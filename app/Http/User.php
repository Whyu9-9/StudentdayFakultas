<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';
    protected $dateFormat = 'Y-m-d H:i';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['nim', 'password', 'nama', 'nama_panggilan', 'program_studi', 'jenis_kelamin', 
        'gol_darah', 'tempat_lahir', 'tanggal_lahir', 'alamat', 'alamat_sekarang', 
        'no_telepon','id_line', 'no_hp', 'email', 'asal_sekolah', 'hobi', 'cita-cita', 'idola', 
        'moto', 'jumlah_saudara', 'nama_ayah', 'nama_ibu', 'penyakit_khusus', 'profile',
        'mahasiswa_baru', 'angkatan', 'ganti_pass', 'lengkap', 'youtube', 'koordinator','bukti_pembayaran','minat_bakat'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    //protected $dates = ['created_at'];

    public function logs(){
        return $this->hasMany(Log::class, 'mahasiswa_id');
    }

    public function notes(){
        return $this->hasMany(Notes::class, 'user_id');
    }

    public function prestasi(){
        return $this->hasMany(Prestasi::class, 'mahasiswa_id');
    }

    public function organisasi(){
        return $this->hasMany(Organisasi::class, 'mahasiswa_id');
    }

    public function prodi(){
        return $this->belongsTo(ProgramStudi::class, 'program_studi');
    }

    public function kelamin(){
        return $this->belongsTo(JenisKelamin::class, 'jenis_kelamin');
    }

    public function goldarah(){
        return $this->belongsTo(GolonganDarah::class, 'gol_darah');
    }

    public function mhsangkatan(){
        return $this->belongsTo(Angkatan::class, 'angkatan');
    }

    public function mhsagama(){
        return $this->belongsTo(Agama::class, 'agama');
    }
    
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }
}
