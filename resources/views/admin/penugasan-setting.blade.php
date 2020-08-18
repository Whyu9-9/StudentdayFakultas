@extends('layouts.admin-layout')

@section('penugasan')
    active
@endsection

@section('content')
    <h2 class="mb-4"><i class="fa fa-user"></i> Penugasan</h2>
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
            <a href="{{ route('penugasan.setting-add') }}" class="btn btn-primary mb-3"><i class="fa fa-plus-circle mr-1"></i>Tambah Tugas</a>
            <div class="table-responsive">
                <table id="table" class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Keterangan</th>
                            <th scope="col">Tipe</th>
                            <th scope="col">File</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($penugasansetting as $i => $setting)
                        <tr>
                            <td>{{$i + 1}}</td>
                            <td>{{$setting->keterangan}}</td>
                            <td>{{$setting->tipe}}</td>
                            <td>
                                @if (isset($setting->file))
                                    <a href="{{ route('penugasan.seting-download', ['id'=>$setting->id]) }}" class="btn btn-success">Download</a>
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('penugasan.seting-delete', ['id'=>$setting->id]) }}" class="btn btn-danger">Delete</a>
                            </td>
                            
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    
@endsection