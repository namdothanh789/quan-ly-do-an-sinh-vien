<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('home') }}" class="brand-link navbar-info">
        <img src="{!! asset('admin/dist/img/AdminLTELogo.png') !!}"
             alt="AdminLTE Logo"
             class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">Quản lý đồ án</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        @php
            $user = Auth::user();
        @endphp
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('/admin/dist/img/avatar5.png') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{!! $user->name !!}</a>
        </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column nav-legacy nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item has-treeview">
                    <a href="{{ route('home') }}" class="nav-link">
                        <i class="nav-icon fas fa fa-home"></i>
                        <p>Bảng điều khiển</p>
                    </a>
                </li>
                @if ($user->can(['toan-quyen-quan-ly', 'quan-ly-danh-sach-dang-ky-de-tai']))
                <li class="nav-item">
                    <a href="{{ route('student.topics.index') }}" class="nav-link {{ isset($student_topics) ? $student_topics : '' }}">
                        <i class="nav-icon fas fa-clipboard-list"></i>
                        <p>Danh sách đăng ký</p>
                    </a>
                </li>
                @endif


                @if ($user->can(['toan-quyen-quan-ly', 'quan-ly-danh-sach-sinh-vien', 'danh-sach-nhom-sinh-vien']))
                    <li class="nav-item has-treeview {{ isset($student_active) || isset($group_active) ? 'menu-open' : ''}}">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-graduation-cap" aria-hidden="true"></i>
                            <p>Quản lý sinh viên <i class="fas fa-angle-left right"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            @if ($user->can(['toan-quyen-quan-ly', 'quan-ly-danh-sach-sinh-vien']))
                                <li class="nav-item">
                                    <a href="{{ route('student.index') }}" class="nav-link {{ isset($student_active) ? $student_active : '' }}">
                                        <i class="far fa-circle nav-icon" aria-hidden="true"></i>
                                        <p>Sinh viên </p>
                                    </a>
                                </li>
                            @endif
                            @if ($user->can(['toan-quyen-quan-ly', 'danh-sach-nhom-sinh-vien']))
                                <li class="nav-item">
                                    <a href="{{ route('group.index') }}" class="nav-link {{ isset($group_active) ? $group_active : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Nhóm sinh viên</p>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif

                @if ($user->can(['toan-quyen-quan-ly', 'quan-ly-danh-sach-giao-vien']))
                <li class="nav-item">
                    <a href="{{ route('user.index') }}" class="nav-link {{ isset($user_active) ? $user_active : '' }}">
                        <i class="nav-icon fa fa-fw fa-user" aria-hidden="true"></i>
                        <p>Giáo viên </p>
                    </a>
                </li>
                @endif

                @if ($user->can(['toan-quyen-quan-ly', 'quan-ly-danh-sach-de-tai', 'quan-ly-danh-sach-de-tai-theo-nam']))
                <li class="nav-item has-treeview {{ isset($topic_menu) || isset($topic_course_menu) ? 'menu-open' : ''}}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-file-word" aria-hidden="true"></i>
                        <p>Quản lý đề tài <i class="fas fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        @if ($user->can(['toan-quyen-quan-ly', 'quan-ly-danh-sach-de-tai']))
                        <li class="nav-item">
                            <a href="{{ route('topic.index') }}" class="nav-link {{ isset($topic_menu)  ? $topic_menu : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Đề tài</p>
                            </a>
                        </li>
                        @endif
                        @if ($user->can(['toan-quyen-quan-ly', 'quan-ly-danh-sach-de-tai-theo-nam']))
                        <li class="nav-item">
                            <a href="{{ route('topic.course.index') }}" class="nav-link {{ isset($topic_course_menu) ? $topic_course_menu : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Đề tài theo năm</p>
                            </a>
                        </li>
                        @endif
                    </ul>
                </li>
                @endif
                @if ($user->can(['toan-quyen-quan-ly', 'quan-ly-danh-sach-hoi-dong']))
                <li class="nav-item">
                    <a href="{{ route('council.index') }}" class="nav-link {{ isset($council_menu)  ? $council_menu : '' }}">
                        <i class="fa fa-users nav-icon"></i>
                        <p>Quản lý hội đồng</p>
                    </a>
                </li>
                @endif
                @if ($user->can(['toan-quyen-quan-ly', 'quan-ly-danh-sach-thong-bao']))
                <li class="nav-item">
                    <a href="{{ route('notifications.index') }}" class="nav-link {{ isset($notification_active)  ? $notification_active : '' }}">
                        <i class="fa fa-fw fa-envelope nav-icon"></i>
                        <p>Thông báo</p>
                    </a>
                </li>
                @endif
                @if ($user->can(['toan-quyen-quan-ly', 'danh-sach-lich-hen']))
                <li class="nav-item">
                    <a href="{{ route('schedule.student.index') }}" class="nav-link {{ isset($schedule_active)  ? $schedule_active : '' }}">
                        <i class="fa fa-fw fa-calculator nav-icon"></i>
                        <p>Lịch hẹn</p>
                    </a>
                </li>
                @endif
                @if ($user->can(['toan-quyen-quan-ly', 'quan-ly-danh-sach-chuc-vu', 'quan-ly-danh-sach-khoa-bo-mon', 'quan-ly-danh-sach-nien-khoa', 'quan-ly-danh-sach-vai-tro']))
                <li class="nav-item has-treeview {{ isset($group_permission) || isset($permission_active)
                || isset($role_active) || isset($position_menu) || isset($department_menu) || isset($course_menu) ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-database"></i>
                        <p>
                            Quản lý dữ liệu
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @if ($user->can(['toan-quyen-quan-ly', 'quan-ly-danh-sach-chuc-vu']))
                        <li class="nav-item">
                            <a href="{{ route('position.index') }}" class="nav-link {{ isset($position_menu)  ? $position_menu : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Chức vụ</p>
                            </a>
                        </li>
                        @endif
                        @if ($user->can(['toan-quyen-quan-ly', 'quan-ly-danh-sach-khoa-bo-mon',]))
                        <li class="nav-item">
                            <a href="{{ route('department.index') }}" class="nav-link {{ isset($department_menu)  ? $department_menu : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Quản lý khoa / bộ môn</p>
                            </a>
                        </li>
                        @endif
                        @if ($user->can(['toan-quyen-quan-ly', 'quan-ly-danh-sach-nien-khoa']))
                        <li class="nav-item">
                            <a href="{{ route('course.index') }}" class="nav-link {{ isset($course_menu)  ? $course_menu : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Niên khóa</p>
                            </a>
                        </li>
                        @endif
                        {{--<li class="nav-item">--}}
                            {{--<a href="{{ route('group.permission.index') }}" class="nav-link {{ isset($group_permission)  ? $group_permission : '' }}">--}}
                                {{--<i class="far fa-circle nav-icon" aria-hidden="true"></i>--}}
                                {{--<p>Nhóm quyền</p>--}}
                            {{--</a>--}}
                        {{--</li>--}}
                        {{--<li class="nav-item">--}}
                            {{--<a href="{{ route('permission.index') }}" class="nav-link {{ isset($permission_active) ? $permission_active : '' }}">--}}
                                {{--<i class="far fa-circle nav-icon"></i>--}}
                                {{--<p> Quyền </p>--}}
                            {{--</a>--}}
                        {{--</li>--}}
                        @if ($user->can(['toan-quyen-quan-ly', 'quan-ly-danh-sach-vai-tro']))
                        <li class="nav-item">
                            <a href="{{ route('role.index') }}" class="nav-link {{ isset($role_active) ? $role_active : '' }}">
                                <i class="far fa-circle nav-icon" aria-hidden="true"></i>
                                <p> Vai trò </p>
                            </a>
                        </li>
                        @endif
                    </ul>
                </li>
                @endif
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
