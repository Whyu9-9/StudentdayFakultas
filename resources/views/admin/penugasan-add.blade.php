@extends('layouts.admin-layout')

@section('penugasan')
    active
@endsection

@section('content')

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

    <h2 class="mb-4"><i class="fa fa-user"></i> Tambah Tugas</h2>
    <div class="card mb-4">
        <div class="card-body">
            <div class="col-md-8">
                <form action="{{ route('penugasan.setting-post') }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <table class="table table-borderless">
                        <tbody>
                            <tr>
                                <td><label for="ket">Keterangan</label></td>
                                <td>
                                    <div class="form-group">
                                        <textarea class="form-control" id="exampleFormControlTextarea1" name="keterangan" rows="3" placeholder="Masukan keterangan tugas disini..."></textarea>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><label for="tugas">Link Tugas</label>
                                    <!-- <small>Format .pdf</small> -->
                                </td>
                                <td>
                                    <div class="form-group">
                                        <textarea class="form-control" id="exampleFormControlTextarea1" name="link" rows="3" placeholder="Masukan link form tugas disini..."></textarea>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><label for="tipe" data-toggle="tooltip" data-placement="right" title="Wajib diisi" style="cursor:pointer">Tipe</label></td>
                                <td>
                                    <select name="tipe" id="tipe" class="custom-select" required>
                                        <option selected>- Pilih Tipe -</option>
                                            <option value="essay">Essay</option>
                                            <option value="jawab_soal">Jawab Soal</option>
                                            <option value="tugas_khusus">Tugas Khusus</option>
                                    </select>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <a href="{{ route('penugasan.setting') }}" class="btn btn-danger"><i class="fa fa-times"></i> Kembali</a>
                    <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Tambah Tugas</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('custom_javascript')
    <script>
        $(".berkas").change(function() {
            var name = this.files[0].name;
            var label = this.nextElementSibling;
            label.textContent = name;
        });
    </script>
@endsection
