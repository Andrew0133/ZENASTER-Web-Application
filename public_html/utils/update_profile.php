<?php
    session_start();
    if (isset($_POST['submit']) || isset($_POST['btnUser'])) //Possiamo arrivarci sia da lato utente che da lato admin btnUser -> admin , submit -> pulsante update_profile_form.php
    {
        if (isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['email'])) //Settati campi obbligatori
        {
            require 'connect_db.php';
            if (!$stmt = mysqli_stmt_init($conn)) 
            {
                header("Location: ../show_profile.php?error=update_error");
                exit();
            }

            if(!strlen($_POST['firstname']) || !strlen($_POST['lastname']) || !strlen($_POST['email'])){ //campi obbligatori non vuoti
                if(isset($_SESSION['admin']) && isset($_POST['id'])){
                    header("Location: ../admin/adm_users.php?error=fieldsMustBeWritten");
                    exit();
                }
                header("Location: ../show_profile.php?error=fieldsMustBeWritten");
                exit();
            }

            if (isset($_SESSION['admin']) && isset($_POST['id'])) //modifica utente da admin
            {
                
                $sql = "UPDATE users SET firstname = ?, lastname = ?, email = ?, Indirizzo = ?, Cellulare = ?, amministratore = ?, banned = ? WHERE uid = ".$_POST['id'];//id viene mandato con tasto verde modifica in zona admin

            }
            else {
                //modifica profilo standard di un amministratore o di un utente normale
                $sql = "UPDATE users SET firstname = ?, lastname = ?, email = ?, Indirizzo = ?, Cellulare = ?, amministratore = ?, banned = ? WHERE uid = ".$_SESSION['userId'];
                $_POST['Amministratore'] = 0;
                if(isset($_SESSION['admin']) && $_SESSION['admin'] == true){//se admin vuole modificare il proprio profilo da interfaccia utente e non da aerea amministrativa
                    $_POST['Amministratore'] = 1;
                }
                $_POST['banned'] = 0;
            }

        
            if (!mysqli_stmt_prepare($stmt, $sql))
            {
                header("Location: ../show_profile.php?error=update_error");
                exit();
            }
            else
            {
                if(!mysqli_stmt_bind_param($stmt, "sssssdd", $_POST['firstname'], $_POST['lastname'], $_POST['email'], $_POST['Indirizzo'], $_POST['Cellulare'], $_POST['Amministratore'], $_POST['ban']))
                {
                    header("Location: ../show_profile.php?error=update_error");
                    exit();
                }

                if (!mysqli_stmt_execute($stmt))
                {
                    header("Location: ../show_profile.php?error=update_error");
                    exit();
                }

                mysqli_stmt_close($stmt);
                mysqli_close($conn);
                if(isset($_SESSION['admin']) && isset($_POST['id']))
                {
                    header("Location: ../admin/adm_users.php?message=operationSuccess");
                    exit();
                }
                else 
                {
                    header("Location: ../show_profile.php");
                    exit();
                }  
            } 
        }
        else
        {
            header("Location: ../show_profile.php?error=update_error");
            exit();
        }
    }
    else
    {
        header("Location: ../index.php");
        exit();
    }
?>