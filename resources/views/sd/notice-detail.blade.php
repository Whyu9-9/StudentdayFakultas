@extends('layouts.layout')

@section('title')
	Pengumuman
@endsection

@section('content')
    <div class="jumbotron jumbotron-fluid" style="background: #3C3B3F; background: -webkit-linear-gradient(to top, #605C3C, #3C3B3F);  background: linear-gradient(to top, #605C3C, #3C3B3F); height: 50vh;">
        <div class="container" style="margin-top: 40px;">
            <div class="text-center">
                <img class="img-fluid mx-auto" src="{{ asset('/img/logo-sd-2020.png') }}" style="max-height:30vh;" alt="">
            </div>
        </div>
    </div>

    <div class="container">
        <div id="main" style="padding: 80px 0">
            <h1 class="text-center" style="color: #333; font-weight: 700; font-size: 32px; padding-bottom: 80px">{{ $data->judul }}</h1>
            
            @if ($data->gambar != null)
                <div class="text-center">
                    <img src="/thumbnail/{{ $data->gambar }}" height="auto" width="80%" alt="">
                </div>
            @endif
            
            <div class="text-justify mt-5 mb-5" id="konten">
                {!! $data->konten !!}
            </div>
            @if($data->gambar == "1539088784.jpg")
                <div>
                    <a target="_blank" href="https://drive.google.com/drive/folders/1leSITLuOLFgAk_dOX3wjzS4rG0WrNCUW?usp=sharing">Download Nilai Student day 2018</a> 
                </div>
            @endif
        </div>
    </div>
@endsection