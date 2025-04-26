<!DOCTYPE html>
<html lang="en">
    @include('partials.header') 
    <title>ForesightFluxCP | Data Import</title>

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
                            
                            <h4 class="page-title">Data Impor</h4>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item active">Melakukan Import Data Historis Kripto Dalam Bentuk CSV, Belum Tau Caranya?, Bisa Ke <a style="color: #00aeff; text-decoration: underline;" href="{{ route('petunjukPenggunaan') }}">Sini</a>. Nah, Kalo Udah Tau Nanti Balik Lagi, Impor Datanya. Data Impornya Akan Dilakukan Pra-Proses</li>
                                {{-- <li class="breadcrumb-item active">Selamat datang di ForesightFluxCP</li> --}}
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
                                    <div class="d-flex justify-content-between align-items-center mb-4">
                                        <h4 class="mt-0 header-title">Tabel Data Hasil Impor</h4>
                                        <div>
                                            @if ($data->isEmpty())
                                                <a href="{{ route('data.inputImportData') }}" class="btn btn-primary waves-effect waves-light"> 
                                                    Monggo Datanya Di Impor
                                                </a>
                                            @else
                                                <button id="hapusDataImport" type="button" class="btn btn-danger waves-effect waves-light me-2">
                                                    Hapus Semua Data 
                                                </button>     
                                                <button id="praProsesBtn" type="button" class="btn btn-outline-primary waves-effect waves-light">
                                                    Pra-Proses Data Kripto
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
                                            <p class="mb-1"><strong>Jangka Waktu:</strong> {{ $source->periode_awal }} - {{ $source->periode_akhir }}</p>
                                            <p class="mb-1"><strong>Total Data:</strong> {{ $data->count() }}</p>
                                        </div>
                                    @endif
                                    
                                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                            <tr>
                                                <th style="width: 10px">No</th>
                                                <th>Tanggal</th>
                                                <th>Price</th>
                                                <th>Open</th>
                                                <th>High</th>
                                                <th>Low</th>
                                                <th>Vol.</th>
                                                <th>Change %</th>
                                            </tr>
                                        </thead>                                     
                                        <tbody>
                                            @foreach ($data as $row)
                                                <tr>
                                                    <td style="text-align: center">{{ $row->id }}</td>
                                                    <td>{{ $row->date }}</td>
                                                    <td>{{ $row->price }}</td>
                                                    <td>{{ $row->open }}</td>
                                                    <td>{{ $row->high }}</td>
                                                    <td>{{ $row->low }}</td>
                                                    <td>{{ $row->vol }}</td>
                                                    <td>{{ $row->change }}</td>
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
                                            <h5 class="mb-1"><strong>⚠️ Note: </strong>Hanya fokus saja pada kolom <strong>Date dan Price</strong>, karena proses peramalan hanya menggunakan 2 kolom itu 📝</h5>
                                            <br><br>
                                            <p class="mb-1"><strong>📊 Penjelasan Kolom:</strong></p>
                                            <p class="mb-1"><strong>Date: </strong>Tanggal data harga {{ $source->name }} dicatat, dalam format Tahun-Bulan-Tanggal (YYYY-MM-DD)</p>
                                            <p class="mb-1"><strong>Price: </strong>Harga penutupan (closing price) {{ $source->name }} pada akhir hari tersebut yang merupakan harga acuan yang biasanya dipakai untuk analisis harian.</p>
                                            <p class="mb-1"><strong>Open: </strong>Harga pembukaan {{ $source->name }} saat awal perdagangan hari itu.</p>
                                            <p class="mb-1"><strong>High: </strong>Harga tertinggi yang dicapai {{ $source->name }} selama satu hari perdagangan.</p>
                                            <p class="mb-1"><strong>Low: </strong>Harga terendah yang dicapai {{ $source->name }} selama satu hari perdagangan.</p>
                                            <p class="mb-1"><strong>Vol.: </strong>Volume perdagangan, yaitu jumlah {{ $source->name }} yang diperdagangkan selama hari itu. Satuan seperti K berarti ribuan (misalnya, {{ $vol }} = {{ number_format($vol_number) }} {{ $source->name }} pada hari itu).</p>
                                            <p class="mb-1"><strong>Change %: </strong>Persentase perubahan harga dari hari sebelumnya ke hari setelahnya. Menggambarkan apakah harga naik atau turun dibanding hari sebelumnya.</p>
                                            <br>
                                            <p class="mb-1"><strong>🎨 Warna Hijau & Merah</strong></p>
                                            <p class="mb-1"><strong style="color: green">Hijau </strong>menandakan bahwa harga {{ $source->name }} naik dibandingkan dengan hari sebelumnya.</p>
                                            <p class="mb-1"><strong style="color: red">Merah </strong>menandakan harga turun dibanding hari sebelumnya.</p>
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

        {{-- ngasih warna ke baris tabelnya --}}
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                const table = document.querySelector("#datatable tbody");
                const rows = table.querySelectorAll("tr");
            
                let previousPrice = null;
            
                rows.forEach(row => {
                    const priceCell = row.cells[2]; // Kolom Price
                    const changeCell = row.cells[7]; // Kolom Change
            
                    // Bersihkan koma ribuan, biar jadi format angka valid
                    let priceText = priceCell.textContent.trim().replace(/,/g, '');
                    const currentPrice = parseFloat(priceText);
            
                    // Warnai kolom PRICE jika angkanya valid
                    if (!isNaN(currentPrice)) {
                        if (previousPrice !== null) {
                            if (currentPrice > previousPrice) {
                                priceCell.style.color = "green";
                            } else if (currentPrice < previousPrice) {
                                priceCell.style.color = "red";
                            }
                        }
                        previousPrice = currentPrice;
                    }
            
                    // Warnai kolom CHANGE
                    const changeText = changeCell.textContent.trim();
                    if (changeText.startsWith("+")) {
                        changeCell.style.color = "green";
                    } else if (changeText.startsWith("-")) {
                        changeCell.style.color = "red";
                    }
                });
            });
        </script>
            
        {{-- pop up buat pra-proses --}}
        <script>
            document.getElementById("praProsesBtn").addEventListener("click", function () {
              Swal.fire({
                title: 'Beneran Mau Di Pra-Proses Nih Datanya?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Iya',
                cancelButtonText: 'Tidak',
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#6c757d',
              }).then((result) => {
                if (result.isConfirmed) {
                  Swal.fire({
                    title: 'Oke!',
                    text: 'Data akan diproses.',
                    icon: 'success',
                    timer: 1000,
                    showConfirmButton: false,
                    timerProgressBar: true
                  });
          
                  setTimeout(() => {
                    toastr.success('Data Kripto Impor Berhasil Di Pra-Proses');
                  });
                }
              });
            });
        </script>

        {{-- pop up untuk hapus data --}}
        <script>
            document.getElementById("hapusDataImport").addEventListener("click", function () {
                Swal.fire({
                    title: 'Yakin Mau Hapus Semua Data?',
                    text: 'Aksi ini akan menghapus semua data impor yang ada! Yakin mau melanjutkan',
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
                            icon: 'success',
                            timer: 5000,
                            showConfirmButton: false,
                            timerProgressBar: true
                        });
        
                        setTimeout(() => {
                            window.location.href = "{{ route('data.hapusImportData') }}";
                        });
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