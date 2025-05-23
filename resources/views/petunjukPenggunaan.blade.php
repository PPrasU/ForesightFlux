<!DOCTYPE html>
<html class="no-js" lang="zxx">
  <head>
    <!-- Meta Tags -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="keywords" content="Site keywords here" />
    <meta name="description" content="" />
    <meta name="copyright" content="" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />

    <!-- Title -->
    <title>ForesightFluxCP | Petunjuk Penggunaan</title>

    <!-- Favicon -->
    {{-- <link rel="icon" href="images/Logo_icon.png" /> --}}
    <link rel="icon" href="images/favicon.ico" />

    <!-- Google Fonts -->
    <link
      href="https://fonts.googleapis.com/css?family=Poppins:200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap"
      rel="stylesheet"
    />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="source/css/bootstrap.min.css" />
    <!-- Nice Select CSS -->
    <link rel="stylesheet" href="source/css/nice-select.css" />
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="source/css/font-awesome.min.css" />
    <!-- icofont CSS -->
    <link rel="stylesheet" href="source/css/icofont.css" />
    <!-- Slicknav -->
    <link rel="stylesheet" href="source/css/slicknav.min.css" />
    <!-- Owl Carousel CSS -->
    <link rel="stylesheet" href="source/css/owl-carousel.css" />
    <!-- Datepicker CSS -->
    <link rel="stylesheet" href="source/css/datepicker.css" />
    <!-- Animate CSS -->
    <link rel="stylesheet" href="source/css/animate.min.css" />
    <!-- Magnific Popup CSS -->
    <link rel="stylesheet" href="source/css/magnific-popup.css" />

    <!-- Medipro CSS -->
    <link rel="stylesheet" href="source/css/normalize.css" />
    <link rel="stylesheet" href="source/style.css" />
    <link rel="stylesheet" href="source/css/responsive.css" />
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
                  <a href="/"><img src="" alt="Tempat logo" /></a>
                </div>
                <div class="mobile-nav"></div>
              </div>
              <div class="col-lg-7 col-md-9 col-12">
                <div class="main-menu">
                  <nav class="navigation">
                    <ul class="nav menu">
                        <li class="active">
                            <a>Petunjuk Penggunaan Peramalan Harga Kripto</a>
                        </li>
                    </ul>
                  </nav>
                </div>
              </div>
              <div class="col-lg-2 col-12">
                <div class="get-quote">
                  <a href="{{ route('dashboard') }}" class="btn">Dasbor</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </header>

    {{-- petunjuk impor data --}}
    <section class="call-action overlay" data-stellar-background-ratio="0.5">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 col-md-12 col-12">
            <div class="content">
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="why-choose section">
      <div class="container">
        @foreach($petunjukImport as $index => $petunjuk)
          <div class="row mb-5">
            <div class="col-lg-6 col-12">
              <div class="choose-left">
                <h3>{{ $index + 1 }}. {{ $petunjuk->judul }}</h3>
                
                @if($petunjuk->desk_1)
                  <p>{!! nl2br(e($petunjuk->desk_1)) !!}</p>
                @endif
                
                @if($petunjuk->desk_2)
                  <p>{!! nl2br(e($petunjuk->desk_2)) !!}</p>
                @endif
                
                @if($petunjuk->desk_3)
                  <b>{!! nl2br(e($petunjuk->desk_3)) !!}</b>
                @endif

                <br><br><br>
              </div>
            </div>

            <div class="col-lg-6 col-12">
              <div class="choose-right">
                <img src="{{ asset('foto-petunjuk-penggunaan/' . $petunjuk->gambar) }}" alt="Petunjuk Gambar {{ $index + 1 }}" class="img-fluid" />
              </div>
            </div>
          </div>
          @endforeach

        <div class="row">
          <div class="col-lg-12">
            <div class="section-title">
              <h2>Petunjuk Penggunaan Website Peramalan Harga Kripto Untuk Impor Data</h2>
              <img src="images/section-img.png" alt="#" />
              <p>
                Tingkat kesulitan: <a style="color: red">Rumit (Perlu login untuk bisa download) </a><br>
                Keunggulan: <a style="color: green">Data lebih lengkap </a>
              </p>
            </div>
          </div>
        </div>
        {{-- 1 --}}
        <div class="row">
          <div class="col-lg-6 col-12">
            <div class="choose-left">
              <h3>1. Cari Sumber Data Historis</h3>
              <p>
                Sumber data historis kripto dapat diambil pada website 
                <a 
                  style="color: #1a76d1; text-decoration: underline;" 
                  href="https://www.investing.com/crypto/currencies" 
                  target="_blank"
                >
                  investing.com
                </a>
                klik saja link tersebut
              </p>
              <p>
                Terlihat pada gambar disamping terdapat berbagai mancam jenis kripto yang dapat dipilih
                seperti Bitcoin, Ethereum, Tether USDt, XRP, BNB, dan kripto lainnya.
              </p>
              <b>
                Pilih aset kripto yang ingin dilakukan peramalan, misalnya Bitcoin.
              </b>
              <br><br><br>
            </div>
          </div>

          <div class="col-lg-6 col-12">
            <div class="choose-right">
              <img src="images/petunjuk-impor-1.png" alt="#" />
            </div>
          </div>

        </div>
        {{-- 2 --}}
        <div class="row">
          <div class="col-lg-6 col-12">
            <div class="choose-left">
              <h3>2. Pilih Aset Kripto lalu Masuk Ke Submenu Historical Data/Data Historis</h3>
              <p>
                Setelah memilih aset kripto selanjutnya yaitu
                masuk ke submenu Historical Data (bila bahasa Inggris) 
                atau Data Historis (bila bahasa Indonesia)
              </p>
              <p>
                Kenapa ke submenu data historis atau historical data, karena peramalan harga kripto pada 
                website ini datanya menggunakan data historis. Apa itu data historis, data historis 
                adalah kumpulan data dari peristiwa atau aktivitas yang telah terjadi di masa lalu biasanya 
                berupa data harian atau bulanan ataupun tahunan.
              </p>
            </div>
          </div>

          <div class="col-lg-6 col-12">
            <div class="choose-right">
              <img src="images/petunjuk-impor-2.png" alt="#" />
            </div>
          </div>

        </div>
        {{-- 3 --}}
        <div class="row">
          <div class="col-lg-6 col-12">
            <div class="choose-left">
              <h3>3. Pilih Jangka Waktu, Ubah Mata Uang, Ubah Menjadi Ascending</h3>
              <p>
                Setelah itu dapat memilih jangka waktu yang diinginkan maupun mata uang lain selain dolar 
                Amerika ($), tapi tidak semua aset kripto memiliki mata uang Indonesia (Rp) 
              </p>
              <b>
                <b style="color: red">Penting:</b> Ubah bagian Date agar data urut menjadi tanggal terlama (Awal) ke tanggal terbaru (Akhir) 
                atau bisa disebut Ascending
              </b>
              <br><br><br><br>
            </div>
          </div>

          <div class="col-lg-6 col-12">
            <div class="choose-right">
              <img src="images/petunjuk-impor-3.png" alt="#" />
            </div>
          </div>

        </div>
        {{-- 4 --}}
        <div class="row">
          <div class="col-lg-6 col-12">
            <div class="choose-left">
              <h3>4. Data Historis Yang Sudah Diatur</h3>
              <p>
                Contoh gambar disamping ini data telah diatur seperti mata uang USD, jangka waktu menjadi 
                01/01/2024 - 04/15/2025 dan kolom Date muncul baris pertama dari Jan 01, 2024 sampai Apr 15, 2025
              </p>
              <b>
                Atur agar kolom Date urut dari tanggal terlama (awal) hingga tanggal terbaru (akhir) untuk 
                untuk dapat dilakukan proses peramalan
              </b>
              <br><br><br><br>
            </div>
          </div>

          <div class="col-lg-6 col-12">
            <div class="choose-right">
              <img src="images/petunjuk-impor-4.png" alt="#" />
            </div>
          </div>

        </div>
        {{-- 5 --}}
        <div class="row">
          <div class="col-lg-6 col-12">
            <div class="choose-left">
              <h3>5. Download Data Historis Yang Sudah Diatur</h3>
              <p>
                Setelah itu klik download untuk mendownload data historis Bitcoin yang sudah diatur dengan 
                mata uang USD, jangka waktu 01/01/2024 - 04/15/2025, serta kolom Date urut Ascending
              </p>
              <p>
                Data historis yang diunduh ini berupa file format .csv, nantinya data ini dapat dilakukan 
                proses peramalan nantinya. Proses peramalan hanya melakukan unggahan data yang sudah diunduh sebelumnya.
              </p>
            </div>
          </div>

          <div class="col-lg-6 col-12">
            <div class="choose-right">
              <img src="images/petunjuk-impor-5.png" alt="#" />
            </div>
          </div>
        </div>
        {{-- 6 --}}
        <div class="row">
          <div class="col-lg-6 col-12">
            <div class="choose-left">
              <h3>6. Menuju Halaman Import Data CSV</h3>
              <p>
                Setelah itu data csv didapatkan lalu menuju ke Dasbor->Pengambilan Data->Import Data
              </p>
              <p>
                Data historis yang diunduh ini berupa file format .csv, nantinya data ini dapat dilakukan 
                proses peramalan nantinya. Proses peramalan hanya melakukan unggahan data yang sudah diunduh sebelumnya.
              </p>
            </div>
          </div>

          <div class="col-lg-6 col-12">
            <div class="choose-right">
              <img src="images/petunjuk-impor-5.png" alt="#" />
            </div>
          </div>
        </div>
        {{-- 7 --}}
        <div class="row">
          <div class="col-lg-6 col-12">
            <div class="choose-left">
              <h3>5. Download Data Historis Yang Sudah Diatur</h3>
              <p>
                Setelah itu klik download untuk mendownload data historis Bitcoin yang sudah diatur dengan 
                mata uang USD, jangka waktu 01/01/2024 - 04/15/2025, serta kolom Date urut Ascending
              </p>
              <p>
                Data historis yang diunduh ini berupa file format .csv, nantinya data ini dapat dilakukan 
                proses peramalan nantinya. Proses peramalan hanya melakukan unggahan data yang sudah diunduh sebelumnya.
              </p>
            </div>
          </div>

          <div class="col-lg-6 col-12">
            <div class="choose-right">
              <img src="images/petunjuk-impor-5.png" alt="#" />
            </div>
          </div>
        </div>
        {{-- 8 --}}
        <div class="row">
          <div class="col-lg-6 col-12">
            <div class="choose-left">
              <h3>5. Download Data Historis Yang Sudah Diatur</h3>
              <p>
                Setelah itu klik download untuk mendownload data historis Bitcoin yang sudah diatur dengan 
                mata uang USD, jangka waktu 01/01/2024 - 04/15/2025, serta kolom Date urut Ascending
              </p>
              <p>
                Data historis yang diunduh ini berupa file format .csv, nantinya data ini dapat dilakukan 
                proses peramalan nantinya. Proses peramalan hanya melakukan unggahan data yang sudah diunduh sebelumnya.
              </p>
            </div>
          </div>

          <div class="col-lg-6 col-12">
            <div class="choose-right">
              <img src="images/petunjuk-impor-5.png" alt="#" />
            </div>
          </div>
        </div>
        {{-- 9 --}}
        <div class="row">
          <div class="col-lg-6 col-12">
            <div class="choose-left">
              <h3>5. Download Data Historis Yang Sudah Diatur</h3>
              <p>
                Setelah itu klik download untuk mendownload data historis Bitcoin yang sudah diatur dengan 
                mata uang USD, jangka waktu 01/01/2024 - 04/15/2025, serta kolom Date urut Ascending
              </p>
              <p>
                Data historis yang diunduh ini berupa file format .csv, nantinya data ini dapat dilakukan 
                proses peramalan nantinya. Proses peramalan hanya melakukan unggahan data yang sudah diunduh sebelumnya.
              </p>
            </div>
          </div>

          <div class="col-lg-6 col-12">
            <div class="choose-right">
              <img src="images/petunjuk-impor-5.png" alt="#" />
            </div>
          </div>
        </div>
        {{-- 10 --}}
        <div class="row">
          <div class="col-lg-6 col-12">
            <div class="choose-left">
              <h3>5. Download Data Historis Yang Sudah Diatur</h3>
              <p>
                Setelah itu klik download untuk mendownload data historis Bitcoin yang sudah diatur dengan 
                mata uang USD, jangka waktu 01/01/2024 - 04/15/2025, serta kolom Date urut Ascending
              </p>
              <p>
                Data historis yang diunduh ini berupa file format .csv, nantinya data ini dapat dilakukan 
                proses peramalan nantinya. Proses peramalan hanya melakukan unggahan data yang sudah diunduh sebelumnya.
              </p>
            </div>
          </div>

          <div class="col-lg-6 col-12">
            <div class="choose-right">
              <img src="images/petunjuk-impor-5.png" alt="#" />
            </div>
          </div>
        </div>
        {{-- 11 --}}
        <div class="row">
          <div class="col-lg-6 col-12">
            <div class="choose-left">
              <h3>5. Download Data Historis Yang Sudah Diatur</h3>
              <p>
                Setelah itu klik download untuk mendownload data historis Bitcoin yang sudah diatur dengan 
                mata uang USD, jangka waktu 01/01/2024 - 04/15/2025, serta kolom Date urut Ascending
              </p>
              <p>
                Data historis yang diunduh ini berupa file format .csv, nantinya data ini dapat dilakukan 
                proses peramalan nantinya. Proses peramalan hanya melakukan unggahan data yang sudah diunduh sebelumnya.
              </p>
            </div>
          </div>

          <div class="col-lg-6 col-12">
            <div class="choose-right">
              <img src="images/petunjuk-impor-5.png" alt="#" />
            </div>
          </div>
        </div>
        {{-- 12 --}}
        <div class="row">
          <div class="col-lg-6 col-12">
            <div class="choose-left">
              <h3>5. Download Data Historis Yang Sudah Diatur</h3>
              <p>
                Setelah itu klik download untuk mendownload data historis Bitcoin yang sudah diatur dengan 
                mata uang USD, jangka waktu 01/01/2024 - 04/15/2025, serta kolom Date urut Ascending
              </p>
              <p>
                Data historis yang diunduh ini berupa file format .csv, nantinya data ini dapat dilakukan 
                proses peramalan nantinya. Proses peramalan hanya melakukan unggahan data yang sudah diunduh sebelumnya.
              </p>
            </div>
          </div>

          <div class="col-lg-6 col-12">
            <div class="choose-right">
              <img src="images/petunjuk-impor-5.png" alt="#" />
            </div>
          </div>
        </div>
      </div>
    </section>

    {{-- petunjuk data API --}}
    <section class="call-action-1 overlay" data-stellar-background-ratio="0.5">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 col-md-12 col-12">
            <div class="content">
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="why-choose section">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="section-title">
              <h2>Petunjuk Penggunaan Website Peramalan Harga Kripto Untuk Data API</h2>
              <img src="images/section-img.png" alt="#" />
              <p>
                Tingkat kesulitan: <a style="color: green">Sangat Mudah</a><br>
                Kelemahan: <a style="color: red">Data yang didapat terbatas</a>
              </p>
            </div>
          </div>
        </div>
        {{-- 1 --}}
        <div class="row">
          <div class="col-lg-6 col-12">
            <div class="choose-left">
              <h3>1. Ke Dasbor lalu Pilih Pengambilan Data lalu Pilih Data Dari API</h3>
              <p>
                Setelah berada di halaman dasbor, pilih menu Pengambilan Data lalu pilih Data Dari API
              </p>
              <p>
                Pada Data API ini kalian dapat melakukan proses peramalan dengan sangat mudah. Kalian hanya 
                perlu memilih kripto apa dan juga jangka waktunya. Setelah memilih akan menuju ke proses 
                berikutnya.
              </p>
            </div>
          </div>

          <div class="col-lg-6 col-12">
            <div class="choose-right">
              <img src="images/petunjuk-api-1.png" alt="#" />
            </div>
          </div>

        </div>
         {{-- 2 --}}
         <div class="row">
          <div class="col-lg-6 col-12">
            <div class="choose-left">
              <h3>2. Setelah itu Klik Tombol Pilih</h3>
              <p>
                Setelah dipastikan memilih kripto yang ingin dilakukan proses peramalan dan jangka waktunya 
                lalu klik tombol Pilih berwarna biru.
              </p>
              <p>
                Pada proses ini data yang sudah dipilih akan disimpan dan nantinya data ini akan dilakukan 
                proses peramalan.
              </p>
            </div>
          </div>

          <div class="col-lg-6 col-12">
            <div class="choose-right">
              <img src="images/petunjuk-api-2.png" alt="#" />
            </div>
          </div>

        </div>
      </div>
    </section>

    {{-- balik atau ke dasbor --}}
    <section class="pricing-table section">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="section-title">
              <h2>Udah paham kah? kalo udah paham, gas lakuin peramalannya</h2>
              <img src="images/section-img.png" alt="#" />
            </div>
          </div>
        </div>
        <div class="row">
          <!-- Table -->
          <div class="col-lg-6 col-md-12 col-12">
            <div class="single-table">
              <div class="table-head">
                <div class="icon" style="display: flex; align-items: center; justify-content: center; gap: 15px;">
                  <a href="{{ route('awal') }}">
                    <i class="icofont icofont-circled-left" style="cursor: pointer;"></i>
                  </a>                  
                  
                  <span style="font-size: 20px; font-weight: bold; color: #808080; position: relative; top: -2px;"                  >
                    atau
                  </span>
                  
                  <a href="#top" onclick="scrollToTop(event)">
                    <i 
                      class="icofont icofont-circled-up" 
                      style="cursor: pointer;"
                    ></i>
                  </a>
                </div>
                
                <h4 class="title">Ndak paham ni</h4>
              </div>
              <ul class="table-list">
                <li class="cross">
                  <i class="icofont icofont-thumbs-down"></i>Masih ndak paham, ya mungkin ini bukan buatmu 😅
                </li>
                <li class="cross">
                  {{-- <i class="icofont icofont-thumbs-down"></i>Cupu detected! 🚨 --}}
                  <i class="icofont icofont-thumbs-down"></i> detected! 🚨
                </li>
                <li class="cross">
                  <i class="icofont icofont-thumbs-down"></i>Baca lagi dari atas (bisa pake button kanan bawah otomatis keatas) 🫠
                </li>
                <li class="cross">
                  {{-- <i class="icofont icofont-thumbs-down"></i>cupu-cupu 😩 --}}
                  <i class="icofont icofont-thumbs-down"></i>Huhuhuhu 😩
                </li>
                <li class="cross">
                  <i class="icofont icofont-thumbs-down"></i>Kalo masih ndak paham, ndak usah lanjut dah 😏
                </li>
                <li class="cross">
                  <i class="icofont icofont-thumbs-down"></i>Dah balik aja ndak usah kesini 😩
                </li>
                <li><p style="font-size: 9px"></p></li>
              </ul>
              <div class="table-bottom">
                <a class="btn" href="{{ route('awal') }}">Balik</a>
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
                <h4 class="title">Udah paham nih bos</h4>
              </div>
              <ul class="table-list">
                <p>Kalo udah paham, lanjut ke dasbor yang isinya</p>
                <p  style="margin-bottom: 15px">isinya itu</p>
                <li>
                  <i class="icofont icofont-ui-check"></i>Ya Dasbor Dong 😏
                </li>
                <li>
                  <i class="icofont icofont-ui-check"></i>Ambil Data dari API (kalo males impor) 🤓
                </li>
                <li>
                  <i class="icofont icofont-ui-check"></i>Impor Data (khusus yang jago aja) 🤠
                </li>
                <li>
                  <i class="icofont icofont-ui-check"></i>Proses Peramalannya 😏
                </li>
                <li>
                  <i class="icofont icofont-ui-check"></i>Hasilnya dong, pasti 😎
                </li>
              </ul>
              <div class="table-bottom">
                <a class="btn" href="{{ route('dashboard') }}">Meluncur Ke Dasbor Boskuh</a>
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
    <script src="source/js/jquery.min.js"></script>
    <!-- jquery Migrate JS -->
    <script src="source/js/jquery-migrate-3.0.0.js"></script>
    <!-- jquery Ui JS -->
    <script src="source/js/jquery-ui.min.js"></script>
    <!-- Easing JS -->
    <script src="source/js/easing.js"></script>
    <!-- Color JS -->
    <script src="source/js/colors.js"></script>
    <!-- Popper JS -->
    <script src="source/js/popper.min.js"></script>
    <!-- Bootstrap Datepicker JS -->
    <script src="source/js/bootstrap-datepicker.js"></script>
    <!-- Jquery Nav JS -->
    <script src="source/js/jquery.nav.js"></script>
    <!-- Slicknav JS -->
    <script src="source/js/slicknav.min.js"></script>
    <!-- ScrollUp JS -->
    <script src="source/js/jquery.scrollUp.min.js"></script>
    <!-- Niceselect JS -->
    <script src="source/js/niceselect.js"></script>
    <!-- Tilt Jquery JS -->
    <script src="source/js/tilt.jquery.min.js"></script>
    <!-- Owl Carousel JS -->
    <script src="source/js/owl-carousel.js"></script>
    <!-- counterup JS -->
    <script src="source/js/jquery.counterup.min.js"></script>
    <!-- Steller JS -->
    <script src="source/js/steller.js"></script>
    <!-- Wow JS -->
    <script src="source/js/wow.min.js"></script>
    <!-- Magnific Popup JS -->
    <script src="source/js/jquery.magnific-popup.min.js"></script>
    <!-- Counter Up CDN JS -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/waypoints/2.0.3/waypoints.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="source/js/bootstrap.min.js"></script>
    <!-- Main JS -->
    <script src="source/js/main.js"></script>
    <script>
      function scrollToTop(e) {
        e.preventDefault();
        window.scrollTo({ top: 0, behavior: 'smooth' });
      }
    </script>
  </body>
</html>
