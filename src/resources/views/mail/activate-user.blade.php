Xin chào bạn {{ $newUser->last_name }} {{ $newUser->first_name }},
Vui lòng click vào đường link sau để kích hoạt tài khoản.
<a href="{{ route('auth.register.active-user', ['username' => $newUser->username, 'activeCode' => $newUser->active_code]) }}">Kích hoạt tài khoản</a>