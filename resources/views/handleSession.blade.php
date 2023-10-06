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
                    <img class="img-fluid logo mt-3" src="img/icon.png">
                    <h4 class="text-danger fw-bold">CONFIRM</h4>
                    <div class="bg-light">

                        <p class="p-3"><strong>NOTE:</strong> You are already logged in as {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}, you need to log out out before logging in as different user.</p>
                        </div>
                    <hr class="bg-dark"> <!-- Horizontal line as a divider -->
                    <div class="my-3 button-mail px-1">
                        <form action="{{ route('logout') }}" method="post">
                            @csrf
                        <button class="btn btn-primary w-100" type="submit">Logout</button>
                    </form>
                        <a class="btn btn-danger w-100" href="{{ route('cancelLogoutSession') }}" title="Cancel">
                             Cancel
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
