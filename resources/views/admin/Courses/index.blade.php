@extends('layout.layout')

@section('content')

@include('flash_message')

<div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Course List</h6>
        </div>
        <div class="card-body">
        <button class="btn btn btn-primary btn-sm mb-3" data-toggle="modal" data-target="#CreateCourse">
                    <span class="text">Add New
                                <i class="fas fa-plus mt-1"></i>
                            </span>
                    </button>

            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Course Id</th>
                            <th>Course Code</th>
                            <th>Course Name</th>
                            <th>Course Level</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($course as $course)
                            <tr>
                                <td>{{ $course->id }}</td>
                                <td>{{ $course->course_code }}</td>
                                <td>{{ $course->course_title }}</td>
                                <td>{{ $course->course_level }}</td>
                                <td>
                                <a class="btn btn-primary btn-sm" onclick="openEditCourseModal('{{ route('admin.course.edit', $course) }}')">Edit</a>
                                    <form action="{{ route('admin.course.destroy', $course) }}" method="POST" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @include('admin.Courses.modal')
@endsection
