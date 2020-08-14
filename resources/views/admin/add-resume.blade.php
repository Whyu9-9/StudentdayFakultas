@extends('layouts.admin-layout')

@section('resume')
    active
@endsection

@section('activeR1')
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

    <h2 class="mb-4"><i class="fa fa-user"></i> Tambah Aturan Resume</h2>
    <div class="card mb-4">
        <div class="card-body">
            <div class="col-md-8">
                <form action="{{ route('admin.resume-setting-post') }}" method="post">
                    {{ csrf_field() }}
                    <table class="table table-borderless">
                        <tbody>
                            <tr>
                                <td><label for="program_studi" data-toggle="tooltip" data-placement="right" title="Wajib diisi" style="cursor:pointer">Program Studi<span class="text-danger">*</label></td>
                                <td>
                                    <select name="program_studi" id="program_studi" class="custom-select" required>
                                        <option selected>- Pilih Program Studi -</option>
                                        @foreach ($program_studi as $prodi)
                                            <option value="{{$prodi->id}}">{{$prodi->nama}}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td><label for="mulai">mulai</label></td>
                                <td>
                                    <input type="datetime-local" class="form-control" name="mulai" id="mulai">
                                </td>
                            </tr>
                            <tr>
                                <td><label for="berakhir">berakhir</label></td>
                                <td>
                                    <input type="datetime-local" class="form-control" name="berakhir" id="berakhir">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <a href="{{ route('admin.resume-setting') }}" class="btn btn-danger"><i class="fa fa-times"></i> Kembali</a>
                    <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Tambah Aturan</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('custom-javascript')

@endsection