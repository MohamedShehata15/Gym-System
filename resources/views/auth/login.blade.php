<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Log in</title>

    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css"
        integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog=="
        crossorigin="anonymous" />

    <link href="{{ mix('css/app.css') }}" rel="stylesheet">

</head>
<body class=" container py-3 con"> 
    <h2 class="fw-bold mb-2 text-uppercase text-white  text-center">Welcome To Our Fitness Court</h2>

      <div class="row d-flex justify-content-center align-items-center ">

        <div class="card bg-dark text-white" style="border-radius: 1rem;">
        <div class="card-body p-5 text-center">
        <div class="mb-md-5 mt-md-4 pb-5">
        <form id="loginForm" method="post" action="{{ url('/login') }}">
                    @csrf


              <p class="text-white-50 mb-5">Please enter your email and password!</p>

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

             <div class="row">
                <div class="col-12">
                    <div class="icheck-primary">
                        <input type="checkbox" id="remember">
                        <label for="remember">Remember Me</label>
                    </div>
                </div>
             </div>

             <div class="row my-4">
                <div class="col-12">
                    <button type="submit" class="btn btn-outline-light btn-lg px-5">Sign In</button>
                    </div>
             </div>

             <p class="small mb-5 pb-lg-2"><a class="text-white-50" href="{{ route('password.request') }}">I forgot my password</a> </p>         







        </form>
        </div>
        </div>
    </div>
    </div>

    <script src="{{ mix('js/app.js') }}" defer></script>

</body>

</html>
