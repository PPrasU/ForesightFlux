<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <title>ForesightFluxCP | Dasbor</title>
        <meta content="Admin Dashboard" name="description" />
        <meta content="Themesbrand" name="author" />
        <link rel="shortcut icon" href="images/Logo_icon.png">

        <!--Morris Chart CSS -->
        <link rel="stylesheet" href="plugins/morris/morris.css">
        <!-- DataTables -->
        <link href="plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <!--Chartist Chart CSS -->
        <link rel="stylesheet" href="plugins/chartist/css/chartist.min.css">
        <!-- C3 charts css -->
        <link href="plugins/c3/c3.min.css" rel="stylesheet" type="text/css" />

        {{-- Form Advance --}}
        <link href="plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css" rel="stylesheet">
        <link href="plugins/bootstrap-md-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet">
        <link href="plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
        <link href="plugins/bootstrap-touchspin/css/jquery.bootstrap-touchspin.min.css" rel="stylesheet" />
        <!-- Dropzone css -->
        <link href="plugins/dropzone/dist/dropzone.css" rel="stylesheet" type="text/css">

        {{-- ======= --}}
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="css/icons.css" rel="stylesheet" type="text/css">
        <link href="css/style.css" rel="stylesheet" type="text/css">
    </head>

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
                            
                            <h4 class="page-title">Beranda</h4>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item active">Selamat datang di sistem peramalan kripto</li>
                                {{-- <li class="breadcrumb-item active">Selamat datang di ForesightFluxCP</li> --}}
                            </ol>
                            <a id="datetime" class="breadcrumb-item active" style="color: #9e9e9e"></a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="page-content-wrapper">
                <div class="container-fluid">
                    {{-- 4 kotak biru --}}
                    <div class="row">
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-primary mini-stat position-relative">
                                <div class="card-body">
                                    <div class="mini-stat-desc">
                                        <h6 class="text-uppercase verti-label text-white-50">Close Price</h6>
                                        <div class="text-white">
                                            <h6 class="text-uppercase mt-0 text-white-50">Harga Penutupan</h6>
                                            <h3 class="mb-3 mt-0">Rp1.000.000</h3>
                                            <div class="">
                                                <span class="badge badge-light text-info"> +11% </span> <span class="ml-2">Dari Hari Sebelumnya</span>
                                            </div>
                                        </div>
                                        <div class="mini-stat-icon">
                                            <i class="mdi mdi-cube-outline display-2"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-primary mini-stat position-relative">
                                <div class="card-body">
                                    <div class="mini-stat-desc">
                                        <h6 class="text-uppercase verti-label text-white-50">Open Price</h6>
                                        <div class="text-white">
                                            <h6 class="text-uppercase mt-0 text-white-50">Harga Pembuka</h6>
                                            <h3 class="mb-3 mt-0">Rp1.000.000</h3>
                                            <div class="">
                                                <span class="badge badge-light text-danger"> -29% </span> <span class="ml-2">Dari Hari Sebelumnya</span>
                                            </div>
                                        </div>
                                        <div class="mini-stat-icon">
                                            <i class="mdi mdi-buffer display-2"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-primary mini-stat position-relative">
                                <div class="card-body">
                                    <div class="mini-stat-desc">
                                        <h6 class="text-uppercase verti-label text-white-50">Max Price</h6>
                                        <div class="text-white">
                                            <h6 class="text-uppercase mt-0 text-white-50">Harga Tertinggi</h6>
                                            <h3 class="mb-3 mt-0">Rp1.000.000</h3>
                                            <div class="">
                                                <span class="badge badge-light text-primary"> 0% </span> <span class="ml-2">Dari Hari Sebelumnya</span>
                                            </div>
                                        </div>
                                        <div class="mini-stat-icon">
                                            <i class="mdi mdi-tag-text-outline display-2"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-primary mini-stat position-relative">
                                <div class="card-body">
                                    <div class="mini-stat-desc">
                                        <h6 class="text-uppercase verti-label text-white-50">Min Price</h6>
                                        <div class="text-white">
                                            <h6 class="text-uppercase mt-0 text-white-50">Harga Terendah</h6>
                                            <h3 class="mb-3 mt-0">Rp1.000.000</h3>
                                            <div class="">
                                                <span class="badge badge-light text-info"> +89% </span> <span class="ml-2">Dari Hari Sebelumnya</span>
                                            </div>
                                        </div>
                                        <div class="mini-stat-icon">
                                            <i class="mdi mdi-briefcase-check display-2"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xl-9">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="mt-0 header-title mb-4">Tabel Data Historis Kripto</h4>
                                    <div class="table-responsive">
                                        <table class="table table-hover mb-0">
                                            <thead>
                                              <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Tanggal</th>
                                                <th scope="col">Open</th>
                                                <th scope="col">High</th>
                                                <th scope="col">Low</th>
                                                <th scope="col">Close</th>
                                                <th scope="col">Volume</th>
                                              </tr>
                                            </thead>
                                            <tbody>
                                              <tr>
                                                <th scope="row">1</th>
                                                <td>17-02-2025</td>
                                                <td>Rp100.000</td>
                                                <td>Rp100.000</td>
                                                <td>Rp100.000</td>
                                                <td>Rp100.000</td>
                                                <td>Rp100.000</td>
                                              </tr>
                                              <tr>
                                                <th scope="row">2</th>
                                                <td>16-02-2025</td>
                                                <td>Rp100.000</td>
                                                <td>Rp100.000</td>
                                                <td>Rp100.000</td>
                                                <td>Rp100.000</td>
                                                <td>Rp100.000</td>
                                              </tr>
                                              <tr>
                                                <th scope="row">3</th>
                                                <td>15-02-2025</td>
                                                <td>Rp100.000</td>
                                                <td>Rp100.000</td>
                                                <td>Rp100.000</td>
                                                <td>Rp100.000</td>
                                                <td>Rp100.000</td>
                                              </tr>
                                              <tr>
                                                <th scope="row">4</th>
                                                <td>14-02-2025</td>
                                                <td>Rp100.000</td>
                                                <td>Rp100.000</td>
                                                <td>Rp100.000</td>
                                                <td>Rp100.000</td>
                                                <td>Rp100.000</td>
                                              </tr>
                                              <tr>
                                                <th scope="row">5</th>
                                                <td>13-02-2025</td>
                                                <td>Rp100.000</td>
                                                <td>Rp100.000</td>
                                                <td>Rp100.000</td>
                                                <td>Rp100.000</td>
                                                <td>Rp100.000</td>
                                              </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="mt-0 header-title mb-4">Tabel Hasil Peramalan</h4>
                                    <div class="table-responsive order-table">
                                        <table class="table table-hover mb-0">
                                            <thead>
                                                <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Tanggal</th>
                                                <th scope="col">Hasil Prediksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <th scope="row">1</th>
                                                    <td>22-02-2025</td>
                                                    <td>Rp100.000</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">2</th>
                                                    <td>21-02-2025</td>
                                                    <td>Rp100.000</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">3</th>
                                                    <td>20-02-2025</td>
                                                    <td>Rp100.000</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">4</th>
                                                    <td>19-02-2025</td>
                                                    <td>Rp100.000</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">5</th>
                                                    <td>18-02-2025</td>
                                                    <td>Rp100.000</td>
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
        </div>

        @include('partials.footer')

        <!-- jQuery  -->
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.bundle.min.js"></script>
        <script src="js/jquery.slimscroll.js"></script>
        <script src="js/waves.min.js"></script>

        <script src="plugins/jquery-sparkline/jquery.sparkline.min.js"></script>

        {{-- DATATABLE JS --}}
        <!-- Required datatable js -->
        <script src="plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="plugins/datatables/dataTables.bootstrap4.min.js"></script>
        <!-- Buttons examples -->
        <script src="plugins/datatables/dataTables.buttons.min.js"></script>
        <script src="plugins/datatables/buttons.bootstrap4.min.js"></script>
        <script src="plugins/datatables/jszip.min.js"></script>
        <script src="plugins/datatables/pdfmake.min.js"></script>
        <script src="plugins/datatables/vfs_fonts.js"></script>
        <script src="plugins/datatables/buttons.html5.min.js"></script>
        <script src="plugins/datatables/buttons.print.min.js"></script>
        <script src="plugins/datatables/buttons.colVis.min.js"></script>
        <!-- Responsive examples -->
        <script src="plugins/datatables/dataTables.responsive.min.js"></script>
        <script src="plugins/datatables/responsive.bootstrap4.min.js"></script>
        

        {{-- CHART JS --}}
        <!-- Peity JS -->
        <script src="plugins/peity/jquery.peity.min.js"></script>
        <!--Morris Chart-->
        <script src="plugins/morris/morris.min.js"></script>
        <script src="plugins/raphael/raphael-min.js"></script>
        <!-- KNOB JS -->
        <script src="plugins/jquery-knob/excanvas.js"></script>
        <script src="plugins/jquery-knob/jquery.knob.js"></script>     
        <!--C3 Chart-->
        <script src="plugins/d3/d3.min.js"></script>
        <script src="plugins/c3/c3.min.js"></script>
        <!--Chartist Chart-->
        <script src="plugins/chartist/js/chartist.min.js"></script>
        <script src="plugins/chartist/js/chartist-plugin-tooltip.min.js"></script>
        <!-- Chart JS -->
        <script src="plugins/chart.js/chart.min.js"></script>
        <!-- Chart Flot JS -->
        <script src="plugins/flot-chart/jquery.flot.min.js"></script>
        <script src="plugins/flot-chart/jquery.flot.time.js"></script>
        <script src="plugins/flot-chart/jquery.flot.tooltip.min.js"></script>
        <script src="plugins/flot-chart/jquery.flot.resize.js"></script>
        <script src="plugins/flot-chart/jquery.flot.pie.js"></script>
        <script src="plugins/flot-chart/jquery.flot.selection.js"></script>
        <script src="plugins/flot-chart/jquery.flot.stack.js"></script>
        <script src="plugins/flot-chart/curvedLines.js"></script>
        <script src="plugins/flot-chart/jquery.flot.crosshair.js"></script>


        {{-- FORM JS --}}
        <!-- Parsley js -->
        <script src="plugins/parsleyjs/parsley.min.js"></script>
        <script>
            $(document).ready(function() {
                $('form').parsley();
            });
        </script>
        {{-- Datetimepicker --}}
        <script src="plugins/jquery-sparkline/jquery.sparkline.min.js"></script>
        <script src="plugins/bootstrap-md-datetimepicker/js/moment-with-locales.min.js"></script>
        <script src="plugins/bootstrap-md-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>
        {{-- Colorpicker --}}
        <script src="plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
        {{-- Select2 --}}
        <script src="plugins/select2/js/select2.min.js"></script>
        <script src="plugins/bootstrap-maxlength/bootstrap-maxlength.min.js"></script>
        <script src="plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js"></script>
        <script src="plugins/bootstrap-touchspin/js/jquery.bootstrap-touchspin.min.js"></script>
        <!--Wysiwig js-->
        <script src="plugins/tinymce/tinymce.min.js"></script>
        <script>
            $(document).ready(function () {
                if($("#elm1").length > 0){
                    tinymce.init({
                        selector: "textarea#elm1",
                        theme: "modern",
                        height:300,
                        plugins: [
                            "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                            "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                            "save table contextmenu directionality emoticons template paste textcolor"
                        ],
                        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",
                        style_formats: [
                            {title: 'Bold text', inline: 'b'},
                            {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
                            {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
                            {title: 'Example 1', inline: 'span', classes: 'example1'},
                            {title: 'Example 2', inline: 'span', classes: 'example2'},
                            {title: 'Table styles'},
                            {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
                        ]
                    });
                }
            });
        </script>
        <!-- Dropzone js -->
        <script src="plugins/dropzone/dist/dropzone.js"></script>


        <!-- App js -->
        <script src="js/app.js"></script>

        <script>
            function updateDateTime() {
                const now = new Date();
            
                // Ambil hari dalam bahasa Indonesia
                const days = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"];
                const dayName = days[now.getDay()];
            
                // Format tanggal
                const day = now.getDate();
                const monthNames = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
                const month = monthNames[now.getMonth()];
                const year = now.getFullYear();
            
                // Format waktu
                const hours = String(now.getHours()).padStart(2, "0");
                const minutes = String(now.getMinutes()).padStart(2, "0");
                const seconds = String(now.getSeconds()).padStart(2, "0");
            
                // Gabungkan hasil format di atas
                const formattedDateTime = `${dayName}, ${day}-${month}-${year}  |  ${hours}:${minutes}:${seconds}`;
            
                // Masukkan hasil ke elemen HTML dengan id "datetime"
                document.getElementById("datetime").innerHTML = formattedDateTime;
            }
            
            // Jalankan fungsi pertama kali
            updateDateTime();
            
            // Perbarui waktu setiap detik
            setInterval(updateDateTime, 1000);
        </script>

        {{-- Dashboard --}}
        <script src="pages/dashboard.js"></script>
        {{-- Datatable Pages --}}
        <script src="pages/datatables.init.js"></script>
        {{-- C3 Chart Pages --}}
        <script src="pages/c3-chart-init.js"></script>
        {{-- Chartis Chart Pages --}}
        <script src="pages/chartist.init.js"></script>
        {{-- Chart JS Pages --}}
        <script src="pages/chartjs.init.js"></script>
        {{-- Chart Flot Pages --}}
        <script src="pages/flot.init.js"></script>
        {{-- Chart Morris Pages --}}
        <script src="pages/morris.init.js"></script>

        {{-- Form Advanced Pages --}}
        <script src="pages/form-advanced.js"></script>
    </body>

</html>