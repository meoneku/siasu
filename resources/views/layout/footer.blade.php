<footer id="footer">
    <div class="footer-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 footer-contact">
                    <h3>FTUNHASY</h3>
                    <p>
                        Jl. Irian Jaya 55 Gedung C<br />
                        Tebuireng Tromol Pos IX<br />
                        Jombang Jawa Timur <br /><br />
                        <strong>Telp:</strong> 864206, 851396, 874685<br />
                        <strong>Email:</strong> ft.tu@unhasy.ac.id<br />
                    </p>
                </div>

                <div class="col-lg-4 col-md-6 footer-links">
                    <h4>Fakultas</h4>
                    <ul>
                        <li><i class="bx bx-chevron-right"></i> <a href="http://agamaislam.unhasy.ac.id/">Fakultas Agama Islam</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="http://informatika.unhasy.ac.id/">Fakultas Teknologi Informasi</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="http://ekonomi.unhasy.ac.id/">Fakultas Ekonomi</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="http://ilmupend.unhasy.ac.id/">Fakultas Ilmu Pendidikan</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="http://pps.unhasy.ac.id/">Fakultas Pascasarjana</a></li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-6 footer-links">
                    <h4>Lembaga & Layanan Akademik</h4>
                    <ul>
                        <li><i class="bx bx-chevron-right"></i> <a href="http://pusatbahasa.unhasy.ac.id/">Lembaga Bahasa</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="http://lppm.unhasy.ac.id/">LPPM</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="http://lpm.unhasy.ac.id/">LPM</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="http://siakadonline.unhasy.ac.id">SIAKAD</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">Alumni</a></li>
                    </ul>
                </div>

                <div class="col-lg-2 col-md-6 footer">
                    <h4>Pengunjung</h4>
                    <ul>
                        <li>Hari ini : {{ App\Models\Visitor::whereDate('created_at', date('Y-m-d'))->count() }}</li>
                        <li>Kemarin : {{ App\Models\Visitor::whereDate('created_at', date('Y-m-d', strtotime('-1 days')))->count() }}</li>
                        <li>Minggu ini : {{ App\Models\Visitor::whereBetween('created_at', [date('Y-m-d', strtotime('-7 days')), date('Y-m-d', strtotime('+1 days'))])->count() }}</li>
                        <li>Bulan ini : {{ App\Models\Visitor::whereMonth('created_at', date('m'))->count() }}</li>
                        <li>Tahun ini : {{ App\Models\Visitor::whereYear('created_at', date('Y'))->count() }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="container d-md-flex py-4">
        <div class="me-md-auto text-center text-md-start">
            <div class="copyright">
                &copy; Copyright <strong><span>Fakultas Teknik Unhasy</span></strong>. All Rights Reserved
            </div>
        </div>
        <div class="social-links text-center text-md-right pt-3 pt-md-0">
            <a href="https://twitter.com/ftunhasy" class="twitter"><i class="bx bxl-twitter"></i></a>
            <a href="ttps://ms-my.facebook.com/people/Fakultas-Teknik-Unhasy/100069531803899/" class="facebook"><i class="bx bxl-facebook"></i></a>
            <a href="https://instagram.com/unhasyft" class="instagram"><i class="bx bxl-instagram"></i></a>
            <a href="https://www.youtube.com/channel/UCREKNuzSKNElIYFAd_aoUFA" class="youtube"><i class="bx bxl-youtube"></i></a>
        </div>
    </div>
</footer>
