/**
 * Created by Folow on 07/06/2017.
 */
$(document).ready(function()
{
    $(window).scroll(function() {
        if($(this).scrollTop() > 50)  /*height in pixels when the navbar becomes non opaque*/
        {
            if(!$('.navbarTop').hasClass("opaque-navbar"))
                $('.navbarTop').toggleClass("opaque-navbar");
        } else {
            if($('.navbarTop').hasClass("opaque-navbar"))
            $('.navbarTop').toggleClass("opaque-navbar");
        }
    });

});