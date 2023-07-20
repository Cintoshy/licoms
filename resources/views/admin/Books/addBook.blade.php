@extends('layout.layout')


@section('content')
<!-- Add User -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Add Book</h6>
    </div>
    <div class="card-body">
        <a href="{{ route('admin-books.index') }}" class="btn btn-warning btn-icon-split mb-3">
            <span class="icon text-white-50">
                <i class="fas fa-arrow-left pt-1"></i>
            </span>
            <span class="text">RETURN</span>
        </a>

        @if (isset($validation))
            <div class="alert alert-danger" role="alert">
                <ul>
                    @foreach ($validation as $validation)
                        <li>{{ esc($validation) }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.books.store') }}" method="post">
            @csrf
            <div class="form-group row">
                <div class="col-sm-12 mb-6 mb-sm-0">
                    <input type="text" class="form-control form-control-user" id="id" name="id" value=""
                        placeholder="Book Number" required>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-6 mb-3 sm-0">
                    <input type="text" class="form-control form-control-user" id="cn" name="cn" value=""
                        placeholder="Call Number" required>
                </div>
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user" id="access_no" name="access_no" value=""
                        placeholder="Accession Number" required>
                </div>
                <div class="col-sm-6 mb-sm-0">
                    <input type="text" class="form-control form-control-user" id="title" name="title" value=""
                        placeholder="Title" required>
                </div>
                <div class="col-sm-6 mb-sm-0">
                    <input type="text" class="form-control form-control-user" id="copy" name="copy" value=""
                        placeholder="Copy" required>
                </div>
                <div class="col-sm-6 mt-3 sm-0">
                    <input type="text" class="form-control form-control-user" id="author" name="author" value=""
                        placeholder="Author">
                </div>
                <div class="col-sm-6 mb-5 mt-3 mb-sm-0">
                    <select class="form-control form-control-user" id="year" name="year" required>
                        <option value="" selected disabled>Year</option>
                        <option value="0">2015</option>
                        <option value="1">2016</option>
                        <option value="2">2017</option>
                        <option value="3">2018</option>
                    </select>
                </div>
                <div class="col-sm-6 mt-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user" id="publish" name="publish" value=""
                        placeholder="Publish" required>
                </div>
                <div class="col-sm-6 mt-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user" id="cc" name="cc" value=""
                        placeholder="CC" required>
                </div>
            </div>
            <button class="btn btn-primary btn-block">
                <i class="fas fa-plus"></i> Add Book
            </button>
        </form>
    </div>
</div>

<div class="col-md-12">
    <div class="text-center">
      <button class="btn btn-primary">Actions</button>
      <button class="btn btn-primary">Details</button>
      <button class="btn btn-primary">Line-Item Budget</button>
      <button class="btn btn-primary">Classifications</button>
      <button class="btn btn-primary">Files</button>
      <button class="btn btn-primary">Messages</button>
      <button class="btn btn-primary">Project Team</button>
      <button class="btn btn-primary">Status</button>
      <button class="btn btn-primary">Cash Program</button>
      <button class="btn btn-primary">Reprogramming Status</button>
    </div>

@endsection
