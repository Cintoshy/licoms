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
                <div class="icon-circle bg-gradient-primary">
                                <i class="fa-solid fa-bookmark"></i>
                                
                            </div>
                        </div>
                    <div>
                    <div class="font-weight-bold">"{{ $selectedBook->book->title }}" has been Selected <span class="fw-bolder text-danger">{{ $selectedBook->faculty->first_name }} {{ $selectedBook->faculty->last_name }}</span> to the Course Subject "{{ $selectedBook->course_id }}"</div>
                         <span class="small text-gray-500">{{ $selectedBook->created_at }}</span>
                    </div>
                    </div>
                </div>

                <table class="table table-bordered table-sm text-right">
                    <tbody>
                        <tr>
                        <th scope="row" class="align-middle" width="25%">BOOK TITLE</th>
                        <td class="align-middle font-weight-bold text-light bg-gradient-primary text-left">{{ $selectedBook->book->title }}</td>
                        </tr>
                        <tr>
                        <th scope="row">AUTHOR</th>
                        <td class="text-left">{{ $selectedBook->book->author }}</td>
                        </tr>
                        <tr>
                        <th scope="row">Access Number</th>
                        <td class="text-left">{{ $selectedBook->book->access_no }}</td>
                        </tr>
                        <tr>
                        <th scope="row">PUBLISH</th>
                        <td class="text-left">{{ $selectedBook->book->publish }}</td>
                        </tr>
                        <tr>
                        <th scope="row">YEAR</th>
                        <td class="text-left">{{ $selectedBook->book->year }}</td>
                        </tr>
                        <tr>
                        <th scope="row">COPY</th>
                        <td class="text-left">{{ $selectedBook->book->copy }}</td>
                        </tr>
                        <tr>
                        <td colspan="2"></td>
                        </tr>
                        <tr>
                        <th scope="row" class="align-middle" width="25%">COURSE CODE</th>
                        <td class="align-middle font-weight-bold text-light bg-gradient-warning text-left">{{ $selectedBook->course_id }}</td>
                        </tr>
                        <tr>
                        <th scope="row">COURSE TITLE</th>
                        <td class="text-left">{{ $selectedBook->course->course_title }}</td>
                        </tr>
                        <tr>
                        <th scope="row">LEVEL</th>
                        <td class="text-left">{{ $selectedBook->course->course_level }}</td>
                        </tr>
                        <tr>
                        <th scope="row">FACULTY</th>
                        <td class="text-left">{{ $selectedBook->faculty ? $selectedBook->faculty->first_name . ' ' . $selectedBook->faculty->last_name : 'None' }}</td>
                        </tr>
                        <tr>
                        <th scope="row">PROGRAM CHAIR</th>
                        <td class="text-left">{{ $selectedBook->programChair ? $selectedBook->programChair->first_name . ' ' . $selectedBook->programChair->last_name : 'None' }}</td>
                        </tr>
                        <tr>
                        <th scope="row">LIBRARIAN</th>
                        <td class="text-left">{{ $selectedBook->librarian ? $selectedBook->librarian->first_name . ' ' . $selectedBook->librarian->last_name : 'None' }}</td>
                        </tr>
                        <tr>
                        <th scope="row">DATE APPROVED</th>
                        <td class="text-left bg-success text-light">
                        @if ($selectedBook->approved_at)
                            {{ $selectedBook->approved_at }}
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
