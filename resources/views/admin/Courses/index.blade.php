@extends('layout.layout')

@section('content')

@include('flash_message')

<div class="card shadow mb-4">
<div class="card-header">
            <div class="row no-gutters align-items-center">
                
                <div class="col mr-2">
                <h1 class="display-6 fw-bolder text-uppercase">Course Subject</h1>
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                        Total Course</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $course->count() }}</div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-graduation-cap fa-4x text-gray-500 pr-3"></i>
                </div>
            </div>
        </div>
        <div class="card-body">
            <button id="details-btn" class="btn btn-primary mb-3">
            <i class="fas fa-filter me-2"></i>Filter
            </button>

            <a class="btn btn-secondary mb-3"  href="{{ route('admin.course.index') }}">    
                <i class="fas fa-cogs mr-2"></i>Clear
            </a>   
        <!-- <button class="btn btn-success mb-3" id="exportPdfBtn">Import</button> -->
        <form id="details-form" style="display: none;" method="get" action="{{ route('admin.course.filter') }}">
                @csrf
            <div class="row ">
                <div class="col-md-6 mb-3">
                    <select class="form-control form-control-user" id="program_filter" name="program_filter">
                        <option value="" selected>All Program</option>
                        @foreach ($programs as $program)
                           <option value="{{ $program->name }}">{{ $program->name }}</option>
                       @endforeach

                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <select class="form-control form-control-user" id="courseGroup_filter" name="courseGroup_filter">
                        <option value="" selected>Course Group</option>
                        @foreach ($courseGroups as $courseGroup)
                           <option value="{{ $courseGroup->course_group }}">{{ $courseGroup->course_group }}</option>
                       @endforeach
                    </select>
                </div>
            </div>
            <button type="submit" class="btn btn-primary w-100">Apply Filters</button>
        </form>


            <div class="table-responsive">
                <table class="table table-bordered" id="tableData" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Course Code</th>
                            <th>Course Name</th>
                            <th>Course Group</th>
                            <th>Course Level</th>
                            <th>Assigned Program</th>
                            <th width="10%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($dateFilterResults as $course)
                            <tr>
                                <td>{{ $course->id }}</td>
                                <td>{{ $course->course_code }}</td>
                                <td>{{ $course->course_title }}</td>
                                <td>{{ $course->course_group }}</td>
                                <td>{{ $course->course_level }}</td>
                                <td>{{ $course->assigned_program }}</td>
                                <td>
                                <a class="btn btn-primary" onclick="openEditCourseModal('{{ route('admin.course.edit', $course) }}')"><i class="fa-solid fa-pen-to-square"></i></a>
                                    <form action="{{ route('admin.course.destroy', $course) }}" method="POST" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteCourseModal{{$course->id}}"><i class="fas fa-trash text-white"></i></button>
                                        @include('admin.Courses.deleteCourseModal')
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="bottom-right-container">
            <button class="bg-primary bottom-right-button" data-toggle="modal" data-target="#CreateCourse">

            <i class="fa-solid fa-plus text-white px-1"></i>

            </button>
        </div>

        @include('admin.Courses.modal')
    
    </div>
</div>
</div>


@endsection
