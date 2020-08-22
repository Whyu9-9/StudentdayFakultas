<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Prestasi;
use App\Log;
use Auth;
use Response;
use Session;
use PDF;

class PrestasiController extends Controller
{
	public function __construct(){
		$this->middleware('admin', [
			'only' => ['show']
		]);
		$this->middleware('auth:user', [
			'only' => ['index', 'store', 'destroy', 'getPdf']
		]);
	}

	public function index(Request $req){
		if(Auth::user()->ganti_pass == 0){
            return redirect('/ganti-password')->with('info', 'Password harus diganti terlebih dahulu');
        }
		$mahasiswa = User::findOrFail($req->user()->id);
		$prestasi = Prestasi::where('mahasiswa_id', $req->user()->id)->get();
		return view('sd.prestasi', compact('mahasiswa', 'prestasi'));
	}

	public function store(Request $req){
		$messages = [
            'required' => 'Kolom :attribute Wajib Diisi!',
            'min' => 'Kolom :attribute Harus Diisi minimum :min karakter!',
			'numeric' => 'Kolom :attribute Hanya Bisa Diisi dengan Angka!',
			'mimes:pdf' => 'Kolom :attribute Hanya Bisa Diisi dengan file format .pdf'
		];

		$this->validate($req, [
			'nama' => 'required|string',
	    	'tingkat' => 'required|string',
			'tahun' => 'required|numeric',
			'berkas' => 'required|mimes:pdf'
		],$messages);

		if($req->tingkat == 'null'){
            return redirect()->back()
            ->withErrors('Kolom Tingkat Harus diisi');
		}

		if($req->hasFile('berkas')){
            $prestasi = $req->file('berkas');
            $name = Auth::user()->nim .'_prestasi_'. time().'.'.$prestasi->getClientOriginalExtension();
            $destinationPath = public_path('/prestasi');
            $prestasi->move($destinationPath, $name);

			Prestasi::create([
				'mahasiswa_id' => $req->user()->id,
				'nama' => $req->nama,
				'tingkat' => $req->tingkat,
				'tahun' => $req->tahun,
				'berkas' => '/prestasi/'.$name
			]);

			Log::create([
				'mahasiswa_id' => $req->user()->id,
				'tipe' => 4,
				'konten' => 'Menambah prestasi : '.$req->nama
			]);
	
			return back()->withSuccess('Prestasi berhasil ditambah');
        }else{
			return back()->withErrors('Prestasi gagal ditambah');
        }

	}

	public function destroy(Request $req, $id){
		$row = Prestasi::findOrFail($id);
		Log::create([
			'mahasiswa_id' => $req->user()->id,
			'tipe' => 5,
			'konten' => 'Menghapus prestasi : '.$row->nama
		]);
		$row->delete();
		return redirect()->back()->with('success', 'Prestasi berhasil dihapus');
	}

    public function show($id){
    	$mahasiswa = User::findOrFail($id);
		$prestasi = Prestasi::where('mahasiswa_id', $id)->get();
    	return view('admin.prestasi', compact('mahasiswa', 'prestasi'));
	}
	
	public function getPdf($id){
		$prestasi = Prestasi::findOrFail($id);
		$mahasiswa = User::findOrFail($prestasi->mahasiswa_id);

        $file = public_path($prestasi->berkas);
        $headers = array(
			'Content-Type: application/pdf',
		);

        return Response::download($file, $mahasiswa->nim.'_prestasi.pdf', $headers);
	}
}
