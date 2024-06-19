@extends('backend.layouts.app')
@section('title') Liên hệ từ khách hàng @endsection
@section('content')
    <section class="content">
        <div class="container-fluid">
            <!-- Main row -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <!-- /.card-header -->
                        <div class="card-header">
                            <h3 class="card-title">Liên hệ từ khách hàng</h3>
                            <div class="form-search">
                                <form class="form-inline" action="{{ route('contact.index') }}" method="get">
                                  <div class="form-row align-items-center margin-auto">
                                    <div class="form-group mr-2 mb-2">
                                      <label for="name" class="sr-only">Tên khách hàng</label>
                                      <input type="text" name="name" value="{{ Request::get('name') }}" class="form-control" id="name"
                                             placeholder="Tên khách hàng">
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
                                    <th>Email</th>
                                    <th>Nội dung</th>
                                    <th>Hành động</th>
                                </tr>
                                </thead>
                                <tbody>        
                                @if (!$contacts->isEmpty())
                                    @php $i = $contacts->firstItem() @endphp
                                    @foreach($contacts as $conta)
                                        <tr>
                                            {{--<td>{{ $i }}</td>--}}
                                            <td>{{$conta->id }}</td>
                                            <td>{{ $conta->Ten }}</td>
                                            <td>{{ $conta->email }}</td>
                                            <td>{{ $conta->NoiDung }}</td>
                                            <td>
                                                <a id="{{$conta->id}}" class="btn btn-danger btn-sm btn-delete" href="#">
                                                    <i class="fas fa-trash"></i>
                                                    <form method="post" action="{{ route('contact.destroy', $conta->id) }}"
                                                          id="form_{{$conta->id}}">
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
                        @if($contacts->hasPages())
                          <div class="pagination text-center mb-4">
                            {{ $contacts->links() }}
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
