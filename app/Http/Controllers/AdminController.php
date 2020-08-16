<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
use App\Notes;
use App\ProgramStudi;
use App\Angkatan;
use App\PengumumanStudentDay;
use App\GolonganDarah;
use App\JenisKelamin;
use App\Agama;
use App\Resume;
use App\ResumeTime;
use App\Prestasi;
use DB;
use Hash;
use Session;
use File;
use Image;
use Excel;
use App\Exports\MahasiswaExport;
use Validator;
use Auth;
use Mail;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mahasiswa = User::all()->count();
        // return $mahasiswa;
        $verifikasi = DB::table('users')
                        ->select('users.*', 'logs.*')
                        ->where('users.lengkap', '=', 8)
                        ->count();
        $belum_verifikasi = $mahasiswa - $verifikasi;
        $sudah_verifikasi = DB::table('users')
                            ->select('users.*', 'logs.*')
                            ->where('users.lengkap', '>=', 4)
                            ->count();              
        return view('admin.index', compact('mahasiswa', 'verifikasi', 'belum_verifikasi', 'sudah_verifikasi'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function mahasiswaIndex(Request $req)
    {
        $filter = [];
        $prodis = ProgramStudi::all();
        $data = User::with(['prodi', 'mhsangkatan', 'kelamin','mhsagama','goldarah']);
        // $data = DB::table('users')
        //             ->leftJoin('program_studis', 'users.program_studi', '=', 'program_studis.id')
        //             ->leftJoin('jenis_kelamins', 'users.jenis_kelamin', '=', 'jenis_kelamins.id')
        //             ->leftJoin('golongan_darahs', 'users.gol_darah', '=', 'golongan_darahs.id')
        //             ->leftJoin('angkatans', 'users.angkatan', '=', 'angkatans.id')
        //             ->select('users.*', 'program_studis.nama as prodi', 'jenis_kelamins.nama as jk', 'golongan_darahs.nama as goldar', 'angkatans.tahun as tahun')
        //             ->where('users.id', 2727)
        //             ->orderBy('nim', 'asc');
        // if($req->has('lengkap') && $req->has('prodi')){
        //     if($req['lengkap'] == 0 || $req['lengkap'] == 1 || $req['lengkap'] == 2 || $req['lengkap'] == 3 || $req['lengkap'] == 4 || $req['lengkap'] == 5 || $req['lengkap'] == 6 || $req['lengkap'] == 7 || $req['lengkap'] == 8 || $req['lengkap'] == 9){
        //         $filter['lengkap'] = $req->lengkap;
        //     }

        //     foreach($prodis as $prodi){
        //         if($prodi->id == $req->prodi){
        //             $filter['prodi'] = $req->prodi;
        //             break;
        //         }
        //     }
        //     $data->where([
        //         'lengkap' => $req->lengkap,
        //         'program_studi' => $req->prodi
        //     ]);

        // }
        
        if($req->has('lengkap')){  
            if($req['lengkap'] == 0 || $req['lengkap'] == 1 || $req['lengkap'] == 2 || $req['lengkap'] == 3 || $req['lengkap'] == 4 || $req['lengkap'] == 5 || $req['lengkap'] == 6 || $req['lengkap'] == 7 || $req['lengkap'] == 8 || $req['lengkap'] == 9){
                $data->where('lengkap', $req->lengkap);
                $filter['lengkap'] = $req->lengkap;
            }
        }
        
        if($req->has('prodi')){
            foreach($prodis as $prodi){
                if($prodi->id == $req->prodi){
                    $data->where('program_studi', $req->prodi);
                    $filter['prodi'] = $req->prodi;
                    break;
                }
            }
        }

        if($req->has('maba')){
            if($req->maba == 1 || $req->maba == 2|| $req->maba == 3|| $req->maba == 4){
                $data->where('mahasiswa_baru', $req->maba);
                $filter['maba'] = $req->maba;
            }
        }
        // dd($filter);
        $data = $data->get();
        // dd(isset($data));
        return view('admin.mahasiswa', compact('data', 'filter', 'prodis'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function sdPengumumanIndex()
    {
        $data = DB::table('pengumuman_student_days')->orderBy('id', 'desc')->get();
        return view('admin.sd-pengumuman', compact('data'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function angkatanIndex()
    {
        $data = Angkatan::all();
        return view('admin.angkatan', compact('data'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function golonganDarahIndex()
    {
        $data = GolonganDarah::all();
        return view('admin.golongan-darah', compact('data'));
    }

    public function noteIndex()
    {
        $note = Notes::with(['user']);
        $note= $note->get();
        $datas = User::all();
        return view('admin.noted', compact('note','datas'));
    }

    public function penugasanPdf($id){
        $note = Notes::find($id);
        $mahasiswa = User::find($note->user_id);

        $file= public_path(). $note->tugas;

        $headers = [
            'Content-Type' => 'application/pdf',
         ];

        return response()->download($file, 'tugas-'.$mahasiswa->nim.'.pdf', $headers);
    }
    
    public function getKrmPdf($id){
        $mahasiswa = User::find($id);

        $file = public_path(). $mahasiswa->krm;
        $headers = [
            'Content-Type' => 'application/pdf',
        ];

        return response()->download($file, 'krm-'.$mahasiswa->nim.'.pdf', $headers);
    }

    public function getBuktiPembayaran($id){
        $mahasiswa = User::findOrFail($id);

        $file = public_path().$mahasiswa->bukti_pembayaran;

        $headers = [
            'Content-Type' => 'application/pdf',
        ];

        return response()->download($file, 'bukti-pembayaran-'.$mahasiswa->nim.'.pdf', $headers);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function jenisKelaminIndex()
    {
        $data = JenisKelamin::all();
        return view('admin.jenis-kelamin', compact('data'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function programStudiIndex()
    {
        $data = ProgramStudi::all();
        return view('admin.program-studi', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function mahasiswaCreate()
    {
        $program_studi = ProgramStudi::all();
        $angkatans = Angkatan::all();
        $agamas = Agama::all();
        return view('admin.add-mahasiswa', compact('program_studi', 'angkatans', 'agamas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function sdPengumumanCreate()
    {
        return view('admin.add-sd-pengumuman');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function mahasiswaStore(Request $request)
    {
        $validator = Validator::make($request->all(),[
                'nim' => 'required|string|max:10',
                'nama' => 'required|string',
                'program_studi' => 'required',
                'jenis_kelamin' => 'required',
            ]
        );

        if ($validator->fails()) {
            Session::flash('error', 'Mahasiswa gagal ditambahkan');
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $mahasiswa = new User;
        $mahasiswa->nim = $request->nim;
        $mahasiswa->password = Hash::make($request->nim);
        $mahasiswa->nama = $request->nama;
        $mahasiswa->nama_panggilan = $request->nama_panggilan;
        $mahasiswa->program_studi = $request->program_studi;
        $mahasiswa->jenis_kelamin = $request->jenis_kelamin;
        $mahasiswa->agama = $request->agama;
        $mahasiswa->gol_darah = $request->gol_darah;
        $mahasiswa->tempat_lahir = $request->tempat_lahir;
        $mahasiswa->tanggal_lahir = $request->tanggal_lahir;
        $mahasiswa->alamat = $request->alamat;
        $mahasiswa->alamat_sekarang = $request->alamat_sekarang;
        $mahasiswa->no_telepon = $request->no_telepon;
        $mahasiswa->id_line = $request->id_line;
        $mahasiswa->no_hp = $request->no_hp;
        $mahasiswa->email = $request->email;
        $mahasiswa->asal_sekolah = $request->asal_sekolah;
        $mahasiswa->hobi = $request->hobi;
        $mahasiswa->cita_cita = $request->cita_cita;
        $mahasiswa->idola = $request->idola;
        $mahasiswa->moto = $request->moto;
        $mahasiswa->jumlah_saudara = $request->jumlah_saudara;
        $mahasiswa->nama_ayah = $request->nama_ayah;
        $mahasiswa->nama_ibu = $request->nama_ibu;
        $mahasiswa->vegetarian = $request->vegetarian;
        $mahasiswa->penyakit_khusus = $request->penyakit_khusus;
        $mahasiswa->mahasiswa_baru = $request->mahasiswa_baru;
        $mahasiswa->angkatan = $request->angkatan;
        $mahasiswa->save();
        Session::flash('success', 'Mahasiswa berhasil ditambahkan');
        return redirect()->route('admin.mahasiswa');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function sdPengumumanStore(Request $request)
    {
        $messages = [
            'required' => 'Kolom :attribute Wajib Diisi!',
		];
		
		$this->validate($request, [
			'judul' => 'required|string',
	    	'konten' => 'required|string',
        ],$messages);
        
        $pengumuman = new PengumumanStudentDay;
        $pengumuman->judul = $request->judul;
        $pengumuman->konten = $request->konten;
        if($request->hasFile('gambar')){
    		$thumbnail = $request->file('gambar');
    		$fileName = time() . '.' .$thumbnail->getClientOriginalExtension();
    		Image::make($thumbnail)->save('thumbnail/' . $fileName);
    		$pengumuman->gambar = $fileName;
        }
        $pengumuman->save();
        Session::flash('success', 'Pengumuman berhasil ditambahkan');
        return redirect()->route('admin.sd-pengumuman');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function angkatanStore(Request $request)
    {
        $angkatan = new Angkatan;
        $angkatan->tahun = $request->tahun;
        $angkatan->save();
        Session::flash('success', 'Angkatan berhasil ditambahkan');
        return redirect()->route('admin.angkatan-index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function jenisKelaminStore(Request $request)
    {
        $jenis_kelamin = new JenisKelamin;
        $jenis_kelamin->nama = $request->nama;
        $jenis_kelamin->save();
        Session::flash('success', 'Jenis kelamin berhasil ditambahkan');
        return redirect()->route('admin.jenis-kelamin-index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function programStudiStore(Request $request)
    {
        $prodi = new ProgramStudi;
        $prodi->nama = $request->nama;
        $prodi->save();
        Session::flash('success', 'Program studi berhasil ditambahkan');
        return redirect()->route('admin.program-studi-index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function mahasiswaEdit($id)
    {
        $data = User::find($id);
        $program_studi = ProgramStudi::all();
        $angkatans = Angkatan::all();
        $jenis_kelamins = JenisKelamin::all();
        $agamas = Agama::all();
        $gol_darahs = GolonganDarah::all();
        $note = Notes::where('user_id', $id)->orderBy('created_at', 'desc')->first();
        // return $mahasiswa;
        return view('admin.edit-mahasiswa', compact('data', 'program_studi', 'angkatans', 'jenis_kelamins', 'agamas', 'gol_darahs','note'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function sdPengumumanEdit($id)
    {
        $data = PengumumanStudentDay::find($id);
        return view('admin.edit-sd-pengumuman', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function mahasiswaUpdate(Request $request, $id)
    {
        $validator = Validator::make($request->all(),
            [
                'nim' => 'required|string|max:10',
                'nama' => 'required|string',
                'program_studi' => 'required',
                'jenis_kelamin' => 'required',
            ]
        );

        if ($validator->fails()) {
            Session::flash('error', 'Mahasiswa gagal diperbaharui');
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        $mahasiswa = User::find($id);
        $mahasiswa->nim = $request->nim;
        $mahasiswa->nama = $request->nama;
        $mahasiswa->nama_panggilan = $request->nama_panggilan;
        $mahasiswa->program_studi = $request->program_studi;
        $mahasiswa->jenis_kelamin = $request->jenis_kelamin;
        $mahasiswa->agama = $request->agama;
        $mahasiswa->gol_darah = $request->gol_darah;
        $mahasiswa->tempat_lahir = $request->tempat_lahir;
        $mahasiswa->tanggal_lahir = $request->tanggal_lahir;
        $mahasiswa->alamat = $request->alamat;
        $mahasiswa->alamat_sekarang = $request->alamat_sekarang;
        $mahasiswa->no_telepon = $request->no_telepon;
        $mahasiswa->id_line = $request->id_line;
        $mahasiswa->no_hp = $request->no_hp;
        $mahasiswa->email = $request->email;
        $mahasiswa->asal_sekolah = $request->asal_sekolah;
        $mahasiswa->hobi = $request->hobi;
        $mahasiswa->cita_cita = $request->cita_cita;
        $mahasiswa->idola = $request->idola;
        $mahasiswa->moto = $request->moto;
        $mahasiswa->jumlah_saudara = $request->jumlah_saudara;
        $mahasiswa->nama_ayah = $request->nama_ayah;
        $mahasiswa->nama_ibu = $request->nama_ibu;
        $mahasiswa->vegetarian = $request->vegetarian;
        $mahasiswa->penyakit_khusus = $request->penyakit_khusus;
        $mahasiswa->mahasiswa_baru = $request->mahasiswa_baru;
        $mahasiswa->angkatan = $request->angkatan;
        $mahasiswa->save();

        /**
        * Store a newly created resource in storage.
        *
        * @param  \Illuminate\Http\Request  $request
        * @return \Illuminate\Http\Response
        */
        // $note = new Notes;
        // $note->user_id = $id;
        // $note->notes = $request->note;
        // $note->save();
        Session::flash('success', 'Mahasiswa berhasil diperbaharui / Note Berhasil Ditambahkan !');
        return redirect()->route('admin.mahasiswa');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function verify($id)
    {
        $verify= 8;
        $mahasiswa = User::find($id);
        $mahasiswa->lengkap = 8;
        $update = $mahasiswa->save();
        if($update){
            Session::flash('success', 'Mahasiswa Telah Terverifikasi');
            return redirect()->back();
        }else{
            Session::flash('failed', 'Mahasiswa gagal Diverifikasi');
            return redirect()->back();
        }
    }

    public function getpdfscan($id){
        $mahasiswa = User::find($id);

        $file= public_path(). $mahasiswa->scan_penyakit;

        $headers = [
            'Content-Type' => 'application/pdf',
         ];

        return response()->download($file, 'scan-penyakit-'.$mahasiswa->nim.'.pdf', $headers);
    }

    private function checkkoordinator($id){
        $mahasiswa = User::find($id);

        if($mahasiswa->mahasiswa_baru == 2){
            return 0;
        }

        if($mahasiswa === null){
            return 0;
        }else{
            $data = DB::table('users')
                    ->select('koordinator')
                    ->where([
                        'program_studi' => $mahasiswa->program_studi,
                        'mahasiswa_baru' => 1,
                        'koordinator' => 1
                    ])
                    ->get();
            // dd(count($data));
            if(count($data) > 0){
                return 0;
            }else{
                return 1;
            }
        }

    }

    public function registered($id)
    {
        // dd('x');
        $koor = $this->checkkoordinator($id);
        $verify= 4;
        $mahasiswa = User::find($id);
        // dd($mahasiswa);
        $mahasiswa->lengkap = $verify;
        $mahasiswa->koordinator = $koor;
        $check = $mahasiswa->save();
        // dd($x);
        // $update = $mahasiswa->update([
        //     'lengkap' => 2,
        //     'koordinator' => 1
        // ]);
        if($check){
            // $sendemail = Mail::send('emails.verify', ['user' => $mahasiswa], function ($m) use ($mahasiswa) {
            //     $m->from('studentdayteknik2020@unud.com', 'SDF Teknik 2020');

            //     $m->to($mahasiswa->email, $mahasiswa->name)->subject('Berhasil Mendaftar Student Day Fakultas!');
            // });

            // if($sendemail > 0){
                Session::flash('success', 'Mahasiswa Telah Terdaftar');
                return redirect()->back();
            // }else{
            //     Session::flash('success', 'Mahasiswa Telah Terdaftar, Email Gagal di Kirim!');
            //     return redirect()->route('admin.mahasiswa');
            // }
        }else{
            Session::flash('failed', 'Mahasiswa gagal Terdaftar');
            return redirect()->back();
        }
    }

    public function noteRegister($id, Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'note' => 'required|string'
            ]
        );

        if ($validator->fails()) {
            session()->flash('failed', 'Gagal Mengirim Note');
            return redirect()->getUrlGenerator()->previous();
        }

        $mahasiswa = User::find($id);
        if(isset($mahasiswa)){
            $mahasiswa->update([
                'lengkap' => 2
            ]);

            $note = Notes::create([
                'user_id' => $mahasiswa->id,
                'notes' => $request->note,
                'tipe' => 'registrasi'
            ]);

            session()->flash('success', 'Note kesalahan Pendaftaran berhasil dikirim');
            return redirect()->getUrlGenerator()->previous();
        }else{
            session()->flash('failed', 'Gagal Mengirim Note');
            return redirect()->getUrlGenerator()->previous();
        }
    }

    public function noteVerifikasi($id, Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'note' => 'required|string'
            ]
        );

        if ($validator->fails()) {
            session()->flash('failed', 'Gagal Mengirim Note');
            return redirect()->getUrlGenerator()->previous();
        }

        $mahasiswa = User::find($id);
        if(isset($mahasiswa)){
            $mahasiswa->update([
                'lengkap' => 6
            ]);

            $note = Notes::create([
                'user_id' => $mahasiswa->id,
                'notes' => $request->note,
                'tipe' => 'verifikasi'
            ]);

            session()->flash('success', 'Note kesalahan Verifikasi Ulang berhasil dikirim');
            return redirect()->getUrlGenerator()->previous();
        }else{
            session()->flash('failed', 'Gagal Mengirim Note');
            return redirect()->getUrlGenerator()->previous();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function sdPengumumanUpdate(Request $request, $id)
    {
        $messages = [
            'required' => 'Kolom :attribute Wajib Diisi!',
		];
		
		$this->validate($request, [
            'judul' => 'required|string',
            'konten' => 'required|string',
        ],$messages);

        $pengumuman = PengumumanStudentDay::find($id);
        $pengumuman->judul = $request->judul;
        $pengumuman->konten = $request->konten;
        
        if ($request->hasFile('gambar')) {
            $oldFileName = $pengumuman->gambar;
            File::delete('thumbnail/'. $oldFileName);

            $thumbnail = $request->file('gambar');
    		$fileName = time() . '.' .$thumbnail->getClientOriginalExtension();
    		Image::make($thumbnail)->save('thumbnail/' . $fileName);
    		$pengumuman->gambar = $fileName;
        }

        Session::flash('success', 'Pengumuman berhasil diperbaharui');
        $pengumuman->save();
        return redirect()->route('admin.sd-pengumuman');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function angkatanUpdate(Request $request, $id)
    {
        $angkatan = Angkatan::find($id);
        $angkatan->tahun = $request->tahun;
        $angkatan->save();
        Session::flash('success', 'Angkatan berhasil diperbaharui');
        return redirect()->route('admin.angkatan-index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function jenisKelaminUpdate(Request $request, $id)
    {
        $jenis_kelamin = JenisKelamin::find($id);
        $jenis_kelamin->nama = $request->nama;
        $jenis_kelamin->save();
        Session::flash('success', 'Jenis kelamin berhasil diperbaharui');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function programStudiUpdate(Request $request, $id)
    {
        $prodi = ProgramStudi::find($id);
        $prodi->nama = $request->nama;
        $prodi->save();
        Session::flash('success', 'Program studi berhasil diperbaharui');
        return redirect()->route('admin.program-studi-index');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function mahasiswaDestroy($id)
    {
        $mahasiswa = User::find($id);
        $mahasiswa->delete();
        Session::flash('success', 'Mahasiswa berhasil dihapus');
        return redirect()->route('admin.mahasiswa');
    }

     /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function sdPengumumanDestroy($id)
    {
        $pengumuman = PengumumanStudentDay::find($id);
        $pengumuman->delete();
        Session::flash('success', 'Pengumuman berhasil dihapus');
        return redirect()->route('admin.sd-pengumuman');
    }

     /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function angkatanDestroy($id)
    {
        $angkatan = Angkatan::find($id);
        $angkatan->delete();
        Session::flash('success', 'Angkatan berhasil dihapus');
        return redirect()->route('admin.angkatan-index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function jenisKelaminDestroy($id)
    {
        $jenis_kelamin = JenisKelamin::find($id);
        $jenis_kelamin->delete();
        Session::flash('success', 'Jenis kelamin berhasil dihapus');
        return redirect()->route('admin.jenis-kelamin-index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function programStudiDestroy($id)
    {
        $prodi = ProgramStudi::find($id);
        $prodi->delete();
        Session::flash('success', 'Program studi berhasil dihapus');
        return redirect()->route('admin.program-studi-index');
    }

    public function excel(){
    //     protected $fillable = [
    //     'nim', 'password', 'nama', 'nama_panggilan', 'program_studi', 'jenis_kelamin', 
    //     'gol_darah', 'tempat_lahir', 'tanggal_lahir', 'alamat', 'alamat_sekarang', 
    //     'no_telepon', 'no_hp', 'email', 'asal_sekolah', 'hobi', 'cita-cita', 'idola', 
    //     'moto', 'jumlah_saudara', 'nama_ayah', 'nama_ibu', 'vegetarian', 'penyakit_khusus', 
    //     'mahasiswa_baru', 'angkatan', 'ganti_pass'
    // ];
        // $data = User::with([
        //     'prodi',
        //     'mhsangkatan',
        //     'goldarah',
        //     'kelamin',
        //     'tb_log' => function($q){
        //         $q->where('tipe', 1)->orderBy('id', 'desc')->first();
        //     }
        // ])->withCount('prestasi', 'organisasi')->get();
        return Excel::download(new MahasiswaExport, 'mahasiswa.xlsx');
        // $arr_excel = array(
        //     'No',
        //     'NIM',
        //     'Nama Lengkap',
        //     'Nama Panggilan',
        //     'Program Studi',
        //     'Jenis Kelamin',
        //     'Gol Darah',
        //     'Tempat Lahir',
        //     'Tanggal Lahir',
        //     'Alamat Asal',
        //     'Alamat Sekarang',
        //     'No Telp',
        //     'No HP',
        //     'Email',
        //     'Asal Sekolah',
        //     'Hobi',
        //     'Cita-cita',
        //     'Idola',
        //     'Moto',
        //     'Jumlah Saudara',
        //     'Nama Ayah',
        //     'Nama Ibu',
        //     'Vegetarian',
        //     'Penyakit Khusus',
        //     'Mahasiswa Baru',
        //     'Angkatan',
        //     'Prestasi',
        //     'Pengalaman Organisasi',
        //     'Terakhir Login'
        // );
        // foreach ($data as $i => $row) {
        //     $arr_excel[] = array(
        //         'No' => $i + 1,
        //         'NIM' => $row->nim,
        //         'Nama Lengkap' => $row->nama,
        //         'Nama Panggilan' => $row->nama_panggilan,
        //         'Program Studi' => $row->prodi->nama,
        //         'Jenis Kelamin' => $row->kelamin->nama,
        //         'Gol Darah' => $row->goldarah->nama,
        //         'Tempat Lahir' => $row->tempat_lahir,
        //         'Tanggal Lahir' => $row->tanggal_lahir,
        //         'Alamat Asal' => $row->alamat,
        //         'Alamat Sekarang' => $row->alamat_sekarang,
        //         'No Telp' => $row->no_telepon,
        //         'No HP' => $row->no_hp,
        //         'Email' => $row->email,
        //         'Asal Sekolah' => $row->asal_sekolah,
        //         'Hobi' => $row->hobi,
        //         'Cita-cita' => $row->cita_cita,
        //         'Idola' => $row->idola,
        //         'Moto' => $row->moto,
        //         'Jumlah Saudara' => $row->jumlah_saudara,
        //         'Nama Ayah' => $row->nama_ayah,
        //         'Nama Ibu' => $row->nama_ibu,
        //         'Vegetarian' => ($row->vegetarian == 1)? 'Ya' : 'Tidak',
        //         'Penyakit Khusus' => $row->penyakit_khusus,
        //         'Mahasiswa Baru' => ($row->mahasiswa_baru == 1)? 'Ya' : 'Tidak',
        //         'Angkatan' => $row->mhsangkatan->tahun,
        //         'Prestasi' => $row->prestasi_count,
        //         'Pengalaman Organisasi' => $row->organisasi_count,
        //         'Terakhir Login' => (isset($row->tb_log))? $row->tb_log[0]->created_at->format('d-m-Y') : 'Tidak Ada'
        //     );
        // }
        //
    }

    public function gantiPasswordIndex(){
        return view('admin.password');
    }

    public function gantiPassword(Request $req){
    	$this->validate($req, [
    		//'password' => 'required|string|confirmed',
    		'password_lama' => 'required|string'
    	]);

    	if(Hash::check($req->password_lama, Auth::user()->password)){
    		Auth::user()->update([
    			'password' => bcrypt($req->password),
    			'ganti_pass' => 1
    		]);
    		return redirect('/admin-password/reset')->with('success', 'Password berhasil diganti');
    	}

    	return redirect()->back()->with('error', 'Password lama Anda salah');
    }

    public function buatPassword() {
        $data = User::all();
        foreach($data as $row){
            User::find($row->id)->update([
                'password' => bcrypt($row->nim)
            ]);
        }
        return 1;
    }

    public function exportExcel(Request $req) {

        $data = User::with([
            'prestasi',
            'organisasi',
            'prodi',
            'kelamin',
            'goldarah',
            'mhsangkatan',
            'mhsagama',
            'logs' => function($query){
                $query->where('tipe', 1)->orderBy('id', 'desc');
            }
        ]);
        
        if($req->has('lengkap')){
            if($req->lengkap == 0 || $req->lengkap == 1 || $req->lengkap == 2 || $req->lengkap == 3 || $req->lengkap == 4 || $req->lengkap == 5 || $req->lengkap == 6 || $req->lengkap == 7 || $req->lengkap == 8 || $req->lengkap == 9){
                $data->where('lengkap', $req->lengkap);
            }
        }

        if($req->has('prodi')){
            $prodis = ProgramStudi::all();
            foreach($prodis as $prodi){
                if($prodi->id == $req->prodi){
                    $data->where('program_studi', $req->prodi);
                    break;
                }
            }
        }

        if($req->has('maba')){
            if($req->maba == 1 || $req->maba == 2){
                $data->where('mahasiswa_baru', $req->maba);
            }
        }

        $data = $data->get();
        
        // Initialize the array which will be passed into the Excel
        // generator.
        $mahasiswa = []; 

        // Define the Excel spreadsheet headers
        $mahasiswa[] = [
            'NIM', 
            'Nama',
            'Nama Panggilan',
            'Program studi',
            'Jenis Kelamin',
            'Agama',
            'Golongan Darah',
            'Tempat Lahir',
            'Tanggal Lahir',
            'Alamat Asal',
            'Alamat Sekarang',
            'No Telepon',
            'ID Line',
            'Nomor Ponsel',
            'Email',
            'Asal Sekolah',
            'Alasan Kuliah',
            'Hobi',
            'Minat Bakat',
            'Cita-Cita',
            'Idola',
            'Motto',
            'Jumalah Saudara',
            'Nama Ayah',
            'Nama Ibu',
            'Penyakit Khusus',
            'Mahasiswa Baru ?',
            'Angkatan',
            'Prestasi', 
            'Pengalaman Organisasi', 
            'Terakhir login'
        ];

        
        // Convert each member of the returned collection into an array,
        // and append it to the payments array.
        foreach ($data as $row) {
            $login = "Tidak ada";
            if(count($row->logs) > 0){
                $login = $row->logs[0]->created_at->format('l, d F Y - H:i');
            }
            
            $prestasi = "Tidak Ada";
            $p = "";
            if(count($row->prestasi) > 0){
                foreach($row->prestasi as $prestasis){
                    $p = $prestasis['nama']."(".$prestasis['tingkat']."|".$prestasis['tahun'].")".",".$p;
                }
                $prestasi = $p;
            }
            
            $organisasi = "Tidak Ada";
            $o = "";
            if(count($row->organisasi) > 0){
                foreach($row->organisasi as $organisasis){
                    $o = $organisasis['nama'].",".$o;
                }
                $organisasi = $o;
            }
            
            $mhs  = "";
            if($row->mahasiswa_baru){
                if($row->mahasiswa_baru == 2){
                    $mhs = "Tidak";
                }else{
                    $mhs = "Iya";
                }
            }
            $mahasiswa[] = [
                $row->nim,
                $row->nama,
                $row->nama_panggilan,
                $row->prodi['nama'],
                $row->kelamin['nama'],
                $row->mhsagama['nama'],
                $row->goldarah['nama'],
                $row->tempat_lahir,
                $row->tanggal_lahir,
                $row->alamat,
                $row->alamat_sekarang,
                $row->no_telepon,
                $row->id_line,
                $row->no_hp,
                $row->email,
                $row->asal_sekolah,
                $row->alasan_kuliah,
                $row->hobi,
                $row->minat_bakat,
                $row->cita_cita,
                $row->idola,
                $row->moto,
                $row->jumlah_saudara,
                $row->nama_ayah,
                $row->nama_ibu,
                $row->penyakit_khusus,
                $mhs,
                $row->mhsangkatan['tahun'],
                $prestasi,
                $organisasi,
                $login
            ];
        }

        // Generate and return the spreadsheet
        Excel::create('peserta', function($excel) use ($mahasiswa) {

            // Set the spreadsheet title, creator, and description
            $excel->setTitle('Peserta Student Day');

            // Build the spreadsheet, passing in the payments array
            $excel->sheet('sheet1', function($sheet) use ($mahasiswa) {
                $sheet->fromArray($mahasiswa, null, 'A1', false, false);
            });

        })->download('xlsx');
    }

    public function buatbaruakun2020(){
        dd('x');
        
        $mahasiswa = new User;
    }

    // Resume Area
    public function resumeIndex(){
        $resume = Resume::all();
        $mahasiswa = User::all();
        $program_studi = ProgramStudi::all();

        return view('admin.resume', compact('resume', 'mahasiswa', 'program_studi'));
    }

    public function resumeSetting(){
        $resumetime = ResumeTime::all();
        $program_studi = ProgramStudi::all();

        return view('admin.resume-setting', compact('resumetime','program_studi'));
    }

    public function resumeCreate(){
        $program_studi = ProgramStudi::all();
        return view('admin.add-resume', compact('program_studi'));
    }

    public function resumePost(Request $request){
        // dd($request);
        //belom isi validasi
        ResumeTime::create([
            'prodi_id' => $request->program_studi,
            'mulai' => $request->mulai,
            'berakhir' => $request->berakhir
        ]);

        return back()->withSuccess('Berhasil Menambahkan Aturan');
    }

    public function resumeDelete($id){
        $resume = ResumeTime::find($id);
        if(isset($resume)){
            $resume->delete();

            return back()->withSuccess('Berhasil Menghapus Aturan');
        }else{
            return back()->withErrors('Gagal menghapus aturan');
        }
    }

	public function getPrestasiPdf($id){
		$prestasi = Prestasi::findOrFail($id);
		$mahasiswa = User::findOrFail($prestasi->mahasiswa_id);

        $file = public_path($prestasi->berkas);
        $headers = array(
			'Content-Type: application/pdf',
		);

        return Response::download($file, $mahasiswa->nim.'_prestasi.pdf', $headers);
	}
}
