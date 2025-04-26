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
                    <div class="row">
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-primary mini-stat position-relative">
                                <div class="card-body">
                                    <div class="mini-stat-desc">
                                        <h6 class="text-uppercase verti-label text-white-50">Close Price</h6>
                                        <div class="text-white">
                                            <h6 class="text-uppercase mt-0 text-white-50">Harga Penutupan</h6>
                                            <h3 class="mb-3 mt-0">Rp1.000.000</h3>
                                            <div class="">
                                                <span class="badge badge-light text-info"> +11% </span> <span class="ml-2">Dari Hari Sebelumnya</span>
                                            </div>
                                        </div>
                                        <div class="mini-stat-icon">
                                            <i class="mdi mdi-cube-outline display-2"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-primary mini-stat position-relative">
                                <div class="card-body">
                                    <div class="mini-stat-desc">
                                        <h6 class="text-uppercase verti-label text-white-50">Open Price</h6>
                                        <div class="text-white">
                                            <h6 class="text-uppercase mt-0 text-white-50">Harga Pembuka</h6>
                                            <h3 class="mb-3 mt-0">Rp1.000.000</h3>
                                            <div class="">
                                                <span class="badge badge-light text-danger"> -29% </span> <span class="ml-2">Dari Hari Sebelumnya</span>
                                            </div>
                                        </div>
                                        <div class="mini-stat-icon">
                                            <i class="mdi mdi-buffer display-2"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-primary mini-stat position-relative">
                                <div class="card-body">
                                    <div class="mini-stat-desc">
                                        <h6 class="text-uppercase verti-label text-white-50">Max Price</h6>
                                        <div class="text-white">
                                            <h6 class="text-uppercase mt-0 text-white-50">Harga Tertinggi</h6>
                                            <h3 class="mb-3 mt-0">Rp1.000.000</h3>
                                            <div class="">
                                                <span class="badge badge-light text-primary"> 0% </span> <span class="ml-2">Dari Hari Sebelumnya</span>
                                            </div>
                                        </div>
                                        <div class="mini-stat-icon">
                                            <i class="mdi mdi-tag-text-outline display-2"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-primary mini-stat position-relative">
                                <div class="card-body">
                                    <div class="mini-stat-desc">
                                        <h6 class="text-uppercase verti-label text-white-50">Min Price</h6>
                                        <div class="text-white">
                                            <h6 class="text-uppercase mt-0 text-white-50">Harga Terendah</h6>
                                            <h3 class="mb-3 mt-0">Rp1.000.000</h3>
                                            <div class="">
                                                <span class="badge badge-light text-info"> +89% </span> <span class="ml-2">Dari Hari Sebelumnya</span>
                                            </div>
                                        </div>
                                        <div class="mini-stat-icon">
                                            <i class="mdi mdi-briefcase-check display-2"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xl-9">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="mt-0 header-title mb-4">Tabel Data Historis Kripto</h4>
                                    <div class="table-responsive">
                                        <table class="table table-hover mb-0">
                                            <thead>
                                              <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Tanggal</th>
                                                <th scope="col">Open</th>
                                                <th scope="col">High</th>
                                                <th scope="col">Low</th>
                                                <th scope="col">Close</th>
                                                <th scope="col">Volume</th>
                                              </tr>
                                            </thead>
                                            <tbody>
                                              <tr>
                                                <th scope="row">1</th>
                                                <td>17-02-2025</td>
                                                <td>Rp100.000</td>
                                                <td>Rp100.000</td>
                                                <td>Rp100.000</td>
                                                <td>Rp100.000</td>
                                                <td>Rp100.000</td>
                                              </tr>
                                              <tr>
                                                <th scope="row">2</th>
                                                <td>16-02-2025</td>
                                                <td>Rp100.000</td>
                                                <td>Rp100.000</td>
                                                <td>Rp100.000</td>
                                                <td>Rp100.000</td>
                                                <td>Rp100.000</td>
                                              </tr>
                                              <tr>
                                                <th scope="row">3</th>
                                                <td>15-02-2025</td>
                                                <td>Rp100.000</td>
                                                <td>Rp100.000</td>
                                                <td>Rp100.000</td>
                                                <td>Rp100.000</td>
                                                <td>Rp100.000</td>
                                              </tr>
                                              <tr>
                                                <th scope="row">4</th>
                                                <td>14-02-2025</td>
                                                <td>Rp100.000</td>
                                                <td>Rp100.000</td>
                                                <td>Rp100.000</td>
                                                <td>Rp100.000</td>
                                                <td>Rp100.000</td>
                                              </tr>
                                              <tr>
                                                <th scope="row">5</th>
                                                <td>13-02-2025</td>
                                                <td>Rp100.000</td>
                                                <td>Rp100.000</td>
                                                <td>Rp100.000</td>
                                                <td>Rp100.000</td>
                                                <td>Rp100.000</td>
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
                                    <h4 class="mt-0 header-title mb-4">Tabel Hasil Peramalan</h4>
                                    <div class="table-responsive order-table">
                                        <table class="table table-hover mb-0">
                                            <thead>
                                                <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Tanggal</th>
                                                <th scope="col">Hasil Prediksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <th scope="row">1</th>
                                                    <td>22-02-2025</td>
                                                    <td>Rp100.000</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">2</th>
                                                    <td>21-02-2025</td>
                                                    <td>Rp100.000</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">3</th>
                                                    <td>20-02-2025</td>
                                                    <td>Rp100.000</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">4</th>
                                                    <td>19-02-2025</td>
                                                    <td>Rp100.000</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">5</th>
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
                </div>
            </div>
        </div>

        @include('partials.footer')
        @include('partials.scripts')
    </body>

</html>