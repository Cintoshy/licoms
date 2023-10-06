@extends('layout.layout')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">All list of Books</h6>
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
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>CN</th>
                            <th>Title</th>
                            <th>Author</th>
                            <th>Publish</th>
                            <th>Accession #</th>
                            <th>Copy</th>
                            <th>Year</th>
                            <th>CC</th>
                            <th>Status</th>
                            <th>Program</th>
                            <th>Program Chair</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($requestedBooks as $requestedBook)
                            <tr>
                                <td>{{ $requestedBook->book->id }}</td>
                                <td>{{ $requestedBook->book->call_number }}</td>
                                <td>{{ $requestedBook->book->title }}</td>
                                <td>{{ $requestedBook->book->author }}</td>
                                <td>{{ $requestedBook->book->access_no }}</td>
                                <td>{{ $requestedBook->book->copy }}</td>
                                <td>{{ $requestedBook->book->year }}</td>
                                <td>{{ $requestedBook->book->publish }}</td>
                                <td>{{ $requestedBook->course_id }}</td>
                                <td>{{ $requestedBook->status }}</td>
                                <th>{{ $requestedBook->program_name}}</th>
                                <td>{{ $requestedBook->programChair->first_name ?? 'N/A' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
