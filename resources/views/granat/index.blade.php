@extends('layouts.layout')

@section('title')
	GrAnaT
@endsection

@section('content')
    <div class="jumbotron jumbotron-fluid" style="background: #3C3B3F; background: -webkit-linear-gradient(to top, #605C3C, #3C3B3F);  background: linear-gradient(to top, #c3a72f, #222); height: 70vh;">
        <div class="container" style="margin-top: 40px;">
            <div class="text-center">
                <img class="img-fluid mx-auto" src="{{ asset('/img/granat.png') }}" style="max-height:50vh;" alt="">
            </div>
        </div>
    </div>

    <div class="container" style="padding:80px 0 80px 0;">
        <h1 class="text-center mb-4">Tentang GrAnaT</h1>
        <p class="text-justify">
            GrAnaT merupakan suatu event musik yang menampilkan band-band Bali dengan aliran musik Underground 
            yang telah diseleksi melalui dua tahapan penilaian, yaitu Audisi CD dan GrAnaT  Tour and Audition. 
            Band-band yang lolos audisi akan ditampilkan kembali pada acara main event. 
        </p>
        <p class="text-justify">
            Setelah didapat band yang lolos dalam audisi CD kemudian dilanjutkan dengan GrAnaT  Next Tour and Audition 
            yang dapat disaksikan langsung oleh penonton. Audisi ini dilaksanakan dengan tujuan untuk mencari bakat band 
            audisi GrAnaT dengan penjurian live performance dan merupakan perkenalan awal event GrAnaT  kepada masyarakat umum.
        </p>
        <p class="text-center">
            <a class="btn btn-lg" target="_blank" href="https://www.granatsmft.com/" style="color:#FFF; background-color:#c3a72f">Website Granat</a>
        </p>
    </div>
    
    
@endsection

@section('footer')
    <footer>
        <div class="footer-container">
            <p class="text-center m-0 pt-3">
                &#169; SMFT @1963-2018
                {{-- <span class="float-right"><a href="#">Ke atas</a></span> --}}
            </p>
        </div>
    </footer>
@endsection

@section('custom_javascript')

@endsection