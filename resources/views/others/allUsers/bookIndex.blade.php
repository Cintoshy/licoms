@extends('layout.layout')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Program Chair</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-8 mb-3">
                    <a href="" class="btn btn-success btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="fas fa-plus mt-1"></i>
                        </span>
                        <span class="text">Convert to Excel</span>
                    </a>
                </div>
                <div class="col-md-4 mb-3">
                    <select class="form-control" id="role" name="role">
                        <option value="">All</option>
                        <option value="0">Approved</option>    
                        <option value="1">Pending</option>
                        <option value="2">Rejected</option>
                    </select>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>CN</th>
                            <th>Title</th>
                            <th>Author</th>
                            <th>Publish</th>
                            <th>Accession #</th>
                            <th>Volume</th>
                            <th>Year</th>
                            <th>CC</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($books as $book)
                            <tr>
                                <td>{{ $book->id }}</td>
                                <td>{{ $book->title }}</td>
                                <td>{{ $book->author }}</td>
                                <td>{{ $book->access_no }}</td>
                                <td>{{ $book->volume }}</td>
                                <td>{{ $book->year }}</td>
                                <td>{{ $book->publish }}</td>
                                <td>{{ $book->cc }}</td>
                                <td>{{ $book->status }}</td>
                                <td>
                                @php $role = auth()->user()->role; @endphp

                                @if($role === 1)
                                    <a href="" class="btn btn-primary btn-sm w-100 my-3">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-eye mt-1"></i>
                                        </span>
                                        <span class="text">View</span>
                                    </a>
                                    <form method="POST" action="{{ route('pg-books.grant-status', $book->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-success btn-sm w-100" @if ($book->status === 'Approved') disabled @endif>
                                        <span class="icon text-light">
                                            Approve
                                            <i class="fa-solid fa-check ms-1"></i>
                                        </span>
                                    </button>
                                </form>
                                <form method="POST" action="{{ route('pg-books.deny-status', $book->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-danger btn-sm w-100" @if ($book->status === 'Rejected') disabled @endif>
                                        <span class="icon text-light">
                                            Reject
                                            <i class="fa-solid fa-ban ms-1"></i>
                                        </span>
                                    </button>
                                </form>

                                @elseif($role === 2)

                                <a href="" class="btn btn btn-primary btn-sm w-100">
                                    <span class="text">View
                                    <i class="fas fa-eye mt-1"></i>
                                    </span>
                                </a>
                                <a href="" class="btn btn btn-warning btn-sm w-100 my-3">
                                    <span class="icon text-white-50">
                                        <i class="fas fa-pencil mt-1"></i>
                                    </span>
                                    <span class="text">Edit</span>
                                </a>

                                @if ($book->status !== 'Granted' && $book->status !== 'Denied')
                                    <form method="POST" action="{{ route('lib-books.grant-status', $book->id) }}">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-success btn-sm w-100">
                                            <span class="icon text-light">
                                                Grant
                                                <i class="fa-solid fa-check ms-1"></i>
                                            </span>
                                        </button>
                                    </form>
                                    <form method="POST" action="{{ route('lib-books.deny-status', $book->id) }}">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-danger btn-sm w-100">
                                            <span class="icon text-light">
                                                Deny
                                                <i class="fa-solid fa-ban ms-1"></i>
                                            </span>
                                        </button>
                                @else
                                    <form method="POST" action="{{ route('lib-books.cancel-status', $book->id) }}">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-secondary btn-sm w-100">
                                            <span class="icon text-light">
                                                Cancel
                                                <i class="fa-solid fa-times ms-1"></i>
                                            </span>
                                        </button>
                                    </form>
                                @endif

                                @elseif($role === 3)

                                <a href="#" class="btn btn-primary btn-sm w-100">
                                        <span class="icon text-light">
                                            View
                                            <i class="fa-solid fa-eye ms-1"></i>
                                        </span>
                                    </a>
                                @if ($book->status == 'Available')

                                    <form method="POST" action="{{ route('fac-books.update-status', $book->id) }}">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-success btn-sm w-100">
                                            <span class="icon text-light">
                                                Select
                                                <i class="fa-solid fa-check ms-1"></i>
                                            </span>
                                        </button>
                                    </form>
                                @elseif ($book->status == 'Selected')
                                    <form method="POST" action="{{ route('fac-books.cancel-status', $book->id) }}">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-danger btn-sm w-100">
                                            <span class="icon text-light">
                                                Cancel
                                                <i class="fa-solid fa-ban ms-1"></i>
                                            </span>
                                        </button>
                                    </form>
                                    @elseif ($book->status == 'Accepted')
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
