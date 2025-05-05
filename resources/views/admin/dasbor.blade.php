<!DOCTYPE html>
<html lang="en">
  <head>
    @include('admin.partials.header')
    <title>Admin | Dasbor</title>
  </head>

  <body>
    <div id="wrapper">
      @include('admin.partials.topbar')
      @include('admin.partials.sidebar')
      
      <div class="content-page">
        <div class="content">
          <div class="container-fluid">

            <div class="row">
              <div class="col-sm-12">
                <div class="page-title-box">
                  <h4 class="page-title">Admin Dasbor</h4>
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item active">
                      Yo Admin Balik Lagi Nih, Mangatzxzx!
                    </li>
                  </ol>

                  <div class="state-information d-none d-sm-block">
                    <div class="state-graph">
                      <div id="header-chart-1"></div>
                      <div class="info">User</div>
                    </div>
                    <div class="state-graph">
                      <div id="header-chart-2"></div>
                      <div class="info">Setting</div>
                    </div>
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
                                      <h6 class="text-uppercase verti-label text-white-50">User</h6>
                                      <div class="text-white">
                                          <h6 class="text-uppercase mt-0 text-white-50">Total</h6>
                                          <h3 class="mb-3 mt-0">15</h3>
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
                                      <h6 class="text-uppercase verti-label text-white-50">Setting</h6>
                                      <div class="text-white">
                                          <h6 class="text-uppercase mt-0 text-white-50">Total</h6>
                                          <h3 class="mb-3 mt-0">6</h3>
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
                                      <h6 class="text-uppercase verti-label text-white-50">Import Data</h6>
                                      <div class="text-white">
                                          <h6 class="text-uppercase mt-0 text-white-50">Petunjuk Penggunaan</h6>
                                          <h3 class="mb-3 mt-0">10</h3>
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
                                      <h6 class="text-uppercase verti-label text-white-50">Data API</h6>
                                      <div class="text-white">
                                          <h6 class="text-uppercase mt-0 text-white-50">Petunjuk Penggunaan</h6>
                                          <h3 class="mb-3 mt-0">5</h3>
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
                                  <h4 class="mt-0 header-title mb-3">Tabel User Management</h4>
                                  <div class="table-responsive">
                                      <table class="table table-hover mb-0">
                                          <thead>
                                            <tr>
                                              <th scope="col">No</th>
                                              <th scope="col">Username</th>
                                              <th scope="col">IP Address</th>
                                              <th scope="col">Login Terakhir</th>
                                            </tr>
                                          </thead>
                                          <tbody>
                                            <tr>
                                              <th scope="row">1</th>
                                              <td>test_test</td>
                                              <td>------</td>
                                              <td>------</td>
                                            </tr>
                                            <tr>
                                              <th scope="row">2</th>
                                              <td>test_test</td>
                                              <td>------</td>
                                              <td>------</td>
                                            </tr>
                                            <tr>
                                              <th scope="row">3</th>
                                              <td>test_test</td>
                                              <td>------</td>
                                              <td>------</td>
                                            </tr>
                                            <tr>
                                              <th scope="row">4</th>
                                              <td>test_test</td>
                                              <td>------</td>
                                              <td>------</td>
                                            </tr>
                                            <tr>
                                              <th scope="row">5</th>
                                              <td>test_test</td>
                                              <td>------</td>
                                              <td>------</td>
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
                                  <h4 class="mt-0 header-title mb-3">Tabel Setting</h4>
                                  <div class="table-responsive order-table">
                                      <table class="table table-hover mb-0">
                                          <thead>
                                              <tr>
                                              <th scope="col">No</th>
                                              <th scope="col">Bagian</th>
                                              <th scope="col">Nilai</th>
                                              </tr>
                                          </thead>
                                          <tbody>
                                              <tr>
                                                  <th scope="row">1</th>
                                                  <td>Persentase Training (%)</td>
                                                  <td>80</td>
                                              </tr>
                                              <tr>
                                                  <th scope="row">2</th>
                                                  <td>Persentase Testing (%)</td>
                                                  <td>20</td>
                                              </tr>
                                              <tr>
                                                  <th scope="row">3</th>
                                                  <td>Alpha (0 s/d 1)</td>
                                                  <td>0.01</td>
                                              </tr>
                                              <tr>
                                                  <th scope="row">4</th>
                                                  <td>Beta (0 s/d 1)</td>
                                                  <td>0.02</td>
                                              </tr>
                                              <tr>
                                                  <th scope="row">5</th>
                                                  <td>Gamma (0 s/d 1)</td>
                                                  <td>0.03</td>
                                              </tr>
                                          </tbody>
                                      </table>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>

                  <div class="row">
                      <div class="col-xl-6">
                          <div class="card">
                              <div class="card-body">
                                  <h4 class="mt-0 header-title mb-3">Tabel Petunjuk Penggunaan Import Data</h4>
                                  <div class="table-responsive">
                                      <table class="table table-hover mb-0">
                                          <thead>
                                            <tr>
                                              <th scope="col">No</th>
                                              <th scope="col">Judul</th>
                                              <th scope="col">Deskripsi 1</th>
                                              <th scope="col">Deskripsi 2</th>
                                              <th scope="col">Deskripsi 3</th>
                                            </tr>
                                          </thead>
                                          <tbody>
                                            <tr>
                                              <th scope="row">1</th>
                                              <td>Cari Sumber Data Historis</td>
                                              <td>-----</td>
                                              <td>-----</td>
                                              <td>-----</td>
                                            </tr>
                                            <tr>
                                              <th scope="row">2</th>
                                              <td>Pilih Aset Kripto lalu Masuk Ke Submenu Historical Data/Data Historis</td>
                                              <td>-----</td>
                                              <td>-----</td>
                                              <td>-----</td>
                                            </tr>
                                            <tr>
                                              <th scope="row">3</th>
                                              <td>Pilih Jangka Waktu, Ubah Mata Uang, Ubah Menjadi Ascending</td>
                                              <td>-----</td>
                                              <td>-----</td>
                                              <td>-----</td>
                                            </tr>
                                            <tr>
                                              <th scope="row">4</th>
                                              <td>Data Historis Yang Sudah Diatur</td>
                                              <td>-----</td>
                                              <td>-----</td>
                                              <td>-----</td>
                                            </tr>
                                            <tr>
                                              <th scope="row">5</th>
                                              <td>Download Data Historis Yang Sudah Diatur</td>
                                              <td>-----</td>
                                              <td>-----</td>
                                              <td>-----</td>
                                            </tr>
                                          </tbody>
                                      </table>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <div class="col-xl-6">
                          <div class="card">
                              <div class="card-body">
                                  <h4 class="mt-0 header-title mb-3">Tabel Petunjuk Penggunaan API</h4>
                                  <div class="table-responsive order-table">
                                    <table class="table table-hover mb-0">
                                      <thead>
                                        <tr>
                                          <th scope="col">No</th>
                                          <th scope="col">Judul</th>
                                          <th scope="col">Deskripsi 1</th>
                                          <th scope="col">Deskripsi 2</th>
                                          <th scope="col">Deskripsi 3</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        <tr>
                                          <th scope="row">1</th>
                                          <td>Cari Sumber Data Historis</td>
                                          <td>-----</td>
                                          <td>-----</td>
                                          <td>-----</td>
                                        </tr>
                                        <tr>
                                          <th scope="row">2</th>
                                          <td>Pilih Aset Kripto lalu Masuk Ke Submenu Historical Data/Data Historis</td>
                                          <td>-----</td>
                                          <td>-----</td>
                                          <td>-----</td>
                                        </tr>
                                        <tr>
                                          <th scope="row">3</th>
                                          <td>Pilih Jangka Waktu, Ubah Mata Uang, Ubah Menjadi Ascending</td>
                                          <td>-----</td>
                                          <td>-----</td>
                                          <td>-----</td>
                                        </tr>
                                        <tr>
                                          <th scope="row">4</th>
                                          <td>Data Historis Yang Sudah Diatur</td>
                                          <td>-----</td>
                                          <td>-----</td>
                                          <td>-----</td>
                                        </tr>
                                        <tr>
                                          <th scope="row">5</th>
                                          <td>Download Data Historis Yang Sudah Diatur</td>
                                          <td>-----</td>
                                          <td>-----</td>
                                          <td>-----</td>
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
        </div>

        @include('admin.partials.footer')
      </div>

    </div>
    @include('admin.partials.scripts')
    
  </body>
</html>
