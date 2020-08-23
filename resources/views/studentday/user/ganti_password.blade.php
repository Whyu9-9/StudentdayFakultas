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
                                        <li class="list-inline-item">Ganti Password</li>
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
                                    <h3 class="title-2" style="margin-bottom: 40px">Ganti Password</h3>
                                    {{-- <span style="color: #ccc">Lengkapi form data berikut</span> --}}
                                    <form method="POST" action="/ganti_password">
                                        @csrf
                                        <div class="form-group row">
                                            <label class="col-sm-3">Password Lama</label>
                                            <div class="col-sm-4">
                                                <input name="password_lama" type="password" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3">Password Baru</label>
                                            <div class="col-sm-4">
                                                <input name="password" type="password" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3">Ulang Password Baru</label>
                                            <div class="col-sm-4">
                                                <input name="password_confirmation" type="password" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3"></label>
                                            <div class="col-sm-4">
                                                <button type="submit" class="btn btn-primary"><i class="fa fa-key"></i> Ganti Password</button>
                                            </div>
                                        </div>
                                    </form>
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
                <h5 class="modal-title" id="smallmodalLabel">Tambah Organisasi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/organisasi" method="POST">
                @csrf
                <input name="mahasiswa_id" type="hidden" value="{{ Auth::user()->id }}">
                <div class="modal-body">
                    <div class="form-group">
                        <input name="nama" type="text" class="form-control" placeholder="Nama Organisasi">
                    </div>
                    <div class="form-group">
                        <input name="jabatan" type="text" class="form-control" placeholder="Jabatan">
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