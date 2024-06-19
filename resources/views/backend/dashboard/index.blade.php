@extends('backend.layouts.app')
@section('title') Dashboard @endsection
@section('content')
<section class="content">
    <div class="container-fluid">
        @if(Auth::user()->VaiTro == 1)
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title">Thống kê dữ liệu</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row" style="margin-bottom: 15px;">
                    <div class="col-sm-12">
                        <form action="">
                            <div class="row">
                                <div class="col-sm-12 col-md-3">
                                    <?php $currentDay = date('m'); ?>
                                    <div class="form-group">
                                        <select name="select_day" id="" class="form-control">
                                            <option value="">Chọn ngày</option>
                                            @foreach($listDay as $key => $day)
                                                <option {{ Request::get('select_day') == ($key +1) ? "selected='selected'" : '' }} value="{{$key + 1}}">{{$key + 1}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-3">
                                    <?php $month = date('m'); ?>
                                    <div class="form-group">
                                        <select name="select_month" id="" class="form-control">
                                            <option value="">Chọn tháng</option>
                                            @for($i = 1; $i < 13; $i++)
                                                @if(Request::get('select_month'))
                                                    <option {{ Request::get('select_month') == $i ? "selected='selected'" : '' }} value="{{$i}}">{{$i}}</option>
                                                @else
                                                    <option {{ $month == $i ? "selected='selected'" : '' }} value="{{$i}}">{{$i}}</option>
                                                @endif
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-3">
                                    <?php $year = date('Y'); ?>
                                    <div class="form-group">
                                        <select name="select_year" id="" class="form-control">
                                            <option value="">Chọn năm</option>
                                            @for($i = $year - 15; $i <= $year + 5; $i++)
                                                @if(Request::get('select_year'))
                                                    <option {{ Request::get('select_year') == $i ? "selected='selected'" : '' }} value="{{$i}}">{{$i}}</option>
                                                @else
                                                    <option {{ $year == $i ? "selected='selected'" : '' }} value="{{$i}}">{{$i}}</option>
                                                @endif
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-2">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-success " style="margin-right: 10px"><i class="fas fa-search"></i> Filter </button>
                                    </div>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title">Dữ liệu</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{ $numberProduct }}</h3>

                                <p>Tổng số sản phẩm</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-bag"></i>
                            </div>
                            <a href="{{ route('product.index') }}" class="small-box-footer">Xem thêm<i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>{{ $numberUser }}</h3>

                                <p>Tổng số người dùng</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-person-add"></i>
                            </div>
                            <a href="{{ route('user.index') }}" class="small-box-footer">Xem thêm <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>{{ $numberContact }}</h3>

                                <p>Tổng số liên hệ</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-pie-graph"></i>
                            </div>
                            <a href="{{ route('contact.index') }}" class="small-box-footer">Xem thêm <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box btn-primary">
                            <div class="inner">
                                <h3>{{ $numberSupplier }}</h3>

                                <p>Tổng số nhà cung cấp</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-paper-airplane"></i>
                            </div>
                            <a href="{{ route('supplier.index') }}" class="small-box-footer">Xem thêm <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title">Dữ liệu đơn hàng</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div class="row">

                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>{{ $orderSuccess }}</h3>

                                <p>Đơn hàng đã giao</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                            <a href="{{ route('order.index', ['menu' => 'success', 'status' => 3]) }}" class="small-box-footer">Xem thêm <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                    <!-- small box -->
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>{{ $orderCanGiao }}</h3>

                                <p>Đơn hàng cần giao</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                            <a href="{{ route('order.index', ['menu' => 'success', 'status' => 1]) }}" class="small-box-footer">Xem thêm <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box btn-primary">
                            <div class="inner">
                                <h3>{{ $orderDangGiao }}</h3>

                                <p>Đơn hàng đang giao</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                            <a href="{{ route('order.index', ['menu' => 'success', 'status' => 2]) }}" class="small-box-footer">Xem thêm <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>{{ $orderHuy }}</h3>

                                <p>Đơn bị hủy</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                            <a href="{{ route('order.index', ['menu' => 'success', 'status' => 4]) }}" class="small-box-footer">Xem thêm <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box btn-secondary">
                            <div class="inner">
                                <h3>{{ $orderKhongNhan }}</h3>

                                <p>Đơn hàng khách không nhận</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                            <a href="{{ route('order.index', ['menu' => 'success', 'status' => 5]) }}" class="small-box-footer">Xem thêm <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title">Thống kê doanh thu</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3 style="font-size: 20px;">{{ number_format($totalMoneyDay) }}</h3>

                                <p>Doanh thu ngày {{ Request::get('select_day') ? Request::get('select_day') : date('d') }}</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-pie-graph"></i>
                            </div>
                            <a href="" class="small-box-footer">vnđ</a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3 style="font-size: 20px;">{{ number_format($totalMoneyMonth) }}</h3>

                                <p>Doanh thu tháng {{ Request::get('select_month') ? Request::get('select_month') : date('m') }}</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-pie-graph"></i>
                            </div>
                            <a href="" class="small-box-footer">vnđ</a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3 style="font-size: 20px;">{{ number_format($totalMoneyYear) }}</h3>

                                <p>Doanh thu năm {{ Request::get('select_year') ? Request::get('select_year') : date('Y') }}</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-pie-graph"></i>
                            </div>
                            <a href="" class="small-box-footer">vnđ</a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box btn-primary">
                            <div class="inner">
                                <h3 style="font-size: 20px;">{{ number_format($totalMoney) }}</h3>

                                <p>Tổng số doanh số</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-pie-graph"></i>
                            </div>
                            <a href="" class="small-box-footer">vnđ</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div><!--/. container-fluid -->
</section>
@endsection
