@extends('layouts.admin-layout')

@section('activeIklan')
    active
@endsection

@section('custom_css')
    <!-- <style media="screen">
       table {
           border-collapse:collapse;
           table-layout:fixed;
           width:310px;
       }
       table td {
           border:solid 1px #fab;
           width:100px;
           word-wrap:break-word;
       }
    </style> -->
@endsection

@section('content')
    <h2 class="mb-4"><i class="fa fa-user"></i> Iklan Setting</h2>
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
            <a href="{{ route('admin-iklan-create') }}" class="btn btn-primary mb-3"><i class="fa fa-plus-circle mr-1"></i>Tambah Iklan</a>
            <div class="table-responsive">
                <table id="table" class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Judul</th>
                            <th scope="col" class="col-3">Keterangan</th>
                            <th scope="col">Gambar</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($iklans as $index => $iklan)
                        <tr>
                            <th scope="col">{{$index}}</th>
                            <th scope="col">{{$iklan->judul}}</th>
                            <th scope="col" class="col-3">{{$iklan->keterangan}}</th> <!-- benerin bagian ini yu -->
                            <th scope="col"><img src="{{$iklan->image}}" alt="no image" style="width:250px;"></th>
                            <th scope="col"> <a href="{{ route('admin-iklan-destroy', ['id' => $iklan->id]) }}" class="btn btn-danger">Delete</a> </th>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
