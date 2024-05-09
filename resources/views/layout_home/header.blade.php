<style>
    .modal {
        display: none; /* Ẩn modal ban đầu */
        position: fixed;
        top: 25%;
    }

    .header {
        border-bottom: 1px solid black;
    }

    .nav-item a {
        font-size: 20px;
    }
</style>
<header id="header" class="site-header header-scrolled position-fixed text-black bg-light">
    <nav id="header-nav" class="navbar navbar-expand-lg px-3 mb-3">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('home.index') }}">
                <img src="{{ asset('template/images/main-logo.png') }}" class="logo"
                     style="height: 90px;margin-left:35%">
            </a>
            <button class="navbar-toggler d-flex d-lg-none order-3 p-2" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#bdNavbar" aria-controls="bdNavbar" aria-expanded="false"
                    aria-label="Toggle navigation">
                <svg class="navbar-icon">
                    <use xlink:href="#navbar-icon"></use>
                </svg>
            </button>
            <div class="offcanvas offcanvas-end" tabindex="-1" id="bdNavbar" aria-labelledby="bdNavbarOffcanvasLabel">
                <div class="offcanvas-header px-4 pb-0">
                    <a class="navbar-brand" href="index.html">
                        <img src="images/main-logo.png" class="logo">
                    </a>
                    <button type="button" class="btn-close btn-close-black" data-bs-dismiss="offcanvas"
                            aria-label="Close" data-bs-target="#bdNavbar"></button>
                </div>
                <div class="offcanvas-body">
                    <ul id="navbar"
                        class="navbar-nav text-uppercase justify-content-end align-items-center flex-grow-1 pe-3">
                        <li class="nav-item">
                            <a class="nav-link me-4 active" href="{{ route('home.index') }}">Trang chủ</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link me-4" href="#laptop-products">Sản phẩm</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link me-4" href="#yearly-sale">Sale</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link me-4" href="#latest-blog">Blog</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link me-4 dropdown-toggle link-dark" data-bs-toggle="dropdown" href="#"
                               role="button" aria-expanded="false">Pages</a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="about.html" class="dropdown-item">About</a>
                                </li>
                                <li>
                                    <a href="blog.html" class="dropdown-item">Blog</a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <div class="user-items ps-5">
                                <ul class="d-flex justify-content-end list-unstyled">
                                    <li class="pe-3" id="i-user">
                                        <a>
                                            <svg class="user">>
                                                <span>
                                                    @if(session()->has('name'))
                                                        <li class="nav-item dropdown">
                                                            <a class="nav-link me-4  link-dark" data-bs-toggle="dropdown" role="button" aria-expanded="false">
                                                                {{ session()->get('name') }}
                                                            </a>
                                                            <ul class="dropdown-menu">
                                                                <li>
                                                                    <a href="{{ route('home.logout') }}" class="dropdown-item">Đăng xuất</a>
                                                                </li>
                                                            </ul>
                                                        </li>
                                                        @else
                                                        <li class="nav-item dropdown">
                                                            <a class="nav-link me-4  link-dark" data-bs-toggle="dropdown" role="button" aria-expanded="false">
                                                                 <i class="uil-user"></i>
                                                            </a>
                                                            <ul class="dropdown-menu">
                                                                <li>
                                                                    <a href="{{ route('home.login') }}" class="dropdown-item">Đăng nhập</a>
                                                                </li>
                                                            </ul>
                                                        </li>

                                                        @endif
                                                </span>
                                            </svg>
                                        </a>
                                    </li>
                                    <li>
                                        {{--                                        @if(session()->has('id'))--}}
                                        <a>
                                            <svg class="cart">
                                                <li class="nav-item dropdown">
                                                    <a class="nav-link me-4  link-dark" href="{{ route('home.cart') }}"  role="button" aria-expanded="false">
                                                        <i class="uil-cart"></i>
                                                    </a>
                                                </li>
                                            </svg>
                                        </a>
                                        {{--                                        @endif--}}
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</header>

