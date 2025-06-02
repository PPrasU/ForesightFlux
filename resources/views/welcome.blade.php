<!DOCTYPE html>
<html class="no-js" lang="zxx">
  <head>
    <!-- Meta Tags -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />

    <!-- Title -->
    <title>ForesightFluxCP | Homepage</title>

    <!-- Favicon -->
    <link rel="icon" href="{{ secure_asset('images/Logo.webp') }}" />
    <link rel="icon" href="{{ secure_asset('images/Logo_icon.webp') }}" />

    <!-- Google Fonts -->
    <link
      href="https://fonts.googleapis.com/css?family=Poppins:200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap"
      rel="stylesheet"
    />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ secure_asset('source/css/bootstrap.min.css') }}" />
    <!-- Nice Select CSS -->
    <link rel="stylesheet" href="{{ secure_asset('source/css/nice-select.css') }}" />
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="{{ secure_asset('source/css/font-awesome.min.css') }}" />
    <!-- icofont CSS -->
    <link rel="stylesheet" href="{{ secure_asset('source/css/icofont.css') }}" />
    <!-- Slicknav -->
    <link rel="stylesheet" href="{{ secure_asset('source/css/slicknav.min.css') }}" />
    <!-- Owl Carousel CSS -->
    <link rel="stylesheet" href="{{ secure_asset('source/css/owl-carousel.css') }}" />
    <!-- Datepicker CSS -->
    <link rel="stylesheet" href="{{ secure_asset('source/css/datepicker.css') }}" />
    <!-- Animate CSS -->
    <link rel="stylesheet" href="{{ secure_asset('source/css/animate.min.css') }}" />
    <!-- Magnific Popup CSS -->
    <link rel="stylesheet" href="{{ secure_asset('source/css/magnific-popup.css') }}" />

    <!-- Medipro CSS -->
    <link rel="stylesheet" href="{{ secure_asset('source/css/normalize.css') }}" />
    <link rel="stylesheet" href="{{ secure_asset('source/style.css') }}" />
    <link rel="stylesheet" href="{{ secure_asset('source/css/responsive.css') }}" />
  </head>
  <body>
    <!-- Preloader -->
    <div class="preloader">
      <div class="loader">
        <div class="loader-outter"></div>
        <div class="loader-inner"></div>

        <div class="indicator">
          <svg width="16px" height="12px">
            <polyline id="back" points="1 6 4 6 6 11 10 1 12 6 15 6"></polyline>
            <polyline
              id="front"
              points="1 6 4 6 6 11 10 1 12 6 15 6"
            ></polyline>
          </svg>
        </div>
      </div>
    </div>

    <!-- Header Area -->
    <header class="header">
      <div class="header-inner">
        <div class="container">
          <div class="inner">
            <div class="row">
              <div class="col-lg-3 col-md-3 col-12">
                <div class="logo">
                  <a href="/"><img src="{{ secure_asset('images/Logo.webp') }}" alt="Tempat logo" style="height: 55px; width: 180px;"/></a>
                </div>
                <div class="mobile-nav"></div>
              </div>
              <div class="col-lg-7 col-md-9 col-12">
                <div class="main-menu">
                  <nav class="navigation">
                    <ul class="nav menu">
                        <li class="active">
                            <a>Peramalan Harga Kripto Berbasis Data Historis</a>
                        </li>
                    </ul>
                  </nav>
                </div>
              </div>
              <div class="col-lg-2 col-12">
                <div class="get-quote">
                  <a href="{{ route('petunjukPenggunaan') }}" class="btn">Petunjuk Penggunaan</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </header>

    {{-- slider --}}
    <section class="slider">
      <div class="hero-slider">
        <div class="single-slider" style="background-image: url('images/slider.jpg');">
          <div class="container">
            <div class="row">
              <div class="col-lg-7">
                <div class="text">
                  <h1>
                    We Provide <span>Crypto Prediction</span> Services That You Can
                    <span>Use!</span>
                  </h1>
                  <p>
                    Dengan sebuah teknologi analisis data kripto, kami menyediakan prediksi harga yang dapat digunakan untuk membantu Anda mengetahui pergerakan prediksi kripto untuk beberapa hari kedepannya.
                  </p>
                  <div class="button">
                    <a href="{{ route('petunjukPenggunaan') }}" class="btn">Cara Penggunaan Website</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="single-slider" style="background-image: url('images/slider3.jpg')">
          <div class="container">
            <div class="row">
              <div class="col-lg-7">
                <div class="text">
                  <h1>
                    Real-Time <span>Crypto</span> Price
                    <span>Update!</span>
                  </h1>
                  <p>
                    Tetap terhubung dengan pembaruan harga kripto secara real-time. Pantau pergerakan harga kripto yang terus berubah.
                  </p>
                  <div class="button">
                    <a href="{{ route('petunjukPenggunaan') }}" class="btn">Cara Penggunaan Website</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="single-slider" style="background-image: url('images/Slider2.jpg')">
          <div class="container">
            <div class="row">
              <div class="col-lg-7">
                <div class="text">
                  <h1>
                    Empower Your <span>Crypto Investments</span> with 
                    <span>Forecastsing</span> From Us!
                  </h1>
                  <p>
                    Dapatkan akses ke model peramalan berbasis data historis untuk meramalkan harga kripto beberapa hari kedepan beserta akurasi dari model peramalannya.
                  </p>
                  <div class="button">
                    <a href="{{ route('dashboard') }}" class="btn">Lakukan Peramalannya</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    {{-- kelebihan web --}}
    <section class="schedule">
      <div class="container">
        <div class="schedule-inner">
          <div class="row">
            <div class="col-lg-4 col-md-6 col-12">
              <div class="single-schedule first">
                <div class="inner">
                  <div class="icon">
                    <i class="fa fa-cogs"></i>
                  </div>
                  <div class="single-content">
                    <h4>Get Data From API</h4>
                    <p>
                      Tinggal memilih jenis kripto dan jangka waktu yang diinginkan untuk dilakukan peramalan. Mudah, tinggal pilih dan proses.
                    </p>
                    <a href="{{ route('petunjukPenggunaan') }}"
                      >LEARN MORE<i class="fa fa-long-arrow-right"></i
                    ></a>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-6 col-12">
              <div class="single-schedule middle">
                <div class="inner">
                  <div class="icon">
                    <i class="icofont-prescription"></i>
                  </div>
                  <div class="single-content">
                    <h4>Upload Your Historical Data</h4>
                    <p>
                      Dapat mengunggah sendiri data historis dengan menggunakan file csv jika sudah memiliki data historis atau jika kripto tidak ada pada API.
                    </p>
                    <a href="{{ route('petunjukPenggunaan') }}"
                      >LEARN MORE<i class="fa fa-long-arrow-right"></i
                    ></a>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-12 col-12">
              <div class="single-schedule last">
                <div class="inner">
                  <div class="icon">
                    <i class="icofont-ui-clock"></i>
                  </div>
                  <div class="single-content">
                    <h4>Real-Time Crypto Movement</h4>
                    <p>
                        Dapat melihat pergerakan kripto secara waktu nyata, sehingga dapat melihat perubahan yang terjadi di market kripto.
                    </p>
                    <a href="{{ route('petunjukPenggunaan') }}"
                      >LEARN MORE<i class="fa fa-long-arrow-right"></i
                    ></a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    {{-- Pelayanan websitenya --}}
    <section class="Feautes section">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="section-title">
              <h2>We Are Here to Assist You in Navigating the Crypto Market</h2>
              <img src="images/section-img.png" alt="#" />
              <p>
                Leveraging forecasting techniques, we provide real-time crypto market predictions based on historical data to help you stay ahead of the curve.
              </p>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-4 col-12">
            <div class="single-features">
              <div class="signle-icon">
                <i class="icofont icofont-chart-bar-graph"></i>
              </div>
              <h3>Price Prediction Models</h3>
              <p>
                Menggunakan model peramalan  Triple Exponential Smoothing untuk memprediksi harga kripto di masa depan berdasarkan data historis, membantu Anda membuat keputusan investasi yang lebih tepat.
              </p>
            </div>
          </div>
          <div class="col-lg-4 col-12">
            <div class="single-features">
              <div class="signle-icon">
                <i class="icofont icofont-database"></i>
              </div>
              <h3>Historical Data Analysis</h3>
              <p>
                Analisis data harga kripto masa lalu untuk mengidentifikasi pola dan tren yang berguna dalam meramalkan pergerakan harga di masa depan, memberikan wawasan yang lebih jelas tentang pasar.
              </p>
            </div>
          </div>
          <div class="col-lg-4 col-12">
            <div class="single-features last">
              <div class="signle-icon">
                <i class="icofont icofont-clock-time"></i>
              </div>
              <h3>Real-Time Predictions</h3>
              <p>
                Peroleh prediksi harga kripto secara real-time, memungkinkan Anda untuk selalu mengikuti perkembangan pasar dan memanfaatkan peluang perdagangan dengan cepat.
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>

    {{-- pilih petunjuk penggunaan atau dasbor --}}
    <section class="pricing-table section">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="section-title">
              <h2>Pertama Kali Mengunjungi Website Ini?</h2>
              <img src="images/section-img.png" alt="#" />
              <p>
                Silahkan pilih petunjuk cara penggunaan jika pertama kali mengunjungi website ini, 
                jika tidak langsung saja ke dasbor
              </p>
            </div>
          </div>
        </div>
        <div class="row">
          <!-- Table -->
          <div class="col-lg-6 col-md-12 col-12">
            <div class="single-table">
              <div class="table-head">
                <div class="icon">
                  <i class="icofont icofont-list"></i>
                </div>
                <h4 class="title">Petunjuk Cara Penggunaan</h4>
              </div>
              <ul class="table-list">
                <p style="margin-bottom: 15px">Berisi rincian seperti</p>
                <li class="cross">
                  <i class="icofont icofont-ui-close"></i>Cara Gunain Menu Impor Data
                </li>
                <li class="cross">
                  <i class="icofont icofont-ui-close"></i>Cara Gunain Menu Data Dari API
                </li>
                <li class="cross">
                  <i class="icofont icofont-ui-check"></i>Nah Kalo Udah Paham Baru Ke Dasbor
                </li>
                <br><br><br><br>
              </ul>
              <div class="table-bottom">
                <a class="btn" href="{{ route('petunjukPenggunaan') }}">Inpo dong gunaiinnya gimana</a>
              </div>
            </div>
          </div>

          <!-- Table -->
          <div class="col-lg-6 col-md-12 col-12">
            <div class="single-table">
              <div class="table-head">
                <div class="icon">
                  <i class="icofont icofont-space-shuttle"></i>
                </div>
                <h4 class="title">Langsung Ke Dasbor</h4>
              </div>
              <ul class="table-list">
                <p>Berisi menu-menu untuk peramalan dong, apa aja isinya?</p>
                <p  style="margin-bottom: 15px">isinya itu</p>
                <li>
                  <i class="icofont icofont-ui-check"></i>Beranda
                </li>
                <li>
                  <i class="icofont icofont-ui-check"></i>Pengambilan Data dari API
                </li>
                <li>
                  <i class="icofont icofont-ui-check"></i>Pengambilan Data dari Impor csv
                </li>
                <li>
                  <i class="icofont icofont-ui-check"></i>Proses Peramalannya
                </li>
                <li>
                  <i class="icofont icofont-ui-check"></i>Hasilnya dong, pasti
                </li>
              </ul>
              <div class="table-bottom">
                <a class="btn" href="{{ route('dashboard') }}">Meluncur Ke Dasbor</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <footer id="footer" class="footer">
      
      <div class="copyright">
        <div class="container">
          <div class="row">
            <div class="col-lg-12 col-md-12 col-12">
              <div class="copyright-content">
                <p>
                    © {{ date('Y') }} ForesightFluxCP <span class="d-none d-sm-inline-block">- Proyek Tugas Akhir Putra Prasetya Utama (2118030) | Template by <a href="https://www.wpthemesgrid.com">wpthemesgrid.com</a></span>
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </footer>

    <!-- jquery Min JS -->
    <script src="{{ secure_asset('source/js/jquery.min.js') }}"></script>
    <!-- jquery Migrate JS -->
    <script src="{{ secure_asset('source/js/jquery-migrate-3.0.0.js') }}"></script>
    <!-- jquery Ui JS -->
    <script src="source/js/jquery-ui.min.js"></script>
    <!-- Easing JS -->
    <script src="{{ secure_asset('source/js/easing.js') }}"></script>
    <!-- Color JS -->
    <script src="{{ secure_asset('source/js/colors.js') }}"></script>
    <!-- Popper JS -->
    <script src="{{ secure_asset('source/js/popper.min.js') }}"></script>
    <!-- Bootstrap Datepicker JS -->
    <script src="{{ secure_asset('source/js/bootstrap-datepicker.js') }}"></script>
    <!-- Jquery Nav JS -->
    <script src="{{ secure_asset('source/js/jquery.nav.js') }}"></script>
    <!-- Slicknav JS -->
    <script src="{{ secure_asset('source/js/slicknav.min.js') }}"></script>
    <!-- ScrollUp JS -->
    <script src="{{ secure_asset('source/js/jquery.scrollUp.min.js') }}"></script>
    <!-- Niceselect JS -->
    <script src="{{ secure_asset('source/js/niceselect.js') }}"></script>
    <!-- Tilt Jquery JS -->
    <script src="{{ secure_asset('source/js/tilt.jquery.min.js') }}"></script>
    <!-- Owl Carousel JS -->
    <script src="{{ secure_asset('source/js/owl-carousel.js') }}"></script>
    <!-- counterup JS -->
    <script src="{{ secure_asset('source/js/jquery.counterup.min.js') }}"></script>
    <!-- Steller JS -->
    <script src="{{ secure_asset('source/js/steller.js') }}"></script>
    <!-- Wow JS -->
    <script src="{{ secure_asset('source/js/wow.min.js') }}"></script>
    <!-- Magnific Popup JS -->
    <script src="{{ secure_asset('source/js/jquery.magnific-popup.min.js') }}"></script>
    <!-- Counter Up CDN JS -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/waypoints/2.0.3/waypoints.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="{{ secure_asset('source/js/bootstrap.min.js') }}"></script>
    <!-- Main JS -->
    <script src="{{ secure_asset('source/js/main.js') }}"></script>
    <script>
      function scrollToTop(e) {
        e.preventDefault();
        window.scrollTo({ top: 0, behavior: 'smooth' });
      }
    </script>
  </body>
</html>
