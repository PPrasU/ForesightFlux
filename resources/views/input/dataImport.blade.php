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
                                                    <input type="text" id="date-startt" name="date-start" class="form-control" placeholder="Tanggal awal" >
                                                    <span class="mx-2">–</span>
                                                    <input type="text" id="date-endd" name="date-end" class="form-control" placeholder="Tanggal akhir" >
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
                                                Import Filenya
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
        <!-- Flatpickr JS -->
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

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
        
        {{-- validasi 720 pake flatpicker --}}
        <script>
            const maxDays = 99999;
            let startPicker, endPicker;

            function addDays(date, days) {
                const copy = new Date(date);
                copy.setDate(copy.getDate() + days);
                return copy;
            }

            function subtractDays(date, days) {
                const copy = new Date(date);
                copy.setDate(copy.getDate() - days);
                return copy;
            }

            const today = new Date(); // ambil tanggal hari ini

            startPicker = flatpickr("#date-startt", {
                dateFormat: "Y-m-d",
                maxDate: today, // ❗️batasi maksimal hanya sampai hari ini
                onChange: function(selectedDates) {
                    if (selectedDates.length === 0) return;

                    const startDate = selectedDates[0];
                    const maxEndDate = addDays(startDate, maxDays);

                    const effectiveMaxEndDate = maxEndDate > today ? today : maxEndDate;

                    endPicker.set('minDate', startDate);
                    endPicker.set('maxDate', effectiveMaxEndDate);

                    const currentEnd = endPicker.selectedDates[0];
                    if (currentEnd && (currentEnd < startDate || currentEnd > effectiveMaxEndDate)) {
                        endPicker.clear();
                    }
                }
            });

            endPicker = flatpickr("#date-endd", {
                dateFormat: "Y-m-d",
                maxDate: today, // ❗️batasi maksimal hanya sampai hari ini
                onChange: function(selectedDates) {
                    if (selectedDates.length === 0) return;

                    const endDate = selectedDates[0];
                    const minStartDate = subtractDays(endDate, maxDays);

                    startPicker.set('maxDate', endDate > today ? today : endDate);
                    startPicker.set('minDate', minStartDate);

                    const currentStart = startPicker.selectedDates[0];
                    if (currentStart && (currentStart > endDate || currentStart < minStartDate)) {
                        startPicker.clear();
                    }
                }
            });

        </script>
    </body>

</html>