<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notes extends Model
{
    protected $table = "notes";
    //
    protected $fillable = ['user_id', 'notes', 'tipe', 'notes_ilmiah'];

    public function user(){
    	return $this->belongsTo(User::class, 'user_id');
    }
}
