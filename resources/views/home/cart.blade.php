@extends('layout_home.product_detail')
<style>
    .list_product {
        padding-top: 150px;
    }

    .table-centered {
        margin: 0 auto; /* Center horizontally */
        text-align: center; /* Center text within cells */
    }
    .notional-price{
        float: right;
    }
    .btn_buy button{
        margin-top: 10px;
        height:50px;
        width:230px;
        font-size: 20px;
        border: 2px solid #131814;
        background-color: white;
        border-radius: 10px;
    }
    .btn_buy button:hover{
        color:white;
        background-color: #131814;
    }
</style>
@section('content')
    <div class="list_product">
        <div class="display-header d-flex justify-content-between pb-3">
            <h3 class="display-7 text-dark text-uppercase"> Giỏ hàng của tôi</h3>
        </div>
        <hr>
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
                @foreach($order_detail as $i)
                    <tr>
                        <td>{{ $tmp++  }}</td>
                        <td>{{ $i->product_name}}</td>
                        <td>
                            <img src="{{asset('storage/'.$i->image)}}" width="100">
                        </td>
                        <td>
                            <a href="{{ route('home.downcart',$i->product_id) }}"><i class="uil-arrow-down" style="margin-right:5px;font-size: 20px"></i></a>
                            {{ $i->quantity }}
                            <a href="{{ route('home.upcart',$i->product_id) }}"><i class="uil-arrow-up" style="margin-left:5px;font-size: 20px"></i></a>
                        </td>
                        <td>{{ number_format($i->price, 0, ',', '.') }}<u>đ</u></td>
                        <td>{{ number_format($i->price* $i->quantity, 0, ',', '.') }}<u>đ</u></td>
                        <td>
                            <a href="{{ route('home.destroy', $i->product_id) }}" class="btn btn-danger" id="btn-delete">
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
{{--            handle notional price--}}
            @php
            $notional_price = 0;
            foreach ($order_detail as $i){
                $notional_price += $i->quantity*$i->price;
            }
            @endphp
            <div>
                <h4 class="display-7 text-dark ">
                    {{ number_format($notional_price, 0, ',', '.') }}<u>đ</u>
                </h4>
            </div>
            <div>
                <a href="{{ route('home.order') }}" class="btn_buy">
                   <button>
                      Mua ngay
                   </button>
                </a>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            // handle event delete button
            $(document).on('click','#btn-delete',function(){
                let form = $(this).parents('form');
                $.ajax({
                    url: form.attr('action'),
                    type: 'POST',
                    dataType: 'json',
                    data: form.serialize(),
                    success: function() {
                        console.log("success");
                        table.draw();
                    },
                    error: function() {
                        console.log("error");
                    }
                });
            });
        });
    </script>
@endsection
