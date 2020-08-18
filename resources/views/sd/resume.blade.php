@extends('layouts.beranda-layout')

@section('active7')
    active
@endsection

@section('content')
    <h2 class="mb-4"><i class="fa fa-sticky-note"></i> Resume</h2>
    
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

    @if(Session::has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="text-success fas fa-check mr-1"></i> {{Session::get('success')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @elseif(Session::has('failed'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="text-success fas fa-check mr-1"></i> {{Session::get('failed')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>  
    @endif
    @if (Auth::user()->lengkap == 8)
        <div class="card">
            <div class="card-header">
                <h3>Resume</h3>
            </div>
            <div class="card-body text-center">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Keterangan</th>
                            @if(count($resume) === 0)
                            <th>File</th>
                            <th>Action</th>
                            @else
                            <th>Status</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @if ($checktime === null)
                            <tr>
                                <td colspan="4">Waktu Upload Belum Tersedia</td>
                            </tr>
                        @else
                            @if(count($resume) === 0)
                            <form action="/beranda-sd-resume" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <tr>
                                    <td>1</td>
                                    <td>Acara Pertama
                                        @if(!$hasil)
                                        <div id="time"></div></td>
                                        @endif
                                    <td>
                                        @if($hasil)
                                        <strong>Expired</strong>
                                        @else
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="resume" name="resume">
                                            <label id="label-resume" class="custom-file-label" for="resume">Choose file</label>
                                        </div>
                                        @endif
                                    </td>
                                    <td>
                                        @if($hasil)
                                        <strong>Expired</strong>
                                        @else
                                        <button class="btn btn-primary"><i class="fa fa-paper-plane"></i> Kirim</button>
                                        @endif
                                        {{-- <button class="btn btn-success">Unduh</button>
                                        <button class="btn btn-danger">Hapus</button> --}}
                                    </td>
                                </tr>
                            </form>
                            @else
                                <tr>
                                    <td>1</td>
                                    <td>Acara Pertama</td>
                                    <td colspan="2">
                                        <span class="badge badge-success">Sudah Upload Resume</span>
                                    </td>
                                </tr>
                            @endif
                        @endif
                    </tbody>
                </table>
                
                @if($errors->has('resume'))
                    <span class="text-danger" role="alert">
                        <strong>{{ $errors->first('resume') }}</strong>
                    </span> 
                @endif
            </div>
        </div>
    @elseif(Auth::user()->lengkap === 0 || Auth::user()->lengkap === 1 || Auth::user()->lengkap === 2 || Auth::user()->lengkap === 3 || Auth::user()->lengkap === 4)
        <div class="alert alert-warning">
            <i class="fa fa-exclamation-circle"></i> Biodata Anda belum lengkap. Lengkapi biodata untuk dapat mencetak berkas Student Day. <br>
            <a href="/beranda-sd/{{ Auth::user()->id }}/edit" class="btn btn-primary mt-3"><i class="fa fa-edit"></i> Lengkapi biodata</a>
        </div>
    @elseif(Auth::user()->lengkap === 6)
        <div class="alert alert-danger">
            <i class="fa fa-exclamation-circle"></i> Terdapat Kesalahan pada biodata atau verifikasi ulang. Perbaiki kesalahan untuk mencetak berkas Student Day <br>
            <a href="/beranda-sd/{{ Auth::user()->id }}/edit" class="btn btn-primary mt-3"><i class="fa fa-edit"></i> Perbaiki biodata</a>
            <a href="/beranda-sd/verifikasi" class="btn btn-primary mt-3"><i class="fa fa-edit"></i> Perbaiki Verifikasi Ulang</a>
        </div>
    @elseif(Auth::user()->lengkap === 5 || Auth::user()->lengkap === 7)
        <div class="alert alert-primary">
            <i class="fa fa-exclamation-circle"></i> Akun Anda belum terverifikasi. Tunggu hingga semua data terverifikasi untuk dapat mencetak berkas Student Day. <br>
        </div>
    @endif
@endsection

@section('custom_javascript')
    <script>
        $("#resume").change(function() {
            var name = this.files[0].name;
            var label = this.nextElementSibling;
            label.textContent = name;
        })
    </script>

    <script src="/js/countdown.min.js"></script>
    
    <script> 
    function timekeeper(){
        $.ajax({
            url: '/get/time/resume',
            type: 'GET',
            success: function(data){
                var time = new Date(data);
                // console.log(time);
                
                var timerId =countdown(time, function(ts) {
                    // console.log(ts);
                    document.getElementById('time').innerHTML = ts.toHTML("strong");
                },
                countdown.HOURS|countdown.MINUTES|countdown.SECONDS);
            },
            error: function(data){
            },
        });
    }
    timekeeper();
    // var timerId =countdown(new Date('2020-08-05T05:41:00'), function(ts) {
    //     console.log(ts);
    //     document.getElementById('test').innerHTML = ts.toHTML("strong");
    // },
    // countdown.HOURS|countdown.MINUTES|countdown.SECONDS);

        // later on this timer may be stopped
        // window.clearInterval(timerId);
    </script>
@endsection