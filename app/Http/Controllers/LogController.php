<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class LogController extends Controller
{
	public function __construct(){
		$this->middleware('admin');
	}

    public function show($id){
    	$mahasiswa = User::with('logs')->findOrFail($id);
    	return view('admin.log', compact('mahasiswa'));
    }
}
