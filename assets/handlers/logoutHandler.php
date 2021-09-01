<?php
    if(isset($_POST['logout'])){
        session_start();
        unset($_SESSION['userLoggedIn'], $_SESSION['currentUserCollege']);   //destroying login session
        //checking if cookie is set or not
        if(isset($_COOKIE['userLoggedIn'])){
            setcookie("userLoggedIn", "", time()-3600, "/"); //destroying login cookie
        } 
        $_SESSION['logoutCheck'] = 1;   //creating a session variable to display the logout alert

        header("Location: ../../index.php");    //when logged out successfully
    }else{
        header("Location: ../../index.php");    //when directly trying to access this handler
    }
?>