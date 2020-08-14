@extends('layouts.admin-layout')

@section('active2')
    active
@endsection

@section('content')
    <h3 class="mb-4"><i class="fa fa-list"></i> Log : {{$mahasiswa->nama}} ({{$mahasiswa->nim}})</h3>
    <div class="card mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table id="table" class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Aktivitas</th>
                            <th scope="col">Waktu</th>
                        </tr>
                    </thead>
                    <tbody>
                    @if(count($mahasiswa->logs) > 0)
                        @foreach($mahasiswa->logs as $i => $log)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td>{{ $log->konten }}</td>
                            <td>{{ $log->created_at }}</td>
                        </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

