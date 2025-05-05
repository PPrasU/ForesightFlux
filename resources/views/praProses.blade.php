<!DOCTYPE html>
<html lang="en">
    @include('partials.header') 

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
                                        <div class="alert alert-danger" role="alert">
                                            {{ session('error') }}
                                        </div>
                                    @endif
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul class="mb-0">
                                                @foreach ($errors->all() as $err)
                                                    <li>{{ $err }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    <div class="d-flex justify-content-between align-items-center mb-4">

                                        <h4 class="mt-0 header-title">Tabel Data Hasil Pra-Proses Nih</h4>                                                                             
                                        <div>
                                            @if ($data->count() > 0)
                                                <button id="hapusPraProses" type="button" class="btn btn-outline-danger waves-effect waves-light">
                                                    Hapus Semua Data Pra Proses
                                                </button>

                                                <form id="ProsesForm" action="#" method="POST" style="display: none;">
                                                    @csrf
                                                </form>
                                                <button id="prosesBtn" type="button" class="btn btn-outline-primary waves-effect waves-light">
                                                    Proses Peramalan Kripto
                                                </button>
                                            @endif
                                        </div>
                                    </div>
                                    @php
                                        $source = $data->first()->source ?? null;
                                    @endphp
                                    @if ($source)
                                        <div class="mb-4">
                                            <p class="mb-1"><strong>Nama Kripto:</strong> {{ $source->name }}</p>

                                            @if ($source->sumber === 'Import')
                                                <p class="mb-1"><strong>Jangka Waktu:</strong> {{ $source->periode_awal }} s/d {{ $source->periode_akhir }}</p>
                                            @elseif ($source->sumber === 'API')
                                                <p class="mb-1"><strong>Jangka Waktu:</strong> {{ $source->jangka_waktu }} Hari</p>
                                            @endif
                                            
                                            <p class="mb-1"><strong>Total Data:</strong> {{ $data->count() }}</p>
                                        </div>
                                    @endif
                                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>Tanggal</th>
                                                <th>Harga Terakhir</th>
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
                        timer: 3000,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });
                    setTimeout(() => {
                        toastr.error('Sabar bang belom sampe proses peramalan ini');
                    }, 3100); // delay 1 detik setelah Swal close
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
                        window.location.href = "{{ route('peramalan.hapusProsesPeramalan') }}";

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