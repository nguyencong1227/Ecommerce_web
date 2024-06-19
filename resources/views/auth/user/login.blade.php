@extends('frontend.layouts.app')
@section('title') Đăng nhập @endsection
@section('content')
    <main>
        <section class="container">


            <ul class="b-crumbs">
                <li>
                    <a href="{{ route('client.home') }}">
                        Trang chủ
                    </a>
                </li>
            </ul>
            <h1 class="main-ttl"><span>Đăng nhập</span></h1>
            <div class="auth-wrap">
                <div class="auth-col">
                    @include('frontend.layouts.alert')
                    <form method="post" class="login">
                        @csrf
                        <p>
                            <label for="username">E-mail <span class="required">*</span></label><input required type="text" name="email">
                        </p>
                        <p>
                            <label for="password">Password <span class="required">*</span></label><input required type="password" name="password">
                        </p>
                        <p class="auth-submit">
                            <input type="submit" value="Đăng nhập">
                            {{--<label for="rememberme">Nhớ đăng nhập</label>--}}
                        </p>
                        {{--<p class="auth-lost_password">--}}
                            {{--<a href="#">Bạn quên mật khẩu?</a>--}}
                        {{--</p>--}}
                    </form>
                </div>
            </div>
        </section>
    </main>
@endsection
