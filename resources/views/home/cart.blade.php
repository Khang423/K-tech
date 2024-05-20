@extends('layout_home.product_detail')
<style>
    .list_product {
        padding-top: 150px;
    }

    .table-centered {
        margin: 0 auto;
        /* Center horizontally */
        text-align: center;
        /* Center text within cells */
    }

    .notional-price {
        float: right;
    }

    .btn_buy button {
        margin-top: 10px;
        height: 50px;
        width: 230px;
        font-size: 20px;
        border: 2px solid #131814;
        background-color: white;
        border-radius: 10px;
    }

    .btn_buy button:hover {
        color: white;
        background-color: #131814;
    }
    th, td {
        border: 1px solid #000;
        text-align: center; /* Horizontal centering */
        vertical-align: middle; /* Vertical centering */
    }
    #btn_up:hover{
        width: 20px;
        height: 18px;
        border-radius: 10px;
        background: black;
        color: white
    }
    #btn_down:hover{
        width: 10px;
        height: 18px;
        border-radius: 10px;
        background: black;
        color: white
    }
</style>
@section('content')
    <div class="list_product">

        <div class="display-header d-flex justify-content-between pb-3">
            <h3 class="display-7 text-dark text-uppercase"> Giỏ hàng của tôi</h3>
        </div>
        <div class="">
            <table class="table table-hover table-centered" style="width: 100%">
                <thead>
                    <tr>
                        <th>SST</th>
                        <th>Tên sản phẩm</th>
                        <th>Ảnh </th>
                        <th>Số lượng</th>
                        <th>Giá</th>
                        <th>Thành tiền</th>
                        <th></th>
                    </tr>
                    @php
                        $tmp = 1;
                    @endphp
                    @foreach ($order_detail as $i)
                        <tr>
                            <td>{{ $tmp++ }}</td>
                            <td>{{ $i->product_name }}</td>
                            <td>
                                <img src="{{ asset('storage/' . $i->image) }}" width="100">
                            </td>
                            <td>
                                <a data-up="{{ $i->product_id }}" id="btn_down">
                                    <i class="uil-arrow-down" style="margin-right:5px;font-size: 20px" ></i>
                                </a>
                                {{ $i->quantity }}
                                <a data-up="{{ $i->product_id }}" id="btn_up">
                                    <i class="uil-arrow-up" style="margin-left:5px;font-size: 20px" ></i>
                                </a>
                            </td>
                            <td>{{ number_format($i->price, 0, ',', '.') }}<u>đ</u></td>
                            <td>{{ number_format($i->price * $i->quantity, 0, ',', '.') }}<u>đ</u></td>
                            <td>
                                <a data-id ="{{ $i->product_id }}" class="btn btn-danger" id="btn-delete">
                                    <i class="uil-trash"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </thead>
            </table>
        </div>
        <br>
        <div class="notional-price">
            <div class="display-header d-flex justify-content-between pb-3">
                <h3 class="display-7 text-dark text-uppercase">Tổng tiền</h3>
            </div>
            {{--            handle notional price --}}
            @php
                $notional_price = 0;
                foreach ($order_detail as $i) {
                    $notional_price += $i->quantity * $i->price;
                }
            @endphp
            <div>
                <h4 class="display-7 text-dark ">
                    {{ number_format($notional_price, 0, ',', '.') }}<u>đ</u>
                </h4>
            </div>
            <div>
                <a href="{{ route('home.order') }}" class="btn_buy" data-order-id="{{ $order->id }}">
                    <button>
                        Mua ngay
                    </button>
                </a>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <div>
        @if (session('error'))
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Thông báo',
                    text: '{{ session('error') }}'
                });
            </script>
        @endif
    </div>
    <script>
        $(document).ready(function() {
            $(document).on('click', '#btn-delete', function() {
                var product_id = $(this).data('id');
                $.ajax({
                    url: '{{ route('cart.destroy') }}',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        id: product_id,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function() {
                        console.log("success");
                        location.reload();
                    },
                    error: function() {
                        console.log("error");
                    }
                });
            });

            $(document).on('click', '#btn_up', function() {
                var product_id = $(this).data('up');
                $.ajax({
                    url: '{{ route('cart.up') }}',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        id: product_id,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function() {
                        console.log("success");
                        location.reload();
                    },
                    error: function() {
                        console.log("error");
                    }
                });
            });
            $(document).on('click', '#btn_down', function() {
                var product_id = $(this).data('up');
                $.ajax({
                    url: '{{ route('cart.down') }}',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        id: product_id,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function() {
                        console.log("success");
                        location.reload();
                    },
                    error: function() {
                        console.log("error");
                    }
                });
            });
        });
    </script>
@endpush
