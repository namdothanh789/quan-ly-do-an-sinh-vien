<nav class="navbar navbar-top navbar-expand navbar-dark bg-primary border-bottom">
    <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Search form -->
            <a href="/">
                <img class="logo_banner" style="height: 100px !important;" src="{{ asset('page/img/brand/ProManager128x128.png') }}">
            </a>
            <!-- Navbar links -->
            <ul class="navbar-nav align-items-center  ml-md-auto ">
                <li class="nav-item d-xl-none">
                    <!-- Sidenav toggler -->
                    <div class="pr-3 sidenav-toggler sidenav-toggler-dark active" data-action="sidenav-pin" data-target="#sidenav-main">
                        <div class="sidenav-toggler-inner">
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                        </div>
                    </div>
                </li>
                <li class="nav-item d-sm-none">
                    <a class="nav-link" href="#" data-action="search-show" data-target="#navbar-search-main">
                        <i class="ni ni-zoom-split-in"></i>
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        <i class="ni ni-bell-55"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-xl dropdown-menu-right py-0 overflow-hidden">
                        <!-- Dropdown header -->
                        <div class="px-3 py-3">
                            <h6 class="text-sm text-muted m-0">Thông báo của bạn <strong class="text-primary">{{ $notifications->count() }}</strong>.</h6>
                        </div>
                        <!-- List group -->
                        <div class="list-group list-group-flush">
                            @foreach ($notifications as $notification)
                            <a href="{{ route('user.notifications.details', $notification->id) }}" class="list-group-item list-group-item-action">
                                <div class="row align-items-center">
                                    <div class="col ml--2">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <h4 class="mb-0 text-sm">{{ $notification->n_title }}</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            @endforeach
                        </div>
                        <!-- View all -->
                        <a href="{{ route('user.notifications.index') }}" class="dropdown-item text-center text-primary font-weight-bold py-3">Xem thêm</a>
                    </div>
                </li>
            </ul>
            <?php
                $user = Auth::guard('students')->user();
            ?>
            <ul class="navbar-nav align-items-center  ml-auto ml-md-0 ">
                <li class="nav-item dropdown">
                    <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="media align-items-center">
                            <span class="avatar avatar-sm rounded-circle">
                                <img alt="Image placeholder" src="{{ isset($user->avatar) && !empty($user->avatar) ? asset(pare_url_file($user->avatar)) : asset('page/img/theme/team-4.jpg') }}">
                            </span>
                            <div class="media-body  ml-2  d-none d-lg-block">
                                <span class="mb-0 text-sm  font-weight-bold">{{ $user->name }}</span>
                            </div>
                        </div>
                    </a>
                    <div class="dropdown-menu  dropdown-menu-right ">
                        <div class="dropdown-header noti-title">
                            <h6 class="text-overflow m-0">Xin Chào</h6>
                        </div>
                        <a href="{{ route('user.profile') }}" class="dropdown-item">
                            <i class="ni ni-single-02"></i>
                            <span>Thông tin tài khoản</span>
                        </a>

                        <a href="{{ route('user.schedule.calendar') }}" class="dropdown-item">
                            <i class="ni ni-calendar-grid-58"></i>
                            <span>Lịch</span>
                        </a>

                        <a href="{{ route('user.schedule.teacher') }}" class="dropdown-item">
                            <i class="ni ni-calendar-grid-58"></i>
                            <span>Đăng ký lịch hẹn</span>
                        </a>
                        <a href="{{ route('user.topic.details') }}" class="dropdown-item">
                            <i class="ni ni-bullet-list-67"></i>
                            <span>Đề tài đã đăng ký</span>
                        </a>
                        <a href="{{ route('user.change.password') }}" class="dropdown-item">
                            <i class="ni ni-curved-next"></i>
                            <span>Đổi mật khẩu</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="{{ route('user.logout') }}" class="dropdown-item">
                            <i class="ni ni-button-power"></i>
                            <span>Logout</span>
                        </a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>