@extends('layouts.beranda-layout')

@section('active6')
    active
@endsection

@section('content')
    <h2 class="mb-4"><i class="fa fa-check-circle"></i> Ubah Link
    </h2>
    @if(Session::has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="text-success fas fa-check mr-1"></i> {{Session::get('success')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
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