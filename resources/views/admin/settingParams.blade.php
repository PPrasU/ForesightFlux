<!DOCTYPE html>
<html lang="en">
  <head>
    @include('admin.partials.header')
    <title>ForesightFluxCP | Setting Params</title>
    <!-- DataTables -->
    <link href="{{ asset('plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('plugins/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Responsive datatable examples -->
    <link href="{{ asset('plugins/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <style>
        /* Style normal tombol */
        .btn-warning {
            background-color: #f0ad4e;
            border-color: #eea236;
            color: white;
        }

        /* Hover tombol Edit */
        .btn-warning:hover {
            background-color: #ec971f;
            border-color: #d58512;
            color: white;
        }

        /* Style normal tombol Delete */
        .btn-danger {
            background-color: #d9534f;
            border-color: #d43f3a;
            color: white;
        }

        /* Hover tombol Delete */
        .btn-danger:hover {
            background-color: #c9302c;
            border-color: #ac2925;
            color: white;
        }
        .btn-warning:hover,
        .btn-danger:hover {
            transform: scale(1.05);
            transition: all 0.3s ease;
        }

    </style>
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
                  <h4 class="page-title">Setting Params</h4>
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item active">
                      Isine Buat Halaman Setting Params Kayak Percentage Buat Data Training Sama Testing, Parameter Metode Kayak Alpha, Beta, sama Gamma, Gituuuuu
                    </li>
                  </ol>
                </div>
              </div>
            </div>

            <div class="page-content-wrapper">
              <div class="container-fluid">
                {{-- Isine tabel --}}
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
                                <h3 class="mt-0 header-title">Tabel Setting Params</h3>
                            </div>
                          
                            <table class="table mb-0">
                                <thead class="thead-default">
                                  <tr>
                                    <th scope="col" style="text-align: center">Parameter Alpha</th>
                                    <th scope="col" style="text-align: center">Parameter Beta</th>
                                    <th scope="col" style="text-align: center">Parameter Gamma</th>
                                    <th scope="col" style="text-align: center">
                                      @if ($jenisData === 'Harian')
                                          Season Length (Harian)
                                      @elseif ($jenisData === 'Mingguan')
                                          Season Length (Mingguan)
                                      @else
                                          Season Length
                                      @endif
                                    </th>
                                    <th scope="col" style="text-align: center">Persentase Data Training</th>
                                    <th scope="col" style="text-align: center">Persentase Data Testing</th>
                                    <th scope="col" style="width: 15px; text-align: center">Aksi</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  @foreach ($dataParam as $row)
                                    <tr>
                                        <td style="text-align: center">{{ +$row->alpha }}</td>
                                        <td style="text-align: center">{{ +$row->beta }}</td>
                                        <td style="text-align: center">{{ +$row->gamma }}</td>
                                        <td style="text-align: center">
                                            @if ($jenisData === 'Harian')
                                                @switch((int) $row->season_length_harian)
                                                    @case(7)
                                                        7 (Mingguan)
                                                        @break
                                                    @case(30)
                                                        30 (Bulanan)
                                                        @break
                                                    @case(90)
                                                        90 (Kuartal)
                                                        @break
                                                    @case(365)
                                                        365 (Tahunan)
                                                        @break
                                                    @default
                                                        {{ +$row->season_length_harian }}
                                                @endswitch
                                            @elseif ($jenisData === 'Mingguan')
                                                @switch((int) $row->season_length_mingguan)
                                                    @case(4)
                                                        4 (Bulanan)
                                                        @break
                                                    @case(12)
                                                        12 (Kuartal)
                                                        @break
                                                    @case(52)
                                                        52 (Tahunan)
                                                        @break
                                                    @default
                                                        {{ +$row->season_length_mingguan }}
                                                @endswitch
                                            @else
                                                {{ +$row->season_length_harian }}
                                            @endif
                                        </td>
                                        <td style="text-align: center">{{ +$row->training_percentage }}%</td>
                                        <td style="text-align: center">{{ +$row->testing_percentage }}%</td>
                                        <td style="text-align: center">
                                            <a href="#"
                                                class="btn btn-warning"
                                                data-bs-toggle="modal"
                                                data-bs-target="#editSettingModal"
                                                data-id="{{ $row->id }}"
                                                data-alpha="{{ $row->alpha }}"
                                                data-beta="{{ $row->beta }}"
                                                data-gamma="{{ $row->gamma }}"
                                                data-training="{{ $row->training_percentage }}"
                                                data-testing="{{ $row->testing_percentage }}"
                                                data-season_length="{{ $jenisData === 'Harian' ? $row->season_length_harian : $row->season_length_mingguan }}"
                                                data-jenis_data="{{ $jenisData }}"
                                                title="Edit Data">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        </td>
                                    </tr>
                                  @endforeach
                                </tbody>
                            </table>

                            <!-- Modal -->
                            <div class="modal fade" id="editSettingModal" tabindex="-1" aria-labelledby="editSettingModalLabel" aria-hidden="true">
                              <div class="modal-dialog">
                                <form method="POST" id="editSettingForm" action="">
                                    @csrf
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="editSettingModalLabel">Edit Setting Param</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                      </div>
                                      <div class="modal-body">
                                        <input type="hidden" name="id" id="setting-id">
                                        
                                        <div class="mb-3">
                                          <label for="alpha" class="form-label">Alpha</label>
                                          <input type="text" class="form-control" name="alpha" id="alpha">
                                        </div>
                                        <div class="mb-3">
                                          <label for="beta" class="form-label">Beta</label>
                                          <input type="text" class="form-control" name="beta" id="beta">
                                        </div>
                                        <div class="mb-3">
                                          <label for="gamma" class="form-label">Gamma</label>
                                          <input type="text" class="form-control" name="gamma" id="gamma">
                                        </div>
                                        <div class="mb-3">
                                          <label for="training_percentage" class="form-label">Training %</label>
                                          <input type="number" class="form-control" name="training_percentage" id="training_percentage" min="0" max="100">
                                        </div>
                                        <div class="mb-3">
                                          <label for="testing_percentage" class="form-label">Testing %</label>
                                          <input type="number" class="form-control" name="testing_percentage" id="testing_percentage" readonly>
                                        </div>
                                        <div class="mb-3" id="seasonLengthHarianDiv">
                                            <label class="form-label">Season Length Harian (Default)</label>
                                            <select class="form-control" name="season_length_harian" id="season_length_harian">
                                                <option value="7" {{ $setting->season_length_harian == 7 ? 'selected' : '' }}>7 (mingguan)</option>
                                                <option value="30" {{ $setting->season_length_harian == 30 ? 'selected' : '' }}>30 (bulanan) default</option>
                                                <option value="90" {{ $setting->season_length_harian == 90 ? 'selected' : '' }}>90 (kuartalan)</option>
                                                <option value="365" {{ $setting->season_length_harian == 365 ? 'selected' : '' }}>365 (tahunan)</option>
                                            </select>
                                        </div>
                                        <div class="mb-3" id="seasonLengthMingguanDiv" style="display: none;">
                                            <label class="form-label">Season Length Mingguan</label>
                                            <select class="form-control" name="season_length_mingguan" id="season_length_mingguan">
                                                <option value="4" {{ $setting->season_length_mingguan == 4 ? 'selected' : '' }}>4 (bulanan) default</option>
                                                <option value="13" {{ $setting->season_length_mingguan == 13 ? 'selected' : '' }}>13 (kuartal)</option>
                                                <option value="52" {{ $setting->season_length_mingguan == 52 ? 'selected' : '' }}>52 (tahunan)</option>
                                            </select>
                                        </div>
                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                      </div>
                                    </div>
                                </form>
                              </div>
                            </div>

                          </div>
                      </div>
                  </div>
                </div>
                @if ($training->count() > 0)
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
                                </div>
                                
                                @php
                                  $source = $training->first()->source ?? null;
                                  $name = $source->display_name ?? $source->name ?? '-';
                                  $start = $source ? \Carbon\Carbon::parse($source->periode_awal)->format('m-d-Y') : '-';
                                  $end = $source ? \Carbon\Carbon::parse($source->periode_akhir)->format('m-d-Y') : '-';
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
                  {{-- buat ngecek aja ini --}}
                  <div class="row">
                      <div class="col-xl-12">
                          <div class="card">
                              <div class="card-body">
                                  <div class="d-flex justify-content-between align-items-center mb-4">
                                      <h3 class="mt-0 header-title">Tabel Hasil Peramalan Data Testing</h3>
                                  </div>
                                  <table id="datatable2" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                      <thead>
                                          <tr>
                                              <th style="width: 10px" hidden>No</th>
                                              <th style="width: 100px">Tanggal</th>
                                              <th>Aktual</th>
                                              <th>Hasil Peramalan</th>
                                              <th style="width: 150px">Error</th>
                                              <th style="width: 100px">Absolute Error</th>
                                              <th style="width: 100px">Error Square</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                          @foreach ($testing as $row)
                                              <tr>
                                                  <td style="text-align: center" hidden>{{ $row->id }}</td>
                                                  <td style="text-align: center">{{ $row->date }}</td>
                                                  <td>{{ $row->actual }}</td>
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

                  <div class="row">
                      <div class="col-xl-12">
                          <div class="card">
                              <div class="card-body">
                                  <div class="d-flex justify-content-between align-items-center mb-4">
                                      <h3 class="mt-0 header-title">Tabel Hasil Perhitungan Akurasi</h3>
                                  </div>
                                  <table id="datatable3" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                      <thead>
                                          <tr>
                                              <th style="width: 100px">MAPE</th>
                                              <th style="width: 150px">RMSE</th>
                                              <th style="width: 100px">Rata-Rata Aktual</th>
                                              <th style="width: 100px">Relative RMSE</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                          @foreach ($akurasi as $row)
                                              <tr>
                                                  <td>{{ $row->mape }}</td>
                                                  <td>{{ $row->rmse }}</td>
                                                  <td>{{ $row->avg_actual }}</td>
                                                  <td>{{ $row->relative_rmse }}</td>
                                              </tr>
                                          @endforeach
                                      </tbody>
                                  </table>
                              </div>
                          </div>
                      </div>
                  </div>
                @endif
                
                @if ($dataPraproses->count() > 0)
                  <div class="row">
                      <div class="col-xl-12">
                          <div class="card">
                              <div class="card-body">
                                  <div class="d-flex justify-content-between align-items-center mb-4">
                                      <h3 class="mt-0 header-title">Kombinasi Parameter Terbaik</h3>
                                  </div>
                                  <form id="optimizeForm" method="POST" action="{{ route('admin.optimize') }}">
                                    @csrf
                                    <button id="optimizeBtn" class="btn btn-primary mb-3" type="submit">
                                        🔍 Jalankan Grid Search
                                    </button>
                                  </form>
                                  <div class="mb-4">
                                        <p class="mb-1"><strong>MAPE Terbaik</strong></p>
                                        <p class="mb-1"><strong>Training Testing (90:10):</strong> 
                                            {{ $best_results[90]['mape'] ?? 'N/A' }}% (α={{ $best_results[90]['alpha'] ?? '-' }}, β={{ $best_results[90]['beta'] ?? '-' }}, γ={{ $best_results[90]['gamma'] ?? '-' }})
                                        </p>
                                        <p class="mb-1"><strong>Training Testing (80:20):</strong> 
                                            {{ $best_results[80]['mape'] ?? 'N/A' }}% (α={{ $best_results[80]['alpha'] ?? '-' }}, β={{ $best_results[80]['beta'] ?? '-' }}, γ={{ $best_results[80]['gamma'] ?? '-' }})
                                        </p>
                                        <p class="mb-1"><strong>Training Testing (70:30):</strong> 
                                            {{ $best_results[70]['mape'] ?? 'N/A' }}% (α={{ $best_results[70]['alpha'] ?? '-' }}, β={{ $best_results[70]['beta'] ?? '-' }}, γ={{ $best_results[70]['gamma'] ?? '-' }})
                                        </p>
                                        <p class="mb-1"><strong>Training Testing (60:40):</strong> 
                                            {{ $best_results[60]['mape'] ?? 'N/A' }}% (α={{ $best_results[60]['alpha'] ?? '-' }}, β={{ $best_results[60]['beta'] ?? '-' }}, γ={{ $best_results[60]['gamma'] ?? '-' }})
                                        </p>
                                        <p><strong>Jenis Data:</strong> {{ $jenisData }} (Season Length: {{ $seasonLength }})</p>
                                        <h5>Total Data Training dan Testing Berdasarkan Persentase:</h5>
                                        <ul>
                                            @foreach ($totalCounts as $percent => $counts)
                                                <li>
                                                    <strong>{{ $percent }}% Training</strong>:
                                                    Training = {{ $counts['training'] }}, 
                                                    Testing = {{ $counts['testing'] }}
                                                </li>
                                            @endforeach
                                        </ul>

                                  </div>

                                  @if(isset($grid_results) && isset($best_results))
                                      <h4 class="mt-4">🔍 Hasil Grid Search</h4>
                                      <div class="table-responsive">
                                          <table id="datatable4" class="table table-bordered table-hover">
                                              <thead class="table-dark text-center">
                                                  <tr>
                                                      <th>Training</th>
                                                      <th>Testing</th>
                                                      <th>Alpha</th>
                                                      <th>Beta</th>
                                                      <th>Gamma</th>
                                                      <th>MAPE</th>
                                                      <th>RMSE</th>
                                                      <th>rRMSE</th>
                                                  </tr>
                                              </thead>
                                              <tbody>
                                                  @foreach($grid_results as $res)
                                                      @php
                                                          $best = $best_results[$res['training']] ?? null;
                                                          $isBest = $best &&
                                                              $res['alpha'] == $best['alpha'] &&
                                                              $res['beta'] == $best['beta'] &&
                                                              $res['gamma'] == $best['gamma'];
                                                      @endphp
                                                      <tr class="{{ $isBest ? 'table-success fw-bold' : '' }}">
                                                          <td class="text-center">{{ $res['training'] }}</td>
                                                          <td class="text-center">{{ $res['testing'] }}</td>
                                                          <td class="text-center">{{ $res['alpha'] }}</td>
                                                          <td class="text-center">{{ $res['beta'] }}</td>
                                                          <td class="text-center">{{ $res['gamma'] }}</td>
                                                          <td>{{ number_format($res['mape'], 4) }}</td>
                                                          <td>{{ number_format($res['rmse'], 4) }}</td>
                                                          <td>{{ number_format($res['rrmse'], 4) }}</td>
                                                      </tr>
                                                  @endforeach
                                              </tbody>
                                          </table>
                                          <div class="alert alert-info">
                                              Setiap baris <span class="fw-bold text-success">berwarna hijau</span> menandakan kombinasi α, β, γ terbaik berdasarkan MAPE untuk masing-masing <strong>persentase training</strong>.
                                          </div>
                                      </div>
                                  @endif

                              </div>
                          </div>
                      </div>
                  </div>
                @endif
              </div>
            </div>
          </div>
        </div>

        @include('admin.partials.footer')
      </div>

    </div>
    @include('admin.partials.scripts')
    {{-- DATATABLE JS --}}
    <!-- Required datatable js -->
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
    {{-- Datatable Pages --}}
    <script src="{{ asset('pages/datatables.init.js') }}"></script>
    <script>
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl, {
                delay: { show: 0, hide: 0 } // <- ini bikin tanpa delay
            });
        });
    </script>
    
    {{-- buat modal --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
      document.addEventListener('DOMContentLoaded', function () {
        // Inisialisasi DataTables
        ['#datatable1', '#datatable2', '#datatable3', '#datatable4'].forEach(id => {
          $(id).DataTable();
        });

        const trainingInput = document.getElementById('training_percentage');
        const testingInput = document.getElementById('testing_percentage');
        const form = document.getElementById('editSettingForm');
        const settingId = document.getElementById('setting-id');

        const alphaInput = document.getElementById('alpha');
        const betaInput = document.getElementById('beta');
        const gammaInput = document.getElementById('gamma');
        const seasonLengthInput = document.getElementById('season_length');

        // Update nilai testing saat training diubah manual
        trainingInput.addEventListener('input', function () {
          const trainingVal = parseFloat(this.value);
          if (!isNaN(trainingVal) && trainingVal >= 0 && trainingVal <= 100) {
            testingInput.value = 100 - trainingVal;
          } else {
            testingInput.value = '';
          }
        });

        // Saat tombol edit diklik
        const editButtons = document.querySelectorAll('a[data-bs-target="#editSettingModal"]');
        editButtons.forEach(btn => {
          btn.addEventListener('click', function () {
            const id = this.dataset.id;

            // Set action form
            form.action = `/admin/setting-params/update/${id}`;
            settingId.value = id;

            // Set nilai input dari dataset tombol
            alphaInput.value = this.dataset.alpha;
            betaInput.value = this.dataset.beta;
            gammaInput.value = this.dataset.gamma;

            const training = parseFloat(this.dataset.training);
            const testing = parseFloat(this.dataset.testing);

            trainingInput.value = !isNaN(training) ? training : '';
            testingInput.value = !isNaN(testing) ? testing : '';
          });
        });

        const jenisData = this.dataset.jenis_data;
        const seasonLengthHarianDiv = document.getElementById('seasonLengthHarianDiv');
        const seasonLengthMingguanDiv = document.getElementById('seasonLengthMingguanDiv');
        const seasonLengthHarian = document.getElementById('season_length_harian');
        const seasonLengthMingguan = document.getElementById('season_length_mingguan');
        const seasonLength = this.dataset.season_length;

        // Tampilkan sesuai jenis data
        if (jenisData === 'Harian') {
            seasonLengthHarianDiv.style.display = 'block';
            seasonLengthMingguanDiv.style.display = 'none';
            seasonLengthHarian.value = seasonLength;
        } else if (jenisData === 'Mingguan') {
            seasonLengthHarianDiv.style.display = 'none';
            seasonLengthMingguanDiv.style.display = 'block';
            seasonLengthMingguan.value = seasonLength;
        }
      });
    </script>

    {{-- buat animasi loading --}}
    <!-- Tambahkan ini di bagian akhir halaman -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const form = document.getElementById("optimizeForm");

            form.addEventListener("submit", function(event) {
                event.preventDefault();  // Cegah submit default

                // Tampilkan SweetAlert2 loading
                Swal.fire({
                    title: 'Sedang melakukan Grid Search...',
                    text: 'Sabar ya, ini bukan ngelag... cuma kerja keras ajah 😆🔄',
                    allowOutsideClick: false,
                    showConfirmButton: false,
                    didOpen: () => {
                        Swal.showLoading();

                        // Submit form setelah alert tampil
                        form.submit();
                    }
                });
            });
        });
    </script>

    
  </body>
</html>
