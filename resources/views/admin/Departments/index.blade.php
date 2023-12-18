@extends('layout.layout')

@section('content')

@include('flash_message')

    <div class="card shadow mb-4">
        <div class="card-header">
        <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                <h1 class="display-6 fw-bolder text-uppercase">Departments</h1>
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                        Total Department</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $department->count() }}</div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-solid fa-house-flag fa-4x text-gray-500 pr-3"></i>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="tableData" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Department Name</th>
                            <th>Description</th>
                            <th>Logo</th>
                            <th width="10%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($department as $department)
                            <tr>
                                <td>{{ $department->department_name }}</td>
                                <td>{{ $department->description }}</td>
                                <td>
                                    @if ($department->logo)
                                        <img src="{{ asset('storage/' . $department->logo) }}" alt="Department Logo" width="50">
                                    @else
                                        NONE
                                    @endif
                                </td>

                                <td>
                                <a class="btn btn-primary" onclick="openDeptEditBookModal('{{ route('admin.department.edit', $department) }}')"><i class="fa-solid fa-pen-to-square"></i></a>
                                    <form action="{{ route('admin.department.destroy', $department) }}" method="POST" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteDepartmentModal{{$department->id}}"><i class="fas fa-trash text-white"></i></button>
                                        @include('admin.Departments.deleteDepartmentModal')
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
            <button class="bg-primary bottom-right-button" data-toggle="modal" data-target="#CreateDepartment">

            <i class="fa-solid fa-plus text-white px-1"></i>

            </button>
        </div>


    @include('admin.Departments.modal')

        </div>
    </div>
</div>

@endsection
