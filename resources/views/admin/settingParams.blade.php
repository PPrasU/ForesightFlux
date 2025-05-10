<!DOCTYPE html>
<html lang="en">
  <head>
    @include('admin.partials.header')
    <title>Admin | Setting Params</title>
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
                                      <th scope="col" style="text-align: center">Season Length</th>
                                      <th scope="col" style="text-align: center">Persentase Data Training</th>
                                      <th scope="col" style="text-align: center">Persentase Data Testing</th>
                                      <th scope="col" style="width: 15px; text-align: center">Aksi</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    @foreach ($data as $row)
                                        <tr>
                                            <td style="text-align: center">{{ $row->alpha }}</td>
                                            <td style="text-align: center">{{ $row->beta }}</td>
                                            <td style="text-align: center">{{ $row->gamma }}</td>
                                            <td style="text-align: center">{{ $row->season_length }}</td>
                                            <td style="text-align: center">{{ $row->training_percentage }}%</td>
                                            <td style="text-align: center">{{ $row->testing_percentage }}%</td>
                                            <td style="text-align: center">
                                              <a href="#" 
                                                class="btn btn-warning" 
                                                data-bs-toggle="modal"
                                                data-bs-target="#editSettingModal"
                                                data-id="{{ $row->id }}"
                                                data-alpha="{{ $row->alpha }}"
                                                data-beta="{{ $row->beta }}"
                                                data-gamma="{{ $row->gamma }}"
                                                data-season_length="{{ $row->season_length }}"
                                                data-training="{{ $row->training_percentage }}"
                                                data-testing="{{ $row->testing_percentage }}"
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
                                            <label for="season_length" class="form-label">Season Length</label>
                                            <select class="form-control" name="season_length" id="season_length">
                                              <option value="7">7 (mingguan)</option>
                                              <option value="30">30 (bulanan)</option>
                                              <option value="90">90 (kuartalan)</option>
                                            </select>
                                          </div>
                                          <div class="mb-3">
                                            <label for="training_percentage" class="form-label">Training %</label>
                                            <input type="number" class="form-control" name="training_percentage" id="training_percentage" min="0" max="100" readonly>
                                          </div>
                                          <div class="mb-3">
                                            <label for="testing_percentage" class="form-label">Testing %</label>
                                            <input type="number" class="form-control" name="testing_percentage" id="testing_percentage" readonly>
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
          const modal = document.getElementById('editSettingModal');
          modal.addEventListener('show.bs.modal', function (event) {
              const button = event.relatedTarget;
              
              document.querySelector('#setting-id').value = button.getAttribute('data-id');
              document.querySelector('#alpha').value = button.getAttribute('data-alpha');
              document.querySelector('#beta').value = button.getAttribute('data-beta');
              document.querySelector('#gamma').value = button.getAttribute('data-gamma');
              document.querySelector('#season_length').value = button.getAttribute('data-season_length');
              document.querySelector('#training_percentage').value = button.getAttribute('data-training');
              document.querySelector('#testing_percentage').value = button.getAttribute('data-testing');
          });
      });
    </script>

    {{-- isi form action modal --}}
    <script>
      document.addEventListener('DOMContentLoaded', function () {
          const editButtons = document.querySelectorAll('a[data-bs-target="#editSettingModal"]');
          const form = document.getElementById('editSettingForm');
      
          editButtons.forEach(btn => {
              btn.addEventListener('click', function () {
                  const id = this.dataset.id;
                  form.action = `/admin/setting-params/update/${id}`; // sesuaikan dengan route update kamu
      
                  document.getElementById('alpha').value = this.dataset.alpha;
                  document.getElementById('beta').value = this.dataset.beta;
                  document.getElementById('gamma').value = this.dataset.gamma;
                  document.getElementById('season_length').value = this.dataset.season_length;
                  document.getElementById('training_percentage').value = this.dataset.training;
                  document.getElementById('testing_percentage').value = this.dataset.testing;
              });
          });
      });
    </script>
    
    {{-- agar testing terisi otomatis --}}
    <script>
      document.addEventListener('DOMContentLoaded', function () {
        const trainingInput = document.getElementById('training_percentage');
        const testingInput = document.getElementById('testing_percentage');
    
        // Set testing % otomatis saat nilai training diubah
        trainingInput.addEventListener('input', function () {
          const trainingVal = parseFloat(this.value);
          if (!isNaN(trainingVal) && trainingVal >= 0 && trainingVal <= 100) {
            testingInput.value = 100 - trainingVal;
          } else {
            testingInput.value = '';
          }
        });
    
        // Saat tombol edit diklik, data juga tetap diatur
        const editButtons = document.querySelectorAll('a[data-bs-target="#editSettingModal"]');
        const form = document.getElementById('editSettingForm');
    
        editButtons.forEach(btn => {
          btn.addEventListener('click', function () {
            const id = this.dataset.id;
            form.action = `/admin/setting-params/update/${id}`;
    
            document.getElementById('alpha').value = this.dataset.alpha;
            document.getElementById('beta').value = this.dataset.beta;
            document.getElementById('gamma').value = this.dataset.gamma;
            document.getElementById('season_length').value = this.dataset.season_length;
    
            const training = this.dataset.training;
            document.getElementById('training_percentage').value = training;
            document.getElementById('testing_percentage').value = 100 - training;
          });
        });
      });
    </script>
    
  </body>
</html>
