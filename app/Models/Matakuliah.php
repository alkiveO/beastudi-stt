<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matakuliah extends Model
{
    use HasFactory;
    // Nama tabel (karena bukan bentuk plural default Laravel)
    protected $table = 'matakuliah';

    // Primary key
    protected $primaryKey = 'id';

    // Auto increment
    public $incrementing = true;

    // Tipe primary key
    protected $keyType = 'int';

    // Kolom yang boleh diisi (mass assignment)
    protected $fillable = [
        'kode_mk',
        'nama_mk',
        'sks',
    ];

    public function krs()
{
    return $this->hasMany(Krs::class, 'matakuliah_id');
}

}
