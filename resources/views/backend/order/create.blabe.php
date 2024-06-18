@extends('backend.layouts.app')
@section('title') Người dùng @endsection
@section('content')
    <section class="content">
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Tạo mới</h3>

            </div>
            <div class="card-body">
                <form method="POST" action="{{route('user.store')}}" accept-charset="UTF-8" class="form-horizontal">
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
                        <label for="email" class="col-sm-2 col-form-label">Email <span class="note">*</span></label>

                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="email" id="email" value="{{old('email')}}">
                            @if ($errors && $errors->has('email'))
                                <p class="text-danger text-xs error-message">{{ $errors->first('email') }}</p>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password" class="col-sm-2 col-form-label">Password <span class="note">*</span></label>

                        <div class="col-sm-4">
                            <input type="password" class="form-control" name="password" id="password" value="{{old('password')}}">
                            @if ($errors && $errors->has('password'))
                                <p class="text-danger text-xs error-message">{{ $errors->first('password') }}</p>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="address" class="col-sm-2 col-form-label">Địa chỉ </label>

                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="address" id="address" value="{{old('address')}}">
                            @if ($errors && $errors->has('address'))
                                <p class="text-danger text-xs error-message">{{ $errors->first('address') }}</p>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="phone_number" class="col-sm-2 col-form-label">Số điện thoại</label>

                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="phone_number" id="phone_number" value="{{old('phone_number')}}">
                            @if ($errors && $errors->has('phone_number'))
                                <p class="text-danger text-xs error-message">{{ $errors->first('phone_number') }}</p>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Vai trò</label>
                        <div class="input-group date col-sm-4">
                            <select name="role" id="role" value="{{old('role')}}" class="form-control">
                                @foreach($roleUser as $key=>$role)
                                    <option value="{{$key}}">{{$role}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Hiển thị</label>

                        <div class="col-sm-10">
                            <input name="active" type="checkbox" id="active" />
                        </div>
                    </div>

                    <!-- <div class="form-group row"> -->
                        <div class="form-group row">
                            <div class="col-sm-2">
                            </div>
                            <div class="col-sm-1">
                                <button class="btn btn-default float-left"><a style="color:black" href="{{ route('user.index') }}">Hủy</a></button>
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