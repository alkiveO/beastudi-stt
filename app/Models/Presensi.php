<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presensi extends Model
{
    use HasFactory;
    protected $table = 'presensi';

    protected $primaryKey = 'id';

    public $incrementing = true;

    protected $keyType = 'int';

    protected $fillable = [
        'krs_id',
        'total_pertemuan',
        'total_hadir',
    ];

    /**
     * =====================
     * RELATIONS
     * =====================
     */

    public function krs()
    {
        return $this->belongsTo(Krs::class, 'krs_id');
    }

    /**
     * =====================
     * ACCESSORS (OPTIONAL)
     * =====================
     */

    // Persentase kehadiran
    public function getPersentaseKehadiranAttribute()
    {
        if ($this->total_pertemuan == 0) {
            return 0;
        }

        return round(
            ($this->total_hadir / $this->total_pertemuan) * 100,
            2
        );
    }
}
