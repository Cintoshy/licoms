@extends('layout.layout')

@section('content')

@include('flash_message')

<div class="card shadow mb-4">
<div class="card-header">
            <div class="row no-gutters align-items-center">
                
                <div class="col mr-2">
                <h1 class="display-6 fw-bolder text-uppercase">Course Group</h1>
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                        Total Course</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $courseGroup->count() }}</div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-graduation-cap fa-4x text-gray-500 pr-3"></i>
                </div>
            </div>
        </div>
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-bordered" id="tableData" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Course Group</th>
                            <th>Description</th>
                            <th width="10%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($courseGroup as $courseGroup)
                            <tr>
                                <td>{{ $courseGroup->course_group }}</td>
                                <td>{{ $courseGroup->description }}</td>

                                <td>
                                <a class="btn btn-primary" onclick="openEditCourseModal('{{ route('admin.courseGroup.edit', $courseGroup) }}')"><i class="fa-solid fa-pen-to-square"></i></a>
                                    <form action="{{ route('admin.courseGroup.destroy', $courseGroup) }}" method="POST" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger"data-toggle="modal" data-target="#deleteCourseGroupModal{{$courseGroup->id}}"><i class="fas fa-trash text-white"></i></button>
                                        @include('admin.courseGroup.deleteCourseGroupModal')
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
    @include('admin.courseGroup.modal')
    
        </div>
    </div>
</div>


@endsection
