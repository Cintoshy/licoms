@extends('layout.layout')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Program Chair</h6>
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
                <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Requeted ID</th>
                            <th>Book Title</th>
                            <th>Author</th>
                            <th>Accession No.</th>
                            <th>Copy</th>
                            <th>Year</th>
                            <th>Publish</th>
                            <th>CC</th>
                            <th>Faculty</th>
                            <th>Librarian</th>
                            <th>Program Chair</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($requestedBooks as $requestedBook)
                        <tr>
                            <td>{{ $requestedBook->id }}</td>
                            <td>{{ $requestedBook->book->title }}</td>
                            <td>{{ $requestedBook->book->author }}</td>
                            <td>{{ $requestedBook->book->access_no }}</td>
                            <td>{{ $requestedBook->book->copy }}</td>
                            <td>{{ $requestedBook->book->year }}</td>
                            <td>{{ $requestedBook->book->publish }}</td>
                            <td>{{ $requestedBook->book->cc }}</td>
                            <td>{{ $requestedBook->faculty ? $requestedBook->faculty->first_name : '-' }}</td>
                            <td>{{ $requestedBook->librarian ? $requestedBook->librarian->first_name : '-' }}</td>
                            <td>{{ $requestedBook->programChair ? $requestedBook->programChair->first_name : '-' }}</td>
                            <td>{{ $requestedBook->status }}</td>   
                                <td>
                                    <a href="" class="btn btn-primary btn-sm w-100 my-3">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-eye mt-1"></i>
                                        </span>
                                        <span class="text">View</span>
                                    </a>
                                    <form method="POST" action="{{ route('pg-books.grant-status', $requestedBook->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-success btn-sm w-100">
                                        <span class="icon text-light">
                                            Approve
                                            <i class="fa-solid fa-check ms-1"></i>
                                        </span>
                                    </button>
                                </form>
                                <form method="POST" action="{{ route('pg-books.deny-status', $requestedBook->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-danger btn-sm w-100">
                                        <span class="icon text-light">
                                            Reject
                                            <i class="fa-solid fa-ban ms-1"></i>
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
