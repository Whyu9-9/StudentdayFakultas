@extends('layouts.admin-layout')

@section('resume')
    active
@endsection

@section('activeR1')
    active
@endsection

@section('content')
    <h2 class="mb-4"><i class="fa fa-user"></i> Resume Setting</h2>
    @if(Session::has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="text-success fas fa-check mr-1"></i> {{Session::get('success')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <div class="card mb-4">
        <div class="card-body">
            <a href="{{ route('admin.resume-setting-create') }}" class="btn btn-primary mb-3"><i class="fa fa-plus-circle mr-1"></i>Tambah Aturan</a>
            <div class="table-responsive">
                <table id="table" class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Program Studi</th>
                            <th scope="col">Mulai</th>
                            <th scope="col">Berakhir</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        @if(count($resumetime) === 0)
                            <td colspan="5" class="text-center">Tidak ada Data</td>
                        @else
                            @foreach ($resumetime as $i => $resume)
                                <th>{{$i+1}}</th>
                                <td>
                                    @foreach ($program_studi as $prodi)
                                        @if ($prodi->id === $resume->prodi_id)
                                            {{$prodi->nama}}
                                        @endif
                                    @endforeach
                                </td>
                                <td>{{$resume->mulai}}</td>
                                <td>{{$resume->berakhir}}</td>
                                <td><a href="{{ route('admin.resume-setting-delete', ['id'=>$resume->id]) }}" class="btn btn-danger">Delete</a></td>
                            @endforeach
                        @endif
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    
@endsection