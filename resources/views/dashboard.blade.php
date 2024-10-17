<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('javascript/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- daterange picker -->
    <link rel="stylesheet" href="{{ asset('javascript/plugins/daterangepicker/daterangepicker.css') }}">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="{{ asset('javascript/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Bootstrap Color Picker -->
    <link rel="stylesheet"
        href="{{ asset('javascript/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css') }}">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
        href="{{ asset('javascript/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('javascript/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('javascript/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <!-- Bootstrap4 Duallistbox -->
    <link rel="stylesheet"
        href="{{ asset('javascript/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css') }}">
    <!-- BS Stepper -->
    <link rel="stylesheet" href="{{ asset('javascript/plugins/bs-stepper/css/bs-stepper.min.css') }}">
    <!-- dropzonejs -->
    <link rel="stylesheet" href="{{ asset('javascript/plugins/dropzone/min/dropzone.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('javascript/plugins/dist/css/adminlte.min.css') }}">
    {{-- estilos --}}
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">

    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('javascript/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('javascript/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('javascript/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

    {{-- SweetAlert2 --}}

    <link rel="stylesheet" href="{{ asset('javascript/plugins/sweetalert2/sweetalert2.min.css') }}">

</head>

<body class="hold-transition sidebar-mini">

    <div class="wrapper">



        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="index3.html" class="nav-link">prueba</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link">prueba</a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Navbar Search -->
                <li class="nav-item">
                    <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                        <i class="fas fa-search"></i>
                    </a>
                    <div class="navbar-search-block">
                        <form class="form-inline">
                            <div class="input-group input-group-sm">
                                <input class="form-control form-control-navbar" type="search" placeholder="Buscar"
                                    aria-label="Search">
                                <div class="input-group-append">
                                    <button class="btn btn-navbar">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true" href="#"
                        role="button">
                        <i class="fas fa-th-large"></i>
                    </a>
                </li>
            </ul>
        </nav>

        <aside class="aside main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="https://www.mypantalla.com/" class="brand-link" target="blank">
                <img src="{{ asset('assets/small_logo.png') }}" alt="Mypantalla"
                    class="brand-image img-circle elevation-3 shadow">
                <span class="brand-text font-weight-light">MyPantalla</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="{{ asset('assets/user.png') }}" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">{{ $array['nombre'] }}</a>
                    </div>
                </div>

                <!-- SidebarSearch Form -->
                <div class="form-inline">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                            aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <h1 class="nav-header">MENÚ</h1>
                        <li class="nav-item">
                            <a class="nav-link">
                                <i class="fa-regular fa-newspaper"></i>&nbsp;&nbsp;
                                <p>
                                    Noticias
                                    {{-- <span class="right badge badge-danger">New</span> --}}
                                </p>
                            </a>
                        </li>


                        <li class="nav-item">
                            <a class="nav-link" onclick="showManageLabor('{{ route('showManageLabor') }}')"
                                type="button">
                                <i class="fa-solid fa-clipboard"></i>&nbsp;&nbsp;
                                <p>
                                    Manejo de labores
                                    {{-- <span class="right badge badge-danger">New</span> --}}
                                </p>
                            </a>
                        </li>


                        <li class="nav-item">
                            <a class="nav-link" onclick="register_user('{{ route('registroUser') }}')"
                                type="button" id="register_nav">
                                <i class="fa-solid fa-user-plus"></i>&nbsp;&nbsp;
                                <p>
                                    Registrar Usuarios
                                </p>
                            </a>
                        </li>


                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fa-solid fa-person-shelter"></i>&nbsp;&nbsp;
                                <p>
                                    Reporte ingresos
                                </p>
                            </a>
                        </li>


                        <li class="nav-item">
                            <a href="#" class="nav-link" type="button"
                                onclick="getShowAssists('{{ route('getShowAssist') }}')">
                                <i class="fa-brands fa-creative-commons-nd"></i>&nbsp;&nbsp;
                                <p>
                                    Asistencias
                                </p>
                            </a>
                        </li>


                        <li class="nav-item">
                            <a class="nav-link" type="button"
                                onclick="getShowLabors('{{ route('showMyLabors') }}')">
                                <i class="fa-solid fa-user-clock"></i>&nbsp;&nbsp;
                                <p>
                                    Mis labores
                                </p>
                            </a>
                        </li>


                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fa-solid fa-clock"></i>&nbsp;&nbsp;
                                <p>
                                    Reporte horas extras
                                </p>
                            </a>
                        </li>


                        <li class="nav-item">
                            <a type="button" class="nav-link"
                                onclick="getViewHistoryLabors('{{ route('getShowHistorySubLabors') }}')">
                                <i class="fa-solid fa-list"></i>&nbsp;&nbsp;
                                <p>
                                    Historial de labores
                                </p>
                            </a>
                        </li>


                    </ul>
                </nav>
            </div>

        </aside>





        <!-- Modal de confirmación-->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg bg-danger">
                        <h5 class="modal-title" id="exampleModalLabel"><i
                                class="fa-solid fa-triangle-exclamation"></i>&nbsp;&nbsp;¡Seguro de realizar esta
                            acción!</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="bridge" data-state="">


                        <h4 id="security"></h4>

                        <p>Una vez realizada esta acción no podrá deshacerla!</p>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i
                                class="fa-solid fa-ban"></i>&nbsp;&nbsp;Cancelar</button>
                        <button type="button" class="btn btn-primary"
                            onclick="sendModalAccept('{{ route('captureHour') }}')"><i
                                class="fa-solid fa-circle-check"></i>&nbsp;&nbsp;Confirmar</button>
                    </div>
                </div>
            </div>
        </div>


        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper" style="min-height: 805px;">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Dashboard {{ $array['rol'] }}</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Dashboard v1</li>
                            </ol>
                        </div>
                    </div>
                    <div id="container_menu"></div> <!-- DONDE SE CARGA CADA PESTAÑA -->

                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="{{ asset('javascript/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('javascript/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- Select2 -->
    <script src="{{ asset('javascript/plugins/select2/js/select2.full.min.js') }}"></script>
    <!-- Bootstrap4 Duallistbox -->
    <script src="{{ asset('javascript/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js') }}"></script>
    <!-- InputMask -->
    <script src="{{ asset('javascript/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('javascript/plugins/inputmask/jquery.inputmask.min.js') }}"></script>
    <!-- date-range-picker -->
    <script src="{{ asset('javascript/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <!-- bootstrap color picker -->
    <script src="{{ asset('javascript/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('javascript/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <!-- BS-Stepper -->
    <script src="{{ asset('javascript/plugins/bs-stepper/js/bs-stepper.min.js') }}"></script>
    <!-- dropzonejs -->
    <script src="{{ asset('javascript/plugins/dropzone/min/dropzone.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('javascript/plugins/dist/js/adminlte.min.js') }}"></script>
    <!-- SweetAlert2 -->
    <script src="{{ asset('javascript/plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>
    <!-- date-range-picker -->
    <script src="{{asset('javascript/plugins/daterangepicker/daterangepicker.js')}}"></script>

    {{-- DATATABLES --}}
    <script src="{{ asset('javascript/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('javascript/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('javascript/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('javascript/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('javascript/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('javascript/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('javascript/plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('javascript/plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('javascript/plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('javascript/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('javascript/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('javascript/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

    <!-- Page specific script -->
    <script src="{{ asset('javascript/dashboard.js') }}"></script>

</body>

</html>
