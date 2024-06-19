@extends('frontend.layouts.app')
@section('title') Thông tin người dùng @endsection
@section('content')
<main>
    <section class="container">
        <ul class="b-crumbs">
            <li>
                <a href="{{ route('client.home') }}">
                    Trang chủ
                </a>
            </li>
            <li>
                <a href="">
                    Thông tin người dùng
                </a>
            </li>
        </ul>
        <h1 class="main-ttl"><span>Thông tin người dùng</span></h1>
        <!-- Catalog Sidebar - start -->

        <!-- Catalog Items | Gallery V1 - start -->
        <div class="section-sb">
            <!-- Catalog Categories - start -->
            @include('frontend.layouts.menu_user')
            <!-- Catalog Categories - end -->
        </div>
        <div class="section-cont">
            <div class="auth-wrap">
                <div class="auth-col" style="width:100%">
                    @include('frontend.layouts.alert')
                    <form method="post" class="login" action="{{ route('update.info.user')}}">
                        @csrf
                        <p>
                            <input required type="text" name="name" value="{{old('name', isset($user->Ten) ? $user->Ten : '')}}" placeholder="Tên của bạn">
                            @if ($errors && $errors->has('name'))
                        <p class="text-danger text-xs error-message">{{ $errors->first('name') }}</p>
                        @endif
                        </p>
                        <p>
                            <input required type="text" name="email" placeholder="Email" value="{{old('email', isset($user->email) ? $user->email : '')}}">
                            @if ($errors && $errors->has('email'))
                        <p class="text-danger text-xs error-message">{{ $errors->first('email') }}</p>
                        @endif
                        </p>
                        <p>
                            <input required type="number" name="phone_number" placeholder="Số điện thoại" value="{{old('phone_number', isset($user->SDT) ? $user->SDT : '')}}">
                            @if ($errors && $errors->has('phone_number'))
                        <p class="text-danger text-xs error-message">{{ $errors->first('phone_number') }}</p>
                        @endif
                        </p>
                        <p>
                            </label><input required type="text" name="address" placeholder="Địa chỉ" value="{{old('address', isset($user->DiaChi) ? $user->DiaChi : '')}}">
                        </p>
                        <p class="auth-submit">
                            <input type="submit" value="Cập nhật thông tin">
                        </p>

                    </form>
                </div>
            </div>
        </div>
        <!-- Catalog Items | Gallery V1 - end -->
    </section>
</main>
@endsection