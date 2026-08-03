<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KontribusiKhusus extends Model
{
    use HasFactory;

    protected $table = 'kontribusi_khusus';
    protected $fillable = ['nama', 'slug', 'pic', 'telp_pic'];

    public function monitoring()
    {
        return $this->hasMany(Monitoring::class);
    }

    public function item_kontribusi_khusus()
    {
        return $this->hasMany(ItemKontribusiKhusus::class);
    }
}
