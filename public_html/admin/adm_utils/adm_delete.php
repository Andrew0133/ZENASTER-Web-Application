<?php
    session_start();
    /*File utilizzato per cancellare prodotti, utenti e newsletter */
    if (isset($_POST['deleteBtnUser']) || isset($_POST['deleteBtnProduct']) || isset($_POST['deleteBtnNewsletter'])) //Possiamo cancellare da newsletter,prodotti e user.
    {
        require '../../utils/connect_db.php';

        //Vediamo da dove arriviamo
        if (isset($_POST['deleteBtnUser']))
        {
            $sql = "DELETE FROM users WHERE uid LIKE ".intval($_POST['deleteBtnUser']);
        }
        else if (isset($_POST['deleteBtnProduct']))
        {
            $sql = "DELETE FROM prodotti WHERE gid LIKE ".intval($_POST['deleteBtnProduct']);
        }
        else if (isset($_POST['deleteBtnNewsletter']))
        {
            $sql = "DELETE FROM newsletter WHERE eid LIKE ".intval($_POST['deleteBtnNewsletter']);
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

        if (!mysqli_stmt_execute($stmt))
        {
            header("Location: ../adm_index.php?error=somethingIsWrong");
            exit();
        }

        if (isset($_POST['deleteBtnUser']))
        {
            header("Location: ../adm_users.php");
            exit();
        }
        else if(isset($_POST['deleteBtnProduct']))
        {
            if (file_exists("../../".$_POST['pathDelProd'])){//Vediamo se il file esiste 
                unlink("../../".$_POST['pathDelProd']);//Se esiste eliminiamo il file
            }

            header("Location: ../adm_products.php");
            exit();
        }
        else if(isset($_POST['deleteBtnNewsletter']))
        {
            header("Location: ../adm_mail.php");
            exit();
        }
        exit();
    }
    else
    {
        header("Location: ../../index.php");
        exit();  
    }
?>