<!DOCTYPE html>
<html lang="en">
    @include('partials.header')
    <title>ForesightFluxCP | FaQ Pertanyaan Yang Sering Ditanyakan</title>

    <body>
        @include('partials.navbar')
        <div class="wrapper">

            <div class="page-title-box">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="state-information d-none d-sm-block">
                                <div class="state-graph">
                                    <div id="header-chart-1"></div>
                                    <div class="info">Bitcoin</div>
                                </div>
                                {{-- <div class="state-graph">
                                    <div id="header-chart-2"></div>
                                    <div class="info">Item Sold 1230</div>
                                </div> --}}
                            </div>
                            
                            <h4 class="page-title">FaQ Pertanyaan Yang Sering Ditanyakan</h4>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item active">Berisikan pertanyaan-pertanyaan yang sering ditanyakan mengenai website ini</li>
                                {{-- <li class="breadcrumb-item active">Selamat datang di ForesightFluxCP</li> --}}
                            </ol>
                            <a id="datetime" class="breadcrumb-item active" style="color: #9e9e9e"></a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="page-content-wrapper">
                <div class="container-fluid">
                    {{-- baris pertama PERINGATAN --}}
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h3 class="mt-0 header-title">Beberapa Note:</h3>
                                            <ul class="mb-0">
                                                <li><strong>⚠️ Titik sebagai pembacaan nilai desimal, sedangkan koma untuk pemisah ribuan.</strong></li>
                                                <li><strong>📌 Hasil peramalan ini bersifat informatif saja</strong>, bukan sebagai patokan pasti untuk membeli atau menjual kripto.</li>
                                                <li><strong>📈 Akurasi peramalan dapat berubah</strong> tergantung dari data sebelumnya dan pola pergerakan pasar yang tidak selalu konsisten.</li>
                                                <li><strong>💡 Gunakan hasil prediksi sebagai bahan pertimbangan tambahan</strong>, bukan satu-satunya dasar untuk pengambilan keputusan.</li>
                                                <li><strong>🌍 Hasil ini tidak mempertimbangkan faktor eksternal seperti kebijakan ekonomi, sentimen pasar, isu geopolitik, </strong> yang sebenarnya bisa sangat memengaruhi naik turunnya harga kripto.</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- baris kedua --}}
                    <h5>📡 Pertanyaan Mengenai Data API</h5>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="card m-b-30">
                                <div class="card-body">
                                    <blockquote class="card-blockquote mb-0">
                                        <p>Kenapa hanya maksimal 720 data saja?🤔</p>
                                        <footer class="blockquote-footer font-12">
                                            karena data dari API (Kraken API) hanya menyediakan data harian maupun mingguan itu maksimal 720 data saja.
                                            <footer class="blockquote-footer font-12">
                                                <a href="https://docs.kraken.com/api/docs/rest-api/get-ohlc-data/" target="__blank" style="color: rgb(0, 170, 255)">kraken API</a>
                                                menjelaskan bahwa <cite title="Source Title">"Returns up to 720 of the most recent entries (older data cannot be retrieved, regardless of the value of since)."</cite>
                                            </footer>
                                        </footer>
                                        <br><br>
                                    </blockquote>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card m-b-30">
                                <div class="card-body">
                                    <blockquote class="card-blockquote mb-0">
                                        <p>Nama kripto kemungkinan tidak sesuai!😱</p>
                                        <footer class="blockquote-footer font-12">
                                            Kenapa?, karena pada Kraken API ini hanya memiliki id (atau pair) untuk proses pengambilan datanya.
                                            <footer class="blockquote-footer font-12">
                                                Contoh XXBTZUSD, ini adalah id (pair) untuk kripto Bitcoin.
                                                Contoh lainnya XETHZUSD, ini adalah id (pair) untuk kripto Ethereum. 
                                                Juga ada ETCUSD ini adalah id (pair) untuk kripto Ethereum classic. 
                                            </footer>
                                        </footer>
                                        <br>
                                    </blockquote>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card m-b-30">
                                <div class="card-body">
                                    <h6 class="card-subtitle font-14 text-muted">Error saat ingin memilih kripto 😤👿</h6>
                                </div>
                                <img class="img-fluid" src="images/error-api-1.png" alt="Card image cap">
                                <div class="card-body">
                                    <p class="card-text">Jika terjadi error seperti itu, harap untuk merefresh halaman.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- baris ketiga --}}
                    <h5>🖨 Pertanyaan Mengenai Import Data</h5>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="card m-b-30">
                                <div class="card-body">
                                    <blockquote class="card-blockquote mb-0">
                                        <p>Mengapa data csv hanya dari investing?😠</p>
                                        <footer class="blockquote-footer font-12">
                                            Karena <a href="investing.com" style="color: rgb(0, 170, 255)" target="__blank">investing</a> 
                                            ini mudah untuk melakukan navigasi, terdapat sorting tanggal,
                                            fleksibel, dan memiliki berbagai macam kurs IDR untuk beberapa kripto populer. 😎😤
                                        </footer>
                                    </blockquote>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card m-b-30">
                                <div class="card-body">
                                    <blockquote class="card-blockquote mb-0">
                                        <p>kenapa hanya file csv saja yang bisa digunakan? 🥴</p>
                                        <footer class="blockquote-footer font-12">
                                            Yaaa, karena data dari <a href="investing.com" style="color: rgb(0, 170, 255)" target="__blank">investing</a>
                                            ini itu csv. 🤯<br>
                                            <footer class="blockquote-footer font-12">
                                                Biar kalian juga ndak impor file-file aneh lainnya.😉
                                            </footer>
                                        </footer>
                                    </blockquote>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card m-b-30">
                                <div class="card-body">
                                    <blockquote class="card-blockquote mb-0">
                                        <p>Saya sudah import csv tapi kenapa tetap error? 😡</p>
                                        <footer class="blockquote-footer font-12">
                                            Karena formatnya salah, kalau format csv itu diambil dari web lain yang tidak sesuai dengan format dari 
                                            <a href="investing.com" style="color: rgb(0, 170, 255)" target="__blank">investing</a> yaaa! 🤓
                                        </footer>
                                    </blockquote>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- baris keempat --}}
                    <h5>⏳ Pertanyaan Mengenai Pra Proses Data</h5>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="card m-b-30">
                                <div class="card-body">
                                    <blockquote class="card-blockquote mb-0">
                                        <p>Mengapa perlu dilakukan pra proses data? 👺</p>
                                        <footer class="blockquote-footer font-12">
                                            Agar proses pada sistem itu tidak memakan waktu yang cukup lama. Memangnya mau menunggu ±5 menit 
                                            untuk proses peramalannya? 🧐
                                        </footer>
                                    </blockquote>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card m-b-30">
                                <div class="card-body">
                                    <blockquote class="card-blockquote mb-0">
                                        <p>Pra proses data ini ngapain aja sii?</p>
                                        <footer class="blockquote-footer font-12">
                                            Rahasia dooonggggg. Kepo yaaaa?😂😂🤣🤣
                                        </footer>
                                    </blockquote>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card m-b-30">
                                <div class="card-body">
                                    <blockquote class="card-blockquote mb-0">
                                        <p>Nggak bisa skip aja kah pra proses datanya?</p>
                                        <footer class="blockquote-footer font-12">
                                            Ndak boleh dongg. Kalo data belum di pra proses, maka data tidak bisa dilakukan peramalan. 🙂🙃
                                        </footer>
                                    </blockquote>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- baris kelima --}}
                    <h5>🎖 Pertanyaan Mengenai Hasil Peramalan</h5>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="card m-b-30">
                                <div class="card-body">
                                    <blockquote class="card-blockquote mb-0">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere
                                            erat a ante.</p>
                                        <footer class="blockquote-footer font-12">
                                            Someone famous in <cite title="Source Title">Source Title</cite>
                                        </footer>
                                    </blockquote>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4" >
                            <div class="card m-b-30" >
                                <div class="card-body">
                                    <blockquote class="card-blockquote mb-0">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere
                                            erat a ante.</p>
                                        <footer class="blockquote-footer font-12">
                                            Someone famous in <cite title="Source Title">Source Title</cite>
                                        </footer>
                                    </blockquote>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card m-b-30">
                                <div class="card-body">
                                    <blockquote class="card-blockquote mb-0">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere
                                            erat a ante.</p>
                                        <footer class="blockquote-footer font-12">
                                            Someone famous in <cite title="Source Title">Source Title</cite>
                                        </footer>
                                    </blockquote>
                                </div>
                            </div>
                        </div>
                    </div>
                    

                </div>
            </div>
        </div>

        @include('partials.footer')
        @include('partials.scripts')

        
    </body>

</html>