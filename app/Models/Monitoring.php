<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Monitoring extends Model
{
    use HasFactory;

    protected $table = 'monitoring';
    protected $guarded = [];

    public function periode()
    {
        return $this->belongsTo(Periode::class)->withDefault();
    }

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'nim', 'nim')
            ->withDefault();
    }
 

public function evaluasi()
{
    return $this->hasMany(Evaluasi::class);
}


    public function pembimbing_akademik()
    {
        return $this->belongsTo(PembimbingAkademik::class)
            ->withDefault();
    }

    public function kontribusi_khusus()
    {
        return $this->belongsTo(KontribusiKhusus::class)
            ->withDefault();
    }

    public function prestasi()
    {
        return $this->hasMany(Prestasi::class);
    }

    public function getFormatStatusBeastudiAttribute()
    {
        if ($this->status_beastudi === 'aman') {
            return '<span class="badge badge-success" style="padding:8px; font-size:12px;">Aman</span>';
        } elseif ($this->status_beastudi === 'evaluasi') {
            return '<span class="badge badge-warning" style="padding:8px; font-size:12px;">Evaluasi</span>';
        } elseif ($this->status_beastudi === 'keluar') {
            return '<span class="badge badge-danger" style="padding:8px; font-size:12px;">Keluar</span>';
        } else {
            return '<span class="badge badge-secondary" style="padding:8px; font-size:12px;">Menunggu Update</span>';
        }
    }
}
