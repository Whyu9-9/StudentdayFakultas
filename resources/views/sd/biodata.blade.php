@extends('layouts.beranda-layout')



@section('activeregistrasi')

    active

@endsection



@section('active2')

    active

@endsection



@section('expand')

    true

@endsection



@section('content')

<div class="col-12 row mb-4">

    <h2 class="mr-3"><i class="fa fa-home"></i> Beranda</h2>

    @if (Auth::user()->lengkap == 0)

        <div class="alert alert-warning d-inline-flex mb-0">

            <p class="mb-0"><i class="fa fa-bell"></i> Belum Terdaftar Student Day.</p>

        </div>

    @elseif(Auth::user()->lengkap == 1)

        <div class="alert alert-primary">

            <p class="mb-0"><i class="fa fa-dot-circle text-primary"></i> Mengajukan Pendaftaran Student Day.</p>

        </div>

    @elseif(Auth::user()->lengkap == 2)

        <div class="alert alert-danger">

            <p class="mb-0"><i class="fa fa-exclamation-circle text-danger"></i> Terdapat Kesalahan pada Data Biodata</p>

        </div>

    @elseif(Auth::user()->lengkap == 3)

        <div class="alert alert-primary">

            <p class="mb-0"><i class="fa fa-dot-circle text-primary"></i> Mengajukan perbaikan kesalahan Data Pendaftaran</p>

        </div>

    @elseif(Auth::user()->lengkap == 4)
    @if(Auth::user()->mahasiswa_baru<3)
        <div class="alert alert-success">

            <p class="mb-0"><i class="fa fa-check text-success"></i> Pendaftaran Terverifikasi</p>

        </div>
    @else
    <div class="alert alert-warning d-inline-flex mb-0">

        <p class="mb-0"><i class="fa fa-bell"></i> Belum Terdaftar Student Day.</p>

    </div>
    @endif
    @elseif(Auth::user()->lengkap == 5)
    @if(Auth::user()->mahasiswa_baru<3)
        <div class="alert alert-primary">

            <p class="mb-0">

                <i class="fa fa-dot-circle text-warning"></i> Mengajukan Verifikasi Ulang Student Day

            </p>

        </div>
    @else
    <div class="alert alert-primary">

        <p class="mb-0">

            <i class="fa fa-dot-circle text-warning"></i> Mengajukan Pendaftaran Student Day

        </p>

    </div>
    @endif
    @elseif(Auth::user()->lengkap == 6)
    @if(Auth::user()->mahasiswa_baru<3)
        <p class="mb-0">

            <div class="alert alert-danger">

                <p class="mb-0">

                    <i class="fa fa-exclamation-circle text-danger"></i> Terdapat Kesalahan pada Data Verifikasi Ulang

                </p>

            </div>

        </p>
    @else
    <p class="mb-0">

        <div class="alert alert-danger">

            <p class="mb-0">

                <i class="fa fa-exclamation-circle text-danger"></i> Terdapat Kesalahan pada Data Pendaftaran

            </p>

        </div>

    </p>
    @endif
    @elseif(Auth::user()->lengkap == 7)
    @if(Auth::user()->mahasiswa_baru<3)
        <p class="mb-0">

            <div class="alert alert-primary">

                <i class="fa fa-dot-circle text-primary"></i> Mengajukan perbaikan kesalahan Data Verifikasi Ulang

            </div>

        </p>
    @else
    <p class="mb-0">

        <div class="alert alert-primary">

            <i class="fa fa-dot-circle text-primary"></i> Mengajukan perbaikan kesalahan Data Pendaftaran

        </div>

    </p>
    @endif

    @elseif(Auth::user()->lengkap == 8)

        <p class="mb-0">

            <div class="alert alert-success">

                <i class="fa fa-check-double text-success"></i> Terverifikasi

            </div>

        </p>

    @elseif(Auth::user()->lengkap == 9)

        <div class="alert alert-primary py-1 mb-0 mr-2">

            <p class="mb-0"><i class="fa fa-dot-circle text-primary"></i> Mengajukan Perbaikan Biodata</p>

        </div>

    @endif

