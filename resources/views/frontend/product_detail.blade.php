@extends('frontend.layouts.app')
@section('title') Siêu thị mẹ bé @endsection
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
                <a href="{{route('client.category_producte_detail', $productDetail->category_product->id)}}">
                    {{ $productDetail->category_product ? $productDetail->category_product->ten : '' }}
                </a>
            </li>
            <li>
                <span>{{ $productDetail->Ten }}</span>
            </li>
        </ul>
        <!-- Single Product - start -->
        <div class="prod-wrap" style="margin-top: 20px">

            <!-- Product Images -->
            <div class="prod-slider-wrap">
                <div class="prod-slider">
                    <ul class="prod-slider-car">
                        <li>
                            <a class="fancy-img">
                                <img src="{{ Storage::url('images/'.$productDetail->Anh) }}" alt="">
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Product Description/Info -->
            <div class="prod-cont">
                <div class="prod-info">
                    <h1 class="main-ttl"><span>{{ $productDetail->Ten }}</span></h1>
                    <p style="padding-bottom: 10px; font-size: 20px">
                        <b class="item_current_price">{{ number_format($productDetail->Gia,0,',','.') }}&nbsp;đ</b>
                    </p>
                    <p class="prod-skuttl">Còn lại : <span style="color:red">{{ $productDetail->SoLuong }}</span>&nbsp;&nbsp;Sản phẩm</p>
                    <div class="prod-skuwrap">
                        <p class="prod-skuttl">Chọn size</p>
                        <div class="offer-props-select opened">
                            <select name="size" id="size">
                                @php $sizes = explode(',', $productDetail->size); @endphp
                                @foreach($sizes as $size)
                                <option value="{{ $size }}">{{ $size }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <p class="prod-qnt">
                        <input value="1" type="number" min="1" class="qty">
                    </p>
                    <p class="prod-addwrap">
                        <a href="{{ route('get.shopping.add', $productDetail->id) }}" class="prod-add" rel="nofollow">Thêm giỏ hàng</a>
                    </p>
                    </br>
                </div>
            </div>

            <!-- Product Tabs -->
            <div class="prod-tabs-wrap">
                <div class="prod-tab-cont">
                    <h1 class="main-ttl"><span style="width: 100%;">Mô tả</span></h1>
                    <div class="prod-tab stylization" id="prod-tab-1">
                        {!! $productDetail->MoTa !!}
                    </div>
                    <div class="prod-tab prod-tab-video" id="prod-tab-3">
                        <iframe width="853" height="480" src="https://www.youtube.com/embed/kaOVHSkDoPY?rel=0&amp;showinfo=0" allowfullscreen></iframe>
                    </div>
                </div>
            </div>

        </div>
        <!-- Single Product - end -->

        <!-- Related Products - start -->
        <div class="prod-related">
            <h2><span>Sản phẩm liên quan</span></h2>
            <div class="prod-related-car" id="prod-related-car">
                <ul class="slides">
                    <li class="prod-rel-wrap">
                        @foreach($productRelated as $proRelated)
                        <div class="prod-rel">
                            <a href="{{ route('client.product_detail', $proRelated->id) }}" class="prod-rel-img">
                                <img src="{{ Storage::url('images/'.$proRelated->Anh) }}" alt="Adipisci aperiam commodi">
                            </a>
                            <div class="prod-rel-cont">
                                <h3><a href="{{ route('client.product_detail', $proRelated->id) }}">{{ $proRelated->Ten }}</a></h3>
                                <p class="prod-rel-price">
                                    <b>{{ $productDetail->Gia }}&nbsp;đ</b>
                                </p>
                                <div class="prod-rel-actions">
                                    <p class="prod-addwrap">
                                        <a title="Thêm giỏ hàng" href="{{ route('get.shopping.add', $proRelated->id) }}" class="prod-add"><i class="fa fa-shopping-cart"></i></a>
                                    </p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </li>
                </ul>
            </div>
        </div>
        <!-- Related Products - end -->

    </section>
</main>
@endsection