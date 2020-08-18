@extends('layouts.beranda-layout')

@section('active6')
    active
@endsection

@section('content')
    <div class="col-12 row mb-4">
        <h2 class="mr-3"><i class="fa fa-check-circle"></i> Verifikasi</h2>
        @if(Auth::user()->lengkap == 5)
            <div class="alert alert-primary">
                <p class="mb-0">
                    <i class="fa fa-dot-circle text-warning"></i> Mengajukan Verifikasi Ulang Student Day
                </p>
            </div>
        @elseif(Auth::user()->lengkap == 6)
            <p class="mb-0">
                <div class="alert alert-danger">
                    <p class="mb-0">
                        <i class="fa fa-exclamation-circle text-danger"></i> Terdapat Kesalahan pada Data Verifikasi Ulang
                    </p>
                </div>
            </p>
        @elseif(Auth::user()->lengkap == 7)
            <p class="mb-0">
                <div class="alert alert-primary">
                    <i class="fa fa-dot-circle text-primary"></i> Mengajukan perbaikan kesalahan Data Verifikasi Ulang
                </div>
            </p>
        @elseif(Auth::user()->lengkap == 8)
            <p class="mb-0">
                <div class="alert alert-success">
                    <i class="fa fa-check-double text-success"></i> Terverifikasi
                </div>
            </p>
        @endif
    </div>

    @if(Session::has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="text-success fas fa-check mr-1"></i> {{Session::get('success')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
            
    @if(Auth::user()->lengkap == 0 || Auth::user()->lengkap == 1 || Auth::user()->lengkap == 2 || Auth::user()->lengkap == 3)
    <div class="alert alert-primary">
        <i class="fa fa-check-circle"></i> 
            Kamu Belum Terdaftar Student Day! Silahkan Mendaftar Terlebih dahulu.
        <br>
    </div>
    @elseif(Auth::user()->lengkap == 4)
    <div class="alert alert-success">
        <i class="fa fa-check-circle"></i> 
            Terdaftar Student Day, Silahkan Verifikasi Ulang!
        <br>
    </div>
    @elseif(Auth::user()->lengkap == 5)
    <div class="alert alert-warning">
        <i class="fa fa-check-circle"></i> 
            Admin Sedang Memvalidasi Data Verifikasi.
        <br>
    </div>
    @elseif(Auth::user()->lengkap == 6)
    <div class="alert alert-danger">
        <?php
            $i = count($notes);
        ?>
        @foreach ($notes as $note)
            <p>
                <i class="fa fa-exclamation-circle"></i> Note dari ADMIN: <strong>{{$note->notes}}</strong>
                <p style="margin-left:18px;">Dikirim Pada: {{date($note->created_at)}}</p>
            </p>
        @endforeach
    </div>
    @elseif(Auth::user()->lengkap == '7')
    <div class="alert alert-warning">
        <i class="fa fa-check-circle"></i> 
            Admin Sedang Memvalidasi Data Verifikasi.
        <br>
    </div>
    @else
    <div class="alert alert-success">
        <i class="fa fa-check-circle"></i> 
            Verifikasi Ulang Berhasil, Silahkan Cetak Berkas Student Day 2020 <a class="btn btn-info" href="{{ route('beranda-sd.cetak-berkas') }}" >Klik Disini</a>
        <br>
    </div>
    @endif
    @if(Auth::user()->lengkap == 6)
    <div class="alert alert-primary">
        <h5>Kamu Mendapatkan Tugas Khusus</h5>
        <p>Tugas Khusus dikirim 1 jam setelah hari-h Student Day berakhir bersamaan dengan tugas-tugas lainnya.
        <br><strong>PESERTA DIHARAPKAN UNTUK MENDOWNLOAD SOAL DAN MENCATAT NOTE YANG DIBERIKAN SEBELUM HILANG DARI HALAMAN INI!</strong></p>
        <?php
            $i = count($ilmiah);
        ?>
        @foreach ($ilmiah as $khusus)
        @if ($khusus->notes_ilmiah != null)
            <p>
                <i class="fa fa-exclamation-circle"></i> Note dari ADMIN: <strong>{{$khusus->notes_ilmiah}}</strong>
                <p style="margin-left:18px;">Dikirim Pada: {{date($note->created_at)}}</p>
            </p>
        @endif
        @endforeach
        <a style="margin-left:18px;" class="btn btn-primary" href="https://drive.google.com/drive/folders/1IV9a69E5z11QD11X8hpw5pIVlol2LBab?usp=sharing">Link Soal Tugas Khusus</a>
    </div>
    @endif
    <div class="card mb-4">
        <div class="card-body">
            @if(Auth::user()->lengkap == 0 || Auth::user()->lengkap == 1 || Auth::user()->lengkap == 2 || Auth::user()->lengkap == 3)
            <div class="alert alert-warning">
                <i class="fa fa-exclamation-circle"></i> Biodata Anda belum lengkap. Lengkapi biodata untuk dapat verifikasi ulang. <br>
                <a href="/beranda-sd/{{ Auth::user()->id }}/edit" class="btn btn-primary mt-3"><i class="fa fa-edit"></i> Lengkapi biodata</a>
            </div>
            @elseif(Auth::user()->lengkap == 4)
            <form action="{{ route('beranda-sd.verifikasi-post', ['id'=>Auth::user()->id]) }}" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-8 px-5">
                        {{ csrf_field() }}
                        @if(Auth::user()->penyakit_khusus != null)
                        <label for="riwayat"><strong>Riwayat Penyakit</strong></label>
                        <div class="mb-3">
                            <div class="input-group">
                                <input type="text" class="form-control" id="riwayat" name="riwayat" value="{{Auth::user()->penyakit_khusus}}" readonly>
                            </div>
                            @if($errors->has('riwayat'))
                                <span class="text-danger mx-2" role="alert">
                                    <strong>{{ $errors->first('riwayat') }}</strong>
                                </span> 
                            @endif
                        </div>

                        <label for="scan-riwayat"><strong>Scan Bukti Riwayat Penyakit</strong></label>
                        <small class="">*format pdf.</small>
                        <div class="mb-3">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="scan-riwayat" name="scan-riwayat">
                                <label id="label-scan-riwayat" class="custom-file-label" for="scan-riwayat">Choose file</label>
                            </div>
                            @if($errors->has('scan-riwayat'))
                                <span class="text-danger mx-2" role="alert">
                                    <strong>{{ $errors->first('scan-riwayat') }}</strong>
                                </span> 
                            @endif
                        </div>
                        @endif
                        <label for="basic-url"><strong>Youtube URL</strong></label>
                        <div class="mb-3">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="span-url">https://youtu.be/</span>
                                </div>
                                <input type="text" class="form-control" id="url" name="url" aria-describedby="span-url">
                            </div>
                            @if($errors->has('url'))
                                <span class="text-danger mx-2" role="alert">
                                    <strong>{{ $errors->first('url') }}</strong>
                                </span> 
                            @endif
                        </div>
                        
                        @if (Auth::user()->mahasiswa_baru == 2)
                            <label for="bukti-pembayaran"><strong>Bukti Pembayaran</strong></label>
                            <small class="">*format pdf.</small>
                            <div class="mb-3">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input berkas" id="bukti-pembayaran" name="bukti-pembayaran">
                                    <label id="label-bukti-pembayaran" class="custom-file-label" for="bukti-pembayaran">Choose file</label>
                                </div>
                                @if($errors->has('bukti-pembayaran'))
                                    <span class="text-danger mx-2" role="alert">
                                        <strong>{{ $errors->first('bukti-pembayaran') }}</strong>
                                    </span> 
                                @endif
                            </div>
                        @endif
                        
                    </div>
                    <div class="col-md-4 px-5 border-left">
                        <label for="basic-url"><strong>Profile Picture</strong></label>
                        <div class="mb-3">
                            <img id="show-profileimage" class="float-left my-3" src="{{$data->profile != null ? asset('/public'.$data->profile) : '/img/foto3x4.jpg'}}" style="border-style:solid; height: 200px; width: 150px;" alt="not found">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="profileimage" name="profileimage">
                                <label id="label-profileimage" class="custom-file-label" for="profileimage">Choose file</label>
                                <br>
                        <small>* Upload foto dengan ketentuan menggunakan kemeja putih polos</small>
                            </div>
                            @if($errors->has('profileimage'))
                                <span class="text-danger mx-2" role="alert">
                                    <strong>{{ $errors->first('profileimage') }}</strong>
                                </span> 
                            @endif
                        </div>
                    </div>
                </div>        
                <div class="col-12 text-center mt-3">
                    <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Verifikasi Ulang</button>
                </div>
            </form>
            @elseif(Auth::user()->lengkap == 5 || Auth::user()->lengkap == 6 || Auth::user()->lengkap == 7 || Auth::user()->lengkap == 8)
            <div class="row">
                <div class="col-md-8 px-5">
                    @if(Auth::user()->penyakit_khusus != null)
                    <label for="riwayat"><strong>Riwayat Penyakit</strong></label>
                    <div class="mb-3">
                        <div class="input-group">
                            <input type="text" class="form-control" id="riwayat" name="riwayat" value="{{Auth::user()->penyakit_khusus}}" readonly>
                        </div>
                    </div>
                    
                    <label for="scan-riwayat"><strong>Scan Bukti Riwayat Penyakit</strong></label>
                    <div class="mb-3">
                        @if(Auth::user()->scan_penyakit == null)
                        -
                        @else
                        <a href="/beranda-sd-verifikasi-scan-download/{{Auth::user()->id}}">Download</a>
                        @endif
                    </div>
                    @endif
                    <label for="basic-url"><strong>Youtube URL</strong></label>
                    <div class="mb-3">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                {{-- <span class="input-group-text" id="span-url">{{Auth::user()->youtube}}</span> --}}
                                <a>{{Auth::user()->youtube}}</a>
                            </div>
                        </div>
                    </div>
                    @if (Auth::user()->mahasiswa_baru == 2)
                    <label for="basic-url"><strong>Bukti Pembayaran</strong></label>
                    <div class="mb-3">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                {{-- <span class="input-group-text" id="span-url">{{Auth::user()->youtube}}</span> --}}
                                <a href="/beranda-sd-verifikasi-scan-download/pembayaran/{{Auth::user()->id}}">Download</a>
                            </div>
                        </div>
                    </div>
                    @endif
                    @if(Auth::user()->lengkap == 6)
                    <a href="/beranda-sd/verifikasi/edit/{{ Auth::user()->id }}" class="btn btn-secondary"><i class="fa fa-edit"></i> Ubah Data Verifikasi</a>
                    @endif
                </div>
                <div class="col-md-4 px-5 border-left">
                    <label for="basic-url"><strong>Profile Picture</strong></label>
                    <div class="mb-3">
                        <img id="show-profileimage" class="float-left my-3" src="{{Auth::user()->profile != null ?  asset('/public'.Auth::user()->profile) : '/img/foto3x4.jpg'}}" style="border-style:solid;height: 200px; width: 150px;" alt="not found">
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
@endsection

@section('custom_javascript')
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#show-profileimage').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#profileimage").change(function() {
            var filename = this.files[0].name;
            readURL(this);
            $('#label-profileimage').html(filename);
        });

        $("#scan-riwayat").change(function(){
            var name = this.files[0].name;
            $("#label-scan-riwayat").html(name);
        });

        $(".berkas").change(function() {
            var name = this.files[0].name;
            var label = this.nextElementSibling;
            label.textContent = name;
        });
    </script>
@endsection