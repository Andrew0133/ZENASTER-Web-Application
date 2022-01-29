<?php
    if (isset($_POST['submit']))
    {
        if (isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['email']) && (isset($_POST['pass'])) && isset($_POST['confirm'])
            && strlen($_POST['firstname']) && strlen($_POST['lastname']) && strlen($_POST['email']) && strlen($_POST['pass']) && strlen($_POST['confirm']))
        {
            require 'vars.php';

            // controllo lunghezza password
            if (strlen($_POST['pass']) < MAX_PASSWORD_LENGTH)
            {
                header("Location: ../registration_form.php?error=passwordTooShort");
                exit();
            }

            // controllo pattern email
            if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                header("Location: ../registration_form.php?error=wrongEmailStructure");
                exit();
            }
            
            if ($_POST['pass'] === $_POST['confirm']) // controllo conferma uguale a pass
            {
                require 'connect_db.php';

                if (!$stmt = mysqli_stmt_init($conn)) 
                {
                    header("Location: ../registration_form.php?error=registration_error");
                    exit();
                }

                $sql = "INSERT INTO users VALUES (default, ?, ?, ?, ?, null, null, default, default)"; //query per inserire utente

                if (!mysqli_stmt_prepare($stmt, $sql))
                {
                    
                    header("Location: ../registration_form.php?error=registration_error");
                    exit();
                }
                else
                {
                    if(!$hashedPwd = password_hash($_POST['pass'], PASSWORD_DEFAULT))
                    {
                        header("Location: ../registration_form.php?error=registration_error");
                        exit();
                    }
                    
                    if(!mysqli_stmt_bind_param($stmt, "ssss", $_POST['firstname'], $_POST['lastname'], $_POST['email'], $hashedPwd))
                    {
                        header("Location: ../registration_form.php?error=registration_error");
                        exit();
                    }

                    if (!mysqli_stmt_execute($stmt))
                    {
                        header("Location: ../registration_form.php?error=registration_error");
                        exit();
                    }
                    mysqli_stmt_close($stmt);
                    mysqli_close($conn);
                    header("Location: ../login_form.php");
                    exit();
                }
            }
            else
            {
                header("Location: ../registration_form.php?error=wrongPasswordValidation");
                exit();
            }
        }
        else
        {
            header("Location: ../registration_form.php?error=emptySpace");
            exit();
        }
    }
    else
    {
        header("Location: ../registration_form.php");
        exit();
    }
?>