</div>



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

            <i class="text-success fas fa-check mr-1"></i> {{session('success')}}

            <button type="button" class="close" data-dismiss="alert" aria-label="Close">

                <span aria-hidden="true">&times;</span>

            </button>

        </div>

    @endif

    @if(Auth::user()->mahasiswa_baru == 2)

    @if(Auth::user()->bukti_pembayaran == null)

        <div class="alert alert-warning">

            <i class="fa fa-exclamation-circle"></i> Pengumuman Bagi Mahasiswa Lama

            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#pengumumanmala">

                Lihat

            </button>

        </div>

    @endif

        @if(Auth::user()->bukti_pembayaran == null)

        <div class="modal fade" id="pengumumanmala" tabindex="-1" aria-labelledby="pengumumanmalaLabel" aria-hidden="show">

            <div class="modal-dialog">

                <div class="modal-content">

                    <div class="modal-header">

                        <h5 class="modal-title" id="pengumumanmalaLabel">Pengumuman Bagi Mahasiswa Lama</h5>

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                          <span aria-hidden="true">&times;</span>

                        </button>

                    </div>

                    <div class="modal-body">

                        Bagi mahasiswa lama yang akan mengikuti student day fakultas teknik 2020, diharapkan untuk membayar biaya kontribusi sebesar Rp. 75.000. Pembayaran dapat dilakukan melalui transfer ke nomor rekening <strong>0773057978 a.n Ni Made Candra Puspita D (Bank BNI)</strong> dan menguploadnya pada saat verifikasi. 

                        <br>

                        <img src="{{asset('/img/pembayaranmala.png')}}" style="width: 100%">

                    </div>

                    <div class="modal-footer">

                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                    </div>

                </div>

            </div>

        </div>

        @endif

    @endif

    @if(Auth::user()->mahasiswa_baru < 3)
    @if(Auth::user()->lengkap == 4)
            <div class="alert alert-info">

                <i class="fa fa-check text-success"></i> Selamat anda telah terdaftar, silahkan akses QR Code untuk masuk ke dalam group LINE, klik tombol berikut untuk mengakses QR Code <a class="btn btn-info" href="{{ route('beranda-sd-qrcode') }}" >Klik Disini</a>

            </div>
    @endif
    @else
    @if(Auth::user()->lengkap == 8)
            <div class="alert alert-success">
                <i class="fa fa-check-circle"></i> Selamat anda telah terdaftar, silahkan akses QR Code untuk masuk ke dalam group LINE, klik tombol berikut untuk mengakses QR Code <a class="btn btn-info" href="{{ route('beranda-sd-qrcode') }}" >Klik Disini</a>
            </div>
            <div class="alert alert-success">
                <i class="fa fa-check-circle"></i> 
                    Verifikasi Ulang Berhasil, Silahkan Cetak Berkas Student Day 2020 <a class="btn btn-info" href="{{ route('beranda-sd.cetak-berkas') }}" >Klik Disini</a>
                <br>
            </div>
    @endif
    @endif
    
    @if (Auth::user()->lengkap == 0)

    <div class="alert alert-primary"> 

        <i class="fa fa-exclamation-circle"></i> Dengan menekan tombol dibawah ini anda telah setuju bahwa Data Biodata, Organisasi dan Prestasi yang dicantumkan telah benar. <br>

        <button type="button" class="btn btn-primary mt-3" data-toggle="modal" data-target="#daftar">

            <i class="fa fa-edit"></i> Daftar Student Day

        </button>

    </div>

    <div class="modal fade" id="daftar" tabindex="-1" aria-labelledby="daftarsd" aria-hidden="show">

        <div class="modal-dialog">

            <div class="modal-content">

                <div class="modal-header">

                    <h5 class="modal-title" id="daftarsd">Ajukan Pendaftaran Student Day?</h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                      <span aria-hidden="true">&times;</span>

                    </button>

                </div>

                <div class="modal-body">

                    Pastikan biodata anda sudah lengkap sebelum menyetujui <strong>"PENDAFTARAN STUDENT DAY 2020"</strong>

                </div>

                <div class="modal-footer">

                    <a style="margin-bottom:14px;" href="{{ route('beranda-sd-daftar', ['id' => Auth::user()->id]) }}" class="btn btn-primary mt-3"><i class="fa fa-paper-plane"></i> Setuju</a>

                    <a href="/beranda-sd/{{ Auth::user()->id }}/edit" class="btn btn-secondary"><i class="fa fa-edit"></i> Ubah Biodata</a>

                    <button type="button" class="btn btn-danger" data-dismiss="modal">Kembali</button>

                </div>

            </div>

        </div>

    </div>

    @elseif(Auth::user()->lengkap == 2)

    <div class="alert alert-danger">

        <?php

            $i = count($notes);

        ?>

        @foreach ($notes as $note)

            <p>

                <i class="fa fa-exclamation-circle"></i> Note dari ADMIN: <strong>{{$note->notes}}</strong>

                <p style="margin-left:18px;">Dikirim Pada: {{date($note->created_at)}}</p>

            </p>

        @endforeach

    </div>

    @endif

    @if (Auth::user()->lengkap == 4)

    <div class="alert alert-primary"> 

        <i class="fa fa-exclamation-circle"></i> Dengan menekan tombol dibawah ini anda telah setuju bahwa Data Biodata, Organisasi dan Prestasi yang dicantumkan telah benar. <br>

        <button type="button" class="btn btn-primary mt-3" data-toggle="modal" data-target="#daftar">

            <i class="fa fa-edit"></i> Daftar Student Day

        </button>

    </div>

    <div class="modal fade" id="daftar" tabindex="-1" aria-labelledby="daftarsd" aria-hidden="show">

        <div class="modal-dialog">

            <div class="modal-content">

                <div class="modal-header">

                    <h5 class="modal-title" id="daftarsd">Ajukan Pendaftaran Student Day?</h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                      <span aria-hidden="true">&times;</span>

                    </button>

                </div>

                <div class="modal-body">

                    Pastikan biodata anda sudah lengkap sebelum menyetujui <strong>"PENDAFTARAN STUDENT DAY 2020"</strong>

                </div>

                <div class="modal-footer">

                    <a style="margin-bottom:14px;" href="{{ route('beranda-sd-daftar', ['id' => Auth::user()->id]) }}" class="btn btn-primary mt-3"><i class="fa fa-paper-plane"></i> Setuju</a>

                    <a href="/beranda-sd/{{ Auth::user()->id }}/edit" class="btn btn-secondary"><i class="fa fa-edit"></i> Ubah Biodata</a>

                    <button type="button" class="btn btn-danger" data-dismiss="modal">Kembali</button>

                </div>

            </div>

        </div>

    </div>

    @elseif(Auth::user()->lengkap == 6)
    @if(Auth::user()->mahasiswa_baru >2 )
    <div class="alert alert-danger">

        <?php

            $i = count($notes);

        ?>

        @foreach ($notes as $note)

            <p>

                <i class="fa fa-exclamation-circle"></i> Note dari ADMIN: <strong>{{$note->notes}}</strong>

                <p style="margin-left:18px;">Dikirim Pada: {{date($note->created_at)}}</p>

            </p>

        @endforeach
    </div>
    @endif
    @if(Auth::user()->mahasiswa_baru > 2 )
    @if(Auth::user()->lengkap == 6 )
    @foreach($cek as $ceks)
    @if($ceks->notes_ilmiah!=null)
    <div class="alert alert-primary">

        <h5>Kamu Mendapatkan Tugas Khusus</h5>

        <p>Tugas Khusus dikirim 1 jam setelah hari-h Student Day berakhir bersamaan dengan tugas-tugas lainnya.

        <br><strong>PESERTA DIHARAPKAN UNTUK MENDOWNLOAD SOAL DAN MENCATAT NOTE YANG DIBERIKAN SEBELUM HILANG DARI HALAMAN INI!</strong></p>

        <?php

            $i = count($ilmiah);

        ?>

        @foreach ($ilmiah as $khusus)

        @if ($khusus->notes_ilmiah != null)

            <p>

                <i class="fa fa-exclamation-circle"></i> Note dari ADMIN: <strong>{{$khusus->notes_ilmiah}}</strong>

                <p style="margin-left:18px;">Dikirim Pada: {{date($note->created_at)}}</p>

            </p>

        @endif
        

        @endforeach

        <a style="margin-left:18px;" class="btn btn-primary" href="https://drive.google.com/drive/folders/1IV9a69E5z11QD11X8hpw5pIVlol2LBab?usp=sharing">Link Soal Tugas Khusus</a>

    </div>

    @endif

    @endforeach

    @endif

    @endif

    @endif
    
