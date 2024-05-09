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
{{--account--}}
            <li class="side-nav-item">
                <a href="javascript: void(0);" class="side-nav-link">
                    <i class=" uil-user-circle"></i>
                    <span> Account </span>
                    <span class="menu-arrow"></span>
                </a>
                <ul class="side-nav-second-level" aria-expanded="false">
                    <li>
                        <a href="{{ route('admin.index') }}"><i class=" uil-user mr-1"></i>Admin</a>
                    </li>
                    <li>
                        <a href="{{ route('staff.index') }}"><i class="  uil-users-alt mr-1"></i>Staff</a>
                    </li>
                    <li>
                        <a href="{{ route('customer.index') }}"><i class="  uil-users-alt mr-1"></i>Customer</a>
                    </li>
                </ul>
            </li>
{{--product--}}
            <li class="side-nav-item">
                <a href="{{ route('product.index') }}" class="side-nav-link">
                    <i class=" uil-laptop"></i>
                    <span> Product </span>
                </a>
            </li>
{{--Supplier--}}
            <li class="side-nav-item">
                <a href="{{ route('supplier.index') }}" class="side-nav-link">
                    <i class="uil-truck"></i>
                    <span> Supplier </span>
                </a>
            </li>
{{--address--}}
            <li class="side-nav-item">
                <a href="javascript: void(0);" class="side-nav-link">
                    <i class=" uil-map-marker"></i>
                    <span> Address </span>
                    <span class="menu-arrow"></span>
                </a>
                <ul class="side-nav-second-level" aria-expanded="false">
                    <li>
                        <a href="{{ route('ward.index') }}"><i class=" uil-user mr-1"></i>Ward</a>
                    </li>
                    <li>
                        <a href="{{ route('districts.index') }}"><i class="  uil-users-alt mr-1"></i>District</a>
                    </li>
                    <li>
                        <a href="{{ route('cities.index') }}"><i class="  uil-users-alt mr-1"></i>City</a>
                    </li>
                </ul>
            </li>
{{--Warehouse--}}
            <li class="side-nav-item">
                <a href="{{ route('warehouse.index') }}" class="side-nav-link">
                    <i class="  uil-building"></i>
                    <span> Warehouse </span>
                </a>
            </li>

            <li class="side-nav-item">
                <a href="{{ route('category.index') }}" class="side-nav-link">
                    <i class="  uil-building"></i>
                    <span> Category </span>
                </a>
            </li>

            <li class="side-nav-item">
                <a href="javascript: void(0);" class="side-nav-link">
                    <i class="uil-envelope"></i>
                    <span> Email </span>
                    <span class="menu-arrow"></span>
                </a>
                <ul class="side-nav-second-level" aria-expanded="false">
                    <li>
                        <a href="apps-email-inbox.html">Inbox</a>
                    </li>
                    <li>
                        <a href="apps-email-read.html">Read Email</a>
                    </li>
                </ul>
            </li>

            <li class="side-nav-item">
                <a href="javascript: void(0);" class="side-nav-link">
                    <i class="uil-briefcase"></i>
                    <span> Projects </span>
                    <span class="menu-arrow"></span>
                </a>
                <ul class="side-nav-second-level" aria-expanded="false">
                    <li>
                        <a href="apps-projects-list.html">List</a>
                    </li>
                    <li>
                        <a href="apps-projects-details.html">Details</a>
                    </li>
                    <li>
                        <a href="apps-projects-gantt.html">Gantt <span
                                class="badge badge-pill badge-light-lighten font-10 float-right">New</span></a>
                    </li>
                    <li>
                        <a href="apps-projects-add.html">Create Project <span
                                class="badge badge-pill badge-success-lighten font-10 float-right">New</span></a>
                    </li>
                </ul>
            </li>

            <li class="side-nav-item">
                <a href="apps-social-feed.html" class="side-nav-link">
                    <i class="uil-rss"></i>
                    <span> Social Feed </span>
                </a>
            </li>

            <li class="side-nav-item">
                <a href="javascript: void(0);" class="side-nav-link">
                    <i class="uil-clipboard-alt"></i>
                    <span> Tasks </span>
                    <span class="menu-arrow"></span>
                </a>
                <ul class="side-nav-second-level" aria-expanded="false">
                    <li>
                        <a href="apps-tasks.html">List</a>
                    </li>
                    <li>
                        <a href="apps-tasks-details.html">Details</a>
                    </li>
                    <li>
                        <a href="apps-kanban.html">Kanban Board</a>
                    </li>
                </ul>
            </li>
        </ul>
        <div class="clearfix"></div>
    </div>
</div>
