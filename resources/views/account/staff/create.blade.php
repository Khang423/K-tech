@extends('layout_admin.master')
@section('content')
    <style>
        #image {
            border: 3px dashed #5BBCFF;
            border-radius: 15px;
            background: #daeffe;
            width: 200px;
            height: 200px;
        }

        .btn {
            width: 100px;
            height: 40px;
        }

    </style>
    <div class="card">
        {{--<div class="card-header"></div>--}}
        <div class="card-body">
            <form action="{{ route('staff.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>Họ Tên</label>
                    <input type="text" name="name" placeholder="Nhập họ tên của bạn" class="form-control"
                           value="{{ old('name') }}">
                    <span class="error-name text-danger"></span>
                </div>
                <div class="form-group">
                    <label>Avatar</label>
                    <br>
                    <div>
                        <img src="{{ asset('image')}}/upload.png" id="image">
                        <input type="file" name="avatar" id="img-file" onchange="chooseFile(this)">
                    </div>
                </div>

                <div class="form-group">
                    <label>Số điện thoại</label>
                    <input type="text" name="phone" placeholder="Nhập số điện thoại của bạn" class="form-control"
                           value="{{ old('phone') }}">
                    <span class="error-phone text-danger"></span>
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" placeholder="Nhập email của bạn" class="form-control"
                           value="{{ old('email') }}">
                    <span class="error-mail text-danger"></span>
                </div>

                <div class="form-group">
                    <label>Tên Tài Khoản</label>
                    <input type="text" name="username" placeholder="Nhập tên tài khoản của bạn" class="form-control"
                           value="{{ old('username') }}">
                    <span class="error-username text-danger"></span>
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
                    <span class="error-password text-danger"></span>
                </div>
                <select class="custom-select mb-3" name="role_id">
                    <option selected disabled> Vai Trò</option>
                    @foreach($name_role as $i)
                        <option value="{{ $i->id }} ">
                            {{ $i->name}}
                        </option>
                    @endforeach
                </select>
                <span class="error-role text-danger"></span>
                <br>

                <button class="btn btn-success" id="btn-create" type="button"> Create</button>
                <a href="{{ route('staff.index') }}" class="btn btn-primary"> Prev </a>

            </form>

        </div>
    </div>
    @push('js')
        <script>
            $(document).ready(function () {

                $(document).on('click', '#btn-create', function () {
                    let form = $(this).parents('form');
                    let createUrl = form.attr('action');
                    let formData = new FormData(form[0]);

                    $.ajax({
                        url: createUrl,
                        type: 'POST',
                        dataType: 'json',
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function (data) {
                            console.log("success");
                            location.href = "{{ route('staff.index') }}";
                        },
                        error: function (data) {
                            console.log(data);
                            let errorName = data.responseJSON.errors.name ? data.responseJSON.errors.name[0] : '';
                            $('.error-name').text(errorName);
                            let errorPhone = data.responseJSON.errors.phone ? data.responseJSON.errors.phone[0] : '';
                            $('.error-phone').text(errorPhone);
                            let errorMail = data.responseJSON.errors.email ? data.responseJSON.errors.email[0] : '';
                            $('.error-mail').text(errorMail);
                            let errorUsername = data.responseJSON.errors.username ? data.responseJSON.errors.username[0] : '';
                            $('.error-username').text(errorUsername);
                            let errorPassword = data.responseJSON.errors.password ? data.responseJSON.errors.password[0] : '';
                            $('.error-password').text(errorPassword);
                            let errorRole = data.responseJSON.errors.roles_id ? data.responseJSON.errors.roles_id[0] : '';
                            $('.error-role').text(errorRole);
                        }
                    });
                });
            });

            function chooseFile(fileInput) {
                if (fileInput.files && fileInput.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $('#image').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(fileInput.files[0]);
                }
            }
        </script>
    @endpush

@endsection
