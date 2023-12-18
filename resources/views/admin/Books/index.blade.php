@extends('layout.layout')

@section('content')

@include('flash_message')
    <div class="card shadow mb-4">  
        <div class="card-header">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <h1 class="fw-bolder text-uppercase">All List Books</h1>
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                        Total Books</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $books->count() }}</div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-book fa-4x text-gray-500 pr-3"></i>
                </div>
            </div>
        </div>
            @if ($message = Session::get('import'))
                <div class="alert alert-success mx-3 mt-3 mb-0">
                {{ $message }}
                </div>
             @endif
        <div class="card-body">
        <button id="details-btn" class="btn btn-warning mb-3">
        <i class="fas fa-filter me-2"></i>Filter
        </button>

        <a class="btn btn-secondary mb-3"  href="{{ route('admin-books.index') }}">    
            <i class="fas fa-cogs mr-2"></i>Clear
        </a>   
        <!-- <button class="btn btn-success mb-3" id="exportPdfBtn">Import</button> -->
        <!-- <div class="btn-group mb-3" role="group" aria-label="Button Group"> -->
                            <button class="btn btn-success mb-3" data-toggle="modal" data-target="#ImportBooks">
                                <span class="text">Import Books
                                </span>
                            </button>
                            <a class="btn btn-outline-info mb-3"  href="{{ (route('download.bookListTemplate')) }}">    
                                <i class="fa fa-download mr-2"></i>Template
                            </a>   
                            <!-- <button class="btn btn-primary" data-toggle="modal" data-target="#MinimumRequirements">
                                <span class="text">Import Existing Approved Books
                                </span>
                            </button>
                        </div> -->
        <form id="details-form" style="display: none;" method="get" action="{{ route('admin.books.filter') }}">
                @csrf
            <div class="row ">
            <div class="col-md-6 mb-3">
                <select class="form-control form-control-user" id="year_filter" name="year_filter">
                    <option value="" selected>Book Year</option>
                        @foreach ($years as $program)
                           <option value="{{ $program->year }}">{{ $program->year }}</option>
                       @endforeach
                </select>
            </div>
                <div class="col-md-6 mb-3">
                    <select class="form-control" name="date_filter">
                        <option value="">All Dates</option>
                        <option value="today">Today</option>
                        <option value="yesterday">Yesterday</option>
                        <option value="this_week">This Week</option>
                        <option value="last_week">Last Week</option>
                        <option value="this_month">This Month</option>
                        <option value="last_month">Last Month</option>
                        <option value="this_year">This Year</option>
                        <option value="last_year">Last Year</option>
                        <!-- Add more options here -->
                    </select>
                </div>
            </div>

            
            <button type="submit" class="btn btn-primary w-100">Apply Filters</button>
        </form>

        
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="tableData" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Call Number</th>
                            <th>Title</th>
                            <th>Author</th>
                            <th>Publish</th>
                            <th>Accession No.</th>
                            <th>Volume</th>
                            <th>Year</th>
                            <th>Created at</th>
                            <th width="13%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($dateFilterResults as $book)
                            <tr>
                                <td>{{ $book->call_number }}</td>
                                <td>{{ $book->title }}</td>
                                <td>{{ $book->author }}</td>
                                <td>{{ $book->publish }}</td>
                                <td>
                                    {{ implode(', ', json_decode($book->access_no)) }}
                                </td>
                                <td>{{ $book->volume }}</td>
                                <td>{{ $book->year }}</td>
                                <td>{{ $book->created_at }}</td>
                                <td>
                                <a class="btn btn-info mt-1" href="{{ route('admin.books.show', $book->id) }}"><i class="fas fa-eye"></i></a>
                                <a class="btn btn-primary mt-1" onclick="openEditBookModal('{{ route('admin.books.edit', $book) }}')"><i class="fa-solid fa-pen-to-square"></i></a>
                                    <form action="{{ route('admin.books.destroy', $book) }}" method="POST" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger mt-1" data-toggle="modal" data-target="#deleteBookModal{{$book->id}}"><i class="fas fa-trash text-white"></i></button>
                                        @include('admin.Books.deleteModal')
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
    <div class="bottom-right-container">
            <button class="bg-primary bottom-right-button" data-toggle="modal" data-target="#AddBooks">
            <i class="fa-solid fa-plus text-white px-1"></i>

            </button>
        </div>



@endsection