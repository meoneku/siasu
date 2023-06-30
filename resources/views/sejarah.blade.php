<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />

    <title>Sejarah | Fakultas Teknik UNHASY</title>
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
                    <h2><strong>Sejarah</strong></h2>
                </div>

            </div>
        </section><!-- End Breadcrumbs -->

        <!-- ======= About Us Section ======= -->
        <section id="about-us" class="about-us section-bg">
            <div class="container" data-aos="fade-up">

                <div class="row content">
                    <div class="d-flex justify-content-center">
                        <img src="{{ url('') }}/img/pngegg.png" alt="..." class="img-fluid" width="10%" />
                    </div>
                    <div class="col-lg-12 pt-4 pt-lg-0" data-aos="fade-left">
                        <h3>{{ $sejarah->judul }}</h3>
                        <h6 class="date-created mb-2"><i class="bi bi-clock"></i> {{ \App\Helpers\IndoTanggal::tanggal($sejarah->publish_at) }}</h6>
                        {!! $sejarah->body !!}
                    </div>
                </div>

            </div>
        </section>
    </main><!-- End #main -->

    @include('layout.footer')

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    @include('layout.js')

</body>

</html>
