/**
 * Created by Folow on 10/06/2017.
 */
$(document).ready(function()
{
    $('#editEtuBtn').click(function(e){
        var inputetu=$('.input-etu');
        if ($(inputetu).attr('disabled'))
            {
                $(inputetu).removeAttr('disabled');
            }
        else
            {
                $(inputetu).attr('disabled', 'true');
            }
       $("#hideButton").toggle();
        });
    $('#addCursusEtu').click(function(e){
        $('#formAddCursus').submit();
    });

    $('#deleteEtudiant').click(function(e){
        $('#formDeleteEtudiant').submit();
    });


});