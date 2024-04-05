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
    <form action="{{ route('members.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="simpleinput">Họ Tên</label>
            <input type="text" id="simpleinput" class="form-control" name="name" placeholder="Nhập họ tên của bạn">
        </div>

        <div class="form-group">
            <label for="example-number">Số điện thoại</label>
            <input class="form-control" id="example-number" type="number" name="phone" placeholder="Nhập số điện thoại của bạn">
        </div>

        <div class="form-group">
            <label for="example-email">Email</label>
            <input type="email" id="example-email" name="email" class="form-control" placeholder="Nhập email của bạn"">
        </div>

        <div class="form-group">
            <label for="simpleinput">Tên Tài Khoản</label>
            <input type="text" id="simpleinput" class="form-control" name="username" placeholder="Nhập tên tài khoản của bạn">
        </div>
        <div class="form-group">
            <label for="password">Mật Khẩu</label>
            <div class="input-group input-group-merge">
                <input type="password" id="password" class="form-control" name="password" placeholder="Nhập mật khẩu ">
                <div class="input-group-append" data-password="false">
                    <div class="input-group-text">
                        <span class="password-eye"></span>
                    </div>
                </div>
            </div>
        </div>

        <select class="custom-select mb-3" name="roles_id">
            <option selected> Vai Trò </option>
                @foreach($name_role as $i)
                    <option value="{{ $i->id }}"> {{ $i->name}} </option>
                @endforeach
        </select>
        <button class="btn btn-success ">Create</button>
    </form>
@endsection
