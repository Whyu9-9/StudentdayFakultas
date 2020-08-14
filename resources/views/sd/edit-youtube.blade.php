@extends('layouts.beranda-layout')

@section('active6')
    active
@endsection

@section('content')
    <h2 class="mb-4"><i class="fa fa-check-circle"></i> Verifikasi
    </h2>
    @if(Session::has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="text-success fas fa-check mr-1"></i> {{Session::get('success')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    
    
            
    @if(Auth::user()->lengkap === 0 || Auth::user()->lengkap === 1 || Auth::user()->lengkap === 2 || Auth::user()->lengkap === 3)
    <div class="alert alert-primary">
        <i class="fa fa-check-circle"></i> 
            Kamu Belum Terdaftar Student Day! Silahkan Mendaftar Terlebih dahulu.
        <br>
    </div>
    @elseif(Auth::user()->lengkap === 4)
    <div class="alert alert-success">
        <i class="fa fa-check-circle"></i> 
            Terdaftar Student Day, Silahkan Verifikasi Ulang!
        <br>
    </div>
    @elseif(Auth::user()->lengkap === 5)
    <div class="alert alert-warning">
        <i class="fa fa-check-circle"></i> 
            Admin Sedang Memvalidasi Data Verifikasi.
        <br>
    </div>
    @elseif(Auth::user()->lengkap === 6)
    <div class="alert alert-danger">
        <i class="fa fa-check-circle"></i> 
        Terdapat kesalahan pada data verifikasi ulang.<br>
                    
        @if($errors->has('berkas'))
            <span class="text-danger" role="alert">
                <strong>{{ $errors->first('berkas') }}</strong>
            </span> 
        @endif
        <ul>
            <?php
                $i = count($notes);
            ?>
            @foreach ($notes as $note)
                <li>{{date($note->created_at)}} - {{$note->notes}}</li>
                @if($note->tugas !== null)
                <div class="mb-3">
                    <a href="{{ route('get-penugasan', ['id'=>$note->id]) }}">Berkas berhasil diupload</a>
                </div>    
                @else
                    <form action="{{ route('post-penugasan-verifikasi', ['id'=>$note->id]) }}" method="post" class="mb-3" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-10 px-0">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input berkas" name="berkas">
                                    <label id="label-berkas" class="custom-file-label" for="berkas">Choose file</label>
                                </div>
                            </div>
                            <div class="col-2 py-0">
                                <button class="btn btn-primary">Upload</button>
                            </div>
                        </div>
                    </form>
                @endif
            @endforeach
        </ul>
        <br>
    </div>
    @elseif(Auth::user()->lengkap === '7')
    <div class="alert alert-warning">
        <i class="fa fa-check-circle"></i> 
            Admin Sedang Memvalidasi Data Verifikasi.
        <br>
    </div>
    @else
    <div class="alert alert-success">
        <i class="fa fa-check-circle"></i> 
            Verifikasi Ulang Berhasil, Silahkan Cetak Berkas Student Day 2020.
        <br>
    </div>
    @endif
    <div class="card mb-4">
        <div class="col-6 mt-2">
            <label for="basic-url"><strong>Youtube URL</strong></label>
            <div class="mb-3">
                <form action="{{ route('beranda-sd.verifikasi-youtube-post', ['id'=>Auth::user()->id]) }}" method="post">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="span-url">https://youtu.be/</span>
                        </div>
                        <input type="text" class="form-control" id="url" name="url" aria-describedby="span-url">
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-primary ml-3">Simpan</button>
                    </div>
                </form>
                @if($errors->has('url'))
                    <span class="text-danger mx-2" role="alert">
                        <strong>{{ $errors->first('url') }}</strong>
                    </span> 
                @endif
            </div>
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