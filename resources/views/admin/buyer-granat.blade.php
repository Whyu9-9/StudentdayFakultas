@extends('layouts.admin-layout')

@section('active2')
    active
@endsection

@section('content')
    <h2 class="mb-4"><i class="fa fa-sticky-note"></i> List Buyer Baju GrAnaT</h2>
    @if(Session::has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="text-success fas fa-check mr-1"></i> {{Session::get('success')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <div class="card mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <div class="col-12">
                    <div class="row">
                      <a style="margin-top: 5px;margin-right: 3px;" href="/export-excel-granat?prodi={{isset($filter['prodi']) ? $filter['prodi'] : ''}}"
                      class="btn btn-outline-success mb-3 mr-3"><i class="fa fa-file mr-1"></i>Rekap Pembeli</a>
                      <form action="{{ route('admin.buyer-granat') }}" action="GET">
                        <div class="form-group row">
                          <div class="col-md-8 col-sm-12 row ml-3 mr-1">
                            <select style="margin-top: 5px;" name="prodi" id="prodi" class="form-control col-12 ml-3">
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
                          </div>
                          <div class="col-md-2 col-sm-12">
                            <button style="margin-top: 5px;" type="submit" class="btn btn-primary"><span class="fa fa-filter"></span> Filter</button>
                          </div>
                        </div>
                      </form>
                    </div>
                </div>
                <table id="table" class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama Mahasiswa</th>
                            <th scope="col">NIM</th>
                            <th scope="col">Program Studi</th>
                            <th scope="col">No telp</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (isset($granat))
                            @foreach ($granat as $i =>$granatd)
                            <tr>
                                <td>{{ $i + 1 }}</td>
                                <td>{{ $granatd->namamhs }}</td>
                                <td>{{ $granatd->nim }}</td>
                                <td>{{ $granatd->prodi_name }}</td>
                                <td>{{ $granatd->telp }}</td>
                            </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>


@endsection
