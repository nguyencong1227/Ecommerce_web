<!DOCTYPE html>
<html>
<!-- header s -->
@include('backend.layouts.header')
<!-- header end -->
<body class="hold-transition sidebar-mini layout-fixed">
	<div class="wrapper">
		<!-- nav s -->
		@include('backend.layouts.nav')
		<!-- nav e -->
		<!-- menu s -->
		@include('backend.layouts.menu')
		<!-- menu e -->
		<!-- Content s -->
		<div class="content-wrapper" style="margin-left: 300px">
			@yield('content')
		</div>
		<!-- Content e -->
		<!-- Control Sidebar -->
		<aside class="control-sidebar control-sidebar-dark">
		<!-- Control sidebar content goes here -->
		</aside>
		<!-- /.control-sidebar -->
		<!-- footer s -->
		@include('backend.layouts.footer')
		<!-- footer e -->
	</div>
	<!-- script s -->
	@include('backend.layouts.script')
	<!-- script e -->
</body>
</html>