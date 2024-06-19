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
                <a href="{{route('client.category_producte_detail', $categoryProducts->id)}}">
                    {{ $categoryProducts->ten }}
                </a>
            </li>
        </ul>
        <!-- Catalog Sidebar - start -->
        <div class="prod-related">
            <h1 class="main-ttl"><span style="width: 100%">Sản phẩm mới</span></h1>
            <div class="prod-related-car" id="prod-related-car" style="width: 100%">
                <ul class="slides" style="width: 100%">
                    <li class="prod-rel-wrap" style="width: 100%">
                        @foreach($productNews as $product)
                        <div class="prod-rel">
                            <a href="{{ route('client.product_detail', $product->id) }}" class="prod-rel-img">
                                <img src="{{ Storage::url('images/'.$product->Anh) }}" alt="Adipisci aperiam commodi">
                            </a>
                            <div class="prod-rel-cont">
                                <h3><a href="{{ route('client.product_detail', $product->id) }}">{{ $product->Ten }}</a></h3>
                                <p class="prod-rel-price">
                                    <b>{{ $product->Gia }}&nbsp;đ</b>
                                </p>
                                <div class="prod-rel-actions">
                                    <p class="prod-addwrap">
                                        <a title="Thêm giỏ hàng" href="{{ route('get.shopping.add', $product->id) }}" class="prod-add"><i class="fa fa-shopping-cart"></i></a>
                                    </p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </li>
                </ul>
            </div>
        </div>
        <!-- Catalog Sidebar - end -->
        <!-- Catalog Items | Gallery V1 - start -->
        <div class="section-cont">
            <!-- Catalog Topbar - end -->
            <h1 class="main-ttl" style="padding-top: 10px;"><span style="width: 100%">{{ $categoryProducts->ten }}</span></h1>
            <div class="prod-items section-items">
                @if(!$products->isEmpty())
                @foreach($products as $pro)
                <div class="prod-i">
                    <div class="prod-i-top">
                        <a href="{{ route('client.product_detail', $pro->id) }}" class="prod-i-img">
                            <!-- NO SPACE --><img src="{{ Storage::url('images/'.$pro->Anh) }}" alt="Adipisci aperiam commodi"><!-- NO SPACE -->
                        </a>
                        <a href="{{ route('get.shopping.add', $pro->id) }}" class="prod-i-buy prod-add">Thêm giỏ hàng</a>
                    </div>
                    <h3>
                        <a href="{{ route('client.product_detail', $pro->id) }}">{{ $pro->Ten }}</a>
                    </h3>
                    <p class="prod-i-price">
                        <b>{{ $pro->Gia }}&nbsp;đ</b>
                    </p>
                </div>
                @endforeach
                @endif
            </div>

            @if($products->hasPages())
            <div class="pagination text-center mb-4">
                {{ $products->links() }}
            </div>
            @endif
        </div>
        <!-- Catalog Items | Gallery V1 - end -->
    </section>
</main>
@endsection