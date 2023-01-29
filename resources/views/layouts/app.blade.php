<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Telkom Participant</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset('dist/img/TELKOM/favicon.ico') }}" type="image/x-icon">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
</head>
<?php

if (!empty(Auth::guard('user_regionals')->user()->username)) {
    $username = Auth::guard('user_regionals')->user()->username;
    $email = Auth::guard('user_regionals')->user()->email;
}

if (!empty(Auth::guard('user_pos')->user()->nama)) {
    $username = Auth::guard('user_pos')->user()->nama;
    $email = Auth::guard('user_pos')->user()->email;
}

if (!empty(Auth::guard('user_pic')->user()->name)) {
    $username = Auth::guard('user_pic')->user()->name;
    $email = Auth::guard('user_pic')->user()->email;
}

?>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{ url('/') }}" class="nav-link">Home</a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">

                <!-- Notifications Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-user"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <div class="dropdown-divider"></div>
                        <?php if (!empty(Auth::guard('user_regionals')->user()->username)) { ?>
                            <a href="{{ route('user-regional.show', Auth::guard('user_regionals')->user()->id) }}" class="dropdown-item">
                                <i class="fas fa-user mr-2"></i> {{ ucfirst($username) }}
                            </a>
                        <?php } ?>
                        <?php if (!empty(Auth::guard('user_pic')->user()->name)) { ?>
                            <a href="{{ route('user-pic.show', Auth::guard('user_pic')->user()->id) }}" class="dropdown-item">
                                <i class="fas fa-user mr-2"></i> {{ ucfirst($username) }}
                            </a>
                        <?php } ?>
                        <?php if (!empty(Auth::guard('user_pos')->user()->nama)) { ?>
                            <a href="{{ route('user-pos.show', Auth::guard('user_pos')->user()->id) }}" class="dropdown-item">
                                <i class="fas fa-user mr-2"></i> {{ ucfirst($username) }}
                            </a>
                        <?php } ?>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-envelope mr-2"></i> {{ $email }}
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item dropdown-footer" href="" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('signout') }}" method="GET" style="display: none;">
                            @method('GET')
                            @csrf
                        </form>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="" class="brand-link">
                <img src="{{ asset('dist/img/TELKOM/hand.png') }}" alt="AdminLTE Logo" class="brand-image" style="opacity: .8">
                <span class="brand-text font-weight-light">My IndiHome POS</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="{{ asset('dist/img/avatar5.png') }}" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">{{ ucfirst($username) }}</a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                        <li class="nav-item">
                            <a href="{{ route('dashboard') }}" class="nav-link @yield('menu-dashboard')">
                                <i class="nav-icon fas fa-home"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>

                        <li class="nav-header">Master</li>

                        <?php if (!empty(Auth::guard('user_regionals')->user()->username)) { ?>
                            <li class="nav-item">
                                <a href="{{ route('user-regional.index') }}" class="nav-link @yield('menu-user-regional')">
                                    <i class="nav-icon fas fa-user-cog"></i>
                                    <p>
                                        Users Regional
                                    </p>
                                </a>
                            </li>
                        <?php } ?>
                        <?php if (!empty(Auth::guard('user_pic')->user()->name) || !empty(Auth::guard('user_regionals')->user()->username)) { ?>
                            <li class="nav-item">
                                <a href="{{ route('user-pic.index') }}" class="nav-link @yield('menu-user-pic')">
                                    <i class="nav-icon fas fa-user-cog"></i>
                                    <p>
                                        Users PIC
                                    </p>
                                </a>
                            </li>
                        <?php } ?>
                        <?php if (!empty(Auth::guard('user_pos')->user()->nama) || !empty(Auth::guard('user_pic')->user()->name) || !empty(Auth::guard('user_regionals')->user()->username)) { ?>
                            <li class="nav-item">
                                <a href="{{ route('user-pos.index') }}" class="nav-link @yield('menu-user-pos')">
                                    <i class="nav-icon fas fa-user-cog"></i>
                                    <p>
                                        AGENT POS
                                    </p>
                                </a>
                            </li>
                        <?php } ?>

                        <li class="nav-header">Transaction</li>

                        <li class="nav-item">
                            <a href="{{ route('pos.index') }}" class="nav-link @yield('menu-pos')">
                                <i class="nav-icon fas fa-database"></i>
                                <p>
                                   SALES POS
                                </p>
                            </a>
                        </li>

                        {{-- <li class="nav-header">Master</li>
                        @can('role-list')
                        <li class="nav-item">
                            <a href="{{ route('roles.index') }}" class="nav-link @yield('menu-role')">
                        <i class="nav-icon fas fa-shield-alt"></i>
                        <p>
                            Role Management
                        </p>
                        </a>
                        </li>
                        @endcan
                        @can('user-list')
                        <li class="nav-item">
                            <a href="{{ route('users.index') }}" class="nav-link @yield('menu-user')">
                                <i class="nav-icon fas fa-user-cog"></i>
                                <p>
                                    Users Management
                                </p>
                            </a>
                        </li>
                        @endcan
                        @can('user-list')
                        <li class="nav-item">
                            <a href="{{ route('user-regional.index') }}" class="nav-link @yield('menu-user-regional')">
                                <i class="nav-icon fas fa-user-cog"></i>
                                <p>
                                    Users Regional
                                </p>
                            </a>
                        </li>
                        @endcan
                        @can('user-list')
                        <li class="nav-item">
                            <a href="{{ route('user-pic.index') }}" class="nav-link @yield('menu-user-pic')">
                                <i class="nav-icon fas fa-user-cog"></i>
                                <p>
                                    Users PIC
                                </p>
                            </a>
                        </li>
                        @endcan
                        @can('user-list')
                        <li class="nav-item">
                            <a href="{{ route('user-pos.index') }}" class="nav-link @yield('menu-user-pos')">
                                <i class="nav-icon fas fa-user-cog"></i>
                                <p>
                                    AGENT POS
                                </p>
                            </a>
                        </li>
                        @endcan --}}
                        {{-- @can('product-list')
                        <li class="nav-item">
                            <a href="{{ route('products.index') }}" class="nav-link @yield('menu-product')">
                        <i class="nav-icon fa fa-cube"></i>
                        <p>
                            Product
                        </p>
                        </a>
                        </li>
                        @endcan --}}

                        {{-- <li class="nav-header">Sales</li>
                        @can('pos-list')
                        <li class="nav-item">
                            <a href="{{ route('pos.index') }}" class="nav-link @yield('menu-pos')">
                        <i class="nav-icon fa fa-cube"></i>
                        <p>
                            SALES POS
                        </p>
                        </a>
                        </li>
                        @endcan --}}
                        {{-- @can('transaction-list')
                        <li class="nav-item">
                            <a href="{{ route('transaction.index') }}" class="nav-link @yield('menu-transaction')">
                        <i class="nav-icon fas fa-suitcase"></i>
                        <p>
                            Transaction
                        </p>
                        </a>
                        </li>
                        @endcan --}}
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>@yield('page-name')</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                @yield('breadcrumb')
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        @yield('content')
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <div class="float-right d-none d-sm-block">
                <b>Version</b> 3.2.0
            </div>
            <strong>Copyright &copy; {{ date('Y') }} <a href="https://www.telkom.co.id" target="_blank">Telkom</a>.</strong> All rights
            reserved.
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- DataTables  & Plugins -->
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    {{-- <script src="{{ asset('dist/js/demo.js') }}"></script> --}}
    <!-- Page specific script -->
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });

        function tonumeric(param, type = 'dot') {
            if (type == 'dot') {
                number = parseFloat(param.split('.').join(""));
            } else if (type == 'rp') {
                param = param.replace("Rp. ", '')
                number = parseFloat(param.split('.').join(""));
            }
            return number;
        }


        function rupiah(param) {
            if (param == 0 || param == null || param == '') {
                return 'Rp. 0';
            }

            return 'Rp. ' + parseInt(param).toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.")
        }
    </script>
    @stack('js')
</body>

</html>