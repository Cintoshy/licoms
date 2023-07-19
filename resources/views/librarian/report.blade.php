@extends('layout.layout')

@section('content')
    <div class="card shadow">
        <div class="card-header">
            <h6 class="m-0 font-weight-bold text-primary">Generate Reports</h6>
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
                <table class="table table-bordered table-active table-striped text-center" id="dataTable" width="100%" cellspacing="0">
                    <thead  class="bg-gradient-info text-light">
                    <tr>
                        <th colspan="2">CCS</th>
                        <th colspan="2">2024</th>
                        <th colspan="2">2023</th>
                        <th colspan="2">2022</th>
                        <th colspan="2">2021</th>
                        <th colspan="2">2020</th>
                        <th rowspan="2">Printed Books</th>
                        <th rowspan="2">Electronics Books</th>
                        <th colspan="2">Grand Total</th>
                        <th rowspan="2">% per Subject</th>
                        <th rowspan="2">Titles Needed</th>
                        <th colspan="2">2019  Below</th>
                        
                    </tr>

                        <tr>
                            <th rowspan="2">CC</th>
                            <th rowspan="2">Courses</th>
                            <th>T</th>
                            <th>V</th>
                            <th>T</th>
                            <th>V</th>
                            <th>T</th>
                            <th>V</th>
                            <th>T</th>
                            <th>V</th>
                            <th>T</th>
                            <th>V</th>
                            <th>T</th>
                            <th>V</th>
                            <th>T</th>
                            <th>V</th>
                        </tr>
                    </thead>
                    <tbody>
                            <tr>
                                <td>ma</td>
                                <td>ma</td>
                                <td>ma</td>
                                <td>ma</td>
                                <td>ma</td>
                                <td>ma</td>
                                <td>ma</td>
                                <td>ma</td>
                                <td>ma</td>
                                <td>ma</td>
                                <td>ma</td>
                                <td>ma</td>
                                <td>ma</td>
                                <td>ma</td>
                                <td>ma</td>
                                <td>ma</td>
                                <td>ma</td>
                                <td>ma</td>
                                <td>ma</td>
                                <td>ma</td>
                            </tr>
                            <tr>
                            <td>ma</td>
                                <td>ma</td>
                                <td>ma</td>
                                <td>ma</td>
                                <td>ma</td>
                                <td>ma</td>
                                <td>ma</td>
                                <td>ma</td>
                                <td>ma</td>
                                <td>ma</td>
                                <td>ma</td>
                                <td>ma</td>
                                <td>ma</td>
                                <td>ma</td>
                                <td>ma</td>
                                <td>ma</td>
                                <td>ma</td>
                                <td>ma</td>
                                <td>ma</td>
                                <td>ma</td>
                            </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
