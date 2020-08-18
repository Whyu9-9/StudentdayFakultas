<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use Session;
use PDF;
use Carbon\Carbon;
use Response;
use Validator;
use App\User;
use App\Penugasan;
use App\Angkatan;
use App\ProgramStudi;
use App\GolonganDarah;
use App\JenisKelamin;
use App\Agama;
use App\PengumumanStudentDay;
use App\Periode;
use App\Log;
use App\Notes;
use App\ResumeTime;
use App\Resume;
use App\Organisasi;
use App\Prestasi;
use \Carbon\now;
use App\PenugasanSetting;

class DashboardSdController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        date_default_timezone_set('Asia/Jakarta');
        //$periodes = Periode::with('prodi')->get();
        $status = 0;
        // foreach($periodes as $periode){
        //     $mulai = Carbon::parse($periode->mulai);
        //     $berakhir = Carbon::parse($periode->berakhir);
        //     if(Carbon::now()->between($mulai, $berakhir) || ($periode->mulai->isToday() || $periode->berakhir->isToday())){
        //         if($periode->prodi_id == 0 || Auth::user()->program_studi == $periode->prodi_id){
        //             $status = 1;
        //             break;
        //         } else {
        //             Log::create([
        //                 'mahasiswa_id' => Auth::user()->id,
        //                 'tipe' => 9,
        //                 'konten' => 'Mencoba login saat tidak dalam periode'
        //             ]);
        //             Log::create([
        //                 'mahasiswa_id' => Auth::user()->id,
        //                 'tipe' => 2,
        //                 'konten' => 'Log Out'
        //             ]);
        //             Auth::logout(Auth::user());
        //             return redirect('/login')->with('info', 'Hanya Program Studi '. $periode->prodi->nama.' yang dapat mengakses saat ini');
        //         }
        //         $status = 1;
        //     }
        // }

        // if(!$status){
        //     Auth::logout(Auth::user());
        //     return redirect('/login')->with('info', 'Anda tidak dapat mengakses untuk saat ini');
        // }

        $periode = Periode::where('prodi_id', Auth::user()->program_studi)->first();
    	$mulai = Carbon::parse($periode->mulai);
    	$berakhir = Carbon::parse($periode->berakhir);
    	if(Carbon::now()->between($mulai, $berakhir) || ($periode->mulai->isToday() || $periode->berakhir->isToday())){
	    	$status = 1;
	    } else {
	    	$status = 1;
	    }

	    if(!$status){
            Auth::logout(Auth::user());
            return redirect('/login')->with('info', 'Anda tidak dapat mengakses untuk saat ini');
        }

        if(Auth::user()->ganti_pass == 0){
            return redirect('/ganti-password')->with('info', 'Password harus diganti terlebih dahulu');
        }
        $data = DB::table('pengumuman_student_days')
            ->orderBy('id', 'desc')
            ->simplePaginate(3);
        // return $data;
        return view('sd.beranda', compact('data'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function biodata()
    {
        if(Auth::user()->ganti_pass == 0){
            return redirect('/ganti-password')->with('info', 'Password harus diganti terlebih dahulu');
        }

        $prestasis = DB::table('prestasis')
                    ->leftJoin('users', 'prestasis.mahasiswa_id', '=', 'users.id')
                    ->select('prestasis.nama')
                    ->where('users.id', '=', Auth::user()->id)
                    ->get();
        // return $prestasis;
        
        $organisasis = DB::table('organisasis')
                    ->leftJoin('users', 'organisasis.mahasiswa_id', '=', 'users.id')
                    ->select('organisasis.nama')
                    ->where('users.id', '=', Auth::user()->id)
                    ->get();
        // return $organisasis;
   
        $data = DB::table('users')
                ->leftjoin('angkatans', 'users.angkatan', '=', 'angkatans.id')
                ->leftjoin('golongan_darahs', 'users.gol_darah', '=', 'golongan_darahs.id')
                ->leftJoin('jenis_kelamins', 'users.jenis_kelamin', '=', 'jenis_kelamins.id')
                ->leftjoin('program_studis', 'users.program_studi', '=', 'program_studis.id')
                ->leftjoin('agamas', 'users.agama', '=', 'agamas.id')
                ->select('users.*', 'angkatans.tahun as tahun', 'golongan_darahs.nama as goldar', 'jenis_kelamins.nama as jk', 
                        'program_studis.nama as prodi', 'agamas.nama as agama_')
                ->where('users.id', '=', Auth::user()->id)
                ->first();
        // return Response::json($data);

        $notes = Notes::where([
            'user_id' => Auth::user()->id,
            'tipe' => 'registrasi'
        ])->orderBy('created_at', 'desc')->take('1')->get();
        return view('sd.biodata', compact('data', 'notes'));
    }

    public function cetakBerkas(){
        if(Auth::user()->ganti_pass == 0){
            return redirect('/ganti-password')->with('info', 'Password harus diganti terlebih dahulu');
        }

        if(Auth::user()->lengkap != 8){
            return redirect('/beranda-sd-biodata');
        }

        $data = DB::table('users')
                ->leftjoin('angkatans', 'users.angkatan', '=', 'angkatans.id')
                ->leftjoin('program_studis', 'users.program_studi', '=', 'program_studis.id')
                ->leftjoin('agamas', 'users.agama', '=', 'agamas.id')
                ->select('users.*', 'angkatans.tahun as tahun', 'program_studis.nama as prodi', 'agamas.nama as agama_')
                ->where('users.id', '=', Auth::user()->id)
                ->first();
        return view('sd.cetak-berkas', compact('data'));
    }

    public function nameTag()
    {

        if(Auth::user()->lengkap != 8){
            return redirect('/beranda-sd-biodata');
        }
        if(Auth::user()->lengkap == 0){
            return redirect()->route('beranda-sd.cetak-berkas');
        }
        $data = DB::table('users')
                ->leftjoin('angkatans', 'users.angkatan', '=', 'angkatans.id')
                ->leftjoin('program_studis', 'users.program_studi', '=', 'program_studis.id')
                ->select('users.*', 'angkatans.tahun as tahun', 'program_studis.nama as prodi')
                ->where('users.id', '=', Auth::user()->id)
                ->first();
        Log::create([
            'mahasiswa_id' => Auth::user()->id,
            'tipe' => 10,
            'konten' => 'Mendownload berkas Name Tag'
        ]);
        $pdf = PDF::loadView('sd.name-tag-pdf', compact('data'));
        return $pdf->setPaper('a4', 'potrait')->stream();
    }

    public function biodataPdf()
    {

        if(Auth::user()->lengkap != 8){
            return redirect('/beranda-sd-biodata');
        }
        if(Auth::user()->lengkap == 0){
            return redirect()->route('beranda-sd.cetak-berkas');
        }
        $prestasis = DB::table('prestasis')
                    ->leftJoin('users', 'prestasis.mahasiswa_id', '=', 'users.id')
                    ->select('prestasis.nama')
                    ->where('users.id', '=', Auth::user()->id)
                    ->get();
        // return $prestasis;
        
        $organisasis = DB::table('organisasis')
                    ->leftJoin('users', 'organisasis.mahasiswa_id', '=', 'users.id')
                    ->select('organisasis.nama')
                    ->where('users.id', '=', Auth::user()->id)
                    ->get();
        // return $organisasis;

        $data = DB::table('users')
                ->leftjoin('angkatans', 'users.angkatan', '=', 'angkatans.id')
                ->leftjoin('program_studis', 'users.program_studi', '=', 'program_studis.id')
                ->leftjoin('golongan_darahs', 'users.gol_darah', '=', 'golongan_darahs.id')
                ->leftjoin('agamas', 'users.agama', '=', 'agamas.id')
                ->leftjoin('organisasis', 'users.id', '=', 'organisasis.mahasiswa_id')
                ->leftjoin('prestasis', 'users.id', '=', 'prestasis.mahasiswa_id')
                ->select('users.*', 'angkatans.tahun as tahun', 'program_studis.nama as prodi', 
                        'golongan_darahs.nama as goldar', 'agamas.nama as agama_')
                ->where('users.id', '=', Auth::user()->id)
                ->first(); 

        Log::create([
            'mahasiswa_id' => Auth::user()->id,
            'tipe' => 10,
            'konten' => 'Mendownload berkas Form Verifikasi'
        ]);

        // return Response::json($data);       
        $pdf = PDF::loadView('sd.biodata-pdf', compact('data', 'prestasis', 'organisasis'));
        return $pdf->setPaper('a4', 'potrait')->stream();
    }

    public function evaluasiPdf(){

        if(Auth::user()->lengkap != 8){
            return redirect('/beranda-sd-biodata');
        }
        if(Auth::user()->lengkap == 0){
            return redirect()->route('beranda-sd.cetak-berkas');
        }
        $data = DB::table('users')
                ->join('program_studis', 'users.program_studi', '=', 'program_studis.id')
                ->select('users.*', 'program_studis.nama as prodi')
                ->where('users.id', '=', Auth::user()->id)
                ->first();
        Log::create([
            'mahasiswa_id' => Auth::user()->id,
            'tipe' => 10,
            'konten' => 'Mendownload berkas Kartu Evaluasi'
        ]);
        $pdf = PDF::loadView('sd.evaluasi-pdf', compact('data'));
        // return view('sd.evaluasi-pdf', compact('data'));
        return $pdf->setPaper('a5', 'landscape')->stream();
    }

    public function panduanPdf(){

        if(Auth::user()->lengkap != 8){
            return redirect('/beranda-sd-biodata');
        }
        Log::create([
            'mahasiswa_id' => Auth::user()->id,
            'tipe' => 10,
            'konten' => 'Mendownload berkas Buku Panduan'
        ]);
        $file="berkas/buku_panduan.pdf";
        $headers = array(
              'Content-Type: application/pdf',
            );

        return Response::download($file, 'Buku Panduan Student Day 2020.pdf', $headers);
    }

    public function coverpanduanPdf(){

        if(Auth::user()->lengkap != 8){
            return redirect('/beranda-sd-biodata');
        }
        Log::create([
            'mahasiswa_id' => Auth::user()->id,
            'tipe' => 11,
            'konten' => 'Mendownload berkas Cover Buku Panduan'
        ]);
        $file="berkas/cover_buku_panduan.pdf";
        $headers = array(
              'Content-Type: application/pdf',
            );

        return Response::download($file, 'Cover Buku Panduan.pdf', $headers);
    }

    public function getpdfscan($id){
        $mahasiswa = User::find($id);
        $file= public_path(). $mahasiswa->scan_penyakit;

        $headers = [
            'Content-Type' => 'application/pdf',
         ];

        return response()->download($file, 'scan-penyakit-'.$mahasiswa->nim.'.pdf', $headers);
    }

    public function getBuktiPembayaran($id){
        $mahasiswa = User::findOrFail($id);

        $file = public_path().$mahasiswa->bukti_pembayaran;

        $headers = [
            'Content-Type' => 'application/pdf',
        ];

        return response()->download($file, 'bukti-pembayaran-'.$mahasiswa->nim.'.pdf', $headers);
    }

    public function getKrmPdf($id){
        $mahasiswa = User::find($id);

        $file = public_path(). $mahasiswa->krm;
        $headers = [
            'Content-Type' => 'application/pdf',
        ];

        return response()->download($file, 'krm-'.$mahasiswa->nim.'.pdf', $headers);
    }

    public function getKetentuanVerifikasi(){
        $mahasiswa = User::find(Auth::user()->id);
        if($mahasiswa->lengkap >= 4 && $mahasiswa->lengkap !== 9){
            $file = public_path().'/berkas/KETENTUAN_VERIFIKASI .pdf';
            $headers = [
                'Content-Type' => 'application/pdf ',
            ];
    
            return response()->download($file, 'KETENTUAN VERIFIKASI .pdf', $headers);
        }
    }

    public function verifikasi(){
        /*if(Auth::user()->lengkap != 8){
            return redirect()->route('beranda-sd.biodata');
        }*/
        if(Auth::user()->lengkap == 0){
            return redirect()->route('beranda-sd.biodata');
        }else if(Auth::user()->lengkap == 4 || Auth::user()->lengkap == 5 || Auth::user()->lengkap == 6 || Auth::user()->lengkap == 7 || Auth::user()->lengkap == 8){
            $data = User::where('id',Auth::user()->id)->first();
            $notes = Notes::where([
                'user_id' => Auth::user()->id,
                'tipe' => 'verifikasi'
            ])->orderBy('created_at', 'desc')->take('1')->get();
            $ilmiah = Notes::where([
                'user_id' => Auth::user()->id,
                'tipe' => 'verifikasi',
            ])->get();
            return view('sd.verifikasi',compact('data','notes','ilmiah'));
        }
    }

    public function verifikasipost(Request $request, $id){
        /*if(Auth::user()->lengkap != 8){
            return redirect()->route('beranda-sd.biodata');
        }*/
        $checkuser = User::find($id);
        if($checkuser->mahasiswa_baru == 2){
            if($checkuser->penyakit_khusus == null){  
                if(auth::user()->lengkap == 6){    
                $validator = Validator::make($request->all(), 
                    [
                        'profileimage' => 'image',
                        'bukti-pembayaran' => 'mimes:pdf'
                        // 'angkatan' => 'required',
                    ]
                );
    
                if ($validator->fails()) {
                    Session::flash('error', 'Gagal Upload Verifikasi');
                    return redirect()->back()
                                ->withErrors($validator)
                                ->withInput();
                }
            }else{
                $validator = Validator::make($request->all(), 
                    [
                        'url' => 'required',
                        'profileimage' => 'required|image',
                        'bukti-pembayaran' => 'required|mimes:pdf'
                        // 'angkatan' => 'required',
                    ]
                );
    
                if ($validator->fails()) {
                    Session::flash('error', 'Gagal Upload Verifikasi');
                    return redirect()->back()
                                ->withErrors($validator)
                                ->withInput();
                }
            }
                $mahasiswa = User::find($id);
                if ($request->hasFile('profileimage')) {
                    $image = $request->file('profileimage');
                    $name = $mahasiswa->nim.'_'.time().'.'.$image->getClientOriginalExtension();
                    $destinationPath = public_path('/userprofile');
                    $image->move($destinationPath, $name);
                    $profilepath = '/userprofile/'.$name;
                }else{
                    $profilepath = $mahasiswa->profile;
                }

                if($request->hasFile('bukti-pembayaran')){
                    $pdf = $request->file('bukti-pembayaran');
                    $name = $mahasiswa->nim.'_'.time().'.'.$pdf->getClientOriginalExtension();
                    $destination = public_path('/bukti-pembayaran-mala');
                    $pdf->move($destination, $name);
                    $pdf_bukti = '/bukti-pembayaran-mala/'.$name;
                }else{
                    $pdf_bukti = $mahasiswa->bukti_pembayaran;
                }
                
                // $mahasiswa->koordinator = $this->checkkoordinator($id);
                if(Auth::user()->youtube == null){
                    $mahasiswa->youtube = 'https://www.youtube.com/embed/'.$request->url;
                }
                $mahasiswa->profile = $profilepath;
                if(Auth::user()->lengkap == 6){
                    $mahasiswa->lengkap = 7;
                }else{
                    $mahasiswa->lengkap = 5;
                }
                $mahasiswa->bukti_pembayaran = $pdf_bukti;
                $mahasiswa->save();
                
                Session::flash('success', 'Verifikasi Berhasil');
                return redirect()->route('beranda-sd.verifikasi');
            }else{
                if(auth::user()->lengkap == 6){
                $validator = Validator::make($request->all(), 
                    [
                        'profileimage' => 'image',
                        'riwayat' => 'string',
                        'scan-riwayat' => 'mimes:pdf',
                        'bukti-pembayaran' => 'mimes:pdf'
                        // 'angkatan' => 'required',
                    ]
                );
    
                if ($validator->fails()) {
                    Session::flash('error', 'Gagal Upload Verifikasi');
                    return redirect()->back()
                                ->withErrors($validator)
                                ->withInput();
                }
            }else{
                $validator = Validator::make($request->all(), 
                    [
                        'url' => 'required',
                        'profileimage' => 'required|image',
                        'riwayat' => 'string',
                        'scan-riwayat' => 'required|mimes:pdf',
                        'bukti-pembayaran' => 'required|mimes:pdf'
                        // 'angkatan' => 'required',
                    ]
                );
    
                if ($validator->fails()) {
                    Session::flash('error', 'Gagal Upload Verifikasi');
                    return redirect()->back()
                                ->withErrors($validator)
                                ->withInput();
                }
            }
                $mahasiswa = User::find($id);
                if ($request->hasFile('profileimage')) {
                    $image = $request->file('profileimage');
                    $name = $mahasiswa->nim.'_'.time().'.'.$image->getClientOriginalExtension();
                    $destinationPath = public_path('/userprofile');
                    $image->move($destinationPath, $name);
                    $profilepath = '/userprofile/'.$name;
                }else{
                    $profilepath = $mahasiswa->profile;
                }

                
                if($request->hasFile('bukti-pembayaran')){
                    $pdf = $request->file('bukti-pembayaran');
                    $name = $mahasiswa->nim.'_'.time().'.'.$pdf->getClientOriginalExtension();
                    $destination = public_path('/bukti-pembayaran-mala');
                    $pdf->move($destination, $name);
                    $pdf_bukti = '/bukti-pembayaran-mala/'.$name;
                }else{
                    $pdf_bukti = $mahasiswa->bukti_pembayaran;
                }
    
                if($request->hasFile('scan-riwayat')){
                    $pdf = $request->file('scan-riwayat');
                    $name = $mahasiswa->nim.'_'.time().'.'.$pdf->getClientOriginalExtension();
                    $destination = public_path('/riwayat-penyakit');
                    $pdf->move($destination, $name);
                    $scanpath = '/riwayat-penyakit/'.$name;
                }else{
                    $scanpath = $mahasiswa->scan_penyakit;
                }
                
                // $mahasiswa->koordinator = $this->checkkoordinator($id);
                if(Auth::user()->youtube == null){
                    $mahasiswa->youtube = 'https://www.youtube.com/embed/'.$request->url;
                }
                $mahasiswa->scan_penyakit = $scanpath;
                $mahasiswa->profile = $profilepath;
                if(auth::user()->lengkap == 6){
                    $mahasiswa->lengkap=7;
                }else{
                    $mahasiswa->lengkap = 5;
                }
                $mahasiswa->bukti_pembayaran = $pdf_bukti;
                $mahasiswa->save();
                
                Session::flash('success', 'Verifikasi Berhasil');
                return redirect()->route('beranda-sd.verifikasi');
            }
        }else{
            if($checkuser->penyakit_khusus === null){
                if(auth::user()->lengkap == 6){      
                $validator = Validator::make($request->all(), 
                    [
                        'profileimage' => 'image'
                        // 'angkatan' => 'required',
                    ]
                );

                if ($validator->fails()) {
                    Session::flash('error', 'Gagal Upload Verifikasi');
                    return redirect()->back()
                                ->withErrors($validator)
                                ->withInput();
                }
            }else{
                $validator = Validator::make($request->all(), 
                    [
                        'url' => 'required',
                        'profileimage' => 'image'
                        // 'angkatan' => 'required',
                    ]
                );

                if ($validator->fails()) {
                    Session::flash('error', 'Gagal Upload Verifikasi');
                    return redirect()->back()
                                ->withErrors($validator)
                                ->withInput();
                }
            }
                $mahasiswa = User::find($id);
                if ($request->hasFile('profileimage')) {
                    $image = $request->file('profileimage');
                    $name = $mahasiswa->nim.time().'_'.'.'.$image->getClientOriginalExtension();
                    $destinationPath = public_path('/userprofile');
                    $image->move($destinationPath, $name);
                    $profilepath = '/userprofile/'.$name;
                }else{
                    $profilepath = $mahasiswa->profile;
                }


                if($request->hasFile('bukti-pembayaran')){
                    $pdf = $request->file('bukti-pembayaran');
                    $name = $mahasiswa->nim.'_'.time().'.'.$pdf->getClientOriginalExtension();
                    $destination = public_path('/bukti-pembayaran-mala');
                    $pdf->move($destination, $name);
                    $pdf_bukti = '/bukti-pembayaran-mala/'.$name;
                }else{
                    $pdf_bukti = $mahasiswa->bukti_pembayaran;
                }
                
                // $mahasiswa->koordinator = $this->checkkoordinator($id);
                if(Auth::user()->youtube == null){
                    $mahasiswa->youtube = 'https://www.youtube.com/embed/'.$request->url;
                }
                $mahasiswa->profile = $profilepath;
                $mahasiswa->bukti_pembayaran = $pdf_bukti;
                if(auth::user()->lengkap == 6){
                    $mahasiswa->lengkap = 7;
                }else{
                    $mahasiswa->lengkap = 5;
                }
                $mahasiswa->save();
                
                Session::flash('success', 'Verifikasi Berhasil');
                return redirect()->route('beranda-sd.verifikasi');
            }else{
                if(auth::user()->lengkap == 6){
                $validator = Validator::make($request->all(), 
                    [
                        'profileimage' => 'image',
                        'riwayat' => 'required',
                        'scan-riwayat' => 'mimes:pdf'
                        // 'angkatan' => 'required',
                    ]
                );

                if ($validator->fails()) {
                    Session::flash('error', 'Gagal Upload Verifikasi');
                    return redirect()->back()
                                ->withErrors($validator)
                                ->withInput();
                }
            }else{
                $validator = Validator::make($request->all(), 
                    [
                        'url' => 'required',
                        'profileimage' => 'required|image',
                        'riwayat' => 'required',
                        'scan-riwayat' => 'required|mimes:pdf'
                        // 'angkatan' => 'required',
                    ]
                );

                if ($validator->fails()) {
                    Session::flash('error', 'Gagal Upload Verifikasi');
                    return redirect()->back()
                                ->withErrors($validator)
                                ->withInput();
                }
            }
                $mahasiswa = User::find($id);
                if ($request->hasFile('profileimage')) {
                    $image = $request->file('profileimage');
                    $name = $mahasiswa->nim.'_'.time().'.'.$image->getClientOriginalExtension();
                    $destinationPath = public_path('/userprofile');
                    $image->move($destinationPath, $name);
                    $profilepath = '/userprofile/'.$name;
                }else{
                    $profilepath = $mahasiswa->profile;
                }

                if($request->hasFile('scan-riwayat')){
                    $pdf = $request->file('scan-riwayat');
                    $name = $mahasiswa->nim.'_'.time().'.'.$pdf->getClientOriginalExtension();
                    $destination = public_path('/riwayat-penyakit');
                    $pdf->move($destination, $name);
                    $scanpath = '/riwayat-penyakit/'.$name;
                }else{
                    $scanpath = $mahasiswa->scan_penyakit;
                }

                if($request->hasFile('bukti-pembayaran')){
                    $pdf = $request->file('bukti-pembayaran');
                    $name = $mahasiswa->nim.'_'.time().'.'.$pdf->getClientOriginalExtension();
                    $destination = public_path('/bukti-pembayaran-mala');
                    $pdf->move($destination, $name);
                    $pdf_bukti = '/bukti-pembayaran-mala/'.$name;
                }else{
                    $pdf_bukti = $mahasiswa->bukti_pembayaran;
                }
                
                // $mahasiswa->koordinator = $this->checkkoordinator($id);
                if(Auth::user()->youtube == null){
                    $mahasiswa->youtube = 'https://www.youtube.com/embed/'.$request->url;
                }
                $mahasiswa->scan_penyakit = $scanpath;
                $mahasiswa->profile = $profilepath;
                $mahasiswa->bukti_pembayaran = $pdf_bukti;
                if(auth::user()->lengkap ==6 ){
                    $mahasiswa->lengkap = 7;
                }else{
                    $mahasiswa->lengkap = 5;
                }
                $mahasiswa->save();
                
                Session::flash('success', 'Verifikasi Berhasil');
                return redirect()->route('beranda-sd.verifikasi');
            }
        }
    }

    private function checkkoordinator($id){
        $mahasiswa = User::find($id);
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
            if(count($data) !== 0){
                return 0;
            }else{
                return 1;
            }
        }

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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function qrCode(){
        if(Auth::user()->lengkap >= 4 && Auth::user()->lengkap == 9){
            return redirect()->route('beranda-sd.biodata');
        }
        $user = User::where('id',Auth::user()->id)->first();
        return view('sd.qrcode', Compact('user'));
    }

    public function daftar($id){
        $user = User::find($id);
        if(isset($user)){
            if($user->jenis_kelamin == null || $user->nama_panggilan == null || $user->agama == null || $user->alasan_kuliah == null || $user->gol_darah == null || $user->tempat_lahir == null || $user->tanggal_lahir == null || $user->alamat == null || $user->alamat_sekarang == null || $user->id_line == null || $user->no_hp == null || $user->email == null || $user->asal_sekolah == null || $user->cita_cita == null || $user->idola == null || $user->moto == null || $user->jumlah_saudara == null || $user->nama_ayah == null || $user->nama_ibu == null || $user->krm == null || $user->minat_bakat == null || $user->profile == null){ 
                return back()->withErrors('Lengkapi Biodata Sebelum Mendaftar Student Day.');
            }
            
            if($user->checkorpres == 1){
                $organisasi = Organisasi::where('mahasiswa_id', $id)->get();
                if(count($organisasi) == 0){
                    return back()->withErrors('Organisasi belum diisi, lengkapi data untuk daftar student day.');
                }
            }elseif($user->checkorpres == 2){
                $prestasi = Prestasi::where('mahasiswa_id', $id)->get();
                if(count($prestasi) == 0){
                    return back()->withErrors('Prestasi belum diisi, lengkapi data untuk daftar student day.');
                }
            }elseif($user->checkorpres == 3){
                $organisasi = Organisasi::where('mahasiswa_id', $id)->get();
                $prestasi = Prestasi::where('mahasiswa_id', $id)->get();
                if(count($prestasi) == 0 || count($organisasi) == 0){
                    return back()->withErrors('Organisasi & Prestasi belum diisi, lengkapi data untuk daftar student day.');
                }
            }

            $user->update([
                'lengkap' => 1
            ]);

            // Session::flash('success', 'Pendaftaran Berhasil');
            return back()->withSuccess('Pendaftaran Berhasil.');
        }else{
            // Session::flash('success', 'Pendaftaran Gagal, Mahasiswa tidak ditemukan.');
            return back()->withErrors('Mahasiswa tidak ditemukan.');
        }
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
        if(Auth::user()->ganti_pass == 0){
            return redirect('/ganti-password')->with('info', 'Password harus diganti terlebih dahulu');
        }
        $data = User::where('id',Auth::user()->id)->first();
        $program_studi = DB::table('program_studis')
                    ->join('users', 'program_studis.id', '=', 'users.program_studi')
                    ->select('program_studis.nama as prodi')
                    ->where('program_studis.id', '=', $data->program_studi)
                    ->first();
        $angkatans = DB::table('angkatans')
                    ->join('users', 'angkatans.id', '=', 'users.angkatan')
                    ->select('angkatans.tahun as angkatan')
                    ->where('angkatans.id', '=', $data->angkatan)
                    ->first();
        $gol_darahs = GolonganDarah::get();
        $jenis_kelamins = JenisKelamin::get();
        $agamas = Agama::get();
        // return $program_studi->prodi;
        // dd($datas);
        return view('sd.edit-biodata', compact('data', 'program_studi', 'angkatans', 'gol_darahs', 'jenis_kelamins', 'agamas'));
    }

    public function editVerifikasi(){
        $data = User::where('id',Auth::user()->id)->first();
        return view('sd.edit-verifikasi',compact('data'));
    }

    public function editYoutube(){
        return view('sd.edit-youtube');
    }

    public function postYoutube($id, Request $request){
        $validator = Validator::make($request->all(), 
            [
                'url' => 'required',
            ]
        );

        if ($validator->fails()) {
            Session::flash('error', 'Gagal Upload Verifikasi');
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $mahasiswa = User::findOrFail($id);
        $mahasiswa->youtube = 'https://www.youtube.com/embed/'.$request->url;
        $mahasiswa->save();

        return redirect('/beranda-sd/verifikasi/edit/'.Auth::user()->id)->withSuccess('Berhasil Update URL Youtube');
        
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
        if(Auth::user()->ganti_pass == 0){
            return redirect('/ganti-password')->with('info', 'Password harus diganti terlebih dahulu');
        }
        
        $checkorpres = 0;

        $validator = Validator::make($request->all(), 
            [
                'nama' => 'required|string',
                'nama_panggilan' => 'required',
                // 'program_studi' => 'required',
                'jenis_kelamin' => 'required',
                'agama' => 'required',
                'gol_darah' => 'required',
                'tempat_lahir' => 'required',
                'tanggal_lahir' => 'required',
                'alamat' => 'required',
                'alamat_sekarang' => 'required',
                'no_telepon' => 'numeric',
                'id_line' => 'required',
                'no_hp' => 'required',
                'email' => 'required|email',
                'asal_sekolah' => 'required',
                'alasan_kuliah' => 'required',
                'hobi' => 'string',
                'minat_bakat' => 'required',
                'cita_cita' => 'required',
                'idola' => 'required',
                'moto' => 'required',
                'jumlah_saudara' => 'required',
                'nama_ayah' => 'required',
                'nama_ibu' => 'required',
                // 'vegetarian' => 'required',
                'penyakit_khusus' => 'string',
                // 'mahasiswa_baru' => 'required',
                // 'angkatan' => 'required',
            ]
        );
        
        if ($validator->fails()) {
            Session::flash('error', 'Biodata gagal diperbaharui');
            return redirect()->back()
            ->withErrors($validator)
            ->withInput();
        }

        $mahasiswa = User::find($id);
        $mahasiswa->nama = $request->nama;
        $mahasiswa->nama_panggilan = $request->nama_panggilan;
        // $mahasiswa->program_studi = $request->program_studi;
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
        $mahasiswa->alasan_kuliah = $request->alasan_kuliah;
        $mahasiswa->hobi = $request->hobi;
        $mahasiswa->minat_bakat = $request->minat_bakat;
        $mahasiswa->cita_cita = $request->cita_cita;
        $mahasiswa->idola = $request->idola;
        $mahasiswa->moto = $request->moto;
        $mahasiswa->jumlah_saudara = $request->jumlah_saudara;
        $mahasiswa->nama_ayah = $request->nama_ayah;
        $mahasiswa->nama_ibu = $request->nama_ibu;
        // $mahasiswa->vegetarian = $request->vegetarian;
        if($request->penyakit_khusus != null){
            $mahasiswa->penyakit_khusus = $request->penyakit_khusus;
        }else{
            $mahasiswa->penyakit_khusus = null;
        }
        // $mahasiswa->mahasiswa_baru = $request->mahasiswa_baru;
        
        if(isset($mahasiswa)){
            if($mahasiswa->krm == null){
                $valid = Validator::make($request->all(),
                [
                    'krm' => 'required|mimes:pdf'
                ]);
                if ($valid->fails()) {
                    Session::flash('error', 'Biodata gagal diperbaharui');
                    return redirect()->back()
                    ->withErrors($valid)
                    ->withInput();
                }
                
                if($request->hasFile('krm')){
                    $krm = $request->file('krm');
                    $name = Auth::user()->nim .'_'. time().'.'.$krm->getClientOriginalExtension();
                    $destinationPath = public_path('/krm');
                    $krm->move($destinationPath, $name);

                    $mahasiswa->krm = '/krm/'.$name;
                }
            }else{
                $valid = Validator::make($request->all(),
                [
                    'krm' => 'mimes:pdf'
                ]);
                if ($valid->fails()) {
                    Session::flash('error', 'Biodata gagal diperbaharui');
                    return redirect()->back()
                    ->withErrors($valid)
                    ->withInput();
                }
                
                if($request->hasFile('krm')){
                    $krm = $request->file('krm');
                    $name = Auth::user()->nim .'_'. time().'.'.$krm->getClientOriginalExtension();
                    $destinationPath = public_path('/krm');
                    $krm->move($destinationPath, $name);

                    $mahasiswa->krm = '/krm/'.$name;
                }
            }
            if($mahasiswa->profile == null){
                $valid = Validator::make($request->all(),
                [
                    'profileimage' => 'required|image'
                ]);
                if ($valid->fails()) {
                    Session::flash('error', 'Biodata gagal diperbaharui');
                    return redirect()->back()
                    ->withErrors($valid)
                    ->withInput();
                }

                if ($request->hasFile('profileimage')) {
                    $image = $request->file('profileimage');
                    $name = time().'.'.$image->getClientOriginalExtension();
                    $destinationPath = public_path('/userprofile');
                    $image->move($destinationPath, $name);
                    
                    $mahasiswa->profile = '/userprofile/'.$name;
                }
            }else{
                $valid = Validator::make($request->all(),
                [
                    'profileimage' => 'image'
                ]);
                if ($valid->fails()) {
                    Session::flash('error', 'Biodata gagal diperbaharui');
                    return redirect()->back()
                    ->withErrors($valid)
                    ->withInput();
                }

                if ($request->hasFile('profileimage')) {
                    $image = $request->file('profileimage');
                    $name = time().'.'.$image->getClientOriginalExtension();
                    $destinationPath = public_path('/userprofile');
                    $image->move($destinationPath, $name);
                    
                    $mahasiswa->profile = '/userprofile/'.$name;
                }
            }
            
        }

        if($request->has('check_organisasi')){
            if($request->has('check_prestasi')){
                $checkorpres = 3;
            }else{
                $checkorpres = 1;
            }
        }else{
            if($request->has('check_prestasi')){
                $checkorpres = 2;
            }else{
                $checkorpres = 0;
            }
        }
        $mahasiswa->checkorpres = $checkorpres;
        if(auth::user()->lengkap == 2){
            $mahasiswa->lengkap = "9";
            $mahasiswa->save();
        }
        
        $mahasiswa->save();
        Log::create([
            'mahasiswa_id' => Auth::user()->id,
            'tipe' => 3,
            'konten' => 'Mengubah biodata'
        ]);
        // $mahasiswa->angkatan = $request->angkatan;
        Session::flash('success', 'Biodata berhasil diperbaharui');
        return redirect()->route('beranda-sd.biodata');
    }

    public function resume(){
        if(Auth::user()->lengkap != 8){
            return redirect()->route('beranda-sd.biodata');
        }
        if(Auth::user()->ganti_pass == 0){
            return redirect('/ganti-password')->with('info', 'Password harus diganti terlebih dahulu');
        }
        $now = Carbon::now();
        $checktime = ResumeTime::where('prodi_id', Auth::user()->program_studi)->first();
        if($checktime !== null){
            $convert = Carbon::parse($checktime->berakhir);
            $hasil = $now->gt($convert);
        }else{
            $hasil = null;
        }
        $resumetime = ResumeTime::all();
        $resume = Resume::where('user_id', Auth::user()->id)->get();

        return view('sd.resume', compact('resume', 'resumetime','hasil', 'checktime'));

    }

    public function resumePost(Request $request){
        if(Auth::user()->lengkap != 8){
            return redirect()->route('beranda-sd.biodata');
        }
        $validator = Validator::make($request->all(),[
            'resume' => 'required|mimes:pdf'
        ]);

        if ($validator->fails()) {
            Session::flash('error', 'Gagal Upload Tugas');
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        };

        // cek date time
        $now = Carbon::now();
        $resume = ResumeTime::where('prodi_id', Auth::user()->program_studi)->first();
        $time = Carbon::parse($resume->berakhir);
        $hasil = $now->diff($time);
        if($now->gt($time)){
            return redirect()->back()
                ->withErrors("gagal mengirim, telah melewati batas waktu");
            // dd('x,',$time, $now, $hasil);
        }

        if($request->hasFile('resume')){
            $resume = $request->file('resume');
            $name = Auth::user()->nim .'_'. time().'.'.$resume->getClientOriginalExtension();
            $destinationPath = public_path('/resume');
            $resume->move($destinationPath, $name);

            Resume::create([
                'prodi_id' => Auth::user()->program_studi,
                'user_id' => Auth::user()->id,
                'file' => '/resume/'.$name
            ]);
            Session::flash('success', 'Resume Berhasil di upload');
            return redirect()->back();
        }else{
            Session::flash('failed', 'Resume Gagal di Upload');
            return redirect()->back();
        }
    }

    public function tugas(){
        if(Auth::user()->lengkap != 8){
            return redirect()->route('beranda-sd.biodata');
        }
        $cek = Notes::where([
            'user_id' => Auth::user()->id,
            'tipe' => 'ilmiah'
        ])->orderBy('created_at', 'desc')->get();
        //dd($cek);

        $now = Carbon::now();
        $checktime = ResumeTime::where('prodi_id', Auth::user()->program_studi)->first();
        if($checktime !== null){
            $convert = Carbon::parse($checktime->berakhir);
            $hasil = $now->gt($convert);
        }else{
            $hasil = null;
        }
        $resumetime = ResumeTime::all();
        $resume = Resume::where('user_id', Auth::user()->id)->get();

        return view('sd.penugasan', compact('cek', 'resumetime','hasil', 'checktime'));
    }

    public function penugasanPost(Request $request){
        // dd($request);
        // dd($request);
        $validator = Validator::make($request->all(),[
            'tugas' => 'required|mimes:pdf',
            'tipe' => 'required|string'
        ]);

        if ($validator->fails()) {
            Session::flash('error', 'Gagal Upload Tugas');
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        };

        if($request->hasFile('tugas')){
            $mahasiswa = User::find(Auth::user()->id);
            $tugas = $request->file('tugas');
            $name = Auth::user()->nim .'_'. time().'.'.$tugas->getClientOriginalExtension();
            $destinationPath = public_path('/penugasan/khusus');
            $tugas->move($destinationPath, $name);

            $dbtugas = Penugasan::create([
                'prodi_id' => $mahasiswa->program_studi,
                'user_id' => $mahasiswa->id,
                'file' => '/penugasan/khusus/'.$name,
                'tipe' => $request->tipe
            ]);

            if($dbtugas !== null){
                $mahasiswa = User::find(Auth::user()->id);
                if(isset($mahasiswa)){
                    $mahasiswa->update([
                        'lengkap' => 7
                    ]);
                    return back()->withSuccess('Tugas Berhasil di Upload');
                }else{
                    return back()->withErrors('Gagal Update status mahasiswa');
                }
            }else{
                return back()->withSuccess('Tugas Berhasil di Upload');
            }
        }
    }

    public function penugasanPdfDownload($id){
        $tugas = PenugasanSetting::find($id);

        $file = public_path().$tugas->file;

        $headers = [
            'Content-Type' => 'application/pdf',
        ];

        return response()->download($file, 'soal-'.$tugas->keterangan.'.pdf', $headers);
    }

    public function penugasanSoalPost(Request $request, $id){
        if(Auth::user()->lengkap != 8){
            return redirect()->route('beranda-sd.biodata');
        }
        $validator = Validator::make($request->all(),[
            'tugas' => 'required|mimes:pdf',
            'tipe' => 'required|string'
        ]);

        if ($validator->fails()) {
            Session::flash('error', 'Gagal Upload Tugas');
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        };

        if($request->hasFile('tugas')){
            $mahasiswa = User::find(Auth::user()->id);
            $tugas = $request->file('tugas');
            $name = Auth::user()->nim .'_'. time().'.'.$tugas->getClientOriginalExtension();
            $destinationPath = public_path('/penugasan/soal');
            $tugas->move($destinationPath, $name);

            $dbtugas = Penugasan::create([
                'prodi_id' => $mahasiswa->program_studi,
                'user_id' => $mahasiswa->id,
                'file' => '/penugasan/soal/'.$name,
                'tipe' => $request->tipe,
                'penugasan_id' => $id
            ]);

            if($dbtugas !== null){
                $mahasiswa = User::find(Auth::user()->id);
                if(isset($mahasiswa)){
                    // $mahasiswa->update([
                    //     'lengkap' => 7
                    // ]);
                    return back()->withSuccess('Tugas Berhasil di Upload');
                }else{
                    return back()->withErrors('Gagal Update status mahasiswa');
                }
            }else{
                return back()->withSuccess('Tugas Berhasil di Upload');
            }
        }
        
    }

    public function penugasanEssayPost(Request $request, $id){
        if(Auth::user()->lengkap != 8){
            return redirect()->route('beranda-sd.biodata');
        }
        $validator = Validator::make($request->all(),[
            'tugas' => 'required|mimes:pdf',
            'tipe' => 'required|string'
        ]);

        if ($validator->fails()) {
            Session::flash('error', 'Gagal Upload Tugas');
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        };

        if($request->hasFile('tugas')){
            $mahasiswa = User::find(Auth::user()->id);
            $tugas = $request->file('tugas');
            $name = Auth::user()->nim .'_'. time().'.'.$tugas->getClientOriginalExtension();
            $destinationPath = public_path('/penugasan/essay');
            $tugas->move($destinationPath, $name);

            $dbtugas = Penugasan::create([
                'prodi_id' => $mahasiswa->program_studi,
                'user_id' => $mahasiswa->id,
                'file' => '/penugasan/essay/'.$name,
                'tipe' => $request->tipe,
                'penugasan_id' => $id
            ]);

            if($dbtugas !== null){
                $mahasiswa = User::find(Auth::user()->id);
                if(isset($mahasiswa)){
                    // $mahasiswa->update([
                    //     'lengkap' => 7
                    // ]);
                    return back()->withSuccess('Tugas Berhasil di Upload');
                }else{
                    return back()->withErrors('Gagal Update status mahasiswa');
                }
            }else{
                return back()->withSuccess('Tugas Berhasil di Upload');
            }
        }
        
    }
    
    public function penugasanVerifikasiPost($id, Request $request){
        if(Auth::user()->lengkap != 8){
            return redirect()->route('beranda-sd.biodata');
        }
        // dd($request);
        $validator = Validator::make($request->all(),[
            'berkas' => 'required|mimes:pdf'
        ]);

        if ($validator->fails()) {
            Session::flash('error', 'Gagal Upload Tugas');
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        };

        if($request->hasFile('berkas')){
            // update note
            $note = Notes::find($id);
            
            $tugas = $request->file('berkas');
            $name = Auth::user()->nim .'_'. time().'.'.$tugas->getClientOriginalExtension();
            $destinationPath = public_path('/penugasan/verifikasi');
            $tugas->move($destinationPath, $name);

            $note->tugas = '/penugasan/verifikasi/'.$name;
            $note->save();

            //update status
            
            $tipe = $note->tipe;
            $sisa = Notes::where([
                'tipe' => $tipe,
                'tugas' => null
            ])->get();
            if(count($sisa) === 0){
                $mahasiswa = User::find($note->user_id);
                if(isset($mahasiswa)){
                    $mahasiswa->update([
                        'lengkap' => 7
                    ]);
                    return back()->withSuccess('Tugas Berhasil di Upload');
                }else{
                    return back()->withErrors('Gagal Update status mahasiswa');
                }
            }else{
                return back()->withSuccess('Tugas Berhasil di Upload');
            }
        }
    }

    public function pdfPost($id, Request $request){
        if(Auth::user()->lengkap != 8){
            return redirect()->route('beranda-sd.biodata');
        }
        // dd($request);
        $validator = Validator::make($request->all(),[
            
        ]);

        if ($validator->fails()) {
            Session::flash('error', 'Gagal Upload Tugas');
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        };

       
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

    public function getTimeResume(){
        if(Auth::user()->lengkap != 8){
            return redirect()->route('beranda-sd.biodata');
        }
        $resume = ResumeTime::where('prodi_id', Auth::user()->program_studi)->first();
        return response()->json($resume->berakhir);
    }

    public function perbaikanBiodata($id){
        $mahasiswa = User::findOrFail($id);
        if($mahasiswa->lengkap == 2){
            $mahasiswa->lengkap = 9;
            $mahasiswa->save();

            return back()->withSuccess('Berhasil Mengajukan Perbaikan');
        }else{
            return back()->withErrors('Gagal Mengajukan Perbaikan');
        }
    }

    public function qrcodelink(){
        if(Auth::user()->lengkap != 4){
            return redirect()->route('beranda-sd.biodata');
        }

        $mahasiswa = User::find(Auth::user()->id);
        if($mahasiswa->mahasiswa_baru == 2){
            return redirect('https://line.me/R/ti/g/nsGh5MDCut');
        }else{
            if($mahasiswa->program_studi == 1){
                return redirect('https://line.me/R/ti/g/fvYyls1ooC'); //arsi
            }else if($mahasiswa->program_studi == 2){
                return redirect('https://line.me/R/ti/g/WesXJGEaBc'); //sipil
            }else if($mahasiswa->program_studi == 3){
                return redirect('https://line.me/R/ti/g/VxLBmBw1sN'); //elektro
            }else if($mahasiswa->program_studi == 4){
                return redirect('https://line.me/R/ti/g/_HzUXKQpXk'); //mesin
            }else if($mahasiswa->program_studi == 5){
                return redirect('https://line.me/R/ti/g/-VfkibXIVp'); //ti masih salah
            }else if($mahasiswa->program_studi == 6){
                return redirect('https://line.me/R/ti/g/gqMYsfgYFg'); //lingkungan
            }else if($mahasiswa->program_studi == 7){
                return redirect('https://line.me/R/ti/g/jpnsleyUIX'); //industri
            }
        }
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
}
