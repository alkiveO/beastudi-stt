<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maba extends Model
{
    use HasFactory;

    protected $table = 'maba';
    protected $guarded = [];

    public function prodi()
    {
        return $this->belongsTo(ProgramStudi::class, 'program_studi_id');
    }
}
