<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SatuanBarang extends Model
{
    protected $table = 'table_satuan_barang';
    
    protected $fillable = [
        'nama_satuan',
        'id_barang',
        'harga',
        'status'
    ];

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang');
    }
}