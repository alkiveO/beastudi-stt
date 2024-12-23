<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Mahasiswa extends Authenticatable
{
    use HasFactory;

    protected $table = 'mahasiswa';
    protected $guarded = [];

    public function mou()
    {
        return $this->hasOne(Mou::class, 'mhs_id', 'mhs_id');
    }

    public function monitorings()
    {
        return $this->hasMany(Monitoring::class, 'nim', 'nim');
    }
}
