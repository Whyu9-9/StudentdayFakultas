@extends('layouts.beranda-layout')







@section('active1')



    active



@endsection



@section('content')



<div class="col-12 row mb-4">

    <h2 class="mr-3"><i class="fa fa-home"></i> Beranda</h2>

    @if (Auth::user()->lengkap == 0)

        <div class="alert alert-warning d-inline-flex mb-0">

            <p class="mb-0"><i class="fa fa-bell"></i> Belum Terdaftar Student Day.</p>

        </div>

    @elseif(Auth::user()->lengkap == 1)

        <div class="alert alert-primary">

            <p class="mb-0"><i class="fa fa-dot-circle text-primary"></i> Mengajukan Pendaftaran Student Day.</p>

        </div>

    @elseif(Auth::user()->lengkap == 2)

        <div class="alert alert-danger">

            <p class="mb-0"><i class="fa fa-exclamation-circle text-danger"></i> Terdapat Kesalahan pada Data Biodata</p>

        </div>

    @elseif(Auth::user()->lengkap == 3)

        <div class="alert alert-primary">

            <p class="mb-0"><i class="fa fa-dot-circle text-primary"></i> Mengajukan perbaikan kesalahan Data Pendaftaran</p>

        </div>

    @elseif(Auth::user()->lengkap == 4)
    @if(Auth::user()->mahasiswa_baru<3)
        <div class="alert alert-success">

            <p class="mb-0"><i class="fa fa-check text-success"></i> Pendaftaran Terverifikasi</p>

        </div>
    @else
    <div class="alert alert-warning d-inline-flex mb-0">

        <p class="mb-0"><i class="fa fa-bell"></i> Belum Terdaftar Student Day.</p>

    </div>
    @endif
    @elseif(Auth::user()->lengkap == 5)
    @if(Auth::user()->mahasiswa_baru<3)
        <div class="alert alert-primary">

            <p class="mb-0">

                <i class="fa fa-dot-circle text-warning"></i> Mengajukan Verifikasi Ulang Student Day

            </p>

        </div>
    @else
    <div class="alert alert-primary">

        <p class="mb-0">

            <i class="fa fa-dot-circle text-warning"></i> Mengajukan Pendaftaran Student Day

        </p>

    </div>
    @endif
    @elseif(Auth::user()->lengkap == 6)
    @if(Auth::user()->mahasiswa_baru<3)
        <p class="mb-0">

            <div class="alert alert-danger">

                <p class="mb-0">

                    <i class="fa fa-exclamation-circle text-danger"></i> Terdapat Kesalahan pada Data Verifikasi Ulang

                </p>

            </div>

        </p>
    @else
    <p class="mb-0">

        <div class="alert alert-danger">

            <p class="mb-0">

                <i class="fa fa-exclamation-circle text-danger"></i> Terdapat Kesalahan pada Data Pendaftaran

            </p>

        </div>

    </p>
    @endif
    @elseif(Auth::user()->lengkap == 7)
    @if(Auth::user()->mahasiswa_baru<3)
        <p class="mb-0">

            <div class="alert alert-primary">

                <i class="fa fa-dot-circle text-primary"></i> Mengajukan perbaikan kesalahan Data Verifikasi Ulang

            </div>

        </p>
    @else
    <p class="mb-0">

        <div class="alert alert-primary">

            <i class="fa fa-dot-circle text-primary"></i> Mengajukan perbaikan kesalahan Data Pendaftaran

        </div>

    </p>
    @endif

    @elseif(Auth::user()->lengkap == 8)

        <p class="mb-0">

            <div class="alert alert-success">

                <i class="fa fa-check-double text-success"></i> Terverifikasi

            </div>

        </p>

    @elseif(Auth::user()->lengkap == 9)

        <div class="alert alert-primary py-1 mb-0 mr-2">

            <p class="mb-0"><i class="fa fa-dot-circle text-primary"></i> Mengajukan Perbaikan Biodata</p>

        </div>

    @endif

</div>

