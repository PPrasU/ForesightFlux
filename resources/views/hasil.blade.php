<!DOCTYPE html>
<html lang="en">
    @include('partials.header')
    <title>ForesightFluxCP | Hasil Peramalan</title>

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
                                <li class="breadcrumb-item active">Hasil Dari Peramalan, Dapat Juga Dilihat Hasil Akurasinya Apakah Peramalan Yang Sudah Dilakukan Akurat atau Belum</li>
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
                                    <h4 class="mt-0 header-title mb-4">NOTE: Harap Dibaca</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-body">
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
                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <h3 class="mt-0 header-title">Tabel Hasil Peramalan Data Training</h3>
                                    @if ($training->count() > 0)
                                        <button id="hapusSemuaData" type="button" class="btn btn-outline-danger waves-effect waves-light me-2">
                                            Hapus Semua Hasil Peramalan
                                        </button>
                                        <form id="hapusSemuaDataForm" method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    @endif
                                </div>
                                
                                @php
                                    use Carbon\Carbon;
                                    $source = $training->first()->source ?? null;
                                    $name = $source->display_name ?? $source->name ?? '-';
                                    $start = $source ? Carbon::parse($source->periode_awal)->format('m-d-Y') : '-';
                                    $end = $source ? Carbon::parse($source->periode_akhir)->format('m-d-Y') : '-';
                                    $total = $training->count();
                                @endphp

                                @if ($source)
                                    <div class="mb-4">
                                        <p class="mb-1"><strong>Nama Kripto:</strong> {{ $name }}</p>
                                        <p class="mb-1"><strong>Jangka Waktu:</strong> {{ $start }} s/d {{ $end }}</p>
                                        <p class="mb-1"><strong>Total Data:</strong> {{ $total }}</p>
                                    </div>
                                @endif

                                <table id="datatable1" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr>
                                            <th style="width: 10px" hidden>No</th>
                                            <th style="width: 100px">Tanggal</th>
                                            <th>Aktual</th>
                                            <th>Level Smoothing</th>
                                            <th>Trend Smoothing</th>
                                            <th>Seasonal Smoothing</th>
                                            <th style="width: 100px">Hasil Peramalan</th>
                                            <th style="width: 150px">Error</th>
                                            <th style="width: 100px">Absolute Error</th>
                                            <th style="width: 100px">Error Square</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($training as $row)
                                            <tr>
                                                <td style="text-align: center" hidden>{{ $row->id }}</td>
                                                <td style="text-align: center">{{ $row->date }}</td>
                                                <td>{{ $row->price }}</td>
                                                <td>{{ $row->level }}</td>
                                                <td>{{ $row->trend }}</td>
                                                <td>{{ $row->seasonal }}</td>
                                                <td>{{ $row->forecast }}</td>
                                                <td>{{ $row->error }}</td>
                                                <td>{{ $row->abs_error }}</td>
                                                <td>{{ $row->error_square }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
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
                                    <h4 class="mt-0 header-title mb-4">Grafik Hasil Peramalan Kriptonya</h4>
                                    <table class="table table-hover mb-0">
                                        <thead>
                                          <tr>
                                            <th scope="col">Tanggal</th>
                                            <th scope="col">Harga Aktual (Harga Sebenarnya)</th>
                                            <th scope="col">Harga Hasil Peramalan</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          <tr>
                                            <td>17-02-2025</td>
                                            <td>---</td>
                                            <td>---</td>
                                          </tr>
                                          <tr>
                                            <td>16-02-2025</td>
                                            <td>---</td>
                                            <td>---</td>
                                          </tr>
                                          <tr>
                                            <td>15-02-2025</td>
                                            <td>---</td>
                                            <td>---</td>
                                          </tr>
                                          <tr>
                                            <td>14-02-2025</td>
                                            <td>---</td>
                                            <td>---</td>
                                          </tr>
                                          <tr>
                                            <td>13-02-2025</td>
                                            <td>---</td>
                                            <td>---</td>
                                          </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="mt-0 header-title mb-4">Tabel Hasil Peramalan Disini</h4>
                                    <div class="table-responsive order-table">
                                        <table class="table table-hover mb-0">
                                            <thead>
                                                <tr>
                                                <th scope="col">Tanggal</th>
                                                <th scope="col">Hasil Prediksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>22-02-2025</td>
                                                    <td>Rp100.000</td>
                                                </tr>
                                                <tr>
                                                    <td>21-02-2025</td>
                                                    <td>Rp100.000</td>
                                                </tr>
                                                <tr>
                                                    <td>20-02-2025</td>
                                                    <td>Rp100.000</td>
                                                </tr>
                                                <tr>
                                                    <td>19-02-2025</td>
                                                    <td>Rp100.000</td>
                                                </tr>
                                                <tr>
                                                    <td>18-02-2025</td>
                                                    <td>Rp100.000</td>
                                                </tr>
                                            </tbody>
                                        </table>
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
                                    <h4 class="mt-0 header-title mb-4">Grafik Hasil Perhitungan Akurasi Peramalan Dengan MAPE</h4>
                                    <div class="table-responsive">
                                        <table class="table table-hover mb-0">
                                            <thead>
                                              <tr>
                                                <th scope="col">Tanggal</th>
                                                <th scope="col">Harga Aktual (Harga Sebenarnya)</th>
                                                <th scope="col">Harga Hasil Peramalan</th>
                                              </tr>
                                            </thead>
                                            <tbody>
                                              <tr>
                                                <td>17-02-2025</td>
                                                <td>---</td>
                                                <td>---</td>
                                              </tr>
                                              <tr>
                                                <td>16-02-2025</td>
                                                <td>---</td>
                                                <td>---</td>
                                              </tr>
                                              <tr>
                                                <td>15-02-2025</td>
                                                <td>---</td>
                                                <td>---</td>
                                              </tr>
                                              <tr>
                                                <td>14-02-2025</td>
                                                <td>---</td>
                                                <td>---</td>
                                              </tr>
                                              <tr>
                                                <td>13-02-2025</td>
                                                <td>---</td>
                                                <td>---</td>
                                              </tr>
                                            </tbody>
                                        </table>
                                    </div>
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
                                                    <td>< 10%</td>
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
                                                    <td>Tidak Akurat</td>
                                                </tr>
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

        {{-- pop up untuk hapus data --}}
        <script>
            $(document).ready(function() {
                $('#datatable1').DataTable();
                $('#datatable2').DataTable();
            });

            document.getElementById("hapusSemuaData").addEventListener("click", function () {
                Swal.fire({
                    title: 'Yakin Mau Hapus Semua Data?',
                    text: 'Aksi ini akan menghapus semua data API yang ada! Yakin mau melanjutkan?',
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
    </body>

</html>