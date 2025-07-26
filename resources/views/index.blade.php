@include('header')

<body>
    <header class="header-area header-sticky wow slideInDown" data-wow-duration="0.75s" data-wow-delay="0s">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    @include('navbar')
                </div>
            </div>
        </div>
    </header>

    <div class="main-banner" id="top">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-6 align-self-center">
                            <div class="item header-text">
                                <h6>Selamat datang di {{ config('data.name') }}</h6>
                                <h2>Temukan <em>anime favoritmu</em> dengan <span>mudah</span> di sini!</h2>
                                <p>Animegg adalah platform streaming anime gratis dengan tampilan menarik dan update
                                    anime terbaru setiap hari.</p>
                                <div class="down-buttons mt-4">
                                    <div class="main-blue-button-hover">
                                        <a target="_blank" href="https://wa.me/{{ config('data.phone') }}"><i
                                                class="fa fa-whatsapp me-2"></i>Kontak Kami</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="services" class="our-services section">
        <div class="services-right-dec">
            <img src="assets/images/services-right-dec.png" alt="">
        </div>
        <div class="container">
            <div class="services-left-dec">
                <img src="assets/images/services-left-dec.png" alt="">
            </div>
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="section-heading">
                        <h2>Kami <em>Sediakan</em> Layanan Terbaik untuk <span>Penggemar Anime</span></h2>
                        <span>Layanan Animegg</span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="owl-carousel owl-services">
                        <div class="item">
                            <h4>Nonton Anime Subtitle Indonesia</h4>
                            <div class="icon"><img src="assets/images/service-icon-01.png" alt=""></div>
                            <p>Animegg menyediakan ribuan anime dengan subtitle Indonesia yang update setiap hari.</p>
                        </div>
                        <div class="item">
                            <h4>Anime dengan Kualitas HD</h4>
                            <div class="icon"><img src="assets/images/service-icon-02.png" alt=""></div>
                            <p>Tonton anime favoritmu dalam resolusi tinggi mulai dari 480p hingga 1080p.</p>
                        </div>
                        <div class="item">
                            <h4>Update Jadwal Anime Terbaru</h4>
                            <div class="icon"><img src="assets/images/service-icon-03.png" alt=""></div>
                            <p>Dapatkan informasi jadwal rilis anime musiman terbaru secara real-time.</p>
                        </div>
                        <div class="item">
                            <h4>Anime Berdasarkan Genre</h4>
                            <div class="icon"><img src="assets/images/service-icon-04.png" alt=""></div>
                            <p>Pilih anime favoritmu berdasarkan genre seperti action, romance, comedy, dan lainnya.</p>
                        </div>
                        <div class="item">
                            <h4>Fitur Bookmark dan Riwayat Tonton</h4>
                            <div class="icon"><img src="assets/images/service-icon-01.png" alt=""></div>
                            <p>Simpan anime favoritmu dan lanjutkan menonton dari episode terakhir.</p>
                        </div>
                        <div class="item">
                            <h4>Rekomendasi Anime Personalized</h4>
                            <div class="icon"><img src="assets/images/service-icon-02.png" alt=""></div>
                            <p>Dapatkan rekomendasi anime berdasarkan riwayat tontonanmu.</p>
                        </div>
                        <div class="item">
                            <h4>Komunitas Penggemar Anime</h4>
                            <div class="icon"><img src="assets/images/service-icon-03.png" alt=""></div>
                            <p>Bergabung dengan komunitas Animegg untuk diskusi dan review anime terbaru.</p>
                        </div>
                        <div class="item">
                            <h4>Pencarian Anime Cepat & Akurat</h4>
                            <div class="icon"><img src="assets/images/service-icon-04.png" alt=""></div>
                            <p>Temukan anime dengan mudah menggunakan fitur pencarian cerdas kami.</p>
                        </div>
                        <div class="item">
                            <h4>Support Multi-Device</h4>
                            <div class="icon"><img src="assets/images/service-icon-01.png" alt=""></div>
                            <p>Nikmati Animegg dari HP, tablet, maupun desktop tanpa hambatan.</p>
                        </div>
                        <div class="item">
                            <h4>Download Anime untuk Offline</h4>
                            <div class="icon"><img src="assets/images/service-icon-02.png" alt=""></div>
                            <p>Tonton anime favoritmu di mana saja tanpa perlu koneksi internet.</p>
                        </div>
                        <div class="item">
                            <h4>Anime dengan Audio Jepang Asli</h4>
                            <div class="icon"><img src="assets/images/service-icon-03.png" alt=""></div>
                            <p>Dengarkan suara asli dari seiyuu favoritmu langsung dari Animegg.</p>
                        </div>
                        <div class="item">
                            <h4>Ribuan Judul Anime Lengkap</h4>
                            <div class="icon"><img src="assets/images/service-icon-04.png" alt=""></div>
                            <p>Dari anime lawas hingga terbaru, semua lengkap di Animegg!</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="about" class="about-us section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 align-self-center">
                    <div class="left-image">
                        <img src="animegg/programmer.png" alt="Two Girls working together">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="section-heading">
                        <h2>Perkaya pengalaman menontonmu dengan <em>Animegg</em> &amp; <span>fitur terbaik</span></h2>
                        <p>Animegg hadir untuk kamu para wibu sejati! Temukan anime favoritmu dengan fitur lengkap dan
                            tampilan yang nyaman di semua perangkat.</p>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="fact-item">
                                    <div class="count-area-content">
                                        <div class="icon">
                                            <img src="assets/images/service-icon-01.png" alt="">
                                        </div>
                                        <div class="count-digit">1200+</div>
                                        <div class="count-title">Judul Anime</div>
                                        <p>Dari anime jadul sampai terbaru, semua ada!</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="fact-item">
                                    <div class="count-area-content">
                                        <div class="icon">
                                            <img src="assets/images/service-icon-02.png" alt="">
                                        </div>
                                        <div class="count-digit">98%</div>
                                        <div class="count-title">Pengguna Puas</div>
                                        <p>Pengalaman menonton yang cepat & bebas iklan.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="fact-item">
                                    <div class="count-area-content">
                                        <div class="icon">
                                            <img src="assets/images/service-icon-03.png" alt="">
                                        </div>
                                        <div class="count-digit">24/7</div>
                                        <div class="count-title">Update Anime</div>
                                        <p>Episode terbaru selalu hadir tepat waktu!</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="portfolio" class="our-portfolio section">
        <div class="portfolio-left-dec">
            <img src="assets/images/portfolio-left-dec.png" alt="">
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="section-heading">
                        <h2>Animegg <em>Portal Anime</em> <span> Lengkap</span></h2>
                        <span>Top Anime di Season Ini</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="owl-carousel owl-portfolio">
                        @foreach ($anime['data'] ?? [] as $item)
                            <div class="item">
                                <div class="thumb">
                                    <img style="width: 396px; height: 608px"
                                        src="{{ $item['node']['main_picture']['large'] }}" alt="">
                                    <div class="hover-effect">
                                        <div class="inner-content">
                                            <a rel="sponsored" href="https://templatemo.com/tm-564-plot-listing"
                                                target="_parent">
                                                <h4>{{ $item['node']['title'] }}</h4>
                                            </a>
                                            <span>Ranking #{{ $item['ranking']['rank'] }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="pricing" class="pricing-tables">
        <div class="tables-left-dec">
            <img src="assets/images/tables-left-dec.png" alt="">
        </div>
        <div class="tables-right-dec">
            <img src="assets/images/tables-right-dec.png" alt="">
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="section-heading">
                        <h2>Pilih <em>Paket Nonton</em> Sesuai <span>Kebutuhanmu</span></h2>
                        <span>Paket Langganan Animegg</span>
                    </div>
                </div>
            </div>
            <div class="row">
                <!-- Paket Gratis -->
                <div class="col-lg-4">
                    <div class="item first-item">
                        <h4>Paket Gratis</h4>
                        <em>Rp0/bulan</em>
                        <span>Rp0</span>
                        <ul>
                            <li>Akses anime terbaru (terbatas)</li>
                            <li>Kualitas SD 480p</li>
                            <li>Iklan tampil</li>
                            <li>1 Perangkat</li>
                        </ul>
                        <div class="main-blue-button-hover">
                            <a href="#">Mulai Nonton</a>
                        </div>
                    </div>
                </div>
                <!-- Paket Premium -->
                <div class="col-lg-4">
                    <div class="item second-item">
                        <h4>Paket Premium</h4>
                        <em>Rp49.000/bulan</em>
                        <span>Rp39.000</span>
                        <ul>
                            <li>Akses semua anime tanpa batas</li>
                            <li>Kualitas HD 720p</li>
                            <li>Bebas iklan</li>
                            <li>3 Perangkat</li>
                        </ul>
                        <div class="main-blue-button-hover">
                            <a href="#">Langganan Sekarang</a>
                        </div>
                    </div>
                </div>
                <!-- Paket Ultra -->
                <div class="col-lg-4">
                    <div class="item third-item">
                        <h4>Paket Ultra</h4>
                        <em>Rp89.000/bulan</em>
                        <span>Rp69.000</span>
                        <ul>
                            <li>Semua fitur Premium</li>
                            <li>Kualitas Full HD 1080p</li>
                            <li>Mode offline + Simulcast</li>
                            <li>5 Perangkat + Keluarga</li>
                        </ul>
                        <div class="main-blue-button-hover">
                            <a href="#">Gabung Sekarang</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('testing')

    <div class="footer-dec">
        <img src="assets/images/footer-dec.png" alt="">
    </div>

    <footer>
        <div class="container">
            <div class="row">
                <!-- Logo dan kontak -->
                <div class="col-lg-3">
                    <div class="about footer-item">
                        <div class="logo">
                            <img style="width: 50px" src="assets/images/animegg-big.png" alt="Animegg Logo">
                            <h3 style="color: #03a4ed; font-style: normal;">Animegg</h3>
                        </div>
                        <a href="mailto:admin@animegg.com">admin@animegg.com</a>
                        <ul>
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-discord"></i></a></li>
                            <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                        </ul>
                    </div>
                </div>

                <!-- Navigasi Anime -->
                <div class="col-lg-3">
                    <div class="services footer-item">
                        <h4>Anime</h4>
                        <ul>
                            <li><a href="#">Anime Populer</a></li>
                            <li><a href="#">Anime Ongoing</a></li>
                            <li><a href="#">Anime Terbaru</a></li>
                            <li><a href="#">Anime Movie</a></li>
                        </ul>
                    </div>
                </div>

                <!-- Kategori & Komunitas -->
                <div class="col-lg-3">
                    <div class="community footer-item">
                        <h4>Kategori</h4>
                        <ul>
                            <li><a href="#">Action</a></li>
                            <li><a href="#">Romance</a></li>
                            <li><a href="#">Isekai</a></li>
                            <li><a href="#">Slice of Life</a></li>
                        </ul>
                    </div>
                </div>

                <!-- Newsletter -->
                <div class="col-lg-3">
                    <div class="subscribe-newsletters footer-item">
                        <h4>Berlangganan</h4>
                        <p>Dapatkan update anime terbaru langsung ke emailmu</p>
                        <form action="#" method="get">
                            <input type="text" name="email" id="email" pattern="[^ @]*@[^ @]*"
                                placeholder="Email kamu" required="">
                            <button type="submit" id="form-submit" class="main-button">
                                <i class="fa fa-paper-plane-o"></i>
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Copyright -->
                <div class="col-lg-12">
                    <div class="copyright">
                        <p>© 2025 Animegg. Semua Hak Dilindungi.
                            <br>
                            Dibuat dengan ❤️ untuk para pecinta anime.
                            <br>
                            Desain terinspirasi oleh komunitas anime Indonesia.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>


    <!-- Scripts -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/owl-carousel.js"></script>
    <script src="assets/js/animation.js"></script>
    <script src="assets/js/imagesloaded.js"></script>
    <script src="assets/js/custom.js"></script>

    <script>
        // Acc
        $(document).on("click", ".naccs .menu div", function() {
            var numberIndex = $(this).index();

            if (!$(this).is("active")) {
                $(".naccs .menu div").removeClass("active");
                $(".naccs ul li").removeClass("active");

                $(this).addClass("active");
                $(".naccs ul").find("li:eq(" + numberIndex + ")").addClass("active");

                var listItemHeight = $(".naccs ul")
                    .find("li:eq(" + numberIndex + ")")
                    .innerHeight();
                $(".naccs ul").height(listItemHeight + "px");
            }
        });
    </script>
</body>

</html>
