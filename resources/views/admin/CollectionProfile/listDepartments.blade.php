@extends('layout.layout')

@section('content')
<h3 class="font-weight-bold text-center bg-gradient-dark text-light p-4">Collection Profiles</h3>
<div class="container-fluid">
  <div class="row">
    @foreach($departments as $department)
    <div class="col-6 pt-3">
        <div class="p-3 border bg-gradient-light d-flex flex-column justify-content-center align-items-center">
            <img class="m-3 img-fluid" src="{{ asset('storage/' . $department->logo) }}" style="width: 200px; border-radius: 50%; border: 3px solid black">
            <a data-toggle="modal" data-target="#CAS{{$department->id}}" class="btn btn-primary btn-block">
                <span class="full-text">{{$department->description}}</span>
                <span class="abbreviation">{{$department->department_name}}</span>
            </a>
        </div>
    </div>
    @include('admin.CollectionProfile.modal')
    @endforeach
    
    </div>
</div>


    
@endsection