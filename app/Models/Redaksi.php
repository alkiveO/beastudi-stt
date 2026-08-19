<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Redaksi extends Model
{
    use HasFactory;

    protected $table = 'redaksi';
    protected $fillable = ['jenis', 'slug', 'judul', 'deskripsi'];
    public $timestamps = false;
}
