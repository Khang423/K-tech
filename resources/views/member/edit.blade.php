@extends('layout.master')
@section('content')
    <form action="{{ route('members.update', $member) }}" method="post">
        @csrf
        @method('put')
        <form action="{{ route('members.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="simpleinput">Name</label>
                <input type="text" id="simpleinput" class="form-control" name="name" value="{{ $member->name }}">
            </div>

            <div class="form-group">
                <label for="example-number">Phone</label>
                <input class="form-control" id="example-number" type="number" name="phone" value="{{ $member->phone }}"
                       placeholder="Enter your phone">
            </div>

            <div class="form-group">
                <label for="example-email">Email</label>
                <input type="email" id="example-email" name="email" class="form-control" value="{{ $member->email }}">
            </div>

            <div class="form-group">
                <label for="simpleinput">UserName</label>
                <input type="text" id="simpleinput" class="form-control" name="username" value="{{ $member->username }}">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <div class="input-group input-group-merge">
                    <input type="password" id="password" class="form-control" name="password"
                           placeholder="Enter your password">
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
                    <input type="password" id="password" class="form-control" name="confirm_password"
                           placeholder="Enter your password">
                    <div class="input-group-append" data-password="false">
                        <div class="input-group-text">
                            <span class="password-eye"></span>
                        </div>
                    </div>
                </div>
            </div>
{{--            <select class="custom-select mb-3" name="roles_id">--}}
{{--                <option selected> Role</option>--}}
{{--                @foreach($name_role as $i)--}}
{{--                    <option value="{{ $i->id }}"> {{ $i->name}} </option>--}}
{{--                @endforeach--}}
{{--            </select>--}}
            <button class="btn btn-success ">Update</button>
        </form>
    </form>
@endsection
