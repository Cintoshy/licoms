@extends('layout.layout')

@section('content')
    <div class="card shadow">
        <div class="card-header">
        <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                <h1 class="display-6 fw-bolder text-uppercase">Summary Records</h1>
                </div>
                <div class="col-auto">
                    <i class="fas fa-file-contract fa-4x text-gray-500 pr-3"></i>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Department</th>
                            <th>Program</th>
                            <th>Total Titles</th>
                            <th>Total Volumes</th> 
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($groupedBooks as $program => $programBooks)
                            @php
                                $departments = $programBooks->first();
                            @endphp
                            <tr>
                                <td rowspan="{{ $departments->count() }}">{{ $departments->program->department}}</td>
                                <td>{{ $program }}</td>
                                <td>{{ $programBooks->sum('total_titles') }}</td>
                                <td>{{ $programBooks->sum('total_volumes') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>


            </div>
        </div>
    </div>
@endsection
