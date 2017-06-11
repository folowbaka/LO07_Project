/**
 * Created by Folow on 10/06/2017.
 */
$(document).ready(function()
{
    $('#editEtuBtn').click(function(e){
        var inputetu=$('.input-etu');
        if ($(inputetu).attr('readonly'))
            {
                $(inputetu).removeAttr('readonly');
            }
        else
            {
                $(inputetu).attr('readonly', 'true');
            }
       $("#hideButton").toggle();
        });
    $('#addCursusEtu').click(function(e){
        console.log("bite");
        $('#formAddCursus').submit();
    });

});