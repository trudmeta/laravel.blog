(function($) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
    });

    $(function() {

        console.log('main page');

    });//document ready

})(jQuery);
