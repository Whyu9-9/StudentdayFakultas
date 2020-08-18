@extends('layouts.beranda-layout')

@section('active9')
    active
@endsection

@section('content')
    <h2 class="mb-4"><i class="fa fa-sticky-note"></i> Penugasan</h2>
    
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
    
    @if(Auth::user()->lengkap == 6)
        @if (isset($cek))
        <div class="alert alert-danger">
            <i class="fa fa-exclamation-circle"></i> Terdapat Kesalahan pada Verifikasi Ulang. <br>
            <ul>
                <?php
                    $i = count($cek);
                ?>
                @foreach ($cek as $note)
                    <li style="margin-left: -9px;">{{date($note->created_at)}} - {{$note->notes}}</li>
                @endforeach
            </ul>
        </div>
        @endif
        
        <div class="card">
            <div class="card-header">
                <h3>Tugas Khusus</h3>
                <a href="https://drive.google.com/drive/folders/1IV9a69E5z11QD11X8hpw5pIVlol2LBab?usp=sharing" target="_blank">Link Soal Tugas Khusus</a>
            </div>
            <div class="card-body text-center">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Keterangan</th>
                            @if(count($tugas_khusus) == 0)
                            <th>File</th>
                            <th>Action</th>
                            @else
                            <th>Status</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($tugas_khusus) == 0)
                        <form action="/beranda-sd-penugasan" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <tr>
                                <td>1</td>
                                <td>Tugas Khusus
                                    <!--if(!$hasil)
                                    <div id="time"></div></td>
                                    endif-->
                                <td>
                                    <!--if($hasil)
                                    <strong>Expired</strong>
                                    else-->
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input berkas" id="tugas" name="tugas">
                                        <label id="label-tugas" class="custom-file-label" for="tugas">Choose file</label>
                                        <input type="hidden" name="tipe" value="tugas_khusus">
                                    </div>
                                </td>
                                <td>
                                    <button type="submit" class="btn btn-primary">Upload</button>
                                    <!--if($hasil)
                                    <strong>Expired</strong>
                                    else
                                    <button class="btn btn-primary"><i class="fa fa-paper-plane"></i> Kirim</button>
                                    endif-->
                                    {{-- <button class="btn btn-success">Unduh</button>
                                    <button class="btn btn-danger">Hapus</button> --}}
                                </td>
                            </tr>
                        </form>
                        @else
                            <tr>
                                <td>1</td>
                                <td>Tugas Khusus</td>
                                <td colspan="2">
                                    <span class="badge badge-success">Sudah Upload Tugas</span>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                
                @if($errors->has('tugas'))
                    <span class="text-danger" role="alert">
                        <strong>{{ $errors->first('tugas') }}</strong>
                    </span> 
                @endif
            </div>
        </div>
    @endif
    
    
    @if (Auth::user()->lengkap == 8)
        <div class="card">
            <div class="card-header">
                <h3>Jawab Soal</h3>
            </div>
            <div class="card-body text-center">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Keterangan</th>
                            @if(count($jawab_soal) == 0)
                            <th>File</th>
                            <th>Action</th>
                            @else
                            <th>Status</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                            {{-- @if(count($jawab_soal) == 0)
                                @foreach ($listTugas as $i => $list)
                                    @if ($list->tipe == 'jawab_soal')
                                    @endif
                                @endforeach
                            @else --}}
                            <?php
                                $countjawabsoal = count($jawab_soal);
                            ?>
                                @foreach ($listTugas as $i => $list)
                                    @if($list->tipe == 'jawab_soal')
                                        @foreach ($jawab_soal as $j => $soal)
                                            @if ($soal->penugasan_id == $list->id)
                                                <tr>
                                                    <td>{{$i+1}}</td>
                                                    <td>{{$list->keterangan}}</td>
                                                    <td colspan="2">
                                                        <span class="badge badge-success">Sudah Upload Tugas</span>
                                                    </td>
                                                </tr>
                                            @elseif($j == $countjawabsoal)
                                                <form action="{{ route('beranda-sd-penugasan-soal', ['id'=>$list->id]) }}" method="post" enctype="multipart/form-data">
                                                    {{ csrf_field() }}
                                                    <tr>
                                                        <td>{{$i+1}}</td>
                                                        <td>{{$list->keterangan}}</td>
                                                        <td>
                                                            <div class="custom-file">
                                                                <input type="file" class="custom-file-input berkas" id="tugas" name="tugas">
                                                                <label id="label-resume" class="custom-file-label" for="resume">Choose file</label>
                                                                <input type="hidden" name="tipe" value="jawab_soal">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            @if ($list->file != null)
                                                                <a href="{{ route('beranda-sd-penugasan-download-soal', ['id'=>$list->id]) }}" class="btn btn-danger text-white">Soal</a>
                                                            @endif
                                                            <button type="submit" class="btn btn-primary">Upload</button>
                                                        </td>
                                                    </tr>
                                                </form>
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach
                            {{-- @endif --}}
                    </tbody>
                </table>
                
                @if($errors->has('tugas'))
                    <span class="text-danger" role="alert">
                        <strong>{{ $errors->first('tugas') }}</strong>
                    </span> 
                @endif
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h3>Essay</h3>
            </div>
            <div class="card-body text-center">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Keterangan</th>
                            @if(count($essay) == 0)
                            <th>File</th>
                            <th>Action</th>
                            @else
                            <th>Status</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                            @if(count($essay) == 0)
                            <form action="{{ route('beranda-sd-penugasan-essay') }}" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <tr>
                                    <td>1</td>
                                    <td>
                                        @foreach ($listTugas as $list)
                                        @if($list->tipe == 'essay')
                                            {{$list->keterangan}}
                                        @endif
                                        @endforeach
                                        <!--if(!$hasil)
                                        <div id="time"></div></td>
                                        endif-->
                                    <td>
                                        <!--if($hasil)
                                        <strong>Expired</strong>
                                        else-->
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input berkas" id="tugas" name="tugas">
                                            <label id="label-resume" class="custom-file-label" for="tugas">Choose file</label>
                                            <input type="hidden" name="tipe" value="essay">
                                        </div>
                                    </td>
                                    <td>
                                        <button type="submit" class="btn btn-primary">Upload</button>
                                        <!--if($hasil)
                                        <strong>Expired</strong>
                                        else
                                        <button class="btn btn-primary"><i class="fa fa-paper-plane"></i> Kirim</button>
                                        endif-->
                                        {{-- <button class="btn btn-success">Unduh</button>
                                        <button class="btn btn-danger">Hapus</button> --}}
                                    </td>
                                </tr>
                            </form>
                            @else
                                <tr>
                                    <td>1</td>
                                    <td>
                                        @foreach ($listTugas as $list)
                                            @if($list->tipe == 'essay')
                                                {{$list->keterangan}}
                                            @endif
                                        @endforeach</td>
                                    <td colspan="2">
                                        <span class="badge badge-success">Sudah Upload Tugas</span>
                                    </td>
                                </tr>
                            @endif
                    </tbody>
                </table>
                
                @if($errors->has('tugas'))
                    <span class="text-danger" role="alert">
                        <strong>{{ $errors->first('tugas') }}</strong>
                    </span> 
                @endif
            </div>
        </div>
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
                            @if(count($resume) == 0)
                            <th>File</th>
                            <th>Action</th>
                            @else
                            <th>Status</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @if ($checktime == null)
                            <tr>
                                <td colspan="4">Waktu Upload Belum Tersedia</td>
                            </tr>
                        @else
                            @if(count($resume) == 0)
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
                                            <input type="file" class="custom-file-input berkas" id="resume" name="resume">
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
    @elseif(Auth::user()->lengkap == 0 || Auth::user()->lengkap == 1 || Auth::user()->lengkap == 3)
        <div class="alert alert-warning">
            <i class="fa fa-exclamation-circle"></i> Pendaftaran Student Day anda belum terverifikasi. <br>
            <a href="/beranda-sd/{{ Auth::user()->id }}/edit" class="btn btn-primary mt-3"><i class="fa fa-edit"></i> Lihat biodata</a>
        </div>
    @elseif(Auth::user()->lengkap == 2 || Auth::user()->lengkap == 9)
        <div class="alert alert-danger">
            <i class="fa fa-exclamation-circle"></i> Terdapat Kesalahan pada biodata. Perbaiki kesalahan lalu ajukan perbaikan pendaftaran kembali. <br>
            <a href="/beranda-sd/{{ Auth::user()->id }}/edit" class="btn btn-primary mt-3"><i class="fa fa-edit"></i> Perbaiki biodata</a>
        </div>
    @elseif(Auth::user()->lengkap == 4 || Auth::user()->lengkap == 5 || Auth::user()->lengkap == 7)
        <div class="alert alert-primary">
            <i class="fa fa-exclamation-circle"></i> Akun Anda belum terverifikasi. Tunggu hingga semua data terverifikasi untuk dapat mengerjakan penugasan. <br>
        </div>
    @endif
@endsection

@section('custom_javascript')
    <script>
        $("#tugas").change(function() {
            var name = this.files[0].name;
            var label = this.nextElementSibling;
            label.textContent = name;
        })

        $(".berkas").change(function() {
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