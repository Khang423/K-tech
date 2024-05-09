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
    </style>
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.update', $admin) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="form-group">
                    <label for="simpleinput">Name</label>
                    <input type="text" id="simpleinput" class="form-control" name="name" value="{{ $admin->name }}">
                    <span class="error-name text-danger"></span>
                </div>

                <div class="form-group">
                    <label>Avatar</label>
                    <br>
                    <div>
                        <img src="{{ asset('storage/'.$admin->avatar) }}" id="image">
                        <input type="file" name="avatar-new" id="img-file" onchange="chooseFile(this)">
                        <input type="hidden" name="avatar" value="{{$admin->avatar}}" id="img-file"
                               onchange="chooseFile(this)">
                    </div>
                </div>
                <div class="form-group">
                    <label for="example-number">Phone</label>
                    <input class="form-control" id="example-number" type="number" name="phone"
                           value="{{ $admin->phone }}"
                           placeholder="Enter your phone">
                    <span class="error-phone text-danger"></span>
                </div>

                <div class="form-group">
                    <label for="example-email">Email</label>
                    <input type="email" id="example-email" name="email" class="form-control"
                           value="{{ $admin->email }}">
                    <span class="error-mail text-danger"></span>
                </div>

                <div class="form-group">
                    <label for="simpleinput">UserName</label>
                    <input type="text" id="simpleinput" class="form-control" name="username"
                           value="{{ $admin->username }}">
                    <span class="error-username text-danger"></span>
                </div>
                <select class="custom-select mb-3" name="role_id">
                    <option selected disabled> Role</option>
                    @foreach($name_role as $i)
                        <option value="{{ $i->id }}"
                                @if($i->id === $admin->role_id)
                                    selected
                                @endif>
                            {{$i->name}}
                        </option>
                    @endforeach
                </select>
                <span class="error-role text-danger"></span>
                <br>
                <button class="btn btn-success" id="btn-update" type="button">Update</button>
            </form>
        </div>
    </div>
@endsection
@push('js')
    <script>
        $(document).ready(function () {
            $(document).on('click', '#btn-update', function () {
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
                        location.href = "{{ route('admin.index') }}";
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
