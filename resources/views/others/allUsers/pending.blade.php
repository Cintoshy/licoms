@extends('layout.layout')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Pending Books</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Book Title</th>
                            <th>Course Code</th>
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
                            <td>{{ $requestedBook->book->title }}</td>
                            <td>{{ $requestedBook->course_id }}</td>
                            <td>
                                @if ($requestedBook->faculty)
                                    {{ $requestedBook->faculty->first_name }} {{ $requestedBook->faculty->last_name }}
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                @if ($requestedBook->librarian)
                                    {{ $requestedBook->librarian->first_name }} {{ $requestedBook->librarian->last_name }}
                                @else
                                    Pending
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
                                <td>
                                <a href="{{ route('admin.books.show', $requestedBook->book->id) }}" class="btn btn-primary btn-sm w-100">
                                        <span class="icon text-light">
                                            View
                                            <i class="fa-solid fa-eye ms-1"></i>
                                        </span>
                                    </a>
                                    @php
                        $role = auth()->user()->role;
                        @endphp
                        @if($role === 2)
                            @if ($requestedBook->status == 'Granted')
                                <form method="POST" class="my-1" action="{{ route('lib-books.cancel-status', $requestedBook->book->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-danger btn-sm w-100">
                                        <span class="icon text-light">
                                            Cancel
                                            <i class="fa-solid fa-ban ms-1"></i>
                                        </span>
                                    </button>
                                </form>
                            @endif
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
