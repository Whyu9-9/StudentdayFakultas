<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    protected $fillable = ['nama','jenis','gambar','link'];

    public function user(){
    	return $this->belongsTo(User::class, 'user_id');
    }
}
