<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PembelianBaju extends Model
{
    //
    protected $table = 'pembelian_baju';

    protected $fillable = [
        'user_id', 'nama', 'telp', 'ukuran', 'kegiatan'
    ];
}
