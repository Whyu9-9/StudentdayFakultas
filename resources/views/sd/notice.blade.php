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
            <h2 class="text-center" style="color: #333; font-weight: 700; font-size: 32px;">Pengumuman</h2>
            @if (count($data))
                @foreach ($data as $pengumuman)
                    <div class="row justify-content-center">
                        <div class="col-md-10">
                            <div class="card mb-4 box-shadow wow fadeInUp" style="border-radius: 0px">
                                <div class="card-body">
                                    <h5 class="card-title text-body" style="color: #333; font-weight: 500; font-size: 24px; margin-bottom: 20px">{{ $pengumuman->judul }}</h5>
                                    <div class="media mb-3">
                                        <img class="mr-3" src="/thumbnail/{{ $pengumuman->gambar }}" height="auto" width="30%" alt="">
                                        <div class="media-body">
                                            <p class="card-text text-justify">
                                                {!! str_limit($pengumuman->konten, 200) !!}
                                            </p>
                                        </div>
                                    </div>
                                    
                                    
                                    <div class="d-flex justify-content-between align-items-center">
                                        <a href="{{ route('sd-pengumuman.show', $pengumuman->id) }}" class="btn btn-sm btn-outline-secondary" style="border-radius: 0px">Lihat</a>
                                        <small class="text-muted">{{ date('d-m-Y', strtotime($pengumuman->created_at)) }}</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="card mb-4 box-shadow wow fadeInUp" style="border-radius:0px">
                    <div class="card-body">
                        <center>Tidak ada pengumuman</center>
                    </div>
                </div>
            @endif
            {!! $data->render() !!}
        </div>
    </div>
@endsection

@section('custom_javascript')

@endsection