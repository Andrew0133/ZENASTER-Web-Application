 <?php
    session_start();
?>
<!DOCTYPE html>
<html len="en">
    <head>
        <title>Zenaster</title>
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../css/style.css">

        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

        <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="utf-8">

        <link href="https://fonts.googleapis.com/css2?family=Bangers&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed&display=swap" rel="stylesheet">
        <link rel="shortcut icon" type="image/x-icon" href="../favicon.ico"/>  
        
        <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    </head>
    
    <body>
        <?php
            if (isset($_SESSION['admin']))
            {
                require 'adm_header.php';
                if(isset($_GET['error'])){
                    if($_GET['error'] === 'emptySpace'){
                        echo '<br><div id = "alertLogin" class="alert alert-danger text-center mx-auto" role="alert">
                               Non ci sono iscritti alla newsletter!! :(
                            </div>';
                    }  
                    if($_GET['error'] === 'sendError'){
                        echo '<br><div id = "alertLogin" class="alert alert-danger text-center mx-auto" role="alert">
                               Non si è riuscito ad inviare la mail!! :(
                            </div>';
                    }
                    if($_GET['error'] === 'somethingIsWrong'){
                        echo '<br><div id = "alertLogin" class="alert alert-danger text-center mx-auto" role="alert">
                               Ops qualcosa è andato storto!! :(
                            </div>';
                    }   
                }
                else if(isset($_GET['message'])){
                    if($_GET['message'] === 'emailSuccess'){
                        echo '<br><div id = "alertLogin" class="alert alert-success text-center mx-auto" role="alert">
                               Messaggio inviato con successo!
                            </div>';
                    }  
                
                    if($_GET['message'] === 'operationSuccess'){
                        echo '<br><div id = "alertLogin" class="alert alert-success text-center mx-auto zenFont" role="alert">
                                Inserimento avvenuto con successo!
                            </div>';
                    }
                }

                echo ' <div class="content ">
                <br>
                <div class="customRow">
                    <h3 class="display 3 subtitles"> Area Admin </h3>
                    <hr>
                </div>
                <br>
                <div class="row">
                    <div class="col">
                        <br><a href="adm_users.php" class="indexAdmBtnAux indexAdmBtn btn btn-info btn-lg card-header zenFont"><span class="glyphicon glyphicon-plus-sign"></span> Gestisci utenti <br><i class="fas fa-users"></i></a>
                    </div> 
                    <div class="col">
                        <br><a href="adm_products.php" class="indexAdmBtnAux indexAdmBtn btn btn-info btn-lg card-header zenFont"><span class="glyphicon glyphicon-plus-sign"></span> Gestisci prodotti <br><i class="fas fa-compact-disc"></i></a>
                    </div>
                    <div class="col">
                        <br><a href="adm_mail.php" class="indexAdmBtnAux indexAdmBtn btn btn-info btn-lg card-header zenFont"><span class="glyphicon glyphicon-plus-sign"></span> Gestisci Newsletter <br><i class="fas fa-envelope-open-text"></i></a>
                    </div>
                    <div class="col">
                        <br><a href="adm_orders.php" class="indexAdmBtnAux indexAdmBtn btn btn-info btn-lg card-header zenFont"><span class="glyphicon glyphicon-plus-sign"></span> Storico acquisti <br><i class="fas fa-book-open"></i></a>
                    </div>   
                </div>
            </div>';
            }
            else
            {
                header("Location: ../index.php");
                exit();
            }
        ?>
    </body>
    <script src="../js/bootstrap.min.js"></script>
</html>