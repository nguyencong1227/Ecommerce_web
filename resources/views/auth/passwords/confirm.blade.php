@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <!-- Card bắt đầu -->
            <div class="card">
                <!-- Tiêu đề của thẻ -->
                <div class="card-header">{{ __('Confirm Password') }}</div>

                <div class="card-body">
                    <!-- Thông báo cho người dùng xác nhận mật khẩu -->
                    {{ __('Please confirm your password before continuing.') }}

                    <!-- Form để xác nhận mật khẩu -->
                    <form method="POST" action="{{ route('password.confirm') }}">
                        @csrf <!-- Token CSRF để bảo vệ form -->

                        <!-- Trường nhập mật khẩu -->
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <!-- Input cho mật khẩu, bao gồm kiểm tra lỗi -->
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                <!-- Hiển thị thông báo lỗi nếu có lỗi -->
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Nút xác nhận mật khẩu và liên kết quên mật khẩu -->
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <!-- Nút gửi form -->
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Confirm Password') }}
                                </button>

                                <!-- Liên kết đến trang yêu cầu đặt lại mật khẩu nếu người dùng quên mật khẩu -->
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Card kết thúc -->
        </div>
    </div>
</div>
@endsection
