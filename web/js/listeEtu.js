/**
 * Created by Folow on 08/06/2017.
 */
$(document).ready(function()
{

    $('.lineEtu').click(function(e) {

        var idEtu=$(this).children('.idLineEtu').text();
        window.location.href = window.location.href+idEtu;
        e.preventDefault(); // évite qu'un # apparaisse dans l'URL
        return false;
    });
    $('#file').on('change',function(e) {
        $('#formImport').submit();
    });
});