<!DOCTYPE html>
<html lang="en">
    @include('partials.header')
    <title>ForesightFluxCP | Input Data API</title>
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
                            
                            <h4 class="page-title">Input Data API</h4>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                  <a href="{{ route('data.dataAPI') }}" style="text-decoration: underline">Data API</a>
                                </li>
                                <li class="breadcrumb-item">
                                  <a href="{{ route('data.inputDataAPI') }}" style="text-decoration: underline">Input Data</a>
                                </li>
                            </ol>

                            <ol class="breadcrumb">
                                <li class="breadcrumb-item active">Mengambil Data Historis Kripto Melalui API, Data Yang Sudah Dipilih Akan Disimpan Untuk Nantinya Dilakukan Pra-Proses</li>
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
                                            <h4 class="mt-0 header-title">Pilih Data Historis Kripto Untuk Dilakukan Peramalan Nantinya</h4>
                                        </div>
                                    </div>
                    
                                    <form action="{{ route('data.postDataAPI') }}" method="POST" enctype="multipart/form-data" id="apiData">
                                        @csrf
                                        {{-- Pilih Kripto --}}
                                        <div style="margin-top: 50px">
                                            <div class="form-group mb-4">
                                                <label class="control-label font-weight-bold">Pilih Kripto</label>
                                                <select name="crypto_pair" id="crypto_pair" class="form-control form-control-lg select2" required>
                                                    <option selected disabled>--- Pilih Kripto ---</option>
                                                    <option value="bitcoin">Bitcoin (BTC/USD)</option>
                                                    <option value="ethereum">Ethereum (ETH/USD)</option>
                                                    <option value="dogecoin">Dogecoin (DOGE/USD)</option>
                                                    <option value="ripple">Ripple (XRP/USD)</option>
                                                    <option value="litecoin">Litecoin (LTC/USD)</option>
                                                </select>
                                            </div>
                                        </div>
                                        {{-- Jangka Waktu --}}
                                        <div style="margin-top: 20px">
                                            <div class="form-group mb-4">
                                                <label class="font-weight-bold">Jangka Waktu</label>
                                                <div class="d-flex align-items-center">
                                                    <select name="days" id="days" class="form-control form-control-lg" required>
                                                        <option value="" disabled selected>--- Pilih Jangka Waktu ---</option>
                                                        <option value="1">1 Hari</option>
                                                        <option value="7">7 Hari</option>
                                                        <option value="14">14 Hari</option>
                                                        <option value="30">30 Hari</option>
                                                        <option value="90">90 Hari</option>
                                                        <option value="180">180 Hari</option>
                                                        <option value="365">365 Hari</option>
                                                        <option value="max">Sejak Awal</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>


                                        <input type="hidden" name="sumber" value="API" />
                                        {{-- Tombol --}}
                                        <div style="margin-top: 50px">
                                            <button type="submit" class="btn btn-primary btn-lg btn-block mt-3 py-2" >
                                                Pilih Kripto
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