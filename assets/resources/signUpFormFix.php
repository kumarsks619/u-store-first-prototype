<?php
    session_start();

    if(isset($_POST['reset_var'])){
        //FIX: resetting the select input errnos if the preceding select input is modified again
        if($_POST['reset_var'] == "resetState"){
            if(isset($_SESSION['errno_ccity'])){ unset($_SESSION['errno_ccity']); }
            if(isset($_SESSION['errno_cname'])){ unset($_SESSION['errno_cname']); } 
        }

        //FIX: resetting the select input errnos if the preceding select input is modified again
        if($_POST['reset_var'] == "resetCity"){
            if(isset($_SESSION['errno_cname'])){ unset($_SESSION['errno_cname']); } 
        }
    }else{
        header("Location: ../../index.php");    //when directly trying to access this resource
    }
       
?>