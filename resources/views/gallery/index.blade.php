@extends('layouts.layout')

@section('title')
	Galeri
@endsection

@section('content')
    <div class="jumbotron jumbotron-fluid" style="background: #3C3B3F; background: -webkit-linear-gradient(to top, #605C3C, #3C3B3F);  background: linear-gradient(to top, #605C3C, #3C3B3F); height: 70vh;">
        <div class="container" style="margin-top: 40px;">
            <div class="text-center">
                <img class="img-fluid mx-auto" src="{{ asset('/img/ftunud.png') }}" style="max-height:50vh;" alt="">
            </div>
        </div>
    </div>

    <div id="gallery">
        <h1 class="text-center mb-4">Photo Gallery</h1>
        <div class="container">
            <div class="row no-gutters">
                <div class="col-lg-3 col-md-4 col-sm-6 text-center">
                    <div class="gallery-item m-2">
                        <a href="{{ asset('img/smft.jpeg')}}" class="gallery-popup">
                            <img src="{{ asset('img/smft.jpeg')}}" alt="">
                        </a>
                    </div>
                    <h6>Logo Teknik </h6>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 text-center">
                    <div class="gallery-item m-2">
                        <a href="{{ asset('img/smft2.jpeg')}}" class="gallery-popup">
                            <img src="{{ asset('img/smft2.jpeg')}}" alt="">
                        </a>
                    </div>
                    <h6>Hidup Teknik!!!</h6>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 text-center">
                    <div class="gallery-item m-2">
                        <a href="{{ asset('img/first.jpg')}}" class="gallery-popup">
                            <img src="{{ asset('img/first.jpg')}}" alt="">
                        </a>
                    </div>
                    <h6>BKFT 50 </h6>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 text-center">
                    <div class="gallery-item m-2">
                        <a href="{{ asset('img/granat.jpg')}}" class="gallery-popup">
                            <img src="{{ asset('img/granat.jpg')}}" alt="">
                        </a>
                    </div>
                    <h6>GrAnaT "Unstoppable"</h6>
                </div>
            </div>
        </div>
    </div>
    
@endsection

@section('custom_javascript')

@endsection