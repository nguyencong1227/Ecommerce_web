<!DOCTYPE html>
<html>
	<!-- header s -->
	@include('frontend.layouts.header')
	<!-- header end -->
	<body>
		<header class="header">
			<!-- nav s -->
			@include('frontend.layouts.nav')
			<!-- nav e -->
			<!-- menu s -->
			@include('frontend.layouts.menu')
			<!-- menu e -->
		</header>
		<!-- Content s -->
		@yield('content')
		<!-- Content e -->
		<!-- footer s -->
		@include('frontend.layouts.footer')
		<!-- footer e -->
		<!-- script s -->
		@include('frontend.layouts.script')
        @yield('script')
		<!-- script e -->
	</body>
</html>
