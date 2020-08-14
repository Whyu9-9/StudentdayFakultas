@extends('layouts.admin-layout')

@section('active3')
    active
@endsection

@section('content')
    <h2 class="mb-4"><i class="fa fa-sticky-note"></i> Notes</h2>
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
                            <th scope="col">Mahasiswa</th>
                            <th scope="col">NIM</th>
                            <th scope="col">Note</th>
                            <th scope="col">Waktu</th>
                            <th scope="col">Tipe</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($note))
                            @foreach ($note as $i =>$noted)
                            <tr>
                                <td>{{ $i + 1 }}</td>
                                <td>
                                    @foreach ($datas as $data)
                                        @if($data->id === $noted->user_id)
                                            {{$data->nama}}
                                        @endif
                                    @endforeach    
                                </td>
                                <td>
                                    @foreach ($datas as $data)
                                        @if($data->id === $noted->user_id)
                                            {{$data->nim}}
                                        @endif
                                    @endforeach 
                                </td>
                                <td>{{ $noted->notes }}</td>
                                <td>{{ $noted->created_at }}</td>
                                <td>{{ $noted->tipe }}</td>
                            </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    
@endsection