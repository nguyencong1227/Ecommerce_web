@extends('backend.layouts.app')
@section('title') Danh sách đơn hàng @endsection
@section('content')
    <section class="content">
        <div class="container-fluid">
            <!-- Main row -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <!-- /.card-header -->
                        <div class="card-header">
                            <h3 class="card-title">
                            @if($status_order == 1)
                                Danh sách đơn hàng cần giao
                            @elseif($status_order == 3)
                                Danh sách đơn hàng đã giao
                            @else
                                Danh sách đơn hàng khách không nhận
                            @endif
                            </h3>
                        </div>
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                <tr>
                                    {{--<th>Stt</th>--}}
                                    <th>ID</th>
                                    <th>Tên KH</th>
                                    <th style="width: 200px !important;">Địa chỉ</th>
                                    <th>Số điện thoại</th>
                                    <th>Tổng tiền</th>
                                    <th>Chi tiết</th>
                                    <th>Ngày tạo</th>
                                    <th>Trạng thái</th>
                                    <th>Người giao</th>
                                    <th>Hóa đơn</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if (!$orders->isEmpty())
                                    @php $i = 1 @endphp
                                    @foreach($orders as $item)
                                        <tr>
                                            {{--<td>{{ $i }}</td>--}}
                                            <td>{{ $item->id }}</td>
                                            <td>{{ $item->user->Ten ?? "" }}</td>
                                            <td style="width: 200px !important;">
                                                <p>
                                                    {{ isset($item->user->DiaChi)? $item->user->DiaChi :  $item->user->DiaChi}}
                                                </p>
                                            </td>
                                            <td>{{ isset($item->user->SDT)? $item->user->SDT :  $item->user->SDT}}</td>
                                            <td>{{ number_format($item->TongTien,0,',','.') }} VNĐ</td>
                                            <td><a target="_blank" href="{{ route('order.show', $item->id) }}">Chi tiết</a></td>
                                            <td>{{ $item->NgayTao }}</td>
                                            <td>
                                                @if($status_order == 1 || $status_order == 2)
                                                    <select name="status_order" class="update_status_order">
                                                        @foreach($status as $key => $value)
                                                            @if($status_order == 1 && ($key == 1 || $key == 2 || $key == 3|| $key == 5))
                                                                <option value="{{ $key }}" {{ $item->TrangThai == $key ? 'selected="selected"' : '' }}>{{ $value }}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                    <button type="button" class="btn btn-primary btn-xs btn-change-status" style="width: 50px" url="{{ route('order.update.status', $item->id) }}" >Lưu</button>
                                                @else 
                                                    <div style="color:red"> {{$status[$status_order]}}</div>
                                                @endif
                                            </td>

                                            <td>
                                                {{ $item->user_shiper->Ten ?? "" }}
                                            </td>
                                            <td class="billing"><a href="{{route('billing', $item->id)}}" title="Hóa đơn"><i class="fas fa-file-alt"></i></a></td>
                                        </tr>
                                        @php $i++ @endphp
                                    @endforeach
                                 @endif
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        @if($orders->hasPages())
                          <div class="pagination text-center mb-4">
                            {{ $orders->links() }}
                          </div>
                        @endif
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
    @include('backend.common.modal_delete', ['messageConfirm' => 'Bạn có muốn xóa'])
@endsection
@section('js-custom.script')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(function () {
            $('.btn-change-status').click(function () {
                var url = $(this).attr('url');
                var status = $(this).parent().find('.update_status_order').val();

                $.ajax({
                    url: url,
                    method: 'POST',
                    type:'json',
                    data: {
                        status : status,
                    }
                }).done(function( results ) {
                    console.log(results)
                    alert('Cập nhật trạng thái thành công !!!')
                    var curentUrrl = window.location.href;
                    window.location.href = curentUrrl
                }).fail(function( jqXHR, textStatus ) {
                    console.log(jqXHR)
                });
            });
        })
    </script>
@endsection