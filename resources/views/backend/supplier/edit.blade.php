@extends('backend.layouts.app')
@section('title') Chỉnh sửa nhà cung cấp @endsection
@section('content')
    <section class="content">
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Chỉnh sửa</h3>

            </div>
            <div class="card-body">
                <form method="POST" action="{{route('supplier.update',$supplier->id)}}" accept-charset="UTF-8" class="form-horizontal">
                    @csrf
                    @method('PATCH')
                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Tên <span class="note">*</span></label>

                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="name" id="name" value="{{ $supplier->Ten }}">
                            @if ($errors && $errors->has('name'))
                                <p class="text-danger text-xs error-message">{{ $errors->first('name') }}</p>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="address" class="col-sm-2 col-form-label">Địa chỉ <span class="note">*</span></label>

                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="address" id="address" value="{{ $supplier->DiaChi }}">
                            @if ($errors && $errors->has('address'))
                                <p class="text-danger text-xs error-message">{{ $errors->first('address') }}</p>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="phone_number" class="col-sm-2 col-form-label">Số điện thoại <span class="note">*</span></label>

                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="phone_number" id="phone_number" value="{{ $supplier->SDT }}">
                            @if ($errors && $errors->has('phone_number'))
                                <p class="text-danger text-xs error-message">{{ $errors->first('phone_number') }}</p>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email" class="col-sm-2 col-form-label">Email <span class="note">*</span></label>

                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="email" id="email" value="{{ $supplier->email }}">
                            @if ($errors && $errors->has('email'))
                                <p class="text-danger text-xs error-message">{{ $errors->first('email') }}</p>
                            @endif
                        </div>
                    </div>

                    <input type="hidden" name="supplier_id" value="{{ $supplier->id }}">

                    <div class="form-group row">
                        <div class="col-sm-2">
                        </div>
                        <div class="col-sm-1">
                            <button class="btn btn-default float-left"><a style="color:black" href="{{ route('supplier.index') }}">Hủy</a></button>
                        </div>
                        <div class="col-sm-2">
                            <button type="submit" class="btn btn-info">Cập nhật</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.card -->
    </section>
@endsection