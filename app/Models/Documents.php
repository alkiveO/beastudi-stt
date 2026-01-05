<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documents extends Model
{
    use HasFactory;
    protected $table = 'documents';
     protected $fillable = [
        'judul',
        'file',
        'tipe',
        'keterangan',
        'is_publish',
    ];

    protected $casts = [
        'is_publish' => 'boolean',
    ];
}
