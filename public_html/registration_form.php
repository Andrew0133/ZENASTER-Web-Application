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
        
        <div class="content">
            <br><br><h1 class="display 1 text-center mx-auto loginTitle">Registrati</h1><br>
            <?php if(isset($_GET['error'])){
                    if($_GET['error'] === 'wrongPasswordValidation'){
                        echo '<div id = "alertLogin" class="alert alert-danger text-center mx-auto " role="alert">
                                Password e conferma password non corrispondono!
                            </div>';
                    }
                    if($_GET['error'] === 'passwordTooShort'){
                        echo '<div id = "alertLogin" class="alert alert-danger text-center mx-auto " role="alert">
                                Password troppo corta, inserire minimo 8 caratteri!
                            </div>';
                    }
                    if($_GET['error'] === 'registration_error'){
                        echo '<div id = "alertLogin" class="alert alert-danger text-center mx-auto " role="alert">
                                Ops qualcosa è andato storto, riprova più tardi :(
                            </div>';
                    }
                    if($_GET['error'] === 'emptySpace'){
                        echo '<div id = "alertLogin" class="alert alert-danger text-center mx-auto " role="alert">
                                Uno dei campi è vuoto!!
                            </div>';
                    }
                    if($_GET['error'] === 'wrongEmailStructure'){
                        echo '<div id = "alertLogin" class="alert alert-danger text-center mx-auto " role="alert">
                               Formato email non corretto!!
                            </div>';
                    }
                }
            ?>
            <form id="registration" class="text-center" action="utils/registration.php" method="post">
                <div class="form-group">
                    <label class=""><i class="fas fa-user"></i> Nome</label>
                    <input type="text" class="form-control customFormInput" name="firstname" placeholder="Nome" require>
                </div>
                <div class="form-group">
                    <label class=""><i class="fas fa-user"></i> Cognome</label>
                    <input type="text" class="form-control customFormInput" name="lastname" placeholder="Cognome" require>
                </div>
                <div class="form-group">
                    <label class=""><i class="fas fa-envelope" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"></i> Email</label>
                    <input type="email" class="form-control customFormInput" name="email"  aria-describedby="emailHelp" placeholder="Email" require>
                </div>
                <div class="form-group">
                    <label class=""><i class="fas fa-key"></i> Password</label>
                    <input pattern = ".{8,}" type="password" class="form-control customFormInput" name="pass" placeholder="Password" require>
                    <small id="passwordHelp" class="form-text text-muted">La password deve essere lunga almeno 8 caratteri</small>
                </div>
                <div class="form-group">
                    <label class=""><i class="fas fa-key"></i> Conferma password</label>
                    <input pattern = ".{8,}" type="password" class="form-control customFormInput" name="confirm" placeholder="Conferma password" require>
                </div>
                <input type="submit" class="btn btn-primary confermButton " name="submit" value="Registrati">
                <br>
                <br>
                <a class="">Sei già registrato?</a><a class="" href="login_form.php"> Accedi</a>
            </form>
        </div>

        <?php require 'footer.php'; ?>
    </body>
    <script src="js/bootstrap.min.js"></script>
</html>