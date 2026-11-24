<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PembimbingAkademik extends Model
{
    use HasFactory;

    protected $table = 'pembimbing_akademik';

    protected $fillable = [
        'nama',
        'program_studi',
    ];

    public $timestamps = false;

    public function users(): HasMany
    {
        return $this->hasMany(
            User::class,
            'pembimbing_akademik_id'
        );
    }

    public function mahasiswa(): HasMany
    {
        return $this->hasMany(
            Mahasiswa::class,
            'pembimbing_akademik_id'
        );
    }
}