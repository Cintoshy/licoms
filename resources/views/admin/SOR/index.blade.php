@extends('layout.layout')

@section('content')
<h3 class="font-weight-bold text-center bg-gradient-dark text-light p-4">Summary of Records by Department</h3>
<div class="container-fluid">
  <div class="row row-cols-2 row-cols-lg-3 row-cols-md-3 g-5 g-lg-3 py-3">
    <div class="col">
        <div class="p-3 border bg-gradient-light d-flex justify-content-center align-items-center">
            <img class="m-3 img-fluid" src="{{ asset('img/Departments/CAS.jpg') }}" style="width: 200px; border-radius: 50%; border: 3px solid black">
        </div>
        <a data-toggle="modal" data-target="#CAScourseModal" class="btn btn-primary btn-block mb-3">College of Arts & Sciences</a>
    </div>
    <div class="col">
        <div class="p-3 border bg-gradient-light d-flex justify-content-center align-items-center">
            <img class="m-3 img-fluid" src="{{ asset('img/Departments/CCS.jpg') }}" style="width: 200px; border-radius: 50%; border: 3px solid black">
        </div>
        <a data-toggle="modal" data-target="#CCScourseModal" class="btn btn-primary btn-block">College of Computer Studies</a>
    </div>
    <div class="col">
        <div class="p-3 border bg-gradient-light d-flex justify-content-center align-items-center">
            <img class="m-3 img-fluid" src="{{ asset('img/Departments/CEA.jpg') }}" style="width: 200px; border-radius: 50%; border: 3px solid black">
        </div>
        <a data-toggle="modal" data-target="#CEAcourseModal" class="btn btn-primary btn-block mb-3">College of Engineering and Architecture</a>
    </div>
    <div class="col">
        <div class="p-3 border bg-gradient-light d-flex justify-content-center align-items-center">
            <img class="m-3 img-fluid" src="{{ asset('img/Departments/CHS.jpg') }}" style="width: 200px; border-radius: 50%; border: 3px solid black">
        </div>
        <a data-toggle="modal" data-target="#CHScourseModal" class="btn btn-primary btn-block">College of Health Sciences</a>
    </div>
    <div class="col">
        <div class="p-3 border bg-gradient-light d-flex justify-content-center align-items-center">
            <img class="m-3 img-fluid" src="{{ asset('img/Departments/CTDE.jpg') }}" style="width: 200px; border-radius: 50%; border: 3px solid black">
        </div>
        <a data-toggle="modal" data-target="#CTDEcourseModal" class="btn btn-primary btn-block" style="font-size: 14px;">College of Technological Developmental Education</a>
    </div>
    <div class="col">
        <div class="p-3 border bg-gradient-light d-flex justify-content-center align-items-center">
            <img class="m-3 img-fluid" src="{{ asset('img/Departments/CTHBM.jpg') }}" style="width: 200px; border-radius: 50%; border: 3px solid black">
        </div>
        <a data-toggle="modal" data-target="#CTHBMcourseModal" class="btn btn-primary btn-block" style="font-size: 13px;">College of Tourism Hospitality & Business Management</a>
    </div>
</div>
</div>

@include('admin.SOR.modal')
    
@endsection