@extends('layout.login')
@section('content')
    <form action=" {{ route('process_login') }}" method="post">
        @csrf
        <div class="form-group">
            <label>Username</label>
            <input class="form-control" type="text" id="emailaddress" required="" name="username" placeholder="Enter your username">
        </div>
        <div class="form-group">
            <a href="pages-recoverpw-2.html" class="text-muted float-right"><small>Forgot your password?</small></a>
            <label for="password">Password</label>
            <input class="form-control" type="password" required="" id="password" name="password" placeholder="Enter your password">
        </div>
        <div class="form-group mb-3">
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="checkbox-signin">
                <label class="custom-control-label" for="checkbox-signin">Remember me</label>
            </div>
        </div>
        <div class="form-group mb-0 text-center">
            <button class="btn btn-primary btn-block" type="submit"><i class="mdi mdi-login"></i> Log In </button>
        </div>
        <!-- social-->
        <div class="text-center mt-4">
            <p class="text-muted font-16">Sign in with</p>
            <ul class="social-list list-inline mt-3">
                <li class="list-inline-item">
                    <a href="javascript: void(0);" class="social-list-item border-primary text-primary"><i class="mdi mdi-facebook"></i></a>
                </li>
                <li class="list-inline-item">
                    <a href="javascript: void(0);" class="social-list-item border-danger text-danger"><i class="mdi mdi-google"></i></a>
                </li>
                <li class="list-inline-item">
                    <a href="javascript: void(0);" class="social-list-item border-info text-info"><i class="mdi mdi-twitter"></i></a>
                </li>
                <li class="list-inline-item">
                    <a href="javascript: void(0);" class="social-list-item border-secondary text-secondary"><i class="mdi mdi-github-circle"></i></a>
                </li>
            </ul>
        </div>
    </form>
@endsection

