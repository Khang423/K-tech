@extends('layout_home.product_detail')
<style>
    .list_product {
        padding-top: 150px;
        width: 700px;
        margin: auto;
    }

    .product {
        margin-bottom: 10px;
        border-radius: 10px;
        box-shadow: 0 0 2px;
    }

    .product_img {
        margin-left: 50px;
    }

    .product_name {
        padding-top: 10px;
        font-size: 16px;
        font-family: Arial, Baskerville, monospace;
    }

    .product_quantity {
        margin-top: 40px;
        margin-left: 30px;
        font-family: Arial, Baskerville, monospace;
    }

    .product_price {
        font-family: Arial, Baskerville, monospace;
        font-size: 16px;
    }

    .continue {
        margin-bottom: auto;
    }

    input {
        outline: none;
        border: none;
        border-bottom: 1px solid lightgrey;
        width: 90%;
    }

    .info_customer {
        box-shadow: 0 0 2px;
        border-radius: 10px;
    }

    .info_receive {
        box-shadow: 0 0 2px;
        border-radius: 10px
    }

    #name label {
        margin-left: 20px;
        margin-top: 20px;
    }

    #name input {
        padding-left: 15px;
        margin-left: 20px;
        margin-bottom: 20px;
    }

    #address label {
        margin-left: 20px;
    }

    #address input {
        padding-left: 15px;
        margin-left: 20px;
        margin-top: 14px;
    }

    #address select {
        width: 90%;
        margin-left: 20px;
        margin-bottom: 20px;
    }

    #title_left {
        margin-left: 60px;
        margin-bottom: -10px;
    }

    #title_right {
        margin-left: 50px;
        margin-bottom: -10px;
        color: darkgrey;
    }

    #line_title_left {
        border-bottom: 3px solid;
        margin-left: 15px;
    }

    #line_title_right {
        border-bottom: 3px solid darkgrey;
        margin-left: 30px;

    }

    .if_name {
        font-size: 16px;
        margin-left: 20px;
    }

    .if_email {
        font-size: 16px;
        margin-left: 20px;
        margin-bottom: 20px;
    }

    #div_continue {}

    #btn-continue button {
        margin-top: 10px;
        height: 40px;
        width: 100%;
        border: none;
        border-radius: 5px;
        color: white;
        background-color: #212529;
    }

    #btn-continue button:hover {
        background-color: #353b42;
    }

    #div_continue {
        margin-top: 20px;
    }
</style>
@section('content')
    <div class="list_product">
        <div class="row">
            <div class="col-md-5" id="line_title_left">
                <div class="display-header d-flex justify-content-between pb-3">
                    <h4 id="title_left" class="display-7 text-dark text-uppercase">1. Thông tin </h4>
                </div>
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-5" id="line_title_right">
                <div class="display-header d-flex justify-content-between pb-3">
                    <h4 id="title_right" class="display-7 text-uppercase">2. Thanh toán</h4>
                </div>
            </div>
        </div>
        <hr>
        @foreach ($order_detail as $i)
            <div class="product">
                <div class="row">
                    <div class="col-md-3">
                        <div class="product_img">
                            <img src="{{ asset('storage/' . $i->image) }}" width="100">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="product_name">
                            {{ $i->product_name }}
                        </div>
                        <div class="product_price">
                            {{ number_format($i->price, 0, ',', '.') }}<u>đ</u>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="product_quantity">
                            Số lượng : {{ $i->quantity }}
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        <h5 class="text-uppercase" style="padding-bottom: 10px;padding-top: 30px;"> Thông tin khách hàng</h5>
        <div class="info_customer">
            <div class="row">
                <div class="col-md-6" id="name">
                    <label for="">Tên Khách Hàng</label>
                    <br>
                    <div class="if_name">
                        {{ $customer->name }}
                    </div>
                </div>
                <div class="col-md-6" id="name">
                    <label for="">Sđt Khách Hàng</label>
                    <br>
                    <div class="if_name">
                        {{ $customer->phone }}
                    </div>
                </div>
                <div class="col-md-6" id="name">
                    <label for="">Email</label>
                    <br>
                    <div class="if_email">
                        {{ $customer->email }}
                    </div>
                </div>
            </div>
        </div>
        <h5 class="text-uppercase" style="padding-bottom: 10px;padding-top: 30px;"> Thông tin người nhận</h5>
        <form action=" {{ route('order.store') }}" method="POST">
            @csrf
            <div class="info_receive">
                <div class="row">
                    <div class="col-md-6" id="name">
                        <label for="">Tên Người Nhận</label>
                        <br>
                        <input type="text" name="receive_name" value=" {{ $customer->name }}">
                    </div>
                    <div class="col-md-6" id="name">
                        <label for="">Sđt người nhận</label>
                        <br>
                        <input type="text" name="receive_phone" value=" {{ $customer->phone }}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group" id="address">
                            <label> Tỉnh Thành Phố</label>
                            <select name="city_id" class="form-control select2" data-toggle="select2" id="city"
                                required>
                                <option  selected hidden value="{{ $customer->city_id }}">
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
                            <select name="district_id" class="district form-control select2" data-toggle="select2" required>
                                <option  selected hidden value="{{ $customer->district_id }}">
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
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group" id="address">
                            <label> Xã Phường</label>
                            <select name="wards_id" class="form-control select2" data-toggle="select2" id="ward"
                                required>
                                <option selected value="{{ $customer->wards_id }}">
                                    @if ($customer->wards_id)
                                        {{ $customer->ward->name }}
                                    @else
                                        --Quận/Huyện--
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group" id="address">
                            <label>Địa chỉ</label>
                            <input type="text" name="address" value="{{ $customer->address }}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="continue">
                <div class="row" id="div_continue">
                    <div class="col-md-5">
                        <h4 class="display-7 text-dark "> Tổng tiền tạm tính :</h4>
                    </div>
                    <div class="col-md-4"></div>
                    <div class="col-md-3" id="total-price">
                        <h4 class="text-dark">
                            @php
                                $notional_price = 0;
                                foreach ($order_detail as $i) {
                                    $notional_price += $i->quantity * $i->price;
                                }
                            @endphp
                            {{ number_format($notional_price, 0, ',', '.') }}<u>đ</u>
                        </h4>
                    </div>
                    <input type="hidden" name="total_price" value="{{ $notional_price }}">
                    <div id="btn-continue">
                        <a>
                            <button id="btn-create" type="button">
                                Đặt hàng
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
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
            //event handle order
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
                        location.href = "{{ route('home.index') }}";
                    },
                    error: function(data) {
                        console.log(data);
                    }
                });
            });
        });
    </script>
@endsection
