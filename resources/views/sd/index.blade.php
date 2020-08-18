@extends('layouts.layout')

@section('title')
    Student Day
@endsection

@section('active_penerimaan_mahasiswa')
    menu-active
@endsection

@section('content')
    <div class="jumbotron jumbotron-fluid" style="background: #3C3B3F; background: -webkit-linear-gradient(to top, #605C3C, #3C3B3F);  background: linear-gradient(to top, #605C3C, #3C3B3F); height: 100vh;">
        <div class="container" style="margin-top: 10vh">
            <div class="text-center">
                <img class="img-fluid mx-auto" src="{{ asset('/img/logo-sd-2020.png') }}" style="max-height:70vh;" alt="">
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
            <div class="mb-4">
                <section id="facts">
                    <div class="container wow fadeIn">
                        <div class="section-header">
                            <h3 class="section-title">Verifikasi Student Day</h3>
                        </div>
                        <div>
                            <br>
                            <p class="text-center wow fadeInUp">Verifikasi pendaftaran Student Day Fakultas Teknik Universitas Udayana dilakukan 
                            dengan klik tombol di bawah. selanjutnya akan diarahkan ke halaman   
                            <span class="font-italic"><b>LOGIN.</b></span> Login dapat dilakukan dengan username dan password menggunakan NIM.
                            <br>
                            <br>
                            <span class="text-warning">Lengkapilah form data diri yang ada
                            untuk melakukan pendaftaran.</span>
                            </p>
                        </div>
                        {{-- <h5 style="color: #FF4B2B" class="text-center my-5 wow fadeInUp" data-wow-delay="0.5s">Pendaftaran Student Day belum bisa diakses</h5> --}}
    
                        <p class="text-center">
                            <?php $i = 2 ?>
                            @if ($i == 1)
                                <a href="#" id="verify" style="border-radius:22px" class="btn btn-secondary">Verifikasi Pendaftaran</a>
                            @else
                                <a href="{{ route('login') }}" id="verify" style="border-radius:22px" class="btn btn-secondary" aria-disabled="true">Verifikasi Pendaftaran</a>
                            @endif
                        </p>
                    </div>
                </section>
            </div>
            ============================-->

            {{-- COMING SOON SECTION --}}
            <div class="mb-4">
                <section id="facts">
                    <div class="container wow fadeIn">
                        <div class="section-header">
                            <h3 class="section-title">Student Day Fakultas Teknik <script>
                                document.write(new Date().getFullYear());
                            </script></h3>
                        </div>
                        <div>
                            <div class="container my-3">
                                <div class="text-center">
                                    <img class="img-fluid mx-auto" src="{{ asset('/img/logo-sd-2020.png') }}" style="max-height:35vh;" alt="">
                                </div>
                            </div>
                        </div>
                        <p class="text-center">
                            <a href="/login" style="border-radius:22px" class="btn btn-secondary" aria-disabled="true">Login</a>
                        </p>
                    </div>
                </section>
            </div>
            
        </div>
        <div class="col-md-4" style="padding: 80px 20px">
            <!-- Pengumuman Section -->
            <h1 class="text-center mb-4" style="color: #333; font-weight: 700; font-size: 32px;">Pengumuman</h1>
            @if(count($data))
                @foreach ($data as $pengumuman)
                    <div class="card mb-4 box-shadow wow fadeInUp" style="border-radius: 0px">
                        <div class="card-body">
                            <h5 class="title text-body" style="color: #333; font-weight: 500; font-size: 24px;">{{ $pengumuman->judul }}</h5>
                            <p class="description">
                                {!! \Illuminate\Support\Str::limit($pengumuman->konten, 100) !!}
                            </p>
                            <div class="d-flex justify-content-between align-items-center">
                                <a href="{{ route('sd-pengumuman.show', $pengumuman->id) }}" class="btn btn-sm btn-outline-secondary" style="border-radius: 0px">Lihat</a>
                                <small class="text-muted">{{ date('d-m-Y', strtotime($pengumuman->created_at)) }}</small>
                            </div>
                        </div>
                    </div>
                @endforeach
                <a href="{{ route('sd-pengumuman.index') }}" class="btn btn-secondary">Lebih banyak..</a> <!-- End Pengumuman -->
            @else
                <p class="description text-center">Tidak ada pegumuman</p>
            @endif
        </div>
    </main>

    @if (count($modal))
        @section('custom_javascript')
        <script>
            $(document).ready(function () {
                $('#exampleModalCenter').modal('show');
            }); 
        </script>
        @endsection
    @endif
    
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLongTitle">Informasi Terbaru</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
                </div>
                @foreach($modal as $mod)
                    <div class="modal-body" style="padding: 0 !important;">
                        <img class="img-fluid" src="/thumbnail/{{ $mod->gambar }}" alt="">
                    </div>
                    <div class="modal-footer">
                        <a href="{{ route('sd-pengumuman.show', $mod->id) }}" class="btn btn-secondary">Selengkapnya</a>
                    </div>
                @endforeach
			</div>
		</div>
	</div>    
@endsection
