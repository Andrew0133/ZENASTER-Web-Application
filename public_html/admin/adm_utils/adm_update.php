<?php
    session_start();
    if (isset($_POST['btnProd']))
    {
        require '../../utils/connect_db.php';
        
        if(!$stmt = mysqli_stmt_init($conn))
        {
            header("Location: ../adm_products.php?error=updateError");
            exit();
        }
        $sql = "UPDATE prodotti SET title = ?, genere = ?, dataUscita = ?, prezzo = ?, descrizione = ?, path_img = ?, tipo = ? WHERE gid = ".$_POST['gid'];
        
        if(!mysqli_stmt_prepare($stmt, $sql))
        {
            header("Location: ../adm_products.php?error=updateError");
            exit();
        }

        $path = $_POST['path'];
        
        if($_FILES['myfile']['size'] != 0 && $_FILES['myfile']['error'] == 0) //Concatenazione nuovo path se abbiamo caricato file e non ci sono errori
            $path = "photos/".$_POST['tipo']."/".$_FILES['myfile']['name'];
            
        
        if(!mysqli_stmt_bind_param($stmt, "sssdsss", $_POST['title'], $_POST['genere'], $_POST['dateU'], $_POST['price'], $_POST['desc'], $path, $_POST['tipo'])){
            header("Location: ../adm_products.php?error=updateError");
            exit();
        }
        
        if(!mysqli_stmt_execute($stmt)){
            header("Location: ../adm_products.php?error=updateError");
            exit();
        }

        if ($_FILES['myfile']['size'] != 0)
        {
            $target_dir = "../../photos/".$_POST['tipo']."/";
            $target_file = $target_dir . basename($_FILES['myfile']['name']);
            
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

            if (file_exists($target_file)) //Se il file esiste già non carichiamo
            {
                header("Location: ../adm_products.php?error=fileAlreadyExists");
                exit();
            }

            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" ) //Se i formati sono consentiti
            {
                header("Location: ../adm_products.php?error=invalidFormat");
                exit();
            }
            else 
            {
                //Se il prodotto ha già associata una immagine la cancelliamo
                $filename = "../../".$_POST['path']; //get the filename
                unlink($filename); //delete it

                if (move_uploaded_file($_FILES["myfile"]["tmp_name"], $target_file)) //assegniamo al prodotto una immagine nuova
                {
                    header("Location: ../adm_products.php?message=uploadSuccess");
                    exit();
                } 
                else 
                {
                    header("Location: ../adm_products.php?error=uploadError");
                    exit();
                }
            }
        }

        if(!mysqli_stmt_close($stmt)){
            header("Location: ../adm_products.php?error=uploadError");
            exit();
        }
        
        header("Location: ../adm_products.php?message=uploadSuccess");
        exit();
    }
    else
    {
        header("Location: ../../index.php");
        exit();  
    }
?>