@extends('frontend.layouts.app')
@section('title') Siêu thị mẹ bé @endsection
@section('content')
<main>
    <section class="container">


        <!-- Slider -->
        <div class="fr-slider-wrap">
            <div class="fr-slider">
                <ul class="slides">
                    <li>
                        <img src="{{ asset('frontend_asset/img/slider/slide2.jpg') }}" height="480" width="1140" alt="">
                    </li>
                    <li>
                        <img src="{{ asset('frontend_asset/img/slider/slide3.png') }}" height="480" width="1140" alt="">
                    </li>
                    <li>
                        <img src="{{ asset('frontend_asset/img/slider/slide4.jpg') }}" height="480" width="1140" alt="">
                    </li>
                </ul>
            </div>
        </div>


        <!-- Popular Products -->
        <div class="fr-pop-wrap">

            <h3 class="component-ttl"><span>Sản phẩm bán chạy</span></h3>

            <div class="fr-pop-tab-cont">

                <p data-frpoptab-num="1" class="fr-pop-tab-mob active" data-frpoptab="#frpoptab-tab-1"></p>
                <div class="flexslider prod-items fr-pop-tab" id="frpoptab-tab-1">

                    <ul class="slides">
                        @if(!$productSale->isEmpty())
                        @foreach ($productSale as $proSale)
                        <li class="prod-i">
                            <div class="prod-i-top">
                                <a href="{{ route('client.product_detail', $proSale->id) }}" class="prod-i-img">
                                    <!-- NO SPACE --><img src="{{ Storage::url('images/'.$proSale->Anh) }}" alt="Aspernatur excepturi rem"><!-- NO SPACE -->
                                </a>
                                <p class="prod-i-addwrap">
                                    <a href="{{ route('get.shopping.add', $proSale->id) }}" class="prod-i-add prod-add">Thêm giỏ hàng</a>
                                </p>
                            </div>
                            <h3>
                                <a href="{{ route('client.product_detail', $proSale->id) }}">{{ $proSale->Ten }}</a>
                            </h3>
                            <p class="prod-i-price">
                                <b>{{ number_format($proSale->Gia,0,',','.') }}&nbsp;đ</b>
                            </p>
                        </li>
                        @endforeach
                        @endif
                    </ul>

                </div>

            </div><!-- .fr-pop-tab-cont -->


        </div><!-- .fr-pop-wrap -->


        <!-- Banners -->
        <div class="discounts-wrap">
            <h3 class="component-ttl"><span>Sản phẩm mới nhất</span></h3>
            <div class="prod-items section-items">
                @foreach ($productNews as $proNew)
                <div class="prod-i">
                    <div class="prod-i-top">
                        <a href="{{ route('client.product_detail', $proNew->id) }}" class="prod-i-img">
                            <!-- NO SPACE --><img src="{{ Storage::url('images/'.$proNew->Anh) }}" alt="Adipisci aperiam commodi"><!-- NO SPACE -->
                        </a>
                        <a href="{{ route('get.shopping.add', $proNew->id) }}" class="prod-i-buy prod-add">Thêm giỏ hàng</a>
                    </div>
                    <h3>
                        <a href="{{ route('client.product_detail', $proNew->id) }}">{{ $proNew->Ten }}</a>
                    </h3>
                    <p class="prod-i-price">
                        <b>{{ number_format($proNew->Gia,0,',','.') }}&nbsp;đ</b>
                    </p>
                </div>
                @endforeach
            </div>
        </div>
        <!-- Special offer -->
        <div class="discounts-wrap">
            <h3 class="component-ttl"><span>Sản phẩm xem nhiều nhất</span></h3>
            <div class="flexslider discounts-list">
                <ul class="slides">
                    @if(!$productViews->isEmpty())
                    @foreach ($productViews as $proview)
                    <li class="discounts-i">
                        <a href="{{ route('client.product_detail', $proview->id) }}" class="discounts-i-img">
                            <img src="{{ Storage::url('images/'.$proview->Anh) }}" alt="Dicta doloremque">
                        </a>
                        <h3 class="discounts-i-ttl">
                            <a href="{{ route('client.product_detail', $proview->id) }}">{{ $proview->Ten }}</a>
                        </h3>
                        <p class="discounts-i-price">
                            <b>{{ number_format($proview->Gia,0,',','.') }}&nbsp;đ</b>
                        </p>
                    </li>
                    @endforeach
                    @endif
                </ul>
            </div>
        </div>
    </section>
</main>
@endsection