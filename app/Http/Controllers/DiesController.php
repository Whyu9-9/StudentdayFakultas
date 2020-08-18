<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class DiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dies.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function download()
    {
        $file= public_path()."/berkas/form_kehadiran_dies_2020.docx";
        // $headers = array(
        //       'Content-Type: application/pdf',
        //     );

        return Response::download($file);
    }

    
}
