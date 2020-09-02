@extends('layouts.beranda-layout')

@section('active6')
    active
@endsection

@section('content')
    <h2 class="mb-4"><i class="fa fa-user"></i> Subscribe Youtube</h2>
    @if(Session::has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="text-success fas fa-check mr-1"></i> {{Session::get('success')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if(Session::has('errors'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="text-danger fas fa-check mr-1"></i> {{Session::get('errors')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if(auth::user()->mahasiswa_baru <3)
    <div class="alert alert-info alert-dismissible fade show" role="alert">
        <i class="text-info fas fa-check mr-1"></i> Kamu Harus Subscribe Youtube untuk dapat melanjutkan verifikasi
    </div>
    @else
    <div class="alert alert-info alert-dismissible fade show" role="alert">
        <i class="text-info fas fa-check mr-1"></i> Kamu Harus Subscribe Youtube untuk dapat melanjutkan pendaftaran
    </div>
    @endif
    <div class="card mb-4">
        <div class="card-body">
            <script type="text/javascript">
                /**
                 * Sample JavaScript code for youtube.subscriptions.list
                 * See instructions for running APIs Explorer code samples locally:
                 * https://developers.google.com/explorer-help/guides/code_samples#javascript
                 */
                var GoogleAuth;
                var SCOPE = 'https://www.googleapis.com/auth/youtube.force-ssl';
                function handleClientLoad() {
                    // Load the API's client and auth2 modules.
                    // Call the initClient function after the modules load.
                    gapi.load('client:auth2', initClient);
                }

                function initClient() {
                    // Retrieve the discovery document for version 3 of YouTube Data API.
                    // In practice, your app can retrieve one or more discovery documents.
                    var discoveryUrl = 'https://www.googleapis.com/discovery/v1/apis/youtube/v3/rest';

                    // Initialize the gapi.client object, which app uses to make API requests.
                    // Get API key and client ID from API Console.
                    // 'scope' field specifies space-delimited list of access scopes.
                    gapi.client.init({
                        'apiKey': 'AIzaSyD3-XWcUh6WBkCMm52idLuOPL-scuoV03Y',
                        'clientId': '762488036227-brcukcoud1kmvg61guud23u2vhif3t0b.apps.googleusercontent.com',
                        'discoveryDocs': [discoveryUrl],
                        'scope': SCOPE
                    }).then(function () {
                        GoogleAuth = gapi.auth2.getAuthInstance();

                        // Listen for sign-in state changes.
                        GoogleAuth.isSignedIn.listen(updateSigninStatus);

                        // Handle initial sign-in state. (Determine if user is already signed in.)
                        var user = GoogleAuth.currentUser.get();
                        setSigninStatus();

                        // Call handleAuthClick function when user clicks on
                        //      "Sign In/Authorize" button.
                        $('#sign-in-or-out-button').click(function() {
                            handleAuthClick();
                        });

                        $('#revoke-access-button').click(function() {
                            revokeAccess();
                        });

                        $('#subscribe-granat-button').click(function(){
                            addSubscription('UCJiGAXqyzXC74Cli2PDXJuQ',2);
                        });
                        $('#subscribe-dies-button').click(function(){
                            addSubscription('UCn8o1JITHP5p1oemyqyLOSA',1);
                        });

                    });
                }

                function handleAuthClick() {
                    if (GoogleAuth.isSignedIn.get()) {
                        // User is authorized and has clicked "Sign out" button.
                        GoogleAuth.signOut();
                    } else {
                        // User is not signed in. Start Google auth flow.
                        GoogleAuth.signIn();
                    }
                }

                function setSigninStatus(isSignedIn) {
                    var user = GoogleAuth.currentUser.get();
                    var isAuthorized = user.hasGrantedScopes(SCOPE);
                    if (isAuthorized) {
                        $('#sign-in-or-out-button').html('Sign Out');
                        $('#subscribe-dies-button').css('display', 'inline-block');
                        $('#subscribe-granat-button').css('display', 'inline-block');
                        $('#auth-status').html('Akun Youtube Telah Masuk.');
                    } else {
                        $('#sign-in-or-out-button').html('Sign In ke Youtube');
                        $('#subscribe-dies-button').css('display', 'none');
                        $('#subscribe-granat-button').css('display', 'none');
                        $('#auth-status').html('Akun Youtube Belum Masuk');
                    }
                }

                function updateSigninStatus(isSignedIn) {
                    setSigninStatus();
                }

                function addSubscription(channelSub,flag) {
                    var resource = {
                        part: 'id,snippet',
                        snippet: {
                            resourceId: {
                                kind: 'youtube#channel',
                                channelId: channelSub
                            }
                        }
                    };

                    var request = gapi.client.youtube.subscriptions.insert(resource);
                    request.execute(function (response) {
                        var result = response.result;
                        if (result) {
                            window.location.replace("/beranda-sd/verifikasi/subscribed/"+flag);
                        } else {
                            window.location.replace("/beranda-sd/verifikasi/subscribed/"+flag);
                        }
                    });
                }
            </script>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
    <tr>
        <td bgcolor="#010000" align="center" style="padding: 0px 10px 0px 10px;">
            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
            <td bgcolor="#010000" align="center">
                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                    <tr>
                        <p style="font-size: 30px; font-weight:500px; color: #c3862d; margin-top:20px;">Silahkan Melakukan Subscribe Channel Youtube dibawah Sebelum Melanjutkan ke Proses Verifikasi.</p>
                    </tr>
                </table>
            </td>
            <tr>
                <td bgcolor="#010000" align="center" style=" background-position: center;background-image:url('{{ asset('/img/ftunud.png') }}');background-size: 200px 200px; background-repeat: no-repeat; padding: 90px 110px 120px 110px; color: #c3862d; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">
                    
                </td>
            </tr>
                <tr>
                    <td bgcolor="#010000" align="center" style="padding: 20px 30px 40px 30px; color: #c3862d; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">
                        <p> Login Akun Youtube <br> <br> 
                            <button id="sign-in-or-out-button" class="btn btn-primary my-2"></button>
                            <p id="auth-status"></p>
                        </p>
                            @if(count($dies) == 0)
                                <button id="subscribe-dies-button" class="btn btn-danger my-2 subscribe-access-button dies"><i class="fab fa-youtube"></i> Subscribe SMFT</button>
                            @endif
                            
                            @if(count($granat) == 0)
                                <button id="subscribe-granat-button" class="btn btn-danger subscribe-access-button my-2 granat"><i class="fab fa-youtube"></i> Subscribe Granat</button>
                            @endif
                        </p>
                        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
                        <script async defer src="https://apis.google.com/js/api.js"
                                onload="this.onload=function(){};handleClientLoad()"
                                onreadystatechange="if (this.readyState === 'complete') this.onload()">
                        </script>

                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>



<!-- Modal -->

<div class="modal" id="modalReminderYoutube" tabindex="-1" aria-labelledby="modalReminderYoutubetitle" aria-hidden="false">
    <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                        <h5 class="modal-title" id="modalReminderYoutubetitle"></h5>
                        <button id="btn-close-reminder-youtube" type="button" class="close" data-dismiss="modal" aria-label="Close" style="display:none">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-body">
                    <p id="modalReminderYoutubetext"></p>
                    <img src="" alt="" id="modalReminderYoutubeimage" style="width: 100%;">
                </div>

                <div class="modal-footer">
                    <div style="width: 100%;" id="modalReminderYoutubeform">
                    </div>
                </div>
            </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        function reminderYoutube(){
            var check = $('#modalReminderYoutube').hasClass('show');

            $("#modalReminderYoutube").modal({
                backdrop: 'static',
                keyboard: false
            });

            if(!check){
                $('#modalReminderYoutube #modalReminderYoutubetitle').html('REMINDER! Baca Sebelum Subscribe');
                $('#modalReminderYoutube #modalReminderYoutubetext').html('Selama Proses Subscribe diperlukan Login Menggunakan Akun GMAIL yang terhubung ke youtube. ketika login apabila ditampilkan gambar seperti dibawah ini, silahkan klik Advanced, Kemudian tekan Go To StudentDay Fakultas Teknik');
                $('#modalReminderYoutube #modalReminderYoutubeimage').attr('src', '{{ asset('/img/reminder_youtube.jpg') }}');
                $('#modalReminderYoutube').modal('show');
            }
            
            $('#modalReminderYoutube #btn-close-reminder-youtube').hide().delay(3000).show(0);
        }

        reminderYoutube();
    });
</script>
@endsection
