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
                <div class="icon-circle bg-info">
                <i class="fa-solid fa-address-book"></i>
                                
                            </div>
                        </div>
                    <div>
                    <div class="font-weight-bold">"{{ $grantedBook->book->title }}" has been Granted of <span class="fw-bolder text-danger">{{ optional($grantedBook->programChair)->first_name ? $grantedBook->programChair->first_name . ' ' . $grantedBook->programChair->last_name : 'None' }}</span> to the Course Subject "{{ $grantedBook->course_id }}"</div>
                         <span class="small text-gray-500">{{ $grantedBook->granted_at }}</span>
                    </div>
                    </div>
                </div>

                <table class="table table-bordered table-sm text-right">
                    <tbody>
                        <tr>
                        <th scope="row" class="align-middle" width="25%">BOOK TITLE</th>
                        <td class="align-middle font-weight-bold text-light bg-gradient-primary text-left">{{ $grantedBook->book->title }}</td>
                        </tr>
                        <tr>
                        <th scope="row">AUTHOR</th>
                        <td class="text-left">{{ $grantedBook->book->author }}</td>
                        </tr>
                        <tr>
                        <th scope="row">Access Number</th>
                        <td class="text-left">{{ $grantedBook->book->access_no }}</td>
                        </tr>
                        <tr>
                        <th scope="row">PUBLISH</th>
                        <td class="text-left">{{ $grantedBook->book->publish }}</td>
                        </tr>
                        <tr>
                        <th scope="row">YEAR</th>
                        <td class="text-left">{{ $grantedBook->book->year }}</td>
                        </tr>
                        <tr>
                        <th scope="row">COPY</th>
                        <td class="text-left">{{ $grantedBook->book->copy }}</td>
                        </tr>
                        <tr>
                        <td colspan="2"></td>
                        </tr>
                        <tr>
                        <th scope="row" class="align-middle" width="25%">COURSE CODE</th>
                        <td class="align-middle font-weight-bold text-light bg-gradient-warning text-left">{{ $grantedBook->course_id }}</td>
                        </tr>
                        <tr>
                        <th scope="row">COURSE TITLE</th>
                        <td class="text-left">{{ $grantedBook->course->course_title }}</td>
                        </tr>
                        <tr>
                        <th scope="row">LEVEL</th>
                        <td class="text-left">{{ $grantedBook->course->course_level }}</td>
                        </tr>
                        <tr>
                        <th scope="row">FACULTY</th>
                        <td class="text-left">{{ $grantedBook->faculty ? $grantedBook->faculty->first_name . ' ' . $grantedBook->faculty->last_name : 'None' }}</td>
                        </tr>
                        <tr>
                        <th scope="row">PROGRAM CHAIR</th>
                        <td class="text-left">{{ $grantedBook->programChair ? $grantedBook->programChair->first_name . ' ' . $grantedBook->programChair->last_name : 'None' }}</td>
                        </tr>   
                        <tr>
                        <th scope="row">LIBRARIAN</th>
                        <td class="text-left">{{ $grantedBook->librarian ? $grantedBook->librarian->first_name . ' ' . $grantedBook->librarian->last_name : 'None' }}</td>
                        </tr>
                        <tr>
                        <th scope="row">DATE APPROVED</th>
                        <td class="text-left bg-success text-light">
                        @if ($grantedBook->approved_at)
                            {{ $grantedBook->approved_at }}
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
