@extends('layout.layout')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Program Chair</h6>
        </div>
        <div class="card-body">
            <div class="row">
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
                <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Req. ID</th>
                            <th>Book ID</th>
                            <th>Book Title</th>
                            <th>CC</th>
                            <th>Faculty</th>
                            <th>Librarian</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($requestedBooks as $requestedBook)
                        <tr>
                            <td>{{ $requestedBook->id }}</td>
                            <td>{{ $requestedBook->book->id }}</td>
                            <td>{{ $requestedBook->book->title }}</td>
                            <td>{{ $requestedBook->course_id }}</td>
                            <td>{{ $requestedBook->faculty ? $requestedBook->faculty->first_name : '-' }}</td>
                            <td>{{ $requestedBook->librarian ? $requestedBook->librarian->first_name : 'Pending' }}</td>
                            <td>{{ $requestedBook->status }}</td>   
                                <td>
                                    <a href="{{ route('pg-books.show', $requestedBook->book->id) }}" class="btn btn-primary btn-sm w-100">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-eye mt-1"></i>
                                        </span>
                                        <span class="text">View</span>
                                    </a>
                                    <form method="POST" class="my-1" action="{{ route('pg-books.grant-status', $requestedBook->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-success btn-sm w-100">
                                        <span class="icon text-light">
                                            Approve
                                            <i class="fa-solid fa-check"></i>
                                        </span>
                                    </button>
                                </form>
                                <form method="POST" class="mb-1"action="{{ route('pg-books.deny-status', $requestedBook->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-danger btn-sm w-100">
                                        <span class="icon text-light">
                                            Reject
                                            <i class="fa-solid fa-ban"></i>
                                        </span>
                                    </button>
                                </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
