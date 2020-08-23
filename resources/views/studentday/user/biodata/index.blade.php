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
                                        <li class="list-inline-item">Biodata</li>
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
                                    <h3 class="title-2" style="margin-bottom: 20px">Form Biodata Mahasiswa</h3>
                                    {{-- <span style="color: #ccc">Lengkapi form data berikut</span> --}}
                                    
                                    {{-- Form --}}
                                    <form method="POST" action="/biodata" class="m-t-40">
                                        @csrf
                                        <div class="form-group row">
                                            <label class="col-sm-3">No Induk Mahasiswa</label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" value="{{ Auth::user()->nim }}" disabled>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3">Program Studi</label>
                                            <div class="col-sm-6">
                                                <select class="form-control" name="prodi_id">
                                                @if(count($prodi) > 0)
                                                    @foreach($prodi as $row)
                                                        <option value="{{ $row->id }}"
                                                            @if(Auth::user()->prodi_id == $row->id)
                                                                selected 
                                                            @endif>{{ $row->nama }}</option>
                                                    @endforeach
                                                @endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3">Tahum Angkatan</label>
                                            <div class="col-sm-3">
                                                <input type="text" name="angkatan" class="form-control" value="{{ Auth::user()->angkatan }}">
                                            </div>
                                        </div>
                                        <hr class="m-t-20">
                                        <div class="form-group row">
                                            <label class="col-sm-3">Nama Lengkap</label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" value="{{ Auth::user()->nama }}" disabled>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3">Nama Panggilan</label>
                                            <div class="col-sm-6">
                                                <input type="text" name="nama_panggilan" class="form-control" value="{{ Auth::user()->nama_panggilan }}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3">Jenis Kelamin</label>
                                            <div class="col-sm-3">
                                                <select name="jenis_kelamin" class="form-control">
                                                    <option value="1" @if(Auth::user()->jenis_kelamin == 1) selected @endif>Laki-Laki</option>
                                                    <option value="0" @if(Auth::user()->jenis_kelamin == 0) selected @endif>Perempuan</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3">Tempat Lahir</label>
                                            <div class="col-sm-6">
                                                <input type="text" name="tempat_lahir" class="form-control" value="{{ Auth::user()->tempat_lahir }}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3">Tanggal Lahir</label>
                                            <div class="col-sm-3">
                                                <input type="date" name="tanggal_lahir" class="form-control" value="{{ Auth::user()->tanggal_lahir }}" disabled>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3">Gol. Darah</label>
                                            <div class="col-sm-3">
                                                <select name="gol_darah" class="form-control">
                                                @foreach($goldarah as $row)
                                                    <option value="{{ $row }}"
                                                        @if(Auth::user()->gol_darah == $row)
                                                            selected 
                                                        @endif>{{ $row }}</option>
                                                @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3">Alamat Asal</label>
                                            <div class="col-sm-6">
                                                <textarea name="alamat" class="form-control" rows="2">{{ Auth::user()->alamat }}</textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3">Alamat Sekarang</label>
                                            <div class="col-sm-6">
                                                <textarea name="alamat_sekarang" class="form-control" rows="2">{{ Auth::user()->alamat_sekarang }}</textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3">No. Telepon</label>
                                            <div class="col-sm-6">
                                                <input type="text" name="no_telp" class="form-control" value="{{ Auth::user()->no_telp}}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3">No. Handphone</label>
                                            <div class="col-sm-6">
                                                <input type="text" name="no_hp" class="form-control" value="{{ Auth::user()->no_hp}}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3">Email</label>
                                            <div class="col-sm-6">
                                                <input type="email" name="email" class="form-control" value="{{ Auth::user()->email }}">
                                            </div>
                                        </div>
                                        <hr class="m-t-20">
                                        <div class="form-group row">
                                            <label class="col-sm-3">Asal Sekolah</label>
                                            <div class="col-sm-6">
                                                <input type="text" name="asal_sekolah" class="form-control" value="{{ Auth::user()->asal_sekolah }}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3">Hobi</label>
                                            <div class="col-sm-6">
                                                <input type="text" name="hobi" class="form-control" value="{{ Auth::user()->hobi }}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3">Cita-Cita</label>
                                            <div class="col-sm-6">
                                                <input type="text" name="cita_cita" class="form-control" value="{{ Auth::user()->cita_cita }}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3">Tokoh Idola</label>
                                            <div class="col-sm-6">
                                                <input type="text" name="idola" class="form-control" value="{{ Auth::user()->idola }}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3">Moto</label>
                                            <div class="col-sm-6">
                                                <input type="text" name="moto" class="form-control" value="{{ Auth::user()->moto }}">
                                            </div>
                                        </div>
                                        <hr class="m-t-20">
                                        <div class="form-group row">
                                            <label class="col-sm-3">Nama Ayah</label>
                                            <div class="col-sm-6">
                                                <input type="text" name="nama_ayah" class="form-control" value="{{ Auth::user()->nama_ayah }}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3">Nama ibu</label>
                                            <div class="col-sm-6">
                                                <input type="text" name="nama_ibu" class="form-control" value="{{ Auth::user()->nama_ibu }}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3">Jumlah Saudara</label>
                                            <div class="col-sm-3">
                                                <input type="text" name="jml_saudara" class="form-control" value="{{ Auth::user()->jml_saudara }}">
                                            </div>
                                        </div>
                                        <hr class="m-t-20">
                                        <div class="form-group row">
                                            <label class="col-sm-3">Vegetarian</label>
                                            <div class="col-sm-3">
                                                <select name="vegetarian" class="form-control">
                                                    <option value="1" @if(Auth::user()->vegetarian == 1) selected @endif>Ya</option>
                                                    <option value="0" @if(Auth::user()->vegetarian == 0) selected @endif>Tidak</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3">Penyakit Khusus</label>
                                            <div class="col-sm-6">
                                                <input type="text" name="penyakit_khusus" class="form-control" value="{{ Auth::user()->penyakit_khusus }}" placeholder="Kosongkan jika tidak ada">
                                            </div>
                                        </div>
                                        <div class="form-group row m-t-40">
                                            <label class="col-sm-3"></label>
                                            <div class="col-sm-6">
                                                <button type="submit" class="btn btn-primary btn-block">
                                                    <i class="fas fa-save m-r-8"></i>
                                                    Simpan Biodata
                                                </button>
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

@endsection