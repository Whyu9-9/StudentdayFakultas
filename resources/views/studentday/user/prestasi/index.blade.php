@extends('studentday.user.app')

@section('content')

<div class="page-wrapper">
    @include('studentday.user.inc.header_mobile')
    @include('studentday.user.inc.sidebar')

    <!-- PAGE CONTAINER-->
    <div class="page-container">
        @include('studentday.user.inc.header_desktop')
        <!-- BREADCRUMB-->
        <section class="au-breadcrumb m-t-75">
            <div class="section__content section__content--p30">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="au-breadcrumb-content">
                                <div class="au-breadcrumb-left">
                                    <ul class="list-unstyled list-inline au-breadcrumb__list">
                                        <li class="list-inline-item active">
                                            <a href="/beranda">Beranda</a>
                                        </li>
                                        <li class="list-inline-item seprate">
                                            <span>/</span>
                                        </li>
                                        <li class="list-inline-item">Prestasi</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- END BREADCRUMB-->

        <!-- MAIN CONTENT-->
        <div class="main-content">
            {{-- Form Biodata --}}
            <div class="section__content section__content--p30">
                <div class="container-fluid">
                    <div class="row m-t-0">
                        <div class="col-sm-12">
                            @include('studentday.user.inc.alert')
                            <div class="au-card">
                                <div class="au-card-inner">
                                    <h3 class="title-2" style="margin-bottom: 40px">Daftar Prestasi yang Dicapai</h3>
                                    {{-- <span style="color: #ccc">Lengkapi form data berikut</span> --}}
                                    <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#modalTambah"><i class="fa fa-plus"></i> Tambah Prestasi</a>
                                    <div class="table-responsive m-b-40 m-t-20">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama Prestasi</th>
                                                    <th>Tingkat</th>
                                                    <th>Tahun</th>
                                                    <th>Operasi</th>
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
                                                            <form action="/prestasi/{{ $row->id }}" method="POST">
                                                                @csrf
                                                                {{ method_field('DELETE') }}
                                                                <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> Hapus</button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    @include('studentday.user.inc.footer')
                </div>
            </div>
        </div>
        <!-- END MAIN CONTENT-->
        <!-- END PAGE CONTAINER-->
    </div>

</div>

{{-- Modal --}}
<div class="modal fade" id="modalTambah" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="smallmodalLabel">Tambah Prestasi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/prestasi" method="POST">
                @csrf
                <input name="mahasiswa_id" type="hidden" value="{{ Auth::user()->id }}">
                <div class="modal-body">
                    <div class="form-group">
                        <input name="nama" type="text" class="form-control" placeholder="Nama Prestasi">
                    </div>
                    <div class="form-group">
                        <input name="tingkat" type="text" class="form-control" placeholder="Tingkat">
                    </div>
                    <div class="form-group">
                        <input name="tahun" type="text" class="form-control" placeholder="Tahun">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection