<?php
    if (isset($_POST['submit']))
    {
        // se tutto il necessario è settato e non vuoto
        if (isset($_POST['authenticator']) && isset($_POST['validation']) && isset($_POST['newPass']) && isset($_POST['confirmPass']) 
        && strlen($_POST['authenticator']) && strlen($_POST['validation']) && strlen($_POST['newPass']) && strlen($_POST['confirmPass']))
        {
            require 'vars.php';
            //Controllo se la password inviata è lunga almeno 8 caratteri
            if (strlen($_POST['newPass']) < MAX_PASSWORD_LENGTH)
            {
                header("Location: ../recover_password.php?error=passwordTooShort&authenticator=".$_POST['authenticator']."&validation=".$_POST['validation']);
                exit();
            }//Controllo se la conferma pass è uguale alla password
            else if ($_POST['newPass'] != $_POST['confirmPass'])
            {
                header("Location: ../recover_password.php?error=wrongPasswordValidation&authenticator=".$_POST['authenticator']."&validation=".$_POST['validation']);
                exit();
            }
            
            $date = date("U"); //Prendiamo la data, l'ora, i minuti e secondi correnti
            require 'connect_db.php';
    
            $sql = "SELECT * FROM rpToken WHERE rpAuthenticator = ? AND rpDeadline >=".$date; //Prepariamo la query

            //inizio preparazione $sql
            if(!$stmt = mysqli_stmt_init($conn)){
                header("Location: ../recover.php?error=somethingIsWrong");//Essendo un caso eccezionali mandiamo in recover.php per ripetere la procedura
                exit();              
            }
            if (!mysqli_stmt_prepare($stmt, $sql))
            {
                header("Location: ../recover.php?error=somethingIsWrong");
                exit();
            }
            
            if(!mysqli_stmt_bind_param($stmt, "s", $_POST['authenticator']))
            {
                header("Location: ../recover.php?error=somethingIsWrong");
                exit();
            }

            if (!mysqli_stmt_execute($stmt))
            {
                header("Location: ../recover.php?error=somethingIsWrong");
                exit();
            }

            if(!$result = mysqli_stmt_get_result($stmt)){
                header("Location: ../recover.php?error=somethingIsWrong");
                exit();              
            }
            //Fine preparazione $sql
            if (!$row = mysqli_fetch_assoc($result))
            {
                header("Location: ../recover.php?error=somethingIsWrong");
                exit();
            }
            else
            {   //convertiamo in binario da esadecimale
                if(!$token = hex2bin($_POST['validation'])){
                    header("Location: ../recover.php?error=somethingIsWrong");
                    exit();            
                }
                if(!$pass_ver = password_verify($token, $row['rpToken']))//Verifichiamo che il token che viene inviato da utente corrisponda a quello in DB
                {
                    header("Location: ../recover.php?error=somethingIsWrong");
                    exit();
                }
                else
                {
                    $tokenEmail = $row['rpEmail'];
                    $sql = "SELECT * FROM users WHERE email = ?";
                    //Verifichiamo se l'utente esiste
                    if(!$stmt = mysqli_stmt_init($conn)){
                        header("Location: ../recover.php?error=somethingIsWrong");
                        exit();
                    }

                    if (!mysqli_stmt_prepare($stmt, $sql))
                    {
                        header("Location: ../recover.php?error=somethingIsWrong");
                        exit();
                    }
                    
                    if(!mysqli_stmt_bind_param($stmt, "s", $tokenEmail))
                    {
                        header("Location: ../recover.php?error=somethingIsWrong");
                        exit();
                    }

                    if(!mysqli_stmt_execute($stmt))
                    {
                        header("Location: ../recover.php?error=somethingIsWrong");
                        exit();
                    }

                    if(!$result = mysqli_stmt_get_result($stmt)){
                        header("Location: ../recover.php?error=somethingIsWrong");
                        exit();
                    }

                    if (!$row = mysqli_fetch_assoc($result))
                    {
                        header("Location: ../recover.php?error=somethingIsWrong");
                        exit();
                    }
                    else
                    {
                        $sql = "UPDATE users SET pass=? WHERE email = ?";
                        //Cambio password query
                        if(!$stmt = mysqli_stmt_init($conn)){
                            header("Location: ../recover.php?error=somethingIsWrong");
                            exit();                          
                        }
                        if (!mysqli_stmt_prepare($stmt, $sql))
                        {
                            header("Location: ../recover.php?error=somethingIsWrong");
                            exit();
                        }
                        else
                        {
                            //Cambio password
                            if(!$hashedPsw = password_hash($_POST['newPass'], PASSWORD_DEFAULT)){
                                header("Location: ../recover.php?error=somethingIsWrong");
                                exit();
                            }
                            if(!mysqli_stmt_bind_param($stmt, "ss", $hashedPsw, $tokenEmail))
                            {
                                header("Location: ../recover.php?error=somethingIsWrong");
                                exit();
                            }
                            
                            if(!mysqli_stmt_execute($stmt))
                            {
                                header("Location: ../recover.php?error=somethingIsWrong");
                                exit();
                            }
                            
                            // se la password viene cambiata con successo allora eliminiamo il token corrispondente (non si può riutilizzare lo stesso link)
                            $sqlTkn = "DELETE FROM rpToken WHERE rpEmail = ?";

                            if (!$stmtTkn = mysqli_stmt_init($conn))
                            {
                                header("Location: ../recover.php?error=somethingIsWrong");
                                exit();
                            }
                            if (!mysqli_stmt_prepare($stmtTkn, $sqlTkn))
                            {
                                header("Location: ../recover.php?error=somethingIsWrong");
                                exit();
                            }
                            if (!mysqli_stmt_bind_param($stmtTkn, "s", $tokenEmail))
                            {
                                header("Location: ../recover.php?error=somethingIsWrong");
                                exit();
                            }
                            if (!mysqli_stmt_execute($stmtTkn))
                            {
                                header("Location: ../recover.php?error=somethingIsWrong");
                                exit();
                            }

                            mysqli_stmt_close($stmt);
                            mysqli_stmt_close($stmtTkn);
                            mysqli_close($conn);
                            header("Location: ../index.php?message=passRestored");
                            exit();
                        }
                    }
                }
            }
        }
        else
        {
            header("Location: ../recover_password.php?error=emptySpace&authenticator=".$_POST['authenticator']."&validation=".$_POST['validation']);
            exit();  
        }
    }
    else
    {
        header("Location: ../index.php");
        exit();
    }
?>