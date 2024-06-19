<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Hóa đơn </title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="shortcut icon" href="{{ asset('admin\images\icons\admin_icon.png')}}" type="image/x-icon"/>
    <link rel="stylesheet" href="{{ asset('/frontend_asset/css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('frontend_asset/css/AdminLTE.css')}}">

</head>
<body>
<div class="container">
    <div class="wrapper">
        <section class="invoice">
            <!-- title row -->
            <div class="row">
                <div class="col-xs-12">
                    <h2 class="page-header">
                        <a href="{{ route('client.home') }}"><i class="fa fa-globe"></i></a>
                        <span style="margin-left: 29%; font-size: 36px; font-weight: bold;"> </span>
                        <small class="pull-right">Date: <?php echo  date("Y/m/d"); ?></small>
                    </h2>
                </div>
                <!-- /.col -->
            </div>
            <!-- info row -->
            <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                    <strong>Địa chỉ shop </strong><br>
                    <address>
                        <strong>Thời Trang Nam</strong><br>
                        Địa chỉ<br>
                        Địa chỉ<br>
                        Phone:  <br>
                        Email:
                    </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                    <strong>Địa chỉ người nhận hàng </strong>
                    @if($infoUser)
                        <address>
                            @if (!$infoUser->donated)
                                <strong>{{$infoUser->user->Ten ?? ""}}</strong><br>
                                Địa chỉ: {{ $infoUser->user->DiaChi ?? "" }}<br>
                                Phone: {{$infoUser->user->SDT ?? ""}}<br>
                                Email: {{$infoUser->user->email ?? ""}}<br>
                            @else
                                <strong>{{$infoUser->donated->Ten ?? ""}}</strong><br>
                                Địa chỉ: {{ $infoUser->donated->DiaChi ?? "" }}<br>
                                Phone: {{$infoUser->donated->SDT ?? ""}}<br>
                                Email: {{$infoUser->donated->email ?? ""}}<br>
                            @endif
                            Mã đơn hàng : {{$infoUser->id}}
                        </address>
                    @endif
                </div>
                <div class="col-sm-4 invoice-col">
                    <strong>
                        Trạng thái đơn hàng : {{$status[$infoUser->TrangThai]}}
                    </strong><br>
                    <strong>
                        Ngày giao hàng : {{$infoUser->NgayGiao}}
                    </strong><br>
                    <strong>Ghi chú : </strong>
                    <address>
                        {{$infoUser->GhiChu ? $infoUser->GhiChu : ''}}
                    </address>
                </div>
            </div>
            <!-- /.row -->
            <!-- Table row -->
            <div class="row">
                <div class="col-xs-12 table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Stt</th>
                            <th>Sản phẩm</th>
                            <th>SỐ lượng</th>
                            <th>Size</th>
                            <th>Giá tiền</th>
                            <th>Thành tiền</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if (!$orders->isEmpty())
                            @php $i = 1; $total = 0; @endphp
                            @foreach($orders as $item)
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ $item->product->Ten ?? "" }}</td>
                                    <td>{{ $item->SoLuong }}</td>
                                    <td>{{ $item->size }}</td>
                                    <td>{{ number_format($item->product->Gia ?? 0,0,',','.') }} VNĐ</td>
                                    <td>{{ number_format($item->SoLuong * $item->product->Gia ?? 0,0,',','.') }} VNĐ</td>
                                </tr>
                                @php
                                    $i++;
                                    $total = $item->SoLuong * $item->product->Gia + $total;
                                @endphp
                            @endforeach
                            {{--<tr>--}}
                                {{--<td colspan="4" class="text-center" style="color: red">Tổng tiền </td>--}}
                                {{--<td colspan="1" style="color: red"></td>--}}
                            {{--</tr>--}}
                        @endif
                        </tbody>
                    </table>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
            <div class="row">
                <!-- accepted payments column -->
                <!-- /.col -->
                <div class="col-xs-6">
                    <p class="lead">Số tiền phải trả </p>
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                            <tr>
                                <th style="width:50%">Tổng tiền:</th>
                                <td>{{ number_format($total ?? 0,0,',','.') }} VNĐ</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.col -->
            </div>
            <div class="row" style="margin-top: 50px;margin-bottom: 50px;">
                <div class="col-xs-6 text-center">
                    <p style="font-weight: bold;font-size: 16px;">Người giao hàng</p>
                    <p style="font-size: 13px;">(Ký ghi rõ họ tên)</p>
                    <p>
                        @if($infoUser->user_shiper)
                            {{ $infoUser->user_shiper->Ten }}
                        @endif
                    </p>
                </div>
                <div class="col-xs-6 text-center">
                    <p style="font-weight: bold;font-size: 16px;">Khách hàng</p>
                    <p style="font-size: 13px;">(Ký ghi rõ họ tên)</p>
                    @if($infoUser)
                        <p>{{ $infoUser->Ten }}</p>
                    @endif
                </div>
            </div>
            <!-- /.row -->
            <!-- this row will not appear when printing -->
            <div class="row no-print">
                <div class="col-xs-12">
                    <a href="#" target="_blank" onClick="window.print();" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
                </div>
            </div>
        </section>
    </div>
</div>
</body>