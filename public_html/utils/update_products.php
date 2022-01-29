<?php 
     if(!isset($_SESSION)) // necessario per mantenere i filtri attivi nei cambi pagina
     { 
        session_start(); 
     } 

    require 'connect_db.php';
      
    $arrayToBind = [];
    $stringOfTypes = "";
    $page = 1;
    $limit = 9; // limite prodotti visualizzabile per pagina

    $aux_sql = "SELECT * FROM prodotti"; // preparazione query per numero pagina
    $sql = "SELECT * FROM prodotti"; // preparazione query per prodotti

    // creazione query 
    if(isset($_SESSION['filterType']) || isset($_SESSION['filterCat']) || isset($_SESSION['search'])){          
        $aux_sql .= " WHERE ";
        $sql .= " WHERE ";
    }

    // se search settata 
    if(isset($_SESSION['search'])){
        for ($i=0; $i<3; ++$i){array_push($arrayToBind,"%".$_SESSION['search']."%");} // per title, genere e descrizione
        $stringOfTypes .= "sss";
        $aux_sql .= " (title LIKE ? OR genere LIKE ? OR descrizione LIKE ?)";
        $sql .= " (title LIKE ? OR genere LIKE ? OR descrizione LIKE ?)";
        // se sono settate filterCat e filterType aggiungo AND
        if(isset($_SESSION['filterCat']) || isset($_SESSION['filterType'])){
            $aux_sql .= " AND";
            $sql .= " AND";
        } 
    }
    
    // se settata filterType
    if(isset($_SESSION['filterType'])){
        $aux_sql .= " tipo IN (";
        $sql .= " tipo IN (";
        for ($i=0; $i<count($_SESSION['filterType']); ++$i){
            array_push($arrayToBind,$_SESSION['filterType'][$i]);
            $stringOfTypes .= "s";
            $aux_sql .= "?,";
            $sql .= "?,";
        }
        $aux_sql[strlen($aux_sql)-1] = ")"; // per togliere la virgola finale
        $sql[strlen($sql)-1] = ")";
        if(isset($_SESSION['filterCat'])){
            $aux_sql .= " AND";
            $sql .= " AND";
        }
    }

    if(isset($_SESSION['filterCat'])){
        $aux_sql .= " genere IN (";
        $sql .= " genere IN (";
        for ($i=0; $i<count($_SESSION['filterCat']); ++$i){
            array_push($arrayToBind,$_SESSION['filterCat'][$i]);
            $stringOfTypes .= "s";
            $aux_sql .= "?,";
            $sql .= "?,";
        }
        $aux_sql[strlen($aux_sql)-1] = ")";
        $sql[strlen($sql)-1] = ")";
    }
     
    // se ci sono filtri o ricerca sanitizziamo input user
    if(isset($_SESSION['filterType']) || isset($_SESSION['filterCat']) || isset($_SESSION['search']))
    {
        if (!$stmt = mysqli_stmt_init($conn))
        {
            header("Location: ../index.php?error=somethingIsWrong");
            exit();
        }

        /*Query per contare il numero di pagine*/
        if (!mysqli_stmt_prepare($stmt, $aux_sql))
        {
            header("Location: ../index.php?error=somethingIsWrong");
            exit();
        }
        
        if (!mysqli_stmt_bind_param($stmt, $stringOfTypes, ...$arrayToBind))
        {
            header("Location: ../index.php?error=somethingIsWrong");
            exit();
        }

        if (!mysqli_stmt_execute($stmt))
        {
            header("Location: ../index.php?error=somethingIsWrong");
            exit();
        }

        if (!$aux_result = mysqli_stmt_get_result($stmt))
        {
            header("Location: ../index.php?error=somethingIsWrong");
            exit(); 
        }
    }
    else // se no input user allora non serve stmt
    {
        $aux_result = mysqli_query($conn, $aux_sql);
    }
    
    if ($aux_result){
        $aux_query = mysqli_num_rows($aux_result);        
    }else {
        $aux_query = 0;
    }
    
    // controllo se pagina è nell'intervallo max delle pagine
    if (isset($_GET['page'])){
        if (is_numeric($_GET['page'])){
            if(0 <= intval($_GET['page'])-1 && intval($_GET['page'])-1 <= intval($aux_query/$limit)){ //Necessario per aggiornamento pagina
                $page = $_GET['page'];
            }
        }
    }
    
    // calcoliamo offset(9 elementi alla volta)
    $offset = $limit*(intval($page)-1);

    $sql .= " LIMIT $limit OFFSET $offset";//si aggiunge il limit alla QUERY qua così da stampare esattamente 9 o meno elementi per pagina

    if(isset($_SESSION['filterType']) || isset($_SESSION['filterCat']) || isset($_SESSION['search']))
    {
        if (!$stmtProd = mysqli_stmt_init($conn))
        {
            header("Location: ../index.php?error=somethingIsWrong");
            exit();
        }

        /*Query per contare il numero di prodotti*/
        if (!mysqli_stmt_prepare($stmtProd, $sql))
        {
            header("Location: ../index.php?error=somethingIsWrong");
            exit();
        }
        
        if (!mysqli_stmt_bind_param($stmtProd, $stringOfTypes, ...$arrayToBind))
        {
            header("Location: ../index.php?error=somethingIsWrong");
            exit();
        }

        if (!mysqli_stmt_execute($stmtProd))
        {
            header("Location: ../index.php?error=somethingIsWrong");
            exit();
        }

        if (!$result = mysqli_stmt_get_result($stmtProd))
        {
            header("Location: ../index.php?error=somethingIsWrong");
            exit(); 
        }
    }
    else
    {
        $result = mysqli_query($conn, $sql);
    }

    if ($result){
        $query = mysqli_num_rows($result);        
    }else
        $query = 0;
    
    if ($query > 0)
    {
        while($row = mysqli_fetch_assoc($result))
        {
            echo '<div class=" col-12 col-md-6 col-lg-4">
            <div class="card shopMargin">
                <img class="card-img-top mx-auto imgCardClass" src="'.$row['path_img'].'" alt="'.$row['title'].'">
                <div class="card-body ">
                    <h4 class="card-title textColorBlue"><h3 href="product.html" title="View Product" class="textColorBlue zenFont">'.$row['title'].'</h3></h4>
                    <p class="card-text zenFont">
                    
                    <div class="collapse-content">
                        <p class="card-text collapse" id="collapseContent'.$row['gid'].'">'.$row['descrizione'].'</p>
                        <a class="btn btn-flat red-text p-1 my-1 mr-0 mml-1 collapsed" data-toggle="collapse" href="#collapseContent'.$row['gid'].'" 
                        aria-expanded="false" aria-controls="collapseContent">Descrizione <i class="fas fa-comment"></i></a>
                    </div>
                    <div class="row">
                        <div class="col">
                            <h4 class="bloc_left_price">'.$row['prezzo'].'€</h4>
                        </div>
                        <div class="col">
                            <button id = "'.$row['gid'].'" value="'.$row['gid'].'" class="btn btn-block cartJs zenFont">Add to <i class="fas fa-shopping-cart"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>';
        }
        echo '<div class="col-12">
        <nav aria-label="..." id="changePage">
        <ul class="pagination">';

        // contatore pagine
        for ($i = 0; $i < ($aux_query/$limit);  ++$i){
            $pagenum = $i+1; //I numeri delle pagine partono da 1
            // se pagenum = alla page in cui siamo -> colora pagina in cui siamo
            if($pagenum === intval($page)){
                echo '
                <li class=" page-item active switchStyle">
                    <button id = "'.$pagenum.'" class="page-link jsBtn" value="'.$pagenum.'">'.$pagenum.'<span class="sr-only">(current)</span></button>
                </li>';
            }else{
                echo '
                <li class="page-item" >
                    <button id = "'.$pagenum.'" class="page-link jsBtn" value="'.$pagenum.'">'.$pagenum.'</button>
                </li>';
            }
        }
        echo '</ul>
                </nav>
            </div>'; 
    }else{
        echo'<a id="NoDroids">Non ci sono i prodotti che stai cercando</a>
        <img src="photos/sad_robot.png" id="sadRobot" alt ="robot triste">
        ';
    }
mysqli_close($conn);
?>            