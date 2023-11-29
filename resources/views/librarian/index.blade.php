@extends('layout.layout')

@section('content')

<div class="container-fluid">

                    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>    
                <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                    <i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
                    </div>
                    <!-- Content Row -->
                    <div class="row">

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Total Noted Books</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalNotedBooks }}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-book fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Approved Books Card -->
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Active Collection Books</div>   
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">

                                            {{ $activeCollections }}
                                        </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-check-circle fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                            <!-- Pending Requests Card Example -->
                            <div class="col-xl-4 col-md-6 mb-4">
                                <div class="card border-left-warning shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                    Book Pending Requests</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalPendingBooks }}</div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-hourglass-half fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    
                    
                    <div class="row">
                    <script>
                        var prescribedYears = <?= json_encode($programs) ?>;
                        var programCounts = <?= json_encode($programCounts) ?>;
                        var dataValues = Object.values(programCounts);
                    </script>
                        <!-- Area Chart -->
                        <div class="col-xl-12 col-lg-12">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                        <h1 class="display-6 fw-bolder text-uppercase">Book Overview</h1>
                                        <h6 class="mb-0">Prescribed 5 Years</h6>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-bookmark fa-4x text-gray-500 pr-3"></i>
                                        </div>
                                    </div>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body mt-3">
                                    <div class="chart-area">
                                        <canvas id="myAreaChartLibrarian"></canvas>
                                    </div>
                                </div>

                            </div>


                            
                        </div>
                        

                       
                        <!-- <div class="col-lg-4 mb-4">

                            
                            <div class="card shadow mb-4">
                            <div class="card-header">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                        <h4 class="fw-bolder text-uppercase">Active Collection</h4>
                                        <h6 class="mb-0">Prescribed 5 Years</h6>
                                        </div>
                                                <div class="col-auto">
                                                    <i class="fa-brands fa-squarespace fa-2x text-gray-500 pr-3"></i>
                                                </div>
                                    </div> -->
                                <!-- <div class="card-body">
                                    <h4 class="small font-weight-bold">Server Migration <span
                                            class="float-right">20%</span></h4>
                                    <div class="progress mb-4">
                                        <div class="progress-bar bg-danger" role="progressbar" style="width: 20%"
                                            aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <h4 class="small font-weight-bold">Sales Tracking <span
                                            class="float-right">40%</span></h4>
                                    <div class="progress mb-4">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width: 40%"
                                            aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <h4 class="small font-weight-bold">Customer Database <span
                                            class="float-right">60%</span></h4>
                                    <div class="progress mb-4">
                                        <div class="progress-bar" role="progressbar" style="width: 40%"
                                            aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <h4 class="small font-weight-bold">Payout Details <span
                                            class="float-right">80%</span></h4>
                                    <div class="progress mb-4">
                                        <div class="progress-bar bg-info" role="progressbar" style="width: 80%"
                                            aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <h4 class="small font-weight-bold">Account Setup <span
                                            class="float-right">Complete!</span></h4>
                                    <div class="progress">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: 100%"
                                            aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>

                    </div> -->
                    


                        </div>
                </div>  
                
@endsection
