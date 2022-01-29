$(document).ready(function() {
    $('.pathDelProd').hide();
    $('#dataTable').dataTable({
        responsive: true
      });

});


$(document).ready(function(){

    /*Bottone per modificare i prodotti*/
    $(document).on('click','.btnAdminUpdateProd', function(){  
            
        $tr = $(this).closest('tr');
    
        var data = $tr.children("td").map(function(){
            return $(this).text();
        }).get();


    
        $("#update").attr("action", "adm_utils/adm_update.php");
        $("#updateProdTitle").html("Modifica prodotto");
        $("#submit").attr("value","Conferma modifica");
        $("#idFormProd").show();

        if(data[2] != ""){
            $('#'+data[2]).attr('checked',true);
        }
        if(data[7] != ""){
            $('#'+data[7]).attr('checked',true);
        }
            
        
        $('#gid').val(data[0]);
        $('#title').val(data[1]);
        $('#genere').val(data[2]);
        $('#dateU').val(data[3]);
        $('#price').val(data[4]);
        $('#desc').val(data[5]);
        $('#path').val(data[6]);
        $('#pathInp').hide();
        $('#tipo').val(data[7]);
    });
    /*Bottone per aggiungere un prodotto nuovo*/
    $(document).on('click','#addNewProdBtn', function(){  
        
            $("#update").attr("action", "adm_utils/adm_insert.php");
            $("#update")[0].reset();
            $("#updateProdTitle").html("Aggiungi un nuovo prodotto"); 
            $("#submit").attr("value","Conferma Aggiunta");
            $("#idFormProd").hide();
            $('#pathInp').hide();
    });

    $('.pathDelProd').hide();
});


