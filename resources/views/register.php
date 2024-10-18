<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/logo02.png">
    <title>HitaDel | {{ $title }}</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="css/login-registrasi.css">
    <link rel="stylesheet" href="{{ asset('css/login-registrasi.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-..."></link>
</head>

<body>
    <header class="header">
        <a href="#"><img src="{{ asset('img/layouts/logo.png') }}" alt=""></a>
        <nav class="navigation">
            <a href="/" class="btnLogin-popup"><== Back</a>
        </nav>
    </header>

    <div class="wrapper-regis">
        <div class="form-box register" id="register-form">
            <h2>Registration</h2>
            <form method="POST" action="{{ route('register') }}">
                @csrf

                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                <div class="input-box">
                    <span class="icon">
                        <i class='bx bxs-user'></i>
                    </span>
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                    <label for="name">{{ __('Name') }}</label>

                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>
                <div class="input-box">
                    <span class="icon">
                        <i class='bx bxs-envelope'></i>
                    </span>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                    <label for="email">{{ __('Email') }}</label>

                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>
                <div class="input-box">
                    <div class="icon toggle-password" data-target="password">
                        <span class="input-group-text"><i class="fa fa-eye-slash"></i></span>
                    </div>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                        name="password" required autocomplete="new-password">
                    <label for="password">{{ __('Password') }}</label>
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="input-box">
                    <div class="icon toggle-password" data-target="password-confirm">
                        <span class="input-group-text"><i class="fa fa-eye-slash"></i></span>
                    </div>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                        required autocomplete="new-password">
                    <label for="password-confirm">{{ __('Confirm Password') }}</label>
                </div>
                <div class="remember-forgot">
                    <label>
                        <input type="checkbox">
                        I agree to the terms & conditions
                    </label>
                </div>
                <button type="submit" class="btn">Register</button>
                <div class="login-register">
                    <p>Already have an account ?
                        <a href="{{ route('login') }}">Login</a>
                    </p>
                </div>
            </form>
        </div>
    </div>

    <script src="js/login-registrasi.js"></script>
    <script>
        document.querySelectorAll('.toggle-password').forEach(function(el) {
            el.addEventListener('click', function() {
                var targetId = this.getAttribute('data-target');
                var passwordInput = document.getElementById(targetId);

                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    this.innerHTML = '<i class="fa fa-eye"></i>';
                } else {
                    passwordInput.type = 'password';
                    this.innerHTML = '<i class="fa fa-eye-slash"></i>';
                }
            });
        });
    </script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>

</html>