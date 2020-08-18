@extends('layouts.beranda-layout')

@section('activeregistrasi')
    active
@endsection

@section('active5')
    active
@endsection

@section('content')
    <h2 class="mb-4"><i class="fa fa-building"></i> Pengalaman Berorganisasi</h2>  
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="text-success fas fa-check mr-1"></i> {{Session::get('success')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <div class="card mb-4">
        <div class="card-body">
            <a href="#" data-toggle="modal" data-target="#modalTambah" class="btn btn-primary mb-3"><i class="fa fa-plus-circle mr-1"></i>Tambah Organisasi</a>
            <div class="table-responsive">
                <table id="table" class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama Organisasi</th>
                            <th scope="col">Jabatan</th>
                            <th scope="col">Tahun</th>
                            <th scope="col">Operasi</th>
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
                            <td>
                                <form method="POST" action="/organisasi/{{ $organisasi->id }}">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <button class="btn btn-danger" type="submit">
                                        <i class="fa fa-trash"  style="margin-right: 10px"></i>
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="5">
                                <p class="text-center">Tidak ada pengalaman organisasi</p>
                            </td>
                        </tr>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
        @if (count($errors) > 0)
			<div class="alert alert-danger">
                @foreach ($errors->all() as $error)
					<p>{{ $error }}</p>
				@endforeach
			</div>
		@endif
    </div>

<!-- Modal Show -->
    <div class="modal fade" id="modalTambah" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-body" id="exampleModalCenterTitle"><i class="fa fa-building" style="margin-right: 10px"></i> Pengalaman Organisasi Baru</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="/organisasi">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="form-group">
                        <label class="label-control">Nama Organisasi</label>
                        <input type="text" name="nama" class="form-control" placeholder="Contoh: OSIS">
                    </div>
                    <div class="form-group">
                        <label class="label-control">Jabatan</label>
                        <input type="text" name="jabatan" class="form-control" placeholder="Contoh: Seketaris">
                    </div>
                    <div class="form-group">
                        <label class="label-control">Tahun</label>
                        <input type="text" name="tahun" class="form-control" placeholder="Contoh: 2016">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-save" style="margin-right: 10px"></i> Simpan Organisasi
                    </button>
                </div>
                </form>
            </div>
        </div>
    </div><!-- End Modal -->

@endsection