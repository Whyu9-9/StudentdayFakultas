@extends('layouts.beranda-layout')

@section('active3')
    active
@endsection

@section('content')
    <h2 class="mb-4"><i class="fa fa-print"></i> Cetak Berkas</h2>
    @if($data->lengkap == 0 || $data->lengkap == 1 || $data->lengkap == 2 || $data->lengkap == 3)
        <div class="alert alert-warning">
            <i class="fa fa-exclamation-circle"></i> Biodata Anda belum lengkap. Lengkapi biodata untuk dapat mencetak berkas Student Day. <br>
            <a href="/beranda-sd/{{ Auth::user()->id }}/edit" class="btn btn-primary mt-3"><i class="fa fa-edit"></i> Lengkapi biodata</a>
        </div>
    @elseif($data->lengkap == 6)
        <div class="alert alert-danger">
            <i class="fa fa-exclamation-circle"></i> Terdapat Kesalahan pada data verifikasi ulang. Perbaiki kesalahan untuk mencetak berkas Student Day <br>
            <a href="{{ route('beranda-sd.verifikasi') }}" class="btn btn-primary mt-3"><i class="fa fa-edit"></i> Perbaiki Verifikasi Ulang</a>
        </div>
    @elseif($data->lengkap == 4 || $data->lengkap == 5 || $data->lengkap == 7)
        <div class="alert alert-primary">
            <i class="fa fa-exclamation-circle"></i> Akun Anda belum terverifikasi. Tunggu hingga semua data terverifikasi untuk dapat mencetak berkas Student Day. <br>
        </div>
    @elseif (Auth::user()->lengkap == 8)
    <div class="alert alert-success">
        <i class="fa fa-check-circle"></i> Verifikasi Ulang Berhasil. Berkas siap untuk dicetak.<br>
    </div>
    <div class="card">
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Berkas</th>
                        <th>Ukuran Kertas</th>
                        <th>Warna Kertas</th>
                        <th>Link Download</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Buku Panduan Student Day</td>
                        <td>A4 Format Buku Bolak Balik (A4 dibagi 2)</td>
                        <td>Putih</td>
                        <td>
                            <a target="_blank" class="btn btn-success" href="/buku-panduan"><span class="fa fa-download"></span> Download Berkas</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    @endif
        
    
@endsection