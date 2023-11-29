@extends('layout.layout')

@section('content')

@include('flash_message')
<div class="card shadow mb-4">
    <div class="card-header">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                <h1 class="display-6 fw-bolder text-uppercase">Archived Books</h1>
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
                            <th>Publish</th>    
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($books as $book)
                            <tr >
                                <td class="fw-bold">{{ $book->call_number }}</td>
                                <td class="fw-bold">{{ $book->title }}</td>
                                <td>{{ $book->author }}</td>
                                <td>{{ $book->publish }}</td>
                                <td width="15%">
                                <button type="button" class="btn btn-danger btn-sm mt-1" data-toggle="modal" data-target="#hideBookRequestModal{{$book->id}}">
                                        <span class="icon text-light">
                                            Cancel Hide Request
                                            <i class="fa-solid fa-ban ms-1"></i>
                                        </span>      
                                </button>
                                @include('faculty.modal.cancelHideBookrequest')
                                </td>
                            </tr>
                        @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection
