<?php
    session_start();
?>
<!DOCTYPE html>
<html len="en">
    <head>
        <title>Zenaster</title>   
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">

        <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../css/style.css">
        <link rel="shortcut icon" type="image/x-icon" href="../favicon.ico"/> 

        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

        <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="utf-8">

        <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed&display=swap" rel="stylesheet"> 
        <link href="https://fonts.googleapis.com/css2?family=Bangers&display=swap" rel="stylesheet">

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

        <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"> </script>
        <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"> </script>

        <script src="js/users.js"></script>

    </head>
  
    <body>
        <?php
            if (isset($_SESSION['admin']))
            {
                require 'adm_header.php';
                require '../utils/connect_db.php';
                require '../utils/vars.php';

                $sql = "SELECT * FROM users";
                if (!$query = mysqli_query($conn, $sql))
                {
                    header("Location: adm_index.php?error=somethingIsWrong");
                    exit;
                }

                if(isset($_GET['error'])){
                    if($_GET['error'] === 'emptySpaceUser' || $_GET['error'] === 'fieldsMustBeWritten'){
                        echo '<br><div id = "alertLogin" class="alert alert-danger text-center mx-auto zenFont" role="alert">
                                Dati essenziali per utente (nome, cognome, email, password) da inserire sono mancanti!
                            </div>';
                    }
                    if($_GET['error'] === 'passwordTooShort'){
                        echo '<br><div id = "alertLogin" class="alert alert-danger text-center mx-auto zenFont" role="alert">
                                Password troppo corta, inserire minimo 8 caratteri!
                            </div>';
                    }
                    if($_GET['error'] === 'wrongEmailStructure'){
                        echo '<br><div id = "alertLogin" class="alert alert-danger text-center mx-auto zenFont" role="alert">
                                la email non va bene!!!
                            </div>';
                    }
                    if($_GET['error'] === 'somethingIsWrong'){
                        echo '<br><div id = "alertLogin" class="alert alert-danger text-center mx-auto zenFont" role="alert">
                                Ops qualcosa è andato storto, riprova più tardi :(
                            </div>';
                    }
                }
                else if(isset($_GET['message'])){
                    if($_GET['message'] === 'operationSuccess'){
                        echo '<br><div id = "alertLogin" class="alert alert-success text-center mx-auto zenFont" role="alert">
                                Modifica avvenuta con successo!
                            </div>';
                    }
                }

                echo '
                    <div class="content">
                    <br><a href="" id="addNewUserBtn" class="btn btn-info btn-lg card-header" name="addNewUserBtn" data-toggle="modal" data-target="#modalLoginForm"><span class="glyphicon glyphicon-plus-sign"></span><i class="fas fa-plus"></i> Aggiungi utente</a>
                        <div class="modal fade" id="modalLoginForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header text-center">
                                        <h4 id="updateUserTitle" class="modal-title w-100 font-weight-bold">Modifica dati utente</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                
                                    <form name = "update" id ="update" class="text-center" action="../utils/update_profile.php" method="post">
                                        <div class="modal-body mx-3">
                                            <div class="form-group" id="idForm">
                                                <label><i class="fas fa-id-card"></i> ID</label>
                                                <input type="text" class="form-control customFormInput" name="id" id="id" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label><i class="fas fa-user"></i> Nome</label>
                                                <input type="text" class="form-control customFormInput" name="firstname" id="firstname" value="" require>
                                            </div>
                                            <div class="form-group">
                                                <label><i class="fas fa-user"></i> Cognome</label>
                                                <input type="text" class="form-control customFormInput" name="lastname" id="lastname" value=""  require>
                                            </div>
                                            <div class="form-group">
                                                <label><i class="fas fa-envelope"></i> Email</label>
                                                <input type="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" class="form-control customFormInput" name="email" id="email" value="" require>
                                            </div>
                                            <div class="form-group" id="passForm">
                                                <label><i class="fas fa-key"></i> Password</label>
                                                <input type="password" class="form-control customFormInput" name="pass" id="pass" value="" require>
                                            </div> 
                                            <div class="form-group">
                                                <label><i class="fas fa-home"></i> Indirizzo</label>
                                                <input type="text" class="form-control customFormInput" name="Indirizzo" id="indirizzo" value="" require>
                                            </div>
                                            <div class="form-group">
                                                <label><i class="fas fa-mobile-alt"></i> Cellulare</label>
                                                <input type="text" class="form-control customFormInput" name="Cellulare" id="cellulare" value="" require>
                                            </div>
                                            <div class="form-group">
                                                <label><i class="fas fa-users-cog"></i> Amministratore</label>
                                                <!--<input type="text" class="form-control customFormInput" name="Amministratore" id="admin" value="" require>-->

                                                <div>
                                                    <input type="radio" id="admin0" name="Amministratore" value="0">
                                                    <label for="admin0">No</label>
                                                </div>

                                                <div>
                                                    <input type="radio" id="admin1" name="Amministratore" value="1">
                                                    <label for="admin1">Si</label>
                                                </div>

                                            </div>
                                            <div class="form-group"  id="banForm">
                                                <label><i class="fas fa-user-slash"></i> Ban</label>
                                                <input type="text" class="form-control customFormInput" name="ban" id="ban" value="" require>
                                        </div>
                                        <br>
                                        <input type="submit" class="btn btn-primary confermButton" id = "submit" name="submit" value="Conferma modifica">
                                    </form> 
                                </div>
                                </div>
                            </div>
                            </div>
                        <div class="adminTables"><br>
                            <table id="dataTable" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>UserId</th>
                                        <th>Firstname</th>
                                        <th>Lastname</th>
                                        <th>Email</th>
                                        <th>Indirizzo</th>
                                        <th>Cellulare</th>
                                        <th>Amministratore</th>
                                        <th>Bannato</th>
                                        <th>Modifica</th>
                                        <th>Cancella</th>
                                    </tr>
                                </thead>
                                <tbody>';
                            if ($query){
                                $result = mysqli_num_rows($query);
                            }else
                                $result = 0;
                            
                            if ($result > 0)
                            {
                                while($row = mysqli_fetch_assoc($query))
                                {
                                    echo '
                                    <tr>
                                        <td>'.$row['uid'].'</td>
                                        <td>'.htmlspecialchars($row['firstName']).'</td>
                                        <td>'.htmlspecialchars($row['lastname']).'</td>
                                        <td>'.htmlspecialchars($row['email']).'</td>
                                        <td>'.htmlspecialchars($row['Indirizzo']).'</td>
                                        <td>'.htmlspecialchars($row['Cellulare']).'</td>
                                        <td>'.$row['amministratore'].'</td>
                                        <td>'.$row['banned'].'</td>
                                        <td> <a class="btnAdminUpdate btn btn-success" data-toggle="modal" data-target="#modalLoginForm"><i class="fas fa-pen"></i></a> </td>
                                        <td> 
                                        <form class="formDel" action="adm_utils/adm_delete.php" method="post"> 
                                            <button type="submit" name="deleteBtnUser" class="btn btn-danger" value="'.$row['uid'].'"><i class="fas fa-trash-alt"></i></button> 
                                        </form></td>
                                    </tr> ';
                                }
                            }
                            else
                            {
                                echo'Non ci sono utenti';
                            }
                            echo ' </tbody> 
                                </table>
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
</html>