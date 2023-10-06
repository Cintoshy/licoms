@extends('layout.layout')

@section('content')
<h3 class="font-weight-bold text-center bg-gradient-dark text-light p-4">Departments</h3>
<div class="container-fluid">
  <div class="row row-cols-2 row-cols-lg-3 row-cols-md-3 g-5 g-lg-3 py-3">
    <div class="col">
        <div class="p-3 border bg-gradient-light d-flex flex-column justify-content-center align-items-center">
            <img class="m-3 img-fluid" src="{{ asset('img/Departments/CAS.jpg') }}" style="width: 200px; border-radius: 50%; border: 3px solid black">
                <a href="" class="btn btn-primary btn-block">
                <span class="full-text">College of Arts & Sciences</span>
                <span class="abbreviation">CAS</span>
            </a>
        </div>
    </div>
    <div class="col">
        <div class="p-3 border bg-gradient-light d-flex flex-column justify-content-center align-items-center">
            <img class="m-3 img-fluid" src="{{ asset('img/Departments/CCS.jpg') }}" style="width: 200px; border-radius: 50%; border: 3px solid black">
            <a href="{{ route('admin.CCS.index') }}" class="btn btn-primary btn-block">
                <span class="full-text">College of Computer Studies</span>
                <span class="abbreviation">CCS</span>
            </a>
        </div>
    </div>
    <div class="col">
        <div class="p-3 border bg-gradient-light d-flex flex-column justify-content-center align-items-center">
            <img class="m-3 img-fluid" src="{{ asset('img/Departments/CEA.jpg') }}" style="width: 200px; border-radius: 50%; border: 3px solid black">
            <a href="" class="btn btn-primary btn-block">
            <span class="full-text">College of Engineering and Architecture</span>
            <span class="abbreviation">CEA</span>
            </a>
        </div>
    </div>
    <div class="col">
        <div class="p-3 border bg-gradient-light d-flex flex-column justify-content-center align-items-center">
            <img class="m-3 img-fluid" src="{{ asset('img/Departments/CHS.jpg') }}" style="width: 200px; border-radius: 50%; border: 3px solid black">
            <a href="" class="btn btn-primary btn-block">
                <span class="full-text">College of Health Sciences</span>
                <span class="abbreviation">CHS</span>
            </a>
        </div>
    </div>
    <div class="col">
        <div class="p-3 border bg-gradient-light d-flex flex-column justify-content-center align-items-center">
            <img class="m-3 img-fluid" src="{{ asset('img/Departments/CTDE.jpg') }}" style="width: 200px; border-radius: 50%; border: 3px solid black">
            <a href="" class="btn btn-primary btn-block" style="font-size: 15px;"> 
                <span class="full-text">College of Technological Developmental Education</span>
                <span class="abbreviation">CTDE</span>
            </a>
        </div>
    </div>
        <div class="col">
            <div class="p-3 border bg-gradient-light d-flex flex-column justify-content-center align-items-center">
                <img class="m-3 img-fluid" src="{{ asset('img/Departments/CTHBM.jpg') }}" style="width: 200px; border-radius: 50%; border: 3px solid black">
                <a href=""  class="btn btn-primary btn-block" style="font-size: 14px;">            
                    <span class="full-text">College of Tourism Hospitality & Business Management</span>
                    <span class="abbreviation">CTHBM</span>
                </a>
            </div>
        </div>
    </div>
</div>

@include('admin.SOR.modal')
    
@endsection