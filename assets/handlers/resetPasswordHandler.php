<?php
    //checking link validity***************************************************************************
    if(isset($_GET['username'], $_GET['token'])){
        include('conHandler.php');              //including connection handler

        $username = $_GET['username'];      //username of which password is need to reset
        $token = $_GET['token'];            //token

        //sql query to check if the token is valid or not
        $query = "SELECT id, token_expiry FROM forgot_password WHERE username = '$username' AND token = '$token' ";
        $result = mysqli_query($con, $query);
        if(mysqli_num_rows($result) == 0){
            exit("<h1>Token is Invalid !!!</h1>");      //when no such token exists for the current username
        }else{
            $row = mysqli_fetch_assoc($result);
            $tokenExpiry = $row['token_expiry'];        //token expiry time

            date_default_timezone_set('Asia/Calcutta');     //setting default timezone
            $currentDateTime = date("Y-m-d H:i:s");         //current date and time

            if($currentDateTime > $tokenExpiry){
                //deleting the token
                $query = "DELETE FROM forgot_password WHERE token = '$token' ";
                mysqli_query($con, $query);

                exit("<h1>Link has Expired !!!</h1>");
            }
        }
    }else{
        exit("<h1>Link is broken !!!</h1>");     //when directly trying to access this handler
    }

    //Reset Form Handling********************************************************************************
    if(isset($_POST['resetPasswordSubmitBtn'])){
        $pw1 = strip_tags($_POST['password']);              //passowrd
        $pw2 = strip_tags($_POST['confirmPassword']);       //confirm password

        if($pw2 == $pw1){
            $pw = $pw1;
            if(preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,32})/', $pw)){
                $pw = password_hash($pw, PASSWORD_DEFAULT);     //encrypting the password
                //updating the password in the database
                $query = "UPDATE users SET pw = '$pw' WHERE username = '$username' ";
                $result = mysqli_query($con, $query);

                if($result){
                    //deleting the token
                    $query = "DELETE FROM forgot_password WHERE token = '$token' ";
                    mysqli_query($con, $query);

                    $error = "<span id='errorSuccess'>Password Reset Successful ! Go and Login.</span>";     //all good, reset successful
                }else{
                    $error = "<span id='error'>Something went wrong !!! Try again.</span>";  //when there is an error with sql
                }
            }else{
                $error = "<span id='error'>Password requirements NOT statisfied !!!</span>";     //all password requirements are not satisfied
            }
        }else{
            $error = "<span id='error'>Passwords did NOT matched !!!</span>";     //password did not match
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>U-store | Password Reset</title>

    <!-- favicon -->
    <link rel="shortcut icon" href="../img/favicon.ico">

    <style type="text/css">
        body{
            font-family: Arial, Helvetica, sans-serif;
        }
        form{
            width: fit-content;
            display: flex;
            flex-direction: column;
            margin: 20px auto;
            border-radius: 7px;
            background-color: #fff;
            padding: 20px;
            border: 2px solid #DADADA;
            color: #6e6e6e;
        }
        h4{
            text-align: center;
            margin: 0 10px 10px 0;
        }
        .headerGroup{
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px !important;
        }
        img{
            width: 120px;
        }
        .headerGroup span{
            font-size: 1.2rem;
            font-weight: bold;
            margin-right: 10px;
        }
        .formGroup{
            margin: 5px 2px;
        }
        .formGroup input{
            float: right;
            width: 200px;
            border: 1px solid #DADADA;
            border-radius: 3px;
            padding: 5px;
        }
        .formGroup label{
            float: left;
            margin-right: 5px;
            padding: 5px;
            font-variant: small-caps;
            font-size: 0.8rem; 
        }
        input[type="submit"]{
            margin-top: 10px;
            margin-bottom: 10px;
            width: fit-content;
            margin-left: auto;
            border: none;
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px
        }
        input[type="submit"]:hover{
            cursor: pointer;
            background-color: #62aeff;
        }
        input[type="submit"]:active{
            cursor: pointer;
            background-color: #005dc0;
        }
        #error{
            text-align: center;
            color: #dc3545;
            font-size: 0.9rem;
            margin: 5px 0;
        }
        #errorSuccess{
            text-align: center;
            color: #28a745;
            font-size: 0.9rem;
            margin: 5px 0;
        }
    </style>
</head>
<body>

    <form action="" method="POST" autocomplete="off">
        <div class="formGroup headerGroup">
            <img src="../img/logo.jpg">
            <span>Reset Password</span>
        </div>
        <div class="formGroup">
            <label>New Password</label>
            <input type="password" name='password' placeholder="Set a new password" required>
        </div>
        <div class="formGroup">
            <label>Confirm Password</label>
            <input type="password" name='confirmPassword' placeholder="Confirm your new password" required>
        </div>
        <?php
            if(isset($error)){
                echo $error;
            }
        ?>
        <input type="submit" name="resetPasswordSubmitBtn" value="Reset Password">
    </form>
    
</body>
</html>