@extends('studentday.user.app')

@section('content')

<div class="page-wrapper">
    <div class="page-content--bge5">
        <div class="container">
            <div class="login-wrap">
                <div class="login-content">
                    <div class="login-logo">
                        <a href="#">
                            <img src="{{ asset('dashboard/images/icon/logo.png') }}" alt="CoolAdmin">
                        </a>
                    </div>
                    <div class="login-form">
                        <form action="{{ route('login') }}" method="POST">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            @include('studentday.user.inc.alert')
                            <div class="form-group">
                                <label>No Induk Mahasiswa</label>
                                <input class="au-input au-input--full" type="text" name="nim" placeholder="Masukan NIM">
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input class="au-input au-input--full" type="password" name="password" placeholder="Masukan Password">
                            </div>
                            <button class="au-btn au-btn--block au-btn--blue m-b-20" type="submit">sign in</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection
