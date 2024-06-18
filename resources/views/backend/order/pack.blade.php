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
                            @if($status_order == 0)
                                Danh sách đơn hàng đang đóng gói
                            @elseif($status_order == 1)
                                Danh sách đơn hàng đã đóng gói
                            @else
                                Danh sách đơn hàng khách không nhận
                            @endif</h3>
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
                                    @if($status_order == 5 || $status_order == 4)
                                        <th>Hủy</th>
                                    @endif
                                    @if($status_order == 3)
                                        <th>Xác Nhận</th>
                                    @endif
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
                                                @if($status_order == 0)
                                                    <select name="status_order" class="update_status_order">
                                                        @foreach($status as $key => $value)
                                                            @if($key == 0 || $key == 1)
                                                                <option value="{{ $key }}" 
                                                                    @if($item->TrangThai == $key) selected="selected" @endif
                                                                    >{{ $value }}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                    <button type="button" class="btn btn-primary btn-xs btn-change-shiper" style="width: 50px" url="{{ route('order.update.status', $item->id) }}" >Lưu</button>
                                                @elseif($status_order == 1)
                                                    <div style="color:red"> {{$status[1]}}</div>
                                                @elseif($status_order == 3)
                                                    <div style="color:red"> {{$status[3]}}</div>
                                                @else 
                                                    <div style="color:red"> {{$status[5]}}</div>
                                                @endif
                                            </td>

                                            <td>
                                                {{ $item->user_shiper->Ten ?? "" }}
                                            </td>
                                            <td class="billing"><a href="{{route('billing', $item->id)}}" title="Hóa đơn"><i class="fas fa-file-alt"></i></a></td>
                                            @if($item->TrangThai == 5 || $item->TrangThai == 4)
                                                <td>
                                                    @if($item->TrangThai == 5)
                                                        <a id="{{$item->id}}" class="btn btn-danger btn-sm btn-delete" href="#">
                                                            <i class="fas fa-trash"></i> Hủy
                                                            <form method="post" action="{{ route('order.cancel', $item->id) }}"
                                                                  id="form_{{$item->id}}">
                                                                @csrf
                                                                @method('DELETE')
                                                            </form>
                                                        </a>
                                                    @else 
                                                    <div style="color:red">
                                                        Đã Hủy
                                                    </div>
                                                    @endif
                                                </td>
                                            @endif
                                            @if($status_order == 3)
                                                <td><a href="{{ route('order.update.confirm', $item->id) }}">Xác nhận</a></td>
                                            @endif
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
            $('.btn-change-shiper').click(function () {
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
                    alert('Cập nhật trạng thái thành công !!!')
                    var curentUrrl = window.location.href;
                    window.location.href = curentUrrl
                });
            });
        })
    </script>
@endsection