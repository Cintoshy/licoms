@extends('layout.layout')

@section('content')
<!-- Add User -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Add Program</h6>
    </div>
    <div class="card-body">
        <a href="{{ route('admin.users.index') }}" class="btn btn-warning btn-icon-split mb-3">
            <span class="icon text-white-50">
                <i class="fas fa-arrow-left"></i>
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

        <form action="{{ route('admin.users.store') }}" method="post">
            @csrf
            <div class="form-group row">
                <div class="col-sm-12 mb-6 mb-sm-0">
                    <input type="text" class="form-control form-control-user" id="id" name="id" value=""
                        placeholder="Id Number">
                </div>
            </div>
                <div class="form-group row">
                <div class="col-sm-6 mb-3 sm-0">
                    <select class="form-control form-control-user" id="role" name="role">
                        <option value="" selected disabled>Department</option>
                        <option value="0">CAS</option>
                        <option value="1">CCS</option>
                        <option value="2">CEA</option>
                        <option value="3">CHS</option>
                        <option value="4">CTDE</option>
                        <option value="5">CTHBM</option>
                    </select>
                </div>
                <div class="col-md-6 mb-3   ">
                    <select class="form-control form-control-user" id="role" name="role">
                        <option value="" selected disabled>Program</option>
                        <option value="0">Program 1</option>
                        <option value="1">Program 2</option>
                        <option value="2">Program 3</option>
                        <option value="3">Program 4</option>
                    </select>
                </div>
                <div class="col-sm-6 mb-3 sm-0">
                    <select class="form-control form-control-user" id="role" name="role">
                        <option value="" selected disabled>Course</option>
                        <option value="0">Mobile Tech</option>
                        <option value="1">Ethical Hacking</option>
                        <option value="2">Programming</option>
                        <option value="3">Information Assurance</option>
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
                    <input type="text" class="form-control form-control-user" id="crs_grp" name="crs_grp" value=""
                        placeholder="Course Group" required>
                </div>
                <div class="col-sm-6 mb-5 mb-sm-0">
                    <select class="form-control form-control-user" id="role" name="role">
                        <option value="" selected disabled>Semeteser</option>
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

@endsection
