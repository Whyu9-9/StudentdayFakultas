@extends('layouts.beranda-layout')

@section('active9')
    active
@endsection

@section('custom_style')
    <style type="text/css">
    #demo {
        text-align: center;
        font-size: 30px;
        background-color: #dc3545;
        color:#FFF;
        padding: 10px;
        margin :0px 230px 40px 230px;
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
    <h3 style="text-align: center;">Sisa Waktu Pengumpulan Tugas</h3>
    <p id="demo"></p>
        <table border="0" cellpadding="0" cellspacing="0" width="100%">
            <!-- LOGO -->
            <tr>
                <td bgcolor="#fff" align="center">
                    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                        <tr>
                            <p style="font-size: 40px; font-family: 'Lato', Helvetica, Arial, sans-serif; font-weight:400px; color: #c3862d">PENGUMPULAN</p>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td bgcolor="#fff" align="center" style="padding: 0px 10px 0px 10px;">
                    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                        <tr>
                            <td bgcolor="#fff" align="center" valign="top" style="padding: 10px 10px 10px 0px; border-radius: 4px 4px 0px 0px; color: #c3862d; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 48px; font-weight: 400; letter-spacing: 3px; line-height: 48px;">
                                <h1 style="font-size: 20px; font-weight: 700; margin: 2;"></h1> 
                                {{-- <img src="https://pasargro.com/assets/img/cart-template/logo.png" width="155" height="150" style="display: block; border: 0px;" /> --}}
                            </td>
                        </tr>
                        <tr>
                            <td bgcolor="#fff" align="center" valign="top" style="padding: 10px 10px 20px 20px; border-radius: 4px 4px 0px 0px; color: #c3862d; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 15px; font-weight: 400;">
                                <p>Silahkan Mengumpulkan Penugasan Dengan Menekan Tombol Dibawah Ini.</p>
                                <p>
                                    <a style="background-color:goldenrod;border: none;color: white;padding: 10px 20px;text-align: center;text-decoration: none;display: inline-block;font-size: 15px;" href="#" style="color: #d8a547 !important;"><strong>Tombol</strong></a>
                                </p>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            @foreach ($cek as $ceks)
            @if($ceks->notes_ilmiah != NULL)
            <tr>
                <td bgcolor="#010000" align="center" style="padding: 0px 10px 0px 10px;">
                    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                    <td bgcolor="#010000" align="center">
                        <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                            <tr>
                                <p style="font-size: 40px; font-family: 'Lato', Helvetica, Arial, sans-serif; font-weight:400px; color: #c3862d">TUGAS KHUSUS</p>
                            </tr>
                        </table>
                    </td>
                        <tr>
                            <td bgcolor="#010000" align="center" style="padding: 20px 30px 40px 30px; color: #c3862d; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">
                                
                                <p> Silahkan Melakukan Pengumpulan Tugas Khusus Dengan Menekan Tombol dibawah ini <br><br> <a style="background-color:#c3862d ;border: none;color: white;padding: 10px 20px;text-align: center;text-decoration: none;display: inline-block;font-size: 15px;" href="#">Tombol</a> </p>
                                
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
    // Set the date we're counting down to
    var countDownDate = new Date("Sep 12, 2020 17:00:00").getTime();
    
    // Update the count down every 1 second
    var x = setInterval(function() {
    
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
      document.getElementById("demo").innerHTML = days + " Hari " + hours + " Jam "
      + minutes + " Menit " + seconds + " Detik ";
        
      // If the count down is over, write some text 
      if (distance < 0) {
        clearInterval(x);
        document.getElementById("demo").innerHTML = "Waktu Pengumpulan Sudah Habis";
      }
    }, 1000);
    </script>
@endsection