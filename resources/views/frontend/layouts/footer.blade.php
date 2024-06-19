<footer class="footer-wrap">
    <div class="container f-menu-list">
        <div class="row">
            <div class="f-menu">
                <a href="index.html">
                    <img src="{{ asset('frontend_asset/img/logo.png') }}" alt="AllStore - MultiConcept eCommerce Responsive HTML5 Template">
                    </br> Thương hiệu thời trang mẹ và bé nổi tiếng nhất việt nam Việt Nam
                    </br></br>
                </a>
                <table>
                    <tbody>
                        @if (isset($infor['email']))
                            <tr>
                                <td>{{ $infor['email']['title'] . ' : '}}</td>
                                <td>{!! $infor['email']['content'] !!}</td>
                            </tr>
                        @endif
                        @if (isset($infor['hotline']))
                            <tr>
                                <td>{{ $infor['hotline']['title'] . ' : '}}</td>
                                <td>{!! $infor['hotline']['content'] !!}</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
            <div class="f-menu">
                <h3>
                    Trợ Giúp và Tư Vấn
                </h3>
                <ul class="nav nav-pills nav-stacked">
                    @if (isset($infor['gioi-thieu']))
                    <li>
                        <a href="{{ route('client.about') }}">
                            {{ $infor['gioi-thieu']['title'] }}
                        </a>
                    </li>
                    @endif
                    @if (isset($infor['chinh-sach-giao-hang']))
                    <li>
                        <a href="{{ route('client.shopping_guide') }}">
                            {{ $infor['chinh-sach-giao-hang']['title'] }}
                        </a>
                    </li>
                    @endif
                    @if (isset($infor['chinh-sach-doi-hang']))
                    <li>
                        <a href="{{ route('client.policy') }}">
                            {{ $infor['chinh-sach-doi-hang']['title'] }}
                        </a>
                    </li>
                    @endif
                    <li>
                        <a href="{{ route('client.contact_create') }}">
                            Liên hệ
                        </a>
                    </li>
                </ul>
            </div>
            <div class="f-menu">
                <h3>
                    Pages
                </h3>

            </div>
            <div class="f-menu">
                <h3>
                    Google Map
					
                </h3>
                <ul class="nav nav-pills nav-stacked">
                    <li>

                    </li>
                </ul>
            </div>

        </div>
    </div>
</footer>