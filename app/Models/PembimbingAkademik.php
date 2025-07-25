<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PembimbingAkademik extends Model
{
    use HasFactory;

    protected $table = 'pembimbing_akademik';
    protected $guarded = [];
    public $timestamps = false;
}
