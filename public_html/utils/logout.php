<?php
    session_start();
    unset($_SESSION['admin']);
    unset($_SESSION['userId']);
    session_unset();
    session_destroy();
    header("Location: ../index.php");
?>.