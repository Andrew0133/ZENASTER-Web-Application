<?php
    session_start();
?>
<!DOCTYPE html>
<html len="en">
    <head>
        <title>Zenaster</title>
        <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="css/style.css">

        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
        
        <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="utf-8">

        <link href="https://fonts.googleapis.com/css2?family=Bangers&display=swap" rel="stylesheet"> 
        <link rel="shortcut icon" type="image/x-icon" href="favicon.ico"/>

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    </head>
    <body>
        <?php require 'header.php'; require 'utils/connect_db.php'; 
        if(isset($_SESSION['userId']))
        {
            if(isset($_GET['error'])){
                if($_GET['error'] === 'wrongPasswordValidation'){
                    echo '<br><div id = "alertLogin" class="alert alert-danger text-center mx-auto " role="alert">
                            La password vecchia non e corretta!
                        </div>';
                }
                if($_GET['error'] === 'wrongPasswordConfirmValidation'){
                    echo '<br><div id = "alertLogin" class="alert alert-danger text-center mx-auto " role="alert">
                            La nuova password con la relativa conferma non corrispondono
                        </div>';
                }
                if($_GET['error'] === 'passwordTooShort'){
                    echo '<br><div id = "alertLogin" class="alert alert-danger text-center mx-auto " role="alert">
                            Password troppo corta, inserire minimo 8 caratteri!
                        </div>';
                }
                if($_GET['error'] === 'somethingIsWrong'){
                    echo '<br><div id = "alertLogin" class="alert alert-danger text-center mx-auto " role="alert">
                            Ops qualcosa è andato storto, riprova più tardi :(
                        </div>';
                }
                if($_GET['error'] === 'emptySpace'){
                    echo '<br><div id = "alertLogin" class="alert alert-danger text-center mx-auto " role="alert">
                            Uno dei campi è vuoto!!
                        </div>';
                }
            }

        echo '
        <div class="content">
            <br><br><h1 class="display 1 text-center mx-auto loginTitle">Modifica la tua password</h1><br>
            <div class="container">
                <div class="main-body">                
                    <div class="row gutters-sm">
                        <div class="col-md-8 mx-auto">
                        <div class="card mb-3 around">
                            <form id= "formUpdate" action="utils/aux_update_password.php" method="post">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <h6 class="mb-0">Inserisci la vecchia password</h6>
                                        </div>
                                        <div class="col-sm-3 text-secondary">
                                            <input type="password" id="firstname" name="oldPass" value="">
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <h6 class="mb-0">Inserisci la nuova password</h6>
                                        </div>
                                        <div class="col-sm-3 text-secondary">
                                            <input type="password" id="firstname" name="newPass" value="">
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <h6 class="mb-0">Re-inserisci la nuova password</h6>
                                        </div>
                                        <div class="col-sm-3 text-secondary">
                                            <input type="password" id="firstname" name="confirmPass" value="">
                                        </div>
                                    </div>
                                </div>
                                <a class="btn btn-primary profileButton" href="show_profile.php">Annulla</a>
                                <input type="submit" class="btn btn-primary profileButton" name="submit" value="Salva">
                            </form>
                        </div>
                        </div>
                    </div>
                    </div>
                </div><br><br><br><br>
        </div>';
        }else
        {
            header("Location: index.php");
            exit();
        }
        require 'footer.php'; ?>
    </body>
    <script src="js/bootstrap.min.js"></script>
</html>