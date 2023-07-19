@extends('layout.layout')

@section('content')

@include('flash_message')

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">All list of Books</h6>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-md-8 mb-3">
                    <a class="btn btn-primary btn-icon-split" data-toggle="modal" data-target="#AddBooks">
                        <span class="icon text-white-50">
                            <i class="fas fa-plus mt-1"></i>
                        </span>
                        <span class="text">Add Books</span>
                    </a>
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
                            <th>Copy</th>
                            <th>Year</th>
                            <th>CC</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($books as $book)
                            <tr>
                                <td>{{ $book->id }}</td>
                                <td>{{ $book->title }}</td>
                                <td>{{ $book->author }}</td>
                                <td>{{ $book->publish }}</td>
                                <td>{{ $book->access_no }}</td>
                                <td>{{ $book->copy }}</td>
                                <td>{{ $book->year }}</td>
                                <td>{{ $book->cc }}</td>
                                <td>
                                <a class="btn btn-primary btn-sm" onclick="openEditBookModal('{{ route('admin.books.edit', $book) }}')">Edit</a>
                                    <form action="{{ route('admin.books.destroy', $book) }}" method="POST" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
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