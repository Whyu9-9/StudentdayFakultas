@extends('layouts.admin-layout')

@section('activeIklan')
    active
@endsection

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            @foreach ($errors->all() as $error)
                    <i class="text-danger fas fa-exclamation-circle mr-1"></i> {{ $error }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            @endforeach
        </div>
    @elseif (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="text-success fas fa-check mr-1"></i> {{session('success')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <h2 class="mb-4"><i class="fa fa-user"></i> Tambah Iklan</h2>
    <div class="card mb-4">
        <div class="card-body">
            <div class="col-md-12">
                <form action="{{ route('admin-iklan-post') }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <table class="table table-borderless">
                        <tbody>
                            <tr>
                                <td><label for="judul">Judul</label></td>
                                <td>
                                    <textarea type="text" class="form-control" name="judul" id="judul" rows="1" placeholder="Judul"></textarea>
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
                    <a href="{{ route('admin-iklan') }}" class="btn btn-danger"><i class="fa fa-times"></i> Kembali</a>
                    <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Tambah Iklan</button>
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
