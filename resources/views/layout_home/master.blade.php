<!DOCTYPE html>
<html>
<head>
    <title>K-Tech</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="format-detection" content="telephone=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="author" content="">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <link rel="stylesheet" type="text/css" href="{{ asset('template/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('template/style.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Jost:wght@300;400;500&family=Lato:wght@300;400;700&display=swap"
        rel="stylesheet">
    <script src="{{ asset('template/js/modernizr.js')}}"></script>
    <link href="{{ asset('css/icons.min.css') }}" rel="stylesheet" type="text/css"/>
    <style>
        .body {
            width: 1519px;
        }

        #list-product {
            display: flex;
            flex-wrap: wrap;
        }

        .iproduct {
            flex: 1 0 21%; /* Phần tử con chiếm 25% của không gian và có kích thước ban đầu 25% */
            max-width: 21%; /* Giới hạn kích thước tối đa của mỗi phần tử con */
            box-sizing: border-box;
            transition: box-shadow 0.3s ease;
            height: 450px;
        }

        .iproduct:hover {
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.6);
        }

        .card-title {
            max-width: 225px;
            margin-left: 20px;
        }

        .item-price {
            margin-left: 20px;
        }

        #product-swiper {
            width: 1519px;
        }
        .empty{
            height:100px;
        }
    </style>
</head>
<body data-bs-spy="scroll" data-bs-target="#navbar" data-bs-root-margin="0px 0px -40%" data-bs-smooth-scroll="true"
      tabindex="0">

@include('layout_home.header')

<section id="laptop-products" class="product-store position-relative padding-large no-padding-top">
    <div class="container">
        @yield('content')
    </div>
    <div class="swiper-pagination position-absolute text-center"></div>
</section>
<div class="empty"></div>
@include('layout_home.footer')
<script src="{{ asset('template/js/jquery-1.11.0.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
<script type="text/javascript" src="{{ asset('template/js/bootstrap.bundle.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('template/js/plugins.js') }}"></script>
<script type="text/javascript" src="{{ asset('template/js/script.js') }}"></script>
</body>
</html>
