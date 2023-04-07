<nav class="main-header navbar navbar-expand navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ route('index') }}" class="nav-link">Home</a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->
        <li class="nav-item">
            <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                <i class="fas fa-search"></i>
            </a>
            <div class="navbar-search-block">
                <form class="form-inline">
                    <div class="input-group input-group-sm">
                        <input class="form-control form-control-navbar" type="search" placeholder="Search"
                            aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-navbar" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                            <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                <i class="fas fa-th-large"></i>
            </a>
        </li>
        @guest
            @if (Route::has('login'))
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
            @endif
        @else
            <li class="nav-item">
                <a id="navbarDropdown" class="nav-link" href="{{ route('index') }}" role="button"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    @role('pharmacy')
                    <img src="{{ asset('storage/pharmacies_Images/' . (Auth::user()->pharmacy->avatar_image))}}" class="img-circle elevation-2 me-1" alt="User Image"
                        width="30">
                    @endrole
                    @role('doctor')
                    <img src="{{ asset('storage/doctors_Images/' . (Auth::user()->doctor->avatar_image))}}" class="img-circle elevation-2 me-1" alt="User Image"
                        width="30">
                    @endrole
                    @role('admin')
                    <img src="dist/img/admin.jpg" class="img-circle elevation-2 me-1" alt="User Image"
                        width="30">
                    @endrole
                    {{ Auth::user()->name }}
                </a>
            </li>

        @endguest
    </ul>
</nav>
