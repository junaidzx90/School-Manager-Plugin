(function( $ ) {
	'use strict';

    jQuery("body").append(
        '<div id="wpsmp_preloadder"> <div id="wpsmp_loader"></div> </div> </div>'
    );

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
          action: 'wpsmp_wcproject_filterning',
          page: page,
          security: my_projects_data.security
        },
        beforeSend: () => {
          $('.load_more_projects').prop('disabled', true).text("Loading...");
        },
        success: function (response) {
          page += 1;
          if (!response) {
            $('.load_more_projects').remove();
          } else {
            $('.load_more_projects').removeAttr('disabled').text("Load More");
            $('.wpsmp-projects-items').append(response);
          }
        }
      });
    });

    // Project filter
  $(".projectfilter").on("change", function () {
    let filterdata = $(this).val();
    $.ajax({
      type: "POST",
      url: my_projects_data.ajax_url,
      beforeSend: function () {
        $("#wpsmp_preloadder").show();
      },
      data: {
        action: "wpsmp_wcproject_filterning",
        filterdata: filterdata,
        filters: $("#filters").val(),
        security: my_projects_data.security,
      },
      success: function (response) {
        if (response) {
          $("#wpsmp_preloadder").fadeOut();
          $(".wpsmp-projects-items").html(response);
        } else {
          $(".wpsmp-projects-items").html("No Project Found!");
        }
      },
    });
  });

   // Filters projects
   $("#filters").on("change", function () {
    let types = $(this).val();
    $.ajax({
      type: "POST",
      url: my_projects_data.ajax_url,
      data: {
        action: "wpsmp_wcproject_filterning",
        filterdata: $(".projectfilter").val(),
        filters: types,
        security: my_projects_data.security,
      },
      success: function (response) {
        if (response) {
          $("#wpsmp_preloadder").fadeOut();
          $(".wpsmp-projects-items").html(response);
        } else {
          $(".wpsmp-projects-items").html("No Project Found!");
        }
      },
    });
  });

})( jQuery );