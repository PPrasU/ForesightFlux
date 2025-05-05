<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui"/>
<meta content="Admin Dashboard" name="description" />
<meta content="Themesbrand" name="author" />
{{-- <link rel="shortcut icon" href="{{ asset('images/Logo_icon.png') }}"> --}}
<link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}" />

<link rel="stylesheet" href="{{ asset('plugins/morris/morris.css') }}" />

<link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/css/metismenu.min.css') }}" rel="stylesheet" type="text/css"/>

<link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" type="text/css" />
{{-- toastr --}}
@include('sweetalert::alert')
{{-- Toaster CDN CSS --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"
    integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />