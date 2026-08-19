<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mou extends Model
{
    use HasFactory;

    protected $table = 'mou';
    protected $fillable = ['mhs_id', 'spb_rangkap_1', 'spb_rangkap_2', 'surat_komitmen_ortu'];

    public function prodi()
    {
        return $this->belongsTo(ProgramStudi::class, 'program_studi_id');
    }
}
