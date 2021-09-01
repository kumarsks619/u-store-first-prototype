<?php
    session_start();

    include('../handlers/conHandler.php');                  //including connection handler
    include('../includes/errorsList.php');      //including error list

    if(isset($_POST['Id'])){
        //first name
        if($_POST['Id'] == "editFirstName"){
            $f_name = mysqli_real_escape_string($con, $_POST['user_input']);
            $f_name = ucwords(strtolower($f_name));     //upper case each letter of the string
            $errno = -1;      //initializing errno variable
            if($f_name == ""){
                $errno = 16;      //if field is blank
            }else{
                if(strlen($f_name) >= 2 && strlen($f_name) <= 50){
                    if(preg_match('/[^A-Za-z\s]/', $f_name)){
                        $errno = 2;   //contains unacceptable characters
                    }else{
                        $errno = 1;    //all good
                    }
                }else{
                    $errno = 3;   //string length incorrect
                }
            }
            $error_string = $error[$errno];   //preparing all the required data to be returned in the form of a string
            echo $errno . ":" . $error_string;      //echoing for ajax return data
        }

        //last name
        if($_POST['Id'] == "editLastName"){
            $l_name = mysqli_real_escape_string($con, $_POST['user_input']);
            $l_name = ucwords(strtolower($l_name));     //upper case each letter of the string
            $errno = -1;      //initializing errno variable
            if($l_name == ""){
                    $errno= 1;      //if field is blank
            }else{
                if(strlen($l_name) >= 2 && strlen($l_name) <= 50){
                    if(preg_match('/[^A-Za-z\s]/', $l_name)){
                        $errno = 2;   //contains unacceptable characters
                    }else{
                        $errno = 1;    //all good
                    }
                }else{
                    $errno = 3;   //string length incorrect
                }
            }
            $error_string = $error[$errno];   //preparing all the required data to be returned in the form of a string 
            echo $errno . ":" . $error_string;      //echoing for ajax return data
        }
        
        //email
        if($_POST['Id'] == "editEmail"){
            $email = $_POST['user_input'];
            $errno = -1;      //initializing errno variable
            if($email == ""){
                $errno = 16;      //if field is blank
            }else{
                if(filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match('/[^a-z0-9\.@]/', $email)){
                    $email = filter_var($email, FILTER_VALIDATE_EMAIL); //setting validated email format to variable
                    $errno = 1;      //all good
                }else{
                    $errno = 7;   //invalid email format
                }
            }
            $error_string = $error[$errno];   //preparing all the required data to be returned in the form of a string
            echo $errno . ":" . $error_string;      //echoing for ajax return data
        }

        //primary phone number
        if($_POST['Id'] == "editPhone1"){
            $phone_1 = $_POST['user_input'];
            $errno = -1;      //initializing errno variable
            if($phone_1 == ""){
                $errno = 16;      //if field is blank
            }else{
                if(strlen($phone_1) == 10){
                    if(preg_match('/^[6-9][0-9]{9}$/', $phone_1)){
                        $errno = 1;      //all good
                    }else{
                        $errno = 9;      //invalid phone number
                    }
                }else{
                    $errno = 8;  //phone number doesn't contain 10 digits
                }
            }
            $error_string = $error[$errno];   //preparing all the required data to be returned in the form of a string
            echo $errno . ":" . $error_string;      //echoing for ajax return data
        }

        //secondary phone number
        if($_POST['Id'] == "editPhone2"){
            $phone_2 = $_POST['user_input'];
            $phone_1 = $_POST['req_user_input'];
            $errno = -1;      //initializing errno variable
            if($phone_2 == ""){
                $errno = 1;      //if field is blank
            }else{
                if(strlen($phone_2) == 10){
                    if(preg_match('/^[6-9][0-9]{9}$/', $phone_2)){
                        if($phone_2 == $phone_1){
                            $errno = 10;     //same as primary phone number
                        }else{
                            $errno = 1;      //all good
                        }
                    }else{
                        $errno = 9;      //invalid phone number
                    }
                }else{
                    $errno = 8;  //phone number doesn't contain 10 digits 
                }
            }
            $error_string = $error[$errno];   //preparing all the required data to be returned in the form of a string
            echo $errno . ":" . $error_string;      //echoing for ajax return data
        }

        //new password 1
        if($_POST['Id'] == "newPw1"){
            $pw1 = $_POST['user_input'];
            $errno = -1;      //initializing errno variable
            if($pw1 == ""){
                $errno = 16;      //if field is blank
            }else{
                if(preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,32})/', $pw1)){
                    $errno = 1;          //all good
                }else{
                    $errno = 14;     //all password requirements are not satisfied
                }
            }
             //storing error no. in global variable
             $_SESSION['errno_pw1'] = $errno;

            $error_string = $error[$errno];   //preparing all the required data to be returned in the form of a string
            echo $errno . ":" . $error_string;      //echoing for ajax return data
        }

        //new password 2
        if($_POST['Id'] == "newPw2"){
            $pw2 = $_POST['user_input'];
            $pw1 = $_POST['req_user_input'];
            $errno = -1;      //initializing errno variable
            if($pw2 == ""){
                $errno = 16;      //if field is blank
            }else{
                if($pw2 == $pw1){
                    $pw = $pw2;
                    if(preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,32})/', $pw)){
                        $errno = 1;          //all good
                    }else{
                        $errno = 14;     //all password requirements are not satisfied
                    }
                }else{
                    $errno = 15;     //password did not match
                }
            }
             //storing error no. in global variable
            $_SESSION['errno_pw2'] = $errno;

            $error_string = $error[$_SESSION['errno_pw2']];   //preparing all the required data to be returned in the form of a string
            echo $_SESSION['errno_pw2'] . ":" . $error_string;      //echoing for ajax return data
        }
    }else{
        header("Location: ../../index.php");    //when directly trying to access this resource
    }
?>