<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Organisasi extends Model
{
    protected $fillable = [
    	'mahasiswa_id',
    	'nama',
    	'jabatan',
    	'tahun'
    ];

    public function mahasiswa(){
    	$this->belongsTo(Mahasiswa::class, 'mahasiswa_id');
    }
}
