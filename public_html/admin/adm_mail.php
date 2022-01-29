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
        <script src="js/products.js"></script>
    </head>
  
    <body>
        <?php
            if (isset($_SESSION['admin']))
            {
                require 'adm_header.php';
                require '../utils/connect_db.php';
                require '../utils/vars.php';

                $sql = "SELECT * FROM newsletter"; //query per stampare tutte le mail
                if(isset($_GET['error'])){
                    if($_GET['error'] === 'emptySpace1'){
                        echo '<br><div id = "alertLogin" class="alert alert-danger text-center mx-auto" role="alert">
                            Non puoi mandare una email vuota!
                            </div>';
                    }  
                }

                if(isset($_GET['error'])){
                    if($_GET['error'] === 'emptySpace2'){
                        echo '<br><div id = "alertLogin" class="alert alert-danger text-center mx-auto" role="alert">
                               Non ci sono iscritti alla newsletter!! :(
                            </div>';
                    }  
                }
                
                if (!$query = mysqli_query($conn, $sql))
                {
                    header("Location: adm_index.php");
                    exit();
                }

                echo '
                    <div class="content">';
                    
                echo '<br><a href="" id="" class="btn btn-info btn-lg card-header" name="addNewUserBtn" data-toggle="modal" data-target="#modalLoginForm"><span class="glyphicon glyphicon-plus-sign"></span><i class="fas fa-envelope"></i> Scrivi nuova email</a>
                        <div class="modal fade" id="modalLoginForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header text-center">
                                            <h4 id="" class="modal-title w-100 font-weight-bold">Invia una mail!!</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form name = "update" id ="update" class="text-center formNewsLetter" action="../utils/email_sender.php" method="post">
                                                <div class="form-group">
                                                    <label for="message">Compila il messaggio da inviare</label>
                                                    <textarea class="form-control formNewsLetter" rows="5" id="message" name="message"></textarea><br>
                                            <input type="submit" class="btn btn-primary confermButton" id = "submit" name="admBtnNewsletter" value="Invia mail">
                                        </form> 
                                    </div>
                                    </div>
                                </div>
                            </div>
                        <div class="adminTables"><br>
                            <table id="dataTable" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Email</th>
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
                                        <td>'.$row['eid'].'</td>
                                        <td>'.htmlspecialchars($row['email']).'</td>
                                        <td><form class="formDel" action="adm_utils/adm_delete.php" method="post"> 
                                            <button type="submit" name="deleteBtnNewsletter" class="btn btn-danger" value="'.$row['eid'].'"><i class="fas fa-trash-alt"></i></button> 
                                        </form></td>
                                    </tr> ';
                                }
                            }
                            else
                            {
                                echo'Non ci sono utenti a cui inviare una mail';
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
