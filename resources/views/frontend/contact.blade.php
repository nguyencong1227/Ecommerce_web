@extends('frontend.layouts.app')
@section('title') Liên hệ @endsection
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
                <span>Liên hệ</span>
            </li>
        </ul>
        <h1 class="main-ttl"><span>Liên hệ</span></h1>
        <!-- Contacts - start -->
        <br>

        <!-- Contact Form -->
        <div class="contactform-wrap">
            <form action="{{ route('post.contact') }}" method="POST">
                <h3 class="component-ttl component-ttl-ct component-ttl-hasdesc"><span>Phản hồi</span></h3>
                <p class="component-desc component-desc-ct">Một số sự thật nhỏ để từ bỏ tất cả dễ dàng</p>
                @include('frontend.layouts.alert')
                <p class="contactform-field contactform-text">
                    <label class="contactform-label">Họ tên</label><!-- NO SPACE --><span class="contactform-input"><input placeholder="Tên của bạn" type="text" name="name" data-required="text" required></span>
                </p>
                <p class="contactform-field contactform-email">
                    <label class="contactform-label">E-mail</label><!-- NO SPACE --><span class="contactform-input"><input placeholder="E-mail của bạn" type="email" name="email" data-required="text" data-required-email="email" required></span>
                </p>
                <p class="contactform-field contactform-textarea">
                    <label class="contactform-label">Nội dung</label><!-- NO SPACE --><span class="contactform-input"><textarea placeholder="Nội dung của bạn" name="mess" data-required="text"></textarea></span>
                </p>
                <p class="contactform-submit">
                    {{ csrf_field() }}
                    <input value="Gửi" type="submit">
                </p>
            </form>
        </div>
        <br>
        <br>
        <!-- Google Maps -->
        <div class="contacts-map allstore-gmap">
            <div class="marker" data-zoom="15" data-lat="-37.81485261872975" data-lng="144.95655298233032" data-marker="img/marker.png">534-540 Little Bourke St, Melbourne VIC 3000, Australia</div>
        </div>
        <!-- Contacts - end -->

    </section>
</main>
@endsection
