<?php
    if (!isset($_SESSION))
    {
        session_start();
    }

    require 'connect_db.php';

    if (!isset($_SESSION['prodCart']))
    {
        $_SESSION['prodCart'] = [];
    }

    $product = mysqli_real_escape_string($conn, $_GET['product']);

    if (ctype_digit($product))
        array_push($_SESSION['prodCart'], $product);

    $auxToCount = 0;
    foreach(array_count_values($_SESSION['prodCart']) as $key => $value)
    {
        if ($auxToCount >= 100) break;
        $auxToCount += $value;
    }

    echo'<li class="nav-item">
    <a class="nav-link" href="cart.php">Carrello <i class="fas fa-shopping-cart"></i><span class="badge">'.$auxToCount.'</span></a>
    </li>';
?>