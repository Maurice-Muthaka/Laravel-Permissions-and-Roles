@auth
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
        <span class="brand-text font-weight-light">{{ config('app.name', 'Rugno') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
            @guest
            @else
                <a href="/" class="d-block">{{ Auth::user()->name }}</a>
            @endguest
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item">
            <a href="/" class="nav-link {{ Request::is('/') ? 'active' : '' }}">
            <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>

            <!-- <li class="nav-item">
            <a href="/roles" class="nav-link {{ Request::is('roles') ? 'active' : '' }}">
            <i class="nav-icon fas fa-key"></i>
              <p>
                Roles & Permissions
              </p>
            </a>
          </li> -->

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link {{ Request::is(['roles', 'users', 'permissions']) ? 'active' : '' }}">
              <i class="nav-icon fas fa-key"></i>
              <p>
                User Management
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>

            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/roles" class="nav-link {{ Request::is('roles') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Roles</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="/permissions" class="nav-link {{ Request::is('permissions') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Permissions</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="/users" class="nav-link {{ Request::is('users') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Users</p>
                </a>
              </li>
            </ul>
          </li>

          <!-- <li class="nav-item">
            <a href="/users" class="nav-link {{ Request::is('users') ? 'active' : '' }}">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Users
                <span class="right badge badge-danger">New</span>
              </p>
            </a>
          </li> -->

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Customers
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right">6</span>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Saccos</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Privates</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Distributers</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-header">MISCELLANEOUS</li>
          <li class="nav-item">
            <a href="https://adminlte.io/docs/3.0" class="nav-link">
              <i class="nav-icon fas fa-file"></i>
              <p>Documentation</p>
            </a>
          </li>
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
  @endauth