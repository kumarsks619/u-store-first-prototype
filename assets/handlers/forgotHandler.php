<?php
    session_start();

    include('conHandler.php');      //including connection handler

    //PHP Mailer includes
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    include('../../PHPMailer/PHPMailer.php');
    include('../../PHPMailer/Exception.php');
    include('../../PHPMailer/SMTP.php');

    //function to create token 
    function createToken(){
        $str = "qwertyuiopasdfghjklzxcvbnm123456789";   //token will choose values from this
        $str = str_shuffle($str);                       //shuffling the string
        $token = substr($str, 0, 10);                     //taking only first 10 characters for token

        return $token; 
    }

    //RESET PASSWORD************************************************************************************
    if(isset($_POST['forgotPasswordBtn'])){
        $username = $_POST['forgotPasswordUsername'];       //username
        $email = $_POST['forgotPasswordEmail'];             //email

        //checking if the email and username exists or not
        $query = "SELECT id FROM users WHERE username = '$username' AND email = '$email' ";
        $result = mysqli_query($con, $query);
        if(mysqli_num_rows($result) == 0){
            $_SESSION['forgotCheck'] = 1;
            $_SESSION['modalContent'] = "<div class='modal-body'>   
                                            <div class='alert alert-danger'>
                                                <strong>No such user exists</strong> for this username and email !
                                            </div>
                                        </div>
                                        <div class='modal-footer'>
                                            <button type='button' class='btn btn-danger' data-dismiss='modal'>Okay</button>
                                        </div>";

            header("Location: ../../index.php");        //redirecting to index page
            exit();
        }

        //creating a token entry in forgot password table in database
        $token = createToken();        //creating a token
        date_default_timezone_set('Asia/Calcutta');     //setting default timezone
        $query = "INSERT into forgot_password VALUES('', '$username', '$token', DATE_ADD(NOW(), INTERVAL 5 MINUTE)) ";
        mysqli_query($con, $query);

        //creating link to reset password
        $link = "http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . "/resetPasswordHandler.php?username=$username&token=$token";
        

        //mailing starts here************************************************************
        // Instantiation and passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                       // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = 'ustore.sks@gmail.com';                // SMTP username
            $mail->Password   = 'ustore51431981';                          // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
        
            //Recipients
            $mail->setFrom('ustore.sks@gmail.com', 'U-store');         //sent from
            $mail->addAddress($email, $username);                       // Add a recipient
            $mail->addReplyTo('no-reply@gmail.com', 'No reply');        //setting no-reply email
        
            // Content
            $mail->isHTML(true);                                            // Set email format to HTML
            $mail->Subject = "Reset Password";                              //mail subject
            $mail->Body = "<h1>U-store</h1>                                 
                            Hello there!
                            <br><br>
                            In order to reset your password <a href='$link'>click here.</a>
                            <br><br>
                            Kind Regards,<br>
                            U-store";
            //non-HTML mail if HTML one couldn't be loaded due to some reasons
            $mail->AltBody = "U-store
                              Hello there!
                              In order to reset your password, paste the below link in the url column and set go!
                              ";    
        
            if($mail->send()){          //if email is sent successfully
                $_SESSION['forgotCheck'] = 1;
                $_SESSION['modalContent'] = "<div class='modal-body'>   
                                                <div class='alert alert-success'>
                                                    <strong>Check your email inbox.</strong><br>
                                                    <small class='text-muted'>Link valid only for 5 minutes.</small>
                                                </div>
                                            </div>
                                            <div class='modal-footer'>
                                                <button type='button' class='btn btn-success' data-dismiss='modal'>Okay</button>
                                            </div>";

                header("Location: ../../index.php");        //redirecting to index page
                exit();
            }
        } catch (Exception $e) {
            $_SESSION['forgotCheck'] = 1;
            $_SESSION['modalContent'] = "<div class='modal-body'>   
                                            <div class='alert alert-danger'>
                                                <strong>Something went wrong !!!</strong><br>Mailer Error: {$mail->ErrorInfo}<br>Try again.
                                            </div>
                                        </div>
                                        <div class='modal-footer'>
                                            <button type='button' class='btn btn-danger' data-dismiss='modal'>Okay</button>
                                        </div>";

            header("Location: ../../index.php");        //redirecting to index page
            exit();
        }
    }
   

    //FORGOT USERNAME***********************************************************************************
    if(isset($_POST['forgotUsernameBtn'])){
        $email = $_POST['forgotUsernameEmail'];             //email to send mail to

        //checking if the email exists or not
        $query = "SELECT id FROM users WHERE email = '$email' ";
        $result = mysqli_query($con, $query);
        if(mysqli_num_rows($result) == 0){
            $_SESSION['forgotCheck'] = 1;
            $_SESSION['modalContent'] = "<div class='alert alert-danger'>
                                            <strong>No such email exists !!!</strong>
                                        </div>";
            header("Location: ../../index.php");        //redirecting to index page
            exit();
        }

        //fetching all usernames associated with the given email address
        $query = "SELECT username FROM users WHERE email = '$email' ";
        $result = mysqli_query($con, $query);
        //preparing string of all such usernames
        $usernamesStr = "";     //string to store the usernames
        $i = 1;                 //to display the count of usernames     
        while($row = mysqli_fetch_assoc($result)){
            $usernamesStr = $usernamesStr . $i . ") <strong>" . $row['username'] . "</strong><br>";
            $i++;
        }


        //mailing starts here************************************************************
        // Instantiation and passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                       // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = 'ustore.sks@gmail.com';                // SMTP username
            $mail->Password   = 'ustore51431981';                          // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
        
            //Recipients
            $mail->setFrom('ustore.sks@gmail.com', 'U-store');         //sent from
            $mail->addAddress($email);                                  // Add a recipient
            $mail->addReplyTo('no-reply@gmail.com', 'No reply');        //setting no-reply email
        
            // Content
            $mail->isHTML(true);                                            // Set email format to HTML
            $mail->Subject = "Forgot Username";                              //mail subject
            $mail->Body = "<h1>U-store</h1>                                 
                            Hello there!
                            <br><br>
                            Your username could be :<br>
                            $usernamesStr
                            <br><br>
                            Kind Regards,<br>
                            U-store";
            //non-HTML mail if HTML one couldn't be loaded due to some reasons
            $mail->AltBody = "U-store
                             Hello there!
                             Your username could be:
                             $usernamesStr";    
        
            if($mail->send()){          //if email is sent successfully
                $_SESSION['forgotCheck'] = 1;
                $_SESSION['modalContent'] = "<div class='modal-body'>   
                                                <div class='alert alert-success'>
                                                    <strong>Check your email inbox.</strong>
                                                </div>
                                            </div>
                                            <div class='modal-footer'>
                                                <button type='button' class='btn btn-success' data-dismiss='modal'>Okay</button>
                                            </div>";
                header("Location: ../../index.php");        //redirecting to index page
                exit();
            }
        } catch (Exception $e) {
            $_SESSION['forgotCheck'] = 1;
            $_SESSION['modalContent'] = "<div class='modal-body'>   
                                            <div class='alert alert-danger'>
                                                <strong>Something went wrong !!!</strong><br>Mailer Error: {$mail->ErrorInfo}<br>Try again.
                                            </div>
                                        </div>
                                        <div class='modal-footer'>
                                            <button type='button' class='btn btn-danger' data-dismiss='modal'>Okay</button>
                                        </div>";
            header("Location: ../../index.php");        //redirecting to index page
            exit();
        }
    }
?>

