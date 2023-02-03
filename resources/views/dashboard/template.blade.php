<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Sistem Layanan Satu Pintu Fakultas Teknik</title>

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

<body class="hold-transition layout-top-nav" @if (session()->has('success')) onload="loadMessage()" @endif>
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
            <div class="container">
                <a href="#" class="navbar-brand">
                    <img src="{{ url('img/UNHASY.png') }}" alt="Guguk" class="brand-image img-circle elevation-3" style="opacity: .8">
                    <span class="brand-text font-weight-light">OSSFT</span>
                </a>

                <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse order-3" id="navbarCollapse">
                    <!-- Left navbar links -->
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="/webmin/dashboard" class="nav-link">Beranda</a>
                        </li>
                        {{-- <li class="nav-item">
                            <a href="#" class="nav-link">Contact</a>
                        </li> --}}
                        <li class="nav-item dropdown">
                            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Mahasiswa</a>
                            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                                <li><a href="{{ url('webmin/mahasiswa') }}" class="dropdown-item">Data Mahasiswa</a></li>
                                <li class="dropdown-divider"></li>
                                <li><a href="{{ url('webmin/kppi') }}" class="dropdown-item">Praktik Industri / Kerja Praktik</a></li>
                                <li class="dropdown-divider"></li>
                                <li class="dropdown-submenu dropdown-hover">
                                    <a id="skripsi" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Skripsi</a>
                                    <ul aria-labelledby="skripsi" class="dropdown-menu border-0 shadow">
                                        <li><a tabindex="-1" href="{{ url('webmin/skripsi') }}" class="dropdown-item">Pendaftar Skripsi</a></li>
                                        <li><a tabindex="-1" href="{{ url('webmin/seminar') }}" class="dropdown-item">Seminar Proposal</a></li>
                                        <li><a tabindex="-1" href="{{ url('webmin/semhas') }}" class="dropdown-item">Ujian Akhir</a></li>
                                    </ul>
                                </li>
                                <li><a href="{{ url('webmin/yudisium') }}" class="dropdown-item">Yudisium</a></li>
                                <li class="dropdown-divider"></li>
                                <!-- Level two dropdown-->
                                <li class="dropdown-submenu dropdown-hover">
                                    <a id="dropdownSubMenu2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Lulusan</a>
                                    <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow">
                                        <li><a tabindex="-1" href="{{ url('webmin/lulusan') }}" class="dropdown-item">Data Lulusan</a></li>
                                        <li><a tabindex="-1" href="{{ url('webmin/nilai') }}" class="dropdown-item">Nilai</a></li>
                                        <li><a tabindex="-1" href="{{ url('webmin/transkrip') }}" class="dropdown-item">Transkrip</a></li>
                                    </ul>
                                </li>
                                <!-- End Level two -->
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Dosen</a>
                            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                                <li><a href="{{ url('webmin/dosen') }}" class="dropdown-item">Data Dosen</a></li>
                                <li><a href="{{ url('webmin/ajar?semester=') . App\Helpers\Codes::getSemesterNow() }}" class="dropdown-item">Pengajaran</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Surat</a>
                            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                                <li class="dropdown-submenu dropdown-hover">
                                    <a id="dropdownSubMenu1" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Dosen</a>
                                    <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                                        <li><a tabindex="-1" href="{{ url('webmin/prank') }}" class="dropdown-item">Surat Tugas</a></li>
                                        <li><a tabindex="-1" href="{{ url('webmin/prank') }}" class="dropdown-item">Surat Penerbitan ISBN</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown-submenu dropdown-hover">
                                    <a id="dropdownSubMenu2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Mahasiswa</a>
                                    <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow">
                                        <li><a tabindex="-1" href="{{ url('webmin/prank') }}" class="dropdown-item">Surat Keterangan Kuliah</a></li>
                                        <li><a tabindex="-1" href="{{ url('webmin/prank') }}" class="dropdown-item">Surat Permohonan Magang</a></li>
                                        <li><a tabindex="-1" href="{{ url('webmin/prank') }}" class="dropdown-item">Surat Permohonan Penelitian</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        @if (Auth::guard('admin')->user()->role == 'root')
                            <li class="nav-item dropdown">
                                <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Keuangan</a>
                                <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                                    <li><a href="{{ url('webmin/prank') }}" class="dropdown-item">Gaji Bulanan</a></li>
                                    <li><a href="{{ url('webmin/prank') }}" class="dropdown-item">Honorarium Magang</a></li>
                                    <li><a href="{{ url('webmin/prank') }}" class="dropdown-item">Honorarium Proposal Skripsi & Skripsi</a></li>
                                </ul>
                            </li>
                        @endif
                        <li class="nav-item dropdown">
                            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Data Master</a>
                            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                                @if (Auth::guard('admin')->user()->role == 'root')
                                    <li><a href="{{ url('webmin/jurusan') }}" class="dropdown-item">Data Jurusan</a></li>
                                    <li><a href="{{ url('webmin/kegiatan') }}" class="dropdown-item">Data Kegiatan</a></li>
                                    <li><a href="{{ url('webmin/batch') }}" class="dropdown-item">Gelombang / Batch Kegiatan</a></li>
                                    <li class="dropdown-divider"></li>
                                @endif
                                <li><a href="{{ url('webmin/kata') }}" class="dropdown-item">List Kata</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Setting</a>
                            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                                <li><a href="{{ url('webmin/profil') }}" class="dropdown-item">Profil</a></li>
                                <li><a href="{{ url('webmin/password') }}" class="dropdown-item">Ganti Password</a></li>
                                @if (Auth::guard('admin')->user()->role == 'root')
                                    <li class="dropdown-divider"></li>
                                    <li><a href="{{ url('webmin/parameter') }}" class="dropdown-item">Parameter</a></li>
                                @endif
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('webmin/logout') }}" class="nav-link">Keluar</a>
                        </li>
                    </ul>
                </div>

                <!-- Right navbar links -->
                <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
                    <!-- Notifications Dropdown Menu -->
                    <li class="nav-item dropdown">
                        <a class="nav-link" data-toggle="dropdown" href="#">
                            <i class="far fa-bell"></i>
                            {{-- <span class="badge badge-warning navbar-badge">15</span> --}}
                        </a>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                            <span class="dropdown-header">1 Notifikasi</span>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">
                                <i class="fas fa-envelope mr-2"></i> 4 Pesan Baru
                                <span class="float-right text-muted text-sm">3 mnt</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item dropdown-footer">Lihat Semua Notifikasi</a>
                        </div>
                    </li>
                    {{-- <li class="nav-item">
                        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                            <i class="fas fa-th-large"></i>
                        </a>
                    </li> --}}
                </ul>
            </div>
        </nav>
        <!-- /.navbar -->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container">
                    <div class="row mb-2">
                        <div class="col-sm-12">
                            <h1 class="m-0"> {{ $title }}</h1>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="content">
                <div class="container">
                    <div class="row">
                        <!-- Main Content -->
                        @yield('main')
                        <!-- Main Content -->
                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
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
            <!-- To the right -->
            <div class="float-right d-none d-sm-inline">

            </div>
            <!-- Default to the left -->
            <strong>Copyright &copy; {{ date('Y') }} <a href="#">Fakultas Teknik</a>.</strong> All rights reserved.
        </footer>
    </div>
    <!-- ./wrapper -->
    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="{{ url('plugins/jquery/jquery.js') }}"></script>
    <script src="{{ url('plugins/jquery/jquery-ui.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ url('plugins/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ url('js/adminlte.min.js') }}"></script>
    <!-- Sweet Alert -->
    <script src="{{ url('plugins/sweetalert2/sweetalert2.js') }}"></script>
    <script>
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
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $(document).ready(function() {

            $("#searchdosen").autocomplete({
                source: function(request, response) {
                    // Fetch data
                    $.ajax({
                        url: "{{ url('api/getDosen') }}",
                        type: 'post',
                        dataType: "json",
                        data: {
                            _token: CSRF_TOKEN,
                            search: request.term
                        },
                        success: function(data) {
                            response(data);
                        }
                    });
                },
                select: function(event, ui) {
                    // Set selection
                    $('#searchdosen').val(ui.item.label);
                    $('#niy').val(ui.item.niy);
                    $('#nama').val(ui.item.nama);
                    $('#jurusan_id').val(ui.item.jurusan);
                    $('#nidn').val(ui.item.nidn);
                    return false;
                }
            });
        });
    </script>
    @yield('addjs')
</body>

</html>
