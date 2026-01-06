<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengMonitoring extends Model
{
    use HasFactory;

    protected $table = 'pengaturan_monitoring';

    protected $fillable = [
        'is_active',
        'tanggal_buka',
        'tanggal_tutup',
    ];

    protected $casts = [
        'tanggal_buka'  => 'datetime',
        'tanggal_tutup' => 'datetime',
        'is_active'     => 'boolean',
    ];
}
