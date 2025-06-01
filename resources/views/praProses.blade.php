<!DOCTYPE html>
<html lang="en">
    @include('partials.header') 
    <title>ForesightFluxCP | Data Pra-Proses</title>

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
                            
                            <h4 class="page-title">Hasil Pra-Proses  >  Proses Peramalan</h4>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item active">Data Hasil Pra-Proses Dapat Dilihat Di Tabel Bawah Ini, Data Ini Nantinya Akan Dilakukan Proses Peramalan. Nah Tinggal Pencet Aja Tuh Tombolnya Buat Proses Peramalannya</li>
                            </ol>
                            <a id="datetime" class="breadcrumb-item active" style="color: #9e9e9e"></a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="page-content-wrapper">
                <div class="container-fluid">
                    {{-- baris pertama, tabel --}}
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
                                        <h4 class="mt-0 header-title">Tabel Data Hasil Pra-Proses Nih</h4>                                                                             
                                        <div>
                                            @if (!$sudahHasil)
                                                @if (!$data->isEmpty())
                                                    <button id="prosesBtn" type="button" class="btn btn-outline-primary waves-effect waves-light">
                                                        Proses Peramalan Kripto
                                                    </button>
                                                    <form id="prosesForm" action="{{ route('peramalan.post') }}" method="POST" style="display: none;">
                                                        @csrf
                                                    </form> 
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                   
                                    @php
                                        use Carbon\Carbon;
                                        $source = $data->first()->source ?? null;
                                        $name = $source->display_name ?? $source->name ?? '-';
                                        $start = $source ? Carbon::parse($source->periode_awal)->translatedFormat('d F Y') : '-';
                                        $end = $source ? Carbon::parse($source->periode_akhir)->translatedFormat('d F Y') : '-';
                                        $jenis_data = $source->jenis_data ?? '-';
                                        $total = $data->count();
                                    @endphp

                                    @if ($source)
                                        <div class="mb-4">
                                            <p class="mb-1"><strong>Nama Kripto:</strong> {{ $name }}<strong style="margin-left: 15px">Total Data:</strong> {{ $total }}
                                                <strong style="margin-left: 15px">Sumber:</strong>
                                                @if($source->sumber === 'API')
                                                    API 🖥️
                                                @elseif($source->sumber === 'Import')
                                                    Import 🗂️
                                                @endif
                                                <strong style="margin-left: 15px">Jenis Data:</strong> {{ $jenis_data }} 🗓️
                                            </p>
                                            <p class="mb-1"><strong>Jangka Waktu:</strong> {{ $start }} s/d {{ $end }}</p>
                                            <p class="mb-1">
                                            </p>
                                            <p class="mb-1"><strong>Persentase training dan testing:</strong> {{ +$param->training_percentage }}:{{ +$param->testing_percentage }}</p>
                                            <p class="mb-1"><strong>Total Data training {{ $totalTraining }} </strong> testing {{ $totalTesting }} </p>
                                        </div>
                                    @endif
                                    
                                    

                                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>Tanggal</th>
                                                <th>Harga Terakhir (Data Aktual)</th>
                                                <th>Kategori</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data as $row)
                                                <tr>
                                                    <td>{{ $row->date }}</td>
                                                    <td>{{ $row->price }}</td>
                                                    <td>{{ $row->category }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    @if ($source)
                                        <div class="mb-4">
                                            <br>
                                            <h5 class="mb-1"><strong>⚠️ Keterangan : </strong> 📝</h5>
                                            <br>
                                            <p class="mb-1"><strong>📊 Penjelasan Kolom:</strong></p>
                                            <p class="mb-1"><strong>Date: </strong>Tanggal data harga {{ $name }} yang sudah dilakukan pra proses menjadi format YYYY-MM-DD.</p>
                                            <p class="mb-1"><strong>Harga Terakhir: </strong>Harga dari {{ $name }} yang diambil dari sumber {{ $source->sumber }} data. Nanti kolom ini akan menjadi harga asli yang akan dibandingkan dengan harga peramalan nantinya.</p>
                                            <p class="mb-1"><strong>Kategori: </strong>Membedakan mana data untuk training dan data untuk testing. (Untuk kemudahan sistem dalam bekerja nantinya)</p>
                                        </div>
                                    @endif
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

        {{-- warnain data kolom close --}}
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                const table = document.getElementById("datatable");
                const rows = table.querySelectorAll("tbody tr");
        
                let prevClose = null;
        
                rows.forEach((row, index) => {
                    const closeCell = row.cells[1]; // Kolom ke-6 (index ke-5) adalah 'Close'
                    const closeValue = parseInt(closeCell.textContent.replace(/\./g, ''));
        
                    if (prevClose !== null) {
                        if (closeValue > prevClose) {
                            closeCell.style.color = "green";
                        } else if (closeValue < prevClose) {
                            closeCell.style.color = "red";
                        } else {
                            closeCell.style.color = "black";
                        }
                    }
        
                    prevClose = closeValue;
                });
            });
        </script>
        
        {{-- pop up buat proses --}}
        <script>
            document.getElementById("prosesBtn").addEventListener("click", function () {
              Swal.fire({
                title: 'Akhirnya Sampai Disini, Beneran Nih Datanya Mau Di Ramalin?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Iya Dong!',
                cancelButtonText: 'Ndak Deh Pikir-Pikir Dulu',
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#6c757d',
              }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Siap Boskuh!',
                        text: 'Data bakal diproses. Sabar yaa!',
                        allowOutsideClick: false,
                        showConfirmButton: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });
                    document.getElementById("prosesForm").submit();
                }
              });
            });
        </script>

        {{-- pop up untuk hapus data --}}
        <script>
            document.getElementById("hapusPraProses").addEventListener("click", function () {
                Swal.fire({
                    title: 'Yakin Mau Hapus Semua Data?',
                    text: 'Aksi ini akan menghapus semua data pra proses yang ada! Yakin nih?',
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

                        const form = document.getElementById("hapusPraProsesForm");
                        form.action = "{{ route('peramalan.hapusPraProsesPeramalan') }}";
                        form.submit();
                    }
                });
            });
        </script>

        <script>
            toastr.options = {
            "positionClass": "toast-top-right",
            "timeOut": "3000", // 3 detik
            };
        </script>

    </body>

</html>