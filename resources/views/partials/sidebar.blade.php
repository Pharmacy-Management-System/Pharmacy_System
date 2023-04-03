
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="dist/img/PharmacyLogo.gif" alt="Pharmacy Logo" class="brand-image img-circle elevation-3" style="opacity: 0.9;">
      <span class="brand-text font-weight-light">Pharmacy System</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <!-- Sidebar user panel-->
      {{-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Admin</a>
        </div>
      </div> --}}

      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item sidebar-list">
            <a href="{{ route('pharmacies.index') }}" class="nav-link">
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
            <a href="{{route('clients.index')}}" class="nav-link sidebar-list">
              <img src="dist/img/icons/Users-icon.png" class="nav-icon">
              <p>
                Clients
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
            <a href="{{route('addresses.index')}}" class="nav-link">
              <img src="dist/img/icons/User-Addresses-icon.png" class="nav-icon">
              <p>
                Client Addresses
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
            <a href="{{route('orders.index')}}" class="nav-link">
                <img src="dist/img/icons/Orders-icon.png" class="nav-icon">
              <p>
                Orders
              </p>
            </a>
          </li>

          <li class="nav-item sidebar-list">
            <a href="{{route('revenues.index')}}" class="nav-link">
                <img src="dist/img/icons/Revenue-icon.png" class="nav-icon">
              <p>
                Revenue
              </p>
            </a>
          </li>

        </ul>
      </nav>
    </div>
    <!-- /.sidebar -->
  </aside>

