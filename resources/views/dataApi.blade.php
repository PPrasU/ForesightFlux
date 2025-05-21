<!DOCTYPE html>
<html lang="en">
    @include('partials.header')
    <title>ForesightFluxCP | Data API</title>
    <style>
        .text-green {
            color: green;
            font-weight: bold;
        }
        .text-red {
            color: red;
            font-weight: bold;
        }
    </style>      

    <body>
        @include('partials.navbar')
        @if(session('success'))
            toastr.success("{{ session('success') }}", "Sukses");
        @endif
        
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
                            
                            <h4 class="page-title">Data API</h4>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item active">Mengambil Data Historis Kripto Melalui API. Tinggal Pilih Aja Kripto Yang Mau Dilakukan Peramalan. Habis Itu Data Yang Sudah Dipilih Akan Disimpan Untuk Nantinya Dilakukan Pra-Proses</li>
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
                                        <h3 class="mt-0 header-title">Tabel Data Dari API</h3>
                                        <div>
                                            @if ($data->isEmpty())
                                                <a href="{{ route('data.inputDataAPI') }}" class="btn btn-primary waves-effect waves-light"> 
                                                    Datanya Kosong Nih, Yuk Pilih Data Kriptonya
                                                </a>
                                            @else
                                                <button id="hapusDataAPI" type="button" class="btn btn-outline-danger waves-effect waves-light me-2">
                                                    Hapus Semua Data API
                                                </button>
                                                <form id="hapusDataAPIForm" method="POST" style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                                 
                                                @if (!$sudahPraProses)
                                                    <button id="praProsesBtn" type="button" class="btn btn-outline-primary waves-effect waves-light">
                                                        Pra-Proses Data Kripto
                                                    </button>
                                                    <form id="praProsesForm" action="{{ route('data.praProsesAPI') }}" method="POST" style="display: none;">
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
                                        $start = $source ? Carbon::parse($source->periode_awal)->format('m-d-Y') : '-';
                                        $end = $source ? Carbon::parse($source->periode_akhir)->format('m-d-Y') : '-';
                                        $total = $data->count();
                                    @endphp

                                    @if ($source)
                                        <div class="mb-4">
                                            <p class="mb-1"><strong>Nama Kripto:</strong> {{ $name }}</p>
                                            <p class="mb-1"><strong>Jangka Waktu:</strong> {{ $start }} s/d {{ $end }}</p>
                                            <p class="mb-1"><strong>Total Data:</strong> {{ $total }}</p>
                                        </div>
                                    @endif

                                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                            <tr>
                                                <th style="width: 10px" hidden>No</th>
                                                <th style="width: 100px">Tanggal</th>
                                                <th>Open</th>
                                                <th>High</th>
                                                <th>Low</th>
                                                <th>Close</th>
                                                <th style="width: 100px">VWAP</th>
                                                <th style="width: 150px">Volume</th>
                                                <th style="width: 100px">Count</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data as $row)
                                                <tr>
                                                    <td style="text-align: center" hidden>{{ $row->id }}</td>
                                                    <td style="text-align: center">{{ $row->date }}</td>
                                                    <td>{{ $row->open }}</td>
                                                    <td>{{ $row->high }}</td>
                                                    <td>{{ $row->low }}</td>
                                                    <td>{{ $row->close }}</td>
                                                    <td>{{ $row->vwap }}</td>
                                                    <td>{{ $row->vol }}</td>
                                                    <td>{{ $row->count }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                    @if ($source)
                                        @php
                                            // Ambil volume dari data pertama
                                            $vol = $data->first()->vol ?? null;

                                            // Konversi volume jika mengandung "K"
                                            if ($vol && str_contains($vol, 'K')) {
                                                $vol_number = floatval(str_replace('K', '', $vol)) * 1000;
                                            } else {
                                                $vol_number = $vol;
                                            }
                                        @endphp
                                        <div class="mb-4">
                                            <br>
                                            <h5 class="mb-1"><strong>⚠️ Note: </strong>Hanya fokus saja pada kolom <strong>Date dan Close</strong>, karena proses peramalan hanya menggunakan 2 kolom itu 📝</h5>
                                            <br><br>
                                            <p class="mb-1"><strong>📊 Penjelasan Kolom:</strong></p>
                                            <p class="mb-1"><strong>Date: </strong>Tanggal data harga {{ $name }} dicatat dengan format MM-DD-YYYY.👈🏼✅</p>
                                            <p class="mb-1"><strong>Open: </strong>Harga pembukaan {{ $name }} saat awal perdagangan hari itu.</p>
                                            <p class="mb-1"><strong>High: </strong>Harga tertinggi yang dicapai {{ $name }} selama satu hari perdagangan.</p>
                                            <p class="mb-1"><strong>Low: </strong>Harga terendah yang dicapai {{ $name }} selama satu hari perdagangan.</p>
                                            <p class="mb-1"><strong>Close: </strong>Harga penutupan (closing price) {{ $name }} pada akhir hari tersebut yang merupakan harga acuan yang biasanya dipakai untuk analisis harian.👈🏼✅</p>
                                            <p class="mb-1"><strong>VWAP (Volume Weighted Average Price): </strong>Harga rata-rata perdagangan {{ $name }} dalam periode waktu itu, diberi bobot berdasarkan volume.</p>
                                            <p class="mb-1"><strong>Volume: </strong>Total volume aset dasar {{ $name }} yang diperdagangkan dalam periode tersebut.</p>
                                            <p class="mb-1"><strong>Count: </strong>Jumlah total transaksi/trade {{ $name }} yang terjadi selama periode tersebut.</p>
                                            <br>
                                            <p class="mb-1"><strong>🎨 Warna Hijau & Merah</strong></p>
                                            <p class="mb-1"><strong style="color: green">Hijau </strong>menandakan bahwa harga {{ $name }} naik dibandingkan dengan hari sebelumnya.</p>
                                            <p class="mb-1"><strong style="color: red">Merah </strong>menandakan harga {{ $name }} turun dibanding hari sebelumnya.</p>
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
                    const closeCell = row.cells[5]; // Kolom ke-6 (index ke-5) adalah 'Close'
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

        {{-- pop up buat pra-proses --}}
        <script>
            document.getElementById("praProsesBtn").addEventListener("click", function () {
                Swal.fire({
                    title: 'Beneran Mau Di Pra-Proses Nih Datanya?',
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonText: 'Iya Dong!',
                    cancelButtonText: 'Ndak Dulu Deh',
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#6c757d',
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Menampilkan loading setelah konfirmasi
                        Swal.fire({
                            title: 'Proses Data...',
                            text: 'Data sedang diproses.',
                            allowOutsideClick: false,
                            showConfirmButton: false,
                            didOpen: () => {
                                Swal.showLoading(); // Menampilkan loading
                            }
                        });
                        document.getElementById("praProsesForm").submit();
                    }
                });
            });
        </script>        

        {{-- pop up untuk hapus data --}}
        <script>
            document.getElementById("hapusDataAPI").addEventListener("click", function () {
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
                        const form = document.getElementById("hapusDataAPIForm");
                        form.action = "{{ route('data.hapusDataAPI') }}";
                        form.submit();
                    }
                });
            });
        </script>
        

        <script>
            toastr.options = {
            "positionClass": "toast-top-right",
            "timeOut": "5000", // 3 detik
            };
        </script>
            
          
    </body>

</html>