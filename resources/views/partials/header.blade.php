<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta content="Admin Dashboard" name="description" />
    <meta content="Themesbrand" name="author" />
    {{-- <link rel="shortcut icon" href="{{ asset('images/Logo_icon.png') }}"> --}}
    <link rel="icon" href="{{ asset('images/favicon.ico') }}" />

    <!--Morris Chart CSS -->
    <link rel="stylesheet" href="{{ asset('plugins/morris/morris.css') }}">
    <!-- DataTables -->
    <link href="{{ asset('plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('plugins/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <!--Chartist Chart CSS -->
    <link rel="stylesheet" href="{{ asset('plugins/chartist/css/chartist.min.css') }}">
    <!-- C3 charts css -->
    <link href="{{ asset('plugins/c3/c3.min.css') }}" rel="stylesheet" type="text/css" />

    {{-- Form Advance --}}
    <link href="{{ asset('plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css') }}" rel="stylesheet">
    <link href="{{ asset('plugins/bootstrap-md-datetimepicker/css/bootstrap-material-datetimepicker.css') }}" rel="stylesheet">
    <link href="{{ asset('plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('plugins/bootstrap-touchspin/css/jquery.bootstrap-touchspin.min.css') }}" rel="stylesheet" />
    <!-- Dropzone css -->
    <link href="{{ asset('plugins/dropzone/dist/dropzone.css') }}" rel="stylesheet" type="text/css">

    {{-- ======= --}}
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/icons.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css">

    {{-- sweetaler sama toastr --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- toastr --}}
    @include('sweetalert::alert')
    {{-- Toaster CDN CSS --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"
        integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>