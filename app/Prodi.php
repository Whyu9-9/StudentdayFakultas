<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prodi extends Model
{
    protected $table = 'tb_prodi';
    public $timestamps = false;

    protected $fillable = ['nama'];

    public function mahasiswa(){
    	return $this->hasMany(User::class, 'prodi_id');
    }
}
