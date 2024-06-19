@extends('backend.layouts.app')
@section('title') Thông tin shop @endsection
@section('content')
    <section class="content">
        <div class="container-fluid">
            <!-- Main row -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <!-- /.card-header -->
                        <div class="card-header">
                            <h3 class="card-title">Thông tin Shop</h3>

                            <div class="card-tools">
                                <a class="btn btn-success btn-sm" href="{{ route('information.create') }}"><span
                                    class="fas fa-plus"></span> Thêm mới </a>
                            </div>
                            <div class="form-search">
                                <form class="form-inline" action="{{ route('information.index') }}" method="get">
                                  <div class="form-row align-items-center margin-auto">
                                    <div class="form-group mr-2 mb-2">
                                      <label for="title" class="sr-only">Tên thông tin</label>
                                      <input type="text" name="title" value="{{ $request->get('title') }}" class="form-control" id="title"
                                             placeholder="Tên thông tin">
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
                                    <th>Tiêu đề</th>
                                    <th>Hành động</th>
                                </tr>
                                </thead>
                                <tbody>        
                                @if (!$informations->isEmpty())
                                    @php $i = 1 @endphp
                                    @foreach($informations as $info)
                                        <tr>
                                            {{--<td>{{ $i }}</td>--}}
                                            <td>{{ $info->id }}</td>
                                            <td>{{ $info->TieuDe }}</td>
                                            <td>
                                                <a class="btn btn-primary btn-sm" href="{{ route('information.edit', $info->id) }}">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </a>
                                                <a id="{{$info->id}}" class="btn btn-danger btn-sm btn-delete" href="#">
                                                    <i class="fas fa-trash"></i>
                                                    <form method="post" action="{{ route('information.destroy', $info->id) }}"
                                                          id="form_{{$info->id}}">
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
                        @if($informations->hasPages())
                          <div class="pagination text-center mb-4">
                            {{ $informations->links() }}
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
