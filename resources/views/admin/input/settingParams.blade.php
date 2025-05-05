<!DOCTYPE html>
<html lang="en">
  <head>
    @include('admin.partials.header')
    <title>Admin | Input Setting Params</title>
    <!-- DataTables -->
    <link href="{{ asset('plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('plugins/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Responsive datatable examples -->
    <link href="{{ asset('plugins/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <style>
        /* Style normal tombol */
        .btn-warning {
            background-color: #f0ad4e;
            border-color: #eea236;
            color: white;
        }

        /* Hover tombol Edit */
        .btn-warning:hover {
            background-color: #ec971f;
            border-color: #d58512;
            color: white;
        }

        /* Style normal tombol Delete */
        .btn-danger {
            background-color: #d9534f;
            border-color: #d43f3a;
            color: white;
        }

        /* Hover tombol Delete */
        .btn-danger:hover {
            background-color: #c9302c;
            border-color: #ac2925;
            color: white;
        }
        .btn-warning:hover,
        .btn-danger:hover {
            transform: scale(1.05);
            transition: all 0.3s ease;
        }

    </style>
  </head>

  <body>
    <div id="wrapper">
      @include('admin.partials.topbar')
      @include('admin.partials.sidebar')
      
      <div class="content-page">
        <div class="content">
          <div class="container-fluid">

            <div class="row">
              <div class="col-sm-12">
                <div class="page-title-box">
                  <h4 class="page-title">Input Setting Params</h4>
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item active">
                      Isine Buat Input Setting Params Kayak Percentage Buat Data Training Sama Testing, Parameter Metode Kayak Alpha, Beta, sama Gamma, Gituuuuu
                    </li>
                  </ol>

                  <div class="state-information d-none d-sm-block">
                    <div class="state-graph">
                      <div id="header-chart-1"></div>
                      <div class="info">User</div>
                    </div>
                    <div class="state-graph">
                      <div id="header-chart-2"></div>
                      <div class="info">Setting</div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="page-content-wrapper">
                <div class="container-fluid">
                    {{-- baris pertama, tabel --}}
                    <div class="d-flex justify-content-center">
                        <div class="col-xl-8">
                            <div class="card" style="margin-top: 20px; min-height: 420px;">
                                <div class="card-body px-5 py-4">
                                    @if(session('error'))
                                        <div class="alert alert-danger" role="alert">
                                            {{ session('error') }}
                                        </div>
                                    @endif
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul class="mb-0">
                                                @foreach ($errors->all() as $err)
                                                    <li>{{ $err }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                    <div style="margin-top: 10px">
                                        <div class="text-center mb-4">
                                            <h4 class="mt-0 header-title">Input Data Params Lainnya (Kalo Ada)</h4>
                                        </div>
                                    </div>
                    
                                    <form action="{{ route('admin.postSettingParams') }}" method="POST" id="apiData">
                                        @csrf
                                        {{-- Params --}}
                                        <div class="form-group" style="margin-top: 40px">
                                            <label>Params Baru</label>
                                            <input type="text" class="form-control" required placeholder="Masukkan params baru......." name="params" autofocus/>
                                        </div>
                                        
                                        {{-- Value --}}
                                        <div class="form-group" style="margin-top: 40px">
                                            <label>Value</label>
                                            <input type="text" class="form-control" required placeholder="Masukkan nilainya...." name="value"/>
                                        </div>
                                        
                                        {{-- Tombol --}}
                                        <div style="margin-top: 40px">
                                            <button type="submit" class="btn btn-primary btn-lg btn-block mt-3 py-2" >
                                                Submit pake ini ya
                                            </button>
                                        </div>
                                        <div style="margin-top: 20px">
                                            <a href="{{ route('admin.settingParams') }}" class="btn btn-outline-secondary btn-lg btn-block mt-3 py-2" >
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
        </div>

        @include('admin.partials.footer')
      </div>

    </div>
    @include('admin.partials.scripts')
    <!-- Parsley js -->
    <script src="{{ asset('plugins/parsleyjs/parsley.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('form').parsley();
        });
    </script>
    
  </body>
</html>
