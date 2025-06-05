<div class="topbar">
    <!-- LOGO -->
    <div class="topbar-left">
      {{-- <a href="{{ route('admin.dasbor') }}" class="logo"> --}}
      <a href="{{ route('settingParams') }}" class="logo">
        <span>
          <img src="{{ asset('images/Logo.png') }}" alt="" height="60" />
        </span>
        <i>
          <img src="{{ asset('images/Logo_icon.png') }}" alt="" height="54" />
        </i>
      </a>
    </div>

    <nav class="navbar-custom">
      <ul class="list-inline menu-left mb-0">
        <li class="float-left">
          <button class="button-menu-mobile open-left waves-effect waves-light">
            <i class="mdi mdi-menu"></i>
          </button>
        </li>
      </ul>
      <ul class="navbar-right d-flex list-inline float-right mb-0">
        <li class="dropdown notification-list d-none d-sm-block">
          <form role="search" class="app-search">
            <div class="form-group mb-0">
              <input
                type="text"
                class="form-control"
                placeholder="Search.."
              />
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
                        @foreach(array_reverse(session('notifications')) as $notification)
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
        <!--<li class="dropdown notification-list">
            <div class="dropdown notification-list">
                <a class="dropdown-toggle nav-link arrow-none waves-effect nav-user waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                    <img src="{{ asset('images/users/user-4.jpg') }}" alt="user" class="rounded-circle">
                </a>
                <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                    <a class="dropdown-item d-block" href="#"><span class="badge badge-success float-right"></span><i class="mdi mdi-settings m-r-5"></i> Settings</a>
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
      </ul>-->

      
      
    </nav>
  </div>