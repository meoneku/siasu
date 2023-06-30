<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />

    <title>Fakultas Teknik - Universitas Hasyim Asy'ari</title>
    <meta content="Web Portal Fakultas Teknik Universitas Hasyim Asy'ari" name="description" />
    <meta content="" name="keywords" />
    @include('layout.head')
</head>

<body>
    @include('layout.header')

    <!-- ======= Hero Section ======= -->
    <section id="hero">
        <div id="heroCarousel" data-bs-interval="5000" class="carousel slide carousel-fade" data-bs-ride="carousel">
            <div class="carousel-inner" role="listbox">
                @foreach ($banner as $ban)
                    <div class="carousel-item active" style="background-image: url({{ url('uploads') }}/{{ $ban->gambar }})">
                        <div class="carousel-container">
                            <div class="carousel-content animate__animated animate__fadeInUp">
                                <h2>{{ $ban->judul }}</h2>
                                <p>{{ \Illuminate\Support\Str::limit(strip_tags($ban->body), 200, '...') }}</p>
                                <div class="text-center"><a href="{{ url('berita') . '/' . $ban->slug }}" class="btn-get-started">Lanjut Baca</a></div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <a class="carousel-control-prev" href="#heroCarousel" role="button" data-bs-slide="prev">
                <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
            </a>

            <a class="carousel-control-next" href="#heroCarousel" role="button" data-bs-slide="next">
                <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
            </a>

            <ol class="carousel-indicators" id="hero-carousel-indicators"></ol>
        </div>
    </section>

    <main id="main">
        <section id="sejarah" class="about-us">
            <div class="container" data-aos="fade-up">
                <div class="section-title">
                    <h2>Sejarah Singkat</h2>
                </div>
                <div class="row content">
                    <div class="col-lg-6" data-aos="fade-right">
                        <div class="d-flex justify-content-center">
                            <img src="{{ url('') }}/img/pngegg.png" alt="" class="img-fluid" />
                        </div>
                    </div>
                    <div class="col-lg-6 pt-4 pt-lg-0" data-aos="fade-left">
                        {!! $sejarah->singkat !!}
                    </div>
                </div>
            </div>
        </section>

        <section id="fasilitas" class="services section-bg">
            <div class="container" data-aos="fade-up">
                <div class="section-title">
                    <h2>Fasilitas</h2>
                </div>

                <div class="row">
                    @foreach ($fasilitas as $fal)
                        <div class="col-lg-4 col-md-6 d-flex align-items-stretch mb-4 mt-md-0" data-aos="zoom-in" data-aos-delay="100">
                            <div class="card">
                                <img src="{{ url('uploads') }}/{{ $fal->gambar }}" class="card-img-top" alt="..." />
                                <div class="card-body">
                                    <p class="card-text">{{ $fal->deskripsi }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <section id="berita" class="portfolio">
            <div class="container" data-aos="fade-up">
                <div class="section-title">
                    <h2>Berita</h2>
                </div>
                <div class="row">
                    @foreach ($berita as $brit)
                        <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
                            <div class="card">
                                <img src="{{ url('uploads') }}/{{ $brit->gambar }}" class="card-img-top" alt="..." />
                                <div class="card-body">
                                    <h6 class="card-title">{{ \Illuminate\Support\Str::limit($brit->judul, 50, '...') }}</h6>
                                    <h6 class="card-subtitle mb-2 date-created"><i class="bi bi-clock"></i> {{ tanggal_indonesia($brit->publish_at, false) }} in {{ $brit->kategori->name }} by {{ $brit->penulis }}</h6>
                                    <p class="card-text">{{ \Illuminate\Support\Str::limit(strip_tags($brit->body), 170, '...') }}</p>
                                    <div class="d-flex justify-content-end">
                                        <a href="{{ url('berita') . '/' . $brit->slug }}" class="btn btn-success">Lanjutkan Baca</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <section id="kerjasama" class="clients">
            <div class="container" data-aos="fade-up">
                <div class="section-title">
                    <h2>Kerjasama</h2>
                </div>

                <div class="row no-gutters clients-wrap clearfix" data-aos="fade-up">
                    @foreach ($kerjasama as $kerja)
                        <div class="col-lg-3 col-md-4 col-6">
                            <div class="client-logo">
                                <img src="{{ url('uploads') }}/{{ $kerja->logo }}" class="img-fluid" alt="..." />
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    </main>

    @include('layout.footer')

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    @include('layout.js')
</body>

</html>
