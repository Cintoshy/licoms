@extends('layout.layout')

@section('content')

@include('flash_message')
<div class="card shadow mb-4">
    <div class="card-header">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                <h1 class="display-6 fw-bolder text-uppercase">Ignored Books</h1>
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
                            @php
                                    $role = auth()->user()->role;
                                @endphp
                                @if($role === 1)   
                            <th>Action</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($books as $book)
                            <tr >
                                <td class="fw-bold">{{ $book->call_number }}</td>
                                <td class="fw-bold ">
                                <a href="{{ route('fac-books.show', $book->id) }}" class="text-dark">
                                        {{ $book->title }}
                                    </a>
                                </td>
                                <td>{{ $book->author }}</td>
                                <td>{{ $book->publish }}</td>
                                @if($role === 1)   
                                <td>
                                <button type="button" class="btn btn-secondary btn-sm mt-1 w-100" data-toggle="modal" data-target="#undoIgnoredBook{{$book->id}}">
                                        <span class="icon text-light">
                                            Restore
                                            <i class="fa-solid fa-rotate-left ms-1"></i>
                                        </span>      
                                </button>
                                @include('faculty.modal.restoreBook')
                                </td>
                                @endif
                            </tr>
                        @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection
