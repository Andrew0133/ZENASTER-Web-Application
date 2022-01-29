<?php
    if (isset($_POST['submit']))
    {
        // se i campi necessari sono stati tutti settati e non vuoti
        if (isset($_POST['email']) && isset($_POST['pass']) && strlen($_POST['email']) && strlen($_POST['pass']))
        {
            // costruzione query per login
            $sql = "SELECT * FROM users WHERE email = ?";
            require 'connect_db.php';
            require 'vars.php';    
            if (!$stmt = mysqli_stmt_init($conn))
            {
                header("Location: ../login_form.php?error=login_error");
                exit();
            }
            if (!mysqli_stmt_prepare($stmt, $sql))
            {
                header("Location: ../login_form.php?error=login_error");
                exit();
            }
            else
            {
                if(!mysqli_stmt_bind_param($stmt, "s", $_POST['email'])){
                    header("Location: ../login_form.php?error=login_error");
                    exit();
                }
                if (!mysqli_stmt_execute($stmt))
                {
                    header("Location: ../login_form.php?error=login_error");
                    exit(); 
                }
                if (!$result = mysqli_stmt_get_result($stmt)){
                    header("Location: ../login_form.php?error=login_error");
                    exit(); 
                }

                if ($row = mysqli_fetch_assoc($result))
                {
                    // verifica password
                    $pwdCheck = password_verify($_POST['pass'], $row['pass']);
                    if ($pwdCheck === false)
                    {
                        header("Location: ../login_form.php?error=credentialsError");
                        exit();
                    }
                    else
                    {
                        // controllo ban
                        if($row['banned'] == BANNED)
                        {
                            header("Location: ../login_form.php?error=banned");
                            exit();
                        }
                        session_start();
                        $_SESSION['userId'] = $row['uid'];
                        // se admin crea variabile sessione admin
                        if ($row['amministratore'] == SUCCESS)
                            $_SESSION['admin'] = true;

                        mysqli_stmt_close($stmt);
                        mysqli_close($conn);
                        header("Location: ../index.php");
                        exit();
                    }
                }
                else
                {   
                    header("Location: ../login_form.php?error=credentialsError");
                    exit();
                }
            }
        }
        else
        {
            header("Location: ../login_form.php?error=emptySpace");
            exit(); 
        }
    }
    else
    {
        header("Location: ../login_form.php");
        exit();
    }
?>