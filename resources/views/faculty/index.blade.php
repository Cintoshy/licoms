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
                <table class="table table-lg table-bordered text-dark table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>CN</th>
                            <th>Book Title</th>
                            <th>Author</th>
                            <th>Publisher</th>    
                            <th>Volume</th>
                            <th>Year</th>
                            <th width="10%">CC</th>
                            <th width="10%">Action</th>
                            <th>Deadline</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($books as $book)
                            <tr >
                                <td class="fw-bold">{{ $book->id }}</td>
                                <td class="fw-bold">{{ $book->title }}</td>
                                <td>{{ $book->author }}</td>
                                <td>{{ $book->publish }}</td>
                                <td>{{ $book->volume }}</td>
                                <td>{{ $book->year }}</td>
                                <td class="align-middle">
                                <form action="{{ route('fac-select.book', $book->id) }}" method="post">
                                @csrf
                                <select type="text" class="form-control form-control-user" id="dropdown-options" name="course_code"  required>
                                <option></option>
                                    @foreach ($courses as $course)
                                        <option value="{{ $course->course_code }}">{{ $course->course_code }}</option>
                                    @endforeach
                                </select>
                                </td>
                                <td>
                                <a href="{{ route('fac-books.show', $book->id) }}" class="btn btn-primary btn-sm w-100">
                                        <span class="icon text-light">
                                            View
                                            <i class="fa-solid fa-eye ms-1"></i>
                                        </span>
                                    </a>
                                    <button type="button" class="btn btn-success btn-sm w-100 mt-1" data-toggle="modal" data-target="#confirmationModal{{$book->id}}">
                                        <span class="icon text-light">
                                            Select
                                            <i class="fa-solid fa-check ms-1"></i>
                                        </span>
                                    </button>
                                    @include('faculty.modal.selectBookModal')
                                    </form>
                                    <button class="btn btn-warning btn-sm w-100 mt-1" type="button" data-toggle="modal" data-target="#hideBookModal{{$book->id}}">
                                            <span class="icon text-light">
                                                Hide
                                                <i class="fa-solid fa-eye-slash ms-1"></i>
                                            </span>
                                        </button>
                                @include('faculty.modal.hideBookModal')
                            </td>
                                <td>
                                    @php
                                        $dueDate = $book->created_at->addWeeks(2);
                                        $now = now();
                                        $remainingDays = $dueDate->diffInDays($now);
                                    @endphp
                                    
                                    @if ($now > $dueDate)
                                        Delayed
                                    @else
                                        {{ $remainingDays }} days remaining
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
                                    <!-- <div class="btn-group">
                                        <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Action
                                        </button>
                                        <div class="dropdown-menu">
                                            <form class="dropdown-item">
                                            @csrf
                                             
                                            <button type="submit" class="btn btn-primary w-100">Submit</button>
                                            </form>
                                            <a class="dropdown-item" href="#">Another action</a>
                                            <a class="dropdown-item" href="#">Something else here</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#">Separated link</a>
                                        </div>
                                        </div> -->

                                <!-- Modal -->