@extends('frontend.layouts.app')
@section('title') Đăng nhập @endsection
@section('content')
<main>
    <section class="container stylization maincont">


        <ul class="b-crumbs">
            <li>
                <a href="/">
                    Trang chủ
                </a>
            </li>
            <li>
                <span>Đăng ký / Đăng nhập</span>
            </li>
        </ul>
        <h1 class="main-ttl"><span>Đăng ký / Đăng nhập</span></h1>
        <div class="auth-wrap">

            <div class="auth-col">
                <h2>Đăng nhập</h2>
                <form method="post" class="login" action="{{ route('post.user.login') }}">
                    <p>
                        <label for="username">E-mail <span class="required">*</span></label><input type="text" id="username">
                    </p>
                    <p>
                        <label for="password">Password <span class="required">*</span></label><input type="password" id="password">
                    </p>
                    {{--<p class="auth-submit">--}}
                    {{--<input type="submit" value="Đăng nhập">--}}
                    {{--<input type="checkbox" id="rememberme" value="forever">--}}
                    {{--<label for="rememberme">Nhớ đăng nhập</label>--}}
                    {{--</p>--}}
                    {{--<p class="auth-lost_password">--}}
                    {{--<a href="#">Bạn quên mật khẩu?</a>--}}
                    {{--</p>--}}
                </form>
            </div>
            <div class="auth-col">
                <h2>Đăng ký</h2>
                <form method="post" class="register">
                    <p>
                        <label for="reg_email">Email <span class="required">*</span></label><input type="email" id="reg_email">
                    </p>
                    <p>
                        <label for="reg_password">Password <span class="required">*</span></label><input type="password" id="reg_password">
                    </p>
                    <p class="auth-submit">
                        <input type="submit" value="Đăng ký">
                    </p>
                </form>
            </div>
        </div>



    </section>
</main>
@endsection