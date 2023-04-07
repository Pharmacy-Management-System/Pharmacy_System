<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('index') }}" class="brand-link my-1">
      <img src="dist/img/PharmacyLogo.gif" alt="Pharmacy Logo" class="brand-image img-circle elevation-3" style="opacity: 0.9;">
      <span class="brand-text font-weight-light align-middle">Pharmacy System</span>
    </a>
    @role('admin')
    <!-- Sidebar -->
    <div class="sidebar" style="height: 84vh;border-bottom:solid thin rgb(96, 96, 96);">
      <nav class="mt-4">
        <ul class="nav nav-pills nav-sidebar flex-column gap-1" data-widget="treeview" role="menu" data-accordion="false">
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

    @endrole

    @role('pharmacy')
    <!-- Sidebar -->
    <div class="sidebar" style="height: 84vh;border-bottom:solid thin rgb(96, 96, 96);">
        <nav class="mt-4">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <li class="nav-item sidebar-list">
                    <a href="{{ route('pharmacies.index') }}" class="nav-link">
                        <img src="dist/img/icons/Pharmacies-icon.png" class="nav-icon">
                        <p>
                            Pharmacy
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
    @endrole
    @role('doctor')
    <!-- Sidebar -->
    <div class="sidebar" style="height: 84vh;border-bottom:solid thin rgb(96, 96, 96);">
        <nav class="mt-5">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <li class="nav-item sidebar-list">
                    <a href="{{route('doctors.index')}}" class="nav-link">
                        <img src="dist/img/icons/Doctors-icon.png" class="nav-icon">
                        <p>
                            Doctor
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
            </ul>
        </nav>
    </div>
    @endrole

    <!--Logout-->
    <a class="nav-link mt-2" href="{{ route('logout') }}" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
        <img src="/dist/img/icons/Logout-icon.png" class="nav-icon" width="30px">
        <span class="ml-2">{{ __('LogOut') }}</span>
    </a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>

    <!-- /.sidebar -->
</aside>
