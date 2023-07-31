@extends('layout.layout')

@section('content')

@include('flash_message')

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="font-weight-bold text-primary">Requesting Book Page</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-lg table-bordered text-dark table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>CN</th>
                            <th>Book Title</th>
                            <th>Author</th>
                            <th>Publish</th>    
                            <th>Accession #</th>
                            <th>Copy</th>
                            <th>Year</th>
                            <th>CC</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($books as $book)
                            <tr >
                                <td class="fw-bold">{{ $book->id }}</td>
                                <td class="fw-bold">{{ $book->title }}</td>
                                <td>{{ $book->author }}</td>
                                <td>{{ $book->publish }}</td>
                                <td>{{ $book->access_no }}</td>
                                <td>{{ $book->copy }}</td>
                                <td>{{ $book->year }}</td>
                                <td class="align-middle">
                               <!-- <div class="dropdown" name="course_code">
                                    <input type="text" name="course_code" class="form-control dropdown-toggle search-input" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" placeholder="Course Code">
                                    <div name="course_code" class="dropdown-menu dropdown-options" aria-labelledby="dropdownMenuButton">
                                    @foreach ($courses as $course)
                                        <a class="dropdown-item" name="course_code">{{ $course->course_code }}</a>

                                    @endforeach
                                    </div>
                                    </div>-->
                                <form action="{{ route('fac-select.book', $book->id) }}" method="post">
                                @csrf
                                <select type="text" class="form-control form-control-user" id="dropdown-options" name="course_code"  required>
                                <option></option>
                                    @foreach ($courses as $course)
                                        <option value="{{ $course->course_code }}">{{ $course->course_code }}</option>
                                    @endforeach
                                </select>
                                </td>
                                <td>
                                <a href="{{ route('fac-books.show', $book->id) }}" class="btn btn-primary btn-sm w-100">
                                        <span class="icon text-light">
                                            View
                                            <i class="fa-solid fa-eye ms-1"></i>
                                        </span>
                                    </a>
                                <button type="submit" class="btn btn-success btn-sm w-100 mt-1">
                                        <span class="icon text-light">
                                             Select
                                            <i class="fa-solid fa-check ms-1"></i>
                                        </span>
                                    </button>
                                 </form>



                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>CN</th>
                            <th>Book Title</th>
                            <th>Author</th>
                            <th>Publish</th>    
                            <th>Accession #</th>
                            <th>Copy</th>
                            <th>Year</th>
                            <th>CC</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    
@endsection
