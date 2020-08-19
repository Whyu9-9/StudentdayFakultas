<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use Response;
use App\PembelianBaju;
use App\Iklans;
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
        return 0;
        $id = Auth::user()->id;
        $check = PembelianBaju::where('user_id', $id)->get();
        if(count($check) > 0){
            return 1;
        }else{
            return 0;
        }
    }
}
