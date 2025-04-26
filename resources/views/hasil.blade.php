<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <title>ForesightFluxCP | Hasil Peramalan</title>
        <meta content="Admin Dashboard" name="description" />
        <meta content="Themesbrand" name="author" />
        <link rel="shortcut icon" href="images/Logo_icon.png">

        <!--Morris Chart CSS -->
        <link rel="stylesheet" href="plugins/morris/morris.css">
        <!-- DataTables -->
        <link href="{{ asset('plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('plugins/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
        <!--Chartist Chart CSS -->
        <link rel="stylesheet" href="{{ asset('plugins/chartist/css/chartist.min.css') }}">
        <!-- C3 charts css -->
        <link href="{{ asset('plugins/c3/c3.min.css') }}" rel="stylesheet" type="text/css" />

        {{-- Form Advance --}}
        <link href="{{ asset('plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css') }}" rel="stylesheet">
        <link href="{{ asset('plugins/bootstrap-md-datetimepicker/css/bootstrap-material-datetimepicker.css') }}" rel="stylesheet">
        <link href="{{ asset('plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('plugins/bootstrap-touchspin/css/jquery.bootstrap-touchspin.min.css') }}" rel="stylesheet" />
        <!-- Dropzone css -->
        <link href="{{ asset('plugins/dropzone/dist/dropzone.css') }}" rel="stylesheet" type="text/css">

        {{-- ======= --}}
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('css/icons.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css">
    </head>

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
    </body>

</html>