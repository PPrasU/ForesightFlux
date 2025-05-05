<div class="left side-menu">
    <div class="slimscroll-menu" id="remove-scroll">
      <div id="sidebar-menu">
        <ul class="metismenu" id="side-menu">
          <li class="menu-title">Main</li>
          <li>
            <a href="{{ route('admin.dasbor') }}" class="waves-effect">
              <i class="mdi mdi-home"></i>
              <span> Dasbor Admin</span>
            </a>
          </li>
          
          <li>
            <a href="javascript:void(0);" class="waves-effect">
              <i class="mdi mdi-book-multiple"></i>
              <span>
                Petunjuk Penggunaan
                <span class="float-right menu-arrow">
                  <i class="mdi mdi-plus"></i>
                </span> 
              </span>
          </a>
            <ul class="submenu">
              <li><a href="{{ route('admin.petunjukImport') }}">Import</a></li>
              <li><a href="{{ route('admin.petunjukAPI') }}">API</a></li>
            </ul>
          </li>

          <li>
            <a href="{{ route('admin.userManagement') }}" class="waves-effect">
              <i class="mdi mdi-account-group"></i>
              <span> User Management </span>
            </a>
          </li>

          <li>
            <a href="{{ route('admin.settingParams') }}" class="waves-effect">
              <i class="mdi mdi-cogs"></i>
              <span> Set Params </span>
            </a>
          </li>

          <li class="menu-title">Extras</li>

          <li>
            <a href="/" class="waves-effect">
              <i class="mdi mdi-earth"></i>
              <span> Ke Beranda </span>
            </a>
          </li>

          <li>
            <a href="{{ route('dashboard') }}" class="waves-effect">
              <i class="mdi mdi-account-box"></i>
              <span> Ke Dasbor User </span>
            </a>
          </li>
        </ul>
      </div>
      <div class="clearfix"></div>
    </div>
  </div>