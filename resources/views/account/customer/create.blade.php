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
    <form action="{{ route('customer.store') }}" method="POST" enctype="multipart/form-data">
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <div class="float-left">
                            @csrf
                            {{--name--}}
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="name" placeholder="Enter your name " class="form-control"
                                       value="{{ old('name') }}">
                                <span class="error-name text-danger"></span>
                            </div>
                            {{--phone--}}
                            <div class="form-group">
                                <label>Số điện thoại</label>
                                <input type="text" name="phone" placeholder="Nhập số điện thoại của bạn"
                                       class="form-control"
                                       value="{{ old('phone') }}">
                                <span class="error-phone text-danger"></span>
                            </div>
                            {{-- email--}}
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" name="email" placeholder="Nhập email của bạn" class="form-control"
                                       value="{{ old('email') }}">
                                <span class="error-mail text-danger"></span>
                            </div>
                            {{--gender--}}
                            <select class="custom-select mb-3 mt-3" name="gender">
                                <option selected disabled>Gender</option>
                                <option value="1">Male</option>
                                <option value="2">Female</option>
                            </select>
                            {{--birthdate--}}
                            <div class="form-group">
                                <label for="example-date">Birthdate</label>
                                <input class="form-control" id="example-date" type="date" name="birthdate">
                            </div>
                            {{--password--}}
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
                                <span class="error-password text-danger"></span>
                            </div>
                            {{--address--}}
                            <div class="form-group">
                                <label for="simpleinput">Address</label>
                                <input type="text" id="simpleinput" class="form-control" name="address">
                            </div>
                            {{--city--}}
                            <div class="form-group">
                                <select name="city_id" class="form-control select2" data-toggle="select2" id="city"
                                        required>
                                    <option disabled selected hidden>--Tỉnh/Thành Phố--</option>
                                    @foreach($city_name as $i)
                                        <option value="{{$i->id}}">
                                            {{$i->name}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            {{--district--}}
                            <div class="form-group">
                                <select name="district_id" class="district form-control select2" data-toggle="select2"
                                        required>
                                    <option disabled selected hidden>--Quận/Huyện--</option>
                                </select>
                            </div>
                            {{--ward--}}
                            <div class="form-group">
                                <select name="wards_id" class="form-control select2" data-toggle="select2" id="ward"
                                        required>
                                    <option disabled selected hidden>--Xã/Phường--</option>
                                </select>
                            </div>
                            <div class="float-right">
                                <button class="btn btn-success" id="btn-create" type="button">Create</button>
                                <a class="btn btn-primary" href="{{ route('admin.index') }}"> Prev </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <div class="float-right">
                            {{--avatar--}}
                            <div class="form-group">
                                <label>Avatar</label>
                                <br>
                                <div>
                                    <img src="{{ asset('image')}}/upload.png" id="image" alt="">
                                    <input type="file" name="avatar" id="img-file" onchange="chooseFile(this)">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    @push('js')
        <script>
            $(document).ready(function () {
                // event select district
                $('#city').change(function () {
                    let city_id = $(this).val();
                    $.ajax({
                        url: '{{ route('districts.loadDistrict') }}',
                        type: "POST",
                        data: {city_id: city_id, _token: '{{ csrf_token() }}'},
                        success: function (data) {
                            console.log('success');
                            $('.district').empty();
                            $.each(data, function (index, item) {
                                if (index === 0) {
                                    $('.district').append(
                                        $('<option>', {
                                            text: '--Quận/Huyện--'
                                        })
                                    );
                                }
                                $('.district').append(
                                    $('<option>', {
                                        value: item.id,
                                        text: item.name
                                    })
                                );
                            });
                            $(".district option:first").attr("disabled", "true").attr("selected", "true");
                        },
                        error: function (data) {
                            console.log('error');
                        },

                    });
                });
                // event select ward
                $('.district').change(function () {
                    let district_id = $(this).val();
                    $.ajax({
                        url: '{{ route('ward.loadWard') }}',
                        type: "POST",
                        data: {district_id: district_id, _token: '{{ csrf_token() }}'},
                        success: function (data) {
                            console.log('success');
                            $('#ward').empty();
                            $.each(data, function (index, item) {
                                if (index === 0) {
                                    $('#ward').append(
                                        $('<option>', {
                                            text: '--Xã/Phường--'
                                        })
                                    );
                                }
                                $('#ward').append(
                                    $('<option>', {
                                        value: item.id,
                                        text: item.name
                                    })
                                );
                            });
                            $("#ward option:first").attr("disabled", "true").attr("selected", "true");
                        },
                        error: function (data) {
                            console.log('error');
                        },

                    });
                });
                // even click btn create
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
                            location.href = "{{ route('customer.index') }}";
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

@endsection
