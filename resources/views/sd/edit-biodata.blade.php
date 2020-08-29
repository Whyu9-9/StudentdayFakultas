
@extends('layouts.beranda-layout')

@section('active2')
    active
@endsection

@section('content')
    <h2 class="mb-4"><i class="fa fa-user"></i> Edit Biodata</h2>  
    @if (Session::has('errors'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fa fa-exclamation-circle"></i> {{ Session::get('error') }}
            <button type="button" class="close" data-dismiss="alert" arial-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if(Session::has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="text-success fas fa-check mr-1"></i> {{Session::get('success')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if(Auth::user()->mahasiswa_baru <3)
    <div class="card mb-4">
        <div class="card-body">
            <form action="{{ route('beranda-sd.update', Auth::user()->id) }}" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-8 px-5">
                        <p> <b>Perhatian! Nama yang diinputkan akan dipakai sebagai nama pada sertifikat Student Day</b> </p>
                    {{-- @foreach ($datas as $data) --}}
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <td><label for="nim">NIM</label></td>
                                        <td>
                                            <input type="text" class="form-control" name="nim" id="nim" value="{{ $data['nim'] }}" disabled required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="krm">KRM (PDF*)</label></td>
                                        <td>
                                            <div class="col-12 px-0">
                                                <input type="file" class="custom-file-input berkas" id="krm" name="krm">
                                                <label id="label-berkas" class="custom-file-label" for="krm">Choose file</label>
                                                @if($errors->has('krm'))
                                                    <span class="text-danger" role="alert">
                                                        <strong>{{ $errors->first('krm') }}</strong>
                                                    </span> 
                                                @endif
                                            </div>
                                            @if($data['krm'] !== null)
                                            <div class="col-6 px-0">
                                                <a href="{{ route('beranda-sd-get-krm', ['id'=>$data->id]) }}">Download Berkas Sebelumnya</a>
                                            </div>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="nama">Nama</label></td>
                                        <td>
                                            <input type="text" class="form-control" name="nama" id="nama" value="{{ $data['nama'] }}" required>
                                            @if($errors->has('nama'))
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $errors->first('nama') }}</strong>
                                                </span> 
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="nama_panggilan">Nama Panggilan</label></td>
                                        <td>
                                            <input type="text" class="form-control" name="nama_panggilan" id="nama_panggilan" value="{{ $data['nama_panggilan'] }}" required>
                                            @if($errors->has('nama_panggilan'))
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $errors->first('nama_panggilan') }}</strong>
                                                </span> 
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="program_studi">Program Studi</label></td>
                                        <td>
                                            <input type="text" class="form-control" name="nama_panggilan" id="nama_panggilan" value="{{ $program_studi->prodi }}" disabled required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="jenis_kelamin">Jenis Kelamin</label></td required>
                                        <td>
                                            <select name="jenis_kelamin" id="jenis_kelamin" class="custom-select">
                                                <option>- Pilih jenis kelamin -</option>
                                                @foreach($jenis_kelamins as $jenis_kelamin)
                                                    <option @if($data['jenis_kelamin'] == $jenis_kelamin->id) selected @endif value="{{ $jenis_kelamin->id }}">{{ $jenis_kelamin->nama }}</option>
                                                @endforeach
                                            </select>
                                            @if($errors->has('jenis_kelamin'))
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $errors->first('jenis_kelamin') }}</strong>
                                                </span> 
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="agama">Agama</label></td>
                                        <td>
                                            <select name="agama" id="agama" class="custom-select">
                                                <option>- Pilih agama -</option>
                                                @foreach ($agamas as $agama)
                                                    <option @if($data['agama'] == $agama->id) selected @endif value="{{ $agama->id }}">{{ $agama->nama }}</option>
                                                @endforeach
                                            </select>
                                            @if($errors->has('agama'))
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $errors->first('agama') }}</strong>
                                                </span> 
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="gol_darah">Golongan Darah</label></td>
                                        <td>
                                            <select name="gol_darah" id="gol_darah" class="custom-select" required>
                                                @if (intval($data['gol_darah']) == 0 || $data['gol_darah'] == null)
                                                    <option value="0" selected>- Pilih golongan darah -</option>
                                                    @foreach ($gol_darahs as $gol_darah)
                                                        <option value="{{ $gol_darah->id }}">{{ $gol_darah->nama }}</option>
                                                    @endforeach
                                                @else
                                                    @foreach ($gol_darahs as $gol_darah)
                                                        <option @if($data['gol_darah'] == $gol_darah->id) selected @endif value="{{ $gol_darah->id }}">{{ $gol_darah->nama }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            @if($errors->has('gol_darah'))
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $errors->first('gol_darah') }}</strong>
                                                </span> 
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="tempat_lahir">Tempat Lahir</label></td>
                                        <td>
                                            <input type="text" class="form-control" name="tempat_lahir" id="tempat_lahir" value="{{ $data['tempat_lahir'] }}" required>
                                            @if($errors->has('tempat_lahir'))
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $errors->first('tempat_lahir') }}</strong>
                                                </span> 
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="tanggal_lahir">Tanggal Lahir</label></td>
                                        <td>
                                            <input type="date" class="form-control" name="tanggal_lahir" id="tanggal_lahir" value="{{ $data['tanggal_lahir'] }}" required>
                                            @if($errors->has('tanggal_lahir'))
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $errors->first('tanggal_lahir') }}</strong>
                                                </span> 
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="alamat">Alamat Asal</label></td>
                                        <td>
                                            <textarea class="form-control" name="alamat" id="alamat" placeholder="Alamat lengkap berisikan nama jalan, nomor rumah, kabupaten/kota, provinsi." rows="3" required>{{ $data['alamat'] }}</textarea>
                                            @if($errors->has('alamat'))
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $errors->first('alamat') }}</strong>
                                                </span> 
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="alamat_sekarang">Alamat Sekarang</label></td>
                                        <td>
                                            <textarea class="form-control" name="alamat_sekarang" id="alamat_sekarang" rows="3" required>{{ $data['alamat_sekarang'] }}</textarea>
                                            @if($errors->has('alamat_sekarang'))
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $errors->first('alamat_sekarang') }}</strong>
                                                </span> 
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="no_telepon">Nomor Telepon</label></td>
                                        <td>
                                            <input type="tel" class="form-control" name="no_telepon" id="no_telepon" value="{{ $data['no_telepon'] }}">
                                            @if($errors->has('no_telepon'))
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $errors->first('no_telepon') }}</strong>
                                                </span> 
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="id_line">ID Line</label></td>
                                        <td>
                                            <input type="text" class="form-control" name="id_line" id="id_line" value="{{ $data['id_line'] }}" required>
                                            @if($errors->has('id_line'))
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $errors->first('id_line') }}</strong>
                                                </span> 
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="no_hp">Nomor Ponsel</label></td>
                                        <td>
                                            <input type="tel" class="form-control" name="no_hp" id="no_hp" value="{{ $data['no_hp'] }}" required>
                                            @if($errors->has('no_hp'))
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $errors->first('no_hp') }}</strong>
                                                </span> 
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="email">Email</label></td>
                                        <td>
                                            <input type="email" class="form-control" name="email" id="email" value="{{ $data['email'] }}" required>
                                            @if($errors->has('email'))
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span> 
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="asal_sekolah">Asal Sekolah</label></td>
                                        <td>
                                            <input type="text" class="form-control" name="asal_sekolah" id="asal_sekolah" value="{{ $data['asal_sekolah'] }}" required>
                                            @if($errors->has('asal_sekolah'))
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $errors->first('asal_sekolah') }}</strong>
                                                </span> 
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="asalan_kuliah">Alasan Kuliah</label></td>
                                        <td>
                                            <textarea name="alasan_kuliah" id="alasan_kuliah" class="form-control" rows="3" placeholder='Ketikkan alasan kuliah di Fakultas Teknik' required>{{ $data['alasan_kuliah'] }}</textarea>
                                            @if($errors->has('alasan_kuliah'))
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $errors->first('alasan_kuliah') }}</strong>
                                                </span> 
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="hobi">Hobi</label></td>
                                        <td>
                                            <textarea name="hobi" id="hobi" class="form-control" rows="3" placeholder="Ketikkan hobi Anda">{{ $data['hobi'] }}</textarea>
                                            @if($errors->has('hobi'))
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $errors->first('hobi') }}</strong>
                                                </span> 
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="minat_bakat">Minat Bakat</label></td>
                                        <td>
                                            <textarea name="minat_bakat" id="minat_bakat" class="form-control" rows="3" placeholder="Ketikkan minat bakat Anda" required>{{ $data['minat_bakat'] }}</textarea>
                                            <small>*Contoh Kesenian(Tari), Olahraga(Sepak Bola), dst.</small>
                                            @if($errors->has('minat_bakat'))
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $errors->first('minat_bakat') }}</strong>
                                                </span> 
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="cita_cita">Cita-cita</label></td>
                                        <td>
                                            <input type="text" class="form-control" name="cita_cita" id="cita_cita" value="{{ $data['cita_cita'] }}" required>
                                            @if($errors->has('cita_cita'))
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $errors->first('cita_cita') }}</strong>
                                                </span> 
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="idola">Idola</label></td>
                                        <td>
                                            <input type="text" class="form-control" name="idola" id="idola" value="{{ $data['idola'] }}" required>
                                            @if($errors->has('idola'))
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $errors->first('idola') }}</strong>
                                                </span> 
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="moto">Moto</label></td>
                                        <td>
                                            <input type="text" class="form-control" name="moto" id="moto" value="{{ $data['moto'] }}" required>
                                            @if($errors->has('moto'))
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $errors->first('moto') }}</strong>
                                                </span> 
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="jumlah_saudara">Jumlah Saudara</label></td>
                                        <td>
                                            <input type="number" class="form-control" name="jumlah_saudara" id="jumlah_saudara" value="{{ $data['jumlah_saudara'] }}" required>
                                            @if($errors->has('jumlah_saudara'))
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $errors->first('jumlah_saudara') }}</strong>
                                                </span> 
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="nama_ayah">Nama Ayah</label></td>
                                        <td>
                                            <input type="text" class="form-control" name="nama_ayah" id="nama_ayah" placeholder="Nama Ayah sesuai yang tercantum di Kartu Keluarga" value="{{ $data['nama_ayah'] }}" required>
                                            @if($errors->has('nama_ayah'))
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $errors->first('nama_ayah') }}</strong>
                                                </span> 
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="nama_ibu">Nama Ibu</label></td>
                                        <td>
                                            <input type="text" class="form-control" name="nama_ibu" id="nama_ibu" placeholder="Nama Ibu sesuai yang tercantum di Kartu Keluarga" value="{{ $data['nama_ibu'] }}" required>
                                            @if($errors->has('nama_ibu'))
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $errors->first('nama_ibu') }}</strong>
                                                </span> 
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="penyakit_khusus">Penyakit khusus</label></td>
                                        <td>
                                            <textarea class="form-control" name="penyakit_khusus" id="penyakit_khusus" rows="3" placeholder='Kosongkan Jika tidak memiliki penyakit khsusus. Jika ada sebutkan.' >{{ $data['penyakit_khusus'] }}</textarea>
                                            @if($errors->has('penyakit_khusus'))
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $errors->first('tanggal_lahir') }}</strong>
                                                </span> 
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="mahasiswa_baru">Mahasiswa baru</label></td>
                                        <td> 
                                            <input type="text" class="form-control" id="mahasiswa_baru" value="{{ $data['mahasiswa_baru'] != '2' ? 'Ya' : 'Tidak' }}" readonly>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="angkatan">Angkatan</label></td>
                                        <td>
                                            {{ $angkatans->angkatan }}
                                            
                                        </td>
                                    </tr>

                                    <tr>
                                        <td><label for="check_organisasi">Organisasi & Prestasi</label></td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="1" name="check_organisasi" id="check_organisasi" {{$data->checkorpres == 1 || $data->checkorpres == 3 ? 'checked' : ''}}>
                                                <label class="form-check-label" for="check_organisasi">
                                                    Saya Memiliki Pengalaman Organisasi
                                                </label>
                                                <br>
                                                <input class="form-check-input" type="checkbox" value="1" name="check_prestasi" id="check_prestasi" {{$data->checkorpres == 2 || $data->checkorpres == 3 ? 'checked' : ''}}>
                                                <label class="form-check-label" for="check_prestasi">
                                                    Saya Memiliki Prestasi Akademik / Non Akademik
                                                </label>
                                                <br>
                                            </div>
                                            <small>* dengan mencentang pilihan ini, Anda harus mengisi data pada sub menu organisasi atau prestasi</small>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                    {{-- @endforeach --}}
                    </div>
                    <div class="col-md-4 px-5">
                        <img id="show-profileimage" class="float-left m-2" src="{{$data->profile != null ? asset('/public'.$data->profile) : '/img/foto3x4.jpg'}}" style="border-style:solid;height: 200px; width: 150px;" alt="not found">
                        <div class="custom-file mx-2">
                            <input type="file" class="custom-file-input" id="profileimage" name="profileimage">
                            <label id="label-profileimage" class="custom-file-label" for="profileimage">Choose file</label>
                            <small>*Upload Foto dengan Ketentuan Bebas Rapi </small>
                        </div>
                        @if($errors->has('profileimage'))
                            <span class="text-danger mx-2" role="alert">
                                <strong>{{ $errors->first('profileimage') }}</strong>
                            </span> 
                        @endif
                    </div>
            @if($data->lengkap == 2)
                </div>
                    <a href="{{ route('beranda-sd.biodata') }}" class="btn btn-danger"><i class="fa fa-times"></i> Batalkan perubahan</a>
                    <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Ajukan Perbaikan</button>
                </form>
            @else
                </div>
                <a href="{{ route('beranda-sd.biodata') }}" class="btn btn-danger"><i class="fa fa-times"></i> Batalkan perubahan</a>
                <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan perubahan</button>
            </form>
            @endif
        </div>
    </div>
    @else
    <div class="card mb-4">
        <div class="card-body">
            <form action="{{ route('beranda-sd.update', Auth::user()->id) }}" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-8 px-5">
                        <p> <b>Perhatian! Nama yang diinputkan akan dipakai sebagai nama pada sertifikat Student Day</b> </p>
                    {{-- @foreach ($datas as $data) --}}
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <td><label for="nim">NIM</label></td>
                                        <td>
                                            <input type="text" class="form-control" name="nim" id="nim" value="{{ $data['nim'] }}" disabled required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="krm">KRM (PDF*)</label></td>
                                        <td>
                                            <div class="col-12 px-0">
                                                <input type="file" class="custom-file-input berkas" id="krm" name="krm">
                                                <label id="label-berkas" class="custom-file-label" for="krm">Choose file</label>
                                                @if($errors->has('krm'))
                                                    <span class="text-danger" role="alert">
                                                        <strong>{{ $errors->first('krm') }}</strong>
                                                    </span> 
                                                @endif
                                            </div>
                                            @if($data['krm'] !== null)
                                            <div class="col-6 px-0">
                                                <a href="{{ route('beranda-sd-get-krm', ['id'=>$data->id]) }}">Download Berkas Sebelumnya</a>
                                            </div>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="nama">Nama</label></td>
                                        <td>
                                            <input type="text" class="form-control" name="nama" id="nama" value="{{ $data['nama'] }}" required>
                                            @if($errors->has('nama'))
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $errors->first('nama') }}</strong>
                                                </span> 
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="nama_panggilan">Nama Panggilan</label></td>
                                        <td>
                                            <input type="text" class="form-control" name="nama_panggilan" id="nama_panggilan" value="{{ $data['nama_panggilan'] }}" required>
                                            @if($errors->has('nama_panggilan'))
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $errors->first('nama_panggilan') }}</strong>
                                                </span> 
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="program_studi">Program Studi</label></td>
                                        <td>
                                            <input type="text" class="form-control" name="nama_panggilan" id="nama_panggilan" value="{{ $program_studi->prodi }}" disabled required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="jenis_kelamin">Jenis Kelamin</label></td required>
                                        <td>
                                            <select name="jenis_kelamin" id="jenis_kelamin" class="custom-select">
                                                <option>- Pilih jenis kelamin -</option>
                                                @foreach($jenis_kelamins as $jenis_kelamin)
                                                    <option @if($data['jenis_kelamin'] == $jenis_kelamin->id) selected @endif value="{{ $jenis_kelamin->id }}">{{ $jenis_kelamin->nama }}</option>
                                                @endforeach
                                            </select>
                                            @if($errors->has('jenis_kelamin'))
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $errors->first('jenis_kelamin') }}</strong>
                                                </span> 
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="agama">Agama</label></td>
                                        <td>
                                            <select name="agama" id="agama" class="custom-select">
                                                <option>- Pilih agama -</option>
                                                @foreach ($agamas as $agama)
                                                    <option @if($data['agama'] == $agama->id) selected @endif value="{{ $agama->id }}">{{ $agama->nama }}</option>
                                                @endforeach
                                            </select>
                                            @if($errors->has('agama'))
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $errors->first('agama') }}</strong>
                                                </span> 
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="gol_darah">Golongan Darah</label></td>
                                        <td>
                                            <select name="gol_darah" id="gol_darah" class="custom-select" required>
                                                @if (intval($data['gol_darah']) == 0 || $data['gol_darah'] == null)
                                                    <option value="0" selected>- Pilih golongan darah -</option>
                                                    @foreach ($gol_darahs as $gol_darah)
                                                        <option value="{{ $gol_darah->id }}">{{ $gol_darah->nama }}</option>
                                                    @endforeach
                                                @else
                                                    @foreach ($gol_darahs as $gol_darah)
                                                        <option @if($data['gol_darah'] == $gol_darah->id) selected @endif value="{{ $gol_darah->id }}">{{ $gol_darah->nama }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            @if($errors->has('gol_darah'))
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $errors->first('gol_darah') }}</strong>
                                                </span> 
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="tempat_lahir">Tempat Lahir</label></td>
                                        <td>
                                            <input type="text" class="form-control" name="tempat_lahir" id="tempat_lahir" value="{{ $data['tempat_lahir'] }}" required>
                                            @if($errors->has('tempat_lahir'))
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $errors->first('tempat_lahir') }}</strong>
                                                </span> 
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="tanggal_lahir">Tanggal Lahir</label></td>
                                        <td>
                                            <input type="date" class="form-control" name="tanggal_lahir" id="tanggal_lahir" value="{{ $data['tanggal_lahir'] }}" required>
                                            @if($errors->has('tanggal_lahir'))
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $errors->first('tanggal_lahir') }}</strong>
                                                </span> 
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="alamat">Alamat Asal</label></td>
                                        <td>
                                            <textarea class="form-control" name="alamat" id="alamat" placeholder="Alamat lengkap berisikan nama jalan, nomor rumah, kabupaten/kota, provinsi." rows="3" required>{{ $data['alamat'] }}</textarea>
                                            @if($errors->has('alamat'))
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $errors->first('alamat') }}</strong>
                                                </span> 
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="alamat_sekarang">Alamat Sekarang</label></td>
                                        <td>
                                            <textarea class="form-control" name="alamat_sekarang" id="alamat_sekarang" rows="3" required>{{ $data['alamat_sekarang'] }}</textarea>
                                            @if($errors->has('alamat_sekarang'))
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $errors->first('alamat_sekarang') }}</strong>
                                                </span> 
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="no_telepon">Nomor Telepon</label></td>
                                        <td>
                                            <input type="tel" class="form-control" name="no_telepon" id="no_telepon" value="{{ $data['no_telepon'] }}">
                                            @if($errors->has('no_telepon'))
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $errors->first('no_telepon') }}</strong>
                                                </span> 
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="id_line">ID Line</label></td>
                                        <td>
                                            <input type="text" class="form-control" name="id_line" id="id_line" value="{{ $data['id_line'] }}" required>
                                            @if($errors->has('id_line'))
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $errors->first('id_line') }}</strong>
                                                </span> 
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="no_hp">Nomor Ponsel</label></td>
                                        <td>
                                            <input type="tel" class="form-control" name="no_hp" id="no_hp" value="{{ $data['no_hp'] }}" required>
                                            @if($errors->has('no_hp'))
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $errors->first('no_hp') }}</strong>
                                                </span> 
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="email">Email</label></td>
                                        <td>
                                            <input type="email" class="form-control" name="email" id="email" value="{{ $data['email'] }}" required>
                                            @if($errors->has('email'))
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span> 
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="asal_sekolah">Asal Sekolah</label></td>
                                        <td>
                                            <input type="text" class="form-control" name="asal_sekolah" id="asal_sekolah" value="{{ $data['asal_sekolah'] }}" required>
                                            @if($errors->has('asal_sekolah'))
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $errors->first('asal_sekolah') }}</strong>
                                                </span> 
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="asalan_kuliah">Alasan Kuliah</label></td>
                                        <td>
                                            <textarea name="alasan_kuliah" id="alasan_kuliah" class="form-control" rows="3" placeholder='Ketikkan alasan kuliah di Fakultas Teknik' required>{{ $data['alasan_kuliah'] }}</textarea>
                                            @if($errors->has('alasan_kuliah'))
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $errors->first('alasan_kuliah') }}</strong>
                                                </span> 
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="hobi">Hobi</label></td>
                                        <td>
                                            <textarea name="hobi" id="hobi" class="form-control" rows="3" placeholder="Ketikkan hobi Anda">{{ $data['hobi'] }}</textarea>
                                            @if($errors->has('hobi'))
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $errors->first('hobi') }}</strong>
                                                </span> 
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="minat_bakat">Minat Bakat</label></td>
                                        <td>
                                            <textarea name="minat_bakat" id="minat_bakat" class="form-control" rows="3" placeholder="Ketikkan minat bakat Anda" required>{{ $data['minat_bakat'] }}</textarea>
                                            <small>*Contoh Kesenian(Tari), Olahraga(Sepak Bola), dst.</small>
                                            @if($errors->has('minat_bakat'))
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $errors->first('minat_bakat') }}</strong>
                                                </span> 
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="cita_cita">Cita-cita</label></td>
                                        <td>
                                            <input type="text" class="form-control" name="cita_cita" id="cita_cita" value="{{ $data['cita_cita'] }}" required>
                                            @if($errors->has('cita_cita'))
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $errors->first('cita_cita') }}</strong>
                                                </span> 
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="idola">Idola</label></td>
                                        <td>
                                            <input type="text" class="form-control" name="idola" id="idola" value="{{ $data['idola'] }}" required>
                                            @if($errors->has('idola'))
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $errors->first('idola') }}</strong>
                                                </span> 
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="moto">Moto</label></td>
                                        <td>
                                            <input type="text" class="form-control" name="moto" id="moto" value="{{ $data['moto'] }}" required>
                                            @if($errors->has('moto'))
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $errors->first('moto') }}</strong>
                                                </span> 
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="jumlah_saudara">Jumlah Saudara</label></td>
                                        <td>
                                            <input type="number" class="form-control" name="jumlah_saudara" id="jumlah_saudara" value="{{ $data['jumlah_saudara'] }}" required>
                                            @if($errors->has('jumlah_saudara'))
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $errors->first('jumlah_saudara') }}</strong>
                                                </span> 
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="nama_ayah">Nama Ayah</label></td>
                                        <td>
                                            <input type="text" class="form-control" name="nama_ayah" id="nama_ayah" placeholder="Nama Ayah sesuai yang tercantum di Kartu Keluarga" value="{{ $data['nama_ayah'] }}" required>
                                            @if($errors->has('nama_ayah'))
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $errors->first('nama_ayah') }}</strong>
                                                </span> 
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="nama_ibu">Nama Ibu</label></td>
                                        <td>
                                            <input type="text" class="form-control" name="nama_ibu" id="nama_ibu" placeholder="Nama Ibu sesuai yang tercantum di Kartu Keluarga" value="{{ $data['nama_ibu'] }}" required>
                                            @if($errors->has('nama_ibu'))
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $errors->first('nama_ibu') }}</strong>
                                                </span> 
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="penyakit_khusus">Penyakit khusus</label></td>
                                        <td>
                                            <textarea class="form-control" name="penyakit_khusus" id="penyakit_khusus" rows="3" placeholder='Kosongkan Jika tidak memiliki penyakit khsusus. Jika ada sebutkan.' >{{ $data['penyakit_khusus'] }}</textarea>
                                            @if($errors->has('penyakit_khusus'))
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $errors->first('tanggal_lahir') }}</strong>
                                                </span> 
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="scan-riwayat">Scan Bukti Penyakit (PDF*)</label></td>
                                        <td>
                                            <div class="col-12 px-0">
                                                <input type="file" class="custom-file-input berkas" id="scan-riwayat" name="scan-riwayat">
                                                <label id="label-berkas" class="custom-file-label" for="scan-riwayat">Choose file</label>
                                                <small>*Wajib Mengupload bukti jika mengisi form <strong>Penyakit Khusus</strong>.</small>
                                                @if($errors->has('scan-riwayat'))
                                                    <span class="text-danger" role="alert">
                                                        <strong>{{ $errors->first('scan-riwayat') }}</strong>
                                                    </span> 
                                                @endif
                                            </div>
                                            @if(Auth::user()->scan_penyakit != null)
                                            <div class="col-6 px-0">
                                                <a href="/beranda-sd-verifikasi-scan-download/{{Auth::user()->id}}">Download berkas sebelumnya</a>
                                            </div>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="url">Link youtube</label></td>
                                        <td>
                                            <a>{{Auth::user()->youtube}}</a>
                                <a style="margin-left:5px;" class="btn btn-info btn-sm" href="{{ route('beranda-sd.verifikasi-youtube', ['id'=>Auth::user()->id]) }}" class="ml-2"><i class="fa fa-edit"></i> Edit</a>
                                            @if($errors->has('url'))
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $errors->first('url') }}</strong>
                                                </span> 
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="mahasiswa_baru">Mahasiswa baru</label></td>
                                        <td> 
                                            <input type="text" class="form-control" id="mahasiswa_baru" value="{{ $data['mahasiswa_baru'] != '2' ? 'Ya' : 'Tidak' }}" readonly>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="angkatan">Angkatan</label></td>
                                        <td>
                                            {{ $angkatans->angkatan }}
                                            
                                        </td>
                                    </tr>

                                    <tr>
                                        <td><label for="check_organisasi">Organisasi & Prestasi</label></td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="1" name="check_organisasi" id="check_organisasi" {{$data->checkorpres == 1 || $data->checkorpres == 3 ? 'checked' : ''}}>
                                                <label class="form-check-label" for="check_organisasi">
                                                    Saya Memiliki Pengalaman Organisasi
                                                </label>
                                                <br>
                                                <input class="form-check-input" type="checkbox" value="1" name="check_prestasi" id="check_prestasi" {{$data->checkorpres == 2 || $data->checkorpres == 3 ? 'checked' : ''}}>
                                                <label class="form-check-label" for="check_prestasi">
                                                    Saya Memiliki Prestasi Akademik / Non Akademik
                                                </label>
                                                <br>
                                            </div>
                                            <small>* dengan mencentang pilihan ini, Anda harus mengisi data pada sub menu organisasi atau prestasi</small>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                    {{-- @endforeach --}}
                    </div>
                    <div class="col-md-4 px-5">
                        <img id="show-profileimage" class="float-left m-2" src="{{$data->profile != null ? asset('/public'.$data->profile) : '/img/foto3x4.jpg'}}" style="border-style:solid;height: 200px; width: 150px;" alt="not found">
                        <div class="custom-file mx-2">
                            <input type="file" class="custom-file-input" id="profileimage" name="profileimage">
                            <label id="label-profileimage" class="custom-file-label" for="profileimage">Choose file</label>
                            <small>*Upload Foto sesuai dengan <strong>Ketentuan Foto</strong> </small>
                        </div>
                        @if($errors->has('profileimage'))
                            <span class="text-danger mx-2" role="alert">
                                <strong>{{ $errors->first('profileimage') }}</strong>
                            </span> 
                        @endif
                    </div>
            @if($data->lengkap == 6)
                </div>
                    <a href="{{ route('beranda-sd.biodata') }}" class="btn btn-danger"><i class="fa fa-times"></i> Batalkan perubahan</a>
                    <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Ajukan Perbaikan</button>
                </form>
            @else
                </div>
                <a href="{{ route('beranda-sd.biodata') }}" class="btn btn-danger"><i class="fa fa-times"></i> Batalkan perubahan</a>
                <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan perubahan</button>
            </form>
            @endif
        </div>
    </div>
    @endif
@endsection

@section('custom_javascript')
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#show-profileimage').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#krm").change(function() {
            var name = this.files[0].name;
            $('#label-berkas').html(name);
        });
        $("#profileimage").change(function() {
            var filename = this.files[0].name;
            readURL(this);
            $('#label-profileimage').html(filename);
        });

        //$(document).ready(function () {
            //setInterval(function() {
                //$('#pengumumanmala').modal('show');    
            //}, 3000);
            
        });
        
    </script>
@endsection