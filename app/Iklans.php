<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Iklans extends Model
{
    //
    protected $table = 'iklans';

    protected $fillable = [
      'judul', 'keterangan', 'image'
    ];
}
