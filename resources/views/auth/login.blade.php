{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}

{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Del Cafe</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
</head>
<body>
            <div class="login-text">
                <h2>Welcome to</h2>
                    <h1>DEL CAFE</h1>
            </div>
        <div class="login-container">
        <div class="login-form">
            <form method="POST" action="{{ route('login') }}">
                @csrf
            <h2>Welcome Back!</h2>
            <h3>Login to your Account</h3><br>
                <input type="text" id="name" name="name" class="form-control" placeholder="Your username" required>
                <input type="email" name="email" class="form-control" placeholder="Your Email" required>
                <input type="password" id="password" name="password" class="form-control" placeholder="Your password" required>
                <button type="submit" class="btn btn-login">Log In</button>
            </form>
            <div class="divider">
                <span>or</span>
            </div>
            <div class="login-footer">
                <p>Don't have an account? <a href="{{ route('register') }}">Sign Up</a></p>
            </div>
        </div>
    </div>
</body>
</html> --}}

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/logo02.png">
    {{-- <title>HitaDel | {{ $title }}</title> --}}
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="css/login-registrasi.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        integrity="sha512-...">
    </link>
    <link rel="stylesheet" href="{{ asset('css/login-registrasi.css') }}">
</head>

<body>
    <header class="header">
        <a href="/"><img src="{{ asset('img/layouts/logo03.png') }}" alt=""></a>
        {{-- <nav class="navigation">
            <a href="/" class="btnLogin-popup"><== Back</a>
        </nav> --}}
    </header>

    <div class="wrapper">
        <div class="form-box login" id="login-form">
            <h2>Login</h2>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="input-box">
                    <span class="icon">
                        <i class='bx bxs-envelope'></i>
                    </span>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                        name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    <label for="email">{{ __('Email') }}</label>

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="input-box">
                    <div class="icon">
                        <span class="input-group-text" id="toggle-password"><i class="fa fa-eye-slash"></i></span>
                    </div>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                        name="password" required autocomplete="current-password">
                    <label for="password">{{ __('Password') }}</label>
                </div>
                <div class="remember-forgot">
                    <label><input type="checkbox">Remember me</label>
                    <a href="#">Forgot Password ?</a>
                </div>
                <button type="submit" class="btn">
                    {{ __('Login') }}
                </button>
                <div class="login-register">
                    <p>Don't have account ?
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </p>
                </div>
            </form>
        </div>
    </div>

    <script src="js/login-registrasi.js"></script>
    <script>
        document.getElementById('toggle-password').addEventListener('click', function() {
            var passwordInput = document.getElementById('password');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                this.innerHTML = '<i class="fa fa-eye"></i>';
            } else {
                passwordInput.type = 'password';
                this.innerHTML = '<i class="fa fa-eye-slash"></i>';
            }
        });
    </script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>

</html>
