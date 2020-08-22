@extends('layouts.admin-layout')

@section('master_data')
    active
@endsection

@section('activeM1')
    active
@endsection

@section('content')
    <h2 class="mb-4"><i class="fa fa-user"></i> Angkatan</h2>
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
                            <th scope="col">Tahun</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($data))
                            @foreach ($data as $i => $angkatan)
                                <tr>
                                    <th>{{ $i+1 }}</th>
                                    <td>{{ $angkatan->tahun }}</td>
                                    <td>
                                        <!-- Edit -->
                                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#edit"><i class="fa fa-edit"></i></button>
                                        <!-- Modal Edit -->
                                        <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-edit"></i> Edit Angkatan</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="{{ route('admin.angkatan-update', $angkatan->id) }}" method="POST">
                                                    @csrf
                                                        <div class="modal-body">
                                                            {{ method_field('put') }}
                                                            <div class="form-group col-md-5">
                                                                <label for="tahun">Tahun</label>
                                                                <input class="form-control" type="text" name="tahun" id="tahun" placeholder="Tahun" value="{{ $angkatan->tahun }}">
                                                            </div>
                                                    
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
                                                            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan perubahan</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Modal Edit -->

                                        <!-- Delete -->
                                        <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete"><i class="fa fa-trash"></i></button>
                                        <!-- Modal Delete -->
                                        <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-trash mr-1"></i>Hapus Angkatan</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="{{ route('admin.angkatan-destroy', $angkatan->id) }}" method="POST">
                                                        <div class="modal-body">
                                                            {{ csrf_field() }}
                                                            {{ method_field('delete') }}
                                                            Apakah Anda yakin menghapus angkatan <b>{{ $angkatan->tahun }}?</b>
                                                    
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Tidak</button>
                                                            <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> Ya</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Modal Delete -->
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