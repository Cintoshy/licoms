@extends('layout.layout')

@section('content')
<div class="container">
    <div class="row d-flex justify-content-center mt-5">
        <div class="col-md-10">
            <div class="card shadow-lg">
                <div class="card-header bg-gradient-danger text-white">{{ __('Oops!') }}</div>

                <div class="card-body text-center my-5">
                <h1 class="display-4"><i class="fas fa-exclamation-triangle text-warning"></i></h1>
                    <h1 class="display-4">Sorry, the content is not available.</h1>
                    <p class="lead">The requested content is no longer available or has been updated/deleted.</p>
                    <a href="{{ url()->previous() }}" class="btn btn-primary">{{ __('Go to Previous Page') }}</a>
                </div>
                <div class="card-header bg-danger text-white"></div>
            </div>
        </div>
    </div>
</div>
@endsection