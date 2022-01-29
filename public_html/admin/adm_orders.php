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

                $sql = "SELECT h.hid, u.uid, u.email, p.title, h.qnt, h.purchaseDate FROM historypurchase AS h JOIN users AS u ON h.uid = u.uid JOIN prodotti AS p ON h.gid = p.gid";

                if (!$query = mysqli_query($conn, $sql))
                {
                    header("Location: adm_index.php");
                    exit();
                }

                echo '
                    <div class="content">';
                    
                echo '
                        <div class="table-responsive adminTables"><br>
                            <table id="dataTable" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID_Ordine</th>
                                        <th>ID_Utente</th>
                                        <th>Email Utente</th>
                                        <th>Titolo</th>
                                        <th>Quantità</th>
                                        <th>Data</th>
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
                                        <td>'.$row['hid'].'</td>
                                        <td>'.htmlspecialchars($row['uid']).'</td>
                                        <td>'.htmlspecialchars($row['email']).'</td>
                                        <td>'.htmlspecialchars($row['title']).'</td>
                                        <td>'.htmlspecialchars($row['qnt']).'</td>
                                        <td>'.htmlspecialchars($row['purchaseDate']).'</td>
                                    </tr> ';
                                }
                            }
                            else
                            {
                                echo'Non ci sono stati acquisti';
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
