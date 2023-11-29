<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  	<title>LICOMS</title>
    <!-- Custom styles-->
    <!-- Custom fonts for this template-->

    <link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">

    <!-- <link  href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet"> -->

    <!-- Bootstsrap styles-->
  
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">


    <!-- DataTables CSS -->
    <link href="{{ asset('assets/vendor/datatables/datatables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/datatables/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/selectbutton/bootstrap-select.min.css') }}" rel="stylesheet">  
    <link rel="icon" type="image/png" href="{{ asset('img/icon.png') }}">
  </head>
  <body>

  	@include('layout.header')
      
  		@yield('content')
 
  	@include('layout.footer')
    <script src="{{asset('assets/js/jquery-3.2.1.slim.min.js')}}"></script>
      <script src="{{asset('assets/js/popper.min.js')}}"></script>

    <script src="{{ asset('assets/js/xlsx.full.min.js') }}"></script>

    <script src="{{ asset('assets/js/bootstrap-select.min.js') }}"></script>

    <!-- <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script> -->
      


    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  
    <!-- Core plugin JavaScript-->
    <script src="{{ asset('assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('assets/js/sb-admin-2.min.js') }}"></script>

    <!-- Page level plugins -->
    <script src="{{ asset('assets/vendor/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('assets/js/demo/chart-area-demo.js') }}"></script>
    <script src="{{ asset('assets/js/demo/chart-area-programchair.js') }}"></script>
    <script src="{{ asset('assets/js/demo/chart-area-demo-librarian.js') }}"></script>
    <script src="{{ asset('assets/js/demo/chart-pie-demo.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/vfs_fonts.js') }}"></script>
    <script src="{{ asset('assets/js/demo/datatables-demo.js') }}"></script>
    <script src="{{ asset('assets/js/demo/confirmationModal.js') }}"></script>


  </body>
</html>