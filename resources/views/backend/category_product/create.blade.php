@extends('backend.layouts.app')
@section('title') Danh mục sản phẩm @endsection
@section('content')
    <section class="content">
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Thêm mới</h3>

            </div>
            <div class="card-body">
                <form method="POST" action="{{route('category_product.store')}}" accept-charset="UTF-8" class="form-horizontal">
                    @csrf
                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Tên <span class="note">*</span></label>

                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="name" id="name" value="{{old('name')}}">
                            @if ($errors && $errors->has('name'))
                                <p class="text-danger text-xs error-message">{{ $errors->first('name') }}</p>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Thể loại cha</label>
                        <div class="input-group date col-sm-4">
                            <select name="parent_id" id="parent_id" value="{{old('parent_id')}}" class="form-control">
                                <option value="">Thể loại cha</option>
                                @foreach($categoryProduct as $categories)
                                    <option value="{{$categories->id}}">{{$categories->ten}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Hiển thị</label>

                        <div class="col-sm-10">
                            <input name="status" type="checkbox" id="active" /> Hiển thị
                        </div>
                    </div>

                    <!-- <div class="form-group row"> -->
                        <div class="form-group row">
                            <div class="col-sm-2">
                            </div>
                            <div class="col-sm-1">
                                <button class="btn btn-default float-left"><a style="color:black" href="{{ route('category_product.index') }}">Hủy</a></button>
                            </div>
                            <div class="col-sm-1">
                                <button type="submit" class="btn btn-info">Tạo mới</button>
                            </div>
                        </div>
                    <!-- </div> -->
                </form>
            </div>
        </div>
        <!-- /.card -->
    </section>
@endsection