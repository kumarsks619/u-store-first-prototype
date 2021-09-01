<?php
    session_start();

    include('conHandler.php');              //including connection handler
    
    $currentUser = $_SESSION['userLoggedIn'];   //current user's username

    if(isset($_POST['Id'])){
        //first name
        if($_POST['Id'] == "editFirstName"){
            $f_name = mysqli_real_escape_string($con, $_POST['user_input']);
            $f_name = ucwords(strtolower($f_name));     //upper case each letter of the string

            //sql query
            $query = "UPDATE users SET f_name = '$f_name' WHERE username = '$currentUser' ";
            mysqli_query($con, $query);

            echo "Profile Updated !";
        }

        //last name
        if($_POST['Id'] == "editLastName"){
            $l_name = mysqli_real_escape_string($con, $_POST['user_input']);
            $l_name = ucwords(strtolower($l_name));     //upper case each letter of the string

            //sql query
            $query = "UPDATE users SET l_name = '$l_name' WHERE username = '$currentUser' ";
            mysqli_query($con, $query);

            echo "Profile Updated !";
        }

        //email
        if($_POST['Id'] == "editEmail"){
            $email = $_POST['user_input'];

            //sql query
            $query = "UPDATE users SET email = '$email' WHERE username = '$currentUser' ";
            mysqli_query($con, $query);

            echo "Profile Updated !";
        }

        //primary phone number
        if($_POST['Id'] == "editPhone1"){
            $phone_1 = $_POST['user_input'];

            //sql query
            $query = "UPDATE users SET phone_1 = '$phone_1' WHERE username = '$currentUser' ";
            mysqli_query($con, $query);

            echo "Profile Updated !";
        }

        //secondary phone number
        if($_POST['Id'] == "editPhone2"){
            $phone_2 = $_POST['user_input'];

            //sql query
            $query = "UPDATE users SET phone_2 = '$phone_2' WHERE username = '$currentUser' ";
            mysqli_query($con, $query);

            echo "Profile Updated !";
        }
    }


    //changing password
    if(isset($_POST['changePwBtn'])){
        $userInput = $_POST['currentPw'];   //current pw
        $newPw = $_POST['newPw'];           //new pw

        //getting the current password from database for the current user
        $query = "SELECT pw FROM users WHERE username = '$currentUser' ";
        $result = mysqli_query($con, $query);
        $row = mysqli_fetch_assoc($result);

        if(password_verify($userInput, $row['pw']) == 1){
            //encrypting the new pw
            $newPw = password_hash($newPw, PASSWORD_DEFAULT);

            //updating the password
            $query = "UPDATE users SET pw = '$newPw' WHERE username = '$currentUser' ";
            mysqli_query($con, $query);

            $_SESSION['changePwMsg'] = "<p style='color: #28a745; font-size: 0.83rem;' class='text-center w-100 mt-0 pt-0'>Password changed successfully !</p>";   //success message to display
            
            header("Location: ../../myProfile.php");     //redirecting on success
        }else{
            $_SESSION['changePwMsg'] = "<p style='color: #dc3545; font-size: 0.83rem;' class='text-center w-100 mt-0 pt-0'>Password NOT changed !!!</p>";   //success message to display
            
            header("Location: ../../myProfile.php");     //redirecting on error
        }
    }


    //deleting account
    if(isset($_POST['deleteAccountBtn'])){
        $userInput = $_POST['password'];

        //getting the current password from database for the current user
        $query = "SELECT pw FROM users WHERE username = '$currentUser' ";
        $result = mysqli_query($con, $query);
        $row = mysqli_fetch_assoc($result);

        if(password_verify($userInput, $row['pw']) == 1){
            //deleting all the products of the user and its photos************************************
            $query = "SELECT product_photo FROM products WHERE uploaded_by = '$currentUser' ";
            $result = mysqli_query($con, $query);
            while($row = mysqli_fetch_assoc($result)){
                $productPhotoPath = $row['product_photo'];
                $productPhotoPath = "../../" . $productPhotoPath;   //photo path realative this handler
                unlink($productPhotoPath);                          //photo deleted
            }


            //deleting all the bids placed by the user************************************************
            //removing current users placed bids ids from the corresponding products
            $query = "SELECT id, product_id FROM bids WHERE bid_by = '$currentUser' ";
            $result = mysqli_query($con, $query);
            while($row = mysqli_fetch_assoc($result)){
                $bids_on_products[] = $row; //collecting all the products on which the current user placed a bid
            }
            //iterating through each product
            foreach($bids_on_products as $product){
                $productId = $product['product_id'];        //product id
                $bid_id = $product['id'];                   //bid id
                
                $query = "SELECT bids_ids FROM products WHERE id = '$productId' ";
                $result = mysqli_query($con, $query);
                $row = mysqli_fetch_assoc($result);
                $bids_ids_string_products = $row['bids_ids'];
                $bid_id = $bid_id . ",";    //value to be removed
                $bids_ids_string_products = str_replace($bid_id, "", $bids_ids_string_products);
                //updaing products table
                $query = "UPDATE products SET bids_ids = '$bids_ids_string_products' WHERE id = '$productId' ";
                mysqli_query($con, $query);
            }


            //deleting all the bids whose product owner is the current user*******************************
            //updating corresponding users who placed a bid on the current user's product
            $query = "SELECT id, bid_by FROM bids WHERE product_owner = '$currentUser' ";
            $result = mysqli_query($con, $query);
            while($row = mysqli_fetch_assoc($result)){
                $bids_owners[] = $row;      //collecting all the bid_bys on current user's products
            }
            //iterating through each bid owners
            foreach($bids_owners as $bid_owner){
                $bid_by = $bid_owner['bid_by'];   //user who placed bid on the current users's product
                $bid_id = $bid_owner['id'];       //bid id of other user who placed bid on current user's product
                
                $query = "SELECT bids_placed_ids FROM users WHERE username = '$bid_by' ";
                $result = mysqli_query($con, $query);
                $row = mysqli_fetch_assoc($result);
                $bids_ids_string_bid_by_user = $row['bids_placed_ids'];     //bids string of the other user
                $bid_id = $bid_id . ",";        //value to be deleted
                $bids_ids_string_bid_by_user = str_replace($bid_id, "", $bids_ids_string_bid_by_user);  //string prepared
                //updating users table
                $query = "UPDATE users SET bids_placed_ids = '$bids_ids_string_bid_by_user' WHERE username = '$bid_by' ";
                mysqli_query($con, $query);
            }


            //deleting the remember me cookie for the current user********************************
            if(isset($_COOKIE['userLoggedIn'])){
                setcookie("userLoggedIn", "", time()-3600, "/"); //destroying login cookie
            }


            //deleting records from database**************************************************** 
            //deleting all the products records uploaded of the current user from products table
            $query = "DELETE FROM products WHERE uploaded_by = '$currentUser' ";
            mysqli_query($con, $query);
            //deleting all the bids records placed by the current user from bids table
            $query = "DELETE FROM bids WHERE bid_by = '$currentUser' ";
            mysqli_query($con, $query);
            //deleting all the bids records placed on the current user's products from bids table
            $query = "DELETE FROM bids WHERE product_owner = '$currentUser' ";
            mysqli_query($con, $query);
            //deleting all the notification of the current user from noti table
            $query = "DELETE FROM noti WHERE user_to = '$currentUser' ";
            mysqli_query($con, $query);
            //deleting the user record from users table
            $query = "DELETE FROM users WHERE username = '$currentUser' ";
            mysqli_query($con, $query);


            $_SESSION['accountDeleteCheck'] = 1;   //account deleted successfully

            header("Location: ../../index.php");    //when account is deleted
        }else{
            $_SESSION['accountDeleteCheck'] = 0;   //password not matched

            header("Location: ../../myProfile.php");    //when account is NOT deleted
        }

    }


    //if notthing is set******************************************************************************
    if(!isset($_POST['Id']) && !isset($_POST['deleteAccountBtn']) && !isset($_POST['changePwBtn'])){
        header("Location: ../../index.php");    //when directly trying to access this handler
    }
?>