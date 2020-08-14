<!DOCTYPE html>
<html>

<head>
    <title>QR Code</title>
    <link rel="icon" href="{{ asset('/img/favicon.png') }}">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <style type="text/css">
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
</head>

<body style="background-color: #fff; margin: 0 !important; padding: 0 !important;">
    @if ($user->program_studi === '6' || $user->program_studi === '7')
        <table border="0" cellpadding="0" cellspacing="0" width="100%">
            <!-- LOGO -->
            <tr>
                <td bgcolor="#fff" align="center">
                    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                        <tr>
                            <td align="center" valign="top" style="padding: 40px 10px 40px 10px;"> </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td bgcolor="#fff" align="center" style="padding: 0px 10px 0px 10px;">
                    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                        <tr>
                            <td bgcolor="#fff" align="center" valign="top" style="padding: 10px 10px 10px 10px; border-radius: 4px 4px 0px 0px; color: #c3862d; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 48px; font-weight: 400; letter-spacing: 3px; line-height: 48px;">
                                <h1 style="font-size: 20px; font-weight: 700; margin: 2;">Hai, {{$user->nama}}!<br> Selamat, kamu telah terdaftar pada Student Day Fakultas Teknik 2020.</h1> 
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td bgcolor="#fff" align="center" style="padding: 0px 10px 0px 10px;">
                    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                        <tr>
                            <td bgcolor="#fff" align="center" style="padding: 20px 30px 40px 30px; color: #c3862d; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 15px; font-weight: 400; line-height: 25px;">
                                <p>Silahkan bergabung dengan grup LINE Program Studi dengan men-scan QR Code dibawah ini</p>
                                @if($user->program_studi === '6')
                                    <img src="{{url('/img/qrcode/tekniklingkungan2020.png')}}" alt="" style="max-height: 400px">
                                @elseif($user->program_studi === '7')
                                    <img src="{{url('/img/qrcode/teknikindustri2020.png')}}" alt="" style="max-height: 400px">
                                @endif
                                <p>
                                    @if($user->koordinator === '1')
                                        Kamu dipilih sebagai Koordinator Angkatan Program Studi!
                                    @endif
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td bgcolor="#fff" align="left" style="padding: 0px 30px 20px 30px; color: #c3862d; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">
                                
                            </td>
                        </tr>
                        <tr>
                            <td bgcolor="#fff" align="center" style="padding: 0px 30px 40px 30px; border-radius: 0px 0px 4px 4px; color: #c3862d; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">
                                <p style="margin: 0;">Regards,<br>Admin SMFT</p>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td bgcolor="#fff" align="center" style="padding: 30px 10px 0px 10px;">
                    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                        <tr>
                            <td bgcolor="#fff" align="center" style="padding: 30px 30px 30px 30px; border-radius: 4px 4px 4px 4px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">
                                <h2 style="font-size: 20px; font-weight: 400; color: #c3862d; margin: 0;"></h2>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    @else
    <table border="0" cellpadding="0" cellspacing="0" width="100%">
        <!-- LOGO -->
        <tr>
            <td bgcolor="#fff" align="center">
                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                    <tr>
                        <td align="center" valign="top" style="padding: 40px 10px 40px 10px;"> </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td bgcolor="#fff" align="center" style="padding: 0px 10px 0px 10px;">
                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                    <tr>
                        <td bgcolor="#fff" align="center" valign="top" style="padding: 10px 10px 10px 0px; border-radius: 4px 4px 0px 0px; color: #c3862d; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 48px; font-weight: 400; letter-spacing: 3px; line-height: 48px;">
                            <h1 style="font-size: 20px; font-weight: 700; margin: 2;">Hai, {{$user->nama}}!<br> Selamat, kamu telah terdaftar pada Student Day Fakultas Teknik 2020.</h1> 
                        </td>
                    </tr>
                    <tr>
                        <td bgcolor="#fff" align="center" valign="top" style="padding: 10px 10px 20px 20px; border-radius: 4px 4px 0px 0px; color: #c3862d; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 15px; font-weight: 400;">
                            <p>Silahkan bergabung dengan grup LINE Program Studi dengan men-scan QR Code dibawah ini</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td bgcolor="#010000" align="center" style="padding: 0px 10px 0px 10px;">
                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                    <tr>
                        <td bgcolor="#010000" align="center" style="padding: 20px 30px 40px 30px; color: #d8a547; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">
                            @if ($user->program_studi === '1')
                                <img src="{{url('/img/qrcode/teknikarsitektur2020.png')}}" alt="" style="max-height: 400px">
                            @elseif($user->program_studi === '2')
                                <img src="{{url('/img/qrcode/tekniksipil2020.png')}}" alt="" style="max-height: 400px">
                            @elseif($user->program_studi === '3')
                                <img src="{{url('/img/qrcode/teknikelektro2020.png')}}" alt="" style="max-height: 400px">
                            @elseif($user->program_studi === '4')
                                <img src="{{url('/img/qrcode/teknikmesin2020.png')}}" alt="" style="max-height: 400px">
                            @elseif($user->program_studi === '5')
                                <img src="{{url('/img/qrcode/teknologiinformasi2020.png')}}" alt="" style="max-height: 400px">
                            @endif
                            <p>
                                @if($user->koordinator === '1' || $user->koordinator === 1)
                                    Kamu dipilih sebagai Koordinator Angkatan Program Studi!
                                @endif
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td bgcolor="#010000" align="center" style="padding: 0px 30px 40px 30px; border-radius: 0px 0px 4px 4px; color: #f5d170; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">
                            <p style="margin: 0;">Regards,<br>Admin SMFT</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td bgcolor="#010000" align="center" style="padding: 30px 10px 0px 10px;">
                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                    <tr>
                        <td bgcolor="#010000" align="center" style="padding: 30px 30px 30px 30px; border-radius: 4px 4px 4px 4px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">
                            <h2 style="font-size: 20px; font-weight: 400; color: #f5d170; margin: 0;"></h2>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    @endif
</body>

</html>