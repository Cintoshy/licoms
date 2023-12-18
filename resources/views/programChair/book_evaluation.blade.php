@extends('layout.layout')

@section('content')

@include('flash_message')
    <div class="card shadow mb-4 ">
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
                <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Book Title</th>
                            <th>Course Code</th>
                            <th>Course</th>
                            <th>Faculty</th>
                            <th>Status</th>
                            <th width="8%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($requestedBooks as $requestedBook)
                        <tr>
                            <td class="fw-bolder text-uppercase">{{ $requestedBook->book->title }}</td>
                            <td>{{ $requestedBook->course_id }}</td>
                            <td>{{ $requestedBook->course->course_title }}</td>
                            <td>{{ $requestedBook->faculty->first_name ??  '-'}} {{ $requestedBook->faculty->last_name ??  $requestedBook->faculty }}</td>
                            <td class="fw-bold">{{ $requestedBook->status }}</td>   
                                <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-dark dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Action
                                    </button>
                                    <div class="dropdown-menu">
                                        <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="{{ route('pg-books.show', $requestedBook->book->id) }}">
                                                <span class="text fw-bold">View
                                                <i class="fas fa-eye mt-1"></i>
                                                </span>
                                            </a>
                                            <div class="dropdown-divider"></div>
                                    <button class="dropdown-item" type="button" data-toggle="modal" data-target="#verifyBookRequestModal{{$requestedBook->id}}">
                                        <span class="text fw-bold">
                                            Verify
                                            <i class="fa-solid fa-check"></i>
                                        </span>
                                    </button>
                                    <div class="dropdown-divider"></div>
                                    <button class="dropdown-item" type="button" data-toggle="modal" data-target="#editCC{{$requestedBook->id}}">
                                        <span class="text fw-bold">
                                            Edit
                                            <i class="fa-solid fa-pencil ms-1"></i>
                                        </span> 
                                    </button>
                                    <div class="dropdown-divider"></div>
                                    <button class="dropdown-item" type="button" data-toggle="modal" data-target="#refuseBookRequestModal{{$requestedBook->id}}">
                                        <span class="text fw-bold">
                                            Refuse
                                            <i class="fa-solid fa-ban ms-1"></i>
                                        </span> 
                                    </button>
                                    <div class="dropdown-divider"></div>
                            </div>  
                            @include('programChair.modal.editModal')
                                    @include('programChair.modal.verifyBookRequestModal')
                                    @include('programChair.modal.refuseBookRequest')
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
