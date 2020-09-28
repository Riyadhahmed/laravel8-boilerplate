<div class="app-footer">
    <div class="col-12 widget-content bg-premium-dark text-center rounded-top"
    style="bottom: 0; color: #fff; font-weight: bold;padding: 10px;">
    Developed by Riyadh Ahmed || &nbsp; {{date('Y')}}
</div>
</div>
<!-- SlimScroll -->
<script src="{{ asset('assets/js/main.js') }}"></script>
<script src="{{ asset('assets/js/toastr.js') }}"></script>

<script>
    $.fn.modal.Constructor.prototype.enforceFocus = function () {
    };

    setTimeout(function () {
        $('.alert').fadeOut('slow');
    }, 5000); // <-- time in milliseconds
</script>
<script>
    function notify_view(type, message) {
        $.notify({
            message: message
        }, {
            type: type,
            allow_dismiss: true,
            offset: {x: '30', y: '65'},
            spacing: 10,
            z_index: 1031,
            delay: 200,
            animate: {enter: 'animated fadeInDown', exit: 'animated fadeOutUp'}
        });
    }
</script>