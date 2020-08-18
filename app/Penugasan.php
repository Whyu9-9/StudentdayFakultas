<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Penugasan extends Model
{
    //
    protected $table = 'penugasans';

    protected $fillable = [
        'prodi_id', 'user_id', 'file','tipe', 'penugasan_id'
    ];
}
