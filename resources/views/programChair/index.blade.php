@extends('layout.layout')

@section('content')

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
                <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Req. No</th>
                            <th>Book Title</th>
                            <th>CC</th>
                            <th>Course Subject</th>
                            <th>Faculty</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($requestedBooks as $requestedBook)
                        <tr>
                            <td>{{ $requestedBook->id }}</td>
                            <td>{{ $requestedBook->book->title }}</td>
                            <td>{{ $requestedBook->course_id }}</td>
                            <td>{{ $requestedBook->course->course_title }}</td>
                            <td>{{ $requestedBook->faculty ? $requestedBook->faculty->first_name : '-' }}</td>
                            <td>{{ $requestedBook->status }}</td>   
                                <td>
                                    <a href="{{ route('pg-books.show', $requestedBook->book->id) }}" class="btn btn-primary btn-sm w-100">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-eye mt-1"></i>
                                        </span>
                                        <span class="text">View</span>
                                    </a>
                                <button type="button" class="btn btn-success btn-sm w-100 mt-1" data-toggle="modal" data-target="#verifyBookRequestModal{{$requestedBook->id}}">
                                    <span class="icon text-light">
                                            Verify
                                            <i class="fa-solid fa-check"></i>
                                        </span>
                                    </button>
                                    @include('programChair.modal.verifyBookRequestModal')
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
