<!DOCTYPE html>
<html lang="en">
    @include('partials.header')
    <title>ForesightFluxCP | Input Data API</title>
    <style>
        .text-green {
            color: green;
            font-weight: bold;
        }
        .text-red {
            color: red;
            font-weight: bold;
        }
        .date-range-group {
            display: flex;
            align-items: center;
        }

        .date-separator {
            margin: 0 10px;
            font-weight: bold;
            font-size: 1.2rem;
        }

    </style>      

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
                            
                            <h4 class="page-title">Input Data API</h4>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                  <a href="{{ route('data.dataAPI') }}" style="text-decoration: underline">Data API</a>
                                </li>
                                <li class="breadcrumb-item">
                                  <a href="{{ route('data.inputDataAPI') }}" style="text-decoration: underline">Input Data</a>
                                </li>
                            </ol>

                            <ol class="breadcrumb">
                                <li class="breadcrumb-item active">Mengambil Data Historis Kripto Melalui API, Data Yang Sudah Dipilih Akan Disimpan Untuk Nantinya Dilakukan Pra-Proses</li>
                            </ol>
                            <a id="datetime" class="breadcrumb-item active" style="color: #9e9e9e"></a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="page-content-wrapper">
                <div class="container-fluid">
                    {{-- baris pertama, tabel --}}
                    <div class="d-flex justify-content-center">
                        <div class="col-xl-6">
                            <div class="card" style="margin-top: 20px;">
                                <div class="card-body px-2">
                                    <div class="alert-danger text-center">
                                        <h6 class="mt-0 header-title" style="font-size: 14px">🚨Kemungkinan Nama Kripto Tidak Sesuai, Karena Dari API Tidak Menyediakan Nama Asli Kripto⚠️</h6>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="card" style="margin-top: 20px; min-height: 420px;">
                                <div class="card-body px-5 py-4">
                                    @if(session('error'))
                                        <div class="alert alert-danger" role="alert" style="text-align: center">
                                            {{ session('error') }}
                                        </div>
                                    @endif
                                    @if ($errors->any())
                                        <div class="alert alert-danger" style="text-align: center">
                                            @foreach ($errors->all() as $err)
                                                {{ $err }}
                                            @endforeach
                                        </div>
                                    @endif

                                    <div style="margin-top: 10px">
                                        <div class="text-center mb-4">
                                            <h4 class="mt-0 header-title">Pilih Data Historis Kripto Untuk Dilakukan Peramalan Nantinya</h4>
                                        </div>
                                    </div>
                    
                                    <form action="{{ route('data.postDataAPI') }}" method="POST" enctype="multipart/form-data" id="apiData">
                                        @csrf
                                        {{-- Pilih Kripto --}}
                                        <div style="margin-top: 50px">
                                            <div class="form-group mb-4">
                                                <label class="control-label font-weight-bold">Pilih Kripto</label>
                                                <select name="crypto_pair" id="crypto_pair" class="form-control form-control-lg select2" required>
                                                    <option selected disabled>--- Kripto Populer ---</option>
                                                    <option value="XXBTZUSD">Bitcoin (BTC) to USD</option>
                                                    <option value="ETCUSD">Ethereum Classic (ETC) to USD</option>
                                                    <option value="XETHZUSD">Ethereum (ETH) to USD</option>
                                                    <option value="XLTCZUSD">Litecoin (LTC) to USD</option>
                                                    <option value="XDGUSD">Dogecoin (DOGE) (XDG) to USD</option>
                                                    <option value="XCNUSD">Onyxcoin (XCN) to USD</option>
                                                    <option value="MLNUSD">Enzyme (MLN) to USD</option>
                                                    <option value="REPUSD">Augur (REP) to USD</option>
                                                    <option value="SOLUSD">Solana (SOL) to USD</option>
                                                    <option value="PONKEUSD">Ponke SOL (PONKE) to USD</option>
                                                    <option value="POPCATUSD">Popcat SOL (POPCAT) to USD</option>
                                                    <option selected disabled>--- Pilih Kripto Lain ---</option>
                                                    @foreach ($cryptoPairs as $key => $pair)
                                                        @php
                                                            $displayName = $cryptoNames[$key] ?? $pair['wsname'] ?? $key;
                                                        @endphp
                                                        <option value="{{ $key }}" data-display="{{ $displayName }}">
                                                            {{ $displayName }}
                                                        </option>
                                                    @endforeach
                                                    {{-- <option value="XBTUSD">Bitcoin (BTC/USD)</option>
                                                    <option value="ETHUSD">Ethereum (ETH/USD)</option>
                                                    <option value="ADAUSD">Cardano (ADA/USD)</option> --}}
                                                </select>                                                                                                                                                                                           
                                            </div>
                                        </div>

                                        {{-- Jangka Waktu --}}
                                        <div class="form-group mb-4">
                                            <label class="font-weight-bold">Jangka Waktu</label>
                                            <div class="d-flex align-items-center">
                                                <div class="input-group date-range-group">
                                                    <input type="date" name="date-start" id="date-start" class="form-control floating-label" placeholder="awal" />
                                                    <span class="date-separator">–</span>
                                                    <input type="date" name="date-end" id="date-end" class="form-control floating-label" placeholder="akhir" />
                                                </div>
                                            </div>
                                        </div>

                                        <input type="hidden" name="sumber" value="API" />
                                        {{-- Tombol --}}
                                        <div style="margin-top: 50px">
                                            <button type="submit" class="btn btn-primary btn-lg btn-block mt-3 py-2" >
                                                Pilih Kripto
                                            </button>
                                        </div>
                                        <div style="margin-top: 20px">
                                            <a href="{{ route('data.dataAPI') }}" class="btn btn-outline-secondary btn-lg btn-block mt-3 py-2" >
                                                Balik, ndak jadi
                                            </a>
                                        </div>
                                    </form>
                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('partials.footer')
        @include('partials.scripts')
        <script src="{{ asset('pages/form-advanced.js') }}"></script>

        <script>
            document.getElementById("apiData").addEventListener("submit", function(event) {
                event.preventDefault();  // Mencegah reload halaman otomatis
                
                // Menampilkan SweetAlert2 loading
                Swal.fire({
                    title: 'Ambil Data API...',
                    text: 'Sabar ya kalo lama prosesnya 😅',
                    allowOutsideClick: false,
                    showConfirmButton: false,
                    didOpen: () => {
                        Swal.showLoading();  // Menampilkan spinner
                    }
                });

                // Kirim form
                this.submit();  // Melakukan submit form secara normal
            });
        </script>

        {{-- set tanggal nggak bisa besok dst --}}
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                // Dapatkan tanggal hari ini dalam format YYYY-MM-DD
                const today = new Date().toISOString().split("T")[0];
        
                // Set batas maksimal (max) agar tidak bisa pilih besok dan seterusnya
                document.getElementById("date-start").setAttribute("max", today);
                document.getElementById("date-end").setAttribute("max", today);
            });
        </script>
    </body>

</html>