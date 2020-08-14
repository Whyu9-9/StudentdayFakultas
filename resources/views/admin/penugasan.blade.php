@extends('layouts.admin-layout')

@section('active2')
    active
@endsection

@section('content')
    <h3 class="mb-4"><i class="fa fa-list"></i> Penugasan : {{$mahasiswa->nama}} ({{$mahasiswa->nim}})</h3>
    <div class="card mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table id="table" class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Tipe</th>
                            <th scope="col">Waktu</th>
                            <th scope="col">File</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($penugasan as $i => $value)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ $value->tipe }}</td>
                        <td>{{ $value->created_at }}</td>
                        <td><a href="{{ route('penugasan.download', ['id'=>$value->id]) }}" class="btn btn-success">Download</a></td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

