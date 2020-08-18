@extends('layouts.admin-layout')

@section('active2')
    active
@endsection

@section('content')
    <h3 class="mb-4"><i class="fa fa-building" style="margin-right: 10px"></i> Organisasi : {{$mahasiswa->nama}} ({{$mahasiswa->nim}})</h3>
    <div class="card mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table id="table" class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama organisasi</th>
                            <th scope="col">Tingkat</th>
                            <th scope="col">Tahun</th>
                        </tr>
                    </thead>
                    <tbody>
                    @if(count($mahasiswa->organisasi) > 0)
                        @foreach($mahasiswa->organisasi as $i => $organisasi)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td>{{ $organisasi->nama }}</td>
                            <td>{{ $organisasi->jabatan }}</td>
                            <td>{{ $organisasi->tahun }}</td>
                        </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

