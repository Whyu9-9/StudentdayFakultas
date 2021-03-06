@extends('layouts.admin-layout')

@section('active2')
    active
@endsection

@section('content')
    <h2 class="mb-4"><i class="fa fa-sticky-note"></i> List Buyer Merch Bursa</h2>
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
                <a style="margin-top: 5px;margin-right: 3px;" href="/export-excel-bursa" class="btn btn-outline-success mb-3"><i class="fa fa-file mr-1"></i>Rekap Pembeli</a>
                <table id="table" class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama Mahasiswa</th>
                            <th scope="col">No telp</th>
                            <th scope="col">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($bursa))
                            @foreach ($bursa as $i =>$bursad)
                            <tr>
                                <td>{{ $i + 1 }}</td>
                                <td>{{ $bursad->nama }}</td>
                                <td>{{ $bursad->telp }}</td>
                                <td>{{ $bursad->ukuran }}</td>
                            </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    
@endsection