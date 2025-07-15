<!DOCTYPE html>
<html lang="en">
@include('partials.header')
<title>ForesightFluxCP | Hasil Peramalan</title>
<style>
    input.btn-check {
        display: none !important;
    }

    ,
    #range-form {
        display: none !important;
    }

    ,
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

                        <h4 class="page-title">Hasil Peramalan</h4>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active">Hasil Dari Peramalan, Dapat Juga Dilihat Hasil Akurasinya
                                Apakah Peramalan Yang Sudah Dilakukan Akurat atau Belum</li>
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
                                @if (session('error'))
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
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h3 class="mt-0 header-title">NOTE: Harap Dibaca Terlebih Dahulu</h3>
                                        <ul class="mb-0">
                                            <li><strong>⚠️ Titik sebagai pembacaan nilai desimal, sedangkan koma untuk
                                                    pemisah ribuan.</strong></li>
                                            <li><strong>📌 Hasil peramalan ini bersifat informatif saja</strong>, bukan
                                                sebagai patokan pasti untuk membeli atau menjual kripto.</li>
                                            <li><strong>📈 Akurasi peramalan dapat berubah</strong> tergantung dari data
                                                sebelumnya dan pola pergerakan pasar yang tidak selalu konsisten.</li>
                                            <li><strong>💡 Gunakan hasil prediksi sebagai bahan pertimbangan
                                                    tambahan</strong>, bukan satu-satunya dasar untuk pengambilan
                                                keputusan.</li>
                                            <li><strong>🌍 Hasil ini tidak mempertimbangkan faktor eksternal seperti
                                                    kebijakan ekonomi, sentimen pasar, isu geopolitik, </strong> yang
                                                sebenarnya bisa sangat memengaruhi naik turunnya harga kripto.</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- baris kedua, grafik + tabel  --}}
                {{-- HASIL PERAMALAN --}}
                <div class="row">
                    <div class="col-xl-9">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="mt-0 header-title mb-4">Grafik Hasil Peramalan Kripto 7 Hari Berikutnya</h4>
                                @if ($akurasi->count() > 0)
                                    <div class="d-flex justify-content-between align-items-center mt-3">

                                        {{-- Tombol Hapus di Kiri --}}
                                        <div>
                                            <button id="hapusSemuaData" type="button"
                                                class="btn btn-outline-danger waves-effect waves-light me-2">
                                                Hapus Semua Data Pra Proses dan Data Hasil Peramalan
                                            </button>
                                            <form id="hapusSemuaDataForm" method="POST" style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </div>

                                        {{-- Tombol Update di Kanan --}}
                                        @php
                                            $mape = $akurasi->first()->mape ?? null;
                                            $paramUpdatedAt = $param->updated_at ?? null;
                                            $akurasiUpdatedAt = $akurasi->first()->updated_at ?? null;
                                        @endphp
                                    </div>
                                @endif
                                @php
                                    use Carbon\Carbon;

                                    $labels = collect();
                                    $actualData = collect(); // titik untuk data aktual dari testing
                                    $forecastData = collect(); // titik untuk data forecast

                                    // Tambahkan data dari $testing
                                    if ($testing) {
                                        $labels->push(Carbon::parse($testing->date)->translatedFormat('d F Y'));
                                        $actualData->push(round((float) $testing->actual, 2));
                                        $forecastData->push(null); // ⬅️ kosongkan titik forecast di titik actual
                                    }

                                    // Tambahkan hasil prediksi ke labels & data
                                    foreach ($hasil as $item) {
                                        $labels->push(Carbon::parse($item->date_forecast)->translatedFormat('d F Y'));
                                        $actualData->push(null); // ⬅️ kosongkan titik actual di titik forecast
                                        $forecastData->push(round((float) $item->forecast, 2));
                                    }

                                    // Hitung Y-axis range
                                    $combined = $actualData->merge($forecastData)->filter(); // gabung dan hilangkan null

                                    $yMin = floor($combined->min() / 200) * 200 - 200;
                                    $yMax = ceil($combined->max() / 200) * 200 + 200;

                                    $source = $data->first()->source ?? null;
                                    $name = $source->display_name ?? ($source->name ?? '-');
                                    $start = $source
                                        ? Carbon::parse($source->periode_awal)->translatedFormat('d F Y')
                                        : '-';
                                    $end = $source
                                        ? Carbon::parse($source->periode_akhir)->translatedFormat('d F Y')
                                        : '-';
                                    $jenis_data = $source->jenis_data ?? '-';
                                    $total = $data->count();
                                    $dataAkurasi = $akurasi->first();
                                @endphp
                                @if ($source)
                                    <br><br>
                                    <div class="mb-4">
                                        <p class="mb-1"><strong>Nama Kripto:</strong> {{ $name }}<strong
                                                style="margin-left: 15px">Total Data:</strong> {{ $total }}</p>
                                        <p class="mb-1">
                                            <strong>Sumber:</strong>
                                            @if ($source->sumber === 'API')
                                                API 🖥️
                                            @elseif($source->sumber === 'Import')
                                                Import 🗂️
                                            @endif
                                            <strong style="margin-left: 15px">Jenis Data:</strong> {{ $jenis_data }}
                                            🗓️
                                        </p>
                                        <p class="mb-1"><strong>Jangka Waktu:</strong> {{ $start }} s/d
                                            {{ $end }}</p>
                                        <p class="mb-1">
                                        </p>
                                        <p class="mb-1"><strong>Persentase training dan testing:</strong>
                                            {{ +$param->training_percentage }}:{{ +$param->testing_percentage }}</p>
                                        <p class="mb-1"><strong>Total Data training {{ $totalTraining }} </strong>
                                            testing {{ $totalTesting }} </p>
                                        @if ($dataAkurasi)
                                            <div style="margin-bottom: 4px;">
                                                <strong>📊 MAPE:</strong> {{ number_format($dataAkurasi->mape, 2) }}%
                                            </div>
                                        @endif
                                    </div>
                                @endif

                                <!-- hapus d-none untuk user bisa memilih hasil peramalan -->
                                <form method="GET" id="range-form" class="mb-3 d-none">
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="flex-fill">
                                            <input type="radio" class="btn-check" name="range" id="range7"
                                                value="7" {{ $range == 7 ? 'checked' : '' }}>
                                            <label class="btn w-100 py-2 text-center fw-bold" for="range7"
                                                id="label-range7">7 Hari</label>
                                        </div>
                                        <div class="flex-fill">
                                            <input type="radio" class="btn-check" name="range" id="range30"
                                                value="30" {{ $range == 30 ? 'checked' : '' }}>
                                            <label class="btn w-100 py-2 text-center fw-bold" for="range30"
                                                id="label-range30">30 Hari</label>
                                        </div>
                                    </div>
                                </form>


                                <div id="forecastChart" style="height: 300px;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="mt-0 header-title mb-4">Tabel Hasil Peramalan Disini</h4>
                                <div class="table-responsive order-table">
                                    @if (count($hasil) > 0)
                                        <table id="datatable1" class="table table-hover mb-0">
                                            <thead>
                                                <tr>
                                                    <th scope="col" style="width: 120px">Tanggal</th>
                                                    <th scope="col">Hasil Prediksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if ($testing)
                                                    <tr class="table-warning">
                                                        <td>{{ \Carbon\Carbon::parse($testing->date)->translatedFormat('d F Y') }}
                                                        </td>
                                                        <td>{{ number_format($testing->actual, 0, ',', '.') }}
                                                            <small>(Data aktual 1 hari sebelum hasil prediksi)</small>
                                                        </td>
                                                    </tr>
                                                @endif

                                                @foreach ($hasil as $item)
                                                    <tr>
                                                        <td>{{ \Carbon\Carbon::parse($item->date_forecast)->translatedFormat('d F Y') }}
                                                        </td>
                                                        <td>{{ number_format($item->forecast, 0, ',', '.') }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    @else
                                        <div class="alert alert-info mt-3">
                                            Belum ada hasil prediksi untuk ditampilkan.
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- baris ketiga, HASIL MAPE --}}
                <div class="row">
                    <div class="col-xl-9">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="mt-0 header-title mb-4">Grafik Hasil Perhitungan Testing</h4>
                                {{-- hapus d-none untuk user bisa memilih hasil peramalan --}}
                                <form method="GET" class="mb-3 d-none">
                                    <label for="range2">Tampilkan Data Testing Terakhir:</label>
                                    <select name="range2" id="range2" onchange="this.form.submit()">
                                        <option value="10" {{ request('range2') == 10 ? 'selected' : '' }}>10
                                        </option>
                                        <option value="20" {{ request('range2') == 20 ? 'selected' : '' }}>20
                                        </option>
                                        <option value="30" {{ request('range2') == 30 ? 'selected' : '' }}>30
                                        </option>
                                        <option value="60" {{ request('range2') == 60 ? 'selected' : '' }}>60
                                        </option>
                                        <option value="90" {{ request('range2') == 90 ? 'selected' : '' }}>90
                                        </option>
                                    </select>
                                </form>
                                <div id="grafikTesting" height="250"></div>
                                @php
                                    $dataAkurasi = $akurasi->first();
                                @endphp

                                @if ($dataAkurasi)
                                    <div class="mb-4">
                                        <br>
                                        <h5 class="mb-1"><strong>⚠️ Keterangan:</strong></h5><br>

                                        <div class="mb-2" style="font-size: 14px;">
                                            <div style="margin-bottom: 4px;">
                                                <strong>📊 MAPE:</strong> {{ number_format($dataAkurasi->mape, 2) }}%
                                            </div>

                                            <div style="margin-bottom: 4px;">
                                                Ini menunjukkan seberapa besar rata-rata kesalahan prediksi dibanding
                                                nilai aslinya.
                                                Semakin kecil angkanya, semakin akurat prediksinya.
                                                <strong>(angka di belakang titik itu angka desimal)</strong>
                                            </div>

                                            <div style="margin-bottom: 4px;"><strong>Keterangan:</strong></div>

                                            @if ($dataAkurasi->mape < 10)
                                                <div
                                                    style="color: green; font-weight: bold; text-decoration: underline; margin-bottom: 4px;">
                                                    ✅ Sangat Akurat — Prediksi hampir sama dengan data asli. Berdasarkan
                                                    Perhitungan Error MAPE.
                                                </div>
                                            @elseif ($dataAkurasi->mape < 20)
                                                <div
                                                    style="color: #2E8B57; font-weight: bold; text-decoration: underline; margin-bottom: 4px;">
                                                    👍 Baik — Cukup dekat dengan data asli. Berdasarkan Perhitungan
                                                    Error MAPE.
                                                </div>
                                            @elseif ($dataAkurasi->mape < 50)
                                                <div
                                                    style="color: orange; font-weight: bold; text-decoration: underline; margin-bottom: 4px;">
                                                    ⚠️ Cukup — Masih bisa diterima, tapi perlu hati-hati. Berdasarkan
                                                    Perhitungan Error MAPE.
                                                </div>
                                                <div style="color: orange; margin-bottom: 4px;">
                                                    <strong>🛠️ Lakukan <u>Grid Search</u> (tombol warna kuning di
                                                        sebelah kanan) untuk mengatur parameter agar nilai MAPE kecil
                                                        dan hasil peramalan lebih baik.</strong>
                                                </div>
                                            @else
                                                <div
                                                    style="color: red; font-weight: bold; text-decoration: underline; margin-bottom: 4px;">
                                                    ❌ Buruk — Prediksi jauh dari data sebenarnya. Berdasarkan
                                                    Perhitungan Error MAPE.
                                                </div>
                                                <div style="color: red; margin-bottom: 4px;">
                                                    <strong>⚠️ Lakukan <u>Grid Search</u> (tombol warna kuning di
                                                        sebelah kanan) untuk mengatur parameter agar nilai MAPE kecil
                                                        dan hasil peramalan lebih baik.</strong>
                                                </div>
                                            @endif

                                            <br> {{-- Tambahkan jarak bawah --}}
                                        </div>



                                        <p class="mb-1"><strong>📊 RMSE:</strong>
                                            {{ number_format(+$dataAkurasi->rmse) }}
                                            <br>
                                        <p>
                                            Ini adalah ukuran rata-rata kesalahan dalam angka asli (misalnya: rupiah,
                                            unit, dsb).
                                            Nilainya tidak dalam persen, tapi langsung nunjukin seberapa jauh salahnya.
                                            <strong>(koma pemisah ribuan)</strong>
                                            <br>
                                            <strong>Catatan:</strong> Semakin kecil nilai ini, makin bagus hasil
                                            prediksinya.
                                        </p>
                                        </p>

                                        <p class="mb-1"><strong>📊 rRMSE:</strong>
                                            {{ number_format($dataAkurasi->relative_rmse, 2) }}%
                                            <br>
                                        <p>
                                            Ini mirip dengan RMSE, tapi dalam bentuk persentase supaya lebih mudah
                                            dibandingkan.
                                            Berguna untuk tahu seberapa besar kesalahan relatif terhadap rata-rata data.
                                            <strong>(angka dibelakang titik itu angka desimal)</strong>
                                            <br>
                                            <strong>Keterangan:</strong>
                                            @if ($dataAkurasi->relative_rmse < 10)
                                                Sangat Baik — Prediksi sangat mendekati kenyataan.
                                            @elseif ($dataAkurasi->relative_rmse < 20)
                                                Baik — Hasil cukup akurat untuk keperluan umum.
                                            @elseif ($dataAkurasi->relative_rmse < 30)
                                                Cukup — Bisa dipakai, tapi kurang presisi.
                                            @else
                                                Kurang Akurat — Perlu evaluasi model prediksinya.
                                            @endif
                                        </p>
                                        </p>
                                    </div>
                                @else
                                    <p>Tidak ada data akurasi.</p>
                                @endif

                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="mt-0 header-title mb-4">Kategori MAPE</h4>
                                <div class="table-responsive order-table">
                                    <table class="table table-hover mb-0">
                                        <thead>
                                            <tr>
                                                <th scope="col">Persentase MAPE (%)</th>
                                                <th scope="col">Kategori</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    < 10%</td>
                                                <td>Sangat Akurat</td>
                                            </tr>
                                            <tr>
                                                <td>10% - 20%</td>
                                                <td>Akurat</td>
                                            </tr>
                                            <tr>
                                                <td>20% - 50%</td>
                                                <td>Wajar</td>
                                            </tr>
                                            <tr>
                                                <td>> 50%</td>
                                                <td>Sangat Tidak Akurat</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    @if ($dataAkurasi && $dataAkurasi->mape > 20)
                                        <a href="{{ route('settingParams') }}" target="_blank" type="button"
                                            class="btn btn-outline-warning waves-effect waves-light me-4">
                                            Grid Search
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-9">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="mt-0 header-title mb-4">Grafik Hasil Perhitungan Training</h4>
                                <div id="trainingChart" style="height: 400px;"></div>
                            </div>
                        </div>
                    </div>
                    {{-- ini sebagai contoh tambahan --}}
                </div>
            </div>
        </div>
    </div>

    @include('partials.footer')
    @include('partials.scripts')

    {{-- DATATABLE JS --}}
    <!-- Required datatable js -->
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
    {{-- Datatable Pages --}}
    <script src="{{ asset('pages/datatables.init.js') }}"></script>

    {{-- pop up untuk hapus data --}}
    <script>
        $(document).ready(function() {
            $('#datatable1').DataTable({
                paging: rowCount > 10,
                paging: true,
                searching: false,
                ordering: false,
                info: false,
                lengthChange: false,
                language: {
                    paginate: {
                        previous: "Sebelumnya",
                        next: "Berikutnya"
                    },
                    zeroRecords: "Tidak ada data",
                    emptyTable: "Tidak ada data ditampilkan"
                }
            });

            $('#datatable2').DataTable(); // jika kamu memang punya tabel lain
        });

        document.getElementById("hapusSemuaData").addEventListener("click", function() {
            Swal.fire({
                title: 'Yakin Mau Hapus Semua Data?',
                text: 'Aksi ini akan menghapus data Hasil dan Pra Proses yang ada! Yakin mau melanjutkan?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Hapus!',
                cancelButtonText: 'Batal',
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Menghapus...',
                        text: 'Data sedang dihapus.',
                        allowOutsideClick: false,
                        showConfirmButton: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });
                    const form = document.getElementById("hapusSemuaDataForm");
                    form.action = "{{ route('peramalan.hapusHasil') }}";
                    form.submit();
                }
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    {{-- tombol 7 atau 30 --}}
    <script>
        const rangeRadios = document.querySelectorAll('input[name="range"]');

        function updateRangeButtonStyles() {
            rangeRadios.forEach(radio => {
                const label = document.querySelector(`label[for="${radio.id}"]`);
                if (radio.checked) {
                    if (radio.value === "7") {
                        label.classList.remove('btn-outline-primary');
                        label.classList.add('btn-primary');
                    } else if (radio.value === "30") {
                        label.classList.remove('btn-outline-success');
                        label.classList.add('btn-success');
                    }
                } else {
                    if (radio.value === "7") {
                        label.classList.remove('btn-primary');
                        label.classList.add('btn-outline-primary');
                    } else if (radio.value === "30") {
                        label.classList.remove('btn-success');
                        label.classList.add('btn-outline-success');
                    }
                }
            });
        }

        // Jalankan saat radio berubah
        rangeRadios.forEach(radio => {
            radio.addEventListener('change', function() {
                updateRangeButtonStyles();
                document.getElementById('range-form').submit();
            });
        });

        // Jalankan sekali saat awal
        updateRangeButtonStyles();
    </script>

    {{-- grafik hasil peramalan 7 hari kedepan --}}
    <script>
        const options = {
            chart: {
                type: 'line',
                height: 400,
                zoom: {
                    enabled: false
                },
                toolbar: {
                    show: false
                }
            },
            series: [{
                    name: 'Aktual',
                    data: {!! json_encode($actualData) !!}
                },
                {
                    name: 'Forecast',
                    data: {!! json_encode($forecastData) !!}
                }
            ],
            xaxis: {
                categories: {!! json_encode($labels) !!},
                title: {
                    text: 'Tanggal'
                },
                tooltip: {
                    enabled: false
                },
                labels: {
                    rotate: -45,
                    formatter: function(value) {
                        return value;
                    }
                }
            },
            yaxis: {
                min: {{ $yMin }},
                max: {{ $yMax }},
                tickAmount: 7,
                title: {
                    text: 'Nilai'
                }
            },
            stroke: {
                curve: 'smooth',
                width: 2
            },
            tooltip: {
                enabled: true,
                shared: true,
                intersect: false
            },
            markers: {
                size: 5
            },
            grid: {
                padding: {
                    bottom: 20
                }
            },
            colors: ['#007bff', '#34c38f'] // 🔵 biru untuk Aktual, 🟢 hijau untuk Forecast
        };

        const chart = new ApexCharts(document.querySelector("#forecastChart"), options);
        chart.render();
    </script>

    {{-- grafik hasil training --}}
    <script>
        const trainingOptions = {
            chart: {
                type: 'line',
                height: 400,
                zoom: {
                    enabled: false
                },
                toolbar: {
                    show: false
                }
            },
            series: [{
                    name: 'Aktual',
                    data: {!! json_encode($trainingPrices) !!}
                },
                {
                    name: 'Forecast',
                    data: {!! json_encode($trainingForecasts) !!}
                }
            ],
            xaxis: {
                categories: {!! json_encode($trainingLabels) !!},
                title: {
                    text: 'Tanggal'
                },
                tooltip: {
                    enabled: false // ⛔ ini yang menonaktifkan bubble tanggal di bawah sumbu X
                },
                labels: {
                    rotate: -45,
                    formatter: function(value) {
                        return value;
                    }
                }
            },
            yaxis: {
                title: {
                    text: 'Nilai'
                }
            },
            stroke: {
                curve: 'smooth',
                width: 2
            },
            tooltip: {
                enabled: true,
                shared: true,
                intersect: false
            },
            markers: {
                size: 4
            },
            colors: ['#007bff', '#f39c12'], // Biru untuk price, oranye untuk forecast
            grid: {
                padding: {
                    bottom: 20
                }
            },
            legend: {
                position: 'top'
            }
        };

        const trainingChart = new ApexCharts(document.querySelector("#trainingChart"), trainingOptions);
        trainingChart.render();
    </script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/d3/5.16.0/d3.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/c3/0.7.20/c3.min.js"></script>

    {{-- grafik hasil testing --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const labels = @json($testingChart->pluck('date'));
            const actualData = @json($testingChart->pluck('actual'));
            const forecastData = @json($testingChart->pluck('forecast'));

            // Siapkan kolom data
            const xValues = ['x'];
            const actualSeries = ['Actual'];
            const forecastSeries = ['Forecast'];

            for (let i = 0; i < labels.length; i++) {
                // Pastikan semua data valid
                const date = labels[i];
                let actual = actualData[i];
                let forecast = forecastData[i];

                // Konversi data kosong atau tidak numerik menjadi null
                actual = (actual === null || isNaN(actual)) ? null : Number(actual);
                forecast = (forecast === null || isNaN(forecast)) ? null : Number(forecast);

                xValues.push(date);
                actualSeries.push(actual);
                forecastSeries.push(forecast);
            }

            const chart = c3.generate({
                bindto: '#grafikTesting',
                data: {
                    x: 'x',
                    columns: [
                        xValues,
                        actualSeries,
                        forecastSeries
                    ],
                    type: 'line'
                },
                axis: {
                    x: {
                        type: 'timeseries',
                        label: 'Tanggal',
                        tick: {
                            format: '%Y-%m-%d',
                            rotate: -45,
                            values: {!! json_encode(
                                collect($testingChart)->pluck('date')->filter()->values()->chunk(ceil($testingChart->count() / 15))->map(fn($chunk) => $chunk->first()),
                            ) !!}
                        }

                    },
                    y: {
                        label: 'Nilai'
                    }
                },
                color: {
                    pattern: ['#4BC0C0', '#FF6384']
                },
                line: {
                    connectNull: true
                },
                point: {
                    show: true
                }
            });
        });
    </script>

</body>

</html>
