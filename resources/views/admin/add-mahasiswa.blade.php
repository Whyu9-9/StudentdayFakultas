@extends('layouts.admin-layout')

@section('active2')
    active
@endsection

@section('content')
    <h2 class="mb-4"><i class="fa fa-user"></i> Tambah Mahasiswa</h2>
    <div class="card mb-4">
        <div class="card-body">
            <div class="col-md-8">
                <form action="{{ route('admin.mahasiswa-store') }}" method="post">
                    {{ csrf_field() }}
                    <table class="table table-borderless">
                        <tbody>
                            <tr>
                                <td><label for="nim" data-toggle="tooltip" data-placement="right" title="Wajib diisi" style="cursor:pointer">NIM <span class="text-danger">*</span></label></td>
                                <td>
                                    <input type="text" class="form-control" name="nim" id="nim" placeholder="1805xxxxxx" required autofocus>
                                </td>
                            </tr>
                            <tr>
                                <td><label for="nama" data-toggle="tooltip" data-placement="right" title="Wajib diisi" style="cursor:pointer">Nama <span class="text-danger">*</label></td>
                                <td>
                                    <input type="text" class="form-control" name="nama" id="nama" required>
                                </td>
                            </tr>
                            <tr>
                                <td><label for="nama_panggilan">Nama Panggilan</label></td>
                                <td>
                                    <input type="text" class="form-control" name="nama_panggilan" id="nama_panggilan">
                                </td>
                            </tr>
                            <tr>
                                <td><label for="program_studi" data-toggle="tooltip" data-placement="right" title="Wajib diisi" style="cursor:pointer">Program Studi <span class="text-danger">*</label></td>
                                <td>
                                    <select name="program_studi" id="program_studi" class="custom-select" required>
                                        <option>- Pilih program studi -</option>
                                        @foreach ($program_studi as $prodi)
                                        <option value="{{$prodi->id}}">{{$prodi->nama}}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td><label for="jenis_kelamin" data-toggle="tooltip" data-placement="right" title="Wajib diisi" style="cursor:pointer">Jenis Kelamin <span class="text-danger">*</label></td>
                                <td>
                                    <select name="jenis_kelamin" id="jenis_kelamin" class="custom-select" required>
                                        <option value="1">- Pilih jenis kelamin -</option>
                                        <option value="1">Laki-laki</option>
                                        <option value="2">Perempuan</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td><label for="agama">Agama</label></td>
                                <td>
                                    <select name="agama" id="agama" class="custom-select">
                                        <option>- Pilih agama -</option>
                                        @foreach ($agamas as $agama)
                                            <option value="{{ $agama->id }}">{{ $agama->nama }}</option>
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
                                    <select name="gol_darah" id="gol_darah" class="custom-select">
                                        <option value="0">- Pilih golongan darah -</option>    
                                        <option value="1">A</option>
                                        <option value="2">B</option>
                                        <option value="3">AB</option>
                                        <option value="4">O</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td><label for="tempat_lahir">Tempat Lahir</label></td>
                                <td>
                                    <textarea class="form-control" name="tempat_lahir" id="tempat_lahir" rows="3"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td><label for="tanggal_lahir">Tanggal Lahir</label></td>
                                <td>
                                    <input type="date" class="form-control" name="tanggal_lahir" id="tanggal_lahir">
                                </td>
                            </tr>
                            <tr>
                                <td><label for="alamat">Alamat</label></td>
                                <td>
                                    <textarea class="form-control" name="alamat" id="alamat" rows="3"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td><label for="alamat_sekarang">Alamat Sekarang</label></td>
                                <td>
                                    <textarea class="form-control" name="alamat_sekarang" id="alamat_sekarang" rows="3"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td><label for="no_telepon">Nomor Telepon</label></td>
                                <td>
                                    <input type="number" class="form-control" name="no_telepon" id="no_telepon">
                                </td>
                            </tr>
                            <tr>
                                <td><label for="no_hp">Nomor Ponsel</label></td>
                                <td>
                                    <input type="number" class="form-control" name="no_hp" id="no_hp">
                                </td>
                            </tr>
                            <tr>
                                <td><label for="email">Email</label></td>
                                <td>
                                    <input type="email" class="form-control" name="email" id="email" placeholder="contoh@contoh.com">
                                </td>
                            </tr>
                            <tr>
                                <td><label for="asal_sekolah">Asal Sekolah</label></td>
                                <td>
                                    <input type="text" class="form-control" name="asal_sekolah" id="asal_sekolah">
                                </td>
                            </tr>
                            <tr>
                                <td><label for="hobi">Hobi</label></td>
                                <td>
                                    <input type="text" class="form-control" name="hobi" id="hobi">
                                </td>
                            </tr>
                            <tr>
                                <td><label for="cita_cita">Cita-cita</label></td>
                                <td>
                                    <input type="text" class="form-control" name="cita_cita" id="cita_cita">
                                </td>
                            </tr>
                            <tr>
                                <td><label for="idola">Idola</label></td>
                                <td>
                                    <input type="text" class="form-control" name="idola" id="idola">
                                </td>
                            </tr>
                            <tr>
                                <td><label for="moto">Moto</label></td>
                                <td>
                                    <input type="text" class="form-control" name="moto" id="moto">
                                </td>
                            </tr>
                            <tr>
                                <td><label for="jumlah_saudara">Jumlah Saudara</label></td>
                                <td>
                                    <input type="number" class="form-control" name="jumlah_saudara" id="jumlah_saudara">
                                </td>
                            </tr>
                            <tr>
                                <td><label for="nama_ayah">Nama Ayah</label></td>
                                <td>
                                    <input type="text" class="form-control" name="nama_ayah" id="nama_ayah">
                                </td>
                            </tr>
                            <tr>
                                <td><label for="nama_ibu">Nama Ibu</label></td>
                                <td>
                                    <input type="text" class="form-control" name="nama_ibu" id="nama_ibu">
                                </td>
                            </tr>
                            <tr>
                                <td><label for="vegetarian">Vegetarian</label></td>
                                <td>
                                    <select class="form-control" name="vegetarian" id="vegetarian">
                                        <option value="0">- Ya/Tidak -</option>
                                        <option value="1">Ya</option>
                                        <option value="2">Tidak</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td><label for="penyakit_khusus">Penyakit khusus</label></td>
                                <td>
                                    <textarea class="form-control" name="penyakit_khusus" id="penyakit_khusus" rows="3" placeholder='Ketikkan "Tidak Ada" Jika tidak memiliki penyakit khsusus. Jika ada sebutkan.'></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td><label for="mahasiswa_baru">Mahasiswa baru</label></td>
                                <td> 
                                    <select name="mahasiswa_baru" id="mahasiswa_baru" class="custom-select">
                                        <option value="0">- Ya/Tidak -</option>
                                        <option value="1">Ya</option>
                                        <option value="2">Tidak</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td><label for="angkatan">Angkatan</label></td>
                                <td>
                                    <select name="angkatan" id="angkatan" class="form-control">
                                        <option value="0">- Pilih angkatan -</option>
                                        @foreach ($angkatans as $angkatan)
                                            <option value="{{ $angkatan->id }}">{{ $angkatan->tahun }}</option>                                            
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <a href="{{ route('admin.mahasiswa') }}" class="btn btn-danger"><i class="fa fa-times"></i> Batal</a>
                    <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Tambah mahasiswa</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('custom-javascript')

@endsection