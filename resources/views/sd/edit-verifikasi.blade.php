@extends('layouts.beranda-layout')

@section('active6')
    active
@endsection

@section('content')
    <div class="col-12 row mb-4">
        <h2 class="mr-3"><i class="fa fa-check-circle"></i> Verifikasi</h2>
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
    @endif
    <div class="card mb-4">
        <div class="card-body">
            <form action="{{ route('beranda-sd.verifikasi-post', ['id'=>Auth::user()->id]) }}" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-8 px-5">
                        {{ csrf_field() }}
                        @if(Auth::user()->penyakit_khusus != null)
                        <label for="riwayat"><strong>Riwayat Penyakit</strong></label>
                        <br>
                        <small class="">Jika ada kesalahan, Segera ubah. Jika tidak, langsung klik tombol "Ajukan Verifikasi Ulang"</small>
                        <div class="mb-3">
                            <div class="input-group">
                                <input type="text" class="form-control" id="riwayat" name="riwayat" value="{{Auth::user()->penyakit_khusus}}" readonly>
                            </div>
                            <small class="">* tambahkan bila ada.</small>
                            @if($errors->has('riwayat'))
                                <span class="text-danger mx-2" role="alert">
                                    <strong>{{ $errors->first('riwayat') }}</strong>
                                </span> 
                            @endif
                        </div>

                        <label for="scan-riwayat"><strong>Scan Bukti Riwayat Penyakit</strong></label>
                        <br>
                        <small class="">Jika ada kesalahan, Segera ubah. Jika tidak, langsung klik tombol "Ajukan Verifikasi Ulang"</small>
                        <br>
                        <small class="">*format pdf.</small>
                        <div class="mb-3">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="scan-riwayat" name="scan-riwayat">
                                <label id="label-scan-riwayat" class="custom-file-label" for="scan-riwayat">Choose file</label>
                                <a href="/beranda-sd-verifikasi-scan-download/{{Auth::user()->id}}">Download</a>
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
                                {{-- <span class="input-group-text" id="span-url">{{Auth::user()->youtube}}</span> --}}
                                <a>{{Auth::user()->youtube}}</a>
                                <a style="margin-left:5px;" class="btn btn-info btn-sm" href="{{ route('beranda-sd.verifikasi-youtube', ['id'=>Auth::user()->id]) }}" class="ml-2"><i class="fa fa-edit"></i> Edit</a>
                            </div>
                        </div>
                    </div>
                        @if (Auth::user()->mahasiswa_baru == 2)
                            <label for="bukti-pembayaran"><strong>Bukti Pembayaran</strong></label>
                            <br>
                            <small class="">Jika ada kesalahan, Segera ubah. Jika tidak, langsung klik tombol "Ajukan Verifikasi Ulang"</small>
                            <br>
                            <small class="">*format pdf.</small>
                            <div class="mb-3">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input berkas" id="bukti-pembayaran" name="bukti-pembayaran">
                                    <label id="label-bukti-pembayaran" class="custom-file-label" for="bukti-pembayaran">Choose file</label>
                                    <a href="/beranda-sd-verifikasi-scan-download/pembayaran/{{Auth::user()->id}}">Download</a>
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
                        <br>
                        <small class="">Jika ada kesalahan, Segera ubah. Jika tidak, langsung klik tombol "Ajukan Verifikasi Ulang"</small>
                        <div class="mb-3">
                            <img id="show-profileimage" class="float-left my-3" src="{{Auth::user()->profile != null ?  asset('/public'.Auth::user()->profile) : '/img/foto3x4.jpg'}}" style="border-style:solid; height: 200px; width: 150px;" alt="not found">
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
                    <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Ajukan Verifikasi Ulang</button>
                </div>
            </form>
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