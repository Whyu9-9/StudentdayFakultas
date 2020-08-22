@extends('layouts.admin-layout')

@section('master_data')
    active
@endsection

@section('activeM1')
    active
@endsection

@section('content')
    <h2 class="mb-4"><i class="fa fa-user"></i> Golongan Darah</h2>
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
            <div class="table-responsive">
                <table id="table" class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Golongan Darah</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($data))
                            @foreach ($data as $i =>$golongan_darah)
                                <tr>
                                    <th>{{ $i+1 }}</th>
                                    <td>{{ $golongan_darah->nama }}</td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    
@endsection