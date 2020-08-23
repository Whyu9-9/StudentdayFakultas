<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Prodi;
use App\User;
use App\Log;
use App\Prestasi;
use App\Organisasi;
use Hash;

class BerandaController extends Controller
{
	public function __construct(){
		$this->middleware('auth');
	}

    public function beranda(Request $req){
        if($req->user()->ganti_pass != 1){
            return redirect('/ganti_password')->with('info', 'Mahasiswa diwajibkan mengganti password terlebih dahulu');
        }
        $prestasi = Prestasi::where('mahasiswa_id', $req->user()->id)->count();
        $organisasi = Organisasi::where('mahasiswa_id', $req->user()->id)->count();
    	return view('studentday.user.beranda', compact('prestasi', 'organisasi'));
    }

    public function biodata(Request $req){
        if($req->user()->ganti_pass != 1){
            return redirect('/ganti_password')->with('info', 'Mahasiswa diwajibkan mengganti password terlebih dahulu');
        }
    	return view('studentday.user.biodata.index')
    		->with('prodi',
    			Prodi::all()
    		)->with('goldarah',
    			['A', 'B', 'O', 'AB']
    		);
    }

    public function storeBiodata(Request $req){

        Log::create([
            'mahasiswa_id' => Auth::user()->id,
            'tipe' => 11,
            'konten' => 'Mengupdate Biodata Diri'
        ]);

    	$this->validate($req, [
            'nama_panggilan' => 'required|string',
            'prodi_id' => 'required|integer',
            'jenis_kelamin' => 'required|integer',
            'gol_darah' => 'required',
            'tempat_lahir' => 'required|string',
            'alamat' => 'required|string',
            'alamat_sekarang' => 'required|string',
            'no_telp' => 'required|string',
            'no_hp' => 'required|string',
            'email' => 'required|string',
            'hobi' => 'required|string',
            'asal_sekolah' => 'required|string',
            'cita_cita' => 'required|string',
            'idola' => 'required|string',
            'moto' => 'required|string',
            'jml_saudara' => 'required|integer',
            'nama_ayah' => 'required|string',
            'nama_ibu' => 'required|string',
            'penyakit_khusus' => 'string',
            'angkatan' => 'required|integer'
    	]);

    	$req->user()->update($req->all());
        $req->user()->update(['lengkap' => 1]);
        
    
    	return redirect()->back()->with('success', 'Biodata berhasil diperbaharui');
    }

    public function gantiPassword(){
        return view('studentday.user.ganti_password');
    }

    public function storePasswordBaru(Request $req){
        $this->validate($req, [
            'password_lama' => 'required',
            'password' => 'required|min:6|confirmed'
        ]);

        if(Hash::check($req->password_lama, $req->user()->password)){
            $req->user()->password = Hash::make($req->password);
            if($req->user()->ganti_pass != 1){
                $req->user()->ganti_pass = 1;
            }
            $req->user()->update();
            return redirect()->back()->with('success', 'Password berhasil diganti');
        }

        return redirect()->back()->with('error', 'Password lama tidak cocok');
    }
}
