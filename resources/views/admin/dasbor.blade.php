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
                                      <h6 class="text-uppercase verti-label text-white-50">Parameter</h6>
                                      <div class="text-white">
                                          <h6 class="text-uppercase mt-0 text-white-50">Total</h6>
                                          <h3 class="mb-3 mt-0">6</h3>
                                          <div class="">
                                              <span class="badge badge-light text-danger"> -29% </span> <span class="ml-2">Dari Sebelumnya</span>
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
                                          <h3 class="mb-3 mt-0">12</h3>
                                          <div class="">
                                              <span class="badge badge-light text-primary"> +19% </span> <span class="ml-2">Dari Sebelumnya</span>
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
                                          <h3 class="mb-3 mt-0">7</h3>
                                          <div class="">
                                              <span class="badge badge-light text-info"> +8% </span> <span class="ml-2">Dari Hari Sebelumnya</span>
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
                                  <h4 class="mt-0 header-title mb-3">Tabel Setting Parameter</h4>
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
                                                  <td>{{ +$dataParam->training_percentage }}</td>
                                              </tr>
                                              <tr>
                                                  <th scope="row">2</th>
                                                  <td>Persentase Testing (%)</td>
                                                  <td>{{ +$dataParam->testing_percentage }}</td>
                                              </tr>
                                              <tr>
                                                  <th scope="row">3</th>
                                                  <td>Alpha (0 s/d 1)</td>
                                                  <td>{{ +$dataParam->alpha }}</td>
                                              </tr>
                                              <tr>
                                                  <th scope="row">4</th>
                                                  <td>Beta (0 s/d 1)</td>
                                                  <td>{{ +$dataParam->beta }}</td>
                                              </tr>
                                              <tr>
                                                  <th scope="row">5</th>
                                                  <td>Gamma (0 s/d 1)</td>
                                                  <td>{{ +$dataParam->gamma }}</td>
                                              </tr>
                                              <tr>
                                                  <th scope="row">5</th>
                                                  <td>Season Length</td>
                                                  <td>{{ +$dataParam->season_length_harian }}</td>
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
