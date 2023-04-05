<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="icon" href="dist/img/PharmacyLogo.png">
        <title>Pharmacy System | Login</title>

        {{--  style--}}
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{asset("dist/css/adminlte.min.css")}}">

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    </head>
    <body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
        <div class="wrapper">
            <div class="container">
                <div class="row justify-content-center align-items-center" style="height: 100vh;">
                    <div class="col-8 col-md-6 col-lg-4">
                        <div class="card py-4" style="border-radius:10px;">
                            <div class="text-center fw-bold fs-2 my-2">{{ __('LOGIN') }}</div>
                            @if(session('error'))
                                <div class="d-flex justify-content-center align-items-center mb-2" >
                                    <div id ="alert-message" class="col-10 alert alert-danger mt-4 mb-0 alert-dismissible">
                                        {{ session('error') }}
                                        <button type="button" class="close" data-bs-dismiss="alert">&times;</button>
                                    </div>
                                </div>
                            @endif
                            <div class="card-body col-12 m-0">
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <div class="col-12 mb-4">
                                        <span>
                                            <div class="input-group">
                                                <span class="input-group-text" id="email-icon">@</span>
                                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="{{ __('Email Address') }}" value="{{ old('email') }}" required autocomplete="email" autofocus style="height: 50px;">
                                            </div>

                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </span>
                                    </div>

                                    <div class="col-12 mb-4">
                                        <span>
                                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="{{ __('Password') }}" required autocomplete="current-password" style="height: 50px;">

                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </span>
                                    </div>

                                    <div class="d-flex justify-content-evenly align-items-center mb-4">
                                        <div class="form-check">
                                          <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} />
                                          <label class="form-check-label" for="remember"> {{ __('Remember Me') }} </label>
                                        </div>
                                        @if (Route::has('password.request'))
                                            <a class="btn btn-link" href="{{ route('password.request') }}">{{ __('Forgot Password?') }}</a>
                                        @endif
                                    </div>

                                    <div class="col-12 mb-0">
                                        <div class="col-12 d-flex flex-row justify-content-center align-items-center">
                                            <button type="submit" class="col-11 col-md-8 btn btn-primary text-center">
                                                {{ __('LOGIN') }}
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
