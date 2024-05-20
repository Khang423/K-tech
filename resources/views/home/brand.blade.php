@extends('layout_home.product_detail')


@section('content')
    <div class="row">
        <div class="display-header d-flex justify-content-between pb-3">
            <h2 class="display-7 text-dark text-uppercase"> Sản phẩm</h2>
        </div>
        <div class="swiper product-swiper" id="product-swiper">
            <div class="swiper-wrapper" id="list-product">
                @foreach ($p as $i)
                    <a href="{{ route('home.product_detail', $i->id) }}">
                        <div class="iproduct  swiper-slide m-4">
                            <div class="product-card  position-relative">
                                <div class="image-holder">
                                    <img src="{{ asset('storage/' . $i->outsite_image) }}" alt="product-item"
                                         class="img-fluid">
                                </div>
                                <div class="cart-concern position-absolute">
                                    <div class="cart-button d-flex">
                                        <a data-id="{{ $i->id }}" class="btn btn-medium btn-black"
                                           id="btn-addtocart">
                                            Thêm vào giỏ hàng
                                        </a>
                                    </div>
                                </div>
                                <div class="card-detail justify-content-between align-items-baseline pt-3">
                                    <h6 class="card-title text-uppercase">
                                        <a href="#">{{ $i->name }}</a>
                                    </h6>
                                    <span class="item-price text-primary">
                                        @if (isset($i->price))
                                            {{ number_format($i->price, 0, ',', '.') }}<u>đ</u>
                                        @else
                                            Hàng sắp về
                                        @endif
                                    </span>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        $(document).ready(function() {
            $(document).on('click', '#btn-addtocart', function() {
                event.preventDefault();
                let product_id = $(this).data('id');
                $.ajax({
                    url: '{{ route('cart.addtocart') }}',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        id: product_id,
                        _token: '{{ csrf_token() }}',
                    },
                    success: function(data) {
                        console.log("success");
                        Swal.fire({
                            position: "top-end",
                            icon: "success",
                            title: "Thêm vào giỏ hàng thành công",
                            showConfirmButton: false,
                            timer: 2000
                        });
                    },
                    error: function(data) {
                        console.log(data);
                    }
                });
            });
        });
    </script>
@endpush
