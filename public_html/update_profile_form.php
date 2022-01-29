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
            $sql = "SELECT firstname, lastname, email, Indirizzo, Cellulare FROM users WHERE uid LIKE ".$_SESSION['userId']; ////query per stampare dati utente nei placeholder dei campi html
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
            //Fine stmt

            //htmlspecialchars() -> contro XSS
        echo '
        <div class="content">
            <br><br><h1 class="display 1 text-center mx-auto loginTitle">Modifica il tuo profilo</h1><br>
            <div class="container">
                <div class="main-body">
                
                    <!-- /Breadcrumb -->
                
                    <div class="row gutters-sm">
                        <div class="col-md-4 mb-3 ">
                            <div class="card around">
                                <div class="card-body">
                                <div class="d-flex flex-column align-items-center text-center">
                                    <img src="photos/foto_profilo.png" alt="Admin" class="rounded-circle" width="150">
                                    <div class="mt-3">
                                    <h4>'.htmlspecialchars($row['firstname']).' '.htmlspecialchars($row['lastname']).'</h4>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                        <div class="card mb-3 around">
                            <form id= "formUpdate" action="utils/update_profile.php" method="post">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-3">
                                        <h6 class="mb-0">Nome</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                        <input type="text" id="firstname" name="firstname" value="'.htmlspecialchars($row['firstname']).'">
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                        <h6 class="mb-0">Cognome</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                        <input type="text" id="lastname" name="lastname" value="'.htmlspecialchars($row['lastname']).'">
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                        <h6 class="mb-0">Email</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                        <input type="text" id="email" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" value= "'.htmlspecialchars($row['email']).'">
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                        <h6 class="mb-0">Telefono cellulare</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                        <input type="text" id="Cellulare" name="Cellulare" value="'.htmlspecialchars($row['Cellulare']).'">
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                        <h6 class="mb-0">Indirizzo</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                        <input type="text" id="Indirizzo" name="Indirizzo" value="'.htmlspecialchars($row['Indirizzo']).'">
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
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        }else
        {
            header("Location: index.php");
            exit();
        }
        require 'footer.php'; ?>
    </body>
    <script src="js/bootstrap.min.js"></script>
</html>