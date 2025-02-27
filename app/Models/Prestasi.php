<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prestasi extends Model
{
    use HasFactory;

    protected $table = 'prestasi';
    protected $guarded = [];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'nim', 'nim')
            ->withDefault();
    }

    public function periode()
    {
        return $this->belongsTo(Periode::class)->withDefault();
    }
}
