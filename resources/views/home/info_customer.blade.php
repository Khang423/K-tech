@extends('layout_home.product_detail')
@section('content')
    <style>
        #empty {
            padding-top: 200px;
        }

        #btn_info {
            float: left;
            margin-left: 100px;
            border-radius: 10px;
            border: none;
            width: 400px;
            height: 40px;
            font-size: 15px;
            font-family: Arial, Baskerville, monospace;
            background-color: #130f0f;
            color: white;
        }

        #btn_info:hover {
            background-color: #333333;
        }

        #btn_buy {
            float: right;
            margin-right: 100px;
            border-radius: 10px;
            border: none;
            width: 400px;
            height: 40px;
        }

        #customer-name {
            margin-left: 190px;
        }

        .form-info {
            margin-top: 50px;
        }

        .info {
            margin: auto;
            width: 500px;
        }

        table tr {
            align-items: center;
            height: 40px;
        }

        table td {
            top: 10px;
            justify-content: center;
        }

        td input {
            outline: none;
            border: none;
        }

        .btn-update {
            width: 100%;
            height: 40px;
            border: none;
            border-radius: 5px;
            margin-top: 40px;
            background-color: #474d56;
            color: #fff;
        }

        .gender {
            border: none;
        }

        #address input {
            width: 230px;
            height: 40px;
            padding: 15px;
        }
    </style>
    <div id="empty">
        <div class="row">
            <div class="col-md-6">
                <button id="btn_info">
                    Tài khoản của tôi
                </button>
            </div>
            <div class="col-md-6">
                <a href="">
                    <button id="btn_buy">
                        Lịch sử mua hàng
                    </button>
                </a>
            </div>
        </div>
        <div>
            <div class="form-info">
                <div class="info">
                    <div class="display-header d-flex justify-content-between pb-3 " id="customer-name">
                        <h5 class="display-7 text-uppercase" style="padding-right: 5px;color: #666">{{ $customer->name }}
                        </h5>
                    </div>
                    <form action="{{ route('home.info_update') }}" method="post">
                        @csrf
                        <table class="table table-sm table-centered mb-0" width="90%">
                            <tr>
                                <td>
                                    Họ tên: <input type="text" name="name" value="{{ $customer->name }}">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Gmail : {{ $customer->email }}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Giới tính :
                                    <select class="gender" name="gender">
                                        <option value="0" {{ $customer->gender == 0 ? 'selected' : '' }}>Chưa cập nhật
                                        </option>
                                        <option value="1" {{ $customer->gender == 1 ? 'selected' : '' }}>Nam</option>
                                        <option value="2" {{ $customer->gender == 2 ? 'selected' : '' }}>Nữ</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Số điện thoại : <input type="text" name="phone" value="{{ $customer->phone }}">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Ngày sinh : <input type="date" name="birthdate" value="{{ $customer->birthdate }}">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Ngày tham gia vào Kmember : {{ $customer->created_at->format('d/m/Y') }}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="">
                                        Đổi mật khẩu
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group" id="address">
                                                <label> Tỉnh Thành Phố</label>
                                                <select name="city_id" class="form-control select2" data-toggle="select2"
                                                    id="city" required>
                                                    <option  selected hidden value="{{ $customer->city_id}}" >
                                                        @if ($customer->city_id)
                                                            {{ $customer->city->name }}
                                                        @else
                                                            --Tỉnh/Thành Phố--
                                                        @endif
                                                    </option>
                                                    @foreach ($city_name as $i)
                                                        <option value="{{ $i->id }}">
                                                            {{ $i->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group" id="address">
                                                <label> Quận huyện </label>
                                                <select name="district_id" class="district form-control select2"
                                                    data-toggle="select2" required>
                                                    <option  selected hidden value="{{ $customer->district_id}}">
                                                        @if ($customer->district_id)
                                                            {{ $customer->district->name }}
                                                        @else
                                                            --Quận/Huyện--
                                                        @endif
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group" id="address">
                                                <label> Xã Phường</label>
                                                <select name="wards_id" class="form-control select2" data-toggle="select2"
                                                    id="ward" required>
                                                    <option  selected hidden value="{{ $customer->wards_id}}">
                                                        @if ($customer->wards_id)
                                                            {{ $customer->ward->name }}
                                                        @else
                                                            --Xã/Phường--
                                                        @endif
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group" id="address">
                                                <label>Địa chỉ</label><br>
                                                <input id="address" type="text" name="address"
                                                    value="{{ $customer->address }}">
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </table>
                        <button class="btn-update" type="button">
                            Cập nhật
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            $(document).on('click', '.btn-update', function() {
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
                    success: function(data) {
                        console.log("success");
                        Swal.fire({
                            title: "Cập nhật thành công!",
                            showConfirmButton: false,
                            timer: 3000,
                            icon: "success"
                        });
                    },
                    error: function(data) {
                        console.log(data);
                    }
                });
            });
            // event select district
            $('#city').change(function() {
                let city_id = $(this).val();
                $.ajax({
                    url: '{{ route('districts.loadDistrict') }}',
                    type: "POST",
                    data: {
                        city_id: city_id,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(data) {
                        console.log('success');
                        $('.district').empty();
                        $.each(data, function(index, item) {
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
                        $(".district option:first").attr("disabled", "true").attr("selected",
                            "true");
                    },
                    error: function(data) {
                        console.log('error');
                    },
                });
            });
            // event select ward
            $('.district').change(function() {
                let district_id = $(this).val();
                $.ajax({
                    url: '{{ route('ward.loadWard') }}',
                    type: "POST",
                    data: {
                        district_id: district_id,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(data) {
                        console.log('success');
                        $('#ward').empty();
                        $.each(data, function(index, item) {
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
                        $("#ward option:first").attr("disabled", "true").attr("selected",
                            "true");
                    },
                    error: function(data) {
                        console.log('error');
                    },

                });
            });
        });
    </script>
@endsection
