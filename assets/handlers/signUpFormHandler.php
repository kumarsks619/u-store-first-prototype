<?php
    session_start();

    include('conHandler.php');      //including connection handler
    include('../includes/errorsList.php');      //including errors list

    if(isset($_POST['Id'])){
        //ajax resource for first name
        if($_POST['Id'] == "firstName"){
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
            //storing error no. in global variable
            $_SESSION['errno_fname'] = $errno;

            $error_string = $error[$errno];   //preparing all the required data to be returned in the form of a string
            echo $errno . ":" . $error_string;      //echoing for ajax return data
        }

    
        //ajax resource for last name
        if($_POST['Id'] == "lastName"){
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
            //storing error no. in global variable
            $_SESSION['errno_lname'] = $errno;

            $error_string = $error[$errno];   //preparing all the required data to be returned in the form of a string 
            echo $errno . ":" . $error_string;      //echoing for ajax return data
        }

    
        //ajax resource for username
        if($_POST['Id'] == "usernameSignUp"){
            $username = mysqli_real_escape_string($con, $_POST['user_input']);
            $errno = -1;      //initializing errno variable
            if($username == ""){
                $errno = 16;      //if field is blank
            }else{
                if(strlen($username) >= 2 && strlen($username) <= 30){
                    if(preg_match('/[^a-z0-9_]/', $username)){
                        $errno = 4;   //contains unacceptable characters
                    }else{
                        $query = "SELECT id FROM users WHERE username='$username' ";
                        $result = mysqli_query($con, $query);
                        if(mysqli_num_rows($result) > 0){
                            $errno = 5;    //username already exists
                        }else{
                            $errno = 1;    //all good
                        }
                    }
                }else{
                    $errno = 3;   //string length incorrect
                }
            }
            //storing error no. in global variable
            $_SESSION['errno_username'] = $errno;

            $error_string = $error[$errno];   //preparing all the required data to be returned in the form of a string
            echo $errno . ":" . $error_string;      //echoing for ajax return data
        }


        //ajax resource for avatar
        if($_POST['Id'] == "selectAvatar"){
            $avatar = $_POST['avatar_value'];
            $_SESSION['avatar'] = $avatar;          //to be used in inserting data function
            $errno = -1;      //initializing errno variable
            if($avatar == 0){
                $errno = 6;  //avatar not choosen
            }else{
                $avatarLink = "assets/img/avatars/avatar" . $_SESSION['avatar'] . ".png";   //link to send to database
                $errno = 1;      //all good
            }
            //storing error no. in global variable
            $_SESSION['errno_avatar'] = $errno;

            $error_string = $error[$errno];   //preparing all the required data to be returned in the form of a string
            echo $errno . ":" . $error_string;      //echoing for ajax return data
        }


        //ajax resource for email
        if($_POST['Id'] == "email"){
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
            //storing error no. in global variable
            $_SESSION['errno_email'] = $errno;

            $error_string = $error[$errno];   //preparing all the required data to be returned in the form of a string
            echo $errno . ":" . $error_string;      //echoing for ajax return data
        }

        
        //ajax resource for primary phone number
        if($_POST['Id'] == "phone1"){
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
            //storing error no. in global variable
            $_SESSION['errno_phone1'] = $errno;

            $error_string = $error[$errno];   //preparing all the required data to be returned in the form of a string
            echo $errno . ":" . $error_string;      //echoing for ajax return data
        }

        
        //ajax resource for secondary phone number
        if($_POST['Id'] == "phone2"){
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
            //storing error no. in global variable
            $_SESSION['errno_phone2'] = $errno;

            $error_string = $error[$errno];   //preparing all the required data to be returned in the form of a string
            echo $errno . ":" . $error_string;      //echoing for ajax return data
        }

        //ajax resource for college state
        if($_POST['Id'] == "selectState"){
            $c_state = $_POST['user_input'];
            $errno = -1;      //initializing errno variable
            if($c_state == "College State"){
                $errno = 11;     //college state not choosen
            }else{
                $errno = 1;      //all good
            }
            //storing error no. in global variable
            $_SESSION['errno_cstate'] = $errno;

            $error_string = $error[$errno];   //preparing all the required data to be returned in the form of a string
            echo $errno . ":" . $error_string;      //echoing for ajax return data
        }


        //ajax resource for college city
        if($_POST['Id'] == "selectCity"){
            $c_city = $_POST['user_input'];
            $errno = -1;      //initializing errno variable
            if($c_city == "College City"){
                $errno = 12;     //college state not choosen
            }else{
                $errno = 1;      //all good
            }
            //storing error no. in global variable
            $_SESSION['errno_ccity'] = $errno;

            $error_string = $error[$errno];   //preparing all the required data to be returned in the form of a string
            echo $errno . ":" . $error_string;      //echoing for ajax return data
        }


        //ajax resource for college
        if($_POST['Id'] == "selectCollege"){
            $c_name = $_POST['user_input'];
            $errno = -1;      //initializing errno variable
            if($c_name == "College Name"){
                $errno = 13;     //college state not choosen
            }else{
                $errno = 1;      //all good
            }
            //storing error no. in global variable
            $_SESSION['errno_cname'] = $errno;

            $error_string = $error[$errno];   //preparing all the required data to be returned in the form of a string
            echo $errno . ":" . $error_string;      //echoing for ajax return data
        }


        //ajax resource for password
        if($_POST['Id'] == "password1"){
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


        //ajax resource for confirm password
        if($_POST['Id'] == "password2"){
            $pw2 = $_POST['user_input'];
            $pw1 = $_POST['req_user_input'];
            $errno = -1;      //initializing errno variable
            if($pw2 == ""){
                $errno = 16;      //if field is blank
            }else{
                if($pw2 == $pw1){
                    $pw = $pw2;
                    if(preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,32})/', $pw)){
                        $pw = password_hash($pw, PASSWORD_DEFAULT);     //encrypting the password
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



        //ajax resource for toggling sign up button
        if($_POST['Id'] == "signUpNavBtn"){ 
            if(isset($_SESSION['errno_fname'], $_SESSION['errno_lname'], $_SESSION['errno_username'], 
                    $_SESSION['errno_avatar'], $_SESSION['errno_email'], $_SESSION['errno_phone1'],
                    $_SESSION['errno_phone2'], $_SESSION['errno_cstate'], $_SESSION['errno_ccity'],
                    $_SESSION['errno_cname'], $_SESSION['errno_pw1'], $_SESSION['errno_pw2'])){  
                        if($_SESSION['errno_fname'] == 1 && $_SESSION['errno_lname'] == 1 &&  $_SESSION['errno_username'] == 1 
                        && $_SESSION['errno_avatar'] == 1 &&  $_SESSION['errno_email'] == 1 && $_SESSION['errno_phone1'] == 1
                        && $_SESSION['errno_phone2'] == 1 && $_SESSION['errno_cstate'] == 1 && $_SESSION['errno_ccity'] == 1
                        && $_SESSION['errno_cname'] == 1 && $_SESSION['errno_pw1'] == 1 && $_SESSION['errno_pw2'] == 1){
                            echo 1;     //echoing button state value as ajax return - btn will enable
                        }else{
                            echo 0;     //echoing button state value as ajax return - btn will disable
                        }
                    }else{ 
                        echo 0;     //echoing button state value as ajax return - btn will disable
                    }
        }
    }
    

    //finally signing up and inserting data to database
    if(isset($_POST['signUp'])){
        //getting all the inputs in ONE go (stepwise already done above, individualy)
        $f_name = ucwords(strtolower(mysqli_real_escape_string($con, $_POST['firstName'])));
        $l_name = ucwords(strtolower(mysqli_real_escape_string($con, $_POST['lastName'])));
        $username = mysqli_real_escape_string($con, $_POST['username']);
        $avatarLink = "assets/img/avatars/avatar" . $_SESSION['avatar'] . ".png";
        $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
        $phone_1 = $_POST['phone1'];
        $phone_2 = $_POST['phone2'];
        $c_state = $_POST['collegeState'];
        $c_city = $_POST['collegeCity'];
        $c_name = $_POST['collegeName'];
        $pw = password_hash($_POST['password1'], PASSWORD_DEFAULT);

        //sql query to insert data to database
        $query = "INSERT INTO users VALUES('', '$f_name', '$l_name', '$username', '$avatarLink', '$email', '$phone_1',
                                            '$phone_2', '$c_state', '$c_city', '$c_name', '$pw', ',', ',' )";
        
        //finally inserting data
        mysqli_query($con, $query);

        //unsetting error code variables
        unset($_SESSION['errno_fname'], $_SESSION['errno_lname'], $_SESSION['errno_username'], 
                $_SESSION['errno_avatar'], $_SESSION['errno_email'], $_SESSION['errno_phone1'],
                $_SESSION['errno_phone2'], $_SESSION['errno_cstate'], $_SESSION['errno_ccity'],
                $_SESSION['errno_cname'], $_SESSION['errno_pw1'], $_SESSION['errno_pw2']);
        
        //unsetting the avatar session variable
        unset($_SESSION['avatar']);

        
        $_SESSION['signUpCheck'] = 1;   //to be used for displaying success message

        header("Location: ../../index.php?success");    //redirecting when sign up is successful  
    }


    if(!isset($_POST['Id']) && !isset($_POST['signUp'])){
        header("Location: ../../index.php");            //when directly trying to access this handler
    }

?>