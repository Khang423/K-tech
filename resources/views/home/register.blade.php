@extends('layout_admin.register')
@section('content')
    <form action="{{ route('home.process_register') }}">
        @csrf
        <div class="form-group">
            <label for="emailaddress">Mail</label>
            <input class="form-control" type="email" name="email" id="emailaddress" required placeholder="Enter your email">
            <span class="error-email text-danger"></span>
        </div>
        <div class="form-group">
            <label for="fullname">Họ và tên</label>
            <input class="form-control" type="text" id="name" name="name" placeholder="Enter your name" required>
            <span class="error-name text-danger"></span>
        </div>
        <div class="form-group">
            <label for="password">Mật khẩu</label>
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
        <div class="form-group">
            <label for="password">Xác nhận lại mật khẩu</label>
            <div class="input-group input-group-merge">
                <input type="password" id="password" class="form-control" placeholder="Enter your password">
                <div class="input-group-append" data-password="false">
                    <div class="input-group-text">
                        <span class="password-eye"></span>
                    </div>
                </div>
            </div>
            <span class="error-password text-danger"></span>
        </div>
        <div class="form-group mb-0 text-center">
            <button class="btn btn-primary btn-block" type="button" id="btn-create">
                <i class="mdi mdi-account-circle"></i>
                Sign Up
            </button>
        </div>
    </form>
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $(document).on('click', '#btn-create', function() {
            let form = $(this).parents('form');
            let formData = new FormData(form[0]);
            $.ajax({
                url: form.attr('action'),
                type: 'POST',
                dataType: 'json',
                data: formData,
                contentType: false,
                processData: false,
                success: function(data) {
                    console.log("success");
                    location.href = "{{ route('home.login') }}";
                },
                error: function(data) {
                    console.log(data);
                    let errorName = data.responseJSON.errors.name ? data.responseJSON.errors
                        .name[0] : '';
                    $('.error-name').text(errorName);
                    let errorPassword = data.responseJSON.errors.password ? data
                        .responseJSON.errors.password[0] : '';
                    $('.error-password').text(errorPassword);
                    let errorEmail = data.responseJSON.errors.email ? data.responseJSON
                        .errors.email[0] : '';
                    $('.error-email').text(errorEmail);
                    let message = data.responseJSON.errors ? data.responseJSON.errors : '';
                    $('.message').text(message);
                }
            });
        });

        const button = document.getElementById('btn-create');
        button.addEventListener('keydown', function(event) {
            if (event.key === 'Enter') {
                button.click(); // Tự động kích hoạt nút khi nhấn phím Enter
            }
        });
    });
</script>
