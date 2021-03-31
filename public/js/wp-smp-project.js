(function( $ ) {
	'use strict';

    $('aside').remove();

    $('.wpsmp-project').on('mouseover', function () {
        $(this).children().find('.wpsmpover').show();
    });
    $('.wpsmp-project').on('mouseout', function () {
        $(this).children().find('.wpsmpover').hide();
    });

    $('.wpsmp-likebtn').on('click', function (e) {
        e.preventDefault();
    });

})( jQuery );