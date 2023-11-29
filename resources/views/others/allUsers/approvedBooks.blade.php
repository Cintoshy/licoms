@extends('layout.layout')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header">
            <div class="row no-gutters align-items-center">
                <div class="col-auto mr-2">
                    <h1 class="display-6 fw-bolder text-uppercase">Approved Books</h1>
                </div>
                <div class="col">
                    <i class="fas fa-circle-check fa-3x text-success pr-3"></i>
                </div>
                <div class="col-auto">
                <button class="align-items-center btn btn-danger btn-sm px-3 mx-3" type="button" data-toggle="modal" data-target="#exportOptionsModal">
                    Export to PDF
                    <i class="fas fa-download fa-sm text-white-50 ms-1"></i>
            </button>
                </div>
            </div>
        </div>
        <div class="card-body">

            <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Technical Courses and Subjects</th>
                            <th>AVAILABLE BOOKS (TITLES/AUTHOR/EDITION)</th>
                            <th>Copies</th>
                            <th>Copyright</th>
                            <th>Faculty</th>
                            <th>Program Chair</th>
                            <th>Librarian</th>
                            <!-- <th>Status</th> -->
                            <th>Date Noted</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @php $previousCourse = null; @endphp
                        @foreach ($organizeBook as $course => $courseData)
                            @php
                                $courseGroup = $courseData->first()->course_group
                            @endphp
                            @if ($courseGroup !== $previousCourse)
                                    <td class="table-success" colspan="10">{{$courseGroup}}</td>

                            @endif
                            <tr>
                                <td rowspan="{{ count($courseData) + 1 }}">{{ $course }}</td>
                            </tr>
                                
                                    @foreach ($courseData as $data)
                                    <tr>
                                        <td>{{ $data->title }}</td>
                                        <td>{{$data->volume}}</td>
                                        <td>{{$data->year}}</td>
                                        <td>
                                @if ($data->faculty)
                                    {{ $data->faculty->first_name }} {{ $data->faculty->last_name }}
                                @else
                                    Noted
                                @endif
                            </td>
                            <td>
                                @if ($data->programChair)
                                    {{ $data->programChair->first_name }} {{ $data->programChair->last_name }}
                                @else
                                Noted
                                @endif
                            </td>
                            
                            <td>
                                @if ($data->librarian)
                                    {{ $data->librarian->first_name }} {{ $data->librarian->last_name }}
                                @else
                                    -
                                @endif
                            </td>
                            <!-- <td class="fw-bold bg-gradient-success text-light">{{ $data->status }}</td> -->
                            <td>{{ $data->approved_at->format('Y-m-d h:i A') }}</td>
                            <td width="10%  ">
                                <a href="{{ route('all.approvedBookPage.show', $data->requested_book_id) }}" class="btn btn-primary btn-sm w-100">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-eye mt-1"></i>
                                        </span>
                                        <span class="text">View</span>
                                    </a>
                            </td>
                                    </tr>
                                    @endforeach

                                
                            @php $previousCourse = $courseGroup; @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @include('others.export.modal')
@endsection
