jQuery(function ($) {
    // Project delete
    $(".projectdel").on("click", function () {
        let project_id = $(this).parent().attr("data-id");
        let btn = $(this);
        
        if (confirm('Are you sure?')) {
            $.ajax({
                type: "post",
                url: profile_url.ajaxurl,
                data: {
                    action: "delete_project",
                    project_id: project_id,
                },
                beforeSend: function () {
                    $("#webclass_preloader_wrapper").show();
                },
                success: function (response) {
                    if (response) {
                        $("#webclass_preloader_wrapper").hide();
                        let count = parseInt($(".projectscountn").text());
                        btn.parent().parent().parent().remove();
                        $(".projectscountn").text(count - 1);
                    }
                },
            });
        }
        return false;
    });
});