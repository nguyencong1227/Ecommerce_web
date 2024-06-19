@extends('backend.layouts.app')
@section('title') Danh sách nhà cung cấp @endsection
@section('content')
    <section class="content">
        <div class="container-fluid">
            <!-- Main row -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <!-- /.card-header -->
                        <div class="card-header">
                            <h3 class="card-title">Danh sách nhà cung cấp</h3>

                            <div class="card-tools">
                                <a class="btn btn-success btn-sm" href="{{ route('supplier.create') }}"><span
                                    class="fas fa-plus"></span> Thêm mới </a>
                            </div>
                            <div class="form-search">
                                <form class="form-inline" action="{{ route('supplier.index') }}" method="get">
                                  <div class="form-row align-items-center margin-auto">
                                    <div class="form-group mr-2 mb-2">
                                      <label for="name" class="sr-only">Tên Nhà cung cấp</label>
                                      <input type="text" name="name" value="{{ $request->get('name') }}" class="form-control" id="name"
                                             placeholder="Tên nhà cung cấp">
                                    </div>
                                    <button type="submit" class="btn-search btn btn-primary mb-2"><span
                                          class="fas fa-search"></span> Tìm kiếm </button>
                                  </div>
                                </form>
                            </div>
                        </div>
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap ">
                                <thead>
                                <tr>
                                    {{--<th>Stt</th>--}}
                                    <th>ID</th>
                                    <th>Tên</th>
                                    <th>Địa chỉ</th>
                                    <th>Số điện thoại</th>
                                    <th>Email</th>
                                    <th>Hành động</th>
                                </tr>
                                </thead>
                                <tbody>        
                                @if (!$suppliers->isEmpty())
                                    @php $i = $suppliers->firstItem() @endphp
                                    @foreach($suppliers as $sup)
                                        <tr>
                                            {{--<td>{{ $i }}</td>--}}
                                            <td>{{ $sup->id }}</td>
                                            <td>{{ $sup->Ten }}</td>
                                            <td>{{ $sup->DiaChi }}</td>
                                            <td>{{ $sup->SDT }}</td>
                                            <td>{{ $sup->email }}</td>
                                            <td>
                                                <a class="btn btn-primary btn-sm" href="{{ route('supplier.edit', $sup->id) }}">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </a>
                                                <a id="{{$sup->id}}" class="btn btn-danger btn-sm btn-delete" href="#">
                                                    <i class="fas fa-trash"></i>
                                                    <form method="post" action="{{ route('supplier.destroy', $sup->id) }}"
                                                          id="form_{{$sup->id}}">
                                                      @csrf
                                                      @method('DELETE')
                                                    </form>
                                                </a>
                                            </td>
                                        </tr>
                                        @php $i++ @endphp
                                    @endforeach
                                 @endif
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        @if($suppliers->hasPages())
                          <div class="pagination text-center mb-4">
                            {{ $suppliers->links() }}
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
