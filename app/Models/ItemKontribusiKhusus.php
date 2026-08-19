<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ItemKontribusiKhusus extends Model
{
    use HasFactory;

    protected $table = 'item_kontribusi_khusus';
    protected $fillable = ['nama', 'kontribusi_khusus_id'];
    public $timestamps = false;
}
