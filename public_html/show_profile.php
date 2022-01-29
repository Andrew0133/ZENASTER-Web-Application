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

        <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed&display=swap" rel="stylesheet">  
        <link href="https://fonts.googleapis.com/css2?family=Bangers&display=swap" rel="stylesheet"> 
        <link rel="shortcut icon" type="image/x-icon" href="favicon.ico"/>

        <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    </head>
    <body>
        <?php 
        require 'header.php'; 
        require'utils/connect_db.php';
         if (isset($_SESSION['userId']))
        {   
            $sql = "SELECT firstname, lastname, email, Indirizzo, Cellulare FROM users WHERE uid LIKE ".$_SESSION['userId']; //query per stampare dati utente

             //Inizio stmt
            if(!$stmt = mysqli_stmt_init($conn)){
                header("Location: index.php?error=somethingWrong");
                exit();
            }
            if(!mysqli_stmt_prepare($stmt, $sql)){
                header("Location: index.php?error=somethingWrong");
                exit();
            }
            if(!mysqli_stmt_execute($stmt)){
                header("Location: index.php?error=somethingWrong");
                exit();
            }
            if(!$result = mysqli_stmt_get_result($stmt)){
                header("Location: index.php?error=somethingWrong");
                exit();
            }
            if(!$row = mysqli_fetch_assoc($result)){
                header("Location: index.php?error=somethingWrong");
                exit();
            }

            //fine stmt
            //htmlspecialchars() -> contro XSS

            echo '
            <div class="content">
            <br><br><h1 class="display 1 text-center mx-auto loginTitle">Il tuo profilo</h1><br>';
            if(isset($_GET['error']))
            {   //Non aggiorniamo i campi se sono vuoti quelli obbligatori
                if($_GET['error'] === "fieldsMustBeWritten"){
                    echo '<div id = "alertLogin" class="alert alert-danger text-center mx-auto" role="alert">
                                    I campi nome, cognome e mail non possono essere vuoti!!
                                </div>';
                }

                if($_GET['error'] === "update_error"){
                    echo '<div id = "alertLogin" class="alert alert-danger text-center mx-auto" role="alert">
                                    Ops qualcosa è andato storto, riprova più tardi :(
                                </div>';
                }
            }
            echo '<div class="container">
                <div class="main-body ">
                
                    <!-- /Breadcrumb -->
                
                    <div class="row gutters-sm ">
                        <div class="col-md-4 mb-3">
                            <div class="card around">
                                <div class="card-body ">
                                <div class="d-flex flex-column align-items-center text-center ">
                                    <img src="photos/foto_profilo.png" alt="Admin" class="rounded-circle" width="150">
                                    <div class="mt-3">
                                    <h4>'.htmlspecialchars($row['firstname']).' '.htmlspecialchars($row['lastname']).'</h4>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8 ">
                        <div class="card mb-3 around">
                            <div class="card-body ">
                            <div class="row">
                                <div class="col-sm-3">
                                <h6 class="mb-0">Nome completo</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                '.htmlspecialchars($row['firstname']).' '.htmlspecialchars($row['lastname']).'
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                <h6 class="mb-0">Email</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                '.htmlspecialchars($row['email']).'
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                <h6 class="mb-0">Telefono cellulare</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                '.htmlspecialchars($row['Cellulare']).'
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                <h6 class="mb-0">Indirizzo</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                '.htmlspecialchars($row['Indirizzo']).'
                                </div>
                            </div>
                            </div>
                        </div>
                        <a class="btn btn-primary profileButton" href="update_profile_form.php">Modifica il profilo</a>
                        <a class="btn btn-primary profileButton" href="update_password.php">Modifica la password</a>
                        </div>
                    </div>
                    </div>
                </div><br><br><br><br>
        </div>
        ';
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        }
        else
        {
            header("Location: index.php");
            exit();
        }
        ?>
        <?php require 'footer.php'; ?>
    <script src="js/bootstrap.min.js"></script>
    </body>
</html>