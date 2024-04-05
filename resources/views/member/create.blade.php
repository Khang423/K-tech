@extends('layout.master')
@section('content')

    <div class="card">
{{--        <div class="card-header"></div>--}}
        <div class="card-body">
            <form action="{{ route('members.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>Họ Tên</label>
                    <input type="text" name="name" placeholder="Nhập họ tên của bạn" class="form-control"
                           value="{{ old('name') }}">
                    @if($errors->has('name'))
                        <span class="text-danger">
                    {{ $errors->first('name') }}
                </span>
                    @endif
                </div>

                <div class="form-group">
                    <label>Số điện thoại</label>
                    <input type="text" name="phone" placeholder="Nhập số điện thoại của bạn" class="form-control"
                           value="{{ old('phone') }}">
                    @if($errors->has('phone'))
                        <span class="text-danger">
                    {{ $errors->first('phone') }}
                </span>
                    @endif
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" placeholder="Nhập email của bạn" class="form-control"
                           value="{{ old('email') }}">
                    @if($errors->has('email'))
                        <span class="text-danger">
                    {{ $errors->first('email') }}
                </span>
                    @endif
                </div>

                <div class="form-group">
                    <label>Tên Tài Khoản</label>
                    <input type="text" name="username" placeholder="Nhập tên tài khoản của bạn" class="form-control"
                           value="{{ old('username') }}">
                    @if($errors->has('username'))
                        <span class="text-danger">
                    {{ $errors->first('username') }}
                </span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="password">Mật Khẩu</label>
                    <div class="input-group input-group-merge">
                        <input type="password" id="password" class="form-control" name="password"
                               placeholder="Enter your password">
                        <div class="input-group-append" data-password="false">
                            <div class="input-group-text">
                                <span class="password-eye"></span>
                            </div>
                        </div>
                    </div>
                    @if($errors->has('password'))
                        <span class="text-danger">
                    {{ $errors->first('password') }}
                </span>
                    @endif
                </div>
                <select class="custom-select mb-3" name="roles_id">
                    <option selected> Vai Trò</option>
                    @foreach($name_role as $i)
                        <option value="{{ $i->id }}"> {{ $i->name}} </option>
                    @endforeach
                </select>
                @if($errors->has('roles_id'))
                    <span class="text-danger">
                    {{ $errors->first('roles_id') }}
                </span>
                @endif
                <button class="btn btn-success">Create</button>
                <a class="btn btn-primary" href="{{ route('members.index') }}"> Prev </a>
            </form>

        </div>
    </div>

@endsection
