@extends('backend.layouts.app')
@section('title') Danh sách loại sản phẩm @endsection
@section('content')
    <section class="content">
        <div class="container-fluid">
            <!-- Main row -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <!-- /.card-header -->
                        <div class="card-header">
                            <h3 class="card-title">Danh sách loại sản phẩm</h3>

                            <div class="card-tools">
                                <a class="btn btn-success btn-sm" href="{{ route('category_product.create') }}"><span
                                    class="fas fa-plus"></span> Thêm mới </a>
                            </div>
                            <div class="form-search">
                                <form class="form-inline" action="{{ route('category_product.index') }}" method="get">
                                  <div class="form-row align-items-center margin-auto">
                                    <div class="form-group mr-2 mb-2">
                                      <label for="name" class="sr-only">Tên thể loại</label>
                                      <input type="text" name="name" value="{{ $request->get('name') }}" class="form-control" id="name"
                                             placeholder="Tên thể loại">
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
                                    <th>Thể loại cha</th>
                                    <th>Hiển thị</th>
                                    <th>Hành động</th>
                                </tr>
                                </thead>
                                <tbody>        
                                @if (!$categoryProduct->isEmpty())
                                    @php $i = $categoryProduct->firstItem() @endphp
                                    @foreach($categoryProduct as $category)
                                        <tr>
                                            {{--<td>{{ $i }}</td>--}}
                                            <td>{{ $category->id }}</td>
                                            <td>{{ $category->ten }}</td>
                                            <td><?php echo $category->category_product_parent ? $category->category_product_parent->ten : '' ?></td>
                                            <td>
                                                <span class="badge bg-success">
                                                    @if ($category->TrangThai)
                                                        Có
                                                    @else
                                                        Không
                                                    @endif
                                                </span>
                                            </td>
                                            <td>
                                                <a class="btn btn-primary btn-sm" href="{{ route('category_product.edit', $category->id) }}">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </a>
                                                <a id="{{$category->id}}" class="btn btn-danger btn-sm btn-delete" href="#">
                                                    <i class="fas fa-trash"></i>
                                                    <form method="post" action="{{ route('category_product.destroy', $category->id) }}"
                                                          id="form_{{$category->id}}">
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
                        @if($categoryProduct->hasPages())
                          <div class="pagination text-center mb-4">
                            {{ $categoryProduct->links() }}
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
