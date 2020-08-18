<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Organisasi;
use App\Log;
use Auth;

class OrganisasiController extends Controller
{
    public function __construct(){
		$this->middleware('admin', [
			'only' => ['show']
		]);
		$this->middleware('auth:user', [
			'only' => ['index', 'store', 'destroy']
		]);
	}

	public function index(Request $req){
		if(Auth::user()->ganti_pass == 0){
            return redirect('/ganti-password')->with('info', 'Password harus diganti terlebih dahulu');
        }
		$mahasiswa = User::with('organisasi')->findOrFail($req->user()->id);
		return view('sd.organisasi', compact('mahasiswa'));
	}

	public function store(Request $req){
		$messages = [
            'required' => 'Kolom :attribute Wajib Diisi!',
            'min' => 'Kolom :attribute Harus Diisi minimum :min karakter!',
            'numeric' => 'Kolom :attribute Hanya Bisa Diisi dengan Angka!',
		];
		
		$this->validate($req, [
			'nama' => 'required|string',
	    	'jabatan' => 'required|string',
	    	'tahun' => 'required|numeric'
		],$messages);

		Organisasi::create([
			'mahasiswa_id' => $req->user()->id,
			'nama' => $req->nama,
	    	'jabatan' => $req->jabatan,
	    	'tahun' => $req->tahun
		]);

		Log::create([
			'mahasiswa_id' => $req->user()->id,
			'tipe' => 6,
			'konten' => 'Menambah pengalaman organisasi: '.$req->nama
		]);

		return redirect()->back()->with('success', 'Organisasi berhasil ditambah');
	}

	public function destroy(Request $req, $id){
		$row = Organisasi::findOrFail($id);
		Log::create([
			'mahasiswa_id' => $req->user()->id,
			'tipe' => 7,
			'konten' => 'Menghapus pengalaman organisasi: '.$row->nama
		]);
		$row->delete();
		return redirect()->back()->with('success', 'Organisasi berhasil dihapus');
	}

	public function show($id){
    	$mahasiswa = User::with('organisasi')->findOrFail($id);
    	return view('admin.organisasi', compact('mahasiswa'));
    }
}
