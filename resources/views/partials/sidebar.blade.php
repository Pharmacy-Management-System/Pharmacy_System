
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="dist/img/PharmacyLogo.gif" alt="Pharmacy Logo" class="brand-image img-circle elevation-3" style="opacity: 0.9;">
      <span class="brand-text font-weight-light">Pharmacy System</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Admin</a>
        </div>
      </div>

      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item sidebar-list">
            <a href="#" class="nav-link">
                <img src="dist/img/icons/Pharmacies-icon.png" class="nav-icon">
              <p>
                Pharmacies
              </p>
            </a>
          </li>

          <li class="nav-item sidebar-list">
            <a href="{{route('doctors.index')}}" class="nav-link">
                <img src="dist/img/icons/Doctors-icon.png" class="nav-icon">
              <p>
                Doctors
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link sidebar-list">
              <img src="dist/img/icons/Users-icon.png" class="nav-icon">
              <p>
                Users
              </p>
            </a>
          </li>

          <li class="nav-item sidebar-list">
            <a href="{{route('areas.index')}}" class="nav-link">
              <img src="dist/img/icons/Areas-icon.png" class="nav-icon">
              <p>
                Areas
              </p>
            </a>
          </li>

          <li class="nav-item sidebar-list">
            <a href="#" class="nav-link">
              <img src="dist/img/icons/User-Addresses-icon.png" class="nav-icon">
              <p>
                User Addresses
              </p>
            </a>
          </li>

          <li class="nav-item sidebar-list">
            <a href="{{route('medicines.index')}}" class="nav-link">
                <img src="dist/img/icons/Medicines-icon.png" class="nav-icon">
              <p>
                Medicines
              </p>
            </a>
          </li>

          <li class="nav-item sidebar-list">
            <a href="#" class="nav-link">
                <img src="dist/img/icons/Orders-icon.png" class="nav-icon">
              <p>
                Orders
              </p>
            </a>
          </li>

          <li class="nav-item sidebar-list">
            <a href="#" class="nav-link">
                <img src="dist/img/icons/Revenue-icon.png" class="nav-icon">
              <p>
                Revenue
              </p>
            </a>
          </li>

        </ul>
      </nav>

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
      {{-- <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                User
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="./index.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./index2.html" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add</p>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav> --}}
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

