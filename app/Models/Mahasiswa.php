<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Mahasiswa extends Authenticatable
{
    use HasFactory;

    protected $table = 'mahasiswa';
    protected $fillable = [
        'mhs_id',
        'nim',
        'email',
        'password',
        'nama',
        'rombel',
        'no_kk',
        'no_ktp',
        'no_ktp_kepala_keluarga',
        'nama_kepala_keluarga',
        'tahun_masuk',
        'jenis_kelamin',
        'tanggal_lahir',
        'agama',
        'program_studi',
        'jalur_beastudi',
        'provinsi',
        'kota',
        'kecamatan',
        'kelurahan',
        'nomor_hp',
        'nomor_hp_ortu',
        'kode_pos',
        'alamat',
        'status',
    ];

    protected $dataDiriWajib = [
        'nama',
        'tahun_masuk',
        'program_studi',
        'jalur_beastudi',
        'no_ktp',
        'no_kk',
        'nomor_hp',
        'nomor_hp_ortu',
        'kode_pos',
        'jenis_kelamin',
        'tanggal_lahir',
        'agama',
        'alamat',
        'provinsi',
        'kota',
        'kecamatan',
        'kelurahan',
    ];

    public function isDataDiriLengkap()
    {
        return empty($this->missingDataDiri());
    }

    public function missingDataDiri()
    {
        $missing = [];

        foreach ($this->dataDiriWajib as $field) {
            if (! filled($this->{$field})) {
                $missing[] = $field;
            }
        }

        return $missing;
    }

    public function mou()
    {
        return $this->hasOne(Mou::class, 'mhs_id', 'mhs_id');
    }

    public function monitorings()
    {
        return $this->hasMany(Monitoring::class, 'nim', 'nim');
    }
    public function krs()
{
    return $this->hasMany(Krs::class, 'mahasiswa_id');
}

}
