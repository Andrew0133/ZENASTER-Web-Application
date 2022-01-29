<?php
    use PHPMailer\PHPMailer\PHPMailer; 

    if (isset($_POST['btnNews']))
    {
        if (!isset($_POST['email']))
        {
            header("Location: index.php?error=newsletter_error");
            exit();
        }
            $email = $_POST['email'];

            date_default_timezone_set('Etc/UTC');
            require_once "PHPMailer/PHPMailer.php";
            require_once "PHPMailer/SMTP.php";
            require_once "PHPMailer/Exception.php";

            $mail = new PHPMailer(); //creazione oggetto mail

            $mail->isSMTP();
            $mail->Host = gethostbyname('ssl://smtp.gmail.com');
            $mail->SMTPAuth = true;
            $mail->Username = "zenaster2020@gmail.com";
            $mail->Password = "progettosaw2020";
            $mail->Port = 465; //o 587 (per tls)
            $mail->SMTPSecure = "ssl"; // o tls

            //settings
            $mail->isHTML(true);
            $mail->setFrom($email);
            $mail->addAddress($email);
            $mail->Subject = "Iscrizione alla newsletter di Zenaster effettuata con successo!"; 
            $mail->Body = "Ti informiamo che l'iscrizione alla newsletter di Zenaster e' avvenuta con successo. Riceverai informazioni riguardanti
            gli ultimi prodotti di tuo interesse, si spera...";

            if ($mail->send())
            {                
                require 'utils/connect_db.php';
                
                if (!$stmt = mysqli_stmt_init($conn)) 
                {
                    header("Location: index.php?error=newsletter_error");
                    exit();
                }

                $sql = "INSERT INTO newsletter VALUES (default, ?)"; //Inseriamo la mail nella newsletter
        
                if (!mysqli_stmt_prepare($stmt, $sql))
                {         
                    header("Location: index.php?error=newsletter_error");
                    exit();
                }

                if (!mysqli_stmt_bind_param($stmt, "s", $email))
                {
                    header("Location: index.php?error=newsletter_error");
                    exit();
                }

                if (!mysqli_stmt_execute($stmt))
                {
                    header("Location: index.php?error=newsletter_error");
                    exit();
                }

                mysqli_stmt_close($stmt);
                mysqli_close($conn);
                header("Location: index.php?message=subscribeSuccess");
                exit();
            }
            else{
                header("Location: index.php?error=newsletter_error");
                exit();
            }
    }
    else
    {
        header("Location: ../index.php");
        exit();
    }
?>