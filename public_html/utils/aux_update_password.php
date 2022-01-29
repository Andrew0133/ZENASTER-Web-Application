<?php
    session_start();
    if (isset($_SESSION['userId']) && isset($_POST['submit'])) //Devi essere loggato
    {        
    if (isset($_POST['oldPass']) && isset($_POST['newPass']) && isset($_POST['confirmPass'])  //Deve essere tutto settato e non vuoto
    && strlen($_POST['oldPass']) && strlen($_POST['newPass']) && strlen($_POST['confirmPass']))
    {
        require 'vars.php';
        if (strlen($_POST['newPass']) < MAX_PASSWORD_LENGTH)
        {
            header("Location: ../update_password.php?error=passwordTooShort");
            exit();
        }

        $sql = "SELECT uid, pass FROM users WHERE uid = ".$_SESSION['userId']; //Facciamo query
        require 'connect_db.php';        
        if (!$stmt1 = mysqli_stmt_init($conn))
        {
            header("Location: ../update_password.php?error=somethingIsWrong");
            exit();
        }
        
        if (!mysqli_stmt_prepare($stmt1, $sql)){
            header("Location: ../update_password.php?error=somethingIsWrong");
            exit();
        }
        
        if(!mysqli_stmt_execute($stmt1)){
            header("Location: ../update_password.php?error=somethingIsWrong");
            exit();
        }
        
        if(!$result = mysqli_stmt_get_result($stmt1)){
            header("Location: ../update_password.php?error=somethingIsWrong");
            exit();
        }

        if(!$row = mysqli_fetch_assoc($result)){
            header("Location: ../update_password.php?error=somethingIsWrong");
            exit();
        }

        $pwdCheck = password_verify($_POST['oldPass'], $row['pass']);
    
        if ($pwdCheck === false) //Verifichiamo che la pass è giusta
        {
            header("Location: ../update_password.php?error=wrongPasswordValidation");
            exit();
        }
        else
        {
            if ($_POST['newPass'] === $_POST['confirmPass']) //Verifico che sono uguali
            {
                $sqlToUpdate = "UPDATE users SET pass = ? WHERE uid = ".$_SESSION['userId'];
                if (!$stmt2 = mysqli_stmt_init($conn))
                {
                    header("Location: ../update_password.php?error=somethingIsWrong");
                    exit();
                }
                
                if (!mysqli_stmt_prepare($stmt2, $sqlToUpdate))
                {
                    header("Location: ../update_password.php?error=somethingIsWrong");
                    exit();
                }

                if (!$hashedPwd = password_hash($_POST['newPass'], PASSWORD_DEFAULT))
                {
                    header("Location: ../update_password.php?error=somethingIsWrong");
                    exit();
                }

                if (!mysqli_stmt_bind_param($stmt2, "s", $hashedPwd))
                {
                    header("Location: ../update_password.php?error=somethingIsWrong");
                    exit();
                }

                if (!mysqli_stmt_execute($stmt2))
                    {
                        header("Location: ../update_password.php?error=somethingIsWrong");
                        exit();
                    }

                mysqli_stmt_close($stmt1);
                mysqli_stmt_close($stmt2);
                mysqli_close($conn);
                header("Location: ../index.php?message=validPassUpdate");
                exit();
            }
            else
            {
                header("Location: ../update_password.php?error=wrongPasswordConfirmValidation");
                exit();
            }
        }
    }
    else
    {
        header("Location: ../update_password.php?error=emptySpace");
        exit();
    }
}

    else
    {
        header("Location: ../index.php?");
        exit();
    }
?>