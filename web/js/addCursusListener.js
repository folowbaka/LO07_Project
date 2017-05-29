/**
 * Created by david on 22/05/2017.
 */

$(document).ready(function()
{
    var $container=$('div#utt_cursusbundle_cursus_elements');
    var addForm=new AddForm($container);

    $('#add_element').click(function(e) {
        addForm.addDynamicElement();

        e.preventDefault(); // évite qu'un # apparaisse dans l'URL
        return false;
    });

    // On ajoute un premier champ automatiquement s'il n'en existe pas déjà un (cas d'une nouvelle annonce par exemple).
    if (addForm.getIndex() == 0) {
        addForm.addDynamicElement();
    } else {
        // S'il existe déjà des catégories, on ajoute un lien de suppression pour chacune d'entre elles
        addForm.$container.children('div').each(function() {
            addForm.setPrototype($(this));
            addForm.addDeleteLink();
        });
    }

});