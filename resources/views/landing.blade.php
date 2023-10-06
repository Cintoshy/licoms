<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link rel="icon" type="image/png" href="{{ asset('img/icon.png') }}">
    <title>LICOMS</title>
</head>
<body>  
    <div class="container">
        <div class="row" id="card-row">
            <div class="read">
                <div class="ask">
                    <div class="header">
                        <h6 class="m-0">Camarines Sur Polytechnic Colleges</h6>
                        <h6 class="m-0">Nabua, Camarines Sur</h6>
                    </div>
                    <img class="img-fluid logo" src="img/icon.png">
                    <h6 class="sub-title">LIBRARY COLLECTION MAPPING SYSTEM</h6> 
                        @if(Session::has('error'))
                      <div class="alert alert-danger mt-3" role="alert">
                          {{ Session::get('error') }}
                      </div>
                      @endif
                      <!-- Logout Successfully Sign  -->
                    @if(Session::has('success'))
                      <div class="alert alert-success mt-3 p-2" role="alert">
                          {{ Session::get('success') }}
                      </div>
                      @endif
                    <hr class="bg-dark"> <!-- Horizontal line as a divider -->
                    <div class="my-3 button-mail px-1">
                        <a class="btn btn-danger w-100" href="{{ route('login') }}" title="Login to CSPC Mail">
                            <img src="{{ asset('img/google.png') }}" style="width:18px">
                            &nbsp; CSPC Mail
                        </a>
                        <p class="mb-4">Note: Login to CSPC Mail</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
