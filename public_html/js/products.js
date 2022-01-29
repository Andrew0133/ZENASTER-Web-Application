$(document).ready(function(){
    /* Richiesta AJAX per cambiare pagina */
    $(document).on('click','.jsBtn', function(){
        var id = $(this).attr('id');
        var castedId = "#" + String(id);
        var pageNum = $(castedId).val();
        $.get("utils/update_products.php",{page : pageNum}, function(result){
        $("#rowProd").html(result);
        window.scrollTo(0, 0);
      });
    });

    /* Richiesta AJAX per aggiungere elemento al carrello */
    $(document).on('click','.cartJs', function(){
        var id = $(this).attr('id');
        var castedId = "#" + String(id);
        var prodId = $(castedId).val();
        $.get("utils/add_cart.php",{product : prodId}, function(result){
        $("#cart").html(result);
      });
    });

    /* Richiesta AJAX per aggiungere filtri alla ricerca */
    $(document).on('click','#filterBtnJs', function(){ 
        var typeChecked = [];   // verrà riempito con i valori ckeckbox checkati
        // controlliamo i checkbox checkati
        $(':checkbox:checked').each(function(i){
            typeChecked[i] = $(this).val();
        });
        
        if(typeChecked.length == 0){
            if($("#search").length == 0){
                window.location = 'https://webdev19.dibris.unige.it/~S4533904/products.php';
                return;
            }else{ /* Non resetta la ricerca quando si resettano i filtri, continuo la ricerca se non ci sono i filtri */
                var search = $("#search").text();
                var url = 'https://webdev19.dibris.unige.it/~S4533904/products.php';
                var form = $('<form action="' + url + '" method="post">' +
                '<input type="text" name="search" value="' + search + '" />' +
                '</form>');
                $('body').append(form);
                form.submit();
                return;
            }
        }

        $.get("utils/filterType.php",{dataFilter : typeChecked}, function(result){
            $("#rowProd").html(result);
        });

    });
  });