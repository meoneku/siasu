<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />

    <title>Tenaga Kependidikan | Fakultas Teknik UNHASY</title>
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
                    <h2><strong>Tenaga Kependidikan</strong></h2>
                </div>

            </div>
        </section><!-- End Breadcrumbs -->

        <!-- ======= About Us Section ======= -->
        <section id="about-us" class="about-us section-bg">
            <div class="container" data-aos="fade-up">
                <div class="section-title" data-aos="fade-up">
                    <h2>Staf <strong>Fakultas Teknik</strong></h2>
                    <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.</p>
                </div>

                <div class="row content">
                    <table id="myTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Bagian</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Teguh Budi Santoso, S.Kom</td>
                                <td>Kepala Tata Usaha</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Boy Aldi Fariska, S.Pd</td>
                                <td>Staf Fakultas</td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Achmad Rosidi Anshori, S.E.</td>
                                <td>Staf Prodi</td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>Ahmad Fauzi, S.T.</td>
                                <td>Staf Laboratorium</td>
                            </tr>
                        </tbody>
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
