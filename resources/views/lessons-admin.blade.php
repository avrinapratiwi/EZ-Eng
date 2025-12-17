<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>admin-lessons</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

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
                    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
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
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ ($user->first_name ?? '') . ' ' . ($user->last_name ?? '') }}</span>
                                <img class="img-profile rounded-circle" src="{{ asset('img/undraw_profile.svg') }}">
                            </a>
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
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Lessons</h1>
                    </div>

                    <!-- Card menampilkan modul yang dipilih -->
                    <div class="row">
                        <div class="col-12 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <!-- Module Title -->
                                            <div class="h5 font-weight-bold text-primary text-uppercase mb-1">
                                                {{ $module->title }}
                                            </div>
                                            <!-- Module Description -->
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                {{ $module->description }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex justify-content-between align-items-center">
                            <h6 class="m-0 font-weight-bold text-primary">Lessons Data</h6>
                            <a href="#" class="btn btn-success btn-icon-split mb-3" data-toggle="modal" data-target="#addLessonModal">
                                <span class="icon text-white-50">
                                    <i class="fas fa-plus"></i>
                                </span>
                                <span class="text">Add Lessons</span>
                            </a>                        
                        </div>
                        <div class="card-body"> 
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Title</th>
                                            <th>Konten</th>
                                            <th>Order</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                        
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Title</th>
                                            <th>Konten</th>
                                            <th>Order</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                        
                                    <tbody>
                                        @foreach ($lessons as $index => $lesson)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $lesson->title }}</td>
                                            <td>{{ \Illuminate\Support\Str::limit(strip_tags($lesson->konten_html), 50) }}</td>
                                            <td>{{ $lesson->order }}</td>
                        
                                            <td class="text-center">
                        
                                                <!-- EDIT BUTTON -->
                                                <a href="#" 
                                                   class="btn btn-warning btn-icon-split btn-sm"
                                                   data-toggle="modal"
                                                   data-target="#editLessonModal{{ $lesson->id }}">
                                                    <span class="icon text-white-50">
                                                        <i class="fas fa-edit"></i>
                                                    </span>
                                                    <span class="text">Edit</span>
                                                </a>
                        
                                                <!-- DELETE BUTTON -->
                                                <a href="#" 
                                                   class="btn btn-danger btn-icon-split btn-sm"
                                                   data-toggle="modal"
                                                   data-target="#deleteLessonModal{{ $lesson->id }}">
                                                    <span class="icon text-white-50">
                                                        <i class="fas fa-trash"></i>
                                                    </span>
                                                    <span class="text">Delete</span>
                                                </a>
                        
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                        
                                </table>
                            </div>
                        </div>
                        
                        
                    </div>
                </div>
                <!-- /.container-fluid -->

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

    <div class="modal fade" id="addLessonModal" tabindex="-1" role="dialog" aria-labelledby="addLessonModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="addLessonModalLabel">Add Lesson</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                
                <form action="{{ route('lessons.store', $module->id) }}" method="POST">
                    @csrf
                    <input type="hidden" name="module_id" value="{{ $module->id }}">
                    
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Lesson Title</label>
                            <input type="text" name="title" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>Konten HTML</label>
                            <textarea name="konten_html" class="form-control" id="konten_html" rows="10"></textarea> 
                        </div>

                        <div class="form-group">
                            <label>Order</label>
                            <input type="number" name="order" class="form-control" value="1" required>
                        </div>
                    </div>
                    
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <button class="btn btn-success" type="submit">Add Lesson</button>
                    </div>
                </form>
            
            </div>
        </div>
    </div>
    
    @foreach ($lessons as $lesson)
    <div class="modal fade" id="editLessonModal{{ $lesson->id }}" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
    
                <div class="modal-header bg-warning text-white">
                    <h5 class="modal-title">Edit Lesson</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
    
                <form action="{{ route('lessons.update', [$module->id, $lesson->id]) }}" method="POST">
                    @csrf
                    <div class="modal-body">
    
                        <div class="form-group">
                            <label>Lesson Title</label>
                            <input type="text" name="title" class="form-control" value="{{ $lesson->title }}" required>
                        </div>
    
                        <div class="form-group">
                            <label>Konten HTML</label>
                            <textarea name="konten_html" class="form-control kontenEditor" id="konten{{ $lesson->id }}" rows="10">
                                {{ $lesson->konten_html }}
                            </textarea>
                        </div>
    
                        <div class="form-group">
                            <label>Order</label>
                            <input type="number" name="order" class="form-control" value="{{ $lesson->order }}" required>
                        </div>
    
                    </div>
    
                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button class="btn btn-warning" type="submit">Update</button>
                    </div>
                </form>
    
            </div>
        </div>
    </div>
    @endforeach  
    
    @foreach ($lessons as $lesson)
    <div class="modal fade" id="deleteLessonModal{{ $lesson->id }}" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
    
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title">Delete Lesson</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
    
                <div class="modal-body">
                    Are you sure you want to delete <b>{{ $lesson->title }}</b>?
                </div>
    
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-dismiss="modal">Cancel</button>
    
                    <form action="{{ route('lessons.delete', [$module->id, $lesson->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" type="submit">Delete</button>
                    </form>
    
                </div>
    
            </div>
        </div>
    </div>
    @endforeach
    
    

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

    <!-- Page level plugins -->
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('js/demo/datatables-demo.js') }}"></script>

    <script src="https://cdn.ckeditor.com/ckeditor5/38.1.1/classic/ckeditor.js"></script>

    <script>
        let lessonEditor;
    
        $('#addLessonModal').on('shown.bs.modal', function () {
            if (!lessonEditor) {
                ClassicEditor
                    .create(document.querySelector('#konten_html'))
                    .then(editor => lessonEditor = editor)
                    .catch(console.error);
            }
        });
    
        $('#addLessonModal form').on('submit', function(e) {
            if (lessonEditor) {
                lessonEditor.updateSourceElement();
            }
        });
    </script>
    
    
    <script>
        let editors = {};

        $('.kontenEditor').each(function () {
            const id = $(this).attr('id');
            ClassicEditor
                .create(document.querySelector('#' + id))
                .then(editor => editors[id] = editor)
                .catch(console.error);
        });
    </script>
    
    

</body>

</html>
