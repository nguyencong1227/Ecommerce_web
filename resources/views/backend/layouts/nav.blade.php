<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <!-- <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a -->>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
      @if(\Auth::user()->VaiTro == 1)
        <a href="{{ route('product.index') }}" class="nav-link"></a>
      @elseif(\Auth::user()->VaiTro == 2)
        <a href="{{ route('order.pack', 0) }}" class="nav-link"></a>
      @else 
        <a href="{{ route('order.deliver', 1) }}" class="nav-link"></a>
      @endif
    </li>
  </ul>
<!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
    <!-- Notifications Dropdown Menu -->
    <li class="nav-item dropdown">
      <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="fas fa-user-circle"></i>
      </a>
      <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <a href="{{ route('auth.admin.logout') }}" class="dropdown-item">
          <i class="fas fa-sign-out-alt"></i> &nbsp; Logout
        </a>
      </div>
    </li>
  </ul>
</nav>