@extends('layout.layout')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header">
        <div class="row no-gutters align-items-center">
            <div class="col mr-2">
                <h1 class="display-6 fw-bolder text-uppercase">Collection Profile Report</h1>
                <p>By Programs</p>
            </div>

            <div class="col-auto">
                <i class="fas fa-chart-bar fa-4x text-gray-500 pr-3"></i>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="row row-cols-1 row-cols-lg-2 row-cols-md-3 g-5 g-lg-3 py-0">
            @foreach($programs as $program)
                <div class="col">      
                    <a id="program-a" href="{{ route('lib-reports', ['param' => $program->name ]) }}">
                        <div class="p-3 border d-flex flex-column justify-content-center align-items-center background-prorgam">
                            <h1 class="circle-singleline">{{$program->name}}</h1>
                            <span>{{$program->description}}</span>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</div>
    
@endsection