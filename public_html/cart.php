<?php
if(!isset($_SESSION)){
    session_start();
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

        <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="utf-8">   
 
        <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Bangers&display=swap" rel="stylesheet"> 
        <link rel="shortcut icon" type="image/x-icon" href="favicon.ico"/>
        
        <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
        <script src="js/cart.js"></script>
    </head>
    <body>
        <?php $inCart=""; require 'header.php'; ?>
        <div class="container containerShopMargin">
            <?php
            // parte dinamica carrello
                require 'utils/update_cart.php';
            ?>
        </div>
        <?php require 'footer.php'; ?>
    </body>
    <script src="js/bootstrap.min.js"></script>
</html>