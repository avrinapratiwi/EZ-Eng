<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>admin-dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon">
                    <img src="{{ asset('img/logo_ez-eng.png') }}" 
                         alt="Logo" 
                         style="width: 100px; height: 100px; object-fit: contain;">
                </div>
                <div class="sidebar-brand-text mx-3">ADMIN PAGE</div>
            </a>            

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item {{ request()->routeIs('dashboard-admin') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('dashboard-admin') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item {{ request()->routeIs('mentors-admin','learners-admin') ? 'active' : '' }}">
                <a class="nav-link {{ request()->routeIs('mentors-admin','learners-admin') ? '' : 'collapsed' }}"
                   href="#" data-toggle="collapse" data-target="#collapseUsers"
                   aria-expanded="{{ request()->routeIs('mentors-admin','learners-admin') ? 'true' : 'false' }}"
                   aria-controls="collapseUsers">
                   <i class="fas fa-fw fa-users"></i><span>Users</span>
                </a>
            
                <div id="collapseUsers" class="{{ request()->routeIs('mentors-admin','learners-admin') ? 'collapse show' : 'collapse' }}" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Users Management:</h6>
                        <a class="collapse-item {{ request()->routeIs('mentors-admin') ? 'active' : '' }}" href="{{ route('mentors-admin') }}">Mentors</a>
                        <a class="collapse-item {{ request()->routeIs('learners-admin') ? 'active' : '' }}" href="{{ route('learners-admin') }}">Learners</a>
                    </div>
                </div>
            </li>
            <li class="nav-item {{ request()->routeIs('modules-admin','quizzes-admin') ? 'active' : '' }}">
                <a class="nav-link {{ request()->routeIs('modules-admin','quizzes-admin') ? '' : 'collapsed' }}"
                   href="#"
                   data-toggle="collapse"
                   data-target="#collapseCourse"
                   aria-expanded="{{ request()->routeIs('modules-admin','quizzes-admin') ? 'true' : 'false' }}"
                   aria-controls="collapseCourse">
                   <i class="fas fa-fw fa-book"></i>
                   <span>Course</span>
                </a>
            
                <div id="collapseCourse"
                     class="{{ request()->routeIs('modules-admin','quizzes-admin') ? 'collapse show' : 'collapse' }}"
                     data-parent="#accordionSidebar">
                     
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Course Management:</h6>
            
                        <!-- Modules -->
                        <a class="collapse-item {{ request()->routeIs('modules-admin') ? 'active' : '' }}"
                           href="{{ route('modules-admin') }}">
                           Modules
                        </a>
            
                        <!-- Quizzes -->
                        <a class="collapse-item {{ request()->routeIs('quizzes-admin') ? 'active' : '' }}"
                           href="{{ route('quizzes-admin') }}">
                           Quizzes
                        </a>
            
                    </div>
                </div>
            </li>

            <li class="nav-item {{ request()->routeIs('schedule-admin') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('schedule-admin') }}">
                    <i class="fas fa-fw fa-calendar"></i>
                    <span>Schedule</span>
                </a>
            </li>
            
                    

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                                aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                        </li>
             
                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ ($user->first_name ?? '') . ' ' . ($user->last_name ?? '') }}</span>
                                <img class="img-profile rounded-circle"
                                    src="{{ $user->photo
                                            ? asset('storage/'.$user->photo)
                                            : asset('img/undraw_profile.svg') }}">

                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex align-items-center">
                        <h6 class="m-0 font-weight-bold text-primary">My Profile</h6>
                    </div>
                
                    <form method="POST"
                          action="{{ route('update-profile-admin') }}"
                          enctype="multipart/form-data">
                        @csrf
                
                        <div class="card-body">
                            <div class="row">
                
                                <!-- FOTO -->
                                <div class="col-md-3 text-center">
                                    <img
                                        src="{{ $user->photo ? asset('storage/'.$user->photo) : asset('img/undraw_profile.svg') }}"
                                        class="img-profile rounded-circle mb-3"
                                        style="width: 150px; height: 150px; object-fit: cover;"
                                    >
                
                                    <div class="form-group">
                                        <input type="file" name="photo" class="form-control-file">
                                    </div>
                
                                    @if($user->photo)
                                        <div class="form-check">
                                            <input type="checkbox" name="delete_photo" value="1" class="form-check-input">
                                            <label class="form-check-label">Remove photo</label>
                                        </div>
                                    @endif
                                </div>
                
                                <!-- DATA -->
                                <div class="col-md-9">
                                    <div class="row">
                
                                        <div class="col-md-6 form-group">
                                            <label>First Name</label>
                                            <input type="text" name="first_name" class="form-control"
                                                   value="{{ $user->first_name }}" required>
                                        </div>
                
                                        <div class="col-md-6 form-group">
                                            <label>Last Name</label>
                                            <input type="text" name="last_name" class="form-control"
                                                   value="{{ $user->last_name }}" required>
                                        </div>
                
                                        <div class="col-md-6 form-group">
                                            <label>Username</label>
                                            <input type="text" name="username" class="form-control"
                                                   value="{{ $user->username }}" required>
                                        </div>
                
                                        <div class="col-md-6 form-group">
                                            <label>Email</label>
                                            <input type="email" name="email" class="form-control"
                                                   value="{{ $user->email }}" required>
                                        </div>
                
                                        <div class="col-md-6 form-group">
                                            <label>Phone Number</label>
                                            <input type="text" name="phone_number" class="form-control"
                                                   value="{{ $user->phone_number }}" required>
                                        </div>
                
                                        <div class="col-md-6 form-group">
                                            <label>Gender</label>
                                            <select name="gender" class="form-control" required>
                                                <option value="male" {{ $user->gender == 'male' ? 'selected' : '' }}>Male</option>
                                                <option value="female" {{ $user->gender == 'female' ? 'selected' : '' }}>Female</option>
                                            </select>
                                        </div>
                
                                        <div class="col-md-12 form-group">
                                            <label>Address</label>
                                            <input type="text" name="address" class="form-control"
                                                   value="{{ $user->address }}" required>
                                        </div>
                
                                        <div class="col-md-12 form-group">
                                            <label>Bio</label>
                                            <textarea name="bio" class="form-control" rows="3">{{ $user->bio }}</textarea>
                                        </div>
                
                                    </div>
                                </div>
                
                            </div>
                        </div>
                
                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Save Changes
                            </button>
                        </div>
                    </form>
                </div>
                
                        

                </div>
                
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>232302 AVRINA PRATIWI</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="{{ route('logout') }}">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

</body>

</html>