@extends('layout.layout')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Faculty</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-8 mb-3">
                    <a href="" class="btn btn-success btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="fas fa-plus mt-1"></i>
                        </span>
                        <span class="text">Convert to Excel</span>
                    </a>
                </div>
                <div class="col-md-4 mb-3">
                    <select class="form-control" id="role" name="role">
                        <option value="">All</option>
                        <option value="0">Approved</option>    
                        <option value="1">Pending</option>
                        <option value="2">Rejected</option>
                    </select>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-lg table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
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
                            <tr>
                                <td>{{ $book->id }}</td>
                                <td>{{ $book->title }}</td>
                                <td>{{ $book->author }}</td>
                                <td>{{ $book->publish }}</td>
                                <td>{{ $book->access_no }}</td>
                                <td>{{ $book->copy }}</td>
                                <td>{{ $book->year }}</td>
                                <td>
                                <div class="dropdown">
                                    <input type="text" id="dropdownMenuButton" class="form-control dropdown-toggle search-input" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" placeholder="Course Code">
                                    <div class="dropdown-menu dropdown-options" aria-labelledby="dropdownMenuButton">
                                    @foreach ($courses as $course)
                                        <a class="dropdown-item">{{ $course->course_code }}</a>

                                    @endforeach
                                    </div>
                                    </div>
                                </td>
                                <td>
                                <a href="{{ route('fac-books.show', $book->id) }}" class="btn btn-primary btn-sm w-100">
                                        <span class="icon text-light">
                                            View
                                            <i class="fa-solid fa-eye ms-1"></i>
                                        </span>
                                    </a>
                                    <form method="POST" action="{{ route('fac-books.update-status', $book->id) }}">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-success btn-sm w-100">
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
