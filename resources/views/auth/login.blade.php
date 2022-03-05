<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ config('app.name') }}</title>

    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css"
        integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog=="
        crossorigin="anonymous" />

    <link href="{{ mix('css/app.css') }}" rel="stylesheet">

</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="{{ url('/home') }}"><b>{{ config('app.name') }}</b></a>
        </div>
        <!-- /.login-logo -->

        <!-- /.login-box-body -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Sign in to start your session</p>

                <form id="loginForm" method="post" action="{{ url('/login') }}">
                    @csrf

                    <div class="input-group mb-3">
                        <input type="email" name="email" value="{{ old('email') }}" placeholder="Email"
                            class="form-control @error('email') is-invalid @enderror">
                        <div class="input-group-append">
                            <div class="input-group-text"><span class="fas fa-envelope"></span></div>
                        </div>
                        @error('email')
                        <span class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="input-group mb-3">
                        <input type="password" name="password" placeholder="Password"
                            class="form-control @error('password') is-invalid @enderror">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        @error('password')
                        <span class="error invalid-feedback">{{ $message }}</span>
                        @enderror

                    </div>

                    <div class="row mb-2">
                        <div class="col d-flex">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="loginRole" id="inputStaffRadio"
                                    value="staff" @if(old('loginRole') == 'staff') checked @endif>
                                <label class="form-check-label" for="inputStaffRadio">
                                    Staff
                                </label>
                            </div>
                            <div class="form-check mx-3">
                                <input class="form-check-input" type="radio" name="loginRole" id="inputUserRadio"
                                    value="user" @if(old('loginRole') != 'staff') checked @endif>
                                <label class="form-check-label" for="inputUserRadio">
                                    User
                                </label>
                            </div>
                        </div>
                    </div>

            <div class="row">
                <div class="col-8">
                    <div class="icheck-primary">
                        <input type="checkbox" id="remember">
                        <label for="remember">Remember Me</label>
                    </div>
                </div>

                <div class="col-4">
                    <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                </div>

            </div>
            </form>

            <p class="mb-1">
                <a href="{{ route('password.request') }}">I forgot my password</a>
            </p>
            <p class="mb-0">
                <a href="{{ route('register') }}" class="text-center">Register a new membership</a>
            </p>
        </div>
        <!-- /.login-card-body -->
    </div>

    </div>
    <!-- /.login-box -->

    <script src="{{ mix('js/app.js') }}" defer></script>
    <script defer>
        const loginForm = document.querySelector('#loginForm');

        loginForm.addEventListener('submit',  function(e) {
            e.preventDefault();
            const loginRole = document.querySelector("input[name='loginRole']:checked")?.value;
            if(loginRole == 'staff')
                this.setAttribute('action', '/login/staff')
            else
                this.setAttribute('action', '/login')

            this.submit();
        })

    </script>

</body>

</html>
