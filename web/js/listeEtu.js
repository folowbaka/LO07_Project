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

    // On ajoute un premier champ automatiquement s'il n'en existe pas déjà un (cas d'une nouvelle annonce par exemple).

});