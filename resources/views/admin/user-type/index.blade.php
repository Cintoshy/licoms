@extends('layout.layout')

@section('content')

@include('flash_message')
    <div class="card shadow mb-4">
    <div class="card-header">
        <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                <h1 class="display-6 fw-bolder text-uppercase">Users</h1>
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                        Total User</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $employees->count() }}</div>

                </div>
                <div class="col-auto">
                    <i class="fas fa-solid fa-user-gear fa-4x text-gray-500 pr-3"></i>
                </div>
            </div>
        </div>
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-bordered" id="tableData" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Employee ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Contact</th>
                            <th>Email</th>
                            <th>Type of User</th>
                            <th> Assigned Program</th>
                            <th>Department</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($employees as $employee)
                            <tr>
                                <td>{{ $employee->id }}</td>
                                <td>{{ $employee->user_id }}</td>
                                <td>{{ $employee->first_name }}</td>
                                <td>{{ $employee->last_name }}</td>
                                <td>{{ $employee->contact }}</td>
                                <td>{{ $employee->email }}</td>
                                <td>
                                    @if ($employee->role === 0)
                                        Admin
                                    @elseif ($employee->role === 2)
                                        Librarian
                                    @elseif ($employee->role === 1)
                                        Program chair
                                    @elseif ($employee->role === 3)
                                        Faculty
                                    @else
                                        Unknown role
                                    @endif
                                <td>{{ $employee->assigned_program ?? 'All' }}</td>
                                <td>{{ $employee->assigned_department ?? $employee->assignedProgram->department ?? 'All' }}</td>
                                </td>
                                <td>
                                <button class="btn btn-primary btn" onclick="openEditUserModal('{{ route('admin.users.edit', $employee) }}')"><i class="fa-solid fa-pen-to-square"></i></button>
                                    <form action="{{ route('admin.users.destroy', $employee) }}" method="POST" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger btn" data-toggle="modal" data-target="#deleteUserModal{{$employee->id}}"><i class="fas fa-trash text-white"></i></button>
                                        @include('admin.user-type.deleteModal')
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
    <div class="bottom-right-container">
            <button class="bg-primary bottom-right-button" data-toggle="modal" data-target="#CreateUser">

                    <i class="fa-solid fa-user-plus text-white"></i>

            </button>
        </div>
        @include('admin.user-type.modal')
        </div>
    </div>
</div>
@endsection
