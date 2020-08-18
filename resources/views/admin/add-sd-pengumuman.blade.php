@extends('layouts.admin-layout')

@section('active3')
    active
@endsection

@section('content')
    <h2 class="mb-4"><i class="fa fa-bell"></i> Tambah Pengumuman</h2>  
    <div class="card mb-4">
        <div class="card-body">
            <div class="col-md-12">
                <form action="{{ route('admin.sd-pengumuman-store') }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <table class="table table-borderless">
                        <tbody>
                            <tr>
                                <td><label for="judul">Judul</label></td>
                                <td>
                                    <textarea type="text" class="form-control" name="judul" id="nim" rows="1" placeholder="Judul"></textarea>
                                    @if($errors->has('judul'))
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $errors->first('judul') }}</strong>
                                        </span> 
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td><label for="konten">Konten</label></td>
                                <td>
                                    <textarea class="form-control" name="konten" id="konten" rows="10" placeholder="Konten"></textarea>
                                    @if($errors->has('konten'))
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $errors->first('konten') }}</strong>
                                        </span> 
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td><label for="gambar">Gambar</label></td>
                                <td><input type="file" name="gambar" id="gambar"></td>
                            </tr>
                        </tbody>
                        
                    </table>
                    <a href="{{ route('admin.sd-pengumuman') }}" class="btn btn-danger"><i class="fa fa-times"></i> Batal</a>
                    <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Tambah Pengumuman</button>
                </form>
            </div>
        </div>
    </div>

    
@endsection

@section('custom_javascript')
<script src="{{asset('/js/ckeditor/ckeditor.js')}}"></script>
    <script>
        $(function () {
            CKEDITOR.replace('konten')
        })
    </script>
@endsection