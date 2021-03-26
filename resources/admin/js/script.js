(function($) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
    });

    $(function() {

        //admin panel menu toggle
        $("#menu-toggle").click(function(e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled");
        });

        $('.js-modal-image').on('click', function(e){
            var $target = $(e.target);
            var $thumbnail_name = $('.thumbnail_name');
            var image_name = $target.attr('alt');
            $thumbnail_name.val(image_name);
            var $labelImage = $('.label-main-image');
            $labelImage.html('<img src="' + $target.attr('src') + '" alt="">')
        });

    });//document ready

})(jQuery);
