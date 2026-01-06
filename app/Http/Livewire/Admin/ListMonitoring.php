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
protected $listeners = ['monitoringUpdated' => 'reloadPengaturan'];

public function reloadPengaturan()
{
    $this->loadPengaturanMonitoring();
}

 public function mount()
    {
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

    public function updatedSemester($value)
    {
        $this->semester = $value;
        $this->resetPage();
    }

    public function updatedPeriode($value)
    {
        $this->periode = $value;
        $this->resetPage();
    }

    

    /**
     * DOWNLOAD (DIBLOK JIKA DITUTUP)
     */
    public function download()
    {
        if (!$this->pengumpulanAktif) {
            $this->dispatchBrowserEvent('alert', [
                'title' => 'Pengumpulan Ditutup',
                'text'  => 'Pengumpulan laporan sudah ditutup.',
                'icon'  => 'warning',
            ]);
            return;
        }

        return Excel::download(
            new ExportMonitoring(),
            'Monitoring Beastudi.xlsx'
        );
    }

    public function render()
    {
        return view('livewire.admin.list-monitoring', [
            'list_periode' => Periode::latest()->get(),
            'pengumpulanAktif' => $this->pengumpulanAktif,
            'monitorings' => Monitoring::query()
                ->with('mahasiswa', 'periode')
                ->when($this->nim, function ($query) {
                    $query->whereHas('mahasiswa', function ($q) {
                        $q->where('nim', 'like', '%' . $this->nim . '%');
                    });
                })
                ->when($this->nama, function ($query) {
                    $query->whereHas('mahasiswa', function ($q) {
                        $q->whereRaw('LOWER(nama) LIKE ?', [
                            '%' . strtolower($this->nama) . '%'
                        ]);
                    });
                })
                ->when($this->semester, fn ($q) =>
                    $q->where('semester', $this->semester)
                )
                ->when($this->periode, fn ($q) =>
                    $q->where('periode_id', $this->periode)
                )
                ->when($this->status_beastudi, fn ($q) =>
                    $q->where('status_beastudi', $this->status_beastudi)
                )
                ->latest()
                ->paginate(10),
        ]);
    }
}
