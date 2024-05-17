<style>
</style>
<div class="left-side-menu">
    <!-- LOGO -->
    <div class="logo">
        <a href="" class="logo text-center logo-light">
            <span class="logo-lg">
                <img src="{{ asset('image/logo.png') }}" style="width: 200px; height:130px;">
            </span>
            <span class="logo-sm">
                <img src="{{ asset('image/logo.png') }}" style="width: 50px; height:50px;">
            </span>
        </a>
    </div>

    <!-- LOGO -->
    <div class="mt-3">

    </div>
    <div class="h-100" id="left-side-menu-container " data-simplebar>
        <ul class="metismenu side-nav">

            <li class="side-nav-title side-nav-item"></li>

            <li class="side-nav-item">

            </li>
            {{-- account --}}
            @if (session()->get('role_id') === 1)
                <li class="side-nav-item">
                    <a href="javascript: void(0);" class="side-nav-link">
                        <i class=" uil-user-circle"></i>
                        <span> Tài Khoản </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="side-nav-second-level" aria-expanded="false">
                        <li>
                            <a href="{{ route('admin.index') }}"><i class=" uil-user mr-1"></i>Quản trị viên</a>
                        </li>
                        <li>
                            <a href="{{ route('staff.index') }}"><i class="  uil-users-alt mr-1"></i>Nhân viên</a>
                        </li>
                        <li>
                            <a href="{{ route('customer.index') }}"><i class="  uil-users-alt mr-1"></i>Khách hàng</a>
                        </li>
                    </ul>
                </li>
            @endif
            {{-- product --}}
            <li class="side-nav-item">
                <a href="{{ route('product.index') }}" class="side-nav-link">
                    <i class=" uil-laptop"></i>
                    <span> Sản Phẩm </span>
                </a>
            </li>
            {{-- Supplier --}}
            <li class="side-nav-item">
                <a href="{{ route('supplier.index') }}" class="side-nav-link">
                    <i class="uil-truck"></i>
                    <span> Nhà Cung Cấp </span>
                </a>
            </li>
            {{-- address --}}
            <li class="side-nav-item">
                <a href="javascript: void(0);" class="side-nav-link">
                    <i class=" uil-map-marker"></i>
                    <span> Địa chỉ </span>
                    <span class="menu-arrow"></span>
                </a>
                <ul class="side-nav-second-level" aria-expanded="false">
                    <li>
                        <a href="{{ route('ward.index') }}"><i class=" uil-user mr-1"></i>Xã</a>
                    </li>
                    <li>
                        <a href="{{ route('districts.index') }}"><i class="  uil-users-alt mr-1"></i>Huyện </a>
                    </li>
                    <li>
                        <a href="{{ route('cities.index') }}"><i class="  uil-users-alt mr-1"></i>Tỉnh Thành Phố</a>
                    </li>
                </ul>
            </li>
            {{-- Warehouse --}}
            <li class="side-nav-item">
                <a href="{{ route('warehouse.index') }}" class="side-nav-link">
                    <i class="  uil-building"></i>
                    <span> Kho Hàng </span>
                </a>
            </li>
            <li class="side-nav-item">
                <a href="{{ route('order.index') }}" class="side-nav-link">
                    <i class="  uil-bill"></i>
                    <span> Hóa đơn </span>
                </a>
            </li>

            <li class="side-nav-item">
                <a href="{{ route('category.index') }}" class="side-nav-link">
                    <i class="  uil-building"></i>
                    <span> Danh Mục </span>
                </a>
            </li>
            <li class="side-nav-item">
                <a href="{{ route('roles.index') }}" class="side-nav-link">
                    <i class="  uil-building"></i>
                    <span> Vai trò </span>
                </a>
            </li>
        </ul>
        <div class="clearfix"></div>
    </div>
</div>
