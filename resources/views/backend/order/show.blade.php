@extends('backend.layouts.app')
@section('title') Chi tiết đơn hàng @endsection
@section('content')
    <section class="content">
        <div class="container-fluid">
            <!-- Main row -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <!-- /.card-header -->
                        <div class="card-header">
                            <h3 class="card-title">Chi tiết đơn hàng</h3>
                        </div>
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap ">
                                <thead>
                                <tr>
                                    {{--<th>Stt</th>--}}
                                    <th>ID</th>
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
                                            {{--<td>{{ $i }}</td>--}}
                                            <td>{{ $item->id }}</td>
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
                                    <tr>
                                        <td colspan="5" class="text-center" style="color: red">Tổng tiền </td>
                                        <td colspan="1" style="color: red">{{ number_format($total ?? 0,0,',','.') }} VNĐ</td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
    @include('backend.common.modal_delete', ['messageConfirm' => 'Bạn có muốn xóa'])
@endsection