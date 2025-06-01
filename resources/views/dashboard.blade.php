<!DOCTYPE html>
<html lang="en">
    @include('partials.header')
    <title>ForesightFluxCP | Dasbor</title>

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
                            
                            <h4 class="page-title">Beranda</h4>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item active">Selamat datang di sistem peramalan kripto</li>
                                {{-- <li class="breadcrumb-item active">Selamat datang di ForesightFluxCP</li> --}}
                            </ol>
                            <a id="datetime" class="breadcrumb-item active" style="color: #9e9e9e"></a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="page-content-wrapper">
                <div class="container-fluid">
                    {{-- 4 kotak biru --}}
                    @php
                        function formatRupiah($angka) {
                            return 'Rp' . number_format($angka, 0, ',', '.');
                        }
                    @endphp

                    <div class="row">
                        @foreach (['close' => 'Harga Penutupan', 'open' => 'Harga Pembuka', 'high' => 'Harga Tertinggi', 'low' => 'Harga Terendah'] as $key => $label)
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-primary mini-stat position-relative">
                                    <div class="card-body">
                                        <div class="mini-stat-desc">
                                            <h6 class="text-uppercase verti-label text-white-50">{{ ucfirst($key) }} Price</h6>
                                            <div class="text-white">
                                                <h6 class="text-uppercase mt-0 text-white-50">{{ $label }}</h6>
                                                <h3 class="mb-3 mt-0">
                                                    {{ isset($prices[$key]) ? formatRupiah($prices[$key]['value']) : '-' }}
                                                </h3>
                                                <div class="">
                                                    @if(isset($prices[$key]))
                                                        <span class="badge badge-light text-{{ $prices[$key]['status'] }}">
                                                            {{ $prices[$key]['change'] > 0 ? '+' : '' }}{{ $prices[$key]['change'] }}%
                                                        </span>
                                                    @else
                                                        <span class="badge badge-light text-info">-</span>
                                                    @endif
                                                    <span class="ml-2">Dari Hari Sebelumnya</span>
                                                </div>
                                            </div>
                                            <div class="mini-stat-icon">
                                                @switch($key)
                                                    @case('close') <i class="mdi mdi-cube-outline display-2"></i> @break
                                                    @case('open') <i class="mdi mdi-buffer display-2"></i> @break
                                                    @case('high') <i class="mdi mdi-tag-text-outline display-2"></i> @break
                                                    @case('low') <i class="mdi mdi-briefcase-check display-2"></i> @break
                                                @endswitch
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>


                    <div class="row">
                        <div class="col-xl-9">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="mt-0 header-title mb-4">
                                        Tabel Data Historis Kripto {{ ($historicalType) }}
                                    </h4>
                                    <div class="table-responsive">
                                        <table class="table table-hover mb-0">
                                            <thead>
                                                <tr>
                                                    <th scope="col">No</th>
                                                    <th scope="col">Tanggal</th>
                                                    @if($historicalType === 'Import')
                                                        <th scope="col">Price</th>
                                                        <th scope="col">Open</th>
                                                        <th scope="col">High</th>
                                                        <th scope="col">Low</th>
                                                        <th scope="col">Volume</th>
                                                        <th scope="col">Change %</th>
                                                    @else
                                                        <th scope="col">Open</th>
                                                        <th scope="col">High</th>
                                                        <th scope="col">Low</th>
                                                        <th scope="col">Close</th>
                                                        <th scope="col">VWAP</th>
                                                        <th scope="col">Volume</th>
                                                        <th scope="col">Count</th>
                                                    @endif
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php $prev = null; @endphp
                                                @forelse ($historicalData as $index => $item)
                                                    @php
                                                        $compareClass = function($curr, $prevVal) {
                                                            if ($prevVal === null) return 'text-secondary'; // baris pertama
                                                            $c = floatval(str_replace(',', '', $curr));
                                                            $p = floatval(str_replace(',', '', $prevVal));
                                                            return $c > $p ? 'text-success' : ($c < $p ? 'text-danger' : 'text-info');
                                                        };
                                                    @endphp

                                                    <tr>
                                                        <th scope="row">{{ $index + 1 }}</th>
                                                        @if($historicalType === 'Import')
                                                            <td>{{ \Carbon\Carbon::parse($item->date)->translatedFormat('d F Y') }}</td>
                                                            <td class="{{ $compareClass($item->price, $prev->price ?? null) }}">{{ $item->price }}</td>
                                                            <td class="{{ $compareClass($item->open, $prev->open ?? null) }}">{{ $item->open }}</td>
                                                            <td class="{{ $compareClass($item->high, $prev->high ?? null) }}">{{ $item->high }}</td>
                                                            <td class="{{ $compareClass($item->low, $prev->low ?? null) }}">{{ $item->low }}</td>
                                                            <td>{{ $item->vol }}</td>
                                                            <td class="
                                                                @if(Str::startsWith($item->change, '+')) text-success
                                                                @elseif(Str::startsWith($item->change, '-')) text-danger
                                                                @else text-info
                                                                @endif
                                                            ">
                                                                {{ $item->change }}
                                                            </td>
                                                        @else
                                                            <td>{{ \Carbon\Carbon::createFromFormat('m-d-Y', $item->date)->translatedFormat('d F Y') }}</td>
                                                            <td class="{{ $compareClass($item->open, $prev->open ?? null) }}">{{ $item->open }}</td>
                                                            <td class="{{ $compareClass($item->high, $prev->high ?? null) }}">{{ $item->high }}</td>
                                                            <td class="{{ $compareClass($item->low, $prev->low ?? null) }}">{{ $item->low }}</td>
                                                            <td class="{{ $compareClass($item->close, $prev->close ?? null) }}">{{ $item->close }}</td>
                                                            <td class="{{ $compareClass($item->vwap, $prev->vwap ?? null) }}">{{ $item->vwap }}</td>
                                                            <td class="{{ $compareClass($item->vol, $prev->vol ?? null) }}">{{ $item->vol }}</td>
                                                            <td class="{{ $compareClass($item->count, $prev->count ?? null) }}">{{ $item->count }}</td>
                                                        @endif

                                                    </tr>
                                                    @php $prev = $item; @endphp
                                                @empty
                                                    <tr>
                                                        <td colspan="8" class="text-center">Tidak ada historis yang tersedia</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="mt-0 header-title mb-4">
                                        Tabel Hasil Peramalan
                                    </h4>
                                    <div class="table-responsive">
                                        <table class="table table-hover mb-0">
                                            <thead>
                                                <tr>
                                                    <th scope="col">No</th>
                                                    <th scope="col">Tanggal</th>
                                                    <th scope="col">Hasil Prediksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($lastForecasts as $index => $forecast)
                                                    <tr>
                                                        <td>{{ $index + 1 }}</td>
                                                        <td>{{ \Carbon\Carbon::parse($forecast->date_forecast)->translatedFormat('d F Y') }}</td>
                                                        <td>{{ number_format($forecast->forecast, 2) }}</td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="3" class="text-center">Tidak ada historis yang tersedia</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

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

        <script>
            $(document).ready(function () {
                $('#datatable1').DataTable({
                    paging: false,        // Tidak ada paging
                    searching: false,     // Tidak ada pencarian
                    ordering: false,      // Tidak perlu pengurutan
                    info: false,          // Tidak ada info "Showing X of Y"
                    lengthChange: false,  // Tidak ada dropdown "Show X entries"
                    language: {
                        paginate: {
                            previous: "Sebelumnya",
                            next: "Berikutnya"
                        },
                        zeroRecords: "Tidak ada data",
                        emptyTable: "Tidak ada data ditampilkan"
                    }
                });
            });
        </script>

    </body>

</html>