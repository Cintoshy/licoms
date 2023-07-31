@extends('layout.layout')

@section('content')

@include('flash_message')

<div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Department List</h6>
        </div>
        <div class="card-body">
        <button class="btn btn btn-primary btn-sm mb-3" data-toggle="modal" data-target="#CreateDepartment">
                    <span class="text">Add New
                                <i class="fas fa-plus mt-1"></i>
                            </span>
                    </button>

            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                        <th>Department Id</th>
                            <th>Department Code</th>
                            <th>Department Name</th>
                            <th>Program</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($program as $program)
                            <tr>
                            <td>{{ $program->id }}</td>
                                <td>{{ $program->code }}</td>
                                <td>{{ $program->department }}</td>
                                <td>{{ $program->name }}</td>
                                <td>{{ $program->description }}</td>
                                <td>
                                <a class="btn btn-primary btn-sm" onclick="openDeptEditBookModal('{{ route('admin.department.edit', $program) }}')">Edit</a>
                                    <form action="{{ route('admin.department.destroy', $program) }}" method="POST" style="display: inline-block;">
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


    @include('admin.Departments.modal')

@endsection
