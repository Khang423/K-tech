<div class="navbar-custom">
    <ul class="list-unstyled topbar-right-menu float-right mb-0">


        <li class="notification-list">
            <a class="nav-link right-bar-toggle" href="javascript: void(0);">
                <i class="dripicons-gear noti-icon"></i>
            </a>
        </li>

        <li class="dropdown notification-list">
            <a class="nav-link dropdown-toggle nav-user arrow-none mr-0" data-toggle="dropdown" href="#" role="button"
               aria-haspopup="false"
               aria-expanded="false">
                     <span class="account-user-avatar">
                                            <img src="{{ asset('storage/'.session()->get('admin_avatar'))}}
                                   " alt="user-image" class="rounded-circle">
                                        </span>

                <span>
                                        <span class="account-user-name">@if(session()->has('admin_name'))
                                                {{ session('admin_name') }}
                                            @endif</span>
                                        <span class="account-position">@if(session()->has('role_name'))
                                                {{ session('role_name') }}
                                            @endif</span>
                                    </span>
            </a>
            <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated topbar-dropdown-menu profile-dropdown">
                <!-- item-->
                <div class=" dropdown-header noti-title">
                    <h6 class="text-overflow m-0">Welcome !</h6>
                </div>

                <!-- item-->
                <a href="javascript:void(0);" class="dropdown-item notify-item">
                    <i class="mdi mdi-account-circle mr-1"></i>
                    <span>My Account</span>
                </a>
                <!-- item-->
                <a href="javascript:void(0);" class="dropdown-item notify-item">
                    <i class="mdi mdi-key mr-1"></i>
                    <span>Forgot Password</span>
                </a>

                <!-- item-->
                <a href="{{ route('logout') }}" class="dropdown-item notify-item">
                    <i class="mdi mdi-logout mr-1"></i>
                    <span>Logout</span>
                </a>

            </div>
        </li>

    </ul>
    <button class="button-menu-mobile open-left disable-btn">
        <i class="mdi mdi-menu" m></i>
    </button>
    <div class="app-search dropdown d-none d-lg-block">
        <h4 class="page-title" style="margin-top:25px;margin-left:25px">{{ $title }}</h4>
        <div class="dropdown-menu dropdown-menu-animated dropdown-lg" id="search-dropdown">
            <!-- item-->
            <div class="dropdown-header noti-title">
                <h5 class="text-overflow mb-2">Found <span class="text-danger">17</span> results</h5>
            </div>

            <!-- item-->
            <a href="javascript:void(0);" class="dropdown-item notify-item">
                <i class="uil-notes font-16 mr-1"></i>
                <span>Analytics Report</span>
            </a>

            <!-- item-->
            <a href="javascript:void(0);" class="dropdown-item notify-item">
                <i class="uil-life-ring font-16 mr-1"></i>
                <span>How can I help you?</span>
            </a>

            <!-- item-->
            <a href="javascript:void(0);" class="dropdown-item notify-item">
                <i class="uil-cog font-16 mr-1"></i>
                <span>User profile settings</span>
            </a>

            <!-- item-->
            <div class="dropdown-header noti-title">
                <h6 class="text-overflow mb-2 text-uppercase">Users</h6>
            </div>

            <div class="notification-list">
                <!-- item-->
                <a href="javascript:void(0);" class="dropdown-item notify-item">
                    <div class="media">
                        <img class="d-flex mr-2 rounded-circle" src="assets/images/users/avatar-2.jpg"
                             alt="Generic placeholder image" height="32">
                        <div class="media-body">
                            <h5 class="m-0 font-14">Erwin Brown</h5>
                            <span class="font-12 mb-0">UI Designer</span>
                        </div>
                    </div>
                </a>

                <!-- item-->
                <a href="javascript:void(0);" class="dropdown-item notify-item">
                    <div class="media">
                        <img class="d-flex mr-2 rounded-circle" src="assets/images/users/avatar-5.jpg"
                             alt="Generic placeholder image" height="32">
                        <div class="media-body">
                            <h5 class="m-0 font-14">Jacob Deo</h5>
                            <span class="font-12 mb-0">Developer</span>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
