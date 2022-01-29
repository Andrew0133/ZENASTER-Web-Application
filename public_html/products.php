<?php
    session_start();
    if(isset($_SESSION['filterType']) || isset($_SESSION['filterCat']) || isset($_SESSION['search'])){
        unset($_SESSION['filterType']);
        unset($_SESSION['filterCat']);
        unset($_SESSION['search']);
    }
?>
<!DOCTYPE html>
<html len="en">
    <head>
        <title>Zenaster</title>
        <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="utf-8">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
 
        <link href="https://fonts.googleapis.com/css2?family=Bangers&display=swap" rel="stylesheet"> 
        <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed&display=swap" rel="stylesheet"> 
        <link rel="shortcut icon" type="image/x-icon" href="favicon.ico"/>

        <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
        <script src="js/products.js"></script>
    </head>
    <body>
    <?php 
        require 'header.php'; 
    ?>      
        <div class="container containerShopMargin">
            <!-- TOGGLE -->
            <div class="toogleFilter btnFilter">
                <button class="btn btnFilter btnFLex " type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample"><b><i class="fas fa-arrow-right"></i> Filtra <i class="fas fa-arrow-left"></i></b></button>
                <div class="collapse" id="collapseExample">
                    <div class="row mx-auto">
                        <div class="col-sm filterMargin">    
                            <h6 class=""><b><i class="fas fa-gamepad"></i> PRODOTTI</b></h6>
                            <label class="form-check">
                            <input class="form-check-input checkJs" type="checkbox" id="Horror-check" name="selector[]"value="film">
                            <span class="form-check-label ">Film</span>
                            </label> <!-- form-check.// -->
                            <label class="form-check">
                            <input class="form-check-input checkJs" type="checkbox" id="Avventura-check" name="selector[]" value="games">
                            <span class="form-check-label ">Videogiochi</span>
                            </label>  <!-- form-check.// -->
                            <label class="form-check">
                            <input class="form-check-input checkJs" type="checkbox" id="Azione-check" name="selector[]" value="merch">
                            <span class="form-check-label ">Merchandising</span>
                            </label>
                        </div>
                        <div class="col-sm filterMargin">
                            <h6 class=""><b><i class="fas fa-tags"></i> CATEGORIE</b></h6>   
                            <label class="form-check">
                            <input class="form-check-input checkJs" type="checkbox" id="Horror-check" name="selector[]"value="Animazione">
                            <span class="form-check-label ">Animazione</span>
                            </label> <!-- form-check.// -->
                            <label class="form-check">
                            <input class="form-check-input checkJs" type="checkbox" id="Avventura-check" name="selector[]" value="Avventura">
                            <span class="form-check-label ">Avventura </span>
                            </label>  <!-- form-check.// -->
                            <label class="form-check">
                            <input class="form-check-input checkJs" type="checkbox" id="Azione-check" name="selector[]" value="Commedia">
                            <span class="form-check-label ">Commedia</span>
                            </label>  <!-- form-check.// -->
                            <label class="form-check">
                            <input class="form-check-input checkJs" type="checkbox" id="Thriller-check" name="selector[]" value="Fantascienza">
                            <span class="form-check-label ">Fantascienza</span>
                            </label>  <!-- form-check.// -->
                        </div>
                        <button class="btn filterBtn btn-primary submitFilter filterMargin " id="filterBtnJs" name="filterBtnJs" ><i class="fas fa-filter"></i> Applica Filtri</button><br>
                    </div>
                </div>
            </div>
             <!-- /TOGGLE -->
            <br>

            <?php 
                // se searchbar settata e non vuota
                if(isset($_POST['search']) && $_POST['search'] != "")
                {
                    echo '<h4 class="text-muted">I risultati per "<b id="search">'.htmlspecialchars($_POST['search']).'</b>" sono: <a href="products.php"> 
                    <i class="fas fa-times-circle"></i></a> </h4>';
                } 
            ?>

            <div class="row">
                <div class="col">
                    <!---Colonna prodotti-->
                    <div class="row" id="rowProd">
                        <?php 
                            require 'utils/connect_db.php';
                            
                            // se searchbar settata e non vuota -> pulizia input utente e creazione variabile sessione searchbar
                            if (isset($_POST['search']) && $_POST['search'] != "")
                            {
                                $filter = mysqli_real_escape_string($conn, $_POST['search']);
                                $_SESSION['search']= $filter;
                            }

                            // caricamento parte dinamica prodotti
                            require 'utils/update_products.php';
                        ?>
                    </div>
                </div>
            </div>
        </div>
    <?php 
        require 'footer.php'; 
    ?>
    </body>
    <script src="js/bootstrap.min.js"></script>
</html>