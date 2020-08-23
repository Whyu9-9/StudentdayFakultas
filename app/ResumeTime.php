<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResumeTime extends Model
{
    //
    protected $table = 'resume_time';

    protected $fillable = [
        'prodi_id', 'mulai', 'berakhir'
    ];
}
