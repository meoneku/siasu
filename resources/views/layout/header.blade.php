<!-- ======= Header ======= -->
<header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">
        <!-- <h1 class="logo me-auto"><a href="index.html"><span>FT</span>UNHASY</a></h1> -->
        <a href="index.html" class="logo me-auto me-lg-0"><img src="{{ url('') }}/assets/img/FTLogo.png" alt="" class="img-fluid" /></a>

        <nav id="navbar" class="navbar order-last order-lg-0">
            <ul>
                <li><a href="{{ route('home.index') }}">Beranda</a></li>

                <li class="dropdown">
                    <a href="#"><span>Profil</span> <i class="bi bi-chevron-down"></i></a>
                    <ul>
                        <li><a href="{{ route('home.sejarah') }}">Sejarah</a></li>
                        <li class="dropdown">
                            <a href="#"><span>Visi Misi</span> <i class="bi bi-chevron-right"></i></a>
                            <ul>
                                @foreach (\App\Models\Visi::all() as $prodi)
                                    <li><a href="{{ route('home.visi', $prodi->slug) }}">{{ $prodi->nm_menu }}</a></li>
                                @endforeach
                            </ul>
                        </li>
                        <li><a href="{{ route('home.pimpinan') }}">Pimpinan</a></li>
                        @foreach (\App\Models\Profil::all() as $profil)
                            <li><a href="{{ route('home.profil', $profil->slug) }}">{{ $profil->nm_menu }}</a></li>
                        @endforeach
                    </ul>
                </li>

                <li class="dropdown">
                    <a href="#"><span>Akademik</span> <i class="bi bi-chevron-down"></i></a>
                    <ul>
                        <li class="dropdown">
                            <a href="#"><span>Prodi</span> <i class="bi bi-chevron-right"></i></a>
                            <ul>
                                @foreach (\App\Models\Prodi::all() as $prod)
                                    <li><a href="{{ route('home.prodi', $prod->slug) }}">{{ $prod->nm_menu }}</a></li>
                                @endforeach
                            </ul>
                        </li>
                        <li><a href="{{ route('home.kalender') }}">Kalender Akademik</a></li>
                        <li class="dropdown">
                            <a href="#"><span>EJournal</span> <i class="bi bi-chevron-right"></i></a>
                            <ul>
                                @foreach (\App\Models\Ejournal::all() as $jurnal)
                                    <li><a href="{!! $jurnal->link !!}" target="_blank">{{ $jurnal->nm_menu }}</a></li>
                                @endforeach
                            </ul>
                        </li>
                    </ul>
                </li>

                <li class="dropdown">
                    <a href="#"><span>SDM</span> <i class="bi bi-chevron-down"></i></a>
                    <ul>
                        <li><a href="{{ route('home.dosen') }}">Tenaga Pendidik</a></li>
                        <li><a href="{{ route('home.staf') }}">Tenaga Kependidikan</a></li>
                    </ul>
                </li>

                <li class="dropdown">
                    <a href="#"><span>Kemahasiswaan</span> <i class="bi bi-chevron-down"></i></a>
                    <ul>
                        <li><a href="{{ route('home.bem') }}">BEM</a></li>
                        <li class="dropdown">
                            <a href="#"><span>HMP</span> <i class="bi bi-chevron-right"></i></a>
                            <ul>
                                @foreach (\App\Models\Hmp::all() as $hmp)
                                    <li><a href="{{ route('home.hmp', $hmp->slug) }}">{{ $hmp->nm_menu }}</a></li>
                                @endforeach
                            </ul>
                        </li>
                        @foreach (\App\Models\Kemahasiswaan::all() as $mhs)
                            <li><a href="{{ route('home.kemahasiswaan', $mhs->slug) }}">{{ $mhs->nm_menu }}</a></li>
                        @endforeach
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#"><span>Lab</span> <i class="bi bi-chevron-down"></i></a>
                    <ul>
                        @foreach (\App\Models\Lab::all() as $lab)
                            <li><a href="{{ route('home.lab', $lab->slug) }}">{{ $lab->nm_menu }}</a></li>
                        @endforeach
                    </ul>
                </li>
                <li><a href="{{ route('home.pengumuman') }}">Pengumuman</a></li>
                <li><a href="{{ route('home.berita') }}">Berita</a></li>
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav>
        <!-- .navbar -->

        <div class="header-social-links d-flex">
            <a href="https://twitter.com/ftunhasy" class="twitter"><i class="bu bi-twitter"></i></a>
            <a href="https://ms-my.facebook.com/people/Fakultas-Teknik-Unhasy/100069531803899/" class="facebook"><i class="bu bi-facebook"></i></a>
            <a href="https://instagram.com/unhasyft" class="instagram"><i class="bu bi-instagram"></i></a>
            <a href="https://www.youtube.com/channel/UCREKNuzSKNElIYFAd_aoUFA" class="youtube"><i class="bu bi-youtube"></i></a>
        </div>
    </div>
</header>
<!-- End Header -->
