@extends('frontend.layouts.app')
@section('title') Đăng ký  @endsection
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
            <h1 class="main-ttl"><span>Đăng ký</span></h1>
            <div class="auth-wrap">
                <div class="auth-col">
                    <form method="post" class="login">
                        @csrf
                        <p>
                            <label for="name">Họ và tên <span class="required">*</span></label><input required type="text" name="name" value="{{old('name')}}" placeholder="Tên của bạn">
                            @if ($errors && $errors->has('name'))
                                <p class="text-danger text-xs error-message">{{ $errors->first('name') }}</p>
                            @endif
                        </p>
                        <p>
                            <label for="email">E-mail <span class="required">*</span></label><input required type="text" name="email" value="{{old('email')}}" placeholder="Email">
                            @if ($errors && $errors->has('email'))
                                <p class="text-danger text-xs error-message">{{ $errors->first('email') }}</p>
                            @endif
                        </p>
                        <p>
                            <label for="phone_number">Phone <span class="required">*</span></label><input required type="text" name="phone_number" value="{{old('phone_number')}}" placeholder="Số điện thoại">
                            @if ($errors && $errors->has('phone_number'))
                                <p class="text-danger text-xs error-message">{{ $errors->first('phone_number') }}</p>
                            @endif
                        </p>
                        <p>
                            <label for="address">Địa chỉ <span class="required">*</span></label><input required type="text" name="address" value="{{old('address')}}" placeholder="Địa chỉ">
                            @if ($errors && $errors->has('address'))
                                <p class="text-danger text-xs error-message">{{ $errors->first('address') }}</p>
                            @endif
                        </p>
                        <p>
                            <label for="password">Mật Khẩu <span class="required">*</span></label><input required type="password" name="password">
                            @if ($errors && $errors->has('password'))
                                <p class="text-danger text-xs error-message">{{ $errors->first('password') }}</p>
                            @endif
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
