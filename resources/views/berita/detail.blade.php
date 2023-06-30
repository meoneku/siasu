<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />

    <title>Berita | Fakultas Teknik UNHASY</title>
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
                    <h2>{{ $berita->judul }}</h2>
                </div>

            </div>
        </section><!-- End Breadcrumbs -->

        <!-- ======= Blog Section ======= -->
        <section id="blog" class="blog">
            <div class="container" data-aos="fade-up">

                <div class="row">

                    <div class="col-lg-8 entries">

                        <article class="entry entry-single">

                            <div class="entry-img">
                                <img src="{{ url('uploads') . '/' . $berita->gambar }}" alt="..." class="img-fluid">
                            </div>

                            <h2 class="entry-title">
                                <a href="#">{{ $berita->judul }}</a>
                            </h2>

                            <div class="entry-meta">
                                <ul>
                                    <li class="d-flex align-items-center"><i class="bi bi-person"></i> <a href="#">{{ $berita->penulis }}</a></li>
                                    <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a href="#"><time datetime="{{ $berita->publish_at }}">{{ \App\Helpers\IndoTanggal::tanggal($berita->publish_at, false) }}</time></a></li>
                                </ul>
                            </div>

                            <div class="entry-content">
                                {!! $berita->body !!}
                            </div>
                            @if ($berita->file != null)
                                <div class="d-flex justify-content-end">
                                    <a href="{{ url('uploads') . '/' . $berita->file }}" class="btn btn-success"><i class="bi bi-download"></i> Unduh Berkas</a>
                                </div>
                            @endif
                            <div class="entry-footer">
                                <i class="bi bi-folder"></i>
                                <ul class="cats">
                                    <li><a href="{{ url('berita?') . 'kategori=' . $berita->kategori->slug }}">{{ $berita->kategori->name }}</a></li>
                                </ul>
                            </div>

                        </article><!-- End blog entry -->

                    </div><!-- End blog entries list -->

                    <div class="col-lg-4">

                        <div class="sidebar">

                            <h3 class="sidebar-title">Cari</h3>
                            <div class="sidebar-item search-form">
                                <form action="{{ route('home.berita') }}">
                                    <input type="text" id="judul" name="judul" value="{{ request('judul') }}">
                                    <button type="submit"><i class="bi bi-search"></i></button>
                                </form>
                            </div>

                            <h3 class="sidebar-title">Kategori</h3>
                            <div class="sidebar-item categories">
                                <ul>
                                    @foreach ($kategori as $kat)
                                        <li><a href="{{ url('berita?') . 'kategori=' . $kat->slug }}">{{ $kat->name }}</a></li>
                                    @endforeach
                                </ul>
                            </div><!-- End sidebar categories-->

                            <h3 class="sidebar-title">Terbaru</h3>
                            <div class="sidebar-item recent-posts">
                                @foreach ($recent as $data)
                                    <div class="post-item clearfix">
                                        <img src="{{ url('uploads') . '/' . $data->gambar }}" alt="...">
                                        <h4><a href="{{ route('home.berita.detail', $data->slug) }}">{{ $data->judul }}</a></h4>
                                        <time datetime="{{ $data->publish_at }}">{{ \App\Helpers\IndoTanggal::tanggal($data->publish_at, false) }}</time>
                                    </div>
                                @endforeach
                            </div><!-- End sidebar recent posts-->

                        </div><!-- End sidebar -->

                    </div><!-- End blog sidebar -->

                </div>

            </div>
        </section><!-- End Blog Section -->

    </main><!-- End #main -->

    @include('layout.footer')

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    @include('layout.js')

</body>

</html>