<?php

namespace App\Http\Livewire\Admin;

use App\Models\Periode;
use Livewire\Component;
use App\Models\Monitoring;
use App\Models\PengMonitoring;
use Livewire\WithPagination;
use App\Exports\ExportMonitoring;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
class ListMonitoring extends Component
{
    use WithPagination;

    public $nim;
    public $nama;
    public $semester;
    public $periode;
    public $status_beastudi;
        // 🔐 STATUS PENGUMPULAN
    public $tanggal_buka = null;
    public $tanggal_tutup = null;
    public $pengumpulanAktif = false;
  



    protected $queryString = [
        'nim' => ['except' => ''],
        'nama' => ['except' => ''],
        'semester' => ['except' => ''],
        'periode' => ['except' => ''],
        'status_beastudi' => ['except' => ''],
    ];
protected $listeners = ['monitoringUpdated' => 'reloadPengaturan',  'refreshMonitoring' => '$refresh',];

public function reloadPengaturan()
{
    $this->loadPengaturanMonitoring();
}

public function mount()
{
    $this->semester = $this->semester ? (string) $this->semester : null;
    $this->periode  = $this->periode ? (string) $this->periode : null;

    $this->loadPengaturanMonitoring();

     
}


    /**
     * Ambil status pengumpulan
     */
   protected function loadPengaturanMonitoring()
{
    $config = PengMonitoring::first();

    if (!$config || !$config->tanggal_buka) {
        $this->pengumpulanAktif = false;
        return;
    }

    $this->tanggal_buka  = $config->tanggal_buka;
    $this->tanggal_tutup = $config->tanggal_tutup;

    $now = Carbon::now();

    $this->pengumpulanAktif =
        $now->gte(Carbon::parse($this->tanggal_buka)) &&
        (
            !$this->tanggal_tutup ||
            $now->lte(Carbon::parse($this->tanggal_tutup))
        );
}

    // public function updatedSemester($value)
    // {
    //     $this->semester = $value;
    //     $this->resetPage();
    // }

    // public function updatedPeriode($value)
    // {
    //     $this->periode = $value;
    //     $this->resetPage();
    // }
public function updated($property)
{
    if (in_array($property, [
        'nim',
        'nama',
        'semester',
        'periode',
        'status_beastudi',
    ])) {
        $this->resetPage();
    }
}

public function resetFilter()
{
    $this->nim = null;
    $this->nama = null;
    $this->semester = null;
    $this->periode = null;
    $this->status_beastudi = null;

    $this->resetPage();

    // 🔥 trigger event ke JS (khusus reset selectpicker)
    $this->dispatchBrowserEvent('reset-filter-ui');
}

    

    /**
     * DOWNLOAD (DIBLOK JIKA DITUTUP)
     */
  public function download()
{
    Log::info('[DOWNLOAD] Memulai proses download', ['user_id' => auth()->id()]);

    if (!$this->pengumpulanAktif) {
        $this->dispatchBrowserEvent('alert', [
            'title' => 'Pengumpulan Ditutup',
            'text'  => 'Pengumpulan laporan sudah ditutup.',
            'icon'  => 'warning',
        ]);
        return;
    }

    try {
        // Membersihkan buffer agar tidak ada karakter tersembunyi yang merusak file Excel
        if (ob_get_level() > 0) {
            ob_end_clean();
        }

        return Excel::download(
            new ExportMonitoring([
                'nim' => $this->nim,
                'nama' => $this->nama,
                'semester' => $this->semester,
                'periode' => $this->periode,
                'status_beastudi' => $this->status_beastudi,
            ]),
            'Monitoring Beastudi.xlsx'
        );

    } catch (\Throwable $e) {
        Log::error('[DOWNLOAD] Gagal export Excel: ' . $e->getMessage());

        $this->dispatchBrowserEvent('alert', [
            'title' => 'Gagal Download',
            'text'  => 'Terjadi kesalahan teknis di server.',
            'icon'  => 'error',
        ]);
    }
}




    public function render()
{
    $monitorings = Monitoring::query()
    ->with(['mahasiswa', 'periode'])
    ->when($this->nim, fn ($q) =>
        $q->whereHas('mahasiswa', fn ($m) =>
            $m->where('nim', 'like', "%{$this->nim}%")
        )
    )
    ->when($this->nama, fn ($q) =>
        $q->whereHas('mahasiswa', fn ($m) =>
            $m->whereRaw('LOWER(nama) LIKE ?', ['%' . strtolower($this->nama) . '%'])
        )
    )
    ->when($this->semester, fn ($q) =>
        $q->where('semester', $this->semester)
    )
    ->when($this->periode, fn ($q) =>
        $q->where('periode_id', $this->periode)
    )
    ->when($this->status_beastudi, fn ($q) =>
        $q->where('status_beastudi', $this->status_beastudi)
    )
    ->orderBy('id', 'asc')   // 🔥 INI KUNCINYA
    ->paginate(10);

    return view('livewire.admin.list-monitoring', [
        'monitorings' => $monitorings,
        'list_periode' => Periode::latest()->get(),
        'pengumpulanAktif' => $this->pengumpulanAktif,
    ]);
}

}
