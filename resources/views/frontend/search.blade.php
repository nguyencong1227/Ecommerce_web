@extends('frontend.layouts.app')
@section('title') Tìm kiếm sản phẩm @endsection
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
                    <a href="catalog-gallery.html">
                        Tìm kiếm
                    </a>
                </li>
            </ul>
            <h1 class="main-ttl"><span>Tìm kiếm sản phẩm</span></h1>
            <div class="section-cont">
                <!-- Catalog Topbar - end -->
                <div class="prod-items section-items">
                    @if(!$products->isEmpty())
                        @foreach($products as $pro)
                            <div class="prod-i">
                                <div class="prod-i-top">
                                    <a href="{{ route('client.product_detail', $pro->id) }}" class="prod-i-img"><!-- NO SPACE --><img src="{{ Storage::url('images/'.$pro->Anh) }}" alt="Adipisci aperiam commodi"><!-- NO SPACE --></a>
                                    <a href="{{ route('get.shopping.add', $pro->id) }}" class="prod-add prod-i-buy">Thêm giỏ hàng</a>
                                </div>
                                <h3>
                                    <a href="{{ route('client.product_detail', $pro->id) }}">{{ $pro->Ten }}</a>
                                </h3>
                                <p class="prod-i-price">
                                    <b>{{ $pro->Gia }}&nbsp;đ</b>
                                </p>
                            </div>
                        @endforeach
                    @else
                        <p>Không tìm thấy sản phẩm phù hợp</p>
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
