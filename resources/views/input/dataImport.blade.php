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
                                            <h4 class="mt-0 header-title">Impor Data Historis Kripto Untuk Dilakukan Peramalan Nantinya</h4>
                                        </div>
                                    </div>
                    
                                    <form action="{{ route('data.postImportData') }}" method="POST" enctype="multipart/form-data" id="importData">
                                        @csrf
                                        {{-- Jenis Kripto --}}
                                        <div class="form-group">
                                            <label>Jenis Kripto</label>
                                            <input type="text" class="form-control" required placeholder="Masukkan jenis kriptonya" name="name"/>
                                        </div>
                    
                                        {{-- Jangka Waktu --}}
                                        <div>
                                            <div class="form-group mb-4">
                                                <label class="font-weight-bold">Jangka Waktu</label>
                                                <div class="d-flex align-items-center">
                                                    <input type="text" class="form-control form-control-lg mr-2" required placeholder="Periode Awal" id="date-start" name="date-start">
                                                    <span class="mx-2">-</span>
                                                    <input type="text" class="form-control form-control-lg ml-2" required placeholder="Periode Akhir" id="date-end" name="date-end">
                                                </div>
                                            </div>
                                        </div>

                                        {{-- Import File CSV --}}
                                        <div class="form-group">
                                            <label>Import File CSV</label>
                                            <input
                                              type="file"
                                              class="filestyle"
                                              data-buttonname="btn-secondary"
                                              accept=".csv"
                                              required 
                                              name="file"
                                            />
                                        </div>
                                        <input type="hidden" name="sumber" value="Import" />
                                        {{-- Tombol --}}
                                        <div style="margin-top: 40px">
                                            <button type="submit" class="btn btn-primary btn-lg btn-block mt-3 py-2" >
                                                Kuy Import Filenya
                                            </button>
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
    </body>

</html>