@if (Auth::user()->lengkap < 4)
<div class="alert alert-warning">
    <i class="fa fa-exclamation-circle"></i> 
        <strong>Bagi Mahasiswa diharapkan melakukan refresh pada website secara berkala setiap 1 Jam untuk mendapatkan status pendaftaran sesuai tanggal dan waktu registrasi hingga status "Pendaftaran Terverifikasi"</strong> 
    <br>
</div>
@endif

@if (Auth::user()->lengkap >= 4)
<div class="alert alert-warning">
    <i class="fa fa-exclamation-circle"></i> 
        <strong>Bagi Mahasiswa diharapkan melakukan refresh pada website secara berkala setiap 1 Jam untuk mendapatkan status pendaftaran sesuai tanggal dan waktu registrasi hingga status "Terverifikasi"</strong> 
    <br>
</div>
@endif

@if (Auth::user()->lengkap < 4)

<div class="modal fade" id="pengumumannotif" tabindex="-1" aria-labelledby="pengumumannotifLabel" aria-hidden="show">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title" id="pengumumannotifLabel"><i class="fa fa-exclamation"></i> Mohon Diperhatikan</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                  <span aria-hidden="true">&times;</span>

                </button>

            </div>

            <div class="modal-body">

                Bagi Mahasiswa yang sedang mengakses website agar membaca pamflet <strong> "Status Registrasi Pendaftaran Student Day Fakultas Teknik 2020" </strong> dibawah. <br> #HIDUPTEKNIK!!!

                <br>

                <img src="{{asset('/img/notif.png')}}" style="width: 100%">

            </div>

            <div class="modal-footer">

                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

            </div>

        </div>

    </div>

</div>

@endif

@if (Auth::user()->lengkap > 4)
<div class="modal fade" id="pengumumannotif" tabindex="-1" aria-labelledby="pengumumannotifLabel" aria-hidden="show">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="pengumumannotifLabel"><i class="fa fa-exclamation"></i> Mohon Diperhatikan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Bagi Mahasiswa yang sedang mengakses website agar membaca pamflet <strong> "Contoh Atribut dan Kelengkapan Student Day Fakultas Teknik 2020" </strong> dibawah. <br> #HIDUPTEKNIK!!!
                <br><br>
                <img src="{{asset('/img/contoha.png')}}" style="width: 100%">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endif


@if(Auth::user()->lengkap == 4)

    <div class="alert alert-info">

        <i class="fa fa-check text-success"></i> Selamat anda telah terdaftar, silahkan akses QR Code untuk masuk ke dalam group LINE, klik tombol berikut untuk mengakses QR Code <a class="btn btn-info" href="{{ route('beranda-sd-qrcode') }}" >Klik Disini</a>

    </div>

@endif

<div class="card mb-4">



    <div class="card-body">



        <h4><i class="fa fa-bullhorn"></i> Pengumuman</h4>



        @foreach ($data as $pengumuman)



            <div class="card my-4 box-shadow wow fadeInUp" style="border-radius: 0px">



                <div class="card-body">



                    <h5 class="card-title text-body" style="color: #333; font-weight: 500; font-size: 24px; margin-bottom: 20px">{{$pengumuman->judul}}</h5>



                    <div class="media mb-3">



                        <img class="mr-3" src="/thumbnail/{{$pengumuman->gambar}}" height="auto" width="30%" alt="">



                        <div class="media-body">



                            <p class="card-text text-justify">



                                {!! str_limit($pengumuman->konten, 250) !!}



                            </p>



                        </div>



                    </div>



                    <div class="d-flex justify-content-between align-items-center">



                        <a href="{{ route('sd-pengumuman.show', $pengumuman->id) }}" class="btn btn-sm btn-outline-secondary" style="border-radius: 0px">Lihat</a>



                        <small class="text-muted">{{ date('d-m-Y', strtotime($pengumuman->created_at)) }}</small>



                    </div>



                </div>



            </div>    



        @endforeach



    </div>



</div>



@endsection



@section('custom_javascript')

<script>

    $(document).ready(function () {

        $('#pengumumannotif').modal('show');

    }); 

</script>

@endsection