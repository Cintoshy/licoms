@extends('layout.layout')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">User List</h6>
        </div>
        <div class="card-body">
            <a class="btn btn-primary btn-icon-split mb-3" data-toggle="modal" data-target="#CreateUser">
                <span class="icon text-white-50">
                    <i class="fas fa-plus mt-1"></i>
                </span>
                <span class="text">Add User-type</span>
            </a>

            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>User No</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Contact</th>
                            <th>Email</th>
                            <th>Type of User</th>
                            <th>Assigned Program</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->first_name }}</td>
                                <td>{{ $user->last_name }}</td>
                                <td>{{ $user->contact }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @if ($user->role === 0)
                                        Admin
                                    @elseif ($user->role === 2)
                                        Librarian
                                    @elseif ($user->role === 1)
                                        Program chair
                                    @elseif ($user->role === 3)
                                        Faculty
                                    @else
                                        Unknown role
                                    @endif
                                <td>{{ $user->assigned_program }}</td>
                                </td>
                                <td>
                                <a class="btn btn-primary btn-sm" onclick="openEditUserModal('{{ route('admin.users.edit', $user) }}')">Edit</a>
                                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST" style="display: inline-block;">
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
    @include('admin.user-type.modal')
@endsection
