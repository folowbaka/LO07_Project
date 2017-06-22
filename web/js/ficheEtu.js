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
        console.log(indiceCursus);
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
        var idCursus=$(this).parent().children(".idCursus").text();

        $.ajax({
            method: "POST",
            url: url,
            data: { reglement: reglement, idCursus: idCursus }
        })
            .done(function( response ) {
                $("#dialog>ul").html("");
                $("#dialog>h2").html("");
                for(textValidation in response["text"])
                {
                    $("#dialog>ul").append("<li>"+response["text"][textValidation]+"</li><hr>");
                }
                if(response["validation"])
                {
                    $("#dialog>h2").append("Votre cursus est valide");
                }
                else
                {
                    $("#dialog>h2").append("Votre cursus n'est pas valide");
                }
                $( "#dialog" ).dialog({
                    modal: true,
                    minHeight: 500,
                    minWidth: 800,
                    buttons: {
                        Ok: function() {
                            $( this ).dialog( "close" );
                        }
                    }
                });
            });

    });


});