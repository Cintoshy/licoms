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

    @include('flash_message')

      <div class="card shadow mb-4">
        <div class="card-header">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                <h1 class="display-6 fw-bolder text-uppercase">Book Evaluation</h1>
                </div>
                <div class="col-auto">
                    <i class="fas fa-book fa-4x text-gray-500 pr-3"></i>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-lg table-bordered text-dark table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Call #</th>
                            <th>Book Title</th>
                            <th>Author</th>
                            <th>Publisher</th>    
                            <th>Volume</th>
                            <th>Year</th>
                            <th width="20%">Course Code - Course</th>
                            <th width="10%">Action</th>
                            <th>Deadline</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($books as $book)
                            <tr >
                                <td class="fw-bold">{{ $book->call_number }}</td>
                                <td class="fw-bold ">
                                <a href="{{ route('fac-books.show', $book->id) }}" class="text-dark">
                                        {{ $book->title }}
                                    </a>
                                </td>
                                <td>{{ $book->author }}</td>
                                <td>{{ $book->publish }}</td>
                                <td>{{ $book->volume }}</td>
                                <td>{{ $book->year }}</td>
                                <td class="align-middle">
                                <form action="{{ route('fac-select.book', $book->id) }}" method="post" class="mb-3">
                                    @csrf
                                    <div class="input-group mt-3">
                                        <select class="selectpicker form-control" id="selectpickerrr" data-live-search="true" id="dropdown-options" name="course_code" required>
                                            <option></option>
                                            @foreach ($courses as $course)
                                                <option value="{{ $course->course_code }}">{{ $course->course_code }} - {{ $course->course_title }}</option>
                                            @endforeach
                                        </select>
                                        <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#confirmationModal{{$book->id}}">
                                            <span class="icon text-light">
                                                Assign
                                                <i class="fa-solid fa-check ms-1"></i>
                                            </span>
                                        </button>
                                    </div>
                                    @include('faculty.modal.selectBookModal')
                                </form>



                                <!-- <form action="{{ route('fac-select.book', $book->id) }}" method="post">
                                @csrf
                                <select class="selectpicker" id="selectpickerrr" data-live-search="true" id="dropdown-options" name="course_code" required>
                                    <option></option>
                                    @foreach ($courses as $course)
                                        <option value="{{ $course->course_code }}">{{ $course->course_code }} - {{ $course->course_title }}</option>
                                    @endforeach
                                </select>
                                </form>
                                <button type="button" class="btn btn-success btn-sm w-100 mt-1" data-toggle="modal" data-target="#confirmationModal{{$book->id}}">
                                        <span class="icon text-light">
                                            Assign
                                            <i class="fa-solid fa-check ms-1"></i>
                                        </span>
                                    </button>
                                    @include('faculty.modal.selectBookModal') -->
                                <!-- <select type="text" class="form-control form-control-user" id="dropdown-options" name="course_code"  required>
                                <option></option>
                                    @foreach ($courses as $course)
                                        <option value="{{ $course->course_code }}">{{ $course->course_code }} - {{ $course->course_title }}</option>
                                    @endforeach
                                </select> -->

                                </td>
                                <td class="align-middle">
                                    <button class="btn btn-secondary w-100" type="button" data-toggle="modal" data-target="#ignoreBookModal{{$book->id}}">
                                            <span class="icon text-light">
                                            Ignore
                                                <i class="fa-solid fa-eye-slash ms-1"></i>
                                            </span>
                                        </button>
                                @include('faculty.modal.ignoreRequestBookModal')
                            </td>
                                <td>
                                    @php
                                        $dueDate = $book->created_at->addDays(5);
                                        $now = now();
                                        $remainingDays = $dueDate->diffInDays($now);
                                    @endphp
                                    
                                    @if ($now > $dueDate)
                                        Delayed
                                    @else
                                        {{ $remainingDays }} days remaining
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
      
  		
 
  	@include('layout.footer')
    <script src="{{asset('assets/js/jquery-3.2.1.slim.min.js')}}"></script>
      <script src="{{asset('assets/js/popper.min.js')}}"></script>

    <script src="{{ asset('assets/js/xlsx.full.min.js') }}"></script>

    <script src="{{ asset('assets/js/bootstrap-select.min.js') }}"></script>

    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
      


    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
    <!-- <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script> -->
  
    <!-- Core plugin JavaScript-->
    <script src="{{ asset('assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('assets/js/sb-admin-2.min.js') }}"></script>

    <!-- Page level plugins -->
    <script src="{{ asset('assets/vendor/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('assets/js/demo/chart-area-demo.js') }}"></script>
    <script src="{{ asset('assets/js/demo/chart-pie-demo.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/vfs_fonts.js') }}"></script>
    <script src="{{ asset('assets/js/demo/datatables-demo.js') }}"></script>
    <script src="{{ asset('assets/js/demo/confirmationModal.js') }}"></script>


  </body>
</html>
