/**
 * Created by Folow on 07/06/2017.
 */
$(document).ready(function()
{
    $(window).scroll(function() {
        if($(this).scrollTop() > 50)  /*height in pixels when the navbar becomes non opaque*/
        {
            if(!$('.navbar-fixed-top').hasClass("opaque-navbar"))
                $('.navbar-fixed-top').toggleClass("opaque-navbar");
        } else {
            if($('.navbar-fixed-top').hasClass("opaque-navbar"))
            $('.navbar-fixed-top').toggleClass("opaque-navbar");
        }
    });

});