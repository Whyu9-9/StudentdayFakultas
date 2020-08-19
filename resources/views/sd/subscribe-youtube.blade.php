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
    <div class="alert alert-info alert-dismissible fade show" role="alert">
        <i class="text-info fas fa-check mr-1"></i> Kamu Harus Subscribe Youtube untuk dapat melanjutkan verifikasi
    </div>
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
                        // $('#revoke-access-button').click(function() {
                        //     revokeAccess();
                        // });

                        /*
                            0 = belom subscribe keduanya
                            1 = sudah subscribe Dies
                            2 = sudah subscribe granat
                            3 = sudah subscribe keduanya
                        */
                        $('#subscribe-granat-button').click(function(){
                            addSubscription('UCre86jyive2sXJMBLLzlsAA',2);
                        });
                        $('#subscribe-dies-button').click(function(){
                            addSubscription('UCre86jyive2sXJMBLLzlsAA',1);
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

                function revokeAccess() {
                    GoogleAuth.disconnect();
                }

                function setSigninStatus(isSignedIn) {
                    var user = GoogleAuth.currentUser.get();
                    var isAuthorized = user.hasGrantedScopes(SCOPE);
                    if (isAuthorized) {
                        $('#sign-in-or-out-button').html('Keluar');
                        // $('#revoke-access-button').css('display', 'inline-block');
                        $('#subscribe-dies-button').css('display', 'inline-block');
                        $('#subscribe-granat-button').css('display', 'inline-block');
                        $('#auth-status').html('Akun Youtube Telah Masuk.');
                    } else {
                        $('#sign-in-or-out-button').html('Masuk');
                        $('#subscribe-dies-button').css('display', 'none');
                        $('#subscribe-granat-button').css('display', 'none');
                        // $('#revoke-access-button').css('display', 'none');
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
                            // alert("Subscripion failed");
                            // console.log(response);
                        }
                    });
                }

                //762488036227-brcukcoud1kmvg61guud23u2vhif3t0b.apps.googleusercontent.com client_id
                //MMgLpypJYtd6FOOdKowCW1iK gaktau apa
                //AIzaSyD3-XWcUh6WBkCMm52idLuOPL-scuoV03Y api
                // var x = authenticate().then(loadClient);
                // console.log(x);
            </script>

            <div class="col-12 px-0">
                <label for="bukti-pembayaran"><strong>Login Akun Youtube</strong><span class="text-danger">*</span></label>
                <small>Pastikan Email yang digunakan sama dengan di biodata.</small>
            </div>
            <div class="col-12 px-0">
                <button id="sign-in-or-out-button" class="btn btn-primary my-2"><i class="fa fa-edit"></i> Masuk</button>
                <p id="auth-status"></p>
            </div>

            <div class="col-12 px-0">
                <label for="bukti-pembayaran"><strong>Subscribe Akun Youtube</strong><span class="text-danger">*</span></label>
            </div>
            <div class="col-12 px-0">
                @if(count($dies) == 0)
                    <button id="subscribe-dies-button" class="btn btn-danger my-2 subscribe-access-button dies"><i class="fab fa-youtube"></i> Subscribe Dies</button>
                @endif
                @if(count($granat) == 0)
                    <button id="subscribe-granat-button" class="btn btn-danger subscribe-access-button my-2 granat"><i class="fab fa-youtube"></i> Subscribe Granat</button>
                @endif
            </div>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
            <script async defer src="https://apis.google.com/js/api.js"
                    onload="this.onload=function(){};handleClientLoad()"
                    onreadystatechange="if (this.readyState === 'complete') this.onload()">
            </script>
        </div>
    </div>
@endsection