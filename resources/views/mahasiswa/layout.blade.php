<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>OSS | Fakultas Teknik</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ url('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- JQuery UI -->
    <link rel="stylesheet" href="{{ url('plugins/jquery/jquery-ui.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ url('css/adminlte.min.css') }}">
    <!-- Custom CSS -->
    @yield('addcss')
</head>

<body class="hold-transition sidebar-mini sidebar-collapse" @if (session()->has('success')) onload="loadMessage()" @endif>
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>

            <!-- Right navbar links -->
            {{-- <ul class="navbar-nav ml-auto">
                <!-- Notifications Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-bell"></i>
                        <span class="badge badge-warning navbar-badge">15</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <span class="dropdown-item dropdown-header">15 Notifications</span>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-envelope mr-2"></i> 4 new messages
                            <span class="float-right text-muted text-sm">3 mins</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-users mr-2"></i> 8 friend requests
                            <span class="float-right text-muted text-sm">12 hours</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-file mr-2"></i> 3 new reports
                            <span class="float-right text-muted text-sm">2 days</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                    </div>
                </li>
            </ul> --}}
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="index3.html" class="brand-link">
                <img src="{{ url('img/UNHASY.png') }}" alt="OSSFT" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">OSSFT</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="{{ url('uploads') . '/' . Auth::guard('mahasiswa')->user()->foto }}" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">{{ Auth::guard('mahasiswa')->user()->nama }}</a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-item">
                            <a href="{{ url('mahasiswa/home') }}" class="nav-link {{ $menu === 'beranda' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-laptop-house"></i>
                                <p>
                                    Beranda
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-file-word"></i>
                                <p>
                                    Surat
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Keterangan Mahasiswa</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Dispensasi</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Izin Observasi</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Izin Pengambilan Data</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-industry"></i>
                                <p>
                                    Magang
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link {{ strstr($menu, '.', true) === 'skripsi' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-graduation-cap"></i>
                                <p>
                                    Pendaftaran Skripsi
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('judul.index') }}" class="nav-link {{ $menu === 'skripsi.judul' ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Judul</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('seminar.index') }}" class="nav-link  {{ $menu === 'skripsi.seminar' ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Seminar Porposal</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('semhas.index') }}" class="nav-link  {{ $menu === 'skripsi.semhas' ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Seminar Hasil</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-project-diagram"></i>
                                <p>
                                    Lain-lain
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Pendaftaran Yudisium</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="pages/UI/icons.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Stor Berkas</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-header">User Menu</li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-unlock-alt"></i>
                                <p>
                                    Password
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('mahasiswa.logout') }}" class="nav-link">
                                <i class="nav-icon fas fa-sign-out-alt"></i>
                                <p>
                                    Logout
                                </p>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">{{ $title }}</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                @foreach ($breadcumbs as $breadcumb)
                                    @if ($breadcumb['link'] == '')
                                        <li class="breadcrumb-item active">{{ $breadcumb['judul'] }}</li>
                                    @else
                                        <li class="breadcrumb-item"><a href="{{ $breadcumb['link'] }}">{{ $breadcumb['judul'] }}</a></li>
                                    @endif
                                @endforeach
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        @yield('main')
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <strong>Copyright &copy; {{ date('Y') }} <a href="#">Fakultas Teknik</a>.</strong>
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 2.0.3
            </div>
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="{{ url('plugins/jquery/jquery.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ url('plugins/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ url('js/adminlte.min.js') }}"></script>
    <!-- Sweet Alert -->
    <script src="{{ url('plugins/sweetalert2/sweetalert2.js') }}"></script>

    <script>
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        @if (session()->has('success'))
            function loadMessage() {
                Swal.fire({
                    icon: 'success',
                    title: '{{ session('success') }}',
                    showConfirmButton: false,
                    timer: 1000
                })
            };
        @endif
        $('.button-delete').on('click', function(e) {
            const form = $(this).closest("form");
            const message = $(this).data("message");
            e.preventDefault();
            Swal.fire({
                title: 'Yakin ?',
                text: "Apakah Anda Yakin Menghapus " + message + "? Karena Data Setelah Terhapus Tidak Dapat Di Kembalikan !",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            })
        });
    </script>
    @yield('addjs')
</body>

</html>
