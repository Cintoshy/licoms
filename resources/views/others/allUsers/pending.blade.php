@extends('layout.layout')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                <h1 class="display-6 fw-bolder text-uppercase">Pending Books</h1>
                </div>
                <div class="col-auto">
                    <i class="fas fa-regular fa-hourglass-half fa-4x text-gray-500 pr-3"></i>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered " id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Book Title</th>
                            <th>Course Code</th>
                            <th>Faculty</th>
                            <th>Program Chair</th>
                            <th>Status</th>
                            <th>Updated at</th>
                            <th width="10%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($requestedBooks as $requestedBook)
                        <tr>
                            <td class="fw-bolder text-uppercase">{{ $requestedBook->book->title }}</td>
                            <td>{{ $requestedBook->course_id }}</td>
                            <td>
                                @if ($requestedBook->faculty)
                                    {{ $requestedBook->faculty->first_name }} {{ $requestedBook->faculty->last_name }}
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                @if ($requestedBook->programChair)
                                    {{ $requestedBook->programChair->first_name }} {{ $requestedBook->programChair->last_name }}
                                @else
                                    Pending
                                @endif
                            </td>
                            <td class="fw-bold text-success">{{ $requestedBook->status }}</td>
                            <td>{{ $requestedBook->updated_at->format('Y-m-d h:i A')}}</td>
                                <td>
                                <a href="{{ route('admin.books.show', $requestedBook->book->id) }}" class="btn btn-primary btn-sm w-100">
                                        <span class="icon text-light">
                                            View
                                            <i class="fa-solid fa-eye ms-1"></i>
                                        </span>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
