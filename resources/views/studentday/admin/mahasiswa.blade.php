@extends('studentday.admin.app')

@section('content')

<div class="page-wrapper">
    @include('studentday.admin.inc.header_mobile')
    @include('studentday.admin.inc.sidebar')

    <!-- PAGE CONTAINER-->
    <div class="page-container">
        @include('studentday.admin.inc.header_desktop')
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
                                            <a href="/admin/beranda">Beranda</a>
                                        </li>
                                        <li class="list-inline-item seprate">
                                            <span>/</span>
                                        </li>
                                        <li class="list-inline-item">Daftar Mahasiswa</li>
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
                            @include('studentday.admin.inc.alert')
                            <div class="au-card">
                                <div class="au-card-inner">
                                    <h3 class="title-2" style="margin-bottom: 40px">Daftar Mahasiswa</h3>
                                    {{-- <span style="color: #ccc">Lengkapi form data berikut</span> --}}
                                    <table id="tbMahasiswa" class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>NIM</th>
                                                <th>Nama</th>
                                                <th>Program Studi</th>
                                                <th>Angkatan</th>
                                                <th>Operasi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @if(count($mahasiswa) > 0)
                                            @foreach($mahasiswa as $i => $row)
                                                <tr>
                                                    <td>{{ $i + 1 }}</td>
                                                    <td>{{ $row->nim }}</td>
                                                    <td>{{ $row->nama }}</td>
                                                    <td>{{ $row->prodi->nama }}</td>
                                                    <td>{{ $row->angkatan }}</td>
                                                    <td>
                                                        <a href="/admin/biodata/{{ $row->id }}" class="btn btn-primary">
                                                            <i class="fa fa-address-card"></i>
                                                        </a>
                                                        <a href="/admin/log/{{ $row->id }}" class="btn btn-primary">
                                                            <i class="fa fa-clock"></i>
                                                        </a>
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
                    
                    @include('studentday.admin.inc.footer')
                </div>
            </div>
        </div>
        <!-- END MAIN CONTENT-->
        <!-- END PAGE CONTAINER-->
    </div>

</div>

@endsection

@section('js')

<script>
    $(document).ready(function(){
        $('#tbMahasiswa').DataTable();
    });
</script>

@endsection