<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PenugasanSetting extends Model
{
    //
    protected $table = 'penugasansetting';

    protected $fillable = [
        'file', 'tipe', 'keterangan'
    ];
}
