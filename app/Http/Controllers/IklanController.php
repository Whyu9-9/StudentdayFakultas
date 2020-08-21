<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use Response;
use Validator;
use App\PembelianBaju;
use App\Iklans;
use App\UserIklans;
use App\ProgramStudi;
use Excel;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class IklanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $iklans = Iklans::all();
        return view('admin.iklan', compact('iklans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.add-iklan');
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
        $messages = [
            'required' => 'Kolom :attribute Wajib Diisi!',
    		];

    		$this->validate($request, [
  			     'judul' => 'required|string',
             'konten' => 'required|string',
        ],$messages);

        $iklan = new Iklans;
        $iklan->judul = $request->judul;
        $iklan->keterangan = $request->konten;
        if($request->hasFile('gambar')){
        		$thumbnail = $request->file('gambar');
        		$fileName = time().'-'.$request->judul. '.' .$thumbnail->getClientOriginalExtension();
            $destinationPath = public_path('/iklan');
            $thumbnail->move($destinationPath, $fileName);
        		$iklan->image = '/iklan/'.$fileName;
        }
        $iklan->save();
        return back()->withSuccess('Iklan Berhasil ditambahkan');
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $iklans = Iklans::find($id);
        $iklans->delete();

        return back()->withSuccess('Berhasil Hapus Iklan');
    }

    public function getPembelianBaju(){
        $id = Auth::user()->id;
        $dies = PembelianBaju::where('user_id', $id)->where('kegiatan', 'dies')->first();
        $granat = PembelianBaju::where('user_id', $id)->where('kegiatan', 'granat')->first();
        $bursa = PembelianBaju::where('user_id', $id)->where('kegiatan', 'bursa')->first();
        if(isset($granat)){
            return 1;
        }else{
            return 0;
        }
    }

    public function addPembeli(Request $request){
        $validator = Validator::make($request->all(),
            [
                 'nama' => 'required|string',
                 'telepon' => 'required|numeric',
                 'nim' => 'required|numeric',
                 'tipe' => 'required|string'
            ]);

        if ($validator->fails()) {
            return back()
            ->with('failedIklan','Gagal Melakukan Pembelian!');
        }

        $id = Auth::user()->id;
        $beli = new PembelianBaju();
        $beli->user_id = $id;
        $beli->nama = $request->nama;
        $beli->nim = $request->nim;
        $beli->telp = $request->telepon;
        $beli->kegiatan = $request->tipe;
        $beli->save();

        return back()->with('successIklan','Berhasil Menambahkan Pembelian');
    }
    public function granatIndex(Request $req)
    {
        $filter = [];
        $prodis = ProgramStudi::all();
        $granat = PembelianBaju::select('*', 'users.program_studi', 'users.nama as namamhs', 'program_studis.nama as prodi_name')
                  ->join('users', 'users.id', '=', 'user_id')
                  ->join('program_studis', 'program_studis.id', '=', 'users.program_studi')
                  ->where('pembelian_baju.kegiatan', 'granat');

        if($req->has('prodi')){
            foreach($prodis as $prodi){
                if($prodi->id == $req->prodi){
                    $granat->where('program_studi', $req->prodi);
                    $filter['prodi'] = $req->prodi;
                    break;
                }
            }
        }
        $granat = $granat->get();
        return view('admin.buyer-granat', compact('granat', 'filter', 'prodis'));
    }

    public function exportExcelgranat(Request $req) {

        // $data = PembelianBaju::where('kegiatan','granat');
        $prodis = ProgramStudi::all();
        $data = PembelianBaju::select('*', 'users.program_studi','users.nama as namamhs', 'program_studis.nama as prodi_name')
                  ->join('users', 'users.id', '=', 'user_id')
                  ->join('program_studis', 'program_studis.id', '=', 'users.program_studi')
                  ->where('pembelian_baju.kegiatan', 'granat');

        if($req->has('prodi')){
            foreach($prodis as $prodi){
                if($prodi->id == $req->prodi){
                    $data->where('program_studi', $req->prodi);
                    break;
                }
            }
        }
        $data = $data->get();

        // Initialize the array which will be passed into the Excel
        // generator.
        $mahasiswa = [];

        // Define the Excel spreadsheet headers
        $mahasiswa[] = [
            'Nama',
            'NIM',
            'Prodi',
            'No Telp'
        ];


        // Convert each member of the returned collection into an array,
        // and append it to the payments array.
        foreach ($data as $row) {
            $mahasiswa[] = [
                $row->namamhs,
                $row->nim,
                $row->prodi_name,
                $row->telp
            ];
        }

        // Generate and return the spreadsheet
        Excel::create('Rekap Granat', function($excel) use ($mahasiswa) {

            // Set the spreadsheet title, creator, and description
            $excel->setTitle('Granat 2020 via Website');

            // Build the spreadsheet, passing in the payments array
            $excel->sheet('sheet1', function($sheet) use ($mahasiswa) {
                $sheet->fromArray($mahasiswa, null, 'A1', false, false);
            });

        })->download('xlsx');
    }
}
