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
    <link rel="icon" href="{{ asset('images/Logo.webp') }}" />
    <link rel="icon" href="{{ asset('images/Logo_icon.webp') }}" />

    <!-- Google Fonts -->
    <link
      href="https://fonts.googleapis.com/css?family=Poppins:200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap"
      rel="stylesheet"
    />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('source/css/bootstrap.min.css') }}" />
    <!-- Nice Select CSS -->
    <link rel="stylesheet" href="{{ asset('source/css/nice-select.css') }}" />
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="{{ asset('source/css/font-awesome.min.css') }}" />
    <!-- icofont CSS -->
    <link rel="stylesheet" href="{{ asset('source/css/icofont.css') }}" />
    <!-- Slicknav -->
    <link rel="stylesheet" href="{{ asset('source/css/slicknav.min.css') }}" />
    <!-- Owl Carousel CSS -->
    <link rel="stylesheet" href="{{ asset('source/css/owl-carousel.css') }}" />
    <!-- Datepicker CSS -->
    <link rel="stylesheet" href="{{ asset('source/css/datepicker.css') }}" />
    <!-- Animate CSS -->
    <link rel="stylesheet" href="{{ asset('source/css/animate.min.css') }}" />
    <!-- Magnific Popup CSS -->
    <link rel="stylesheet" href="{{ asset('source/css/magnific-popup.css') }}" />

    <!-- Medipro CSS -->
    <link rel="stylesheet" href="{{ asset('source/css/normalize.css') }}" />
    <link rel="stylesheet" href="{{ asset('source/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('source/css/responsive.css') }}" />
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
                  <a href="/"><img src="{{ asset('images/Logo.webp') }}" alt="Tempat logo" style="height: 55px; width: 180px;"/></a>
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

    <div class="breadcrumbs overlay">
			<div class="container">
				<div class="bread-inner">
					<div class="row">
						<div class="col-12">
							<h2>Petunjuk Penggunaan</h2>
							<ul class="bread-list">
								<li><a href="/">Home</a></li>
								<li><i class="icofont-simple-right"></i></li>
								<li class="active">Petunjuk Penggunaan</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>

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
              <img src="images/petunjuk-impor-1.webp" alt="#" />
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
              <img src="images/petunjuk-impor-2.webp" alt="#" />
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
              <img src="images/petunjuk-impor-3.webp" alt="#" />
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
              <br><br><br><br><br>
            </div>
          </div>

          <div class="col-lg-6 col-12">
            <div class="choose-right">
              <img src="images/petunjuk-impor-4.webp" alt="#" />
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
              </p><br>
            </div>
          </div>

          <div class="col-lg-6 col-12">
            <div class="choose-right">
              <img src="images/petunjuk-impor-5.webp" alt="#" />
            </div>
          </div>
        </div>
        {{-- 6 --}}
        <div class="row">
          <div class="col-lg-6 col-12">
            <div class="choose-left">
              <h3>6. Menuju Halaman Import Data CSV</h3>
              <p>
                Setelah itu data csv didapatkan lalu menuju ke <strong>Dasbor➡️Pengambilan Data➡️Import Data➡️Mulai Impor Data</strong>
              </p>
              <p>
                Ikuti langkah-langkahnya agar dapat menuju ke halaman import data csv dari <a href="investing.com" target="_blank">investing.com</a> 
                jangan lupa data csv harus sudah ada agar bisa melakukan import data.
              </p><br><br>
            </div>
          </div>

          <div class="col-lg-6 col-12">
            <div class="choose-right">
              <img src="images/petunjuk-impor-6.webp" alt="#" />
            </div>
          </div>
        </div>
        {{-- 7 --}}
        <div class="row">
          <div class="col-lg-6 col-12">
            <div class="choose-left">
              <h3>7. Melakukan Import Data CSV</h3>
              <p>
                Setelah itu masukkan nama kripto, jangka waktu data historis, dan file csv data historis kripto yang sudah diunduh
                sebelumnya.
              </p>
              <p>
                Pastikan bahwa semua diisi, jika ada satu yang kosong nanti akan error. Setelah itu klik tombol Import Filenya. Mungkin 
                proses akan lama, tergantung dari jumlah data historis yang sudah di unduh sebelumnya. 
              </p><br><br>
            </div>
          </div>

          <div class="col-lg-6 col-12">
            <div class="choose-right">
              <img src="images/petunjuk-impor-7.webp" alt="#" />
            </div>
          </div>
        </div>
        {{-- 8 --}}
        <div class="row">
          <div class="col-lg-6 col-12">
            <div class="choose-left">
              <h3>8. Data CSV Akan Tampil</h3>
              <p>
                Setelah menunggu proses import, data akan tampil dalam bentuk tabel yang terdiri dari kolom Date, Price, Open, High 
                Low, Vol., Change% dan juga ada beberapa informasi yang dapat dilihat.
              </p>
              <p>
                Penjelasan mengenai kegunaan kolom-kolom dapat dilihat dibawah tabel.
              </p><br><br><br>
            </div>
          </div>

          <div class="col-lg-6 col-12">
            <div class="choose-right">
              <img src="images/petunjuk-impor-8.webp" alt="#" />
            </div>
          </div>
        </div>
        {{-- 9 --}}
        <div class="row">
          <div class="col-lg-6 col-12">
            <div class="choose-left">
              <h3>9. Melakukan Pra Proses Data Historis</h3>
              <p>
                Setelah itu klik tombol Pra-Proses Data Kripto untuk mengambil kolom Date dan Price, melakukan standarisasi tanggal, 
                penanganan data hilang, dan yang lainnya.
              </p>
              <p>
                Pra-Proses akan dilakukan oleh sistem, jangan lupa klik tombol "Ya". Kalau tidak maka data nantinya belum bisa dilakukan peramalan. 
                Pra-Proses ini mungkin akan memakan waktu 5 detik, harap bersabar ya!
              </p><br>
            </div>
          </div>

          <div class="col-lg-6 col-12">
            <div class="choose-right">
              <img src="images/petunjuk-impor-9.webp" alt="#" />
            </div>
          </div>
        </div>
        {{-- 10 --}}
        <div class="row">
          <div class="col-lg-6 col-12">
            <div class="choose-left">
              <h3>10. Melakukan Proses Peramalan Data Historis</h3>
              <p>
                Setelah itu klik tombol "Proses Peramalan Kripto" untuk melakukan proses peramalan data historis kripto.
              </p>
              <p>
                Sama seperti Pra-Proses, jangan lupa menekan tombol "Iya Dong!" untuk melakukan prosesnya.
              </p><br><br><br>
            </div>
          </div>

          <div class="col-lg-6 col-12">
            <div class="choose-right">
              <img src="images/petunjuk-impor-10.webp" alt="#" />
            </div>
          </div>
        </div>
        {{-- 11 --}}
        <div class="row">
          <div class="col-lg-6 col-12">
            <div class="choose-left">
              <h3>11. Tadaa Hasil Peramalan Dapat Dilihat</h3>
              <p>
                Hasil peramalan akan tampil berupa grafik dan juga tabel. Terdapat beberapa informasi mengenai hasil peramalannya. 
                Jadi harap dibaca dan dimengerti.
              </p>
              <p>
                Mengingat volatilitas pasar kripto yang sangat tinggi dan dipengaruhi oleh berbagai faktor eksternal, 
                maka hasil peramalan ini tidak bersifat prediktif absolut. Hasil yang disajikan hanya dimaksudkan 
                sebagai referensi tambahan (insight), bukan sebagai saran finansial.
              </p><br><br><br>
            </div>
          </div>

          <div class="col-lg-6 col-12">
            <div class="choose-right">
              <img src="images/petunjuk-impor-11.webp" alt="#" />
            </div>
          </div>
        </div>
        {{-- 12 --}}
        <div class="row">
          <div class="col-lg-6 col-12">
            <div class="choose-left">
              <h3>12. Melakukan Peramalan Dengan Data Lain</h3>
              <p>
                Jika ingin melakukan peramalan dengan data historis kripto yang lain. Jangan lupa untuk menghapus data yang 
                berada di halaman Hasil Peramalan dan Import Data CSV. Setelah itu ulangi langkah-langkahnya.
              </p>
              <p>
                Jika data yang sebelumnya masih ada, maka tidak dapat dilakukan peramalan, karena akan menyebabkan error pada sistem. 
              </p>
            </div>
          </div>

          <div class="col-lg-6 col-12">
            <div class="choose-right">
              <img src="images/petunjuk-impor-12.webp" alt="#" />
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
              <h3>1. Menuju Ke Halaman Data API</h3>
              <p>
                Mmenuju ke Dasbor➡️Pengambilan Data➡️Data API➡️Pilih Data Kripto
              </p>
              <p>
                Pada halaman data API ini kalian tinggal memilih kripto apa yang di inginkan. Tapi data API ini hanya menyediakan maksimum 
                720 data historis kripto saja.
              </p><br><br><br>
            </div>
          </div>

          <div class="col-lg-6 col-12">
            <div class="choose-right">
              <img src="images/petunjuk-api-1.webp" alt="#" />
            </div>
          </div>
        </div>
        {{-- 2 --}}
        <div class="row">
          <div class="col-lg-6 col-12">
            <div class="choose-left">
              <h3>2. Isi Data Kripto Yang Di Inginkan</h3>
              <p>
                Setelah itu pilih kripto, jenis data, dan jangka waktunya. Santai saja jika memilih jenis data harian ini sudah dibatasi 
                sebanyak 720, jadi jangan takut jika jangka waktu yang dipilih melebihi 720 data. Jangan lupa untuk klik Pilih Kripto 
                (Disarankan memilih data harian)
              </p>
              <p>
                Perlu diingat bahwa mungkin saja terdapat kesalahan penamaan nama kripto, karena penamaan dilakukan secara manual soalnya 
                penyedia API yaitu Kraken API tidak menyediakan nama asli kriptonya. Proses mungkin agak lama, jadi mohon bersabar ya!
              </p>
            </div>
          </div>

          <div class="col-lg-6 col-12">
            <div class="choose-right">
              <img src="images/petunjuk-api-2.webp" alt="#" />
            </div>
          </div>
        </div>
        {{-- 3 --}}
        <div class="row">
          <div class="col-lg-6 col-12">
            <div class="choose-left">
              <h3>3. API Akan Tampil</h3>
              <p>
                Data kripto dari API yang sudah dipilih akan tampil dalam bentuk tabel. Untuk penjelasan kolom-kolomnya ada dibawah tabel ya!.
              </p>
              <p>
                Pada proses ini data yang sudah dipilih akan disimpan dan nantinya data ini akan dilakukan 
                proses peramalan.
              </p><br><br><br>
            </div>
          </div>

          <div class="col-lg-6 col-12">
            <div class="choose-right">
              <img src="images/petunjuk-api-3.webp" alt="#" />
            </div>
          </div>
        </div>
        {{-- 4 --}}
        <div class="row">
          <div class="col-lg-6 col-12">
            <div class="choose-left">
              <h3>4. Melakukan Pra Proses Data Historis</h3>
              <p>
                Setelah itu klik tombol Pra-Proses Data Kripto untuk mengambil kolom Date dan Price, melakukan standarisasi tanggal, 
                penanganan data hilang, dan yang lainnya.
              </p>
              <p>
                Pra-Proses akan dilakukan oleh sistem, jangan lupa klik tombol "Ya". Kalau tidak maka data nantinya belum bisa dilakukan peramalan. 
                Pra-Proses ini mungkin akan memakan waktu 5 detik, harap bersabar ya!
              </p><br>
            </div>
          </div>

          <div class="col-lg-6 col-12">
            <div class="choose-right">
              <img src="images/petunjuk-api-4.webp" alt="#" />
            </div>
          </div>
        </div>
        {{-- 5 --}}
        <div class="row">
          <div class="col-lg-6 col-12">
            <div class="choose-left">
              <h3>5. Melakukan Proses Peramalan Data Historis</h3>
              <p>
                Setelah itu klik tombol "Proses Peramalan Kripto" untuk melakukan proses peramalan data historis kripto.
              </p>
              <p>
                Sama seperti Pra-Proses, jangan lupa menekan tombol "Iya Dong!" untuk melakukan prosesnya.
              </p><br><br><br>
            </div>
          </div>

          <div class="col-lg-6 col-12">
            <div class="choose-right">
              <img src="images/petunjuk-api-5.webp" alt="#" />
            </div>
          </div>
        </div>
        {{-- 6 --}}
        <div class="row">
          <div class="col-lg-6 col-12">
            <div class="choose-left">
              <h3>6. Tadaa Hasil Peramalan Dapat Dilihat</h3>
              <p>
                Hasil peramalan akan tampil berupa grafik dan juga tabel. Terdapat beberapa informasi mengenai hasil peramalannya. 
                Jadi harap dibaca dan dimengerti.
              </p>
              <p>
                Mengingat volatilitas pasar kripto yang sangat tinggi dan dipengaruhi oleh berbagai faktor eksternal, 
                maka hasil peramalan ini tidak bersifat prediktif absolut. Hasil yang disajikan hanya dimaksudkan 
                sebagai referensi tambahan (insight), bukan sebagai saran finansial.
              </p><br><br><br>
            </div>
          </div>

          <div class="col-lg-6 col-12">
            <div class="choose-right">
              <img src="images/petunjuk-api-6.webp" alt="#" />
            </div>
          </div>
        </div>
        {{-- 7 --}}
        <div class="row">
          <div class="col-lg-6 col-12">
            <div class="choose-left">
              <h3>7. Melakukan Peramalan Dengan Data Lain</h3>
              <p>
                Jika ingin melakukan peramalan dengan data historis kripto yang lain. Jangan lupa untuk menghapus data yang 
                berada di halaman Hasil Peramalan dan Data API. Setelah itu ulangi langkah-langkahnya.
              </p>
              <p>
                Jika data yang sebelumnya masih ada, maka tidak dapat dilakukan peramalan, karena akan menyebabkan error pada sistem. 
              </p>
            </div>
          </div>

          <div class="col-lg-6 col-12">
            <div class="choose-right">
              <img src="images/petunjuk-api-7.webp" alt="#" />
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
              <h2>Kalau sudah jelas</h2>
              <h2> yuk lanjut ke peramalannya!</h2>
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
                <a class="btn" href="{{ route('awal') }}">Kabuuuurrrr</a>
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
                <p>Kalo udah paham, lanjut ke dasbor yang </p>
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
              <div class="table-bottom" style="margin-top: 45px">
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
    <script src="{{ asset('source/js/jquery.min.js') }}"></script>
    <!-- jquery Migrate JS -->
    <script src="{{ asset('source/js/jquery-migrate-3.0.0.js') }}"></script>
    <!-- jquery Ui JS -->
    <script src="source/js/jquery-ui.min.js"></script>
    <!-- Easing JS -->
    <script src="{{ asset('source/js/easing.js') }}"></script>
    <!-- Color JS -->
    <script src="{{ asset('source/js/colors.js') }}"></script>
    <!-- Popper JS -->
    <script src="{{ asset('source/js/popper.min.js') }}"></script>
    <!-- Bootstrap Datepicker JS -->
    <script src="{{ asset('source/js/bootstrap-datepicker.js') }}"></script>
    <!-- Jquery Nav JS -->
    <script src="{{ asset('source/js/jquery.nav.js') }}"></script>
    <!-- Slicknav JS -->
    <script src="{{ asset('source/js/slicknav.min.js') }}"></script>
    <!-- ScrollUp JS -->
    <script src="{{ asset('source/js/jquery.scrollUp.min.js') }}"></script>
    <!-- Niceselect JS -->
    <script src="{{ asset('source/js/niceselect.js') }}"></script>
    <!-- Tilt Jquery JS -->
    <script src="{{ asset('source/js/tilt.jquery.min.js') }}"></script>
    <!-- Owl Carousel JS -->
    <script src="{{ asset('source/js/owl-carousel.js') }}"></script>
    <!-- counterup JS -->
    <script src="{{ asset('source/js/jquery.counterup.min.js') }}"></script>
    <!-- Steller JS -->
    <script src="{{ asset('source/js/steller.js') }}"></script>
    <!-- Wow JS -->
    <script src="{{ asset('source/js/wow.min.js') }}"></script>
    <!-- Magnific Popup JS -->
    <script src="{{ asset('source/js/jquery.magnific-popup.min.js') }}"></script>
    <!-- Counter Up CDN JS -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/waypoints/2.0.3/waypoints.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="{{ asset('source/js/bootstrap.min.js') }}"></script>
    <!-- Main JS -->
    <script src="{{ asset('source/js/main.js') }}"></script>
    <script>
      function scrollToTop(e) {
        e.preventDefault();
        window.scrollTo({ top: 0, behavior: 'smooth' });
      }
    </script>
  </body>
</html>
