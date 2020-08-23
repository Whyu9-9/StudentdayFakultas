@extends('layouts.layout')

@section('title')
	BKM
@endsection

@section('content')
    <div class="jumbotron jumbotron-fluid" style="background: #3C3B3F; background: -webkit-linear-gradient(to top, #605C3C, #3C3B3F);  background: linear-gradient(to top, #605C3C, #3C3B3F); height: 70vh;">
        <div class="container" style="margin-top: 40px;">
            <div class="text-center">
                <img class="img-fluid mx-auto" src="{{ asset('/img/logo_bkm1.png') }}" style="max-height:50vh;" alt="">
            </div>
        </div>
    </div>

    <div class="container">
        <h1 class="text-center mb-4">Tentang BKM</h1>
        <p class="text-justify font-weight-light">
            Kegiatan BKM (Bakti Keakraban Mahasiswa) merupakan suatu kegiatan yang menjadi 
            rangkaian kegiatan penerimaan mahasiswa baru Fakultas Teknik angkatan. 
            BKM dilaksanakan untuk menjalin keakraban mahasiswa, khususnya mahasiswa baru 
            yang belum saling mengenal, baki antara satu angkatan, kakak kelasnya, dan 
            lingkungan perkuliahan yang akan dihadapi kedepannya.
            Mahasiswa baru juga diperkenalkan dengan kegiatan-kegiatan kemahasiswaan beserta 
            organisasi di lingkungan Senat Mahasiswa Fakultas Teknik Universitas Udayana.
        </p>
        <p class="text-justify font-weight-light">
            PKKMB, Student Day dan BKM merupakan rangkaian dari kegiatan penerimaan mahasiswa 
            baru di lingkungan Fakultas Teknik Universitas Udayana. Sebagaimana kegiatan penerimaan 
            mahasiswa baru lainnya, PKKMB, Student Day, dan BKM ini merupakan kegiatan yang 
            wajib diikuti yang nantinya akan mempengaruhi penginputan SKP, syarat yudisium, 
            dan kelulusan mahasiswa.

        </p>
        <h5 style="color: #FF4B2B" class="text-center mt-5">Pendaftaran BKM belum bisa diakses</h5>
    </div>
    <p class="text-center">
        <button id="verify" style="border-radius:22px" class="my-5 btn btn-lg btn-secondary" disabled>Verifikasi Pendaftaran</button>
    </p>
    
@endsection

@section('custom_javascript')

@endsection