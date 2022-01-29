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
        <link rel="shortcut icon" type="image/x-icon" href="favicon.ico"/>

        <link href="https://fonts.googleapis.com/css2?family=Bangers&display=swap" rel="stylesheet"> 

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    </head>
    <body>
        <?php require 'header.php'; require 'utils/connect_db.php'; 

        if(isset($_GET['error'])){
            if($_GET['error'] === 'passwordTooShort'){
                echo '<br><div id = "alertLogin" class="alert alert-danger text-center mx-auto" role="alert">
                        Password troppo corta :(
                    </div>';
            }  
            
            if($_GET['error'] === 'wrongPasswordValidation'){
                echo '<br><div id = "alertLogin" class="alert alert-danger text-center mx-auto" role="alert">
                        Nuova password e Conferma password devono essere uguali
                    </div>';
            }
            if($_GET['error'] === 'emptySpace'){
                echo '<br><div id = "alertLogin" class="alert alert-danger text-center mx-auto" role="alert">
                        Uno dei campi è vuoto!!
                    </div>';
            }    
        }

        // se settate authenticator e validation(presi in URL)
        if (isset($_GET['authenticator']) && isset($_GET['validation']) )
        {
            $authenticator = $_GET['authenticator'];
            $validation = $_GET['validation'];
        }
        else
        {
            header("Location: recover.php?error=cantValidateRecover");
            exit();
        }

        if (empty($authenticator) || empty($validation))
        {
            header("Location: recover.php?error=cantValidateRecover");
            exit();
        }
        else
        {
            // se tutti i caratteri sono esadecimali 
            if (ctype_xdigit($authenticator) && ctype_xdigit($validation))
            { 
                echo' 
                <div class="content">
                    <br><br><h1 class="display 1 text-center mx-auto loginTitle">Ripristina password</h1><br>
                    <div class="container">
                        <div class="main-body">                
                            <div class="row gutters-sm">
                                <div class="col-md-8">
                                <div class="card mb-3 around">
                                    <form id= "formUpdate" action="utils/aux_recover_password.php" method="post">
                                        <div class="card-body">
                                            <input type="hidden" name="authenticator" value="'.htmlspecialchars($authenticator).'">
                                            <input type="hidden" name="validation" value="'.htmlspecialchars($validation).'">
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <h6 class="mb-0">Inserisci la nuova password</h6>
                                                </div>
                                                <div class="col-sm-9 text-secondary">
                                                    <input type="password" id="firstname" name="newPass" value="">
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <h6 class="mb-0">Re-inserisci la nuova password</h6>
                                                </div>
                                                <div class="col-sm-9 text-secondary">
                                                    <input type="password" id="firstname" name="confirmPass" value="">
                                                </div>
                                            </div>
                                        </div>
                                        <a class="btn btn-primary profileButton" href="recover.php">Annulla</a>
                                        <input type="submit" class="btn btn-primary profileButton" name="submit" value="Salva">
                                    </form>
                                </div>
                                </div>
                            </div>
                            </div>
                        </div><br><br><br><br>
                    </div>';
            }
            else
            {
                header("Location: recover.php?error=cantValidateRecover");
                exit();
            } 
        }
        require 'footer.php'; ?>
    </body>
    <script src="js/bootstrap.min.js"></script>
</html>