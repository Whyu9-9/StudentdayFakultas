@extends('layouts.admin-layout')

@section('active2')
    active
@endsection

@section('content')
    <h2 class="mb-4"><i class="fa fa-user"></i> Mahasiswa</h2>
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
    @if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        @foreach ($errors->all() as $error)
                <i class="text-danger fas fa-exclamation-circle mr-1"></i> {{ $error }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
        @endforeach
    </div>
    @endif
    @if (Session::has('failed'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="text-danger fas fa-exclamation-circle mr-1"></i> {{Session::get('failed')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <div class="card mb-4">
        <div class="card-body">
            <!--<a href="{{ route('admin.mahasiswa-create') }}" class="btn btn-primary mb-3"><i class="fa fa-plus-circle mr-1"></i>Tambah mahasiswa</a>-->
            <a href="/export-excel?lengkap={{isset($filter['lengkap']) ? $filter['lengkap'] : ''}}&prodi={{isset($filter['prodi']) ? $filter['prodi'] : ''}}&maba={{isset($filter['maba']) ? $filter['maba'] : ''}}"
            {{-- @if(isset($filter['lengkap']))
                href="/export-excel?lengkap={{$filter['lengkap']}}"
            @else
                href="/export-excel"
            @endif --}}
             class="btn btn-success mb-3"><i class="fa fa-file mr-1"></i>Export Excel</a>
            <hr>
            <form action="/admin-mahasiswa" action="GET">
                <div class="form-group row">
                    <div class="col-md-8 col-sm-12 row">
                        <select name="lengkap" class="form-control col-md-4 ml-3">
                            <option value="">Semua</option>

                            <?php
                                $arr = ['Belum Daftar', 'Mengajukan Pendaftaran', 'Kesalahan (Pendaftaran)', 'Perbaikan (Pendaftaran)',
                                        'Terdaftar', 'Mengajukan Verifikasi', 'Kesalahan (Verifikasi)', 'Perbaikan (Verifikasi)', 'Terverifikasi',
                                        'Mengajukan Perbaikan Biodata'];
                            ?>
                            @foreach($arr as $i => $r)
                                <option value="{{ $i }}"
                                    @if(isset($filter['lengkap']))
                                        @if($i == $filter['lengkap']) selected @endif
                                    @endif
                                >
                                    {{ $r }}
                                </option>
                            @endforeach
                        </select>
                        <select name="prodi" id="prodi" class="form-control col-md-4 ml-3">
                            <option value="">Semua</option>
                            @foreach ($prodis as $prodi)
                                <option value="{{ $prodi->id }}"
                                    @if(isset($filter['prodi']))
                                        @if($prodi->id == $filter['prodi']) selected @endif
                                    @endif
                                >
                                    {{ $prodi->nama }}
                                </option>
                            @endforeach
                        </select>
                        <select name="maba" id="maba" class="form-control col-md-3 ml-3 mr-0">
                            <option value="">Semua</option>
                            <option value="1"
                                @if(isset($filter['maba']))
                                    @if($filter['maba'] == 1) selected @endif
                                @endif
                            >SNMPTN</option>
                            <option value="2"
                                @if(isset($filter['maba']))
                                    @if($filter['maba'] == 2) selected @endif
                                @endif
                            >Mahasiswa Lama</option>
                            <option value="3"
                                @if(isset($filter['maba']))
                                    @if($filter['maba'] == 3) selected @endif
                                @endif
                            >SBMPTN</option>
                            <option value="4"
                                @if(isset($filter['maba']))
                                    @if($filter['maba'] == 4) selected @endif
                                @endif
                            >MANDIRI</option>
                        </select>
                    </div>
                    <div class="col-md-2 col-sm-12">
                        <button type="submit" class="btn btn-primary"><span class="fa fa-filter"></span> Filter</button>
                    </div>
                </div>
            </form>
            <hr>
            <div class="table-responsive">
                <table id="table" class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">NIM</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Prodi</th>
                            <th scope="col">Pengalaman</th>
                            <th>Status</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($data))
                            @foreach ($data as  $i => $mahasiswa)
                                <tr>
                                    <th
                                        data-toggle="modal" data-target="#mahasiswa"
                                        data-profile="{{ $mahasiswa->profile }}"
                                        data-nim=": {{ $mahasiswa->nim }}"
                                        data-krm="{{ $mahasiswa->krm }}"
                                        data-nama=": {{ $mahasiswa->nama }} {{$mahasiswa->koordinator === 1 || $mahasiswa->koordinator === 1 ? '(koordinator)' : ''}}"
                                        data-nama-panggilan=": {{ $mahasiswa->nama_panggilan }}"
                                        data-prodi=": {{ $mahasiswa->prodi['nama'] }}"
                                        data-jenis-kelamin=":{{ $mahasiswa->kelamin['nama'] }} "
                                        data-agama=": {{ $mahasiswa->mhsagama['nama'] }}"
                                        data-gol-darah=":{{ $mahasiswa->goldarah['nama'] }} "
                                        data-tempat-lahir=": {{ $mahasiswa->tempat_lahir }}"
                                        data-tanggal-lahir=": {{ $mahasiswa->tanggal_lahir }}"
                                        data-alamat=": {{ $mahasiswa->alamat }}"
                                        data-alamat-sekarang=": {{ $mahasiswa->alamat_sekarang }}"
                                        data-no-telepon=": {{ $mahasiswa->no_telepon }}"
                                        data-id-line=": {{ $mahasiswa->id_line }}"
                                        data-no-hp=": {{ $mahasiswa->no_hp }}"
                                        data-email=": {{ $mahasiswa->email }}"
                                        data-asal-sekolah=": {{ $mahasiswa->asal_sekolah }}"
                                        data-alasan-kuliah=": {{ $mahasiswa->alasan_kuliah }}"
                                        data-hobi=": {{ $mahasiswa->hobi }}"
                                        data-minat-bakat=": {{ $mahasiswa->minat_bakat }}"
                                        data-cita-cita=": {{ $mahasiswa->cita_cita }}"
                                        data-idola=": {{ $mahasiswa->idola }}"
                                        data-moto=": {{ $mahasiswa->moto }}"
                                        data-jumlah-saudara=": {{ $mahasiswa->jumlah_saudara }}"
                                        data-nama-ayah=": {{ $mahasiswa->nama_ayah }}" }}
                                        data-nama-ibu=": {{ $mahasiswa->nama_ibu }}"
                                        data-vegetarian=":
                                        @if($mahasiswa->vegetarian == 1)
                                           Ya
                                        @elseif($mahasiswa->vegetarian == 2)
                                            Tidak
                                        @else
                                            Belum ditentukan
                                        @endif
                                        "
                                        data-penyakit-khusus=": {{ $mahasiswa->penyakit_khusus }}"
                                        data-mahasiswa-baru=":
                                        @if($mahasiswa->mahasiswa_baru == 1)
                                            SNMPTN
                                        @elseif($mahasiswa->mahasiswa_baru == 2)
                                            Mahasiswa Lama
                                        @elseif($mahasiswa->mahasiswa_baru == 3)
                                            SBMPTN
                                        @elseif($mahasiswa->mahasiswa_baru == 4)
                                            MANDIRI
                                        @else
                                            Belum ditentukan
                                        @endif
                                        "
                                        data-kondisi-mahasiswa={{$mahasiswa->mahasiswa_baru}}
                                        data-angkatan=": {{ $mahasiswa->mhsangkatan['tahun'] }}"
                                        data-youtube="{{ $mahasiswa->youtube }}"
                                        data-scan-penyakit="{{ $mahasiswa->scan_penyakit }}"
                                        data-lengkap="{{ $mahasiswa->lengkap }}"
                                        data-mahasiswa="{{ $mahasiswa->id }}"
                                        style="cursor:pointer"
                                    >{{ $i+1 }}
                                    </th>
                                    <td
                                        data-toggle="modal" data-target="#mahasiswa"
                                        data-profile="{{ $mahasiswa->profile }}"
                                        data-nim=": {{ $mahasiswa->nim }}"
                                        data-krm="{{ $mahasiswa->krm }}"
                                        data-nama=": {{ $mahasiswa->nama }} {{$mahasiswa->koordinator === 1 || $mahasiswa->koordinator === 1 ? '(koordinator)' : ''}}"
                                        data-nama-panggilan=": {{ $mahasiswa->nama_panggilan }}"
                                        data-prodi=": {{ $mahasiswa->prodi['nama'] }}"
                                        data-jenis-kelamin=":
                                        {{ $mahasiswa->kelamin['nama'] }}"
                                        data-agama=":
                                        {{ $mahasiswa->mhsagama['nama'] }}
                                        "
                                        data-gol-darah=":
                                        {{ $mahasiswa->goldarah['nama'] }}
                                        "
                                        data-tempat-lahir=": {{ $mahasiswa->tempat_lahir }}"
                                        data-tanggal-lahir=": {{ $mahasiswa->tanggal_lahir }}"
                                        data-alamat=": {{ $mahasiswa->alamat }}"
                                        data-alamat-sekarang=": {{ $mahasiswa->alamat_sekarang }}"
                                        data-no-telepon=": {{ $mahasiswa->no_telepon }}"
                                        data-id-line=": {{ $mahasiswa->id_line }}"
                                        data-no-hp=": {{ $mahasiswa->no_hp }}"
                                        data-email=": {{ $mahasiswa->email }}"
                                        data-asal-sekolah=": {{ $mahasiswa->asal_sekolah }}"
                                        data-alasan-kuliah=": {{ $mahasiswa->alasan_kuliah }}"
                                        data-hobi=": {{ $mahasiswa->hobi }}"
                                        data-minat-bakat=": {{ $mahasiswa->minat_bakat }}"
                                        data-cita-cita=": {{ $mahasiswa->cita_cita }}"
                                        data-idola=": {{ $mahasiswa->idola }}"
                                        data-moto=": {{ $mahasiswa->moto }}"
                                        data-jumlah-saudara=": {{ $mahasiswa->jumlah_saudara }}"
                                        data-nama-ayah=": {{ $mahasiswa->nama_ayah }}" }}
                                        data-nama-ibu=": {{ $mahasiswa->nama_ibu }}"
                                        data-vegetarian=":
                                        @if($mahasiswa->mahasiswa_baru == 1)
                                            SNMPTN
                                        @elseif($mahasiswa->mahasiswa_baru == 2)
                                            Mahasiswa Lama
                                        @elseif($mahasiswa->mahasiswa_baru == 3)
                                            SBMPTN
                                        @elseif($mahasiswa->mahasiswa_baru == 4)
                                            MANDIRI
                                        @else
                                            Belum ditentukan
                                        @endif
                                        "
                                        data-kondisi-mahasiswa={{$mahasiswa->mahasiswa_baru}}
                                        data-penyakit-khusus=": {{ $mahasiswa->penyakit_khusus }}"
                                        data-mahasiswa-baru=":
                                        @if($mahasiswa->mahasiswa_baru == 1)
                                            Ya
                                        @elseif($mahasiswa->mahasiswa_baru == 2)
                                            Tidak
                                        @else
                                            Belum ditentukan
                                        @endif
                                        "
                                        data-angkatan=": {{ $mahasiswa->mhsangkatan['tahun'] }}"
                                        data-youtube="{{ $mahasiswa->youtube }}"
                                        data-scan-penyakit="{{ $mahasiswa->scan_penyakit }}"
                                        data-lengkap="{{ $mahasiswa->lengkap }}"
                                        data-mahasiswa="{{ $mahasiswa->id }}"
                                        data-bukti-pembayaran="{{ $mahasiswa->bukti_pembayaran }}"

                                        style="cursor:pointer"
                                    >
                                        {{ $mahasiswa->nim }}
                                    </td>
                                    <td
                                        data-toggle="modal" data-target="#mahasiswa"
                                        data-profile="{{ $mahasiswa->profile }}"
                                        data-nim=": {{ $mahasiswa->nim }}"
                                        data-krm="{{ $mahasiswa->krm }}"
                                        data-nama=": {{ $mahasiswa->nama }} {{$mahasiswa->koordinator === 1 || $mahasiswa->koordinator === 1 ? '(koordinator)' : ''}}"
                                        data-nama-panggilan=": {{ $mahasiswa->nama_panggilan }}"
                                        data-prodi=": {{ $mahasiswa->prodi['nama'] }}"
                                        data-jenis-kelamin=":
                                        {{ $mahasiswa->kelamin['nama'] }}"
                                        data-agama=":
                                        {{ $mahasiswa->mhsagama['nama'] }}
                                        "
                                        data-gol-darah=":
                                        {{ $mahasiswa->goldarah['nama'] }}
                                        "
                                        data-tempat-lahir=": {{ $mahasiswa->tempat_lahir }}"
                                        data-tanggal-lahir=": {{ $mahasiswa->tanggal_lahir }}"
                                        data-alamat=": {{ $mahasiswa->alamat }}"
                                        data-alamat-sekarang=": {{ $mahasiswa->alamat_sekarang }}"
                                        data-no-telepon=": {{ $mahasiswa->no_telepon }}"
                                        data-id-line=": {{ $mahasiswa->id_line }}"
                                        data-no-hp=": {{ $mahasiswa->no_hp }}"
                                        data-email=": {{ $mahasiswa->email }}"
                                        data-asal-sekolah=": {{ $mahasiswa->asal_sekolah }}"
                                        data-alasan-kuliah=": {{ $mahasiswa->alasan_kuliah }}"
                                        data-hobi=": {{ $mahasiswa->hobi }}"
                                        data-minat-bakat=": {{ $mahasiswa->minat_bakat }}"
                                        data-cita-cita=": {{ $mahasiswa->cita_cita }}"
                                        data-idola=": {{ $mahasiswa->idola }}"
                                        data-moto=": {{ $mahasiswa->moto }}"
                                        data-jumlah-saudara=": {{ $mahasiswa->jumlah_saudara }}"
                                        data-nama-ayah=": {{ $mahasiswa->nama_ayah }}" }}
                                        data-nama-ibu=": {{ $mahasiswa->nama_ibu }}"
                                        data-vegetarian=":
                                        @if($mahasiswa->vegetarian == 1)
                                           Ya
                                        @elseif($mahasiswa->vegetarian == 2)
                                            Tidak
                                        @else
                                            Belum ditentukan
                                        @endif
                                        "
                                        data-penyakit-khusus=": {{ $mahasiswa->penyakit_khusus }}"
                                        data-mahasiswa-baru=":
                                        @if($mahasiswa->mahasiswa_baru == 1)
                                            SNMPTN
                                        @elseif($mahasiswa->mahasiswa_baru == 2)
                                            Mahasiswa Lama
                                        @elseif($mahasiswa->mahasiswa_baru == 3)
                                            SBMPTN
                                        @elseif($mahasiswa->mahasiswa_baru == 4)
                                            MANDIRI
                                        @else
                                            Belum ditentukan
                                        @endif
                                        "
                                        data-kondisi-mahasiswa={{$mahasiswa->mahasiswa_baru}}
                                        data-angkatan=": {{ $mahasiswa->mhsangkatan['tahun'] }}"
                                        data-youtube="{{ $mahasiswa->youtube }}"
                                        data-scan-penyakit="{{ $mahasiswa->scan_penyakit }}"
                                        data-lengkap="{{ $mahasiswa->lengkap }}"
                                        data-mahasiswa="{{ $mahasiswa->id }}"
                                        data-bukti-pembayaran="{{ $mahasiswa->bukti_pembayaran }}"

                                        style="cursor:pointer"
                                    >
                                        {{ $mahasiswa->nama }} <strong>{{$mahasiswa->koordinator === 1 || $mahasiswa->koordinator === 1 ? '(koordinator)' : ''}}</strong>
                                    </td>
                                    <td
                                        data-toggle="modal" data-target="#mahasiswa"
                                        data-profile="{{ $mahasiswa->profile }}"
                                        data-nim=": {{ $mahasiswa->nim }}"
                                        data-krm="{{ $mahasiswa->krm }}"
                                        data-nama=": {{ $mahasiswa->nama }} {{$mahasiswa->koordinator === 1 || $mahasiswa->koordinator === 1 ? '(koordinator)' : ''}}"
                                        data-nama-panggilan=": {{ $mahasiswa->nama_panggilan }}"
                                        data-prodi=": {{ $mahasiswa->prodi['nama'] }}"
                                        data-jenis-kelamin=":
                                        {{ $mahasiswa->kelamin['nama'] }}"
                                        data-agama=":
                                        {{ $mahasiswa->mhsagama['nama'] }}
                                        "
                                        data-gol-darah=":
                                        {{ $mahasiswa->goldarah['nama'] }}
                                        "
                                        data-tempat-lahir=": {{ $mahasiswa->tempat_lahir }}"
                                        data-tanggal-lahir=": {{ $mahasiswa->tanggal_lahir }}"
                                        data-alamat=": {{ $mahasiswa->alamat }}"
                                        data-alamat-sekarang=": {{ $mahasiswa->alamat_sekarang }}"
                                        data-no-telepon=": {{ $mahasiswa->no_telepon }}"
                                        data-id-line=": {{ $mahasiswa->id_line }}"
                                        data-no-hp=": {{ $mahasiswa->no_hp }}"
                                        data-email=": {{ $mahasiswa->email }}"
                                        data-asal-sekolah=": {{ $mahasiswa->asal_sekolah }}"
                                        data-alasan-kuliah=": {{ $mahasiswa->alasan_kuliah }}"
                                        data-hobi=": {{ $mahasiswa->hobi }}"
                                        data-minat-bakat=": {{ $mahasiswa->minat_bakat }}"
                                        data-cita-cita=": {{ $mahasiswa->cita_cita }}"
                                        data-idola=": {{ $mahasiswa->idola }}"
                                        data-moto=": {{ $mahasiswa->moto }}"
                                        data-jumlah-saudara=": {{ $mahasiswa->jumlah_saudara }}"
                                        data-nama-ayah=": {{ $mahasiswa->nama_ayah }}" }}
                                        data-nama-ibu=": {{ $mahasiswa->nama_ibu }}"
                                        data-vegetarian=":
                                        @if($mahasiswa->vegetarian == 1)
                                           Ya
                                        @elseif($mahasiswa->vegetarian == 2)
                                            Tidak
                                        @else
                                            Belum ditentukan
                                        @endif
                                        "
                                        data-penyakit-khusus=": {{ $mahasiswa->penyakit_khusus }}"
                                        data-mahasiswa-baru=":
                                        @if($mahasiswa->mahasiswa_baru == 1)
                                            SNMPTN
                                        @elseif($mahasiswa->mahasiswa_baru == 2)
                                            Mahasiswa Lama
                                        @elseif($mahasiswa->mahasiswa_baru == 3)
                                            SBMPTN
                                        @elseif($mahasiswa->mahasiswa_baru == 4)
                                            MANDIRI
                                        @else
                                            Belum ditentukan
                                        @endif
                                        "
                                        data-kondisi-mahasiswa={{$mahasiswa->mahasiswa_baru}}
                                        data-angkatan=": {{ $mahasiswa->mhsangkatan['tahun'] }}"
                                        data-youtube="{{ $mahasiswa->youtube }}"
                                        data-scan-penyakit="{{ $mahasiswa->scan_penyakit }}"
                                        data-lengkap="{{ $mahasiswa->lengkap }}"
                                        data-mahasiswa="{{ $mahasiswa->id }}"
                                        data-bukti-pembayaran="{{ $mahasiswa->bukti_pembayaran }}"

                                        style="cursor:pointer"
                                    >
                                        {{ $mahasiswa->prodi['nama'] }}
                                    </td>
                                    <td>
                                        <a href="/prestasis/{{ $mahasiswa->id }}" class="btn btn-success btn-sm" ><i class="fa fa-trophy"></i> Prestasi</a>
                                        <a href="/organisasi/{{ $mahasiswa->id }}" class="btn btn-success btn-sm"><i class="fa fa-building"></i> Organisasi</a>
                                    </td>
                                    <td
                                        data-toggle="modal" data-target="#mahasiswa"
                                        data-profile="{{ $mahasiswa->profile }}"
                                        data-nim=": {{ $mahasiswa->nim }}"
                                        data-krm="{{ $mahasiswa->krm }}"
                                        data-nama=": {{ $mahasiswa->nama }} {{$mahasiswa->koordinator === 1 || $mahasiswa->koordinator === 1 ? '(koordinator)' : ''}}"
                                        data-nama-panggilan=": {{ $mahasiswa->nama_panggilan }}"
                                        data-prodi=": {{ $mahasiswa->prodi['nama'] }}"
                                        data-jenis-kelamin=":
                                        {{ $mahasiswa->kelamin['nama'] }}"
                                        data-agama=":
                                        {{ $mahasiswa->mhsagama['nama'] }}
                                        "
                                        data-gol-darah=":
                                        {{ $mahasiswa->goldarah['nama'] }}
                                        "
                                        data-tempat-lahir=": {{ $mahasiswa->tempat_lahir }}"
                                        data-tanggal-lahir=": {{ $mahasiswa->tanggal_lahir }}"
                                        data-alamat=": {{ $mahasiswa->alamat }}"
                                        data-alamat-sekarang=": {{ $mahasiswa->alamat_sekarang }}"
                                        data-no-telepon=": {{ $mahasiswa->no_telepon }}"
                                        data-id-line=": {{ $mahasiswa->id_line }}"
                                        data-no-hp=": {{ $mahasiswa->no_hp }}"
                                        data-email=": {{ $mahasiswa->email }}"
                                        data-asal-sekolah=": {{ $mahasiswa->asal_sekolah }}"
                                        data-alasan-kuliah=": {{ $mahasiswa->alasan_kuliah }}"
                                        data-hobi=": {{ $mahasiswa->hobi }}"
                                        data-minat-bakat=": {{ $mahasiswa->minat_bakat }}"
                                        data-cita-cita=": {{ $mahasiswa->cita_cita }}"
                                        data-idola=": {{ $mahasiswa->idola }}"
                                        data-moto=": {{ $mahasiswa->moto }}"
                                        data-jumlah-saudara=": {{ $mahasiswa->jumlah_saudara }}"
                                        data-nama-ayah=": {{ $mahasiswa->nama_ayah }}" }}
                                        data-nama-ibu=": {{ $mahasiswa->nama_ibu }}"
                                        data-vegetarian=":
                                        @if($mahasiswa->vegetarian == 1)
                                           Ya
                                        @elseif($mahasiswa->vegetarian == 2)
                                            Tidak
                                        @else
                                            Belum ditentukan
                                        @endif
                                        "
                                        data-penyakit-khusus=": {{ $mahasiswa->penyakit_khusus }}"
                                        data-mahasiswa-baru=":
                                        @if($mahasiswa->mahasiswa_baru == 1)
                                            SNMPTN
                                        @elseif($mahasiswa->mahasiswa_baru == 2)
                                            Mahasiswa Lama
                                        @elseif($mahasiswa->mahasiswa_baru == 3)
                                            SBMPTN
                                        @elseif($mahasiswa->mahasiswa_baru == 4)
                                            MANDIRI
                                        @else
                                            Belum ditentukan
                                        @endif
                                        "
                                        data-kondisi-mahasiswa={{$mahasiswa->mahasiswa_baru}}
                                        data-angkatan=": {{ $mahasiswa->mhsangkatan['tahun'] }}"
                                        data-youtube="{{ $mahasiswa->youtube }}"
                                        data-scan-penyakit="{{ $mahasiswa->scan_penyakit }}"
                                        data-lengkap="{{ $mahasiswa->lengkap }}"
                                        data-mahasiswa="{{ $mahasiswa->id }}"
                                        data-bukti-pembayaran="{{ $mahasiswa->bukti_pembayaran }}"

                                        style="cursor:pointer"
                                    >
                                        @if($mahasiswa->lengkap === '0')
                                            Belum Daftar
                                        @elseif($mahasiswa->lengkap === '1')
                                            Mengajukan Pendaftaran
                                        @elseif($mahasiswa->lengkap === '2')
                                            Kesalahan (Pendaftaran)
                                        @elseif($mahasiswa->lengkap === '3')
                                            Perbaikan (Pendaftaran)
                                        @elseif($mahasiswa->lengkap === '4')
                                            Terdaftar
                                        @elseif($mahasiswa->lengkap === '5')
                                            Mengajukan Verifikasi
                                        @elseif($mahasiswa->lengkap === '6')
                                            Kesalahan (Verifikasi)
                                        @elseif($mahasiswa->lengkap === '7')
                                            Perbaikan (Verifikasi)
                                        @elseif($mahasiswa->lengkap === '8')
                                            Terverifikasi
                                        @elseif($mahasiswa->lengkap === '9')
                                            Mengajukan Perbaikan Biodata
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>
                                        <!-- log Buton -->
                                        <a style="margin-bottom: 3px; display: block;" href="/log/{{ $mahasiswa->id }}" class="btn btn-info btn-sm"><i class="fa fa-list"></i> Log</a>
                                        <!-- Edit Buton -->
                                        <!--<a style="margin-bottom: 3px; display: block;" href="{{ route('admin.mahasiswa-edit', $mahasiswa->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Edit</a>-->
                                        <!-- Note Buton -->
                                        <a style="margin-bottom: 3px; display: block;" href="/note/{{ $mahasiswa->id }}" class="btn btn-secondary btn-sm"><i class="fa fa-sticky-note"></i> Note</a>
                                        <a style="margin-bottom: 3px; display: block;" href="/penugasan/{{ $mahasiswa->id }}" class="btn btn-success btn-sm"><i class="fa fa-sticky-note"></i> Tugas</a>
                                        {{-- @if($mahasiswa->youtube != null)
                                        <button style="margin-bottom: 3px;" data-toggle="modal" data-target="#youtube" class="btn btn-block btn-danger btn-sm"
                                        data-youtube="{{ $mahasiswa->youtube }}">
                                            <i class="fab fa-youtube"></i>
                                            Youtube
                                        </button>
                                        @endif
                                        @if($mahasiswa->penyakit_khusus != null)
                                            <a style="margin-bottom: 3px; display: block;" href="/beranda-sd-verifikasi-scan-download/{{$mahasiswa->id}}" class="btn btn-success btn-sm"><i class="fa fa-ambulance"></i> Surat Sakit</a>
                                        @endif --}}
                                        <!--Delete Button
                                        <button data-toggle="modal" data-target="#delete" class="btn btn-block btn-danger btn-sm"
                                        data-nim=": {{ $mahasiswa->nim }}"
                                        data-nama=": {{ $mahasiswa->nama }}"
                                        data-prodi=": {{ $mahasiswa->prodi['nama'] }}">
                                            <i class="fa fa-trash"></i>
                                            Hapus
                                        </button>-->
                                        <!-- Delete Modal -->
                                        <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-trash text-danger"></i> Konfirmasi Hapus</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p class="text-center">Apakah Anda yakin menghapus data berikut?</p>
                                                        <div class="row justify-content-center">
                                                            <table class="table-borderless">
                                                                <tr>
                                                                    <td class="font-weight-bold" style="width: 50%;">NIM</td>
                                                                    <td id="nim"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="font-weight-bold">Nama</td>
                                                                    <td id="nama"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="font-weight-bold">Program Studi</td>
                                                                    <td id="prodi"></td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Tidak</button>
                                                        <form action="{{ route('admin.mahasiswa-delete', $mahasiswa->id) }}" method="post">
                                                            {{ csrf_field() }}
                                                            {{method_field('DELETE')}}
                                                            <button type="submit" class="btn btn-danger"><i class="fa fa-check"></i> Ya</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Delete Modal -->
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Show -->
    <div class="modal fade" id="mahasiswa" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-body" id="exampleModalCenterTitle"><i class="fa fa-info-circle"></i> Info Mahasiswa</h5>
                    <ul class="nav nav-pills mx-2" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="pills-biodata-tab" data-toggle="pill" href="#pills-biodata" role="tab" aria-controls="pills-home" aria-selected="true">Biodata</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-verifikasi-tab" data-toggle="pill" href="#pills-verifikasi" role="tab" aria-controls="pills-profile" aria-selected="false">Verifikasi</a>
                        </li>
                    </ul>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-biodata" role="tabpanel" aria-labelledby="pills-biodata-tab">
                        {{-- <form action="#" class="form-group" method="get"> --}}
                            <div class="modal-body">
                                <table class="table table-borderless">
                                    <tbody>
                                        <tr>
                                            <img id="foto-show" style="border-style:solid;height: 200px; width: 150px; margin-left:150px;" src="" alt="">
                                        </tr>
                                        <tr>
                                            <td>NIM</td>
                                            <td id="nim-show"></td>
                                        </tr>
                                        <tr>
                                            <td>KRM</td>
                                            <td id="krm-show"></td>
                                        </tr>
                                        <tr>
                                            <td>Nama</td>
                                            <td id="nama-show"></td>
                                        </tr>
                                        <tr>
                                            <td>Nama Panggilan</td>
                                            <td id="nama-panggilan-show"></td>
                                        </tr>
                                        <tr>
                                            <td>Program Studi</td>
                                            <td id="prodi-show"></td>
                                        </tr>
                                        <tr>
                                            <td>Jenis Kelamin</td>
                                            <td id="jenis-kelamin-show"></td>
                                        </tr>
                                        <tr>
                                            <td>Agama</td>
                                            <td id="agama-show"></td>
                                        </tr>
                                        <tr>
                                            <td>Gol. Darah</td>
                                            <td id="gol-darah-show"></td>
                                        </tr>
                                        <tr>
                                            <td>Tempat Lahir</td>
                                            <td id="tempat-lahir-show"></td>
                                        </tr>
                                        <tr>
                                            <td>Tanggal Lahir</td>
                                            <td id="tanggal-lahir-show"></td>
                                        </tr>
                                        <tr>
                                            <td>Alamat</td>
                                            <td id="alamat-show"></td>
                                        </tr>
                                        <tr>
                                            <td>Alamat Sekarang</td>
                                            <td id="alamat-sekarang-show"></td>
                                        </tr>
                                        <tr>
                                            <td>No. Telepon</td>
                                            <td id="no-telepon-show"></td>
                                        </tr>
                                        <tr>
                                            <td>ID Line</td>
                                            <td id="id-line-show"></td>
                                        </tr>
                                        <tr>
                                            <td>No. HP</td>
                                            <td id="no-hp-show"></td>
                                        </tr>
                                        <tr>
                                            <td>Email</td>
                                            <td id="email-show"></td>
                                        </tr>
                                        <tr>
                                            <td>Asal Sekolah</td>
                                            <td id="asal-sekolah-show"></td>
                                        </tr>
                                        <tr>
                                            <td>Alasan Kuliah</td>
                                            <td id="alasan-kuliah-show"></td>
                                        </tr>
                                        <tr>
                                            <td>Hobi</td>
                                            <td id="hobi-show"></td>
                                        </tr>
                                        <tr>
                                            <td>Minat Bakat</td>
                                            <td id="minat-bakat-show"></td>
                                        </tr>
                                        <tr>
                                            <td>Cita-cita</td>
                                            <td id="cita-cita-show"></td>
                                        </tr>
                                        <tr>
                                            <td>Idola</td>
                                            <td id="idola-show"></td>
                                        </tr>
                                        <tr>
                                            <td>Moto</td>
                                            <td id="moto-show"></td>
                                        </tr>
                                        <tr>
                                            <td>Jumlah Saudara</td>
                                            <td id="jumlah-saudara-show"></td>
                                        </tr>
                                        <tr>
                                            <td>Nama Ayah</td>
                                            <td id="nama-ayah-show"></td>
                                        </tr>
                                        <tr>
                                            <td>Nama Ibu</td>
                                            <td id="nama-ibu-show"></td>
                                        </tr>
                                        {{-- <tr>
                                            <td>Vegetarian</td>
                                            <td id="vegetarian-show"></td>
                                        </tr> --}}
                                        <tr>
                                            <td>Penyakit khusus</td>
                                            <td id="penyakit-khusus-show"></td>
                                        </tr>
                                        <tr>
                                            <td>Jalur Masuk</td>
                                            <td id="mahasiswa-baru-show">:

                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Angkatan</td>
                                            <td id="angkatan-show"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="modal-footer" id="modal-footer-register">
                                <form id="formnoteregist" action="#" method="post" class="col-12 px-0">
                                    <div class="input">
                                        <div class="inputform"></div>
                                        <div class="buttonform">
                                            <div class="float-left col-3 px-0"></div>
                                            <div class="float-right d-inline px-0">
                                                <div class="modal-regist d-inline"></div>
                                                {{ csrf_field() }}
                                                <div class="btn-close d-inline"><button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button></div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        {{-- </form> --}}
                    </div>

                    <div class="tab-pane fade" id="pills-verifikasi" role="tabpanel" aria-labelledby="pills-verifikasi-tab">
                        <div class="modal-body" style="align:center;">
                            <iframe id="youtube" width="470" height="250" src="" frameborder="0" allowfullscreen></iframe>

                            <a id="link-youtube-mahasiswa" style="margin-bottom: 3px; display: block;" href="#" class="btn btn-block btn-danger btn-sm" target="_blank">
                                <i class="fab fa-youtube"></i>
                                 Youtube
                            </a>

                            <a id="scan-penyakit-mahasiswa" style="margin-bottom: 3px; display: block;" href="#" class="btn btn-success btn-sm">
                                <i class="fa fa-ambulance"></i>
                                 Surat Sakit
                            </a>

                            <a id="link-bukti-pembayaran" style="margin-bottom: 3px; display: block;" href="#" class="btn btn-block btn-secondary btn-sm">
                                <i class="fa fa-file-pdf"></i>
                                 Bukti Pembayaran
                            </a>
                        </div>
                        <div class="modal-footer" id="modal-footer-verifikasi">
                            <form id="formnoteverify" action="#" method="post" class="col-12 px-0">
                                <div class="input">
                                    <div class="inputform"></div>
                                    <div class="buttonform">
                                        <div class="float-left col-3 px-0"></div>
                                        <div class="float-right d-inline px-0">
                                            <div class="modal-verify d-inline"></div>
                                            {{ csrf_field() }}
                                            <div class="btn-close d-inline"><button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button></div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal -->

    <!-- Modal Show -->
    <div class="modal fade" id="modal-registrasi" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-body" id="exampleModalCenterTitle"><i class="fa fa-save mr-1"></i>Terima Pendaftaran</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                    <div class="modal-body" style="align:center;">
                        Apakah Anda yakin menerima pendaftaran mahasiswa?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Tidak</button>
                        <a id="btn-regist-accept" href="#" class="btn btn-success"><i class="fa fa-save"></i> Ya</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal Delete -->

    <!-- Modal Show -->
    <div class="modal fade" id="modal-verifikasi" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-body" id="exampleModalCenterTitle"><i class="fa fa-save mr-1"></i>Terima Verifikasi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                    <div class="modal-body" style="align:center;">
                        Apakah Anda yakin meverifikasi mahasiswa?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Tidak</button>
                        <a id="btn-verif-accept" href="#" class="btn btn-success"><i class="fa fa-save"></i> Ya</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal Delete -->


    <!-- Modal Show -->
    <div class="modal fade" id="modal-note" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-body" id="exampleModalCenterTitle"><i class="fa fa-save mr-1"></i> Note Kesalahan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                    <div class="modal-body" style="align:center;">
                        Apakah Anda yakin mengirimkan note kesalahan?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Tidak</button>
                        <a id="btn-note-accept" href="#" class="btn btn-success"><i class="fa fa-save"></i> Ya</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal Delete -->


    <!-- Youtube Modal -->
    {{-- <div id="youtube" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Link Youtube</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body" style="align:center;">
                    <iframe id="youtube" width="470" height="250" src="" frameborder="0" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- End Modal -->
@endsection

@section('custom_javascript')
    <script>
        function gantilinkyoutube(link){
            var link = link;
            var ganti = link.replace('https://www.youtube.com/embed/','https://youtu.be/');
            return ganti;
        }
        $('#mahasiswa').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var foto = button.data('profile')
            var nim = button.data('nim')
            var nama = button.data('nama')
            var nama_panggilan = button.data('nama-panggilan')
            var prodi = button.data('prodi')
            var jenis_kelamin = button.data('jenis-kelamin')
            var agama = button.data('agama')
            var gol_darah = button.data('gol-darah')
            var tempat_lahir = button.data('tempat-lahir')
            var tanggal_lahir = button.data('tanggal-lahir')
            var alamat = button.data('alamat')
            var alamat_sekarang = button.data('alamat-sekarang')
            var no_telepon = button.data('no-telepon')
            var id_line = button.data('id-line')
            var no_hp = button.data('no-hp')
            var email = button.data('email')
            var asal_sekolah = button.data('asal-sekolah')
            var alasan_kuliah = button.data('alasan-kuliah')
            var hobi = button.data('hobi')
            var minat_bakat = button.data('minat-bakat')
            var cita_cita = button.data('cita-cita')
            var idola = button.data('idola')
            var moto = button.data('moto')
            var jumlah_saudara = button.data('jumlah-saudara')
            var nama_ayah = button.data('nama-ayah')
            var nama_ibu = button.data('nama-ibu')
            // var vegetarian = button.data('vegetarian')
            var penyakit_khusus = button.data('penyakit-khusus')
            var mahasiswa_baru = button.data('mahasiswa-baru')
            var angkatan = button.data('angkatan')
            var modal = $(this)
            var youtube = button.data('youtube')
            var scan_penyakit = button.data('scan-penyakit')
            var lengkap = button.data('lengkap')
            var mahasiswaid = button.data('mahasiswa')
            var krm = button.data('krm')
            var bukti_pembayaran = button.data('bukti-pembayaran')
            var kondisi_mahasiswa = button.data('kondisi-mahasiswa')

            modal.find('.modal-body #youtube').attr("src",youtube);
            modal.find('.modal-body #foto-show').attr("src",'/public/'+foto);
            modal.find('.modal-body #nim-show').text(nim)
            modal.find('.modal-body #nama-show').text(nama)
            modal.find('.modal-body #nama-panggilan-show').text(nama_panggilan)
            modal.find('.modal-body #prodi-show').text(prodi)
            modal.find('.modal-body #jenis-kelamin-show').text(jenis_kelamin)
            modal.find('.modal-body #agama-show').text(agama)
            modal.find('.modal-body #gol-darah-show').text(gol_darah)
            modal.find('.modal-body #tempat-lahir-show').text(tempat_lahir)
            modal.find('.modal-body #tanggal-lahir-show').text(tanggal_lahir)
            modal.find('.modal-body #alamat-show').text(alamat)
            modal.find('.modal-body #alamat-sekarang-show').text(alamat_sekarang)
            modal.find('.modal-body #no-telepon-show').text(no_telepon)
            modal.find('.modal-body #id-line-show').text(id_line)
            modal.find('.modal-body #no-hp-show').text(no_hp)
            modal.find('.modal-body #email-show').text(email)
            modal.find('.modal-body #asal-sekolah-show').text(asal_sekolah)
            modal.find('.modal-body #alasan-kuliah-show').text(alasan_kuliah)
            modal.find('.modal-body #hobi-show').text(hobi)
            modal.find('.modal-body #minat-bakat-show').text(minat_bakat)
            modal.find('.modal-body #cita-cita-show').text(cita_cita)
            modal.find('.modal-body #idola-show').text(idola)
            modal.find('.modal-body #moto-show').text(moto)
            modal.find('.modal-body #jumlah-saudara-show').text(jumlah_saudara)
            modal.find('.modal-body #nama-ayah-show').text(nama_ayah)
            modal.find('.modal-body #nama-ibu-show').text(nama_ibu)
            // modal.find('.modal-body #vegetarian-show').text(vegetarian)
            modal.find('.modal-body #penyakit-khusus-show').text(penyakit_khusus)
            modal.find('.modal-body #mahasiswa-baru-show').text(mahasiswa_baru)
            modal.find('.modal-body #angkatan-show').text(angkatan)
            if(kondisi_mahasiswa === 1){
                modal.find('#pills-verifikasi .modal-body #link-bukti-pembayaran').css('display', 'none')
            }else{
                modal.find('#pills-verifikasi .modal-body #link-bukti-pembayaran').css('display', 'block')

                if(bukti_pembayaran === ""){
                    modal.find('#pills-verifikasi .modal-body #link-bukti-pembayaran').attr('href', '#')
                }else{
                    modal.find('#pills-verifikasi .modal-body #link-bukti-pembayaran').attr('href', '/admin-mahasiswa/'+mahasiswaid+'/download/bukti-pembayaran')
                }
            }

            if(youtube === ""){
                modal.find('#pills-verifikasi .modal-body #link-youtube-mahasiswa').attr('href','#')
            }else{
                modal.find('#pills-verifikasi .modal-body #link-youtube-mahasiswa').attr('href',gantilinkyoutube(youtube))
            }

            if(scan_penyakit === ""){
                modal.find('#pills-verifikasi .modal-body #scan-penyakit-mahasiswa').attr('href','#')
            }else{
                modal.find('#pills-verifikasi .modal-body #scan-penyakit-mahasiswa').attr('href','/admin-mahasiswa/'+mahasiswaid+'/download/surat-sakit')
            }

            if(krm === ""){
                modal.find('.modal-body #krm-show').text('-')
            }else{
                modal.find('.modal-body #krm-show').html(': <a href="/admin-get/krm/'+mahasiswaid+'">Download KRM</a>')
            }
            if(lengkap == 1 || lengkap == 2 || lengkap == 3 || lengkap == 9){
                // console.log(lengkap);
                $('#modal-footer-register form').attr('action', '/admin-mahasiswa/'+mahasiswaid+'/note-register');
                $('#modal-footer-register form .input .inputform').html('<input type="text" name="note" id="note" class="col-12"><small>* Isi form hanya jika terdapat kesalahan oleh peserta.</small><hr>');
                $('#modal-footer-register form .input .buttonform .float-left').html('<button id="btn-note-regis" type="submit" class="btn btn-danger"><i class="fa fa-exclamation-circle"></i> Kirim Note</button>');
                // $('#modal-footer-register form .input .buttonform .float-left').html('<button id="btn-note-regis" type="submit" class="btn btn-danger"><i class="fa fa-exclamation-circle"></i> Kirim Note</button>');
                $('#modal-footer-register form .input .buttonform .float-right .modal-regist').html('<button class="btn btn-success" type="button" data-toggle="modal" data-target="#modal-registrasi"><i name="verif" class="fa fa-save"></i> Terima Pendaftaran</button>')
                $('#btn-regist-accept').attr('href', '/admin-mahasiswa/'+mahasiswaid+'/registered');
            }else if(lengkap == 5 || lengkap == 6 || lengkap == 7){
              //<textarea class="form-control" id="note" name="note" rows="3"></textarea>
                $('#modal-footer-verifikasi form').attr('action', '/admin-mahasiswa/'+mahasiswaid+'/note-verifikasi');
                $('#modal-footer-verifikasi form .input .inputform').html('<textarea class="form-control" id="note" name="note" rows="2" placeholder="Form Note dari Admin Sekre"></textarea><textarea class="form-control mt-3" id="note_ilmiah" name="note_ilmiah" rows="2" placeholder="Form Notes dari Admin Ilmiah..."></textarea><small>* Isi form hanya jika terdapat kesalahan oleh peserta.</small><hr>');
                $('#modal-footer-verifikasi form .input .buttonform .float-left').html('<button id="btn-note-verif" type="submit" class="btn btn-danger"><i class="fa fa-exclamation-circle"></i> Kirim Note</button>');
                $('#modal-footer-verifikasi form .input .buttonform .float-right .modal-verify').html('<button class="btn btn-success" type="button" data-toggle="modal" data-target="#modal-verifikasi"><i name="verif" class="fa fa-save"></i> Verifikasi</button>');
                $('#btn-verif-accept').attr('href', '/admin-mahasiswa/'+mahasiswaid+'/verify');
            }
        })
    </script>

    <script>
        $('#delete').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var nim = button.data('nim')
            var nama = button.data('nama')
            var prodi = button.data('prodi')
            var modal = $(this)
            modal.find('.modal-body #nim').text(nim)
            modal.find('.modal-body #nama').text(nama)
            modal.find('.modal-body #prodi').text(prodi)
        })
    </script>

    <script>
        $(document).ready(function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(this).on('submit','#formnoteregist',function(event){
                event.preventDefault();
                var formData = new FormData(this);
                var url = this.action;
                var x = $('#modal-note').modal('show');

                $('#btn-note-accept').on('click', function(e){
                    $.ajax({
                        url: url,
                        type: 'POST',
                        data:formData,
                        async : true,
                        contentType: false,
                        cache: false,
                        processData:false,
                        success: function(data){
                            if(data){
                                window.location.href = data;
                            }else{
                                window.location.href = data;
                            }
                        },
                        error: function(data){
                            alert('gagal');
                            console.log(data)
                        },
                    });
                });
            });

            $(this).on('submit','#formnoteverify',function(event){
                event.preventDefault();
                var formData = new FormData(this);
                var url = this.action;
                var x = $('#modal-note').modal('show');

                $('#btn-note-accept').on('click', function(e){
                    $.ajax({
                        url: url,
                        type: 'POST',
                        data:formData,
                        async : true,
                        contentType: false,
                        cache: false,
                        processData:false,
                        success: function(data){
                            if(data){
                                window.location.href = data;
                            }else{
                                window.location.reload();
                            }
                        },
                        error: function(data){
                            alert('gagal');
                            console.log(data)
                        },
                    });
                });
            });
        });
    </script>

    <script>
        $('#youtube').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var youtube = button.data('youtube')
            var modal = $(this)
            modal.find('.modal-body #youtube').attr("src",youtube);
        });

        $(function(){
            $('body').on('hidden.bs.modal', function(e){
                var $iframes = $(e.target).find('iframe');
                $iframes.each(function(index, iframe){
                    $(iframe).attr('src', $(iframe).attr('src'));
                });
            });
        })
    </script>
@endsection
