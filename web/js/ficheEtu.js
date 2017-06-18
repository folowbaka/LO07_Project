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

    $('.deleteCursusEtu').click(function(e){
        var indiceCursus=$(this).parents(".cursusSection").children(".labelCursus").children(".idCursus").text();
        $(this).parent().parent().find(".deleteCursusIndice").attr("value",indiceCursus);
        $(this).parents('.formDeleteCursus').submit();
    });
    $('.editCursusEtu').click(function(e){
        $(this).parents('.formEditCursus').submit();
    });
    $('.btn-export-cursus').click(function(e){
        $(this).parents('.formExportCursus').submit();
    });
    $(".test-cursus").click(function () {

        var reglement=$(this).parent().children('.select-reglement').val();
        var url=$(this).attr("data-url");

        $.ajax({
            method: "POST",
            url: url,
            data: { name: "John", location: "Boston" }
        })
            .done(function( response ) {
                console.log(response);
                $( "#dialog" ).dialog({
                    modal: true,
                    buttons: {
                        Ok: function() {
                            $( this ).dialog( "close" );
                        }
                    }
                });
            });

    });


});