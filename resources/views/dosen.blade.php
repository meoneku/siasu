<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />

    <title>Tenaga Pendidik | Fakultas Teknik UNHASY</title>
    <meta content="Web Portal Fakultas Teknik Universitas Hasyim Asy'ari" name="description" />
    <meta content="" name="keywords" />

    @include('layout.head')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
</head>

<body>

    @include('layout.header')

    <main id="main">

        <!-- ======= Breadcrumbs ======= -->
        <section id="breadcrumbs" class="breadcrumbs">
            <div class="container">

                <div class="d-flex justify-content-between align-items-center">
                    <h2><strong>Tenaga Pendidik</strong></h2>
                </div>

            </div>
        </section><!-- End Breadcrumbs -->

        <!-- ======= About Us Section ======= -->
        <section id="about-us" class="about-us section-bg">
            <div class="container" data-aos="fade-up">
                <div class="section-title" data-aos="fade-up">
                    <h2>Dosen <strong>Fakultas Teknik</strong></h2>
                    <p>Dosen Fakultas Teknik Terdiri Dari Dosen S1 Teknik Mesin, S1 Teknik Elektro, S1 Teknik Sipil Dan S1 Teknik Industri Dengan Jumlah Keseluruhan Sebanyak {{ $count }} Dosen Tetap</p>
                </div>

                <div class="row content">
                    <table id="myTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NIY</th>
                                <th>Nama</th>
                                <th>Homebase</th>
                            </tr>
                        </thead>
                        @foreach ($dosen as $data)
                            <tbody>
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $data->niy }}</td>
                                    <td>{{ $data->nama }}</td>
                                    <td>{{ $data->jurusan->jenjang }} {{ $data->jurusan->jurusan }}</td>
                                </tr>
                            </tbody>
                        @endforeach
                    </table>
                </div>

            </div>
        </section>
    </main><!-- End #main -->

    @include('layout.footer')

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    @include('layout.js')
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable({
                paging: false,
                searching: false
            })
        })
    </script>

</body>

</html>
