<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resume extends Model
{
    //
    protected $table = 'resumes';

    protected $fillable = [
        'prodi_id', 'user_id', 'file'
    ];
}
