<!-- jQuery  -->
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('js/jquery.slimscroll.js') }}"></script>
<script src="{{ asset('js/waves.min.js') }}"></script>

<script src="{{ asset('plugins/jquery-sparkline/jquery.sparkline.min.js') }}"></script>

{{-- CHART JS --}}
<!-- Peity JS -->
<script src="{{ asset('plugins/peity/jquery.peity.min.js') }}"></script>
<!--Morris Chart-->
<script src="{{ asset('plugins/morris/morris.min.js') }}"></script>
<script src="{{ asset('plugins/raphael/raphael-min.js') }}"></script>
<!-- KNOB JS -->
<script src="{{ asset('plugins/jquery-knob/excanvas.js') }}"></script>
<script src="{{ asset('plugins/jquery-knob/jquery.knob.js') }}"></script>     
<!--C3 Chart-->
<script src="{{ asset('plugins/d3/d3.min.js') }}"></script>
<script src="{{ asset('plugins/c3/c3.min.js') }}"></script>
<!--Chartist Chart-->
<script src="{{ asset('plugins/chartist/js/chartist.min.js') }}"></script>
<script src="{{ asset('plugins/chartist/js/chartist-plugin-tooltip.min.js') }}"></script>
<!-- Chart JS -->
<script src="{{ asset('plugins/chart.js/chart.min.js') }}"></script>
<!-- Chart Flot JS -->
<script src="{{ asset('plugins/flot-chart/jquery.flot.min.js') }}"></script>
<script src="{{ asset('plugins/flot-chart/jquery.flot.time.js') }}"></script>
<script src="{{ asset('plugins/flot-chart/jquery.flot.tooltip.min.js') }}"></script>
<script src="{{ asset('plugins/flot-chart/jquery.flot.resize.js') }}"></script>
<script src="{{ asset('plugins/flot-chart/jquery.flot.pie.js') }}"></script>
<script src="{{ asset('plugins/flot-chart/jquery.flot.selection.js') }}"></script>
<script src="{{ asset('plugins/flot-chart/jquery.flot.stack.js') }}"></script>
<script src="{{ asset('plugins/flot-chart/curvedLines.js') }}"></script>
<script src="{{ asset('plugins/flot-chart/jquery.flot.crosshair.js') }}"></script>


{{-- FORM JS --}}
<!-- Parsley js -->
<script src="{{ asset('plugins/parsleyjs/parsley.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $('form').parsley();
    });
</script>
{{-- Datetimepicker --}}
<script src="{{ asset('plugins/jquery-sparkline/jquery.sparkline.min.js') }}"></script>
<script src="{{ asset('plugins/bootstrap-md-datetimepicker/js/moment-with-locales.min.js') }}"></script>
<script src="{{ asset('plugins/bootstrap-md-datetimepicker/js/bootstrap-material-datetimepicker.js') }}"></script>
{{-- Colorpicker --}}
<script src="{{ asset('plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}"></script>
{{-- Select2 --}}
<script src="{{ asset('plugins/select2/js/select2.min.js') }}"></script>
<script src="{{ asset('plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>
<script src="{{ asset('plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js') }}"></script>
<script src="{{ asset('plugins/bootstrap-touchspin/js/jquery.bootstrap-touchspin.min.js') }}"></script>
<!--Wysiwig js-->
<script src="{{ asset('plugins/tinymce/tinymce.min.js') }}"></script>
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
<script src="{{ asset('plugins/dropzone/dist/dropzone.js') }}"></script>


<!-- App js -->
<script src="{{ asset('js/app.js') }}"></script>

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
{{-- <script src="{{ asset('pages/dashboard.js') }}"></script> --}}
{{-- Datatable Pages --}}
{{-- <script src="{{ asset('pages/datatables.init.js') }}"></script> --}}
{{-- C3 Chart Pages --}}
{{-- <script src="{{ asset('pages/c3-chart-init.js') }}"></script> --}}
{{-- Chartis Chart Pages --}}
{{-- <script src="{{ asset('pages/chartist.init.js') }}"></script> --}}
{{-- Chart JS Pages --}}
{{-- <script src="{{ asset('pages/chartjs.init.js') }}"></script> --}}
{{-- Chart Flot Pages --}}
{{-- <script src="{{ asset('pages/flot.init.js') }}"></script> --}}
{{-- Chart Morris Pages --}}
{{-- <script src="{{ asset('pages/morris.init.js') }}"></script> --}}

{{-- Form Advanced Pages --}}
{{-- <script src="{{ asset('pages/form-advanced.js') }}"></script> --}}

{{-- toastr --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
    @if (session('message'))
        toastr.success('{{ session('message') }}');
    @endif
</script>
<script>
    @if (Session::Has('Success'))
        toastr.success("{{ Session::get('Success') }}")
    @endif
</script>
<script src="{{ asset('js/notification.js') }}"></script>
