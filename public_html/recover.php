<!DOCTYPE html>
<html len="en">
    <head>
        <title>Zenaster</title>
        <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="css/style.css">

        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
 
        <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="utf-8">
        <link rel="shortcut icon" type="image/x-icon" href="favicon.ico"/>

        <link href="https://fonts.googleapis.com/css2?family=Bangers&display=swap" rel="stylesheet"> 
        
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    </head>
    <body>
        <?php require 'header.php'; ?>

        <div class="content">
            <br><br><h1 class="display 1 text-center mx-auto loginTitle">PASSWORD DIMENTICATA?</h1><br>
            <?php 
            // gestione errori
            if(isset($_GET['error'])){
                    if($_GET['error'] === 'somethingIsWrong'){
                        echo '<br><div id = "alertLogin" class="alert alert-danger text-center mx-auto" role="alert">
                                Ops qualcosa è andato storto :(
                            </div>';
                    }  
                    
                    if($_GET['error'] === 'cantValidateRecover'){
                        echo '<br><div id = "alertLogin" class="alert alert-danger text-center mx-auto" role="alert">
                                Non è stato possibile recuperare la password :(
                            </div>';
                    }  
                }
            ?>
            <form id="login"class="text-center" action="utils/email_sender.php" method="post">
                <div class="form-group">
                    <p>Inserisci la mail con cui ti sei iscritto</p><br>
                    <label for="mail"><i class="fas fa-envelope"></i> Inserisci il tuo indirizzo mail...</label>
                    <input type="email" class="form-control customFormInput" id="mail" name="email" aria-describedby="emailHelp" placeholder="Email">
                </div>
                <br>
                <button type="submit" class="btn btn-primary confermButton" name="btnRecPass">Invia</button>
            </form>
        </div>

        <?php require 'footer.php'; ?>

    </body>
    <script src="js/bootstrap.js" ></script>
    <script src="js/bootstrap.min.js"></script>
</html>