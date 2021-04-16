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

    // Project Load more
    let page = 2;
    $('.load_more_projects').on('click', function () {
        $.ajax({
            type: "post",
            url: my_projects_data.ajax_url,
            data: {
                action: 'wpsmp_wc_project',
                page: page,
                security: my_projects_data.security
            },
            beforeSend: () => {
                $('.load_more_projects').prop('disabled',true).text("Loading...");
            },
            success: function (response) {
                $('.load_more_projects').removeAttr('disabled').text("Load More");
                $('.wpsmp-projects-items').append(response);
                page += 1;
                if (!response) {
                    $('.load_more_projects').remove();
                }
            }
        });
    });

})( jQuery );