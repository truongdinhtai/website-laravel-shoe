<ul class="nav nav-tab-profile">
    <li class="nav-item {{ Route::currentRouteName() == 'get_admin.profile.index' ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('get_admin.profile.index') }}">Thông tin cá nhân</a>
    </li>
    <li class="nav-item {{ Route::currentRouteName() == 'get_admin.profile.update_password' ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('get_admin.profile.update_password') }}">Đổi mật khẩu</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#">Đổi email đăng nhập</a>
    </li>
</ul>
