@extends('layouts.admin-layout')

@section('resume')
    active
@endsection

@section('activeR2')
    active
@endsection

@section('content')
    <h3 class="mb-4"><i class="fa fa-list"></i> Resume Data</h3>
    <div class="card mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table id="table" class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Nim</th>
                            <th scope="col">Prodi</th>
                            <th scope="col">Waktu Upload</th>
                            <th scope="col" class="col-2">File</th>
                        </tr>
                    </thead>
                    <tbody>
                    @if(count($resume) > 0)
                        @foreach($resume as $i => $data)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td>
                                @foreach ($mahasiswa as $detail)
                                    @if($detail->id === $data->user_id)
                                        {{$detail->nama}}
                                    @endif
                                @endforeach 
                            </td>
                            <td>
                                @foreach ($mahasiswa as $detail)
                                    @if($detail->id === $data->user_id)
                                        {{$detail->nim}}
                                    @endif
                                @endforeach
                            </td>
                            <td>
                                @foreach ($program_studi as $prodi)
                                    @if($prodi->id === $data->prodi_id)
                                        {{$prodi->nama}}
                                    @endif
                                @endforeach
                            </td>
                            <td>
                                {{$data->created_at}}
                            </td>
                            <td class="text-center">
                                @if($data->file !== null)
                                    <a href="{{ route('admin.mahasiswa-note-download', ['id'=>$data->id]) }}" class="btn btn-danger btn-sm"><i class="fa fa-file-pdf"></i> Download</a>
                                @else
                                    <p>Tidak Tersedia</p>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

