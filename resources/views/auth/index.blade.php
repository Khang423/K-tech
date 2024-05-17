@extends('layout_admin.login')
@section('content')
    <form action="{{ route('process_login') }}" method="post">
        @csrf
        <div class="form-group">
            <label>Username</label>
            <input class="form-control" type="text" id="emailaddress" name="username" placeholder="Enter your username">
            <span class="error-username text-danger"></span>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input class="form-control" type="password" id="password" autocomplete="off" name="password"
                placeholder="Enter your password">
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
    $(document).ready(function() {
        $(document).on('click', '#btn-login', function() {
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
                    location.href = "{{ route('admin.index') }}";
                },
                error: function(data) {
                    console.log(data);
                    let errorUsername = data.responseJSON.errors.username ? data
                        .responseJSON.errors.username[0] : '';
                    $('.error-username').text(errorUsername);
                    let errorPassword = data.responseJSON.errors.password ? data
                        .responseJSON.errors.password[0] : '';
                    $('.error-password').text(errorPassword);
                    let message = data.responseJSON.errors ? data.responseJSON.errors : '';
                    $('.message').text(message);
                }
            });
        });
    });
</script>
