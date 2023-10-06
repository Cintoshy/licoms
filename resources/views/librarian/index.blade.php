@extends('layout.layout')

@section('content')

@include('flash_message')

    <div class="card shadow mb-4">
        <div class="card-header py-3">
        <h1 class="display-6 fw-bolder text-uppercase">Book Evaluation</h1>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr><th>Req. ID</th>
                            <th>Book Title</th>
                            <th>Course Code</th>
                            <th>Course Title</th>
                            <th>Faculty</th>
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
                            <td>{{ $requestedBook->course->course_code }}</td>
                            <td>{{ $requestedBook->course->course_title }}</td>
                            <td>{{ $requestedBook->faculty ? $requestedBook->faculty->first_name : '-' }}</td>
                            <td>{{ $requestedBook->programChair ? $requestedBook->programChair->first_name : 'Pending' }}</td>
                            <td class="fw-bold font-italic">
                            {{ $requestedBook->status }}
                            </td>
                            <td width="10%">
                            <div class="btn-group">
                                <button type="button" class="btn btn-dark dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Action
                                </button>
                                <div class="dropdown-menu">
                                <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ route('lib-books.show', $requestedBook->book->id) }}">
                                        <span class="text fw-bold">View
                                        <i class="fas fa-eye mt-1"></i>
                                        </span>
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" onclick="openLibEditBookModal('{{ route('lib-books.edit', $requestedBook->book->id) }}')">
                                        <span class="text fw-bold">Edit
                                        <i class="fas fa-pencil ms-1"></i>
                                        </span>
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <button class="dropdown-item" type="button" data-toggle="modal" data-target="#approveBookRequestModal{{$requestedBook->id}}">
                                    <span class="text fw-bold">
                                            Approve
                                            <i class="fa-solid fa-check"></i>
                                        </span>
                                    </button>
                                    
                                    <div class="dropdown-divider"></div>
                                    <button class="dropdown-item" type="button" data-toggle="modal" data-target="#rejectBookRequestModal{{$requestedBook->id}}">
                                        <span class="text fw-bold">
                                            Reject
                                            <i class="fa-solid fa-ban ms-1"></i>
                                        </span>
                                    </button>
                                    <div class="dropdown-divider"></div>
                                </div>
                                @include('librarian.modal.approveBookModal')
                                @include('librarian.modal.rejectBookModal')
                            </div>
                                <!-- <a href="{{ route('lib-books.show', $requestedBook->book->id) }}" class="btn btn btn-primary btn-sm w-100">
                                    <span class="text">View
                                    <i class="fas fa-eye mt-1"></i>
                                    </span>
                                </a>
                                <a class="btn btn btn-warning btn-sm w-100 my-1" onclick="openLibEditBookModal('{{ route('lib-books.edit', $requestedBook->book->id) }}')">
                                <span class="text">Edit</span>  
                                    <span class="icon text-white-100">
                                        <i class="fas fa-pencil ms-1"></i>
                                    </span>
                                </a>

                                    <form method="POST" class="mb-1" action="{{ route('lib-books.verified-status', $requestedBook->id) }}">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-success btn-sm w-100">
                                            <span class="icon text-light">
                                                Approved
                                                <i class="fa-solid fa-check ms-1"></i>
                                            </span>
                                        </button>
                                    </form>
                                    <form method="POST" class="m-0" action="{{ route('lib-books.reject-status', $requestedBook->id) }}">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-danger btn-sm w-100">
                                            <span class="icon text-light">
                                                Reject
                                                <i class="fa-solid fa-ban ms-1"></i>
                                            </span>
                                        </button>
                                    </form> -->
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @include('admin.Books.modal')
@endsection
