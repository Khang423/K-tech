@extends('layout_admin.register')
@section('content')
    <form action="{{ route('process_register') }}">
        @csrf
        <div class="form-group">
            <label for="fullname">Full Name</label>
            <input class="form-control" type="text" id="fullname" placeholder="Enter your name" required>
        </div>
        <div class="form-group">
            <label for="emailaddress">Email address</label>
            <input class="form-control" type="email" id="emailaddress" required placeholder="Enter your email">
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input class="form-control" type="password" required id="password" placeholder="Enter your password">
        </div>
        <div class="form-group">
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="checkbox-signup">
                <label class="custom-control-label" for="checkbox-signup">I accept <a href="javascript: void(0);"class="text-muted">Terms and Conditions</a></label>
            </div>
        </div>
        <div class="form-group mb-0 text-center">
            <button class="btn btn-primary btn-block" type="submit"><i class="mdi mdi-account-circle"></i> Sign Up
            </button>
        </div>
        <!-- social-->
        <div class="text-center mt-4">
            <p class="text-muted font-16">Sign up using</p>
            <ul class="social-list list-inline mt-3">
                <li class="list-inline-item">
                    <a href="javascript: void(0);" class="social-list-item border-primary text-primary"><i
                                class="mdi mdi-facebook"></i></a>
                </li>
                <li class="list-inline-item">
                    <a href="javascript: void(0);" class="social-list-item border-danger text-danger"><i
                                class="mdi mdi-google"></i></a>
                </li>
                <li class="list-inline-item">
                    <a href="javascript: void(0);" class="social-list-item border-info text-info"><i
                                class="mdi mdi-twitter"></i></a>
                </li>
                <li class="list-inline-item">
                    <a href="javascript: void(0);" class="social-list-item border-secondary text-secondary"><i
                                class="mdi mdi-github-circle"></i></a>
                </li>
            </ul>
        </div>
    </form>
@endsection
