@extends('layout.layout')

@section('content')

@include('flash_message')

    <div class="card shadow mb-4">
    <div class="card-header">
        <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                <h1 class="display-6 fw-bolder text-uppercase">Programs</h1>
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                        Total Program</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $program->count() }}</div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-chart-bar fa-house-flag fa-4x text-gray-500 pr-3"></i>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="tableData" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Program Name</th>
                            <th>Description</th>
                            <th>Department</th>
                            <th width="13%">Minimum Req</th>
                            <th width="10%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($program as $program)
                            <tr>
                                <td>{{ $program->name }}</td>
                                <td>{{ $program->description }}</td>
                                <td>{{ $program->department }}</td>
                                <td>{{ $program->minimum_req }}</td>
                                <td>
                                <a class="btn btn-primary" onclick="openDeptEditBookModal('{{ route('admin.program.edit', $program) }}')"><i class="fa-solid fa-pen-to-square"></i></a>
                                    <form action="{{ route('admin.program.destroy', $program) }}" method="POST" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger"data-toggle="modal" data-target="#deleteProgramModal{{$program->id}}"><i class="fas fa-trash text-white"></i></button>
                                        @include('admin.Programs.deleteProgramModal')
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


    @include('admin.Programs.modal')

        </div>
    </div>
</div>
    

@endsection
