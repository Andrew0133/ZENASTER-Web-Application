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
        
        <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
        <script src="js/checkout.js"></script>
    </head>
    <body>
        <?php require 'header.php'; ?>
        <div class="container containerShopMargin">
            <?php 
            // se utente loggato
            if(isset($_SESSION['userId']))
            {
                // se acquistato prodotto
                if(isset($_SESSION['prodCart'])){
                    require "utils/connect_db.php";
                    // inserimento nella tabella storico acquisti
                    $sql = "INSERT INTO historypurchase VALUES (default, ?, ?, ?, default)";

                    if (!$stmt = mysqli_stmt_init($conn)){
                        header("Location: index.php?error=somethingWrong");
                        exit();
                    }
                    if (!mysqli_stmt_prepare($stmt, $sql)){
                        header("Location: index.php?error=somethingWrong");
                        exit();
                    }

                    foreach(array_count_values($_SESSION['prodCart']) as $key => $value)
                    {
                        if (!mysqli_stmt_bind_param($stmt, "ddd", $_SESSION['userId'], $key, $value)){
                            header("Location: index.php?error=somethingWrong");
                            exit();
                        }
                    
                        if (!mysqli_stmt_execute($stmt)){
                            header("Location: index.php?error=somethingWrong");
                            exit();
                        }    
                    }
                    // svuotamento carrello
                    unset($_SESSION['prodCart']);
                }
                echo '<h4 class="text-muted">Acquisto completato </h4> <br>';
            }
            else
            {
                echo '<h4 class="text-muted">Per completare il tuo acquisto devi essere loggato al sito, <a href="login_form.php">accedi qui</a> ! </h4> <br>';
            }
            ?>                
        </div>
        <?php require 'footer.php'; ?>
    </body>
    <script src="js/bootstrap.min.js"></script>
</html>