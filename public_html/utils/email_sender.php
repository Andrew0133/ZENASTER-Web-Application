<?php
    use PHPMailer\PHPMailer\PHPMailer; 
    
    // se arriviamo da rec psw o invio mail admin
    if ((isset($_POST['btnRecPass']) && isset($_POST['email']) && strlen($_POST['email'])) || (isset($_POST['admBtnNewsletter']) && isset($_POST['message'])))
    {
        require 'connect_db.php';
        $sql = "";

        /*Inizializziamo lo statment sia nel caso dell'area amministrativa che nel recupero pass */
        if (!$stmt = mysqli_stmt_init($conn))
        {
            header("Location: ../index.php?error=somethingWrong");
            exit();
        }
        // se arriviamo da admin
        if (isset($_POST['admBtnNewsletter']))
        {
            /*Area amministrativa */
            $message = $_POST['message'];

            if(strlen($message) === 0)
            {
                /*Errore nel redirect*/
                header("Location: ../admin/adm_mail.php?error=emptySpace1");
                exit();
            }
            $sql .= "SELECT * FROM newsletter";
        }
        else{
            /*Recupero pass */
            $sql .= "SELECT * FROM users WHERE email = ?";
        }

        if (!mysqli_stmt_prepare($stmt, $sql))
        {
            header("Location: ../index.php?error=somethingWrong");
            exit();
        }

        // se arriviamo da rec psw
        if(isset($_POST['btnRecPass']) && isset($_POST['email']))
        {
            $email = $_POST['email'];
            if (!mysqli_stmt_bind_param($stmt, "s", $email))
            {
                header("Location: ../recover.php?error=somethingIsWrong");
                exit();
            }

            // due token per maggior sicurezza 
            $authenticator = random_bytes(8); //per autenticazione dell'utente 
            $authenticator = bin2hex($authenticator); //converte i bytes in un formato esadecimale per poterlo usare dentro il link che invieremo
            $token = random_bytes(32); //per verificare che sia l'utente quando torna nel sito tramite mail  
            $url = "https://webdev19.dibris.unige.it/~S4533904/recover_password.php?authenticator=".$authenticator."&validation=".bin2hex($token); // con cui user accede per il recupero

            //date U format, data di oggi in secondi dal '70 || 1800 un'ora di validazione da ora
            $deadline = date("U") + 1800;

            //Non si possono avere più di un token per lo stesso utente (scadenza tempo)
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
            if (!mysqli_stmt_bind_param($stmtTkn, "s", $email))
            {
                header("Location: ../recover.php?error=somethingIsWrong");
                exit();
            }
            if (!mysqli_stmt_execute($stmtTkn))
            {
                header("Location: ../recover.php?error=somethingIsWrong");
                exit();
            }

            // inseriamo il nuovo token per l'utente nella tabella dei token
            $sqlTkn = "INSERT INTO rpToken VALUES (default, ?, ?, ?, ?);";
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
            else
            {
                $hashedTkn = password_hash($token, PASSWORD_DEFAULT);   // hash del token di 32 byte
            }
            
            if (!mysqli_stmt_bind_param($stmtTkn, "ssss", $email, $hashedTkn, $authenticator, $deadline))
            {
                header("Location: ../recover.php?error=somethingIsWrong");
                exit();
            }

            if (!mysqli_stmt_execute($stmtTkn))
            {
                header("Location: ../recover.php?error=somethingIsWrong");
                exit();
            }
            mysqli_stmt_close($stmtTkn);

            $message = "Il link per ripristinare la password è il seguente:".$url;
	    }
        
        if (!mysqli_stmt_execute($stmt))
        {
            header("Location: ../index.php?error=somethingWrong");
            exit();
        }

        // controllo risultati
        if (!$result = mysqli_stmt_get_result($stmt))
        {
            /*Nel caso la mail non esista o non ci siano mail iscritte */
            if(isset($_POST['btnRecPass'])){
                header("Location: ../recover.php?error=somethingIsWrong");
                exit();
            }
            if(isset($_POST['admBtnNewsletter'])){
                header("Location: ../admin/adm_mail.php?error=emptySpace2");
                exit();
            }
            header("Location: ../index.php?error=somethingWrong");
            exit();
        }

        if(!$row = mysqli_fetch_assoc($result))
        {
            
            if(isset($_POST['btnRecPass'])){
                header("Location: ../recover.php?error=somethingIsWrong");
                exit();
            }
            if(isset($_POST['admBtnNewsletter'])){
                header("Location: ../admin/adm_mail.php?error=emptySpace2");
                exit();
            }
            header("Location: ../index.php?error=somethingWrong");
            exit();
        }
        
        // inizio creazione oggetto PHPMailer
        date_default_timezone_set('Etc/UTC');
        require_once "../PHPMailer/PHPMailer.php";
        require_once "../PHPMailer/SMTP.php";
        require_once "../PHPMailer/Exception.php";

        $mail = new PHPMailer(); //creazione oggetto mail

        $mail->isSMTP();
        $mail->Host = gethostbyname('ssl://smtp.gmail.com');
        $mail->SMTPAuth = true;
        $mail->Username = "zenaster2020@gmail.com";
        $mail->Password = "progettosaw2020";
        $mail->Port = 465; //587
        $mail->SMTPSecure = "ssl"; // o tls

        // filtriamo i risultati
        if ($result){
            $query = mysqli_num_rows($result);
        }else
            $query = 0;
        
        if ($query > 0)
        {
            // se recpass
            if(isset($_POST['btnRecPass']))
            {
                // invia mail
                $mail->isHTML(true);
                $mail->setFrom($row['email']);
                $mail->addAddress($row['email']);
                $mail->Subject = "Ripristina la password";
                $mail->Body = $message;
                if (!$mail->send())
                {
                    header("Location: ../index.php?error=sendError");
                    exit();
                }
            }
            else if(isset($_POST['admBtnNewsletter'])) // se area admin
            {
                // settiamo i destinatari della mail
                do
                {
                    $mail->isHTML(true);
                    $mail->setFrom($row['email']);
                    $mail->addAddress($row['email']);
                }while($row = mysqli_fetch_assoc($result));

                // inviamo mail a tutti gli iscritti newsletter
                $mail->Subject = "Un messaggio da Zenaster!";
                $mail->Body = $message."<br>Se vuoi disiscriverti da questa newsletter manda una mail a zenaster2020@gmail.com";
                if (!$mail->send())
                {
                    header("Location: ../admin/adm_index.php?error=sendError");
                    exit();
                }
                
                header("Location: ../admin/adm_index.php?message=emailSuccess");
                exit();
            }
            header("Location: ../index.php?message=emailSuccess");
            exit();
        }    
        else
        {
            header("Location: ../index.php?error=somethingWrong");
            exit();
        }
    }
    else
    {
        header("Location: ../index.php?error=somethingWrong");
        exit();
    }
?>
