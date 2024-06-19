<aside class="main-sidebar sidebar-dark-primary elevation-4" style="width:300px !important">
    <!-- Brand Logo -->
    <a href="{{ route('admin.dashboard') }}" class="brand-link">
        <img src="{{ asset('backend_asset/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">AllStore</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('backend_asset/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="{{ route('admin.dashboard') }}" class="d-block">{{Auth::user()->Ten}}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" VaiTro="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->

                @if(Auth::user()->VaiTro == 1)
                    <li class="nav-item has-treeview">
                        <a href="{{ route('category_product.index') }}" class="nav-link">
                            <i class="fas fa-tachometer-alt"></i>
                            <p>Cập nhật thể loại sản phẩm</p>
                        </a>
                    </li>

                    <li class="nav-item has-treeview">
                        <a href="{{ route('product.index') }}" class="nav-link">
                            <i class="fas fa-tachometer-alt"></i>
                            <p>
                                Cập nhật sản phẩm
                            </p>
                        </a>
                    </li>
                @endif
                @if(Auth::user()->VaiTro == 2)
                    <li class="nav-item has-treeview">
                        <a href="{{ route('order.pack', 0) }}" class="nav-link">
                            <i class="fas fa-tachometer-alt"></i>
                            <p>
                                Xem đơn đặt hàng cần đóng gói
                            </p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="{{ route('order.pack', 1) }}" class="nav-link">
                            <i class="fas fa-tachometer-alt"></i>
                            <p>
                                Xem đơn đặt hàng đã đóng gói
                            </p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="{{ route('order.pack', 5) }}" class="nav-link">
                            <i class="fas fa-tachometer-alt"></i>
                            <p>
                                Xem đơn hàng khách không nhận
                            </p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="{{ route('order.pack', 3) }}" class="nav-link">
                            <i class="fas fa-tachometer-alt"></i>
                            <p>
                                Xem danh sách đơn hàng đã giao
                            </p>
                        </a>
                    </li>
                @elseif(Auth::user()->VaiTro == 1)
                    <li class="nav-item has-treeview">
                        <a href="{{ route('order.index') }}" class="nav-link">
                            <i class="fas fa-tachometer-alt"></i>
                            <p>
                                Xử lý đơn hàng
                            </p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="{{ route('order.index', ['menu' => 'success']) }}" class="nav-link">
                            <i class="fas fa-tachometer-alt"></i>
                            <p>
                                Xem danh sách đơn hàng
                            </p>
                        </a>
                    </li>
                @elseif(Auth::user()->VaiTro == 3)
                    <li class="nav-item has-treeview">
                        <a href="{{ route('order.deliver', 1) }}" class="nav-link">
                            <i class="fas fa-tachometer-alt"></i>
                            <p>
                                Xem đơn hàng cần giao
                            </p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="{{ route('order.deliver', 3) }}" class="nav-link">
                            <i class="fas fa-tachometer-alt"></i>
                            <p>
                                Xem đơn hàng đã giao
                            </p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="{{ route('order.deliver', 5)}}" class="nav-link">
                            <i class="fas fa-tachometer-alt"></i>
                            <p>
                                Xem đơn hàng khách không nhận
                            </p>
                        </a>
                    </li>                    
                @endif
                @if(Auth::user()->VaiTro == 1)
                    <li class="nav-item has-treeview">
                        <a href="{{ route('user.index') }}" class="nav-link">
                            <i class="fas fa-tachometer-alt"></i>
                            <p>
                                Quản lý người dùng
                            </p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="{{ route('supplier.index') }}" class="nav-link">
                            <i class="fas fa-tachometer-alt"></i>
                            <p>
                                Cập nhật nhà cung cấp
                            </p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="{{ route('contact.index') }}" class="nav-link">
                            <i class="fas fa-tachometer-alt"></i>
                            <p>
                                Xem liên hệ
                            </p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="{{ route('information.index') }}" class="nav-link">
                            <i class="fas fa-tachometer-alt"></i>
                            <p>
                                Cập nhật thông tin Shop
                            </p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="{{ route('product.create') }}" class="nav-link">
                            <i class="fas fa-tachometer-alt"></i>
                            <p>
                                Nhập Hàng
                            </p>
                        </a>
                    </li>
                @endif
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
