  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="" class="brand-link">
          <img src="{{ asset('img') }}/Logo_BPN-KemenATR.png" alt="AdminLTE Logo"
              class="brand-image img-circle elevation-3" style="opacity: .8">
          <span class="brand-text font-weight-light">ATR-BPN</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
          <!-- Sidebar user panel (optional) -->
          {{-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('adminlte') }}/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Alexander Pierce</a>
        </div>
      </div> --}}

          <!-- SidebarSearch Form -->
          {{-- <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div> --}}

          <!-- Sidebar Menu -->
          <nav class="mt-2">
              <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                  data-accordion="false">
                  <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                  {{-- <li class="nav-item {{ Request::is('Dashboaard') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ Request::is('/') ? 'active' : '' }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">

              <li class="nav-item">
                <a href="{{ route('dashboard') }}" class="nav-link {{ Request::is('Dashboaard') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dashboard v1</p>
                </a>
              </li>

            </ul>
          </li> --}}

                  <li class="nav-item {{ Request::is(['home', 'peminjaman', 'pengembalian']) ? 'menu-open' : '' }}">
                      <a href="#"
                          class="nav-link {{ Request::is(['home', 'peminjaman', 'pengembalian']) ? 'active' : '' }}">
                          <i class="nav-icon fas fa-list-ul"></i>
                          <p>
                              Peminjaman
                              <i class="right fas fa-angle-left"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">

                          @if (Auth::user()->seksi_id == 4 || Auth::user()->seksi_id == 1)
                              <li class="nav-item">
                                  <a href="{{ route('home') }}"
                                      class="nav-link {{ Request::is('home') ? 'active' : '' }}">
                                      <i class="fas fa-minus nav-icon"></i>
                                      <p>List Peminjaman</p>
                                  </a>
                              </li>
                          @endif

                          @if (Auth::user()->seksi_id != 4)
                              <li class="nav-item">
                                  <a href="{{ route('peminjaman') }}"
                                      class="nav-link {{ Request::is('peminjaman') ? 'active' : '' }}">
                                      <i class="fas fa-minus nav-icon"></i>
                                      <p>Peminjaman</p>
                                  </a>
                              </li>

                              <li class="nav-item">
                                  <a href="{{ route('pengembalian') }}"
                                      class="nav-link {{ Request::is('pengembalian') ? 'active' : '' }}">
                                      <i class="fas fa-minus nav-icon"></i>
                                      <p>Pengembalian</p>
                                  </a>
                              </li>
                          @endif



                      </ul>
                  </li>

                  @if (Auth::user()->seksi_id != 4)
                      <li class="nav-item {{ Request::is(['st', 'ba', 'ba-pps']) ? 'menu-open' : '' }}">
                          <a href="#" class="nav-link {{ Request::is(['st', 'ba', 'ba-pps']) ? 'active' : '' }}">
                              <i class="nav-icon fas fa-envelope-open-text"></i>
                              <p>
                                  <span style="font-size: 14px">Surat Tugas & Berita acara</span>
                              </p>
                              <p><i class="right fas fa-angle-left"></i></p>
                          </a>
                          <ul class="nav nav-treeview">

                              <li class="nav-item">
                                  <a href="{{ route('St') }}"
                                      class="nav-link {{ Request::is('st') ? 'active' : '' }}">
                                      <i class="fas fa-minus nav-icon"></i>
                                      <p>Surat Tugas</p>
                                  </a>
                              </li>

                              <li class="nav-item">
                                  <a href="{{ route('Ba') }}"
                                      class="nav-link {{ Request::is('ba') ? 'active' : '' }}">
                                      <i class="fas fa-minus nav-icon"></i>
                                      <p>Berita Acara</p>
                                  </a>
                              </li>

                              {{-- <li class="nav-item">
                <a href="{{ route('baPps') }}" class="nav-link {{ Request::is('ba-pps') ? 'active' : '' }}">
                  <i class="fas fa-minus nav-icon"></i>
                  <p>Berita Acara PPS</p>
                </a>
              </li> --}}

                          </ul>
                      </li>
                  @endif

                  @if (Auth::user()->seksi_id == 1)
                      <li
                          class="nav-item {{ Request::is(['kecamatan-kelurahan', 'seksi-pelayanan', 'hak', 'user', 'penandatangan']) ? 'menu-open' : '' }}">
                          <a href="#"
                              class="nav-link {{ Request::is(['kecamatan-kelurahan', 'seksi-pelayanan', 'hak', 'user', 'penandatangan']) ? 'active' : '' }}">
                              <i class="nav-icon fas fa-database"></i>
                              <p>
                                  Data
                                  <i class="right fas fa-angle-left"></i>
                              </p>
                          </a>
                          <ul class="nav nav-treeview">

                              <li class="nav-item">
                                  <a href="{{ route('kecamatanKelurahan') }}"
                                      class="nav-link {{ Request::is('kecamatan-kelurahan') ? 'active' : '' }}">
                                      <i class="fas fa-minus nav-icon"></i>
                                      <p>Kecamatan & Kelurahan</p>
                                  </a>
                              </li>

                              <li class="nav-item">
                                  <a href="{{ route('seksiPelayanan') }}"
                                      class="nav-link {{ Request::is('seksi-pelayanan') ? 'active' : '' }}">
                                      <i class="fas fa-minus nav-icon"></i>
                                      <p>Seksi & Pelayanan</p>
                                  </a>
                              </li>

                              {{-- <li class="nav-item">
                <a href="{{ route('hak') }}" class="nav-link {{ Request::is('hak') ? 'active' : '' }}">
                  <i class="fas fa-minus nav-icon"></i>
                  <p>Hak</p>
                </a>
              </li> --}}

                              <li class="nav-item">
                                  <a href="{{ route('penandatangan') }}"
                                      class="nav-link {{ Request::is('penandatangan') ? 'active' : '' }}">
                                      <i class="fas fa-minus nav-icon"></i>
                                      <p>Penandatangan</p>
                                  </a>
                              </li>

                              <li class="nav-item">
                                  <a href="{{ route('user') }}"
                                      class="nav-link {{ Request::is('user') ? 'active' : '' }}">
                                      <i class="fas fa-minus nav-icon"></i>
                                      <p>User</p>
                                  </a>
                              </li>


                          </ul>
                      </li>
                  @endif





                  {{-- <li class="nav-item">
            <a href="pages/widgets.html" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Widgets
                <span class="right badge badge-danger">New</span>
              </p>
            </a>
          </li> --}}
                  {{-- <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Layout Options
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right">6</span>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pages/layout/top-nav.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Top Navigation</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/layout/top-nav-sidebar.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Top Navigation + Sidebar</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/layout/boxed.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Boxed</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/layout/fixed-sidebar.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Fixed Sidebar</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/layout/fixed-sidebar-custom.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Fixed Sidebar <small>+ Custom Area</small></p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/layout/fixed-topnav.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Fixed Navbar</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/layout/fixed-footer.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Fixed Footer</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/layout/collapsed-sidebar.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Collapsed Sidebar</p>
                </a>
              </li>
            </ul>
          </li> --}}

              </ul>
          </nav>
          <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
  </aside>
