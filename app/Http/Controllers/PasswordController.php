<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Hash;
use Auth;
use App\Log;
use App\User;

class PasswordController extends Controller
{
    public function __construct(){
    	$this->middleware('auth:users');
    }

    public function gantiPasswordForm(){
    	return view('sd.password');
	}

    public function gantiPassword(Request $req){
		// dd($req);
    	$this->validate($req, [
    		//'password' => 'required|string|confirmed',
    		'password_lama' => 'required|string'
    	]);

    	if(Hash::check($req->password_lama, Auth::user()->password)){
    		Auth::user()->update([
    			'password' => $req->password,
    			'ganti_pass' => 1
    		]);
            Log::create([
                'mahasiswa_id' => Auth::user()->id,
                'tipe' => 8,
                'konten' => 'Mengubah password menjadi '.$req->password
            ]);
    		return redirect('/beranda-sd')->with('success', 'Password berhasil diganti');
    	}

    	return redirect()->back()->with('error', 'Password lama Anda salah');
    }
}
