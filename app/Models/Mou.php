<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mou extends Model
{
    use HasFactory;

    protected $table = 'mou';
    protected $guarded = [];

    public function prodi()
    {
        return $this->belongsTo(ProgramStudi::class, 'program_studi_id');
    }
}
