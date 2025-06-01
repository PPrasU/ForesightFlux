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
        .btn-check {
            position: absolute;
            clip: rect(0, 0, 0, 0);
            pointer-events: none;
            min-width: 500px;
        }
        input[type="radio"].btn-check {
            display: none !important;
        }
        .btn-radio {
            flex: 1;
            text-align: center;
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

                                    <div>
                                        <div class="text-center mb-4">
                                            <h4 class="mt-0 header-title">Pilih Data Historis Kripto Untuk Dilakukan Peramalan Nantinya</h4>
                                        </div>
                                    </div>
                                    
                                    {{-- <form id="apiData"> --}}
                                    <form action="{{ route('data.postDataAPI') }}" method="POST" enctype="multipart/form-data" id="apiData">
                                        @csrf
                                        {{-- Pilih Kripto --}}
                                        <div class="form-group">
                                            <label class="control-label font-weight-bold">Pilih Kripto</label>
                                            <select name="crypto_pair" id="crypto_pair" class="form-control form-control-lg select2" required>
                                                <option selected disabled>--- Kripto Populer ---</option>
                                                <option value="XXBTZUSD" {{ old('crypto_pair') == 'XXBTZUSD' ? 'selected' : '' }}>Bitcoin (BTC) to USD</option>
                                                <option value="XETHZUSD" {{ old('crypto_pair') == 'XETHZUSD' ? 'selected' : '' }}>Ethereum (ETH) to USD</option>
                                                <option value="ETCUSD" {{ old('crypto_pair') == 'ETCUSD' ? 'selected' : '' }}>Ethereum Classic (ETC) to USD</option>
                                                <option value="XLTCZUSD" {{ old('crypto_pair') == 'XLTCZUSD' ? 'selected' : '' }}>Litecoin (LTC) to USD</option>
                                                <option value="XDGUSD" {{ old('crypto_pair') == 'XDGUSD' ? 'selected' : '' }}>Dogecoin (DOGE) (XDG) to USD</option>
                                                <option value="XCNUSD" {{ old('crypto_pair') == 'XCNUSD' ? 'selected' : '' }}>Onyxcoin (XCN) to USD</option>
                                                <option value="MLNUSD" {{ old('crypto_pair') == 'MLNUSD' ? 'selected' : '' }}>Enzyme (MLN) to USD</option>
                                                <option value="REPUSD" {{ old('crypto_pair') == 'REPUSD' ? 'selected' : '' }}>Augur (REP) to USD</option>
                                                <option value="SOLUSD" {{ old('crypto_pair') == 'SOLUSD' ? 'selected' : '' }}>Solana (SOL) to USD</option>
                                                <option value="PONKEUSD" {{ old('crypto_pair') == 'PONKEUSD' ? 'selected' : '' }}>Ponke SOL (PONKE) to USD</option>
                                                <option value="POPCATUSD" {{ old('crypto_pair') == 'POPCATUSD' ? 'selected' : '' }}>Popcat SOL (POPCAT) to USD</option>
                                                <option selected disabled>--- Pilih Kripto Lain ---</option>
                                                @if ($cryptoPairs->isEmpty())
                                                    <option disabled>Data kripto dari API gagal dimuat 😥</option>
                                                @else
                                                    <option disabled>--- Pilih Kripto Lain ---</option>
                                                    @foreach ($cryptoPairs as $key => $pair)
                                                        @php
                                                            $displayName = $cryptoNames[$key] ?? $pair['wsname'] ?? $key;
                                                        @endphp
                                                        <option value="{{ $key }}" {{ old('crypto_pair') == $key ? 'selected' : '' }}>
                                                            {{ $displayName }}
                                                        </option>
                                                    @endforeach
                                                @endif
                                            </select>                                                                                                                                                                                           
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label d-block mb-2">Jenis Data</label>
                                            <div class="d-flex align-items-center gap-2">
                                                <div class="flex-fill">
                                                    <input type="radio" class="btn-check" name="jenis_data" id="harian" value="Harian" {{ old('jenis_data', 'Harian') == 'Harian' ? 'checked' : '' }}>
                                                    <label class="btn btn-success w-100 py-2 text-center fw-bold" for="harian" id="label-harian">
                                                        Harian
                                                    </label>
                                                </div>

                                                <span class="mx-2">–</span>

                                                <div class="flex-fill">
                                                    <input type="radio" class="btn-check" name="jenis_data" id="mingguan" value="Mingguan" {{ old('jenis_data') == 'Mingguan' ? 'checked' : '' }}>
                                                    <label class="btn btn-outline-warning w-100 py-2 text-center fw-bold" for="mingguan" id="label-mingguan">
                                                        Mingguan
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group mb-4">
                                            <label class="font-weight-bold">Jangka Waktu</label>
                                            <label id="keterangan-jangka-waktu" style="font-size: 11px; font-style: italic;" class="d-block mb-2">
                                                * Data harian dari Kraken hanya dapat diambil maksimal sebanyak 720 hari ke belakang dari hari ini.
                                            </label>
                                            <div class="d-flex align-items-center">
                                                <input type="text" id="date-startt" name="date-start" class="form-control" placeholder="Tanggal awal" value="{{ old('date-start') }}" onkeydown="return false">
                                                <span class="mx-2">–</span>
                                                <input type="text" id="date-endd" name="date-end" class="form-control" placeholder="Tanggal akhir" value="{{ old('date-end') }}" onkeydown="return false">
                                            </div>
                                        </div>


                                        <input type="hidden" name="sumber" value="API" />
                                        {{-- Tombol --}}
                                        <div style="margin-top: 40px">
                                            <button type="submit" class="btn btn-primary btn-lg btn-block mt-3 py-2" >
                                                Pilih Kripto
                                            </button>
                                        </div>
                                        {{-- <div style="margin-top: 40px">
                                            <button type="submit" id="submitApiBtn" class="btn btn-primary btn-lg btn-block mt-3 py-2" >
                                                Pilih Kripto
                                            </button>
                                        </div> --}}
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
        <!-- Flatpickr JS -->
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

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

        {{-- jangka waktu validasi dkk --}}
        <script>
            function updateKeterangan() {
                const label = document.getElementById('keterangan-jangka-waktu');
                const jenis = document.querySelector('input[name="jenis_data"]:checked')?.value;

                if (jenis === 'Harian') {
                    label.textContent = '* Data harian dari Kraken hanya dapat diambil maksimal sebanyak 720 hari ke belakang dari hari ini.';
                } else if (jenis === 'Mingguan') {
                    label.textContent = '* Data disajikan secara mingguan, dengan satu baris mencerminkan aktivitas kripto selama tujuh hari.';
                }
            }

            document.addEventListener('DOMContentLoaded', function () {
                const today = new Date();
                const maxDays = 719;
                let startPicker, endPicker;

                function addDays(date, days) {
                    const result = new Date(date);
                    result.setDate(result.getDate() + days);
                    return result;
                }

                function subtractDays(date, days) {
                    const result = new Date(date);
                    result.setDate(result.getDate() - days);
                    return result;
                }

                function isHarian() {
                    return document.querySelector('input[name="jenis_data"]:checked')?.value === "Harian";
                }

                function initDatePickers() {
                    if (startPicker) startPicker.destroy();
                    if (endPicker) endPicker.destroy();

                    const startConfig = {
                        dateFormat: "Y-m-d",
                        maxDate: today,
                        minDate: isHarian() ? subtractDays(today, maxDays) : null,
                        onChange: function (selectedDates) {
                            if (selectedDates.length === 0) return;
                            const start = selectedDates[0];
                            let maxEnd = isHarian() ? addDays(start, maxDays) : today;
                            if (maxEnd > today) maxEnd = today;

                            endPicker.set("minDate", start);
                            endPicker.set("maxDate", maxEnd);

                            const currentEnd = endPicker.selectedDates[0];
                            if (currentEnd && (currentEnd < start || currentEnd > maxEnd)) {
                                endPicker.clear();
                            }
                        }
                    };

                    const endConfig = {
                        dateFormat: "Y-m-d",
                        maxDate: today,
                        minDate: isHarian() ? subtractDays(today, maxDays) : null,
                        onChange: function (selectedDates) {
                            if (selectedDates.length === 0) return;
                            const end = selectedDates[0];
                            let minStart = isHarian() ? subtractDays(end, maxDays) : null;

                            startPicker.set("minDate", minStart);
                            startPicker.set("maxDate", end > today ? today : end);

                            const currentStart = startPicker.selectedDates[0];
                            if (currentStart && (currentStart > end || (minStart && currentStart < minStart))) {
                                startPicker.clear();
                            }
                        }
                    };

                    startPicker = flatpickr("#date-startt", startConfig);
                    endPicker = flatpickr("#date-endd", endConfig);
                }

                // Inisialisasi awal
                initDatePickers();

                // Ganti logika saat user ubah Jenis Data
                document.querySelectorAll('input[name="jenis_data"]').forEach(radio => {
                    radio.addEventListener("change", () => {
                        document.getElementById("date-startt").value = '';
                        document.getElementById("date-endd").value = '';
                        initDatePickers();
                        updateKeterangan();
                    });
                });
                updateKeterangan();
            });

        </script>

        {{-- button pilih jenis data --}}
        <script>
            const radios = document.querySelectorAll('input[name="jenis_data"]');

            function updateStyles() {
                radios.forEach(radio => {
                    const label = document.querySelector(`label[for="${radio.id}"]`);
                    if (radio.checked) {
                        label.classList.remove('btn-outline-warning');
                        label.classList.add('btn-success');
                    } else {
                        label.classList.remove('btn-success');
                        label.classList.add('btn-outline-warning');
                    }
                });
            }

            // Jalankan saat radio berubah
            radios.forEach(radio => {
                radio.addEventListener('change', updateStyles);
            });

            // Jalankan sekali saat awal
            updateStyles();
        </script>

        {{-- script ajax untuk api backend --}}
        {{-- <script>
            document.getElementById('apiData').addEventListener('submit', async function(e) {
                e.preventDefault(); // cegah reload halaman

                const form = e.target;
                const formData = new FormData(form);

                try {
                    const response = await fetch('/api/kraken/fetch', {
                        method: 'POST',
                        headers: {
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        },
                        body: formData
                    });

                    const data = await response.json();

                    if (response.ok) {
                        alert(data.message || 'Data berhasil disimpan!');
                    } else {
                        alert(data.error || 'Terjadi kesalahan.');
                    }
                } catch (error) {
                    console.error('Fetch error:', error);
                    alert('Terjadi error jaringan.');
                }
            });
        </script> --}}

    </body>

</html>