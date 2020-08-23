<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Penugasan;
use App\PenugasanSetting;
use Validator;
use Session;

class PenugasanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){
		$this->middleware('admin');
    }

    public function index()
    {
        //
    }

    public function setting(){
        $penugasansetting = PenugasanSetting::all();
        return view('admin.penugasan-setting', compact('penugasansetting'));
    }

    public function settingAdd(){
        return view('admin.penugasan-add');
    }

    public function settingPost(Request $request){
        $validator = Validator::make($request->all(),
            [
                'keterangan' => 'required|string',
                'tugas' => 'string',
                'tipe' => 'required|string',
            ]
        );

        if ($validator->fails()) {
            Session::flash('error', 'Tugas gagal ditambahkan');
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $tugas = new PenugasanSetting;
        $tugas->keterangan = $request->keterangan;
        $tugas->tipe = $request->tipe;
        $tugas->file = $request->link;
        $tugas->save();
        Session::flash('success', 'Tugas berhasil ditambahkan');
        return redirect()->route('penugasan.setting');
    }

    public function settingDelete($id){
        $tugas = PenugasanSetting::find($id);
        $tugas->delete();
        Session::flash('success', 'Tugas berhasil dihapus');
        return redirect()->route('penugasan.setting');
    }


    public function settingDownload($id){
        $tugas = PenugasanSetting::find($id);
        $file=public_path().$tugas->file;
        $headers = array(
            'Content-Type: application/pdf',
        );

        return Response::download($file, 'tugas.pdf', $headers);
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
    public function show($id)
    {
        //
        $penugasan = Penugasan::where('user_id', $id)->get();
        $mahasiswa = User::find($id);
        return view('admin.penugasan', compact('penugasan', 'mahasiswa'));
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
    }

    public function getPdf($id){
        $tugas = Penugasan::find($id);
        $mahasiswa = User::find($tugas->user_id);

        $file= public_path(). $tugas->file;

        $headers = [
            'Content-Type' => 'application/pdf',
         ];

        return response()->download($file, 'tugas-'.$tugas->tipe.'-'.$mahasiswa->nim.'.pdf', $headers);
    }
}
