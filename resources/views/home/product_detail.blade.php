@extends('layout_home.product_detail')
<style>
    .product-detail {
        padding-top: 150px;
    }

    .image-holder img {
        width: 450px;
        height: 400px;
        margin-left: 90px;
    }

    .image-holder {
        border-radius: 5px;
        border: 1px solid lightgrey;
    }

    .secon_img {
        display: flex;
        flex-wrap: wrap;

    }

    .item_img img {
        width: 500px;
        flex: 1 0 23%;
        max-width: 23%;
        margin-left: 7px;
        margin-top: 10px;
        border-radius: 5px;
        border: 1px solid lightgrey;
    }

    .describe {
        margin-top: 20px;
    }

    .btn-buynow, .btn-addtocart {
        height: 76px;
        width: 290px;
        font-size: 20px;
        text-transform: uppercase;
        border-radius: 15px;
        border: 2px solid #131814;
        background-color: white;
    }

    .btn-addtocart:hover {
        color: white;
        background-color: #131814;
    }

    .btn-buynow:hover {
        color: white;
        background-color: #131814;
    }

    #myModal {
        margin-top: -180px;
    }

    .modal-dialog {
        max-width: 500px;
    }

    label {
        margin-top: 10px;
        margin-bottom:10px;
        font-weight: bold;
        font-size: 18px;
    }
    td {
        height:70px;
    }
    tr  {
        border-radius:10px;
    }
    .tskt{
        height: 682px;
        border-radius:10px;
        box-shadow: 0 0 5px;
    }
    .tskt table{
        margin: 10px;
        width: 500px;
    }
    #btn_xemct{
        border: none;
        margin-top: 10px;
        border-radius: 5px;
        width: 500px;
        height:40px;
        margin-left: 10px;
        background-color: white;
        box-shadow: 0 0 5px;
    }
</style>

