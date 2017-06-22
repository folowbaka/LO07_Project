/**
 * Created by david on 22/05/2017.
 */

var AddForm=function($container)
{
    this._$container=$container;
    this._index=0;



}

AddForm.prototype.addDynamicElement=function()
    {
            // Dans le contenu de l'attribut « data-prototype », on remplace :
        // - le texte "__name__label__" qu'il contient par le label du champ
        // - le texte "__name__" qu'il contient par le numéro du champ
        this._template=this._$container.attr('data-prototype')
            .replace(/__name__label__/g, 'Element n°' + (this._index+1))
            .replace(/__name__/g,        this._index);
        // On crée un objet jquery qui contient ce template
        this._$prototype= $(this._template);
        // On ajoute au prototype un lien pour pouvoir supprimer la catégorie
        $(this._$prototype).find('.selectpicker').selectpicker({
        });
        // On ajoute le prototype modifié à la fin de la balise <div>
        this._$container.append(this._$prototype)
        this.addDeleteLink();
        // Enfin, on incrémente le compteur pour que le prochain ajout se fasse avec un autre numéro
            this._index++;
    }
AddForm.prototype.addDeleteLink=function ()
    {
    // Création  du lien
    var $deleteLink = $('<a href="#" class="btn btn-danger">Supprimer</a>');

    // Ajout du lien
    this._$prototype.append($deleteLink);
    this._$prototype.append("<hr>");

    // Ajout du listener sur le clic du lien pour effectivement supprimer la catégoriea
        var addform=this;
        var $proto=this._$prototype;
    $deleteLink.click(function (e) {
        if(addform._index>1)
        {
            addform._index--;
            $proto.remove();
        }
        console.log(addform._index);
        console.log("bite");
        e.preventDefault(); // évite qu'un # apparaisse dans l'URL
        return false;
    });
}
AddForm.prototype.setPrototype=function($prototype)
{
    this._$prototype=$prototype;
}

AddForm.prototype.getIndex=function()
{
    return this._index;
}
AddForm.prototype.getPrototype=function()
{
    return this._$prototype;
}
AddForm.prototype.getContainer=function()
{
    return this._$container;
}


