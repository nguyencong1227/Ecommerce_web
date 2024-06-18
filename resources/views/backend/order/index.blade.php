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
                            <h3 class="card-title">Danh sách đơn hàng</h3>
                            <div class="form-search">
                                <form class="form-inline" method="get">
                                    <div class="form-row align-items-center margin-auto">
                                        <div class="form-group mr-2 mb-2">
                                            <input type="text" name="name" value="{{ Request::get('name') }}" class="form-control" id="name"
                                                   placeholder="Tên khách hàng">
                                        </div>
                                        <div class="form-group mr-2 mb-2">
                                            <select name="status" id="" class="form-control">
                                                <option value="">Chọn trạng thái</option>
                                                @foreach($status as $key => $statu)
                                                    @if($menu == '')
                                                        @if($key < 3 )
                                                            <option value="{{ $key }}" {{ Request::get('status') == $key ? 'selected="selected"' : '' }}>{{ $statu }}</option>
                                                        @endif
                                                    @else
                                                        @if($key >= 3 && $key <= 5)
                                                            <option value="{{ $key }}" {{ Request::get('status') == $key ? 'selected="selected"' : '' }}>{{ $statu }}</option>
                                                        @endif
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group mr-2 mb-2">
                                            <select name="employee_id" id="" class="form-control">
                                                <option value="">Chọn nhân viên giao</option>
                                                <option value="null">Chưa chọn nhân viên giao</option>
                                                @foreach($shipers as $key => $value)
                                                    <option value="{{ $value->id }}" {{ Request::get('employee_id') == $value->id ? 'selected="selected"' : '' }}>{{ $value->Ten }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @if(!empty($menu))
                                            <input type="hidden" name="menu" value="success">
                                        @endif
                                        <button type="submit" class="btn-search btn btn-primary mb-2"><span
                                                    class="fas fa-search"></span> Lọc </button>
                                    </div>
                                </form>
                            </div>
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
                                    <th>Hành động</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $disableShiper = [3, 4, 5] ?>
                                @if (!$orders->isEmpty())
                                    @php $i = $orders->firstItem() @endphp
                                    @foreach($orders as $item)
                                        <tr>
                                            {{--<td>{{ $i }}</td>--}}
                                            <td>{{ $item->id }}</td>
                                            <td>{{ isset($item->Ten)? $item->Ten :  $item->user->Ten}}</td>
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
                                                <form class="status-form" method="POST" action="{{ route('order.update',$item->id) }}">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="id" value="{{ $item->id }}">
                                                    <select class="form-control status-select" name="status" data-id="{{ $item->id }}">
                                                        @foreach ($status as $key => $value)
                                                            <option value="{{ $key }}" {{ $key == $item->TrangThai ? 'selected' : '' }}>
                                                                {{ $value }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </form>
                                            </td>

                                            <td>
                                                <select name="employee_order" class="update_employee_order" {{ in_array($item->TrangThai, $disableShiper) ? 'disabled' : '' }}>
                                                    <option value="" >-- Chọn shiper --</option>
                                                    @foreach($shipers as $value)
                                                        <option value="{{ $value->id }}" {{ $item->id_NV == $value->id ? 'selected="selected"' : '' }}>{{ $value->Ten }}</option>
                                                    @endforeach
                                                </select>
                                                <button type="button" class="btn btn-primary btn-xs btn-change-shiper" style="width: 50px" url="{{ route('order.shiper.status', $item->id) }}" >Lưu</button>
                                            </td>
                                            <td class="billing"><a href="{{route('billing', $item->id)}}" title="Hóa đơn"><i class="fas fa-file-alt"></i></a></td>
                                            @if(!in_array($item->status, $disableShiper))
                                            <td>
                                                <a id="{{$item->id}}" class="btn btn-danger btn-sm btn-delete" href="#">
                                                    <i class="fas fa-trash"></i> Xóa
                                                    <form method="post" action="{{ route('order.destroy', $item->id) }}"
                                                          id="form_{{$item->id}}">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                </a>
                                            </td>
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
                            {!! $orders->appends($query)->links() !!}
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
                var shiperId = $(this).parent().find('.update_employee_order').val();

                $.ajax({
                    url: url,
                    method: 'POST',
                    type:'json',
                    data: {
                        shiperId : shiperId,
                    }
                }).done(function( results ) {
                    alert('Cập nhật shiper thành công !!!')
                    var curentUrrl = window.location.href;
                    window.location.href = curentUrrl
                });
            });
        })
        document.addEventListener('DOMContentLoaded', function () {
            const statusSelects = document.querySelectorAll('.status-select');

            statusSelects.forEach(select => {
                select.addEventListener('change', function () {
                    const form = this.closest('.status-form');
                    form.submit();
                });
            });
        });
    </script>
@endsection