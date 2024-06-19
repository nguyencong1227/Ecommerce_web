<script src="{{ asset('frontend_asset/js/jquery-1.11.2.min.js') }}"></script>
<script src="{{ asset('frontend_asset/js/jquery.bxslider.min.js') }}"></script>
<script src="{{ asset('frontend_asset/js/fancybox/fancybox.js') }}"></script>
<script src="{{ asset('frontend_asset/js/fancybox/helpers/jquery.fancybox-thumbs.js') }}"></script>
<script src="{{ asset('frontend_asset/js/jquery.flexslider-min.js') }}"></script>
<script src="{{ asset('frontend_asset/js/swiper.jquery.min.js') }}"></script>
<script src="{{ asset('frontend_asset/js/jquery.waypoints.min.js') }}"></script>
<script src="{{ asset('frontend_asset/js/progressbar.min.js') }}"></script>
<script src="{{ asset('frontend_asset/js/ion.rangeSlider.min.js') }}"></script>
<script src="{{ asset('frontend_asset/js/chosen.jquery.min.js') }}"></script>
<script src="{{ asset('frontend_asset/js/jQuery.Brazzers-Carousel.js') }}"></script>
<script src="{{ asset('frontend_asset/js/plugins.js') }}"></script>
<script src="{{ asset('frontend_asset/js/main.js') }}"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDhAYvx0GmLyN5hlf6Uv_e9pPvUT3YpozE"></script>
<script src="{{ asset('frontend_asset/js/gmap.js') }}"></script>
<script>
    $(function () {
        $('.prod-add').click(function (event) {
            event.preventDefault();
            var url = $(this).attr('href');
            var qty = 1;
            var size = '';
            if ($('.qty').val() !== undefined) {
                qty = $('.qty').val();
            }
            if ($('#size') !== undefined) {
                size = $('#size').val();
            }

            $.ajax({
                url: url,
                method: 'GET',
                type:'json',
                data: {
                    qty : qty,
                    size : size
                }
            }).done(function( results ) {
                if (results.code == 1) {
                    $('#total-cart').html(results.total)
                    alert('Thêm sản phẩm thành công');
                } else {
                    alert('Số lượng sản phẩm trong kho không đủ');
                }
            });
        })
        @if(session('success'))
            var message = '<?= session('success') ?>'
            alert(message);
        @endif
        @if(session('danger'))
            var message = '<?= session('danger') ?>'
            alert(message);
        @endif
    })
</script>

@yield('js-custom.script')
