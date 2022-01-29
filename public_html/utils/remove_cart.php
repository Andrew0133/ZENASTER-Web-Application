<?php
    if (!isset($_SESSION))
    {
        session_start();
    }
    // prodotto da rimuovere (id prodotto)
    $product = $_GET['remove'];

    // controllo che id sia intero
    if (ctype_digit($product))
        $_SESSION['prodCart'] = array_values(array_diff($_SESSION['prodCart'],array($product)));

    // se 0 prodotti unset della variabile di sessione
    if(count($_SESSION['prodCart']) === 0)
        unset($_SESSION['prodCart']);

    require 'update_cart.php';
?>