@if(Auth::user()->mahasiswa_baru<3)
    <div class="card mb-4">

        <div class="card-body">

            <a href="/beranda-sd/{{ Auth::user()->id }}/edit" class="btn btn-primary mb-3"><i class="fa fa-edit"></i> Ubah Biodata</a>

            <div class="row">

                <div style="margin-left:-35px;" class="col-md-8 px-5">

                    <table class="table table-borderless">

                        <tbody>

                            <tr>

                                <td><label for="nim">NIM</label></td>

                                <td>: {{ $data->nim }}</td>

                            </tr>

                            <tr>

                                <td><label for="krm">KRM</label></td>

                                <td>

                                    @if($data->krm !== null)

                                        <div class="mb-3">

                                            : <a href="{{ route('beranda-sd-get-krm', ['id'=>$data->id]) }}">Berkas berhasil diupload</a>

                                        </div>    

                                    @else

                                        : -

                                    @endif

                                </td>

                            </tr>

                            <tr>

                                <td><label for="nama">Nama</label></td>

                                <td>: {{ $data->nama }}</td>

                            </tr>

                            <tr>

                                <td><label for="nama_panggilan">Nama panggilan</label></td>

                                @if ($data->nama_panggilan == NULL)

                                    <td>: -</td>

                                @else

                                    <td>: {{ $data->nama_panggilan }}</td>

                                @endif

                            </tr>

                            <tr>

                                <td><label for="program_studi">Program Studi</label></td> 

                                @if ($data->prodi)

                                    <td>: {{ $data->prodi }}</td>

                                @else

                                    <td>: -</td>

                                @endif

                            </tr>

                            <tr>

                                <td><label for="jenis_kelamin">Jenis Kelamin</label></td>

                                @if ($data->jk)

                                    <td>: {{ $data->jk }}</td>

                                @else

                                    <td>: -</td>

                                @endif

                            </tr>

                            <tr>

                                <td><label for="agama">Agama</label></td>

                                @if ($data->agama)

                                    <td>: {{ $data->agama_ }}</td>

                                @else

                                    <td>: -</td>

                                @endif

                            </tr>

                            <tr>

                                <td><label for="gol_darah">Golongan Darah</label></td>

                                @if ($data->goldar)

                                    <td>: {{ $data->goldar }}</td>

                                @else

                                    <td>: -</td>

                                @endif

                            </tr>

                            <tr>

                                <td><label for="tempat_lahir">Tempat Lahir</label></td>

                                @if ($data->tempat_lahir == NULL)

                                    <td>: -</td>

                                @else

                                    <td>: {{ $data->tempat_lahir }}</td>

                                @endif

                            </tr>

                            <tr>

                                <td><label for="tanggal_lahir">Tanggal Lahir</label></td>

                                @if ($data->tanggal_lahir == NULL)

                                    <td>: -</td>

                                @else

                                    <td>: {{ $data->tanggal_lahir }}</td>

                                @endif

                            </tr>

                            <tr>

                                <td><label for="alamat">Alamat Asal</label></td>

                                @if ($data->alamat == NULL)

                                    <td>: -</td>

                                @else

                                    <td>: {{ $data->alamat }}</td>

                                @endif

                            </tr>

                            <tr>

                                <td><label for="alamat_sekarang">Alamat Sekarang</label></td>

                                @if ($data->alamat_sekarang == NULL)

                                    <td>: -</td>

                                @else

                                    <td>: {{ $data->alamat_sekarang }}</td>

                                @endif

                            </tr>

                            <tr>

                                <td><label for="no_telepon">Nomor Telepon</label></td>

                                @if ($data->no_telepon == NULL)

                                    <td>: -</td>

                                @else

                                    <td>: {{ $data->no_telepon }}</td>

                                @endif

                            </tr>

                            <tr>

                                <td><label for="no_telepon">ID Line</label></td>

                                @if ($data->id_line == NULL)

                                    <td>: -</td>

                                @else

                                    <td>: {{ $data->id_line }}</td>

                                @endif

                            </tr>

                            <tr>

                                <td><label for="no_hp">No Ponsel</label></td>

                                @if ($data->no_hp == NULL)

                                    <td>: -</td>

                                @else

                                    <td>: {{ $data->no_hp }}</td>

                                @endif

                            </tr>

                            <tr>

                                <td><label for="email">Email</label></td>

                                @if ($data->email == NULL)

                                    <td>: -</td>

                                @else

                                    <td>: {{ $data->email }}</td>

                                @endif

                            </tr>

                            <tr>

                                <td><label for="asal_sekolah">Asal Sekolah</label></td>

                                @if ($data->asal_sekolah == NULL)

                                    <td>: -</td>

                                @else

                                    <td>: {{ $data->asal_sekolah }}</td>

                                @endif

                            </tr>

                            <tr>

                                <td><label for="alasan_kuliah">Alasan kuliah</label></td>

                                @if ($data->alasan_kuliah)

                                    <td>: {{ $data->alasan_kuliah }}</td>

                                @else

                                    <td>: -</td>

                                @endif

                            </tr>

                            <tr>

                                <td><label for="hobi">Hobi</label></td>

                                @if ($data->hobi == NULL)

                                    <td>: -</td>

                                @else

                                    <td>: {{ $data->hobi }}</td>

                                @endif

                            </tr>

                            <tr>

                                <td><label for="minat_bakat">Minat Bakat</label></td>

                                @if ($data->minat_bakat == NULL)

                                    <td>: -</td>

                                @else

                                    <td>: {{ $data->minat_bakat }}</td>

                                @endif

                            </tr>

                            <tr>

                                <td><label for="cita_cita">Cita-cita</label></td>

                                @if ($data->cita_cita == NULL)

                                    <td>: -</td>

                                @else

                                    <td>: {{ $data->cita_cita }}</td>

                                @endif

                            </tr>

                            <tr>

                                <td><label for="idola">Idola</label></td>

                                @if ($data->idola == NULL)

                                    <td>: -</td>

                                @else

                                    <td>: {{ $data->idola }}</td>

                                @endif

                            </tr>

                            <tr>

                                {{-- gakada --}}

                                <td><label for="moto">Moto</label></td>

                                @if ($data->moto == NULL)

                                    <td>: -</td>

                                @else

                                    <td>: {{ $data->moto }}</td>

                                @endif

                            </tr>

                            <tr>

                                <td><label for="jumlah_saudara">Jumlah Saudara</label></td>

                                @if (intval($data->jumlah_saudara) < 0)

                                    <td>: -</td>

                                @else

                                    <td>: {{ $data->jumlah_saudara }}</td>

                                @endif

                            </tr>

                            <tr>

                                <td><label for="nama_ayah">Nama Ayah</label></td>

                                @if ($data->nama_ayah == NULL)

                                    <td>: -</td>

                                @else

                                    <td>: {{ $data->nama_ayah }}</td>

                                @endif

                            </tr>

                            <tr>

                                <td><label for="nama_ibu">Nama Ibu</label></td>

                                @if ($data->nama_ibu == NULL)

                                    <td>: -</td>

                                @else

                                    <td>: {{ $data->nama_ibu }}</td>

                                @endif

                            </tr>

                            <tr>

                                {{-- gakada --}}

                                <td><label for="penyakit_khusus">Penyakit Khusus</label></td>

                                @if ($data->penyakit_khusus)

                                    <td>: {{ $data->penyakit_khusus }}</td>

                                @else

                                    <td>: Tidak Ada</td>

                                @endif

                            </tr>

                            <tr>

                                <td><label for="mahasiswa_baru">Mahasiswa Baru</label></td>

                                @if ($data->mahasiswa_baru)

                                    @if ($data->mahasiswa_baru != 2)

                                        <td>: Ya</td>

                                    @else

                                        <td>: Tidak</td>

                                    @endif

                                @else

                                    <td>: Belum ditentukan</td>

                                @endif

                            </tr>

                            <tr>

                                <td><label for="angkatan">Angkatan</label></td>

                                @if ($data->angkatan)

                                    <td>: {{ $data->tahun }}</td>

                                @else

                                    <td>: Belum ditentukan</td>

                                @endif

                            </tr>

                            <tr>

                                <td><label for="organisasi_prestasi">Organisasi & Prestasi</label></td>

                                @if ($data->checkorpres == 1)

                                    <td>: Saya Memiliki Pengalaman Organisasi</td>

                                @elseif($data->checkorpres == 2)

                                    <td>: Saya Memiliki Prestasi Akadamik / Non Akademik</td>

                                @elseif($data->checkorpres == 3)

                                    <td>: Saya Memiliki Pengalaman Organisasi dan Prestasi Akademik/Non Akademik</td>

                                @else

                                    <td>: Tidak Ada</td>

                                @endif

                            </tr>

                        </tbody>

                    </table>

                </div>

                <div class="col-md-4 px-5">

                    <img class="float-right" src="{{$data->profile != null ? asset('/public'.$data->profile) : '/img/foto3x4.jpg'}}" style="border-style:solid;height: 400px; width: 300px;" alt="not found">

                </div>

            </div>

        </div>

    </div>
    @else
    <div class="card mb-4">

        <div class="card-body">

            <a href="/beranda-sd/{{ Auth::user()->id }}/edit" class="btn btn-primary mb-3"><i class="fa fa-edit"></i> Ubah Biodata</a>

            <div class="row">

                <div style="margin-left:-35px;" class="col-md-8 px-5">

                    <table class="table table-borderless">

                        <tbody>

                            <tr>

                                <td><label for="nim">NIM</label></td>

                                <td>: {{ $data->nim }}</td>

                            </tr>

                            <tr>

                                <td><label for="krm">KRM</label></td>

                                <td>

                                    @if($data->krm !== null)

                                        <div class="mb-3">

                                            : <a href="{{ route('beranda-sd-get-krm', ['id'=>$data->id]) }}">Berkas berhasil diupload</a>

                                        </div>    

                                    @else

                                        : -

                                    @endif

                                </td>

                            </tr>

                            <tr>

                                <td><label for="nama">Nama</label></td>

                                <td>: {{ $data->nama }}</td>

                            </tr>

                            <tr>

                                <td><label for="nama_panggilan">Nama panggilan</label></td>

                                @if ($data->nama_panggilan == NULL)

                                    <td>: -</td>

                                @else

                                    <td>: {{ $data->nama_panggilan }}</td>

                                @endif

                            </tr>

                            <tr>

                                <td><label for="program_studi">Program Studi</label></td> 

                                @if ($data->prodi)

                                    <td>: {{ $data->prodi }}</td>

                                @else

                                    <td>: -</td>

                                @endif

                            </tr>

                            <tr>

                                <td><label for="jenis_kelamin">Jenis Kelamin</label></td>

                                @if ($data->jk)

                                    <td>: {{ $data->jk }}</td>

                                @else

                                    <td>: -</td>

                                @endif

                            </tr>

                            <tr>

                                <td><label for="agama">Agama</label></td>

                                @if ($data->agama)

                                    <td>: {{ $data->agama_ }}</td>

                                @else

                                    <td>: -</td>

                                @endif

                            </tr>

                            <tr>

                                <td><label for="gol_darah">Golongan Darah</label></td>

                                @if ($data->goldar)

                                    <td>: {{ $data->goldar }}</td>

                                @else

                                    <td>: -</td>

                                @endif

                            </tr>

                            <tr>

                                <td><label for="tempat_lahir">Tempat Lahir</label></td>

                                @if ($data->tempat_lahir == NULL)

                                    <td>: -</td>

                                @else

                                    <td>: {{ $data->tempat_lahir }}</td>

                                @endif

                            </tr>

                            <tr>

                                <td><label for="tanggal_lahir">Tanggal Lahir</label></td>

                                @if ($data->tanggal_lahir == NULL)

                                    <td>: -</td>

                                @else

                                    <td>: {{ $data->tanggal_lahir }}</td>

                                @endif

                            </tr>

                            <tr>

                                <td><label for="alamat">Alamat Asal</label></td>

                                @if ($data->alamat == NULL)

                                    <td>: -</td>

                                @else

                                    <td>: {{ $data->alamat }}</td>

                                @endif

                            </tr>

                            <tr>

                                <td><label for="alamat_sekarang">Alamat Sekarang</label></td>

                                @if ($data->alamat_sekarang == NULL)

                                    <td>: -</td>

                                @else

                                    <td>: {{ $data->alamat_sekarang }}</td>

                                @endif

                            </tr>

                            <tr>

                                <td><label for="no_telepon">Nomor Telepon</label></td>

                                @if ($data->no_telepon == NULL)

                                    <td>: -</td>

                                @else

                                    <td>: {{ $data->no_telepon }}</td>

                                @endif

                            </tr>

                            <tr>

                                <td><label for="no_telepon">ID Line</label></td>

                                @if ($data->id_line == NULL)

                                    <td>: -</td>

                                @else

                                    <td>: {{ $data->id_line }}</td>

                                @endif

                            </tr>

                            <tr>

                                <td><label for="no_hp">No Ponsel</label></td>

                                @if ($data->no_hp == NULL)

                                    <td>: -</td>

                                @else

                                    <td>: {{ $data->no_hp }}</td>

                                @endif

                            </tr>

                            <tr>

                                <td><label for="email">Email</label></td>

                                @if ($data->email == NULL)

                                    <td>: -</td>

                                @else

                                    <td>: {{ $data->email }}</td>

                                @endif

                            </tr>

                            <tr>

                                <td><label for="asal_sekolah">Asal Sekolah</label></td>

                                @if ($data->asal_sekolah == NULL)

                                    <td>: -</td>

                                @else

                                    <td>: {{ $data->asal_sekolah }}</td>

                                @endif

                            </tr>

                            <tr>

                                <td><label for="alasan_kuliah">Alasan kuliah</label></td>

                                @if ($data->alasan_kuliah)

                                    <td>: {{ $data->alasan_kuliah }}</td>

                                @else

                                    <td>: -</td>

                                @endif

                            </tr>

                            <tr>

                                <td><label for="hobi">Hobi</label></td>

                                @if ($data->hobi == NULL)

                                    <td>: -</td>

                                @else

                                    <td>: {{ $data->hobi }}</td>

                                @endif

                            </tr>

                            <tr>

                                <td><label for="minat_bakat">Minat Bakat</label></td>

                                @if ($data->minat_bakat == NULL)

                                    <td>: -</td>

                                @else

                                    <td>: {{ $data->minat_bakat }}</td>

                                @endif

                            </tr>

                            <tr>

                                <td><label for="cita_cita">Cita-cita</label></td>

                                @if ($data->cita_cita == NULL)

                                    <td>: -</td>

                                @else

                                    <td>: {{ $data->cita_cita }}</td>

                                @endif

                            </tr>

                            <tr>

                                <td><label for="idola">Idola</label></td>

                                @if ($data->idola == NULL)

                                    <td>: -</td>

                                @else

                                    <td>: {{ $data->idola }}</td>

                                @endif

                            </tr>

                            <tr>

                                {{-- gakada --}}

                                <td><label for="moto">Moto</label></td>

                                @if ($data->moto == NULL)

                                    <td>: -</td>

                                @else

                                    <td>: {{ $data->moto }}</td>

                                @endif

                            </tr>

                            <tr>

                                <td><label for="jumlah_saudara">Jumlah Saudara</label></td>

                                @if (intval($data->jumlah_saudara) < 0)

                                    <td>: -</td>

                                @else

                                    <td>: {{ $data->jumlah_saudara }}</td>

                                @endif

                            </tr>

                            <tr>

                                <td><label for="nama_ayah">Nama Ayah</label></td>

                                @if ($data->nama_ayah == NULL)

                                    <td>: -</td>

                                @else

                                    <td>: {{ $data->nama_ayah }}</td>

                                @endif

                            </tr>

                            <tr>

                                <td><label for="nama_ibu">Nama Ibu</label></td>

                                @if ($data->nama_ibu == NULL)

                                    <td>: -</td>

                                @else

                                    <td>: {{ $data->nama_ibu }}</td>

                                @endif

                            </tr>

                            <tr>

                                {{-- gakada --}}

                                <td><label for="penyakit_khusus">Penyakit Khusus</label></td>

                                @if ($data->penyakit_khusus)

                                    <td>: {{ $data->penyakit_khusus }}</td>

                                @else

                                    <td>: Tidak Ada</td>

                                @endif

                            </tr>

                            <tr>
                                <td>
                                    <label for="scan-riwayat">Scan Bukti Riwayat Penyakit</label>
                                </td>

                                <div class="mb-3">

                                @if(Auth::user()->scan_penyakit == null)

                                <td>: -</td>

                        @else

                        <td>
                            : <a href="/beranda-sd-verifikasi-scan-download/{{Auth::user()->id}}">Download</a>
                        </td>

                        @endif

                    </div>
                            </tr>
                            <tr>
                                <td>
                                    <label for="basic-url">Youtube URL</label>
                                </td>
                                    
                                <td>
                                    : <a>{{Auth::user()->youtube}}</a>
                                </td>

                                </tr>
                            <tr>

                                <td><label for="mahasiswa_baru">Mahasiswa Baru</label></td>

                                @if ($data->mahasiswa_baru)

                                    @if ($data->mahasiswa_baru != 2)

                                        <td>: Ya</td>

                                    @else

                                        <td>: Tidak</td>

                                    @endif

                                @else

                                    <td>: Belum ditentukan</td>

                                @endif

                            </tr>

                            <tr>

                                <td><label for="angkatan">Angkatan</label></td>

                                @if ($data->angkatan)

                                    <td>: {{ $data->tahun }}</td>

                                @else

                                    <td>: Belum ditentukan</td>

                                @endif

                            </tr>

                            <tr>

                                <td><label for="organisasi_prestasi">Organisasi & Prestasi</label></td>

                                @if ($data->checkorpres == 1)

                                    <td>: Saya Memiliki Pengalaman Organisasi</td>

                                @elseif($data->checkorpres == 2)

                                    <td>: Saya Memiliki Prestasi Akadamik / Non Akademik</td>

                                @elseif($data->checkorpres == 3)

                                    <td>: Saya Memiliki Pengalaman Organisasi dan Prestasi Akademik/Non Akademik</td>

                                @else

                                    <td>: Tidak Ada</td>

                                @endif

                            </tr>

                        </tbody>

                    </table>

                </div>

                <div class="col-md-4 px-5">

                    <img class="float-right" src="{{$data->profile != null ? asset('/public'.$data->profile) : '/img/foto3x4.jpg'}}" style="border-style:solid;height: 400px; width: 300px;" alt="not found">

                </div>

            </div>

        </div>

    </div>
@endif
@endsection



@section('custom_javascript')

    <script>

        $(".berkas").change(function() {

            var name = this.files[0].name;

            var label = this.nextElementSibling;

            label.textContent = name;

        });

    </script>

    <script>

        $(document).ready(function () {

            $('#pengumumanmala').modal('show');    

        }); 

    </script>

@endsection