<?php
    session_start();

    include('conHandler.php');      //including connection handler
    include('../includes/errorsList.php');      //including errors list
    

    if(isset($_POST['usernameLogin'], $_POST['password'])){
        $username = mysqli_real_escape_string($con, $_POST['usernameLogin']);
        $password = mysqli_real_escape_string($con, $_POST['password']);
        $rememberMe = $_POST['rememberMe'];

        $errno = -1;      //initializing errno variable

        $query = "SELECT pw FROM users WHERE username = '$username' ";
        $result = mysqli_query($con, $query);
        if(mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_assoc($result);
            if(password_verify($password, $row['pw']) == 1){
                $_SESSION['userLoggedIn'] = $username;
                $errno = 19;        //login successful
                if($rememberMe == 1){
                    //setting up remember me
                    $userLoggedIn = $_SESSION['userLoggedIn'];                      //cookie variables
                    setcookie("userLoggedIn" ,$userLoggedIn, time()+60*60*24*30, "/");  //cookie set for 30days
                }
                header("Location: ../../home.php");        //when user is logged in successfully
                exit();
            }else{
                $errno = 17;        //password incorrect
            }
        }else{
            $errno = 18;        //invalid username
        }
        //setting errno value to a global variable
        $_SESSION['errno_login'] = $errno;
        $_SESSION['login_error_string'] = $error[$_SESSION['errno_login']];        //error string
        header("Location: ../../index.php?error");    //redirecting to index as an error has occured     
    }else{
        header("Location: ../../index.php");    //when directly trying to access this handler
    }
?>