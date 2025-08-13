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
                                        Isine Buat Halaman Setting Params Kayak Percentage Buat Data Training Sama
                                        Testing, Parameter Metode Kayak Alpha, Beta, sama Gamma, Gituuuuu
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
                                            @if (session('error'))
                                                <div class="alert alert-danger" role="alert"
                                                    style="text-align: center">
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
                                                        <th scope="col" style="text-align: center">Parameter Alpha
                                                        </th>
                                                        <th scope="col" style="text-align: center">Parameter Beta
                                                        </th>
                                                        <th scope="col" style="text-align: center">Parameter Gamma
                                                        </th>
                                                        <th scope="col" style="text-align: center">
                                                            @if ($jenisData === 'Harian')
                                                                Season Length (Harian)
                                                            @elseif ($jenisData === 'Mingguan')
                                                                Season Length (Mingguan)
                                                            @else
                                                                Season Length
                                                            @endif
                                                        </th>
                                                        <th scope="col" style="text-align: center">Persentase Data
                                                            Training</th>
                                                        <th scope="col" style="text-align: center">Persentase Data
                                                            Testing</th>
                                                        <th scope="col" style="width: 15px; text-align: center">Aksi
                                                        </th>
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
                                                            <td style="text-align: center">
                                                                {{ +$row->training_percentage }}%</td>
                                                            <td style="text-align: center">
                                                                {{ +$row->testing_percentage }}%</td>
                                                            <td style="text-align: center">
                                                                <a href="#" class="btn btn-warning"
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
                                            <div class="modal fade" id="editSettingModal" tabindex="-1"
                                                aria-labelledby="editSettingModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <form method="POST" id="editSettingForm" action="">
                                                        @csrf
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="editSettingModalLabel">Edit
                                                                    Setting Param</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <input type="hidden" name="id" id="setting-id">

                                                                <div class="mb-3">
                                                                    <label for="alpha"
                                                                        class="form-label">Alpha</label>
                                                                    <input type="text" class="form-control"
                                                                        name="alpha" id="alpha"
                                                                        value="{{ old('alpha', $row->alpha !== null ? rtrim(rtrim(number_format($row->alpha, 4, '.', ''), '0'), '.') : '') }}">
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label for="beta"
                                                                        class="form-label">Beta</label>
                                                                    <input type="text" class="form-control"
                                                                        name="beta" id="beta"
                                                                        value="{{ old('beta', $row->beta !== null ? rtrim(rtrim(number_format($row->beta, 4, '.', ''), '0'), '.') : '') }}">
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label for="gamma"
                                                                        class="form-label">Gamma</label>
                                                                    <input type="text" class="form-control"
                                                                        name="gamma" id="gamma"
                                                                        value="{{ old('gamma', $row->gamma !== null ? rtrim(rtrim(number_format($row->gamma, 4, '.', ''), '0'), '.') : '') }}">
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label for="training_percentage"
                                                                        class="form-label">Training %</label>
                                                                    <input type="number" class="form-control"
                                                                        name="training_percentage"
                                                                        id="training_percentage" min="0"
                                                                        max="100">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="testing_percentage"
                                                                        class="form-label">Testing %</label>
                                                                    <input type="number" class="form-control"
                                                                        name="testing_percentage"
                                                                        id="testing_percentage" readonly>
                                                                </div>
                                                                <div class="mb-3" id="seasonLengthHarianDiv">
                                                                    <label class="form-label">Season Length Harian
                                                                        (Default)</label>
                                                                    <select class="form-control"
                                                                        name="season_length_harian"
                                                                        id="season_length_harian">
                                                                        <option value="7"
                                                                            {{ $setting->season_length_harian == 7 ? 'selected' : '' }}>
                                                                            7 (mingguan)</option>
                                                                        <option value="30"
                                                                            {{ $setting->season_length_harian == 30 ? 'selected' : '' }}>
                                                                            30 (bulanan) default</option>
                                                                        <option value="90"
                                                                            {{ $setting->season_length_harian == 90 ? 'selected' : '' }}>
                                                                            90 (kuartalan)</option>
                                                                        <option value="365"
                                                                            {{ $setting->season_length_harian == 365 ? 'selected' : '' }}>
                                                                            365 (tahunan)</option>
                                                                    </select>
                                                                </div>
                                                                <div class="mb-3" id="seasonLengthMingguanDiv"
                                                                    style="display: none;">
                                                                    <label class="form-label">Season Length
                                                                        Mingguan</label>
                                                                    <select class="form-control"
                                                                        name="season_length_mingguan"
                                                                        id="season_length_mingguan">
                                                                        <option value="4"
                                                                            {{ $setting->season_length_mingguan == 4 ? 'selected' : '' }}>
                                                                            4 (bulanan) default</option>
                                                                        <option value="13"
                                                                            {{ $setting->season_length_mingguan == 13 ? 'selected' : '' }}>
                                                                            13 (kuartal)</option>
                                                                        <option value="52"
                                                                            {{ $setting->season_length_mingguan == 52 ? 'selected' : '' }}>
                                                                            52 (tahunan)</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Batal</button>
                                                                <button type="submit" class="btn btn-primary">Simpan
                                                                    Perubahan</button>
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
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl, {
                delay: {
                    show: 0,
                    hide: 0
                } // <- ini bikin tanpa delay
            });
        });
    </script>

    {{-- buat modal --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Inisialisasi DataTables
            ['#datatable1', '#datatable2', '#datatable3', '#datatable4', '#datatable90', '#datatable180', '#datatable365', '#datatable730'].forEach(id => {
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
            trainingInput.addEventListener('input', function() {
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
                btn.addEventListener('click', function() {
                    const id = this.dataset.id;

                    // Set action form
                    form.action = `/setting-params/update/${id}`;
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
        document.addEventListener("DOMContentLoaded", function() {
            const form = document.getElementById("optimizeForm");

            form.addEventListener("submit", function(event) {
                event.preventDefault(); // Cegah submit default

                // Tampilkan SweetAlert2 loading
                Swal.fire({
                    title: 'Sedang melakukan Grid Search...',
                    text: 'Sabar ya, proses memakan waktu 1-3 menit',
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
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const form = document.getElementById("slidingForm");

            form.addEventListener("submit", function(event) {
                event.preventDefault(); // Cegah submit default

                Swal.fire({
                    title: 'Proses Sliding Window sedang berjalan...',
                    text: 'Mohon tunggu beberapa saat.',
                    allowOutsideClick: false,
                    showConfirmButton: false,
                    didOpen: () => {
                        Swal.showLoading();
                        form.submit(); // submit form setelah alert muncul
                    }
                });
            });
        });
    </script>

</body>

</html>
