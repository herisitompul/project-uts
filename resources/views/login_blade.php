<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/logo02.png">
    <title>HitaDel | {{ $title }}</title>
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
        <nav class="navigation">
            <a href="/" class="btnLogin-popup"><== Back</a>
        </nav>
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
