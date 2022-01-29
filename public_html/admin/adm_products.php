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

        <link href="https://fonts.googleapis.com/css2?family=Bangers&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed&display=swap" rel="stylesheet">

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

                $sql = "SELECT * FROM prodotti";
                $query = mysqli_query($conn, $sql);

                if(isset($_GET['error']))
                {
                    if($_GET['error'] === 'emptySpaceProducts'){
                        echo '<br><div id = "alertLogin" class="alert alert-danger text-center mx-auto zenFont" role="alert">
                                Dati essenziali per prodotto (titolo, prezzo, tipo) da inserire sono mancanti! 
                            </div>';
                    }
                    if($_GET['error'] === 'somethingIsWrong'){
                        echo '<br><div id = "alertLogin" class="alert alert-danger text-center mx-auto zenFont" role="alert">
                                Ops qualcosa è andato storto, riprova più tardi :(
                            </div>';
                    }
                    if($_GET['error'] === 'fileAlreadyExists'){
                        echo '<br><div id = "alertLogin" class="alert alert-danger text-center mx-auto zenFont" role="alert">
                                Il file che hai inserito per il prodotto esiste gia per il tipo selezionato
                            </div>';
                    }
                    if($_GET['error'] === 'invalidFormat'){
                        echo '<br><div id = "alertLogin" class="alert alert-danger text-center mx-auto zenFont" role="alert">
                                Il formato del file che hai inserito non e consentito
                            </div>';
                    }
                    if($_GET['error'] === 'uploadError'){
                        echo '<br><div id = "alertLogin" class="alert alert-danger text-center mx-auto zenFont" role="alert">
                                Errore nel caricamento della immagine selezionata
                            </div>';
                    }
                    if($_GET['error'] === 'updateError'){
                        echo '<br><div id = "alertLogin" class="alert alert-danger text-center mx-auto zenFont" role="alert">
                                Qualcosa e andato storto nella modifica del prodotto
                            </div>';
                    }
                }
                else if(isset($_GET['message'])){
                    if($_GET['message'] === 'uploadSuccess'){
                        echo '<br><div id = "alertLogin" class="alert alert-success text-center mx-auto zenFont" role="alert">
                                Modifica avvenuta con successo!
                            </div>';
                    }
                }

                echo '
                    <div class="content">
                    <br><a href="" id="addNewProdBtn" class="btn btn-info btn-lg card-header" name="addNewProdBtn" data-toggle="modal" 
                    data-target="#modalLoginForm"><span class="glyphicon glyphicon-plus-sign"></span><i class="fas fa-plus"></i> Aggiungi prodotto</a>
                        <div class="modal fade" id="modalLoginForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header text-center">
                                        <h4 id="updateProdTitle" class="modal-title w-100 font-weight-bold">Modifica dati prodotto</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                
                                    <form name = "update" id ="update" enctype="multipart/form-data" class="text-center" action="adm_utils/adm_update.php" method="post">
                                        <div class="modal-body mx-3">
                                            <div class="form-group" id="idFormProd">
                                                <label><i class="fas fa-clipboard"></i> GID</label>
                                                <input type="text" class="form-control customFormInput" name="gid" id="gid" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label><i class="fas fa-compact-disc"></i> Titolo</label>
                                                <input type="text" pattern ="{1,50}" class="form-control customFormInput" name="title" id="title" value="" require>
                                            </div>
                                            <div class="form-group">
                                                <label><i class="fas fa-bookmark"></i> Genere</label>                                                
                                                <div>
                                                    <input type="radio" id="Animazione" name="genere" value="Animazione">
                                                    <label for="genere">Animazione</label>
                                                </div>

                                                <div>
                                                    <input type="radio" id="Avventura" name="genere" value="Avventura">
                                                    <label for="genere">Avventura</label>
                                                </div>

                                                <div>
                                                    <input type="radio" id="Commedia" name="genere" value="Commedia">
                                                    <label for="genere">Commedia</label>
                                                </div>

                                                <div>
                                                    <input type="radio" id="Fantascienza" name="genere" value="Fantascienza">
                                                    <label for="genere">Fantascienza</label>
                                                </div>

                                            </div>
                                            <div class="form-group">
                                                <label><i class="fas fa-calendar-check"></i> Data di uscita</label>
                                                <input type="text" pattern="\d{4}-\d{1,2}-\d{1,2}" class="form-control customFormInput" name="dateU" id="dateU" value="" require>
                                                <small class="text-muted mx-auto zenFont">Formato accettato yyyy-mm-dd</small>
                                            </div>
                                            <div class="form-group">
                                                <label><i class="fas fa-dollar-sign"></i> Prezzo</label>
                                                <input pattern ="\d{1,5}\.\d{1,2}" type="text" class="form-control customFormInput" name="price" id="price" value="" require>
                                                <small class="text-muted mx-auto zenFont">Esempio di formato accettato: 1111.11 (cifre massime prima del punto 5, dopo il punto 2)</small>
                                            </div> 
                                            <div class="form-group">
                                                <label><i class="fas fa-quote-right"></i> Descrizione</label>
                                                <textarea class="form-control formDesc" rows="5" name="desc" id="desc" value="" require></textarea>
                                            </div>
                                            
                                            <div class="form-group" id="pathInp">
                                                <label><i class="fas fa-folder-open"></i> Path immagine</label>
                                                <input type="text" class="form-control customFormInput" name="path" id="path" value="" require>
                                            </div>
                                            
                                            <div class="form-group">
                                                <i class="fas fa-folder-open"></i> Seleziona la immagine del prodotto:</label>
                                                <input type="file" id="myfile" name="myfile" value=""><br><br>
                                            </div>

                                            <div class="form-group">
                                                <label><i class="fas fa-gamepad"></i> Tipo</label>
                                                <div>
                                                    <input type="radio" id="games" name="tipo" value="games">
                                                    <label for="tipo">games</label>
                                                </div>

                                                <div>
                                                    <input type="radio" id="film" name="tipo" value="film">
                                                    <label for="genere">film</label>
                                                </div>

                                                <div>
                                                    <input type="radio" id="merch" name="tipo" value="merch">
                                                    <label for="tipo">merch</label>
                                                </div>

                                        </div>
                                        <br>
                                        <input type="submit" class="btn btn-primary confermButton" id = "submit" name="btnProd" value="Conferma modifica">
                                    </form> 
                                </div>
                                </div>
                            </div>
                            </div>
                        <div class=" table-responsive adminTables"><br>
                            <table id="dataTable" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>ProductId</th>
                                        <th>Title</th>
                                        <th>Genere</th>
                                        <th>dataUscita</th>
                                        <th>prezzo</th>
                                        <th>descrizione</th>
                                        <th>path_img</th>
                                        <th>tipo</th>
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
                                        <td>'.$row['gid'].'</td>
                                        <td>'.$row['title'].'</td>
                                        <td>'.$row['genere'].'</td>
                                        <td>'.$row['dataUscita'].'</td>
                                        <td>'.$row['prezzo'].'</td>
                                        <td>'.$row['descrizione'].'</td>
                                        <td>'.$row['path_img'].'</td>
                                        <td>'.$row['tipo'].'</td>
                                        <td> <a class="btnAdminUpdateProd btn btn-success" data-toggle="modal" data-target="#modalLoginForm"><i class="fas fa-pen"></i></a> </td>
                                        <td> 
                                        <form class="formDel" action="adm_utils/adm_delete.php" method="post">
                                            <input type="input" class="form-control customFormInput pathDelProd" name="pathDelProd" value="'.$row['path_img'].'">
                                            <button type="submit" name="deleteBtnProduct" class="btn btn-danger" value="'.$row['gid'].'"><i class="fas fa-trash-alt"></i></button> 
                                        </form></td>
                                    </tr> ';
                                }
                            }
                            else
                            {
                                echo'Non ci sono prodotti';
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