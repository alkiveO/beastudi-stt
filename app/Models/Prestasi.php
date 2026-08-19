<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prestasi extends Model
{
    use HasFactory;

    protected $table = 'prestasi';
    protected $fillable = [
        'nim',
        'nama',
        'file',
        'semester',
        'periode_id',
        'monitoring_id',
        'kategori_prestasi_id',
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'nim', 'nim')
            ->withDefault();
    }

    public function periode()
    {
        return $this->belongsTo(Periode::class)->withDefault();
    }

    public function kategori_prestasi()
    {
        return $this->belongsTo(KategoriPrestasi::class)->withDefault();
    }
}
