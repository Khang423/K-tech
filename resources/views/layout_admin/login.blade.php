<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8"/>
    <title> Log in </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description"/>
    <meta content="Coderthemes" name="author"/>
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- App css -->
    <link href="{{ asset('css/icons.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('css/app-creative.min.css') }}" rel="stylesheet" type="text/css" id="light-style"/>
    <link href="{{ asset('css/app-creative-dark.min.css') }}" rel="stylesheet" type="text/css" id="dark-style"/>

    <style>
        #bg-login{
            background-image: url({{ asset('image/bg_Login.jpg.')}});
            background-size: cover;
        }
    </style>
</head>

<body class="authentication-bg pb-0" data-layout-config='{"darkMode":false}'>
<div class="auth-fluid">
    <!--Auth fluid left content -->
    <div class="auth-fluid-form-box">
        <div class="align-items-center d-flex h-100">
            <div class="card-body">

                <!-- Logo -->
                <div class="auth-brand text-center text-lg-left">
                    <a href="index.html" class="logo-dark">
                        <img src="{{ asset('image/login.png.') }}" style="width: 200px; height:120px; margin-left: 40%">
                    </a>
                    <a href="index.html" class="logo-light">
                        <span><img src="{{ asset('image/login.png.') }}" alt="" height="18"></span>
                    </a>
                </div>

                <!-- title-->
                <h4 class="mt-0">Sign In</h4>
                <p class="text-muted mb-4">Enter your username and password to access account.</p>

                <!-- form -->
                @yield('content')
                <!-- end form-->

                <!-- Footer-->
{{--                <footer class="footer footer-alt">--}}
{{--                    <p class="text-muted">Don't have an account? <a href="pages-register-2.html"--}}
{{--                                                                    class="text-muted ml-1"><b>Sign Up</b></a></p>--}}
{{--                </footer>--}}

            </div> <!-- end .card-body -->
        </div> <!-- end .align-items-center.d-flex.h-100-->
    </div>
    <!-- end auth-fluid-form-box-->

    <!-- Auth fluid right content -->
    <div class="auth-fluid-right text-center" id="bg-login" >
        <div class="auth-user-testimonial" >

        </div> <!-- end auth-user-testimonial-->
    </div>
    <!-- end Auth fluid right content -->
</div>
<!-- end auth-fluid-->

<!-- bundle -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="{{ asset('js/vendor.min.js') }}"></script>
<script src="{{ asset('js/app.min.js') }}"></script>

</body>

</html>
