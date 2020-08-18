<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agama extends Model
{
    protected $fillable = [
        'nama'
    ];

    public function mahasiswa(){
    	return $this->hasMany(User::class, 'agama');
    }
}
