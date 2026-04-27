  <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="index3.html" class="brand-link">
          <img src="dist/img/bgn.webp" alt="AdminLTE Logo" class="brand-image img-circle">
          <span class="brand-text font-weight-light">BGNDashboard</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
          <!-- Sidebar Menu -->
          <nav class="mt-2">
              <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                  data-accordion="false">
                  <li class="nav-item">
                      <a href="{{ route('dashboard') }}"
                          class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}">
                          <i class="nav-icon fas fa-tachometer-alt"></i>
                          <p>
                              Dashboard
                          </p>
                      </a>
                  </li>
                  @role('admin')
                      <li class="nav-header">USER MANAGEMENT</li>
                      <li class="nav-item ">
                          <a href="{{ route('users') }}"
                              class="nav-link {{ request()->is(['users', 'users/create', 'users/edit/*']) ? 'active' : '' }}">
                              <i class="nav-icon fas fa-users-cog"></i>
                              <p>
                                  Data Users
                              </p>
                          </a>
                      </li>
                      <li class="nav-header">MASTER DATA</li>
                      <li class="nav-item ">
                          <a href="{{ route('kitchen') }}"
                              class="nav-link {{ request()->is(['kitchen', 'kitchen/create', 'kitchen/edit/*']) ? 'active' : '' }}">
                              <i class="nav-icon fas fa-house-user"></i>
                              <p>
                                  Dapur
                              </p>
                          </a>
                      </li>
                  @endrole
                  @role('kitchen')
                      <li class="nav-header">MASTER DATA</li>
                      <li class="nav-item ">
                          <a href="{{ route('recipient') }}"
                              class="nav-link {{ request()->is(['recipient', 'recipient/create', 'recipient/edit/*']) ? 'active' : '' }}">
                              <i class="nav-icon fas fa-building"></i>
                              <p>
                                  Instansi Penerima
                              </p>
                          </a>
                      </li>
                      <li class="nav-item ">
                          <a href="{{ route('beneficiary') }}"
                              class="nav-link {{ request()->is(['beneficiary', 'beneficiary/create', 'beneficiary/edit/*']) ? 'active' : '' }}">
                              <i class="nav-icon fas fa-users"></i>
                              <p>
                                  Penerima Manfaat
                              </p>
                          </a>
                      </li>
                      <li class="nav-header">MAIN DATA</li>
                      <li class="nav-item ">
                          <a href="{{ route('menu') }}"
                              class="nav-link {{ request()->is(['menu', 'menu/create', 'menu/edit/*']) ? 'active' : '' }}">
                              <i class="nav-icon fas fa-utensils"></i>
                              <p>
                                  Menu
                              </p>
                          </a>
                      </li>
                      <li class="nav-item ">
                          <a href="{{ route('penilaian') }}"
                              class="nav-link {{ request()->is(['penilaian', 'penilaian/detail/*']) ? 'active' : '' }}">
                              <i class="nav-icon fas fa-star"></i>
                              <p>
                                  Penilaian
                              </p>
                          </a>
                      </li>
                      <li class="nav-header">HISTORY</li>
                      <li class="nav-item ">
                          <a href="{{ route('menuLogs') }}"
                              class="nav-link {{ request()->is(['menuLogs']) ? 'active' : '' }}">
                              <i class="nav-icon fas fa-history"></i>
                              <p>
                                  Riwayat Menu
                              </p>
                          </a>
                      </li>
                  @endrole
              </ul>
          </nav>
          <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
  </aside>
