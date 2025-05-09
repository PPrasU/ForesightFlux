<!DOCTYPE html>
<html lang="en">
    @include('partials.header')
    <title>ForesightFluxCP | Input Data Import</title>
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
                            
                            <h4 class="page-title">Impor Data</h4>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                  <a href="{{ route('data.importData') }}" style="text-decoration: underline">Data Import</a>
                                </li>
                                <li class="breadcrumb-item">
                                  <a href="{{ route('data.inputImportData') }}" style="text-decoration: underline">Input Data</a>
                                </li>
                            </ol>

                            <ol class="breadcrumb">
                                <li class="breadcrumb-item active">Impor Data Historis Kripto Yang Ingin Dilakukan Peramalan Sesuai Petunjuk Penggunaan Di <a style="color: #00aeff; text-decoration: underline;" href="{{ route('petunjukPenggunaan') }}">Sini</a></li>
                            </ol>
                            <a id="datetime" class="breadcrumb-item active" style="color: #9e9e9e"></a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="page-content-wrapper">
                <div class="container-fluid">
                    {{-- baris pertama, tabel --}}
                    <div class="d-flex justify-content-center">

                        <div class="col-xl-6">
                            <div class="card" style="margin-top: 10px; min-height: 450px;">
                                <div class="card-body px-5 py-4">
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

                                    <div>
                                        <div class="text-center mb-4">
                                            <h4 class="mt-0 header-title">Impor Data Historis Kripto Untuk Dilakukan Peramalan Nantinya</h4>
                                        </div>
                                    </div>
                    
                                    <form action="{{ route('data.postImportData') }}" method="POST" enctype="multipart/form-data" id="importData">
                                        @csrf
                                        {{-- Jenis Kripto --}}
                                        <div class="form-group">
                                            <label>Jenis Kripto</label>
                                            <input type="text" class="form-control" placeholder="Masukkan jenis kriptonya" name="name"/>
                                        </div>
                    
                                        {{-- Jangka Waktu --}}
                                        <div>
                                            <div class="form-group mb-4">
                                                <label class="font-weight-bold">Jangka Waktu</label>
                                                <div class="d-flex align-items-center">
                                                    <input type="date" class="form-control form-control-lg mr-2" placeholder="Periode Awal" id="date-start" name="date-start">
                                                    <span class="mx-2">-</span>
                                                    <input type="date" class="form-control form-control-lg ml-2" placeholder="Periode Akhir" id="date-end" name="date-end">
                                                </div>
                                            </div>
                                        </div>

                                        {{-- Import File CSV --}}
                                        <div class="form-group" style="margin-top: -10px">
                                            <label>Import File CSV</label>
                                            <input
                                              type="file"
                                              class="filestyle"
                                              data-buttonname="btn-secondary"
                                              accept=".csv"
                                              name="file"
                                            />
                                        </div>
                                        <input type="hidden" name="sumber" value="Import" />
                                        {{-- Tombol --}}
                                        <div style="margin-top: 35px">
                                            <button type="submit" class="btn btn-primary btn-lg btn-block mt-3 py-2" >
                                                Kuy Import Filenya
                                            </button>
                                        </div>
                                        <div style="margin-top: 20px">
                                            <a href="{{ route('data.importData') }}" class="btn btn-outline-secondary btn-lg btn-block mt-3 py-2" >
                                                Balik, ndak jadi
                                            </a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('partials.footer')
        @include('partials.scripts')
        <script src="{{ asset('pages/form-advanced.js') }}"></script>

        <script>
            document.getElementById("importData").addEventListener("submit", function(event) {
                event.preventDefault();  // Mencegah reload halaman otomatis
                
                // Menampilkan SweetAlert2 loading
                Swal.fire({
                    title: 'Mengimpor Data...',
                    text: 'Sabar ya kalo lama prosesnya 😅',
                    allowOutsideClick: false,
                    showConfirmButton: false,
                    didOpen: () => {
                        Swal.showLoading();  // Menampilkan spinner
                    }
                });

                // Kirim form
                this.submit();  // Melakukan submit form secara normal
                addNotification('mdi-approval', 'success', 'Import Data Berhasil', 'Silahkan menuju halaman pra proses untuk dilakukan peramalan.');
            });
        </script>
        
        {{-- set tanggal nggak bisa besok dst --}}
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                // Dapatkan tanggal hari ini dalam format YYYY-MM-DD
                const today = new Date().toISOString().split("T")[0];

                // Set batas maksimal (max) agar tidak bisa pilih besok dan seterusnya
                document.getElementById("date-start").setAttribute("max", today);
                document.getElementById("date-end").setAttribute("max", today);
            });
        </script>
    </body>

</html>