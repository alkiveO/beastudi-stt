<?php

namespace App\Exports;

use App\Models\Prestasi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PrestasiExport implements FromCollection, WithHeadings
{
    protected $kategori_prestasi;

    public function __construct($kategori_prestasi)
    {
        $this->kategori_prestasi = $kategori_prestasi;
    }

    public function collection()
    {
        $query = Prestasi::query()->with(['mahasiswa', 'periode', 'kategori_prestasi']);

        if ($this->kategori_prestasi != -1) {
            if ($this->kategori_prestasi == 0) {
                $query->whereNull('kategori_prestasi_id');
            } else {
                $query->where('kategori_prestasi_id', $this->kategori_prestasi);
            }
        }

        return $query->get()->map(function ($item) {
            return [
                'NIM' => $item->nim,
                'Nama Mahasiswa' => $item->mahasiswa->nama,
                'Semester' => $item->semester,
                'Periode' => $item->periode->nama,
                'Nama Lomba' => $item->nama,
                'Kategori Lomba' => $item->kategori_prestasi->nama ?? 'Lainnya',
            ];
        });
    }

    public function headings(): array
    {
        return ['NIM', 'Nama Mahasiswa', 'Semester', 'Periode', 'Nama Lomba', 'Kategori Lomba'];
    }
}

