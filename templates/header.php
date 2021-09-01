<?php
        session_start();          //starting session

        //checking if someone has logged in or not
        if(isset($_SESSION['userLoggedIn'])){
            $userLoggedIn = $_SESSION['userLoggedIn'];     //getting the username of the user who just logged in

            include('assets/handlers/conHandler.php');  //including connection handler

            //query for the respective user
            $query = "SELECT * FROM users WHERE username = '$userLoggedIn' ";
            $result = mysqli_query($con, $query);
            $row = mysqli_fetch_assoc($result);

            //respective user's details
            $firstName = $row['f_name'];
            $lastName = $row['l_name'];
            $username = $row['username'];
            $avatarLink = $row['avatar'];
            $email = $row['email'];
            $phone1 = $row['phone_1'];
            $phone2 = $row['phone_2'];
            $collegeState = $row['c_state'];
            $collegeCity = $row['c_city'];
            $collegeName = $row['c_name'];
            $pw = $row['pw'];
            $uploadedProuctIds = $row['uploaded_pro_ids'];
            $bidsPlacedIds = $row['bids_placed_ids'];

            //fetching current user's products count
            $uploadedProuctIds = explode(",", $uploadedProuctIds);
            array_shift($uploadedProuctIds);
            array_pop($uploadedProuctIds);
            $uploadedProductsCount = count($uploadedProuctIds);

            //fetching current user's placed bids count
            $bidsPlacedIds = explode(",", $bidsPlacedIds);
            array_shift($bidsPlacedIds);
            array_pop($bidsPlacedIds);
            $bidsPlacedCount = count($bidsPlacedIds);

            //fetching current user's college products count
            $query = "SELECT id FROM products WHERE c_name = '$collegeName' ";
            $result = mysqli_query($con, $query);
            $collegeProductsCount = mysqli_num_rows($result);
            if($collegeProductsCount > 100){
                $collegeProductsCount = "99+";
            }

            //deleting all the useless notifications where user_to = user_from
            $query = "DELETE FROM noti WHERE user_to = user_from ";
            mysqli_query($con, $query);

            //fetching the notifications count
            $query = "SELECT id FROM noti WHERE user_to = '$userLoggedIn' ";
            $result = mysqli_query($con, $query);
            $notiCount = mysqli_num_rows($result);
            
            $_SESSION['currentUserCollege'] = $collegeName;     //for ajax resource

        }else{
            header("Location: index.php");      //when directly trying to access this page, without loggging in 
        }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>U-store</title>

    <!-- Bootstarp CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- FontAwesome CSS -->
    <link rel="stylesheet" href="css/all.css">
    <!-- custom CSS -->
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="css/responsive.css">
    <!-- favicon -->
    <link rel="shortcut icon" href="assets/img/favicon.ico">
    
</head>
<body>
    
    <!-- nav bar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top border-bottom">
        <a class="navbar-brand" href="home.php">
            <img class="img-fluid" src="assets/img/logo.jpg" width="130" height="30" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarContent">
            <span class="navbar-toggler-icon" style="width: 0.95rem; height: 0.95rem;"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarContent">
            <ul class="navbar-nav mr-auto d-lg-none">
                <li class="nav-item">
                    <?php include('assets/includes/homeAvatar.php'); ?>
                </li>
                <li class="nav-item">
                    <?php include('assets/includes/homeMenu.php'); ?>
                </li>
            </ul>
        </div>
        <div class="searchAndUploadGroup d-flex justify-content-between align-items-center">
            <!-- search field form -->
            <form class="form-inline my-2 ml-lg-auto position-relative w-100" id="searchForm">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search products">
                    <div class="input-group-append">
                        <button class="btn btn-outline-info" type="submit" id="searchBtn">Search</button>
                    </div>
                </div>
                <!-- live search results -->
                <div class="searchResults">
            
                </div>
            </form>
            
            <!-- Button trigger upload product modal -->
            <button type="button" id="uploadProductModalBtn" class="btn btn-success btn-lg ml-2 d-none d-lg-block" data-toggle="modal" data-target="#uploadProductModal">Upload</button>
            <button type="button" id="uploadProductModalBtn" class="btn btn-success h-75 ml-2 d-lg-none" data-toggle="modal" data-target="#uploadProductModal">Upload</button>
        </div>  
    </nav>


    <!-- upload(and edit) product Modal -->
    <div class="modal fade" id="uploadProductModal" data-backdrop="static" data-keyboard="false" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Upload Product</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- upload product form -->
                    <?php include('assets/includes/productUploadForm.php'); ?>
                </div>
            </div>
        </div>
    </div>
    

    <!-- sidebar -->
    <aside class="bg-light border-right position-fixed float-left d-none d-lg-block">
        <?php include('assets/includes/homeAvatar.php'); ?>
        
                
            
