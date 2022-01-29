$(document).ready(function() {
    $('#dataTable').DataTable();

});

$(document).ready(function(){
    /*Funzione per aggiornare i dati degli utenti */
    $(document).on('click','.btnAdminUpdate', function(){  
        
        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function(){
            return $(this).text();
        }).get();

        $("#update").attr("action", "../utils/update_profile.php");
        $("#updateUserTitle").html("Modifica dati utente");
        $("#submit").attr("value","Conferma modifica");
        $("#idForm").show();
        $("#passForm").hide();
        $("#banForm").show();

        $('#id').val(data[0]);
        $('#firstname').val(data[1]);
        $('#lastname').val(data[2]);
        $('#email').val(data[3]);
        $('#indirizzo').val(data[4]);
        $('#cellulare').val(data[5]);
        if(data[6] != ""){
            $('#'+"admin"+data[6]).attr('checked',true);
        }
        $('#ban').val(data[7]);
    });
    /*Funzione per creare un nuovo utente */
    $(document).on('click','#addNewUserBtn', function(){  
        
        $("#update").attr("action", "adm_utils/adm_insert.php");
        $("#update")[0].reset();
        $("#updateUserTitle").html("Registra un nuovo utente");
        $("#submit").attr("value","Conferma Aggiunta");
        $("#submit").attr("name","btnUser");
        $("#idForm").hide();
        $("#banForm").hide();
        $("#passForm").show();
    });
});


