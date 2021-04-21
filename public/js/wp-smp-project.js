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
          filters: $("#filters").val(),
          filterdata: $(".projectfilter").val(),
          security: my_projects_data.security
        },
        beforeSend: () => {
          $('.load_more_projects').prop('disabled', true).text("Loading...");
        },
        
        success: function (response) {
          page += 1;
          if (response) {
            if (response != 404) {
              $('.load_more_projects').removeAttr('disabled').text("Load More");
              $('.wpsmp-projects-items').append(response);
            }
            if (response == 404) {
              $('.load_more_projects').fadeOut();
            }
          }
        }
      });
    });

    // Project filter
  $(".projectfilter").on("change", function () {
    let filterdata = $(this).val();
    page = 2;
    
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
          if (response != 404) {
            $('.load_more_projects').removeAttr('disabled').show().text("Load More");
            $(".wpsmp-projects-items").html(response);
          }
          if (response == 404) {
            $(".wpsmp-projects-items").html("No project found!");
          }
        }
      },
    });
  });

   // Filters projects
   $("#filters").on("change", function () {
    let types = $(this).val();
    page = 2;
    
    $.ajax({
      type: "POST",
      url: my_projects_data.ajax_url,
      data: {
        action: "wpsmp_wcproject_filterning",
        filterdata: $(".projectfilter").val(),
        filters: types,
        security: my_projects_data.security,
      },
      beforeSend: function () {
        $("#wpsmp_preloadder").show();
      },
      success: function (response) {
        if (response) {
          $("#wpsmp_preloadder").fadeOut();
          if (response != 404) {
            $(".wpsmp-projects-items").html(response);
          }
          if (response == 404) {
            $(".wpsmp-projects-items").html("No project found!");
          }
        }
      },
    });
  });

})( jQuery );