<?php
    session_start();
    include('../handlers/conHandler.php');          //including connection handler

    if(isset($_POST['diff_var'])){
        //product owner's info**********************************************************************
        if($_POST['diff_var'] == "productOwnerInfo"){
            $username = $_POST['user'];                 //user whose info is requested
            $currentUser = $_SESSION['userLoggedIn'];   //user who requested
            $productId = $_POST['product_id'];          //current product's id   
    
            //sql query to check if the current user has any bid on the current product
            $query = "SELECT bid_status FROM bids WHERE product_id = '$productId' AND bid_by = '$currentUser' ";
            $result = mysqli_query($con, $query);
            if(mysqli_num_rows($result) > 0){         //if bid is placed by the current user on the current product
                $row = mysqli_fetch_assoc($result);
                $bidStatus = $row['bid_status'];        //bid status of the current user on the current product
                if($bidStatus == 'accepted'){
                    $showFullInfo = 1;                      //show full info of the user to the current user
                }else{
                    $showFullInfo = 0;                      //show short info of the user
                }
            }else{
                $showFullInfo = 0;                      //show short info of the user
            }
    
            //checking whether to show full info or not
            if($showFullInfo == 1){
                //sql query to show full info
                $query = "SELECT f_name, l_name, email, phone_1, phone_2 FROM users WHERE username = '$username' ";
                $result = mysqli_query($con, $query);
                $row = mysqli_fetch_assoc($result);
                //user's info
                $fullName = $row['f_name'] . " " . $row['l_name'];      //user's full name
                $email = $row['email'];                                 //user's email
                $phone1 = $row['phone_1'];                              //user's primary phone no.
                $phone2 = $row['phone_2'];                              //user's secondary phone no.
    
                //checking if the user's secondary phone is available or not
                if($phone2 == ""){
                    $phone2 = "not available";      //secondary phone no. is not available
                }
    
                //preparing user's info string to be ecohed for ajax response
                $userInfoString = "fullInfo," . $fullName . "," . $email . "," . $phone1 . "," . $phone2;
            }else{
                //sql query to show short info
                $query = "SELECT f_name, l_name, email FROM users WHERE username = '$username' ";
                $result = mysqli_query($con, $query);
                $row = mysqli_fetch_assoc($result);
                //user's info
                $fullName = $row['f_name'] . " " . $row['l_name'];      //user's full name
                $email = $row['email'];                                 //user's email
    
                //preparing user's info string to be ecohed for ajax response
                $userInfoString = "shortInfo," . $fullName . "," . $email;
            }
    
            echo $userInfoString;           //echoing the info string
        }

        //bid owner's info*****************************************************************
        if($_POST['diff_var'] == "bidOwnerInfo"){
            $username = $_POST['user'];                 //user whose info is requested
            $currentUser = $_SESSION['userLoggedIn'];   //user who requested
            $productId = $_POST['product_id'];          //current product's id
            
            //sql query to get the bid status of the bid which is clicked
            $query = "SELECT bid_status FROM bids WHERE product_id = '$productId' AND bid_by = '$username' ";
            $result = mysqli_query($con, $query);
            $row = mysqli_fetch_assoc($result);
            $bidStatus = $row['bid_status'];

            if($bidStatus == 'accepted'){
                $showFullInfo = 1;               //show full info of the bid owner to the product owner
            }else{
                $showFullInfo = 0;               //show short info of the bid owner to the product owner
            }

            //checking whether to show full info or not
            if($showFullInfo == 1){
                //sql query to show full info
                $query = "SELECT f_name, l_name, email, phone_1, phone_2 FROM users WHERE username = '$username' ";
                $result = mysqli_query($con, $query);
                $row = mysqli_fetch_assoc($result);
                //user's info
                $fullName = $row['f_name'] . " " . $row['l_name'];      //user's full name
                $email = $row['email'];                                 //user's email
                $phone1 = $row['phone_1'];                              //user's primary phone no.
                $phone2 = $row['phone_2'];                              //user's secondary phone no.
    
                //checking if the user's secondary phone is available or not
                if($phone2 == ""){
                    $phone2 = "not available";      //secondary phone no. is not available
                }
    
                //preparing user's info string to be ecohed for ajax response
                $userInfoString = "fullInfo," . $fullName . "," . $email . "," . $phone1 . "," . $phone2;
            }else{
                //sql query to show short info
                $query = "SELECT f_name, l_name, email FROM users WHERE username = '$username' ";
                $result = mysqli_query($con, $query);
                $row = mysqli_fetch_assoc($result);
                //user's info
                $fullName = $row['f_name'] . " " . $row['l_name'];      //user's full name
                $email = $row['email'];                                 //user's email
    
                //preparing user's info string to be ecohed for ajax response
                $userInfoString = "shortInfo," . $fullName . "," . $email;
            }
    
            echo $userInfoString;           //echoing the info string
        }
    }else{
        header("Location: ../../index.php");    //when directly trying to access this resource
    }
?>