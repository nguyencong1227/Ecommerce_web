<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <!-- header s -->
@include('../backend.layouts.header')
<!-- header e -->
</head>
<body class="login-page" >
<div class="login-box">
  <div class="login-logo">
    <a href="{{ url('/') }}">Login</a>
  </div>
  <div class="card">
    <div class="card-body login-card-body">
      @yield('content')
    </div>
  </div>
</div>
</body>
<!-- script s -->
@include('backend.layouts.script')
<!-- script e -->
</html>
