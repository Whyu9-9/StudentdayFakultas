@extends('layouts.admin-layout')

@section('active3')
    active
@endsection

@section('content')
    <h2 class="mb-4"><i class="fa fa-bell"></i> Edit Pengumuman</h2>
    <div class="card mb-4">
        <div class="card-body">
            <div class="col-md-12">
                <form action="{{ route('admin.sd-pengumuman-update', $data->id) }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <table class="table table-borderless">
                        <tbody>
                            <input type="hidden" name="id" value="{{ $data->id }}">
                            <tr>
                                <td><label for="judul">Judul</label></td>
                                <td>
                                    <textarea type="text" class="form-control" name="judul" id="nim" rows="1" placeholder="Judul">{{ $data->judul }}</textarea>
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
                                    <textarea class="form-control" name="konten" id="konten" rows="10" placeholder="Konten">{{ $data->konten }}</textarea>
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
                    <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan perubahan</button>
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