<?php 
    session_start();      
    
    //PHP Mailer includes
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    include('../../PHPMailer/PHPMailer.php');
    include('../../PHPMailer/Exception.php');
    include('../../PHPMailer/SMTP.php');

    if(isset($_POST['sendContactUs'])){
        $emailFromName = $_POST['nameContactUs'];       //mailer name
        $emailFrom = $_POST['emailContactUs'];        //email from
        $emailSubject = $_POST['subjectContactUs'];  //email subject
        $emailMsg = $_POST['messageContactUs'];     //email message        
        
        //mailing starts here************************************************************
        // Instantiation and passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                       // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = 'EMAIL ADDRESS';                 // SMTP username
            $mail->Password   = 'EMAIL PASSWORD';                       // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
        
            //Recipients
            $mail->setFrom($emailFrom, $emailFromName);         //sent from
            $mail->addAddress('ustore.sks@gmail.com', 'U-store');       // Add a recipient
            $mail->addReplyTo($emailFrom, $emailFromName);        //setting no-reply email
        
            // Content
            $mail->isHTML(true);                                            // Set email format to HTML
            $mail->Subject = $emailSubject;                              //mail subject
            $mail->Body = $emailMsg;   
        
            if($mail->send()){          //if email is sent successfully
                $_SESSION['contactUsCheck'] = 1;        //to display the success message
                $_SESSION['contactedUser'] = $emailFromName;    //mailer's full name
                header("Location: ../../index.php?contactUs=success");
                exit();
            }
        } catch (Exception $e) {
            $_SESSION['contactUsCheck'] = 0;        //to display the error message
            $_SESSION['contactedUser'] = $emailFromName;    //mailer's full name
            header("Location: ../../index.php?contactUs=error");
            exit();
        }
    }else{
        $_SESSION['contactUsCheck'] = 0;        //to display the error message
        header("Location: ../../index.php?forbidden");    //when directly trying to access this handler
    }
?>