@section('content')
    <div class="product-detail">
        <hr>
        <div class="breadcrumb">
            <div class="display-header d-flex justify-content-between pb-3">
                <h6 class="display-7 text-uppercase" style="padding-right: 5px;color: #666">Trang chủ</h6>
            </div>
            /
            <div class="display-header d-flex justify-content-between pb-3">
                <h6 class="display-7 text-uppercase" style="padding-left: 5px;padding-right: 5px;color: #666">Sản
                    phẩm</h6>
            </div>
            /
            <div class="display-header d-flex justify-content-between pb-3">
                <h6 class="display-7  text-uppercase"
                    style="padding-left: 5px;padding-right: 5px;color: #666">{{ $brand->name }}</h6>
            </div>
            /
            <div class="display-header d-flex justify-content-between pb-3">
                <h6 class="display-7  text-uppercase"
                    style="padding-left: 5px;padding-right: 5px;color: #666">{{ $category->name }}</h6>
            </div>
            /
            <div class="display-header d-flex justify-content-between pb-3">
                <h6 class="display-7  text-uppercase"
                    style="padding-left: 5px;padding-right: 5px;color: #666">{{ $p->name }}</h6>

            </div>
            <hr>
            <div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="image-holder">
                            <img src="{{asset('storage/'.$p->outsite_image)}}" alt="product-item" class="img-fluid">
                        </div>
                        <div class="secon_img">
                            <div class="item_img">
                                @foreach($p_image as $i)
                                    <img src="{{asset('storage/'.$i->image)}}" alt="product-item" class="img-fluid">
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="float-right">
                            <div class="display-header d-flex justify-content-between pb-3">
                                <h3 class="display-7 text-dark text-uppercase"> {{ $p->name }}</h3>
                            </div>

                            <div>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item"> Bảo Hành : 12 Month</li>
                                    <li class="list-group-item"> CPU : {{$p_detail->cpu }}</li>
                                    <li class="list-group-item"> RAM : {{$p_detail->ram }}GB</li>
                                    <li class="list-group-item"> Ổ cứng : {{$p_detail->ssd }}</li>
                                    <li class="list-group-item"> VGA : {{$p_detail->graphic_card }}</li>
                                    <li class="list-group-item"> Màn hình : {{$p_detail->screen_size }}</li>
                                    <li class="list-group-item"> Pin : {{$p_detail->battery }}</li>
                                    <li class="list-group-item"> Trọng lượng : {{$p_detail->weight }}</li>
                                    <li class="list-group-item"> OS : {{$p_detail->operating_system }}</li>
                                </ul>
                            </div>
                            <span class="item-price ">
                                <br>
                            <h4> @if(isset($p->price))
                                    {{ number_format($p->price, 0, ',', '.') }} VNĐ
                                @else
                                    Sản phẩm chuẩn bị kinh doanh
                                @endif
                            </h4>
                        </span>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="float-left">
                                        @if(isset($p->price))
                                            <a href="">
                                                <button class="btn-buynow">
                                                    Mua ngay
                                                </button>
                                            </a>
                                        @else
                                            <a href="">
                                                <button class="btn-buynow">
                                                    Đặt trước
                                                </button>
                                            </a>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="float-right">
                                        <a href="{{ route('home.addtocart',$p->id) }}">
                                            <button class="btn-addtocart">
                                                Thêm vào giỏ hàng
                                            </button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-7">
                        <div>
                            <div class="display-header d-flex justify-content-between pb-3 mt-2">
                                <h3 class="display-7 text-dark text-uppercase "> Mô tả sản phẩm</h3>
                            </div>
                            <div class="describe">
                                {!! $p_detail->describe !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="float-right">
                            <div>
                               <div class="tskt">
                                   <h4 style="padding-top: 10px;margin-left: 10px"><b>Thông số kỹ thuật</b></h4>
                                   <table class="table table-striped table-centered mb-0 ">
                                       <tr>
                                           <td width="40%">Loại card đồ họa</td>
                                           <td>{{$p_detail->graphic_card }}</td>
                                       </tr>
                                       <tr>
                                           <td width="40%">Loại CPU</td>
                                           <td>{{$p_detail->cpu }}</td>
                                       </tr>
                                       <tr>
                                           <td width="40%">Dung lượng RAM</td>
                                           <td>{{$p_detail->ram }}GB</td>
                                       </tr>
                                       <tr>
                                           <td width="40%">Loại RAM</td>
                                           <td>{{$p_detail->ram_type }}</td>
                                       </tr>
                                       <tr>
                                           <td width="40%">Số khe ram</td>
                                           <td>{{$p_detail->ram_slot }}</td>
                                       </tr>
                                       <tr>
                                           <td width="40%">Ổ cứng</td>
                                           <td>{{$p_detail->ssd }}</td>
                                       </tr>
                                       <tr>
                                           <td width="40%">Màn hình cảm ứng</td>
                                           <td>{{$p_detail->touchscreen }}</td>
                                       </tr>
                                       <tr>
                                           <td width="40%">Chất liệu tấm nền</td>
                                           <td>{{$p_detail->bg_plate }}</td>
                                       </tr>
                                   </table>
                                   <button type="button"   id="btn_xemct" data-toggle="modal" data-target="#myModal">
                                       Xem thông tin chi tiết <i class="uil-down"></i>
                                   </button>
                               </div>

{{--                                modal thông tin chi tiết--}}
                                <div class="container">
                                    <!-- The Modal -->
                                    <div class="modal" id="myModal">
                                        <div class="modal-dialog modal-lg modal-dialog-scrollable">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4> Thông số kỹ thuật</h4>
                                                </div>
                                                <!-- Modal body -->
                                                <div class="modal-body">
                                                    <table class="table table-striped table-centered mb-0 ">
                                                        <label for=""> Vi xử lý & đồ họa</label>
                                                        <tr>
                                                            <td width="40%">Loại card đồ họa</td>
                                                            <td>{{$p_detail->graphic_card }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td width="40%">Loại CPU</td>
                                                            <td>{{$p_detail->cpu }}</td>
                                                        </tr>
                                                    </table>

                                                    <table class="table table-striped table-centered mb-0">
                                                        <label for="" > Ram và Ổ cứng</label>
                                                        <tr>
                                                            <td width="40%">Dung lượng RAM</td>
                                                            <td>{{$p_detail->ram }}GB</td>
                                                        </tr>
                                                        <tr>
                                                            <td width="40%">Loại RAM</td>
                                                            <td>{{$p_detail->ram_type }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td width="40%">Số khe ram</td>
                                                            <td>{{$p_detail->ram_slot }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td width="40%">Ổ cứng</td>
                                                            <td>{{$p_detail->ssd }}</td>
                                                        </tr>
                                                    </table>
                                                    <table class="table table-striped table-centered mb-0">
                                                        <label for=""> Màn hình</label>
                                                        <tr>
                                                            <td width="40%">Màn hình cảm ứng</td>
                                                            <td>{{$p_detail->touchscreen }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td width="40%">Chất liệu tấm nền</td>
                                                            <td>{{$p_detail->bg_plate }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td width="40%">Tần số quét</td>
                                                            <td>{{$p_detail->scan_frequency	 }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td width="40%">Kích thước màn hình</td>
                                                            <td>{{$p_detail->screen_size}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td width="40%">Công nghệ màn hình</td>
                                                            <td>{{$p_detail->screen_tech }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td width="40%">Độ phân giải màn hình</td>
                                                            <td>{{$p_detail->screen_resolution }}</td>
                                                        </tr>
                                                    </table>

                                                    <table class="table table-striped table-centered mb-0">
                                                        <label for=""> Giao tiếp & kết nối</label>
                                                        <tr>
                                                            <td width="40%">Loại đèn bàn phím</td>
                                                            <td>{{$p_detail->keyboard_light }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td width="40%">Webcam</td>
                                                            <td>{{$p_detail->webcam }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td width="40%">Hệ điều hành</td>
                                                            <td>{{$p_detail->operating_system}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td width="40%">Wi-Fi</td>
                                                            <td>{{$p_detail->wifi }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td width="40%">Bluetooth</td>
                                                            <td>{{$p_detail->bluetooth }}</td>
                                                        </tr>
                                                    </table>

                                                    <table class="table table-striped table-centered mb-0">
                                                        <label for=""> Công nghệ âm thanh</label>
                                                        <tr>
                                                            <td width="40%">Loại đèn bàn phím</td>
                                                            <td>{{$p_detail->audio_tech }}</td>
                                                        </tr>
                                                    </table>

                                                    <table class="table table-striped table-centered mb-0">
                                                        <label for=""> Thông số khác </label>
                                                        <tr>
                                                            <td width="40%">Bảo mật</td>
                                                            <td>{{$p_detail->security }}</td>
                                                        </tr>
                                                    </table>

                                                    <table class="table table-striped table-centered mb-0">
                                                        <label for=""> Pin & công nghệ sạc </label>
                                                        <tr>
                                                            <td width="40%">Pin</td>
                                                            <td>{{$p_detail->battery }}</td>
                                                        </tr>
                                                    </table>

                                                    <table class="table table-striped table-centered mb-0">
                                                        <label for=""> Thiết kế & Trọng lượng </label>
                                                        <tr>
                                                            <td width="40%">Màu sắc</td>
                                                            <td>{{$p_detail->color }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td width="40%">Chất liệu</td>
                                                            <td>{{$p_detail->material }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td width="40%">Kích thước</td>
                                                            <td>{{$p_detail->dimension }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td width="40%">Trọng lượng</td>
                                                            <td>{{$p_detail->weight }}</td>
                                                        </tr>
                                                    </table>

                                                    <table class="table table-striped table-centered mb-0">
                                                        <label for=""> Thông số kỹ thuật </label>
                                                        <tr>
                                                            <td width="40%">Cổng giao tiếp</td>
                                                            <td>{{$p_detail->connectivity }}</td>
                                                        </tr>
                                                    </table>

                                                </div>

                                                <!-- Modal footer -->
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">
                                                        Close
                                                    </button>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
@endsection


