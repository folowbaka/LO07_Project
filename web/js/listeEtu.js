/**
 * Created by Folow on 08/06/2017.
 */
$(document).ready(function()
{

    $('.lineEtu').click(function(e) {

        console.log($(this).children('.idLineEtu').text());
        e.preventDefault(); // évite qu'un # apparaisse dans l'URL
        return false;
    });

    // On ajoute un premier champ automatiquement s'il n'en existe pas déjà un (cas d'une nouvelle annonce par exemple).

});