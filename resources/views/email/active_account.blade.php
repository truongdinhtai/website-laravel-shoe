<p>Xin chào <b>{{ $user->name }}</b></p>
<p>Chào mừng bạn đến với hệ thống website của chúng tôi, tài khoản của bạn vừa được tạo, xin vui lòng cập nhật và kích hoạt
    tài khoản <a href="{{ route('get.verify_account',['email' => $user->email]) }}">tại đây</a>
</p>
