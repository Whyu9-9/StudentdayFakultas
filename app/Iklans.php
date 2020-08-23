<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Iklans extends Model
{
    //
    protected $table = 'iklans';

    protected $fillable = [
      'judul', 'keterangan', 'image'
    ];

    public function prodi(){
      return $this->belongsTo(ProgramStudi::class, 'program_studi');
  }

  public function mahasiswa(){
    return $this->hasMany(User::class, 'prodi_id');
  }
}
