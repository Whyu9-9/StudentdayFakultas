@extends('layouts.admin-layout')

@section('active2')
    active
@endsection

@section('content')
    <h3 class="mb-4"><i class="fa fa-trophy" style="margin-right: 10px"></i> Prestasi : {{$mahasiswa->nama}} ({{$mahasiswa->nim}})</h3>
    <div class="card mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table id="table" class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama Prestasi</th>
                            <th scope="col">Tingkat</th>
                            <th scope="col">Tahun</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    @if(isset($prestasi))
                        @if(count($prestasi) > 0)
                            @foreach($prestasi as $i => $row)
                            <tr>
                                <td>{{ $i + 1 }}</td>
                                <td>{{ $row->nama }}</td>
                                <td>{{ $row->tingkat }}</td>
                                <td>{{ $row->tahun }}</td>
                                <td><a href="{{ route('prestasi.download', ['id'=>$row->id]) }}" class="btn btn-primary"><i class="fa fa-file-pdf"></i> Download</a></td>
                            </tr>
                            @endforeach
                        @endif
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

