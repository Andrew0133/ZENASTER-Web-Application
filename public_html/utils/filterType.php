<?php 
    require 'vars.php';
    session_start();

    // se dataFilter no settato e no array 

    if(!isset($_GET['dataFilter']) || !is_array($_GET['dataFilter'])){
        header("Location: ../products.php?error=TypeNotAllowed");
        exit();
    }
    
    $filterAr = $_GET['dataFilter']; // filtri checkboxati (ajax)
    $lengthOfFilterAr = count($_GET['dataFilter']);

    $arrayOfTypes = []; // per tipi
    $arrayOfCategories = []; // per categorie

    // per ogni elem di filterAr
    for ($i = 0; $i < $lengthOfFilterAr; ++$i){
        // se tipo metti in array tipi
        if (in_array($filterAr[$i], typeAllowed)){
            array_push($arrayOfTypes, $filterAr[$i]);
        }
        
        // se cat metti in array categorie
        if (in_array($filterAr[$i], catAllowed))
            array_push($arrayOfCategories, $filterAr[$i]);
    } 

    // se non vuoto creiamo variabile sessione prodotti
    if (count($arrayOfTypes) > 0){
        $_SESSION['filterType'] = $arrayOfTypes;
    }
    else{
        unset($_SESSION['filterType']); // unsettiamo altrimenti applica i filtri precedenti
    }

    // stesso controllo ma per categorie
    if(count($arrayOfCategories) > 0){
        $_SESSION['filterCat'] = $arrayOfCategories;
    }
    else{
        unset($_SESSION['filterCat']);
    }

    require 'update_products.php';
?>            