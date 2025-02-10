<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $table = 'table_master_barang';
    
    protected $fillable = [
        'nama_barang',
        'img_url',
        'qty',
        'status'
    ];
}