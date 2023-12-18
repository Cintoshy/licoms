@extends('layout.layout')

@section('content')

@include('flash_message')
<div class="card shadow mb-4">
    <div class="card-header">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                <h1 class="display-6 fw-bolder text-uppercase">Ignore Book Requests</h1>
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
                                <td class="fw-bold ">
                                <a href="{{ route('fac-books.show', $book->id) }}" class="text-dark">
                                        {{ $book->title }}
                                    </a>
                                </td>
                                <td>{{ $book->author }}</td>
                                <td>{{ $book->publish }}</td>
                                <td>
                                <form class="m-0" method="POST" action="{{ route('pg.PCconfirmIgnoreRequestBook', $book->id) }}">
                                        @csrf
                                        @method('PUT')
                                        <button class="btn btn-primary btn-sm w-100 mt-1" type="button" data-toggle="modal" data-target="#acceptBookHideRequest{{$book->id}}">
                                            <span class="icon text-light">
                                            Accept
                                            <i class="fa-solid fa-check ms-1"></i>
                                        </span>
                                    </button>
                                @include('programChair.modal.acceptHideRequest')
                                </form>
                                <button type="button" class="btn btn-secondary btn-sm mt-1 w-100" data-toggle="modal" data-target="#undoIgnoredBook{{$book->id}}">
                                        <span class="icon text-light">
                                            Refuse
                                            <i class="fa-solid fa-rotate-left ms-1"></i>
                                        </span>      
                                </button>
                                @include('programChair.modal.refuseIgnoreRequestBook')
                                </td>
                            </tr>
                        @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection
