@extends('layout.layout')

@section('content')
@include('flash_message')
<div class="card shadow mb-4">
    <div class="card-header">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                <h1 class="display-6 fw-bolder text-uppercase">Book Evaluation</h1>
                <div class="h6 mb-0">Cancellation Activity</div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-regular fa-hourglass-half fa-4x text-gray-500 pr-3"></i>
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
                            <th>Course Subject</th>
                            <th>Status</th>
                            <th>Updated at</th>
                            <th width="10%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($requestedBooks as $requestedBook)
                        <tr>
                            <td>{{ $requestedBook->book->title }}</td>
                            <td>{{ $requestedBook->course_id }}</td>
                            <td>{{ $requestedBook->course->course_title }}</td>
                            <td class="fw-bold text-success">{{ $requestedBook->status }}</td>
                            <td>{{ $requestedBook->updated_at->format('Y-m-d h:i A')}}</td>
                            <td>
                                @php
                                    $role = auth()->user()->role;
                                @endphp
                                @if ($role === 3) 
                                    <form action="{{ route('fac.cancelSelectedBook', $requestedBook->id) }}" method="POST" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger btn-sm w-100 mt-1" data-toggle="modal" data-target="#cancelSelectedBookModal{{$requestedBook->id}}">
                                        <span class="icon text-light">
                                            Cancel
                                            <i class="fa-solid fa-cancel ms-1"></i>
                                        </span>
                                        </button>
                                        @include('faculty.modal.cancelSelectBookModal')
                                    </form>
                                    @elseif($role === 1)
                                    
                                    <button type="button" class="btn btn-danger btn-sm w-100 mt-1" data-toggle="modal" data-target="#cancelVerifiedBookModal{{$requestedBook->id}}">
                                        <span class="icon text-light">
                                            Cancel
                                            <i class="fa-solid fa-cancel ms-1"></i>
                                        </span>
                                        </button>
                                        @include('programChair.modal.cancelVerifiedBookModal')
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
