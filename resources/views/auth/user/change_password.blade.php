@extends('frontend.layouts.app')
@section('title') Thay đổi mật khẩu @endsection
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
            <h1 class="main-ttl"><span>Thay đổi mật khẩu</span></h1>
            <div class="auth-wrap">
                <div class="auth-col" style="width: 70%;">
                    @include('frontend.layouts.alert')
                    <form method="post" class="login">
                        @csrf
                        <p>
                            <label for="username">Mật khẩu cũ <span class="required">*</span></label><input required type="password" name="current_password">
                            @if ($errors && $errors->has('current_password'))
                                <p class="text-danger text-xs error-message">{{ $errors->first('current_password') }}</p>
                            @endif
                        </p>
                        <p>
                            <label for="password">Mật khẩu mới <span class="required">*</span></label><input required type="password" name="new_password">
                            @if ($errors && $errors->has('new_password'))
                                <p class="text-danger text-xs error-message">{{ $errors->first('new_password') }}</p>
                            @endif
                        </p>
                        <p>
                        <label for="password">Mật khẩu mới <span class="required">*</span></label><input required type="password" name="retype_password">
                            @if ($errors && $errors->has('retype_password'))
                                <p class="text-danger text-xs error-message">{{ $errors->first('retype_password') }}</p>
                            @endif
                        </p>
                        <p class="auth-submit">
                            <input type="submit" value="Thay đổi">
                        </p>

                    </form>
                </div>
            </div>
        </section>
    </main>
@endsection
