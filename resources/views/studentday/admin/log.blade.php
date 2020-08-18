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
                                        <li class="list-inline-item active">
                                            <a href="/admin/mahasiswa">Daftar Mahasiswa</a>
                                        </li>
                                        <li class="list-inline-item seprate">
                                            <span>/</span>
                                        </li>
                                        <li class="list-inline-item active">
                                            <a href="/admin/biodata/{{ $mahasiswa->id }}">{{ $mahasiswa->nim }}</a>
                                        </li>
                                        <li class="list-inline-item seprate">
                                            <span>/</span>
                                        </li>
                                        <li class="list-inline-item">Log</li>
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
                                    <h3 class="title-2" style="margin-bottom: 20px">Log Mahasiswa : {{ $mahasiswa->nama }}</h3>
                                    <div class="table-responsive m-b-40 m-t-20">
                                        <table class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Waktu</th>
                                                    <th>Keterangan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @if(count($mahasiswa->log) > 0)
                                                @foreach($mahasiswa->log as $i => $row)
                                                    <tr>
                                                        <td>{{ $i + 1 }}</td>
                                                        <td>{{ $row->created_at->format('l, d M Y h:i A') }}</td>
                                                        <td>{{ $row->keterangan }}</td>
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
                    
                    @include('studentday.admin.inc.footer')
                </div>
            </div>
        </div>
        <!-- END MAIN CONTENT-->
        <!-- END PAGE CONTAINER-->
    </div>

</div>

@endsection