"use strict";
function copylink() {
    var copyText = document.getElementById("pagelink");
    copyText.select();
    copyText.setSelectionRange(0, 99999);
    document.execCommand("copy");
    
    var tooltip = document.getElementById("wcmyTooltip");
    tooltip.innerHTML = "Copied: " + copyText.value;
}
    
function outFunc() {
    var tooltip = document.getElementById("wcmyTooltip");
    tooltip.innerHTML = "Copy to clipboard";
}

    
jQuery(function ($) {
    // Thumbnail i,age preview
    $('.imgitem').each(function () {
        let btn = $(this);
        $(this).children('img').on("click", function () {
    
            $('.imgitem').children('img').removeClass('thumimgholder-active');
            btn.children('img').addClass('thumimgholder-active');

            $('.imageshow').html('<img src="' + $(this).attr('src') + '" alt="" class="imgmodal">');
    
        });
    });
    
});

