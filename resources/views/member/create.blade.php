@extends('layout.master')
@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('members.store') }}" method="post">
        @csrf
        <div class="form-group">
            <label for="simpleinput">Name</label>
            <input type="text" id="simpleinput" class="form-control" name="name" placeholder="Enter your name" >
        </div>

        <div class="form-group">
            <label for="example-number">Phone</label>
            <input class="form-control" id="example-number" type="number" name="phone" placeholder="Enter your phone">
        </div>

        <div class="form-group">
            <label for="example-email">Email</label>
            <input type="email" id="example-email" name="email" class="form-control" placeholder="Enter your email"">
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <div class="input-group input-group-merge">
                <input type="password" id="password" class="form-control" name="password" placeholder="Enter your password">
                <div class="input-group-append" data-password="false">
                    <div class="input-group-text">
                        <span class="password-eye"></span>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="password">Confirm password</label>
            <div class="input-group input-group-merge">
                <input type="password" id="password" class="form-control" name="confirm_password" placeholder="Enter your password">
                <div class="input-group-append" data-password="false">
                    <div class="input-group-text">
                        <span class="password-eye"></span>
                    </div>
                </div>
            </div>
        </div>

        <select class="custom-select mb-3">
            <option selected> Role</option>
            <option value="1"> Quản Trị Viên </option>
            <option value="2"> Nhân Viên</option>
        </select>
        <button class="btn btn-success ">Create</button>
    </form>
@endsection
