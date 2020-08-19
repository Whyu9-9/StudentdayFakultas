<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserIklans extends Model
{
    //
    protected $table = 'useriklan';

    protected $fillable = [
        'user_id', 'kegiatan', 'flag'
    ];
}
