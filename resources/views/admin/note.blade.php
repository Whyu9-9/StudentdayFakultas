@extends('layouts.admin-layout')

@section('active2')
    active
@endsection

@section('content')
    <h3 class="mb-4"><i class="fa fa-list"></i> Note : {{$mahasiswa->nama}} ({{$mahasiswa->nim}})</h3>
    <div class="card mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table id="table" class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Note</th>
                            <th scope="col">Waktu</th>
                            <th scope="col">Tipe</th>
                        </tr>
                    </thead>
                    <tbody>
                    @if(count($mahasiswa->notes) > 0)
                        @foreach($mahasiswa->notes as $i => $note)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td>{{ $note->notes }}</td>
                            <td>{{ $note->created_at }}</td>
                            <td>{{ $note->tipe }}</td>
                        </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

