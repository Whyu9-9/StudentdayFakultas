<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Periode extends Model
{
    protected $fillable = ['prodi_id', 'mulai', 'berakhir'];
    protected $dates = ['mulai', 'berakhir'];

    public function prodi(){
    	return $this->belongsTo(ProgramStudi::class, 'prodi_id');
    }
}
