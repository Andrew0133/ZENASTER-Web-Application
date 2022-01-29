<?php
    /*File utilizzato per inserire prodotti e utenti */
    if (isset($_POST['btnUser']) || isset($_POST['btnProd']))
    {
        require '../../utils/connect_db.php';
        require '../../utils/vars.php';

        //Inserimento utente
        if (isset($_POST['btnUser']))
        {
            if (isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['email']) && (isset($_POST['pass']))
            && strlen($_POST['firstname']) && strlen($_POST['lastname']) && strlen($_POST['email']) && strlen($_POST['pass']))
            {
                if (strlen($_POST['pass']) < MAX_PASSWORD_LENGTH)
                {
                    header("Location: ../adm_users.php?error=passwordTooShort");
                    exit();
                }
                // controllo pattern email
                if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                    header("Location: ../adm_users.php?error=wrongEmailStructure");
                    exit();
                }

                $sql = "INSERT INTO users VALUES (default, ?, ?, ?, ?, ?, ?, ?, default)";
                $paramsForUsers = "ssssssd";
            }
            else
            {
                header("Location: ../adm_users.php?error=emptySpaceUser");
                exit();
            }
        }
        else if (isset($_POST['btnProd']))//Inserimento Prodotto
        {
            if (isset($_POST['title']) && isset($_POST['tipo']) && isset($_POST['price'])
            && strlen($_POST['title']) && strlen($_POST['tipo']) && strlen($_POST['price']))
            {
                $sql = "INSERT INTO prodotti VALUES (default, ?, ?, ?, ?, ?, ?, ?)";
                $paramsForItems = "sssdsss";
            }
            else
            {
                header("Location: ../adm_products.php?error=emptySpaceProducts");
                exit();
            }
        }

        if (!$stmt = mysqli_stmt_init($conn)) 
        {
            header("Location: ../adm_index.php?error=somethingIsWrong");
            exit();
        }

        if (!mysqli_stmt_prepare($stmt, $sql))
        {         
            header("Location: ../adm_index.php?error=somethingIsWrong");
            exit();
        }

        if (isset($_POST['btnUser']))//Inserimento utente
        {
            if(!$hashedPwd = password_hash($_POST['pass'], PASSWORD_DEFAULT)){
                header("Location: ../adm_index.php?error=somethingIsWrong");
                exit();
            }

            //Se non viene indicato l'amministratore zero di default altrimenti il valore che si passa
            if (!isset($_POST['Amministratore']))    
                $possiblyAdministrator = 0;
            else
                $possiblyAdministrator = $_POST['Amministratore'];

            //Bind per utente
            if(!mysqli_stmt_bind_param($stmt, $paramsForUsers, $_POST['firstname'], $_POST['lastname'], $_POST['email'], $hashedPwd, 
            $_POST['Indirizzo'], $_POST['Cellulare'] , $possiblyAdministrator))
            {
                header("Location: ../adm_users.php?error=somethingIsWrong");
                exit();
            }
        }
        else if (isset($_POST['btnProd']))//Inserimento Prodotto
        {  
            if (isset($_FILES['myfile'])) //Se è stato mandato un file entriamo
            {
                if (strlen($_FILES['myfile']['name']) != 0 ) //Controlliamo se ha un nome
                {
                    $target_dir = "../../photos/".$_POST['tipo']."/"; //Settiamo la cartella in cui mettiamo la immagine tramite il tipo stesso del prodotto
                    $target_file = $target_dir.basename($_FILES['myfile']['name']);//Ci prendiamo tutto il path completo + il nome del file
                    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION)); //Andiamo a prendere il tipo dell'immagine per verificare che l'estensione dell'immagine non sia in un formato non valido
                    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                    && $imageFileType != "gif" ) //Verifichiamo formato
                    {
                        header("Location: ../adm_products.php?error=invalidFormat");
                        exit();
                    }

                    $path = "photos/".$_POST['tipo']."/".$_FILES['myfile']['name']; //Path costruito
                    if (file_exists("../../".$path)) //Se esiste un file con lo stesso nome allora è già presente (ogni prodotto ha un immagine unica)
                    {
                        header("Location: ../adm_products.php?error=fileAlreadyExists");
                        exit();
                    }
                }
                else
                    $path = "";
            }
                else
                    $path = "";

            if(!mysqli_stmt_bind_param($stmt, $paramsForItems, $_POST['title'], $_POST['genere'], $_POST['dateU'], $_POST['price']
            ,$_POST['desc'], $path, $_POST['tipo'])) //Bind dei parametri
            {
                header("Location: ../adm_products.php?error=somethingIsWrong");
                exit();
            }
        }    
        
        if (!mysqli_stmt_execute($stmt))
        {
            header("Location: ../adm_products.php?error=somethingIsWrong");
            exit();
        }

        if (isset($_POST['btnProd'])) //Questo blocco ci permette di caricare effettivamente il file sul server
        {           
            if(strlen($path) != 0)
            {
                $target_dir = "../../photos/".$_POST['tipo']."/";
                $target_file = $target_dir.basename($_FILES['myfile']['name']);
                $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

                if (move_uploaded_file($_FILES["myfile"]["tmp_name"], $target_file))   
                    echo "The file ". htmlspecialchars( basename( $_FILES["myfile"]["name"])). " has been uploaded.";
                else 
                {
                    header("Location: ../adm_products.php?error=uploadError");
                    exit();
                }
                
            }
        }
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        header("Location: ../adm_index.php?message=operationSuccess");
        exit();
    }
    else
    {
        header("Location: ../../index.php");
        exit();
    }
?>