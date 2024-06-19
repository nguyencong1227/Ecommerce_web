<div class="header-middle">
    <div class="container header-middle-cont">
        <div class="toplogo">
            <a href="{{ route('client.home') }}">
                <img src="{{ asset('frontend_asset/img/logo.png') }}" alt="AllStore - MultiConcept eCommerce Template">
            </a>
        </div>
        <div class="shop-menu">
            <ul>

                <li class="topauth">
                    @if (\Auth::guard('nd')->user())
                        <a href="{{ route('info.user') }}">Xin chào {{ \Auth::guard('nd')->user()->Ten }}</a>
                        <a href="{{ route('get.user.logout') }}">Đăng xuất</a>
                    @else
                        <a href="{{ route('get.user.register') }}">
                            <i class="fa fa-lock"></i>
                            <span class="shop-menu-ttl">Đăng ký</span>
                        </a>
                        <a href="{{ route('get.user.login') }}">
                            <span class="shop-menu-ttl">Đăng nhập</span>
                        </a>
                    @endif
                </li>

                <li>
                    <div class="h-cart">
                        <a href="{{ route('get.shopping.list') }}">
                            <i class="fa fa-shopping-cart"></i>
                            <span class="shop-menu-ttl">Giỏ hàng</span>
                            (<b id="total-cart">{{ \Cart::count() }}</b>)
                        </a>
                    </div>
                </li>

            </ul>
        </div>
    </div>
</div>
