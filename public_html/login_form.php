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
        <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed&display=swap" rel="stylesheet">  
        <link rel="shortcut icon" type="image/x-icon" href="favicon.ico"/> 

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    </head>
    <body>
        <?php require 'header.php'; ?>
        <div class="content ">
            <br><br><h1 class="display 1 text-center mx-auto loginTitle">LOGIN</h1><br>
            <?php 
            // gestione errori login
            if(isset($_GET['error'])){
                    if($_GET['error'] === 'login_error'){
                        echo '<div id = "alertLogin" class="alert alert-danger text-center mx-auto " role="alert">
                                Ops qualcosa è andato storto, riprova più tardi :(
                            </div>';
                    }
                    if($_GET['error'] === 'credentialsError'){
                        echo '<div id = "alertLogin" class="alert alert-danger text-center mx-auto " role="alert">
                                Email o password sono sbagliate, riprova!
                            </div>';
                    }
                    if($_GET['error'] === 'emptySpace'){
                        echo '<div id = "alertLogin" class="alert alert-danger text-center mx-auto " role="alert">
                                    Riempire tutti i campi per accedere!
                            </div>';
                    }
                    if($_GET['error'] === 'banned'){
                        echo '<div id = "alertLogin" class="alert alert-danger text-center mx-auto " role="alert">
                                    Sei stato bannato!
                            </div>';
                    }
                }
            ?>
            <form id="login"class="text-center " action="utils/login.php" method="post">
                <div class="form-group">
                    <label class="" for="exampleInputEmail1"><i class="fas fa-envelope"></i> Email</label>
                    <input type="email" class="form-control customFormInput" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" id="emailLogin"aria-describedby="emailHelp" placeholder="Email">
                    <small id="emailHelp" class="form-text text-muted ">Non condivideremo i tuoi dati con nessuno</small>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1 "><i class="fas fa-key"></i> Password</label>
                    <input type="password" class="form-control customFormInput" name="pass" placeholder="Password">
                </div>
                <br>
                <input type="submit" class="btn btn-primary confermButton" name="submit" value="Accedi">
                <br>
                <br>
                <a class="">Non sei ancora registrato?</a><a class="" href="registration_form.php"> Registrati</a>
                <br>
                <br>
                <a class="">Hai dimenticato la  </a><a class="" href="recover.php"> password?</a>
            </form>
        </div>
        <?php require 'footer.php'; ?>
    </body>
    <script src="js/bootstrap.min.js"></script>
</html>