<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Obat extends Model
{
    public $timestamps = false;

    protected $table = 'obat';
    
    protected $fillable = [
        'nama_obat',
        'kemasan',
        'harga',
    ];
}
