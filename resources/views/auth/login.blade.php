<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="{{config('app.name')}}">
    <meta name="author" content="{{config('app.name')}}">
    <meta name="keywords" content="{{config('app.name')}}">
    <title>{{config('app.name')}} | Login</title>
    <script src="{{asset('admin/assets/js/color-modes.js')}}"></script>
    <link rel="stylesheet" href="{{asset('admin/assets/vendors/core/core.css')}}">
    <link rel="stylesheet" href="{{asset('admin/assets/fonts/feather-font/css/iconfont.css')}}">
    <link rel="stylesheet" href="{{asset('admin/assets/css/demo1/style.css')}}">
    <link rel="shortcut icon" href="{{asset('admin/assets/images/favicon.png')}}" />
    <link rel="stylesheet" href="{{asset('css/fontawesome-free-7.0.0-web/css/all.min.css')}}">
</head>
<body>
@include('sweetalert::alert')
<div class="main-wrapper">
    <div class="page-wrapper full-page">
        <div class="page-content d-flex align-items-center justify-content-center">

            <div class="row w-100 mx-0 auth-page">
                <div class="col-md-10 col-lg-8 col-xl-6 mx-auto">
                    <div class="card">
                        <div class="row">
                            <div class="col-md-12 ps-md-0">
                                <div class="auth-form-wrapper px-4 py-5">
                                    <a href="#" class=" text-center nobleui-logo d-block mb-2">{{config('app.name')}}</a>
                                    <h5 class="text-secondary text-center  fw-normal mb-4">Welcome back! Log in to access admin dashboard.</h5>
                                    <form class="forms-sample" action="{{route('login')}}" method="post">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="userEmail" class="form-label">Email address</label>
                                            <input type="email" name="email" class="form-control" id="userEmail" placeholder="Email">
                                            @error('email')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-3" style="position: relative;">
                                            <label for="userPassword" class="form-label">Password</label>
                                            <input type="password" class="form-control" name="password" id="userPassword" autocomplete="current-password" placeholder="Password" style="padding-right: 35px;">
                                            <i toggle="#userPassword" class="fa fa-eye toggle-password" aria-hidden="true"
                                               style="position: absolute; top: 38px; right: 10px; cursor: pointer;"></i>
                                            @error('password')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                            <div class="mt-2">
                                                <a href="{{ route('password.request') }}" class="text-decoration-none">Forgot Password?</a>
                                            </div>
                                        </div>

                                        <div>
                                            <button class="btn btn-primary me-2 mb-2 mb-md-0 text-white">Login</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<script src="{{asset('admin/assets/vendors/core/core.js')}}"></script>
<script src="{{asset('admin/assets/vendors/feather-icons/feather.min.js')}}"></script>
<script src="{{asset('jquery/jquery-3.7.1.min.js')}}"></script>
<script src="{{asset('jq-validation/jquery.validate.js')}}"></script>
<script src="{{asset('jq-validation/additional-methods.js')}}"></script>

<script>

    document.querySelector('.toggle-password').addEventListener('click', function () {
        const input = document.querySelector(this.getAttribute('toggle'));
        if (input.type === 'password') {
            input.type = 'text';
            this.classList.remove('fa-eye');
            this.classList.add('fa-eye-slash');
        } else {
            input.type = 'password';
            this.classList.remove('fa-eye-slash');
            this.classList.add('fa-eye');
        }
    });

</script>

</body>

</html>
