@extends('layouts.admin-layout')

@section('content')
    <h2 class="mb-4"><i class="fa fa-user"></i> Ganti Password</h2>  
    @if(Session::has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="text-success fas fa-check mr-1"></i> {{Session::get('success')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if(Session::has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="text-danger fas fa-check mr-1"></i> {{Session::get('error')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if(Session::has('info'))
        <div class="alert alert-info alert-dismissible fade show" role="alert">
            <i class="text-info fas fa-check mr-1"></i> {{Session::get('info')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <div class="card mb-4">
        <div class="card-body">
        <form method="POST" action="{{ route('admin.password-reset') }}">
                @csrf
                <div class="form-group row">
                    <label class="label-control col-sm-2">Password Lama :</label>
                    <div class="col-sm-6">
                        <input type="password" name="password_lama" class="form-control">
                        @if($errors->has('password_lama'))
                            <small class="text-danger">{{ $errors->first('password_lama') }}</small>
                        @endif
                        @if(session('error'))
                            <small class="text-danger">{{ session('error') }}</small>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label class="label-control col-sm-2">Password Baru :</label>
                    <div class="col-sm-6">
                        <input type="password" name="password" class="form-control">
                        @if($errors->has('password'))
                            <small class="text-danger">{{ $errors->first('password') }}</small>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label class="label-control col-sm-2">Ulang Password Baru :</label>
                    <div class="col-sm-6">
                        <input type="password" name="password_confirmation" class="form-control">
                        @if($errors->has('password_confirmation'))
                            <small class="text-danger">{{ $errors->first('password_confirmation') }}</small>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2"></label>
                    <div class="col-sm-2">
                        <button type="submit" class="btn btn-success btn-block">
                            <i class="fa fa-save"></i> Simpan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection