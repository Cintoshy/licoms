@extends('layout.layout')


@section('content')
<div class="container mt-5">
<div class="row">
    <div class="col-md-12" id="details">
            <div class="card card-primary card-outline">
              <div class="card-header bg-gradient-light">
                <h2 class="fw-bolder">BOOK DETAILS</h2>
              </div>
              <div class="card-body pad table-responsive">
              <!-- <a href="{{ route('admin-books.index') }}" class="btn btn-warning btn-icon-split btn-sm mb-3">
                    <span class="icon text-white-50">
                        <i class="fas fa-arrow-left my-1"></i>
                    </span>
                    <span class="text">RETURN</span>
                </a>
-->
                <table class="table table-bordered table-lg text-right mt-3">
                    <tbody>
                        <tr>
                        <th scope="row" class="align-middle" width="25%">Call Number :</th>
                        <td class="align-middle fw-bolder text-danger text-left">{{ $book->call_number }}</td>
                        </tr>
                        <tr>
                        <th scope="row" class="align-middle" width="25%">BOOK TITLE :</th>
                        <td class="align-middle font-weight-bold text-light bg-gradient-primary text-left">{{ $book->title }}</td>
                        </tr>
                        <tr>
                        <th scope="row">AUTHOR :</th>
                        <td class="text-left">{{ $book->author }}</td>
                        </tr>
                        <tr>
                        <th scope="row">STATUS :</th>
                        <td class="text-left">{{ $book->title }}</td>
                        </tr>
                        <tr>
                        <th scope="row">PUBLISH :</th>
                        <td class="text-left">{{ $book->publish }}</td>
                        </tr>
                        <tr>
                        <th scope="row">YEAR :</th>
                        <td class="text-left">{{ $book->year }}</td>
                        </tr>
                        <tr>
                        <th scope="row">VOLUME/s :</th>
                        <td class="text-left"> {{ $book->volume }}</td>
                        </tr>
                        <tr>
                        <tr>
                        <th scope="row">ACCESSION NUMBER :</th>
                        <td class="text-left"> {{ implode(', ', json_decode($book->access_no)) }}</td>
                        </tr>
                        <th scope="row">DATE :</th>
                        <td class="text-left">{{ $book->created_at }}</td>
                        </tr>

                    </tbody>
                </table>

                    <!-- <div class="mt-3 text-end">
                        <button id="details-btn" class="btn btn-success">DOI</button>
                        <button class="btn btn-primary">Abstarct</button>
                    </div> -->
              </div>
            </div>
          </div>
          </div>



        <!-- <form id="details-form" class="mt-4" style="display: none;">
            <div class="col-md-12">
                <div class="card card-primary card-outline">
                    <div class="card-header">DETAILS</div>
                        <div class="row">
                            <div class="card-body pad table-responsive">
                                <div class="col-sm-4 mb-3 sm-0">
                                    <h4>Digital Object Identifier</h4>
                                 <div class="input-group">
                                    <input type="text" class="form-control form-control-user" id="title" name="title" value="http.doi/10/EthicalHacking">
                                <div class="input-group-append">
                                    <button class="btn btn-primary  px-3" type="button">Visit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </form> -->
    </div>
          @endsection
