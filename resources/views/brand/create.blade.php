@extends('layout_admin.master')
@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('brand.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control">
                </div>
                <div class="form-group">
                    <label>Country</label>
                    <input type="text" name="country" class="form-control">
                </div>
                <button class="btn btn-success" id="btn-create" type="button">Create</button>
                <a class="btn btn-primary" href="{{ route('brand.index') }}"> Prev </a>
            </form>
        </div>
    </div>

@endsection
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
                        location.href = "{{ route('brand.index') }}";
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
                        let errorRole = data.responseJSON.errors.role_id ? data.responseJSON.errors.role_id[0] : '';
                        $('.error-role').text(errorRole);
                    }
                });
            });
        });
    </script>
@endpush
