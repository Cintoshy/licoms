<!doctype html>
<html lang="en">
<head>
  
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/style.css">
    <link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <title>LICOMS</title>

</head>
<body>  
    <div class="container">
      <div class="row gx-5 text-center" id="my-custom-row">
        <div class="col-lg-6 col-sm-1" id="my-custom-col">
          <div class="title">
            <h1 class="side-left">WELCOME TO CSPC LICOMS</h1>
            <hr class="side-left bg-dark">
            <h5 class="side-left bolder">LIBRARY COLLECTION MAPPING SYSTEM</h5>
            </div>
          </div>
          <div class="col-lg-6" id="my-custom-col1">
          <section>
            <div class="landing p-3 shadow-lg">
              <div class="text-center">
        
          <img src="img/Logo.png" height="300px">
          <p class="small fw-bold">Library Collection Mapping System</p>
          <!-- Email Login Error Sign  -->
                @if(Session::has('error'))
                  <div class="alert alert-danger" role="alert">
                      {{ Session::get('error') }}
                  </div>
                   @endif
          <!-- Logout Successfully Sign  -->
                 @if(Session::has('success'))
                  <div class="alert alert-success" role="alert">
                      {{ Session::get('success') }}
                  </div>
                   @endif

                   <form action="#" method="POST" class="p-3">
                      @csrf

                      <div class="form-group mb-3">
                          <div class="input-group">
                              <div class="input-group-prepend">
                                  <span class="input-group-text"><i class="fa-solid fa-user p-1"></i></span>
                              </div>
                              <input type="email" class="form-control" id="email" name="email" placeholder="Username/Email">
                          </div>
                      </div>

                      <div class="form-group mb-3">
                          <div class="input-group">
                              <div class="input-group-prepend">
                                  <span class="input-group-text"><i class="fas fa-lock p-1"></i></span>
                              </div>
                              <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                          </div>
                      </div>

                      <div class="mb-3">
                          <button type="submit" class="btn btn-primary w-100">Login <i class="fa-solid fa-right-to-bracket"></i></button>
                      </div>


              <hr class="my-3"> <!-- Horizontal line as a divider -->
              <div class="my-3">
                <a class="btn btn-danger w-100" href="{{ route('login') }}"class="waves-effect waves-light btn red">
                <img src="{{ asset('img/google.png') }}" style="width:18px">
                &nbsp; CSPC Mail</a>
            </div>
            </div>
          </form>
        </section>
        </form>
        </div>
      </div>
        </div>
    </div>


    
    
</body>
</html>