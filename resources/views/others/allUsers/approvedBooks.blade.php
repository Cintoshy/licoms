@extends('layout.layout')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Approved Books</h6>
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
                            <th>Book Title</th>
                            <th>Course Code</th>
                            <th>Faculty</th>
                            <th>Librarian</th>
                            <th>Program Chair</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($requestedBooks as $requestedBook)
                        <tr>
                            <td>{{ $requestedBook->book->title }}</td>
                            <td>{{ $requestedBook->course_id }}</td>
                            <td>
                                @if ($requestedBook->faculty)
                                    {{ $requestedBook->faculty->first_name }} {{ $requestedBook->faculty->last_name }}
                                @else
                                    auto-approved
                                @endif
                            </td>
                            <td>
                                @if ($requestedBook->librarian)
                                    {{ $requestedBook->librarian->first_name }} {{ $requestedBook->librarian->last_name }}
                                @else
                                    auto-approved
                                @endif
                            </td>
                            <td>
                                @if ($requestedBook->programChair)
                                    {{ $requestedBook->programChair->first_name }} {{ $requestedBook->programChair->last_name }}
                                @else
                                    -
                                @endif
                            </td>
                            <td class="fw-bold bg-success">{{ $requestedBook->status }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
