<!-- jQuery  -->
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/js/metisMenu.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.slimscroll.js') }}"></script>
<script src="{{ asset('assets/js/waves.min.js') }}"></script>

<script src="{{ asset('plugins/jquery-sparkline/jquery.sparkline.min.js') }}"></script>

{{-- Select2 --}}
<script src="{{ asset('plugins/select2/js/select2.min.js') }}"></script>
<script src="{{ asset('plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>
<script src="{{ asset('plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js') }}"></script>
<script src="{{ asset('plugins/bootstrap-touchspin/js/jquery.bootstrap-touchspin.min.js') }}"></script>


<!-- Peity JS -->
<script src="{{ asset('plugins/peity/jquery.peity.min.js') }}"></script>

<script src="{{ asset('plugins/morris/morris.min.js') }}"></script>
<script src="{{ asset('plugins/raphael/raphael-min.js') }}"></script>

<script src="{{ asset('assets/pages/dashboard.js') }}"></script>

<!-- App js -->
<script src="{{ asset('assets/js/app.js') }}"></script>
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
