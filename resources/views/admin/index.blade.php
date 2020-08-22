@extends('layouts.admin-layout')

@section('active1')
    active
@endsection

@section('content')

<h2 class="mb-4"><i class="fa fa-home"></i> Beranda</h2>
    <div class="row mb-4">
        <div class="col-md">
            <div class="d-flex border">
                <div class="bg-primary text-light p-4">
                    <div class="d-flex align-items-center h-100">
                        <i class="fa fa-3x fa-fw fa-user"></i>
                    </div>
                </div>
                <div class="flex-grow-1 bg-white p-4">
                    <p class="text-uppercase text-secondary mb-0">Total Mahasiswa</p>
                    <h3 class="font-weight-bold mb-0">{{ $mahasiswa }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md">
            <div class="d-flex border">
                <div class="bg-success text-light p-4">
                    <div class="d-flex align-items-center h-100">
                        <i class="fa fa-3x fa-fw fa-check"></i>
                    </div>
                </div>
                <div class="flex-grow-1 bg-white p-4">
                    <p class="text-uppercase text-secondary mb-0">Sudah Verifikasi</p>
                    <h3 class="font-weight-bold mb-0">{{ $verifikasi }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md">
            <div class="d-flex border">
                <div class="bg-danger text-light p-4">
                    <div class="d-flex align-items-center h-100">
                        <i class="fa fa-3x fa-fw fa-times"></i>
                    </div>
                </div>
                <div class="flex-grow-1 bg-white p-4">
                    <p class="text-uppercase text-secondary mb-0">Belum Verifikasi</p>
                    <h3 class="font-weight-bold mb-0">{{ $belum_verifikasi }}</h3>
                </div>
            </div>
        </div>
    </div>
@endsection