@extends('layout.layout')

@section('content')

<!-- Add User -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Add Program</h6>
    </div>
    <div class="card-body">
    <div class="row">
            <div class="col-md-9">
                <a href="{{ route('admin.users.index') }}" class="btn btn-warning btn-icon-split btn-sm mb-3">
                    <span class="icon text-white-50">
                        <i class="fas fa-arrow-left mt-1"></i>
                    </span>
                    <span class="text">RETURN</span>
                </a>
            </div>
                <div class="col-md-3">
                    
                    <div class="d-flex justify-content-end">
                    <button class="btn btn btn-primary btn-sm mx-1" data-toggle="modal" data-target="#CreateDepartment">
                    <span class="text">Add Department
                                <i class="fas fa-plus mt-1"></i>
                            </span>
                    </button>
                    <button class="btn btn btn-primary btn-sm " data-toggle="modal" data-target="#CreateCourse">
                         <span class="text">Add Course
                                <i class="fas fa-plus mt-1"></i>
                            </span>
                    </a>
                    </div>
                </div>
            </div>


        @if (isset($validation))
            <div class="alert alert-danger" role="alert">
                <ul>
                    @foreach ($validation as $validation)
                        <li>{{ esc($validation) }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.users.store') }}" method="post">
            @csrf
            <div class="form-group row">
                <div class="col-sm-12 mb-6 mb-sm-0">
                    <input type="text" class="form-control form-control-user" id="id" name="id" value=""
                        placeholder="Id Number" required>
                </div>
            </div>
                <div class="form-group row">
                <div class="col-sm-6 mb-3 sm-0">
                <select class="form-control form-control-user" id="department" name="department" required>
                            <option value="" disabled selected>Department</option>
                        @foreach ($program as $department)
                             <option value="{{ $department->department }}">{{ $department->department }}</option>
                         @endforeach
                    </select>
                </div>
                <div class="col-md-6 mb-3   ">
                <select class="form-control form-control-user" id="program" name="program" required>
                            <option value="" disabled selected>Program</option>
                        @foreach ($program as $program)
                             <option value="{{ $program->name }}">{{ $program->name }}</option>
                         @endforeach
                    </select>
                </div>
                <div class="col-sm-6 mb-3 sm-0">
                <select class="form-control form-control-user" id="course" name="course" required>
                            <option value="" disabled selected>Course</option>
                        @foreach ($courses as $course)
                             <option value="{{ $course->name }}">{{ $course->course_title }}</option>
                         @endforeach
                    </select>
                </div>
                <div class="col-md-6 mb-3   ">
                    <select class="form-control form-control-user" id="role" name="role">
                        <option value="" selected disabled>Year</option>
                        <option value="0">1st Year</option>
                        <option value="1">2nd Year</option>
                        <option value="2">3rd Year</option>
                        <option value="3">4th year</option>
                    </select>
                </div>
                
                <div class="col-sm-6 mb-5 mb-sm-0">
                    <input type="text" class="form-control form-control-user" id="crs_grp" name="crs_grp" value="" placeholder="Course Group" required>
                </div>
                <div class="col-sm-6 mb-5 mb-sm-0">
                    <select class="form-control form-control-user" id="role" name="role">
                        <option value="" selected disabled>Semester</option>
                        <option value="0">1st Semester</option>
                        <option value="1">2nd Semester</option>
                    </select>
                </div>
                <div class="col-sm-6 mt-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user" id="title" name="title" value=""
                        placeholder="Title" required>
                </div>
            </div>
            <div class="form-group row">

            </div>
            <button href="{{ route('admin.users.index') }}" class="btn btn-primary btn-block">
                <i class="fas fa-plus"></i> Add Program
            </button>
        </form>
        
    </div>
   
</div>
@include('admin.Program.modal')

        </div>
    </div>
</div>

@endsection
