@extends('layout.layout')

@section('content')
    <div class="card shadow">
        <div class="card-header">
            <h6 class="m-0 font-weight-bold text-primary">Summary of Records</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-8 mb-3">
                    <a href="{{ route('admin.users.create') }}" class="btn btn-success btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fas fa-plus mt-1"></i>
                </span>
                <span class="text">Convert to Excel</span>
                </a>
            </div>
                <div class="col-md-4 mb-3">
                    
                <select class="form-control" id="role" name="role">
                        <option value="">All Department</option>
                        <option value="0">CAS</option>    
                        <option value="1">CCS</option>
                        <option value="2">CEA</option>
                        <option value="3">CHS</option>
                        <option value="4">CTDE</option>
                        <option value="5">CTHBM</option>
                    </select>
</div>
                </div>
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Department</th>
                            <th>Program</th>
                            <th>T</th>
                            <th>V</th>
                            <th>Pending Titles</th>
                            <th>Title Needed</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
