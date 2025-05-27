<header id="topnav">
    <div class="topbar-main">
        <div class="container-fluid">
            <div class="logo">                
                <a href="{{ route('dashboard') }}" class="logo">
                    <img src="" alt="Tempat Logo" class="logo-small" style="height: 50px; width: 150px;">
                    <img src="" alt="" class="logo-large" style="height: 50px; width: 150px;">
                </a>
            </div>
            <div class="menu-extras topbar-custom">
                <ul class="navbar-right d-flex list-inline float-right mb-0">
                    <li class="dropdown notification-list d-none d-sm-block">
                        <form role="search" class="app-search">
                            <div class="form-group mb-0"> 
                                <input type="text" class="form-control" placeholder="Search..">
                                <button type="submit"><i class="fa fa-search"></i></button>
                            </div>
                        </form> 
                    </li>
                    <li class="dropdown notification-list">
                        <a class="nav-link dropdown-toggle arrow-none waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                            <i id="notif-icon" class="mdi mdi-bell-outline noti-icon"></i>
                            @if(session('notifications') && count(session('notifications')) > 0)
                                <span class="badge badge-pill badge-info noti-icon-badge" id="notification-count">
                                    {{ count(session('notifications')) }}
                                </span>
                            @endif
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg">
                            <h6 class="dropdown-item-text">
                                Notifikasi
                            </h6>
                            <div class="slimscroll notification-item-list" id="notification-list">
                                @if(session('notifications'))
                                    @foreach(session('notifications') as $notification)
                                    <a href="javascript:void(0);" class="dropdown-item notify-item active notification-fade-in">
                                        <div class="notify-icon bg-{{ $notification['bgColor'] }}">
                                            <i class="mdi {{ $notification['icon'] }}"></i>
                                        </div>
                                        <p class="notify-details">
                                            {{ $notification['title'] }}
                                            <span class="text-muted">{{ $notification['text'] }}</span>
                                            <span class="text-muted">
                                                {{ \Carbon\Carbon::parse($notification['time'])->diffForHumans() }}
                                            </span>
                                        </p>
                                    </a>                                    
                                    @endforeach
                                @else
                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                        <div class="notify-icon bg-secondary">
                                            <i class="mdi mdi-bell-off"></i>
                                        </div>
                                        <p class="notify-details">
                                            Tidak ada notifikasi
                                            <span class="text-muted">Belum ada aktivitas terbaru.</span>
                                        </p>
                                    </a>
                                @endif
                            </div>                                                      
                            <a href="{{ route('notifikasi.clear') }}" class="dropdown-item text-center text-primary">
                                Hapus Semua Notifikasi <i class="fi-arrow-right"></i>
                            </a>                            
                        </div>
                    </li>
                    <li class="dropdown notification-list">
                        <div class="dropdown notification-list">
                            <a class="dropdown-toggle nav-link arrow-none waves-effect nav-user waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                <img src="{{ asset('images/users/user-4.jpg') }}" alt="user" class="rounded-circle">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                                <a class="dropdown-item" href="#"><i class="mdi mdi-account-circle m-r-5"></i> Profil</a>
                                <a class="dropdown-item d-block" href="#"><span class="badge badge-success float-right"></span><i class="mdi mdi-settings m-r-5"></i> Settings</a>
                                <a class="dropdown-item" href="/"><i class="mdi mdi-lock-open-outline m-r-5"></i> Home screen</a>
                                <div class="dropdown-divider"></div>
                                {{-- <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                    <i class="mdi mdi-power text-danger"></i>
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form> --}}
                            </div>                                                                    
                        </div>
                    </li>

                    <li class="menu-item list-inline-item">
                        <a class="navbar-toggle nav-link">
                          <div class="lines">
                            <span></span>
                            <span></span>
                            <span></span>
                          </div>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <div class="navbar-custom">
        <div class="container-fluid">
            <div id="navigation">
                <ul class="navigation-menu">
                    <li class="has-submenu {{ Request::is('dasbor') ? 'active' : '' }}">
                        <a href="{{ route('dashboard') }}"><i class="mdi mdi-home"></i>Dasbor</a>
                    </li>
                    <li class="has-submenu {{ Request::is('pergerakan-kripto') ? 'active' : '' }}">
                        <a href="{{ route('pergerakan-kripto') }}"><i class="mdi mdi-finance"></i>Pergerakan Kripto Real-Time</a>
                    </li>
                    <li class="has-submenu {{ Request::is('data/*') ? 'active' : '' }}">
                        <a href="#"><i class="mdi mdi-buffer"></i>Pengambilan Data</a>
                        <ul class="submenu">
                            <li class="{{ Request::is('data/API*') ? 'active' : '' }}">
                                <a href="{{ route('data.dataAPI') }}">Data dari API</a>
                            </li>
                            <li class="{{ Request::is('data/import*') ? 'active' : '' }}">
                                <a href="{{ route('data.importData') }}">Import Data</a>
                            </li>
                        </ul>
                    </li>
                    <li class="has-submenu {{ Request::is('peramalan/*') ? 'active' : '' }}">
                        <a href="#"><i class="mdi mdi-black-mesa"></i>Peramalan</a>
                        <ul class="submenu">
                            <li class="{{ Request::is('peramalan/proses*') ? 'active' : '' }}">
                                <a href="{{ route('peramalan.index') }}">Proses Peramalan</a>
                            </li>
                            <li class="{{ Request::is('peramalan/hasil*') ? 'active' : '' }}">
                                <a href="{{ route('peramalan.hasil') }}">Hasil Peramalan</a>
                            </li>
                        </ul>
                    </li>
                    <li class="has-submenu {{ Request::is('petunjuk-penggunaan') ? 'active' : '' }}">
                        <a href="{{ route('petunjukPenggunaan') }}"><i class="mdi mdi-finance"></i>Petunjuk Penggunaan</a>
                    </li>
                    <style>
                        #datetime {
                            margin-left: auto; /* Membuat elemen berada di kanan */
                            color: #9e9e9e;
                            font-size: 14px; /* Sesuaikan ukuran font jika perlu */
                            display: flex; /* Gunakan flexbox untuk kontrol lebih baik */
                            align-items: center; /* Vertikal tengah jika diperlukan */
                        }
                        .navigation-menu {
                            display: flex;
                            align-items: center; /* Untuk vertikal tengah */
                            width: 100%; /* Pastikan menu memiliki lebar penuh */
                        }

                    </style>
                    
                    <li class="has-submenu" style="margin-left:auto;">
                        <a id="datetime" class="breadcrumb-item active" style="color: #9e9e9e;"></a>
                    </li>                    
                </ul>
            </div>
        </div>
    </div>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const dropdownToggle = document.querySelector('.notification-list .nav-link');
        const notifIcon = document.getElementById('notif-icon');
        const dropdownMenu = document.querySelector('.notification-list .dropdown-menu');

        let dropdownOpen = false;

        function closeDropdown() {
            if (dropdownOpen) {
                notifIcon.classList.remove('mdi-bell');
                notifIcon.classList.add('mdi-bell-outline');
                dropdownMenu.classList.remove('show'); // Sembunyikan menu
                dropdownOpen = false;
            }
        }

        dropdownToggle.addEventListener('click', function (e) {
            e.preventDefault();
            e.stopPropagation(); // cegah bubbling

            dropdownOpen = !dropdownOpen;

            if (dropdownOpen) {
                notifIcon.classList.remove('mdi-bell-outline');
                notifIcon.classList.add('mdi-bell');
                dropdownMenu.classList.add('show'); // Tampilkan menu
            } else {
                notifIcon.classList.remove('mdi-bell');
                notifIcon.classList.add('mdi-bell-outline');
                dropdownMenu.classList.remove('show'); // Sembunyikan menu
            }
        });

        document.addEventListener('click', function (e) {
            if (!dropdownMenu.contains(e.target) && !dropdownToggle.contains(e.target)) {
                closeDropdown();
            }
        });
    });
</script>


</header>