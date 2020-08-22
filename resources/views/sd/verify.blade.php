@extends('layouts.layout')

@section('active_penerimaan_mahasiswa')
    menu-active
@endsection

@section('content')
    @section('content')
    <div class="jumbotron jumbotron-fluid" style="background: #3C3B3F; background: -webkit-linear-gradient(to top, #605C3C, #3C3B3F);  background: linear-gradient(to top, #605C3C, #3C3B3F); height: 100vh;">
        <div class="container" style="margin-top: 20vh">
            <div class="text-center" style="height:100%">
                <img class="mx-auto" src="{{ asset('/img/logo_sd.png') }}" height="auto" width="auto" alt="">
            </div>
        </div>
    </div>

    <main id="main">
        <div class="row justify-content-center m-0">
        <div class="col-md-6">
            <div id="about">
                <div class="container">
                    <!-- <div class="col-lg-6 content order-lg-1 order-2"> -->
                        <h2 style="color: #333; font-weight: 700; font-size: 32px;" class="title">Tentang Student Day</h2>
                        <p class="text-justify wow fadeInUp">
                            Kegiatan Student Day merupakan suatu kegiatan yang menjadi rangkaian kegiatan 
                            penerimaan mahasiswa baru Fakultas Teknik angkatan. Pada kegiatan ini, 
                            mahasiswa baru diperkenalkan dengan kegiatan-kegiatan kemahasiswaan beserta 
                            organisasi di lingkungan Senat Mahasiswa Fakultas Teknik Universitas Udayana.
                        </p>
                        <p class="text-justify wow fadeInUp" data-wow-delay="0.5s">
                            PKKMB, Student Day dan BKM merupakan rangkaian dari kegiatan penerimaan mahasiswa 
                            baru di lingkungan Fakultas Teknik Universitas Udayana. Sebagaimana kegiatan penerimaan 
                            mahasiswa baru lainnya, PKKMB, Student Day, dan BKM ini merupakan kegiatan yang 
                            wajib diikuti yang nantinya akan mempengaruhi penginputan SKP, syarat yudisium, 
                            dan kelulusan mahasiswa.
                        </p>
                    <!-- </div> -->
                </div>
            </div>

            <!--==========================
              Facts Section
            ============================-->
            <section id="facts">
                <div class="container wow fadeIn">
                    <div class="section-header">
                        <h3 class="section-title">Verifikasi Student Day</h3>
                    </div>
                    
                    <!--Verifikasi Section -->
                    @if($data)
                    <!-- Show Alert -->
                        @section('custom_javascript')
                            <script>
                                span = document.getElementById("status-info");
                                text = document.createTextNode("Verifikasi berhasil");
                                span.appendChild(text);
                                $('#status').modal('show')
                            </script>
                        @endsection
                        
                        

                        <!--Show data -->
                        <h3 class="text-center mb-5">Data Mahasiswa</h3>
                        <div id="data-mahasiswa" class="col-md-8 offset-md-2" style="margin-bottom: 5rem"> 
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <td>Nama</td>
                                        <td>{{ $data->nama }}</td>
                                    </tr>
                                    <tr>
                                        <td>NIM</td>
                                        <td>{{ $data->nim }}</td>
                                    </tr>
                                    <tr>
                                        <td>Jurusan</td>
                                        <td>{{ $data->prodi }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <p class="text-center">
                            <a id="pdf" href="#" style="border-radius:22px" class="btn btn-success">Cetak Bukti Verifikasi</a>
                        </p>
                        
                        <p class="text-center">
                            <button id="verify" style="border-radius:22px" class="btn btn-secondary" data-toggle="modal" data-target="#verifikasi-pendaftaran-modal">Verifikasi lagi</button>
                        </p> 
                    @else
                        @section('custom_javascript')
                            <script>
                                span = document.getElementById("status-info");
                                text = document.createTextNode("Verifikasi gagal");
                                span.appendChild(text);
                                $('#status').modal('show')
                            </script>
                        @endsection
                        
                        <!-- Bootstrap div alert -->
                        <div class="alert alert-danger mt-5" style="margin-bottom: 3.4rem" role="alert">
                            <i class="fas fa-check-circle"></i> Verifikasi gagal
                            <ul>
                                <li class="mt-1">Nama, NIM, atau Jurusan Tidak sesuai</li>
                            </ul>
                        </div>
                        <p class="text-center">
                            <button id="verify" style="border-radius:22px" class="btn btn-warning" data-toggle="modal" data-target="#verifikasi-pendaftaran-modal">Coba Lagi</button>
                        </p>
                    @endif<!-- End Verifikasi Section -->
                </div>
            </section><!-- #facts -->
        </div>
        <div class="col-md-4" style="padding: 80px 20px">
            <!-- Pengumuman Section -->
            <div class="p-2">
                <h1 class="text-center mb-4" style="color: #333; font-weight: 700; font-size: 32px;">Pengumuman</h1>
                @if(count($pengumumans))
                    @foreach ($pengumumans as $pengumuman)
                        <div class="card mb-4 box-shadow wow fadeInUp" style="border-radius: 0px">
                            <div class="card-body">
                                <h5 class="title text-body">{{ $pengumuman->judul }}</h5>
                                <p class="description">
                                    {!! str_limit($pengumuman->konten, 100) !!}
                                </p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <a href="{{ route('sd-pengumuman.show', $pengumuman->id) }}" class="btn btn-sm btn-outline-secondary" style="border-radius: 0px">Lihat</a>
                                    <small class="text-muted">{{ date('d-m-Y', strtotime($pengumuman->created_at)) }}</small>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
                
                <a href="{{ route('sd-pengumuman.index') }}" style="border-radius:50px;" class="btn btn-secondary">Lebih banyak..</a>
            </div> <!-- End Pengumuman -->
        </div>
    </main>

    <!-- Modal -->
    <div class="modal fade" id="status" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-body" id="exampleModalLabel">Status</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <span id="status-info" class="text-body"></span>
                <span id="status-info-alert"></span> 
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
            </div>
        </div>
    </div> <!-- End Modal -->

    <!-- Modal -->
    <div class="modal fade" id="verifikasi-pendaftaran-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-body" id="exampleModalCenterTitle">Verifikasi Pendaftaran</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('sd-verify.show') }}" class="form-group" method="get">
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="text-body" for="nama">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama">
                        </div>
                        <div class="form-group">
                            <label class="text-body" for="nim">NIM</label>
                            <input type="text" class="form-control" id="nim" name="nim" placeholder="180xxxxxx">
                        </div>
                        <div class="form-group">
                            <label class="text-body" for="program_studi">Jurusan</label>
                            <select class="form-control" id="program_studi" name="program_studi">
                                <option value="0">-Pilih jurusan-</option>
                                <option value="1">Teknik Arsitektur</option>
                                <option value="2">Teknik Sipil</option>
                                <option value="3">Teknik Elektro</option>
                                <option value="4">Teknik Mesin</option>
                                <option value="5">Teknologi Informasi</option>
                            </select>
                        </div>
                    </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success">Verifikasi</button type="submit">
                    </div>
                </form>
            </div>
        </div>
    </div><!-- End Modal -->
@endsection

