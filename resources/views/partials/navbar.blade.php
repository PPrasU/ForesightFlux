<header id="topnav">
    <div class="topbar-main">
        <div class="container-fluid">
            <div class="logo">                
                <a href="{{ route('dashboard') }}" class="logo">
                    {{-- <img src="images/Logo.png" alt="Logo" class="logo-small" style="height: 50px; width: 150px;"> --}}
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
                            <i class="mdi mdi-bell noti-icon"></i>
                            <span class="badge badge-pill badge-info noti-icon-badge" id="notification-count">
                                {{ session('notifications') ? count(session('notifications')) : 0 }}
                            </span>                                                     
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
                                Tandai Sudah Dibaca <i class="fi-arrow-right"></i>
                            </a>                            
                        </div>        
                    </li>
                    {{-- <li class="dropdown notification-list">
                        <a class="nav-link dropdown-toggle arrow-none waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                            <i class="mdi mdi-bell noti-icon"></i>
                            <span class="badge badge-pill badge-info noti-icon-badge" id="notification-count">0</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg">
                            <h6 class="dropdown-item-text">Notifikasi</h6>
                            <div class="slimscroll notification-item-list" id="notification-list">
                                <!-- Notifikasi akan ditambahkan di sini -->
                            </div>
                            <a href="javascript:void(0);" class="dropdown-item text-center text-primary">
                                Tandai Sudah Dibaca <i class="fi-arrow-right"></i>
                            </a>
                        </div>
                    </li> --}}
                    {{-- @if(session('notification'))
                        <script>
                            let notif = @json(session('notification'));
                            addNotification(notif.icon, notif.bgColor, notif.title, notif.text);
                        </script>
                    @endif --}}
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
                                <a href="{{ route('peramalan.prosesPeramalan') }}">Proses Peramalan</a>
                            </li>
                            <li class="{{ Request::is('peramalan/hasil*') ? 'active' : '' }}">
                                <a href="{{ route('peramalan.hasil') }}">Hasil Peramalan</a>
                            </li>
                        </ul>
                    </li>
                    <li class="has-submenu {{ Request::is('petunjuk-penggunaan') ? 'active' : '' }}">
                        <a href="{{ route('petunjukPenggunaan') }}"><i class="mdi mdi-finance"></i>Petunjuk Penggunaan</a>
                    </li>
                    <li class="has-submenu col-sm-5" style="text-align: right">
                        <a id="datetime" class="breadcrumb-item active" style="color: #9e9e9e"></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</header>