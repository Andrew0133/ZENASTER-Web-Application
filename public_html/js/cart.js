$(document).ready(function(){
    // cancellazione prodotto carrello 
    $(document).on('click','.removeCart', function(){
        var id = $(this).attr('id');
        var castedId = "#" + String(id);
        var prodIdR = $(castedId).val();
        $.get("utils/remove_cart.php",{remove : prodIdR}, function(result){
            $("#tableCart").html(result);
        });
    });
});