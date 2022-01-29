$(document).ready(function(){
    $(document).on('click','#btnNews', function(){
        var prodIdR = $("#email").val();
        $.post("utils/subscribeNewsletter.php",{email : prodIdR}, function(result){
          });
    });

    var url_string = window.location.href; //window.location.href
    var url = new URL(url_string);
        if(url.searchParams.get("error")){
            if(url.searchParams.get("error") === 'newsletter_error'){
            $('html, body').animate({
                scrollTop: $("#newsLetter").offset().top
            }, 2000);
        }
    }
});