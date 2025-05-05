<!DOCTYPE html>
<html lang="en">
  <head>
    @include('admin.partials.header')
    <title>Admin | Petunjuk Penggunaan Import</title>
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
        .text-wrap {
          white-space: normal;
          overflow-wrap: break-word;
          word-break: break-word;
        }
        table {
          table-layout: fixed;
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
                  <h4 class="page-title">Petunjuk Penggunaan Import</h4>
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item active">
                      Isine Buat Halaman Petunjuk Penggunaan Import 
                      <strong>
                        (Import Loh Ya Ini, Bukan API)
                      </strong>
                      Kalo Mau Ngatur-Ngatur Halaman Petunjuk Penggunaan Bisa Lewat Sini Ya Kawan!
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
                  {{-- Isine tabel --}}
                  <div class="row">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <h3 class="mt-0 header-title">Tabel Petunjuk Penggunaan Import</h3>
                                    <div>
                                      <a href="{{ route('admin.inputpetunjukImport') }}" class="btn btn-outline-primary waves-effect waves-light"> 
                                        Input Data
                                      </a>
                                    </div>
                                </div>
                            
                                <table id="datatable" class="table table-bordered dt-responsive" style="border-collapse: collapse; border-spacing: 0; width: 100%; table-layout: fixed;">
                                  <thead>
                                      <tr>
                                          <th scope="col" style="width: 5%;">No</th>
                                          <th scope="col" style="width: 12%;">Judul</th>
                                          <th scope="col" style="width: 12%;">Deskripsi 1</th>
                                          <th scope="col" style="width: 12%;">Deskripsi 2</th>
                                          <th scope="col" style="width: 12%;">Deskripsi 3</th>
                                          <th scope="col" style="width: 25%; text-align: center;">Gambar</th>
                                          <th scope="col" style="width: 10%;">Aksi</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      @foreach ($data as $row)
                                      <tr>
                                          <td style="text-align: center">{{ $row->id }}</td>
                                          <td class="text-wrap" style="max-width: 200px;">{{ $row->judul }}</td>
                                          <td class="text-wrap" style="max-width: 250px;">{{ $row->desk_1 }}</td>
                                          <td class="text-wrap" style="max-width: 250px;">{{ $row->desk_2 }}</td>
                                          <td class="text-wrap" style="max-width: 250px;">{{ $row->desk_3 }}</td>
                                          <td class="d-flex justify-content-center align-items-center p-2">
                                              <img src="{{ asset('foto-petunjuk-penggunaan/' . $row->gambar) }}" style="max-width: 250px; height: auto; object-fit: cover;">
                                          </td>
                                          <td style="text-align: center">
                                              <a href="/admin/petunjuk-import/edit/{{ $row->id }}" class="btn btn-warning" data-bs-toggle="tooltip" title="Edit Data">
                                                  <i class="fas fa-edit"></i>
                                              </a>
                                              <a href="#" class="btn btn-danger delete" data-id="{{ $row->id }}" data-bs-toggle="tooltip" title="Hapus Data">
                                                  <i class="fas fa-trash"></i>
                                              </a>
                                          </td>
                                      </tr>
                                      @endforeach
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

        @include('admin.partials.footer')
      </div>

    </div>
    @include('admin.partials.scripts')
    {{-- DATATABLE JS --}}
    <!-- Required datatable js -->
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
    {{-- Datatable Pages --}}
    <script src="{{ asset('pages/datatables.init.js') }}"></script>
    <script>
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl, {
                delay: { show: 0, hide: 0 } // <- ini bikin tanpa delay
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- hapus data --}}
    <script>
      document.querySelectorAll('.delete').forEach(function(button) {
          button.addEventListener('click', function(e) {
              e.preventDefault();
              var id = this.getAttribute('data-id');

              Swal.fire({
                  title: 'Yakin Mau Hapus Data Ini?',
                  text: 'Aksi ini tidak bisa dibatalkan!',
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonText: 'Hapus!',
                  cancelButtonText: 'Batal',
                  confirmButtonColor: '#d33',
                  cancelButtonColor: '#6c757d',
              }).then((result) => {
                if (result.isConfirmed) {
                        Swal.fire({
                            title: 'Menghapus...',
                            text: 'Data sedang dihapus.',
                            allowOutsideClick: false,
                            showConfirmButton: false,
                            didOpen: () => {
                                Swal.showLoading();
                            }
                        });
                        window.location.href = "{{ route('admin.hapuspetunjukImport', ['id' => '__ID__']) }}".replace('__ID__', id);
                    }
              });
          });
        });
      </script>
  </body>
</html>
