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
                                    <div class="d-flex justify-content-between align-items-center mb-4">
                                        <h4 class="mt-0 header-title">Tabel Data Hasil Pra-Proses Nih</h4>                                                                             
                                        <button id="prosesBtn" type="button" class="btn btn-primary waves-effect waves-light">
                                            Proses Peramalan Kripto
                                        </button>                                          
                                    </div>
                                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>Tanggal</th>
                                                <th>Harga Terakhir</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th>01-01-2024</th>
                                                <th>100.000.000</th>
                                            </tr>
                                            <tr>
                                                <th>02-01-2024</th>
                                                <th>101.200.000</th>
                                            </tr>
                                            <tr>
                                                <th>03-01-2024</th>
                                                <th>99.800.000</th>
                                            </tr>
                                            <tr>
                                                <th>04-01-2024</th>
                                                <th>98.500.000</th>
                                            </tr>
                                            <tr>
                                                <th>05-01-2024</th>
                                                <th>100.300.000</th>
                                            </tr>
                                            <tr>
                                                <th>06-01-2024</th>
                                                <th>102.000.000</th>
                                            </tr>
                                            <tr>
                                                <th>07-01-2024</th>
                                                <th>101.500.000</th>
                                            </tr>
                                            <tr>
                                                <th>08-01-2024</th>
                                                <th>103.200.000</th>
                                            </tr>
                                            <tr>
                                                <th>09-01-2024</th>
                                                <th>102.800.000</th>
                                            </tr>
                                            <tr>
                                                <th>10-01-2024</th>
                                                <th>104.500.000</th>
                                            </tr>
                                            <tr>
                                                <th>11-01-2024</th>
                                                <th>107.500.000</th>
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
        
        {{-- pop up buat pra-proses --}}
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
                    title: 'Oke!',
                    text: 'Data akan diproses.',
                    icon: 'success',
                    timer: 1000,
                    showConfirmButton: false,
                    timerProgressBar: true
                  });
          
                  setTimeout(() => {
                    toastr.success('Data Kripto Impor Berhasil Di Pra-Proses');
                  }, 1000); // delay 1 detik setelah Swal close
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