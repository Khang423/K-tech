@extends('layout_admin.login')
@section('content')
    <form action="{{ route('home.process_login') }}" method="post">
        @csrf
        <div class="form-group">
            <label>Mail</label>
            <input class="form-control" type="text" id="emailaddress" name="email" placeholder="Enter your username">
            <span class="error-email text-danger"></span>
        </div>

        <div class="form-group">
            <a href="pages-recoverpw-2.html" class="text-muted float-right"><small>Forgot your password?</small></a>
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
            <span class="error-password text-danger"></span>
        </div>
        <span class="message text-danger"></span>
        <div class="form-group mb-0 text-center">
            <button class="btn btn-primary btn-block" id="btn-login" type="button"><i class="mdi mdi-login"></i> Log In
            </button>
        </div>
    </form>
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        $(document).on('click', '#btn-login', function () {
            let form = $(this).parents('form');
            let formData = new FormData(form[0]);
            $.ajax({
                url: form.attr('action'),
                type: 'POST',
                dataType: 'json',
                data: formData,
                contentType: false,
                processData: false,
                success: function (data) {
                    console.log("success");
                    location.href = "{{ route('home.index') }}";
                },
                error: function (data) {
                    console.log(data);
                    let errorUsername = data.responseJSON.errors.email ? data.responseJSON.errors.email[0] : '';
                    $('.error-email').text(errorUsername);
                    let errorPassword = data.responseJSON.errors.password ? data.responseJSON.errors.password[0] : '';
                    $('.error-password').text(errorPassword);
                    let eror = data.responseJSON.errors ? data.responseJSON.errors : '';
                    $('.message').text(eror);
                }
            });
        });
    });
</script>

