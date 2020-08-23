@extends('layouts.beranda-layout')

@section('active9')
    active
@endsection

@section('custom_style')
    <style type="text/css">
    .title-right {
        float: right;
    }

    .title-left {
        display: inline;
}

        @media screen {
            @font-face {
                font-family: 'Lato';
                font-style: normal;
                font-weight: 400;
                src: local('Lato Regular'), local('Lato-Regular'), url(https://fonts.gstatic.com/s/lato/v11/qIIYRU-oROkIk8vfvxw6QvesZW2xOQ-xsNqO47m55DA.woff) format('woff');
            }

            @font-face {
                font-family: 'Lato';
                font-style: normal;
                font-weight: 700;
                src: local('Lato Bold'), local('Lato-Bold'), url(https://fonts.gstatic.com/s/lato/v11/qdgUG4U09HnJwhYI-uK18wLUuEpTyoUstqEm5AMlJo4.woff) format('woff');
            }

            @font-face {
                font-family: 'Lato';
                font-style: italic;
                font-weight: 400;
                src: local('Lato Italic'), local('Lato-Italic'), url(https://fonts.gstatic.com/s/lato/v11/RYyZNoeFgb0l7W3Vu1aSWOvvDin1pK8aKteLpeZ5c0A.woff) format('woff');
            }

            @font-face {
                font-family: 'Lato';
                font-style: italic;
                font-weight: 700;
                src: local('Lato Bold Italic'), local('Lato-BoldItalic'), url(https://fonts.gstatic.com/s/lato/v11/HkF_qI1x_noxlxhrhMQYELO3LdcAZYWl9Si6vvxL-qU.woff) format('woff');
            }
        }

        /* CLIENT-SPECIFIC STYLES */
        body,
        table,
        td,
        a {
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
        }

        table,
        td {
            mso-table-lspace: 0pt;
            mso-table-rspace: 0pt;
        }

        img {
            -ms-interpolation-mode: bicubic;
        }

        /* RESET STYLES */
        img {
            border: 0;
            height: auto;
            line-height: 100%;
            outline: none;
            text-decoration: none;
        }

        background{
            opacity: 0.5;
        }

        table {
            border-collapse: collapse !important;
        }

        body {
            height: 100% !important;
            margin: 0 !important;
            padding: 0 !important;
            width: 100% !important;
        }

        /* iOS BLUE LINKS */
        a[x-apple-data-detectors] {
            color: inherit !important;
            text-decoration: none !important;
            font-size: inherit !important;
            font-family: inherit !important;
            font-weight: inherit !important;
            line-height: inherit !important;
        }

        /* MOBILE STYLES */
        @media screen and (max-width:600px) {
            h1 {
                font-size: 32px !important;
                line-height: 32px !important;
            }
        }

        /* ANDROID CENTER FIX */
        div[style*="margin: 16px 0;"] {
            margin: 0 !important;
        }
    </style>
        @endsection

@section('content')
    <h2 class="mb-4"><i class="fas fa-fw fa-file-pdf"></i> Penugasan</h2>
    <div class=" alert alert-danger">
        <i class="fa fa-exclamation-circle text-danger"></i> <strong>Sisa Waktu Pengumpulan Tugas:</strong>
        <span class="badge badge-pill badge-danger" id="demo"></span>
        <br>
        <span>Upload Semua Penugasan melalui Google Form yang Telah Disediakan Sebelum Tenggat Waktu Pengumpulan Berakhir</span>
    </div>
    
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
        <table border="0" cellpadding="0" cellspacing="0" width="100%">
            <?php 
                    $serverdate = date("d-m-Y");
                    if($serverdate == '22-08-2020'){
                        $datecond = 1;
                    }else{
                        $datecond = 0;
                    }
            ?>
            <!-- LOGO -->
            <tr>
                <td bgcolor="#010000" align="center" style="padding: 0px 10px 0px 10px;">
                    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                    <td bgcolor="#010000" align="center">
                        <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                            <tr>
                                <p style="font-size: 40px; font-weight:400px; color: #c3862d; margin-top:20px;">PENGUMPULAN PENUGASAN<br>STUDENT DAY 2020</p>
                            </tr>
                        </table>
                    </td>
                    <tr>
                        <td bgcolor="#010000" align="center" style=" background-position: center;background-image:url('{{ asset('/img/logo-sd-2020.png') }}');background-size: 200px 200px; background-repeat: no-repeat; padding: 90px 110px 120px 110px; color: #c3862d; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">
                            
                        </td>
                    </tr>
                        <tr>
                            <td bgcolor="#010000" align="center" style="padding: 20px 30px 40px 30px; color: #c3862d; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">
                                
                                <p id="tugas"> Silahkan Melakukan Pengumpulan Penugasan dengan Menekan Tombol dibawah ini <br><br> 
                                    @if ($datecond != 0)
                                        <a id="tugas1" style="border-radius:7px;background-color:#c3862d ;border: none;color: white;padding: 10px 20px;text-align: center;text-decoration: none;display: inline-block;font-size: 15px;" href="#">Penugasan</a>
                                        <a id="tugas2" style="border-radius:7px;margin-left:10px;background-color:#c3862d ;border: none;color: white;padding: 10px 20px;text-align: center;text-decoration: none;display: inline-block;font-size: 15px;" href="#">Resume 2</a>
                                        <a id="tugas3" style="border-radius:7px;margin-left:10px;background-color:#c3862d ;border: none;color: white;padding: 10px 20px;text-align: center;text-decoration: none;display: inline-block;font-size: 15px;" href="#">Resume 1</a>
                                    @endif
                                </p>
                                    

                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            @foreach ($cek as $ceks)
            @if($ceks->notes_ilmiah != NULL)
            <tr>
                <td bgcolor="#fff" align="center" style="padding: 0px 10px 0px 10px;">
                    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                    <td bgcolor="#fff" align="center">
                        <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                            <tr>
                                <p style="font-size: 40px; font-weight:400px; color: #010000;margin-top:20px;">PENGUMPULAN PENUGASAN KHUSUS</p>
                            </tr>
                        </table>
                    </td>
                    <tr>
                        <td bgcolor="#fff" align="center" style=" background-position: center;background-image:url('{{ asset('/img/logo-sd-2020-black.png') }}');background-size: 200px 200px; background-repeat: no-repeat; padding: 60px 110px 120px 110px; color: #c3862d; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">
                            
                        </td>
                    </tr>
                        <tr>
                            <td bgcolor="#fff" align="center" style="padding: 20px 30px 40px 30px; color: #010000; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">
                                
                                <p id="khusus1"> Silahkan Melakukan Pengumpulan Penugasan Khusus Dengan Menekan Tombol dibawah ini <br><br> 
                                    @if($datecond != 0)
                                    <a id="khusus" style="background-color:#010000 ;border: none;color: white;padding: 10px 20px;text-align: center;text-decoration: none;display: inline-block;font-size: 15px;" href="#">Link Google Form</a>
                                    @endif
                                </p>
                                
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            @endif
            @endforeach
        </table>
@endsection

@section('custom_javascript')
<script>
    $(document).ready(function(){
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
            }
        });

        function getCount(){
            var data;
            $.ajax({
                url: "/getCountPenugasan/",
                async: false,
                type: "GET",
                success: function(result){
                    data = result;
                }
            });

            var d = new Date();
            var theDate = d.getFullYear() + '-' + ( d.getMonth() ) + '-' + d.getDate();
            var theTime = theDate + " " + data;

            return theTime;
        }

        var times = getCount();
        var countone = new Date(times).getTime();
        var countDownDate = new Date("Sep 11, 2020 10:15:00").getTime();
      // Get today's date and time
      var now = new Date().getTime();
        
      // Find the distance between now and the count down date
      var distance = countDownDate - now;
        console.log(countone);
        console.log(distance);
    });
    // Set the date we're counting down to
    
    // Update the count down every 1 second
    var x = setInterval(function() {
        var countDownDate = new Date("Sep 11, 2020 10:15:00").getTime();
    
      // Get today's date and time
      var now = new Date().getTime();
        
      // Find the distance between now and the count down date
      var distance = countDownDate - now;
        
      // Time calculations for days, hours, minutes and seconds
      var days = Math.floor(distance / (1000 * 60 * 60 * 24));
      var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
      var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
      var seconds = Math.floor((distance % (1000 * 60)) / 1000);
        
      // Output the result in an element with id="demo"
      document.getElementById("demo").innerHTML = minutes + " Menit " + seconds + " Detik ";
        
      // If the count down is over, write some text 
      if (distance < 0) {
        clearInterval(x);
        document.getElementById("demo").innerHTML = "Waktu Pengumpulan Sudah Habis";
        document.getElementById("tugas").innerHTML = "Waktu Pengumpulan Sudah Habis";
        document.getElementById("khusus1").innerHTML = "Waktu Pengumpulan Sudah Habis";
        document.getElementById("tugas1").style.display = "none";
        document.getElementById("tugas2").style.display = "none";
        document.getElementById("khusus").style.display = "none";
      }
    }, 1000);
    </script>
    <script>
        // Set the date we're counting down to
        var countDown = new Date("Sep 11, 2020 05:30:00").getTime();
        
        // Update the count down every 1 second
        var x = setInterval(function() {
        
          // Get today's date and time
          var now = new Date().getTime();
            
          // Find the distance between now and the count down date
          var distance = countDown - now;
            
          // Time calculations for days, hours, minutes and seconds
          var days = Math.floor(distance / (1000 * 60 * 60 * 24));
          var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
          var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
          var seconds = Math.floor((distance % (1000 * 60)) / 1000);
            
          // Output the result in an element with id="demo"
          document.getElementById("demo").innerHTML = minutes + " Menit " + seconds + " Detik ";
            
          // If the count down is over, write some text 
          if (distance < 0) {
            clearInterval(x);
            document.getElementById("tugas3").style.display = "none";
          }
        }, 1000);
        </script>
@endsection