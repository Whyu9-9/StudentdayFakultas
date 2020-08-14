@extends('layouts.beranda-layout')

@section('activeregistrasi')
    active
@endsection

@section('active4')
    active
@endsection

@section('content')
    <h2 class="mb-4"><i class="fa fa-trophy"></i> Prestasi Mahasiswa</h2>  
    @if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        @foreach ($errors->all() as $error)
            <i class="text-danger fas fa-exclamation-circle mr-1"></i> {{ $error }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        @endforeach
    </div>
    @elseif (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="text-success fas fa-check mr-1"></i> {{Session::get('success')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    <div class="card mb-4">
        <div class="card-body">
            <a href="#" data-toggle="modal" data-target="#modalTambah" class="btn btn-primary mb-3"><i class="fa fa-plus-circle mr-1"></i>Tambah Prestasi</a>
            <div class="table-responsive">
                <table id="table" class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama Prestasi</th>
                            <th scope="col">Tingkat</th>
                            <th scope="col">Tahun</th>
                            <th scope="col" class="col-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    @if(count($prestasi) > 0)
                        @foreach($prestasi as $i => $row)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td>{{ $row->nama }}</td>
                            <td>{{ $row->tingkat }}</td>
                            <td>{{ $row->tahun }}</td>
                            <td>
                                <a href="{{ route('prestasi.download', ['id'=>$row->id]) }}" class="btn btn-primary"><i class="fa fa-file-pdf"></i> Download</a>
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete">
                                    <i class="fa fa-trash"></i>
                                    Hapus
                                </button>
                                <!-- Modal Delete Prestasi -->
                                <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Apakah Anda yakin menghapus prestasi <b>{{$row->nama}}</b>?
                                            </div>
                                                <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
                                                <form method="POST" action="/prestasis/{{ $row->id }}">
                                                    {{ csrf_field() }}
                                                    {{ method_field('DELETE') }}
                                                    <button class="btn btn-danger" type="submit">
                                                        <i class="fa fa-trash"></i>
                                                        Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- <form method="POST" action="/prestasi/{{ $row->id }}">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <button class="btn btn-danger" type="submit">
                                        <i class="fa fa-trash"  style="margin-right: 10px"></i>
                                        Hapus
                                    </button>
                                </form> --}}
                            </td>
                        </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="5">
                                <p style="text-align: center;">Tidak ada prestasi</p>
                            </td>
                        </tr>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
        {{-- @if (count($errors) > 0)
			<div class="alert alert-danger">
                @foreach ($errors->all() as $error)
					<p>{{ $error }}</p>
				@endforeach
			</div>
		@endif --}}
    </div>

    <!-- Modal Add Prestasi -->
    <div class="modal fade" id="modalTambah" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-body" id="exampleModalCenterTitle"><i class="fa fa-trophy" style="margin-right: 10px"></i> Prestasi Baru</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="/prestasis" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="form-group">
                        <label class="label-control">Nama Prestasi</label>
                        <input type="text" name="nama" class="form-control" placeholder="Contoh: Lomba Catur">
                    </div>
                    <div class="form-group">
                        <label class="label-control">Tingkat</label>
                        <select class="form-control" name="tingkat">
                            <option value="null" selected>Pilih Tingkat</option>
                            <option value="Kota/Kabupaten">Tingkat Kota/Kabupaten</option>
                            <option value="Provinsi">Tingkat Provinsi</option>
                            <option value="Nasional">Tingkat Nasional</option>
                            <option value="Internasional">Tingkat Internasional</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="label-control">Tahun</label>
                        <input type="text" name="tahun" class="form-control" placeholder="Contoh: 2018">
                    </div>
                    <label class="label-control">Berkas</label>
                    <div class="form-group custom-file">
                        <label id="label-berkas" class="label-control custom-file-label">.pdf</label>
                        <input type="file" name="berkas" id="berkas" class="form-control custom-file-input">
                        <small>*Scan Piagam, sertifikat, bukti prestasi (Upload Salah Satu)</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-save" style="margin-right: 10px"></i>
                        Simpan Prestasi
                    </button>
                </div>
                </form>
            </div>
        </div>
    </div><!-- End Modal -->
@endsection

@section('custom_javascript')
    <script>
        $("#berkas").change(function() {
            var name = this.files[0].name;
            $('#label-berkas').html(name);
        });
    </script>
@endsection