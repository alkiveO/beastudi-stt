<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Monitoring extends Model
{
    use HasFactory;

    protected $table = 'monitoring';
    protected $guarded = [];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'nim', 'nim');
    }

    public function pembimbing_akademik()
    {
        return $this->belongsTo(PembimbingAkademik::class);
    }

    public function kontribusi_khusus()
    {
        return $this->belongsTo(KontribusiKhusus::class);
    }

    public function prestasi()
    {
        return $this->hasMany(Prestasi::class);
    }
}
