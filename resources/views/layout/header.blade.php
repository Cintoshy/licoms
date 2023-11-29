<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <link href="{{ asset('assets/css/sb-admin-2.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    </head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
    <ul class="navbar-nav sidebar sidebar-dark  accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <div class="sidebar-brand d-flex align-items-center justify-content-center">
            <div class="sidebar-brand-icon">
            <img src="{{ asset('img/1234.png') }}" style="width:45px">
            </div> 
            <div class="sidebar-brand-text mx-1">
            <img src="{{ asset('img/1230.png') }}" style="width:100px">
            </div>
        </div>

            @php
                $role = auth()->user()->role;
            @endphp

            @if($role === 0)
                        
        <!-- Admin Sidebar -->

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item fw-bold">
                <a class="nav-link">
                    <i class="fas fa-fw fa-user"></i>
                    <span>Admin Panel</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Menu
            </div>

            <div class="links">
            <!-- Nav Item - Charts -->
            <li class="nav-item @if(Route::is('admin.dashboard')) active @endif">
                <a class="nav-link" href="{{ route('admin.dashboard') }}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>
            <!-- Nav Item - Charts -->
            <li class="nav-item @if(Route::is('admin.SOR.index')) active @endif">
                <a class="nav-link" href="{{ route('admin.SOR.summaryRecords')}}">
                <i class="fa-solid fa-bookmark"></i>
                    <span>Summary of Records</span></a>
            </li>
            <!-- Nav Item - Charts -->
            <li class="nav-item @if(Route::is('admin.listDepartments.index')) active @endif">
                <a class="nav-link" href="{{ route('admin.listDepartments.index') }}">
                <i class="fas fa-th-list"></i>
                    <span>Collection Profile</span></a>
            </li>
            <li class="nav-item @if(Route::is('admin.department.index')) active @endif">
                <a class="nav-link" href="{{ route('admin.department.index') }}">
                <i class="fa-solid fa-house-flag"></i>
                    <span>Departments</span></a>
            </li>
            <li class="nav-item @if(Route::is('admin.program.index')) active @endif">
                <a class="nav-link" href="{{ route('admin.program.index') }}">
                <i class="fa-solid fa-chart-bar"></i>
                    <span>Programs</span></a>
            </li>
            <!-- Nav Item - Charts -->
            <li class="nav-item @if(Route::is('admin.courseGroup.index')) active @endif">
                <a class="nav-link" href="{{ route('admin.courseGroup.index') }}">
                <i class="fas fa-clipboard"></i> 
                    <span>Course Group</span></a>
            </li>

            <li class="nav-item @if(Route::is('admin.course.index')) active @endif">
                <a class="nav-link" href="{{ route('admin.course.index') }}">
                <i class="fas fa-graduation-cap"></i>
                    <span>Courses</span></a>
            </li>

            <!-- Nav Item - Tables -->
            </li>
        <!-- Nav Item - Books -->
            <li class="nav-item" >
                <a class="nav-link" href="" data-toggle="collapse" data-target="#bookRecords" aria-expanded="true" aria-controls="bookRecords">
                <i class="fa-solid fa-book"></i>
                    <span>Book record</span></a>
            
            <div id="bookRecords" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="dropdown-header text-bold">Books function</h6>
                        <a class="collapse-item" href="{{ route('admin-books.index') }}">All List of Books</a>
                        <div class="dropdown-divider"></div>
                        <h6 class="dropdown-header">Books Status</h6>
                        <!-- <a class="collapse-item" href="{{ route('admin-books.allStatus') }}">All Books Status</a> -->
                        <a class="collapse-item" href="{{ route('admin.approvedBooks') }}">Approved Books</a>
                        <a class="collapse-item" href="{{ route('admin.pendingBooks') }}">Pending Books</a>
                        <!-- <a class="collapse-item" href="{{ route('admin.rejectedBooks') }}">Rejected Books</a> -->
                
                    </div>
                </div>
            </li>

            <!-- Nav Item - Tables -->
            <li class="nav-item @if(Route::is('admin.users.index')) active @endif">
                <a class="nav-link" href="{{ route('admin.users.index') }}">
                <i class="fa-solid fa-user-gear"></i>
                    <span>User-Type</span></a>
            </li>
        </div>
                <!-- Admin End of Sidebar -->

        @elseif($role ===1)
                <!-- Program Chair Sidebar -->

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Program Chair - {{ $user_role->assigned_program }}</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Menu
            </div>

            <div class="links">
            <!-- Nav Item - Charts -->

            <li class="nav-item  @if(Route::is('program-chair.index')) active @endif">
                <a class="nav-link" href="{{ route('program-chair.index') }}">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Dashboard</span></a>
            </li>
            <li class="nav-item  @if(Route::is('program-chair.book-evaluation')) active @endif">
                <a class="nav-link" href="{{ route('program-chair.book-evaluation') }}">
                    <i class="fas fa-fw fa-book"></i>
                    <span>Book Evaluation</span></a>
            </li>
            <li class="nav-item @if(Route::is('pg.reports')) active @endif">
                <a class="nav-link" href="{{ route('pg.reports') }}">
                <i class="fas fa-th-list"></i>
                    <span>Reports</span></a>
            </li>
            <li class="nav-item @if(Route::is('pg.approvedBooks')) active @endif">
                <a class="nav-link" href="{{ route('pg.approvedBooks') }}">
                    <i class="fas fa-circle-check"></i>
                    <span>Approved Books</span></a>
            </li>
            <li class="nav-item @if(Route::is('pg.pendingBooks')) active @endif">
                <a class="nav-link" href="{{ route('pg.pendingBooks') }}">
                <i class="fas fa-regular fa-hourglass-half"></i>
                    <span>Pending Books</span></a>
            </li>

            <li class="nav-item @if(Route::is('pg.hideRequest')) active @endif">
                <a class="nav-link" href="{{ route('pg.hideRequest') }}">
                    <i class="fas fa-fw fa-eye-slash"></i>
                    <span>Hide Requests</span></a>
            </li>
            </div>
        <!-- Program Chair End of Sidebar -->

        @elseif($role ===2)

        <!-- Librarian Sidebar -->

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Librarian - {{ $user_role->assigned_department }}</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Menu
            </div>

            <div class="links">
            <!-- Nav Item - Charts -->
            <li class="nav-item @if(Route::is('librarian.dashboard')) active @endif">
                <a class="nav-link" href="{{ route('librarian.dashboard') }}">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Dashboard</span></a>
            </li>
            <!-- Nav Item - Charts -->
            <li class="nav-item @if(Route::is('librarian.book-evaluation')) active @endif">
                <a class="nav-link" href="{{ route('librarian.book-evaluation') }}">
                    <i class="fas fa-fw fa-book"></i>
                    <span>Book Evaluation</span></a>
            </li>
            <!-- Nav Item - Charts -->
            <li class="nav-item @if(Route::is('lib-Reports') || Route::is('lib-reports')) active @endif">
                <a class="nav-link" href="{{ route('lib-Reports') }}">
                    <i class="fas fa-th-list"></i>
                    <span>Reports</span></a>
            </li>
            @php
                $assignedDepartment = auth()->user()->assigned_department;
                $programs = App\Models\Program::where('department', $assignedDepartment)->get();
            @endphp
            <!-- Nav Item - Charts -->
            <li class="nav-item @if(Route::is('lib-books-list')) active @endif">
                <a class="nav-link" type="button" data-toggle="modal" data-target="#listProgramBookEvaluationModal">
                    <i class="fas fa-fw fa-list-check"></i>
                    <span>Book List & Note</span></a>
            </li>
            <!-- Nav Item - Charts -->
            <li class="nav-item @if(Route::is('librarian.approvedBooks')) active @endif">
                <a class="nav-link" type="button" data-toggle="modal" data-target="#listProgramApprovedBookModal">
                    <i class="fas fa-circle-check"></i>
                    <span>Approved Books</span></a>
            </li>

            <li class="nav-item @if(Route::is('lib.pendingBooks')) active @endif">
                <a class="nav-link" type="button" data-toggle="modal" data-target="#listProgramPendingBookModal">
                    <i class="fas fa-regular fa-hourglass-half"></i>
                    <span>Pending Books</span></a>
            </li>

        </div>
        @include('librarian.modal.listProgramsModal')
        <!-- Librarian End of Sidebar -->


        @elseif($role ===3)

                <!-- Faculty Sidebar -->
                
            <!-- Divider -->
            <hr class="sidebar-divider my-0">
            @if (Auth::check())
            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Faculty - {{ $user_role->assigned_program }}</span></a>
            </li>
            @endif

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Menu
            </div>

            <div class="links">
            <li class="nav-item @if(Route::is('faculty.dashboard')) active @endif">
                <a class="nav-link" href="{{ route('faculty.dashboard') }}">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Dashboard</span></a>
            </li>
            <!-- Nav Item - Charts -->
            <li class="nav-item @if(Route::is('faculty.bookEvaluation')) active @endif">
                <a class="nav-link" href="{{ route('faculty.bookEvaluation') }}">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Book Evaluation</span></a>
            </li>
            <!-- Nav Item - Charts -->
            <li class="nav-item @if(Route::is('fac.approvedBooks')) active @endif">
                <a class="nav-link" href="{{ route('fac.approvedBooks') }}">
                    <i class="fas fa-circle-check"></i>
                    <span>Approved</span></a>
            </li>
            <!-- Nav Item - Charts -->
            <li class="nav-item @if(Route::is('fac.pendingBooks')) active @endif">
                <a class="nav-link" href="{{ route('fac.pendingBooks') }}">
                <i class="fas fa-regular fa-hourglass-half"></i>
                    <span>Pending</span></a>
            </li>
            <li class="nav-item @if(Route::is('fac.archivedBooks')) active @endif">
                <a class="nav-link" href="{{ route('fac.archivedBooks') }}">
                <i class="fas fa-sm fa-regular fa-eye-slash"></i>
                    <span>Archived Books</span></a>
            </li>
            </div>



        <!--Faculty End of Sidebar -->

        @endif

        <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">
            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
            </ul>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand bg-gradient-light topbar mb-4 static-top shadow">
                    
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    


                    @if ($role === 0) 
                    <h2 class="fw-bolder text-dark mt-1">
                        <em>
                        Administrator
                        </em>
                    </h2>
                    @elseif($role === 1 || $role === 3)
                    @php
                    $assignedProgram = auth()->user()->assignedProgram;
                    if ($assignedProgram ) {
                        $department = $assignedProgram->department;
                        $programs = App\Models\Department::where('department_name', $department)->first();
                        $logo = $programs->logo;
                    }
                    @endphp
                    <img class="p-0 mr-3 ms-0" src="{{ asset('storage/' .$logo) }}" alt="Department Logo" width="70">
                     <h6 class="fw-bolder text-dark mt-1" id="program_name">
                        <em>
                        {{ Auth::user()->assignedProgram->description }}
                        <!-- <i class="fa-solid fa-house-flag ms-1"></i> -->
                        </em>
                    </h6>
                    @elseif($role === 2)
                    @php
                    $logo = Auth::user()->assignedDepartment->logo;
                    @endphp
                    <img class="p-0 mr-3 ms-0" src="{{ asset('storage/' .$logo) }}" alt="Department Logo" width="70">
                    <h6 class="fw-bolder text-dark mt-1" id="program_name">
                        <em>
                        {{ Auth::user()->assignedDepartment->description }}
                        <i class="fa-solid fa-house-flag ms-1"></i>
                        </em>
                    </h6>
                    @endif
                    <ul class="navbar-nav ml-auto">

                    @if ($role !== 0) 




                            <!-- Nav Item - Alerts -->
                            <li class="nav-item dropdown no-arrow mx-1">
                                <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-bell fa-fw"></i>
                                    <!-- Counter - Alerts -->
                                    @if(Auth::user()->unreadNotifications->count())
                                    <span class="badge badge-danger badge-counter">{{ Auth::user()->unreadNotifications->count() }}</span>
                                    @endif
                                </a>
                                    
                                <!-- Dropdown - Alerts -->
                                <div class="dropdown-list dropdown-menu dropdown-menu-right"
                                    aria-labelledby="alertsDropdown" style="max-height: 400px; overflow-y: auto;">
                                    <h6 class="dropdown-header">
                                        Alerts Center
                                    </h6>
                                    @if (Auth::check())
                                        @foreach (Auth::user()->unreadNotifications as $notification)

     
                                            <a class="dropdown-item d-flex align-items-center bg-gradient-light" id="notif_hover" href="{{ $notification->data['action_url'] }}">
                                                <div class="mr-3">
                                                    <div class="{{ $notification->data['color_icon'] }}">
                                                        <i class="{{ $notification->data['icon'] }}"></i>
                                                    </div>
                                                </div>

                                                <div>
                                                    <div class="small text-gray-500">{{ $notification->created_at }}</div>
                                                    <div class="font-weight-bold">{{ $notification->data['message'] }}</div>
                                                </div>
                                            </a>
                                        @endforeach
                                        @foreach (Auth::user()->readNotifications as $notification)
                                            <a class="dropdown-item d-flex align-items-center" href="{{ $notification->data['action_url'] }}">
                                                <div class="mr-3">
                                                    <div class="{{ $notification->data['color_icon'] }}">
                                                        <i class="{{ $notification->data['icon'] }}"></i>
                                                    </div>
                                                </div>

                                                <div>
                                                    <div class="small text-gray-500">{{ $notification->created_at }}</div>
                                                    <div class="font-weight-bold">{{ $notification->data['message'] }}</div>
                                                </div>
                                            </a>
                                        @endforeach
                                    @endif
                                    <a class="dropdown-item text-center small text-gray-500" href="{{ route('markAllAsRead') }}">Mark all as read</a>
                                </div>
                            </li>
                            @endif

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link text-secondary dropdown-toggle " id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img class="rounded-circle mr-2" src="{{ $profilePictureUrl }}"  width="35">
                                <div>
                                    <i class="fas fa-user fa-sm fa-fw"></i>
                                    <span class="d-none d-lg-inline small">
                                    @if ($user_role->role === 0)
                                        Admin
                                    @elseif ($user_role->role === 2)
                                        Librarian
                                    @elseif ($user_role->role === 1)
                                        Program chair
                                    @elseif ($user_role->role === 3)
                                        Faculty
                                    @else
                                        Unknown role
                                    @endif
                                     <h6 class="fw-bold text-uppercase">{{ Auth::user()->last_name }}, {{ Auth::user()->first_name }}</h6>
                                    </span>
                                </div>
                                     
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <!-- <button class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </button>
                                <button class="dropdown-item" href="">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </button> -->
                                @if ($user_role->role === 0)
                                    <p class="ms-3 mb-0">Setting</p>
                                    @elseif ($user_role->role === 1)
                                    <a class="dropdown-item" 
                                        href="{{ route('pgActivityLogs') }}">
                                        <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Activity
                                        </a>
                                    @elseif ($user_role->role === 2)
                                    <a class="dropdown-item" 
                                        href="{{ route('activityLogs') }}">
                                        <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Activity    
                                        </a>

                                        @elseif ($user_role->role === 3)
                                    <a class="dropdown-item" 
                                        href="{{ route('activityLogs') }}">
                                        <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Activity
                                    </a>
                                    @endif 

                                <div class="dropdown-divider"></div>
                                <button class="dropdown-item" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </button>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">           