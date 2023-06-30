<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />

    <title>Pimpinan | Fakultas Teknik UNHASY</title>
    <meta content="Web Portal Fakultas Teknik Universitas Hasyim Asy'ari" name="description" />
    <meta content="" name="keywords" />

    @include('layout.head')
</head>

<body>
    @include('layout.header')

    <main id="main">

        <!-- ======= Breadcrumbs ======= -->
        <section id="breadcrumbs" class="breadcrumbs">
            <div class="container">

                <div class="d-flex justify-content-between align-items-center">
                    <h2>Pimpinan</h2>
                </div>

            </div>
        </section><!-- End Breadcrumbs -->

        <!-- ======= Dekanat ======= -->
        <section id="team" class="team section-bg">
            <div class="container">

                <div class="section-title" data-aos="fade-up">
                    <h2>Pimpinan <strong>Fakultas Teknik</strong></h2>
                    <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.</p>
                </div>

                <div class="row d-flex justify-content-center">
                    <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
                        <div class="member" data-aos="fade-up">
                            <div class="member-img">
                                <img src="{{ url('uploads') . '/' . $dekan->foto }}" class="img-fluid" alt="">
                                <div class="social">
                                    <a href=""><i class="bi bi-twitter"></i></a>
                                    <a href=""><i class="bi bi-facebook"></i></a>
                                    <a href=""><i class="bi bi-instagram"></i></a>
                                </div>
                            </div>
                            <div class="member-info">
                                <h4>{{ $dekan->nama }}</h4>
                                <span>{{ $dekan->jabatan }} Fakultas Teknik</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
                        <div class="member" data-aos="fade-up" data-aos-delay="100">
                            <div class="member-img">
                                <img src="{{ url('uploads') . '/' . $wadek->foto }}" class="img-fluid" alt="">
                                <div class="social">
                                    <a href=""><i class="bi bi-twitter"></i></a>
                                    <a href=""><i class="bi bi-facebook"></i></a>
                                    <a href=""><i class="bi bi-instagram"></i></a>
                                </div>
                            </div>
                            <div class="member-info">
                                <h4>{{ $wadek->nama }}</h4>
                                <span>{{ $wadek->jabatan }} Fakultas Teknik</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section><!-- End Dekanat -->

        <!-- ======= Kaprodi ======= -->
        <section id="team" class="team">
            <div class="container">

                <div class="section-title" data-aos="fade-up">
                    <h2>Kaprodi <strong>Fakultas Teknik</strong></h2>
                    <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.</p>
                </div>

                <div class="row">
                    @foreach ($kaprodi as $team)
                        <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
                            <div class="member" data-aos="fade-up">
                                <div class="member-img">
                                    <img src="{{ url('uploads') . '/' . $team->foto }}" class="img-fluid" alt="">
                                    <div class="social">
                                        <a href=""><i class="bi bi-twitter"></i></a>
                                        <a href=""><i class="bi bi-facebook"></i></a>
                                        <a href=""><i class="bi bi-instagram"></i></a>
                                    </div>
                                </div>
                                <div class="member-info">
                                    <h4>{{ $team->nama }}</h4>
                                    <span>{{ $team->jabatan }} {{ $team->jurusan->jenjang }} {{ $team->jurusan->jurusan }}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        </section><!-- End Kaprodi -->


    </main><!-- End #main -->

    @include('layout.footer')

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    @include('layout.js')

</body>

</html>
