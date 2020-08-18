@extends('layouts.admin-layout')

@section('active2')
    active
@endsection

@section('content')
    <h2 class="mb-4"><i class="fa fa-user"></i> Edit Mahasiswa</h2>  
    @if (Session::has('errors'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fa fa-exclamation-circle"></i> {{ Session::get('error') }}
            <button type="button" class="close" data-dismiss="alert" arial-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <div class="card mb-4">
        <div class="card-body">
            <div class="col-md-8">
                <form action="{{ route('admin.mahasiswa-update', $data->id) }}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <table class="table table-borderless">
                        <tbody>
                            <tr>
                                <td><label for="nim" data-toggle="tooltip" data-placement="right" title="Wajib diisi" style="cursor:pointer">NIM <span class="text-danger">*</span></label></td>
                                <td>
                                    <input type="text" class="form-control" name="nim" id="nim" value="{{ $data->nim }}" required>
                                    @foreach ($errors->get('nim') as $message)
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span> 
                                    @endforeach
                                </td>
                            </tr>
                            <tr>
                                <td><label for="nama" data-toggle="tooltip" data-placement="right" title="Wajib diisi" style="cursor:pointer">Nama <span class="text-danger">*</span></label></td>
                                <td>
                                    <input type="text" class="form-control" name="nama" id="nama" value="{{ $data->nama }}" required>
                                </td>
                            </tr>
                            <tr>
                                <td><label for="nama_panggilan">Nama Panggilan</label></td>
                                <td>
                                    <input type="text" class="form-control" name="nama_panggilan" id="nama_panggilan" value="{{ $data->nama_panggilan }}">
                                </td>
                            </tr>
                            <tr>
                                <td><label for="program_studi" data-toggle="tooltip" data-placement="right" title="Wajib diisi" style="cursor:pointer">Program Studi <span class="text-danger">*</span></label></td>
                                <td>
                                    <select name="program_studi" id="program_studi" class="custom-select" required>
                                        @foreach ($program_studi as $prodi)
                                        <option @if($data->program_studi == $prodi->id) selected @endif value="{{$prodi->id}}">{{$prodi->nama}}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td><label for="jenis_kelamin" data-toggle="tooltip" data-placement="right" title="Wajib diisi" style="cursor:pointer">Jenis Kelamin <span class="text-danger">*</span></label></td>
                                <td>
                                    <select name="jenis_kelamin" id="jenis_kelamin" class="custom-select">
                                        @foreach ($jenis_kelamins as $jenis_kelamin)
                                            <option @if($data->jenis_kelamin == $jenis_kelamin->id) selected @endif value="{{ $jenis_kelamin->id }}">{{ $jenis_kelamin->nama }}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td><label for="agama">Agama</label></td>
                                <td>
                                    <select name="agama" id="agama" class="custom-select">
                                        <option value="0">- Pilih agama -</option>
                                        @foreach ($agamas as $agama)
                                            <option @if($data->agama == $agama->id) selected @endif value="{{ $agama->id }}">{{ $agama->nama }}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td><label for="gol_darah">Golongan Darah</label></td>
                                <td>
                                    <select name="gol_darah" id="gol_darah" class="custom-select">
                                        @if (intval($data->gol_darah) == 0)
                                            <option value="0" selected>- Pilih golongan darah -</option>
                                            @foreach ($gol_darahs as $gol_darah)
                                                <option value="{{ $gol_darah->id }}">{{ $gol_darah->nama }}</optionendif>
                                            @endforeach
                                        @else
                                            @foreach ($gol_darahs as $gol_darah)
                                                <option @if($data->gol_darah == $gol_darah->id) selected @endif value="{{ $gol_darah->id }}">{{ $gol_darah->nama }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td><label for="tempat_lahir">Tempat Lahir</label></td>
                                <td>
                                    <input type="text" class="form-control" name="tempat_lahir" id="tempat_lahir" value="{{ $data->tempat_lahir }}">
                                </td>
                            </tr>
                            <tr>
                                <td><label for="tanggal_lahir">Tanggal Lahir</label></td>
                                <td>
                                    <input type="date" class="form-control" name="tanggal_lahir" id="tanggal_lahir" value="{{ $data->tanggal_lahir }}">
                                </td>
                            </tr>
                            <tr>
                                <td><label for="alamat">Alamat</label></td>
                                <td>
                                    <textarea class="form-control" name="alamat" id="alamat" rows="3">{{ $data->alamat }}</textarea>
                                </td>
                            </tr>
                            <tr>
                                <td><label for="alamat_sekarang">Alamat Sekarang</label></td>
                                <td>
                                    <textarea class="form-control" name="alamat_sekarang" id="alamat_sekarang" rows="3">{{ $data->alamat_sekarang }}</textarea>
                                </td>
                            </tr>
                            <tr>
                                <td><label for="no_telepon">Nomor Telepon</label></td>
                                <td>
                                    <input type="number" class="form-control" name="no_telepon" id="no_telepon" value="{{ $data->no_telepon }}">
                                </td>
                            </tr>
                            <tr>
                                <td><label for="id_line">ID Line</label></td>
                                <td>
                                    <input type="text" class="form-control" name="id_line" id="id_line" value="{{ $data->id_line }}">
                                </td>
                            </tr>
                            <tr>
                                <td><label for="no_hp">Nomor Ponsel</label></td>
                                <td>
                                    <input type="number" class="form-control" name="no_hp" id="no_hp" value="{{ $data->no_hp }}">
                                </td>
                            </tr>
                            <tr>
                                <td><label for="email">Email</label></td>
                                <td>
                                    <input type="email" class="form-control" name="email" id="email" value="{{ $data->email }}">
                                </td>
                            </tr>
                            <tr>
                                <td><label for="asal_sekolah">Asal Sekolah</label></td>
                                <td>
                                    <input type="text" class="form-control" name="asal_sekolah" id="asal_sekolah" value="{{ $data->asal_sekolah }}">
                                </td>
                            </tr>
                            <tr>
                                <td><label for="pengalam_berorganisasi">Alasan Kuliah</label></td>
                                <td>
                                    <textarea name="alasan_kuliah" id="alasan_kuliah" class="form-control" rows="3" placeholder='Ketikkan alasan kuliah di Fakultas Teknik'>{{ $data->alasan_kuliah }}</textarea>
                                </td>
                            </tr>
                            <tr>
                                <td><label for="hobi">Hobi</label></td>
                                <td>
                                    <textarea name="hobi" id="hobi" class="form-control" rows="3" placeholder="Ketikkan hobi Anda">{{ $data->hobi }}</textarea>
                                </td>
                            </tr>
                            <tr>
                                <td><label for="cita_cita">Cita-cita</label></td>
                                <td>
                                    <input type="text" class="form-control" name="cita_cita" id="cita_cita" value="{{ $data->cita_cita }}">
                                </td>
                            </tr>
                            <tr>
                                <td><label for="idola">Idola</label></td>
                                <td>
                                    <input type="text" class="form-control" name="idola" id="idola" value="{{ $data->idola }}">
                                </td>
                            </tr>
                            <tr>
                                <td><label for="moto">Moto</label></td>
                                <td>
                                    <input type="text" class="form-control" name="moto" id="moto" value="{{ $data->moto }}">
                                </td>
                            </tr>
                            <tr>
                                <td><label for="jumlah_saudara">Jumlah Saudara</label></td>
                                <td>
                                    <input type="number" class="form-control" name="jumlah_saudara" id="jumlah_saudara" value="{{ $data->jumlah_saudara }}">
                                </td>
                            </tr>
                            <tr>
                                <td><label for="nama_ayah">Nama Ayah</label></td>
                                <td>
                                    <input type="text" class="form-control" name="nama_ayah" id="nama_ayah" value="{{ $data->nama_ayah }}">
                                </td>
                            </tr>
                            <tr>
                                <td><label for="nama_ibu">Nama Ibu</label></td>
                                <td>
                                    <input type="text" class="form-control" name="nama_ibu" id="nama_ibu" value="{{ $data->nama_ibu }}">
                                </td>
                            </tr>
                            <tr>
                                <td><label for="vegetarian">Vegetarian</label></td>
                                <td>
                                    <select class="form-control" name="vegetarian" id="vegetarian">
                                        @if ($data->vegetarian == '1')
                                            <option value="1" selected>Ya</option>
                                            <option value="2">Tidak</option>
                                        @elseif ($data->vegetarian == '2')
                                            <option value="1">Ya</option>
                                            <option value="2" selected>Tidak</option>
                                        @else
                                            <option value="0">- Pilih -</option>
                                            <option value="1">Ya</option>
                                            <option value="2">Tidak</option>
                                        @endif
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td><label for="penyakit_khusus">Penyakit khusus</label></td>
                                <td>
                                    <textarea class="form-control" name="penyakit_khusus" id="penyakit_khusus" rows="3" placeholder='Ketikkan "Tidak Ada" Jika tidak memiliki penyakit khsusus. Jika ada sebutkan.'>{{ $data->penyakit_khusus }}</textarea>
                                </td>
                            </tr>
                            <tr>
                                <td><label for="mahasiswa_baru">Mahasiswa baru</label></td>
                                <td> 
                                    <select name="mahasiswa_baru" id="mahasiswa_baru" class="custom-select">
                                        @if($data->mahasiswa_baru == '1')
                                            <option value="1" selected>Ya</option>
                                            <option value="2">Tidak</option>
                                        @elseif($data->mahasiswa_baru == '2')
                                            <option value="1">Ya</option>   
                                            <option value="2" selected>Tidak</option>
                                        @else
                                            <option value="0">- Pilih -</option>
                                            <option value="1">Ya</option>   
                                            <option value="2">Tidak</option>
                                        @endif
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td><label for="angkatan">Angkatan</label></td>
                                <td>
                                    <select name="angkatan" id="angkatan" class="form-control">
                                        <option value="0">- Pilih angkatan -</option>
                                        @foreach ($angkatans as $angkatan)
                                            <option @if($data->angkatan == $angkatan->id) selected @endif value="{{ $angkatan->id }}">{{ $angkatan->tahun }}</option>                                            
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td><label for="note">Note</label></td>
                                <td>
                                    <textarea class="form-control" name="note" id="note" rows="3" placeholder='Kosongkan jika tidak terdapat kesalahan.'>{{ !empty($note->notes) ? $note->notes:'' }}</textarea>
                                </td>       
                            </tr>
                        </tbody>
                    </table>
                    <a href="{{ route('admin.mahasiswa') }}" class="btn btn-danger"><i class="fa fa-times"></i> Batalkan Perubahan</a>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-exclamation"></i> Simpan Perubahan</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('custom-javascript')

@endsection