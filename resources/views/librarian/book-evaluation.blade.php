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
                        <tr>
                            <th>Course Code</th>
                            <th>Book Title</th>
                            <th>Course Title</th>
                            <th>Program</th>
                            <th>Faculty (program)</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($requestedBooks as $requestedBook)
                        <tr>
                            <td>{{ $requestedBook->course->course_code }}</td>
                            <td>
                                <a class="text-dark" href="{{ route('lib-books.show', $requestedBook->book->id) }}">
                                {{ $requestedBook->book->title }}
                                </a>
                            </td>
                            <td>{{ $requestedBook->course->course_title }}</td>
                            <td>{{ $requestedBook->program_name }}</td>
                            <td>{{ $requestedBook->faculty->first_name }}</td>
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
                                    <a class="dropdown-item" type="button" onclick="openLibEditBookModal('{{ route('lib-books.edit', $requestedBook->book->id) }}')">
                                        <span class="text fw-bold">Edit
                                        <i class="fas fa-pencil ms-1"></i>
                                        </span>
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" type="button" data-toggle="modal" data-target="#approveBookRequestModal{{$requestedBook->id}}">
                                        <span class="text fw-bold">
                                            Note
                                            <i class="fa-solid fa-check"></i>
                                        </span>
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" type="button" data-toggle="modal" data-target="#rejectBookRequestModal{{$requestedBook->id}}">
                                        <span class="text fw-bold">
                                            Refuse
                                            <i class="fa-solid fa-ban"></i>
                                        </span>
                                    </a>
                                    <div class="dropdown-divider"></div>
                            </div>
                            @include('librarian.modal.approveBookModal')
                            @include('librarian.modal.rejectBookModal')
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
