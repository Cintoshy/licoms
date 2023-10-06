@extends('layout.layout')

@section('content')

@include('flash_message')

    <div class="card shadow mb-4">
        <div class="card-header py-3">
        <h4 class="m-0 font-weight-bold text-dark text-center text-uppercase">Book Evaluation</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-lg table-bordered text-dark table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>CN</th>
                            <th>Book Title</th>
                            <th>Author</th>
                            <th>Publish</th>    
                            <th>Volume</th>
                            <th>Year</th>
                            <th width="10%">CC</th>
                            <th>Action</th>
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
                                <form action="{{ route('lib-approve.book', $book->id) }}" method="post">
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
                                <button type="submit" class="btn btn-success btn-sm w-100 mt-1">
                                        <span class="icon text-light">
                                             Approve
                                            <i class="fa-solid fa-check ms-1"></i>
                                        </span>
                                    </button>
                                 </form>



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
                    <tfoot>
                        <tr>
                            <th>CN</th>
                            <th>Book Title</th>
                            <th>Author</th>
                            <th>Publish</th>    
                            <th>Volume</th>
                            <th>Year</th>
                            <th>CC</th>
                            <th>Action</th>
                            <th>Deadline</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    
@endsection
