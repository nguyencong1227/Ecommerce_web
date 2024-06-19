@extends('frontend.layouts.app')
@section('title') Thông tin thanh toán  @endsection
@section('content')
    <main>
        <section class="container stylization maincont">
            <ul class="b-crumbs">
                <li>
                    <a href="index.html">
                        Trang chủ
                    </a>
                </li>
                <li>
                    <span>Thông tin thanh toán</span>
                </li>
            </ul>
            <h1 class="main-ttl"><span>Thông tin thanh toán</span></h1>
            <br>
            <!-- Payment Form -->
            <div class="row">
                <div class="col-md-6 contactform-wrap">
                    <form action="{{ route('post.shopping.pay') }}" method="POST">
                        <h3 class="component-ttl component-ttl-ct component-ttl-hasdesc"><span>Thông tin người nhận</span></h3>
                        <p class="contactform-field contactform-text">
                            <label class="contactform-label">Họ tên</label><!-- NO SPACE --><span class="contactform-input"><input placeholder="Tên của bạn" type="text" name="name" value="{{ old('name', isset($user->SDT) ? $user->Ten : '') }}" required></span>
                            <p class="text-danger text-xs error-message">{{ $errors->first('name') }}</p>
                        </p>
                        <p class="contactform-field contactform-email">
                            <label class="contactform-label">E-mail</label><!-- NO SPACE --><span class="contactform-input"><input placeholder="E-mail của bạn" type="email" name="email" data-required-email="email" value="{{ old('email', isset($user->email) ? $user->email : '') }}" required></span>
                            <p class="text-danger text-xs error-message">{{ $errors->first('email') }}</p>
                        </p>
                        <p class="contactform-field contactform-text">
                            <label class="contactform-label">Địa chỉ</label><!-- NO SPACE --><span class="contactform-input"><input placeholder="Địa chỉ của bạn" type="text" name="address" value="{{ old('address', isset($user->DiaChi) ? $user->DiaChi : '') }}" required></span>
                            <p class="text-danger text-xs error-message">{{ $errors->first('address') }}</p>
                        </p>
                        <p class="contactform-field contactform-text">
                            <label class="contactform-label">Phone </label><!-- NO SPACE --><span class="contactform-input"><input placeholder="Số điện thoại" type="number" name="phone" value="{{ old('phone', isset($user->SDT) ? $user->SDT : '') }}" required></span>
                            <p class="text-danger text-xs error-message">{{ $errors->first('phone') }}</p>
                        </p>
                        <p class="contactform-field contactform-textarea">
                            <label class="contactform-label">Nội dung</label><!-- NO SPACE --><span class="contactform-input"><textarea placeholder="Nội dung của bạn" name="message" value="{{ old('message') }}"></textarea></span>
                        </p>
                        {{ csrf_field() }}
                        <p class="contactform-submit">
                            <input value="Đặt hàng" type="submit" name="dat_hang">
                            <input value="Gửi Tặng" type="submit" name="gui_tang">
                        </p>
                    </form>
                </div>
            </div>
            <br>
        </section>
    </main>
@endsection
