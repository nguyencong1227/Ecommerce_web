<!-- jQuery -->
<script src="{{ asset('backend_asset/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap -->
<script src="{{ asset('backend_asset/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE -->
<script src=" {{ asset('backend_asset/js/adminlte.js') }}"></script>
<script src=" {{ asset('backend_asset/plugins/select2/dist/js/select2.js') }}"></script>
<!-- OPTIONAL SCRIPTS -->
<script src=" {{ asset('backend_asset/js/main.js') }}"></script>
<script>
    $(function () {
        $(".input_select2") .select2();
    })
</script>
@yield('js-custom.script')