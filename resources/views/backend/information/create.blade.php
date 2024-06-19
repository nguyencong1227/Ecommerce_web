@extends('backend.layouts.app')
@section('title') Thông tin shop @endsection
@section('css-custom.style')
    <link rel="stylesheet" href="{{ asset('backend_asset/plugins/summernote/summernote-bs4.css') }}">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
@endsection
@section('content')
    <section class="content">
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Thêm mới</h3>

            </div>
            <div class="card-body">
                <form method="POST" action="{{route('information.store')}}" accept-charset="UTF-8" class="form-horizontal">
                    @csrf
                    <div class="form-group row">
                        <label for="title" class="col-sm-2 col-form-label">Tiêu đề <span class="note">*</span></label>

                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="title" id="title" value="{{old('title')}}">
                            @if ($errors && $errors->has('title'))
                                <p class="text-danger text-xs error-message">{{ $errors->first('title') }}</p>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="title" class="col-sm-2 col-form-label">Nội dung <span class="note">*</span></label>

                        <div class="col-sm-8 ">
                            <div class="mb-3">
                            <textarea name="contents" class="textarea" placeholder="Place some text here" style="" rows="10">{{old('contents')}}</textarea>
                            </div>
                            @if ($errors && $errors->has('contents'))
                                <p class="text-danger text-xs error-message">{{ $errors->first('contents') }}</p>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-2">
                        </div>
                        <div class="col-sm-1">
                            <button class="btn btn-default float-left"><a style="color:black" href="{{ route('information.index') }}">Hủy</a></button>
                        </div>
                        <div class="col-sm-2">
                            <button type="submit" class="btn btn-info">Tạo mới</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.card -->
    </section>
@endsection
@section('js-custom.script')
<script src="{{ asset('backend_asset/plugins/summernote/summernote-bs4.min.js') }}"></script>
<script>
    (function ($) {
        $('.textarea').summernote({
            height: 200
        });
    })(jQuery)
</script>
@endsection