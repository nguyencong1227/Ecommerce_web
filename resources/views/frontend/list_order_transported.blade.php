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
                <a href="">
                    Danh sách đơn hàng đang giao
                </a>
            </li>
        </ul>
        <h1 class="main-ttl"><span>Danh sách đơn hàng đang giao</span></h1>
        <!-- Catalog Sidebar - start -->

        <!-- Catalog Items | Gallery V1 - start -->
        <div class="section-sb">
            <!-- Catalog Categories - start -->
            @include('frontend.layouts.menu_user')
            <!-- Catalog Categories - end -->
        </div>
        <div class="section-cont">
            <div class="cart-items-wrap">
                @include('frontend.layouts.alert')
                <table class="cart-items">
                    <thead>
                        <tr>
                            <td>STT</td>
                            <td>Họ và tên</td>
                            <td>Số điện tdoại </td>
                            <td>Tổng tiền</td>
                            <td>Trạng thái</td>
                            <td>Ngày tạo</td>
                            <td>Hành động</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $key => $order)
                        <tr>
                            <td>{{ $key + 1}}</td>
                            <td>{{ isset($order->user) ? $order->user->Ten : '' }}</td>
                            <td>{{ isset($order->user) ? $order->user->SDT : '' }}</td>
                            <td>{{ number_format($order->TongTien) }} đ</td>
                            <td>{{ $status[$order->TrangThai] }}</td>
                            <td>{{ date("d-m-Y", strtotime($order->NgayTao))}}</td>
                            <td>
                                @if(intval($order->TrangThai) == 0)
                                <a href="{{ route('cancel.order', $order->id)}}" class="text-url">Hủy</a> /
                                @endif

                                <a href="{{route('billing', $order->id)}}" class="text-url">Hóa đơn</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Catalog Items | Gallery V1 - end -->
    </section>
</main>
@endsection