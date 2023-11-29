@extends('layout.layout')


@section('content') 
<div class="col-md-12">
            <div class="card card-primary card-outline bg-gradient-light mt-5">
              <div class="card-header bg-gradient-secondary text-light">
                  BOOK REQUESTED DETAILS
              </div>
              <div class="card-body pad table-responsive">
              <div class="mb-3">
                    <div class="d-flex align-items-center">
                        <div class="mr-3">
                    <div class="icon-circle bg-success">
                        <i class="fas fa-check text-white"></i>    
                        </div>
                        </div>
                    <div>
                    <div class="font-weight-bold">"{{ $approvedBook->book->title }}" has been Approved <span class="fw-bolder text-danger">{{ $approvedBook->librarian->first_name ?? '-' }} {{ $approvedBook->librarian->last_name ?? $approvedBook->librarian}}</span> to the Course Subject "{{ $approvedBook->course_id }}"</div>
                         <span class="small text-gray-500">{{ $approvedBook->approved_at }}</span>
                    </div>
                    </div>
                </div>

                <table class="table table-bordered table-sm text-right">
                    <tbody>
                        <tr>
                        <th scope="row" class="align-middle" width="25%">BOOK TITLE</th>
                        <td class="align-middle font-weight-bold text-light bg-gradient-primary text-left">{{ $approvedBook->book->title }}</td>
                        </tr>
                        <tr>
                        <th scope="row">AUTHOR</th>
                        <td class="text-left">{{ $approvedBook->book->author }}</td>
                        </tr>
                        <tr>
                        <th scope="row">Access Number</th>
                        <td class="text-left">{{ implode(', ', json_decode($approvedBook->book->access_no)) }}</td>
                        </tr>
                        <tr>
                        <th scope="row">PUBLISH</th>
                        <td class="text-left">{{ $approvedBook->book->publish }}</td>
                        </tr>
                        <tr>
                        <th scope="row">YEAR</th>
                        <td class="text-left">{{ $approvedBook->book->year }}</td>
                        </tr>
                        <tr>
                        <th scope="row">VOLUME</th>
                        <td class="text-left">{{ $approvedBook->book->volume }}</td>
                        </tr>
                        <tr>
                        <td colspan="2"></td>
                        </tr>
                        <tr>
                        <th scope="row" class="align-middle" width="25%">COURSE CODE</th>
                        <td class="align-middle font-weight-bold text-light bg-gradient-warning text-left">{{ $approvedBook->course_id }}</td>
                        </tr>
                        <tr>
                        <th scope="row">COURSE TITLE</th>
                        <td class="text-left">{{ $approvedBook->course->course_title }}</td>
                        </tr>
                        <tr>
                        <th scope="row">LEVEL</th>
                        <td class="text-left">{{ $approvedBook->course->course_level }}</td>
                        </tr>
                        <tr>
                        <th scope="row">FACULTY</th>
                        <td class="text-left">{{ $approvedBook->faculty ? $approvedBook->faculty->first_name . ' ' . $approvedBook->faculty->last_name : 'None' }}</td>
                        </tr>
                        <tr>
                        <th scope="row">LIBRARIAN</th>
                        <td class="text-left">{{ $approvedBook->librarian ? $approvedBook->librarian->first_name . ' ' . $approvedBook->librarian->last_name : 'None' }}</td>
                        </tr>
                        <tr>
                        <th scope="row">PROGRAM CHAIR</th>
                        <td class="text-left">{{ $approvedBook->programChair ? $approvedBook->programChair->first_name . ' ' . $approvedBook->programChair->last_name : 'Unavailable user' }}</td>
                        </tr>
                        <tr>
                        <th scope="row">DATE APPROVED</th>
                        <td class="text-left bg-success text-light">
                        @if ($approvedBook->approved_at)
                            {{ $approvedBook->approved_at }}
                        @else
                            Pending
                        @endif
                        </td>
                        </tr>

                    </tbody>
                </table>



              </div>
            </div>
            <div class="card-header bg-gradient-secondary ">
              </div>
          </div>
          @endsection
