<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use Response;
use Validator;
use App\PembelianBaju;
use App\Iklans;
use App\UserIklans;
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
        if(isset($dies) && isset($granat) && isset($granat)){
            return 1;
        }else if(isset($dies) && !isset($granat) && isset($bursa)){
            return 2;
        }else if(!isset($dies) && isset($granat) && isset($bursa)){
            return 3;
        }else if(isset($dies) && isset($granat) && !isset($bursa)){
            return 4;
        }else{
            return 0;
        }
    }

    public function addPembeli(Request $request){
        $validator = Validator::make($request->all(),
            [
                 'nama' => 'required|string',
                 'telepon' => 'required|numeric',
                 'keterangan' => 'required|string',
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
        $beli->telp = $request->telepon;
        $beli->ukuran = $request->keterangan;
        $beli->kegiatan = $request->tipe;
        $beli->save();

        return back()->with('successIklan','Berhasil Menambahkan Pembelian');
    }
    public function granatIndex()
    {
        $granat = PembelianBaju::where('kegiatan', 'granat')->get();
        return view('admin.buyer-granat', compact('granat'));
    }

    public function exportExcelgranat() {

        $data = PembelianBaju::where('kegiatan','granat');
        $data = $data->get();

        // Initialize the array which will be passed into the Excel
        // generator.
        $mahasiswa = [];

        // Define the Excel spreadsheet headers
        $mahasiswa[] = [
            'Nama',
            'No Telp',
            'Ukuran Baju'
        ];


        // Convert each member of the returned collection into an array,
        // and append it to the payments array.
        foreach ($data as $row) {
            $mahasiswa[] = [
                $row->nama,
                $row->telp,
                $row->ukuran
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

    public function bursaIndex()
    {
        $bursa = PembelianBaju::where('kegiatan', 'bursa')->get();
        return view('admin.buyer-bursa', compact('bursa'));
    }

    public function exportExcelbursa() {

        $data = PembelianBaju::where('kegiatan','bursa');
        $data = $data->get();

        // Initialize the array which will be passed into the Excel
        // generator.
        $mahasiswa = [];

        // Define the Excel spreadsheet headers
        $mahasiswa[] = [
            'Nama',
            'No Telp',
            'Keterangan'
        ];


        // Convert each member of the returned collection into an array,
        // and append it to the payments array.
        foreach ($data as $row) {
            $mahasiswa[] = [
                $row->nama,
                $row->telp,
                $row->ukuran
            ];
        }

        // Generate and return the spreadsheet
        Excel::create('Rekap Bursa', function($excel) use ($mahasiswa) {

            // Set the spreadsheet title, creator, and description
            $excel->setTitle('Bursa 2020 via Website');

            // Build the spreadsheet, passing in the payments array
            $excel->sheet('sheet1', function($sheet) use ($mahasiswa) {
                $sheet->fromArray($mahasiswa, null, 'A1', false, false);
            });

        })->download('xlsx');
    }
}
