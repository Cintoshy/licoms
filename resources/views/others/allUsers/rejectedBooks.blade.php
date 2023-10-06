@extends('layout.layout')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <h1 class="display-6 fw-bolder text-uppercase">Rejected Books</h1>
                </div>
                <div class="col-auto">
                    <i class="fas fa-solid fa-file-excel fa-3x text-danger pr-3"></i>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Book Title</th>
                            <th>Course Code</th>
                            <th>Faculty</th>
                            <th>Program Chair</th>
                            <th>Librarian</th>
                            <th>Status</th>
                            <th>Date Approved</th>
                            <th>Action</th>
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
                                @if ($requestedBook->programChair)
                                    {{ $requestedBook->programChair->first_name }} {{ $requestedBook->programChair->last_name }}
                                @else
                                    -
                                @endif
                            </td>
                            <td class="fw-bold bg-gradient-success text-light">{{ $requestedBook->status }}</td>
                            <td>
                                @if ($requestedBook->librarian)
                                    {{ $requestedBook->librarian->first_name }} {{ $requestedBook->librarian->last_name }}
                                @else
                                    auto-approved
                                @endif
                            </td>
                            <td>{{ $requestedBook->approved_at }}</td>
                            <td>
                                <a href="{{ route('all.approvedBookPage.show', $requestedBook->id) }}" class="btn btn-primary btn-sm w-100">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-eye mt-1"></i>
                                        </span>
                                        <span class="text">View</span>
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
