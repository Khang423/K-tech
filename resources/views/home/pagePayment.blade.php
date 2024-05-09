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
        color: darkgrey;
    }

    #title_right {
        margin-left: 50px;
        margin-bottom: -10px;

    }

    #line_title_left {
        border-bottom: 3px solid darkgrey;
        margin-left: 30px;
    }

    #line_title_right {

        border-bottom: 3px solid;
        margin-left: 15px;

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

    #name {
        margin-bottom: 10px;
    }

    .row {
        margin-bottom: 20px;
    }
</style>
@section('content')
    <div class="list_product">
        <div class="row">
            <div class="col-md-5" id="line_title_left">
                <div class="display-header d-flex justify-content-between pb-3">
                    <h4 id="title_left" class="display-7 text-uppercase">1. Thông tin </h4>
                </div>
            </div>
            <div class="col-md-1    "></div>
            <div class="col-md-5" id="line_title_right">
                <div class="display-header d-flex justify-content-between pb-3">
                    <h4 id="title_right" class="display-7 text-uppercase">2. Thanh toán</h4>
                </div>
            </div>
        </div>
        <div class="info_customer">
            <div class="row">
                <div class="col-md-6" id="name">
                    <br>
                    <div class="if_name" style="font-size: 18px">
                        Số lượng sản phẩm
                    </div>
                </div>
                <div class="col-md-3"></div>
                <div class="col-md-3" id="name">
                    <br>
                    <div class="if_name" style="font-size: 18px">
                        {{$sum_quantity}}
                    </div>
                </div>

                <div class="col-md-6" id="name">
                    <div class="if_name" style="font-size: 18px">
                        Tiền hàng (tạm tính)
                    </div>
                </div>
                <div class="col-md-3"></div>
                <div class="col-md-3" id="name">
                    <div class="if_name" style="font-size: 18px">
                        @php
                            $notional_price = 0;
                            foreach ($order_detail as $i){
                                $notional_price += $i->quantity*$i->price;
                            }
                            $vat_rate = 5;
                            $vat_inclusive_price = $notional_price * (1 + $vat_rate / 100);
                            $vat_amount = $vat_inclusive_price - $notional_price;
                        @endphp
                        {{ number_format($notional_price, 0, ',', '.') }}<u>đ</u>
                    </div>
                </div>

                <div class="col-md-6" id="name">
                    <div class="if_name" style="font-size: 18px">
                        Phí vận chuyển
                    </div>
                </div>
                <div class="col-md-3"></div>
                <div class="col-md-3" id="name">
                    <div class="if_name" style="font-size: 18px">
                        Miễn phí
                    </div>
                </div>
                <hr style="width: 90%;margin-left: 35px">

                <div class="col-md-6" id="name">
                    <div class="if_name" style="font-size: 18px">
                        Tổng tiền (đã gồm VAT)
                    </div>
                </div>
                <div class="col-md-3"></div>
                <div class="col-md-3" id="name">
                    <div class="if_name" style="font-size: 18px">
                        @php
                            $notional_price = 0;
                            foreach ($order_detail as $i){
                                $notional_price += $i->quantity*$i->price;
                            }
                            $vat_rate = 5;
                            $vat_inclusive_price = $notional_price * (1 + $vat_rate / 100);
                            $vat_amount = $vat_inclusive_price - $notional_price;
                        @endphp
                        {{ number_format($vat_inclusive_price, 0, ',', '.') }}<u>đ</u>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function () {
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
        });
    </script>
@endsection
