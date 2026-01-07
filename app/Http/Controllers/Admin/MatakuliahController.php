<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Matakuliah;
use App\Models\Mahasiswa;
use App\Models\Krs;
use App\Models\Periode;

class MatakuliahController extends Controller
{


    public function index()
    {
        $matakuliah = Matakuliah::select('id', 'kode_mk', 'nama_mk', 'sks')
            ->orderBy('kode_mk')
            ->get();

        return view('admin.matakuliah.index', compact('matakuliah'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_mk' => 'required|string|max:50|unique:matakuliah,kode_mk',
            'nama_mk' => 'required|string|max:255',
            'sks'     => 'required|integer|min:1|max:6',
        ]);

        Matakuliah::create([
            'kode_mk' => $request->kode_mk,
            'nama_mk' => $request->nama_mk,
            'sks'     => $request->sks,
        ]);

        return redirect()
            ->back()
            ->with('success', 'Matakuliah berhasil ditambahkan');
    }
    /**
     * =========================
     * SHOW
     * =========================
     */
public function show(Request $request, $id)
{
    $matakuliah = Matakuliah::findOrFail($id);
$tahunMasuk   = $request->tahun_masuk;
$programStudi = $request->program_studi;
$periodeId    = $request->periode_id;

$periodeList = Periode::orderBy('nama')->get();

    /**
     * Mahasiswa yang SUDAH mengambil MK ini
     */
$mahasiswa = Mahasiswa::whereHas('krs', function ($q) use ($id, $periodeId) {
        $q->where('matakuliah_id', $id);

        if ($periodeId) {
            $q->where('periode_id', $periodeId);
        }
    })
    ->when($tahunMasuk, function ($q) use ($tahunMasuk) {
        $q->where('tahun_masuk', $tahunMasuk);
    })
    ->when($programStudi, function ($q) use ($programStudi) {
        $q->where('program_studi', $programStudi);
    })
    ->get();

    /**
     * Mahasiswa BELUM mengambil MK (modal checklist)
     */
    $mahasiswaBelum = Mahasiswa::whereDoesntHave('krs', function ($q) use ($id, $periodeId) {
        $q->where('matakuliah_id', $id);

        if ($periodeId) {
            $q->where('periode_id', $periodeId);
        }
    })
    ->when($tahunMasuk, function ($q) use ($tahunMasuk) {
        $q->where('tahun_masuk', $tahunMasuk);
    })
    ->when($programStudi, function ($q) use ($programStudi) {
        $q->where('program_studi', $programStudi);
    })
    ->get();

$tahunMasukList = Mahasiswa::select('tahun_masuk')
    ->distinct()
    ->orderBy('tahun_masuk', 'desc')
    ->pluck('tahun_masuk');

$programStudiList = Mahasiswa::select('program_studi')
    ->distinct()
    ->orderBy('program_studi')
    ->pluck('program_studi');

   return view('admin.matakuliah.show', compact(
    'matakuliah',
    'mahasiswa',
    'mahasiswaBelum',
    'periodeList',
    'periodeId',
    'tahunMasuk',
    'programStudi',
    'tahunMasukList',
'programStudiList',

));

}


    /**
     * =========================
     * STORE KRS (CHECKLIST)
     * =========================
     */
    public function storeMahasiswa(Request $request, $matakuliahId)
    {
        $request->validate([
            'periode_id'   => 'required',
            'mahasiswa_id' => 'required|array',
        ]);

        foreach ($request->mahasiswa_id as $mahasiswaId) {
            Krs::firstOrCreate([
                'mahasiswa_id'  => $mahasiswaId,
                'matakuliah_id' => $matakuliahId,
                'periode_id'    => $request->periode_id,
            ]);
        }

        return back()->with('success', 'Mahasiswa berhasil ditambahkan');
    }

}
