@extends('layouts.admin-layout')

@section('active4')
    active
@endsection

@section('content')
    <h2 class="mb-4"><i class="fa fa-bell"></i> Pengumuman</h2>  
    <div class="alert alert-warning" role="alert">
        <i class="fa fa-info-circle"></i> Klik pada baris data untuk melihat detail
    </div>
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
            <a href="{{ route('admin.sd-pengumuman-create') }}" class="btn btn-primary mb-3"><i class="fa fa-plus-circle mr-1"></i>Tambah pengumuman</a>
            <div class="table-responsive">
                <table id="table" class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Judul</th>
                            <th scope="col">Konten</th>
                            <th scope="col">Tanggal dibuat</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($data))
                            @foreach ($data as $i => $pengumuman)
                                <tr>
                                    <th
                                        data-toggle="modal" data-target="#modal"
                                        data-judul="{{ $pengumuman->judul }}"
                                        data-konten="{{ $pengumuman->konten }}"
                                        data-gambar="/thumbnail/{{ $pengumuman->gambar }}"
                                        style="cursor:pointer"
                                    >{{ $i+1 }}
                                    </th>
                                    <td
                                        data-toggle="modal" data-target="#modal"
                                        data-judul="{{ $pengumuman->judul }}"
                                        data-konten="{{ $pengumuman->konten }}"
                                        data-gambar="/thumbnail/{{ $pengumuman->gambar }}"
                                        style="cursor:pointer"
                                    >{{ $pengumuman->judul }}</td>
                                    <td
                                        data-toggle="modal" data-target="#modal"
                                        data-judul="{{ $pengumuman->judul }}"
                                        data-konten="{{ $pengumuman->konten }}"
                                        data-gambar="/thumbnail/{{ $pengumuman->gambar }}"
                                        style="cursor:pointer"
                                    >{{ str_limit($pengumuman->konten, 50) }}</td>
                                    <td
                                        data-toggle="modal" data-target="#modal"
                                        data-judul="{{ $pengumuman->judul }}"
                                        data-konten="{{ $pengumuman->konten }}"
                                        data-gambar="/thumbnail/{{ $pengumuman->gambar }}"
                                        style="cursor:pointer"
                                    >{{ date('d F Y', strtotime($pengumuman->created_at)) }}</td>
                                    <td>
                                        <!-- Edit -->
                                        <a href="{{ route('admin.sd-pengumuman-edit', $pengumuman->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
                                        <!--Delete -->
                                        <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete"><i class="fa fa-trash"></i></button>
                                        
                                        <!-- Modal Delete -->
                                        <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-edit"></i> Edit Angkatan</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="{{ route('admin.sd-pengumuman-destroy', $pengumuman->id) }}" method="POST">
                                                        <div class="modal-body">
                                                            {{ csrf_field() }}
                                                            {{ method_field('delete') }}
                                                            Apakah Anda yakin menghapus pengumuman?</b>
                                                    
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
    <!-- Modal -->
    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <img src="" width="100%" height="auto" alt="">
                    <p class="text-justify pt-4">Modal body text goes here.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal -->
@endsection

@section('custom_javascript')
    <script>
        $('#modal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var judul = button.data('judul') // Extract info from data-* attributes
            var konten = button.data('konten')
            var gambar = button.data('gambar')
            var modal = $(this)
            modal.find('.modal-title').text(judul)
            modal.find('.modal-body p').text(konten)
            modal.find('.modal-body > img').attr('src', gambar);
        })
    </script>
@endsection