<?php
session_start();

//checking if there is any saved user
if (isset($_COOKIE['userLoggedIn'])) {
    $_SESSION['userLoggedIn'] = $_COOKIE['userLoggedIn'];  //setting the cookie value to userLoggedIn session variable
    header("Location: home.php");    //redirecting to home page for the respective user by skipping the index page
}


//clearing sign up form session variables on page reload
if (isset($_SESSION['errno_fname'])) {
    unset($_SESSION['errno_fname']);
}
if (isset($_SESSION['errno_lname'])) {
    unset($_SESSION['errno_lname']);
}
if (isset($_SESSION['errno_username'])) {
    unset($_SESSION['errno_username']);
}
if (isset($_SESSION['errno_avatar'])) {
    unset($_SESSION['errno_avatar']);
}
if (isset($_SESSION['errno_email'])) {
    unset($_SESSION['errno_email']);
}
if (isset($_SESSION['errno_phone1'])) {
    unset($_SESSION['errno_phone1']);
}
if (isset($_SESSION['errno_phone2'])) {
    unset($_SESSION['errno_phone2']);
}
if (isset($_SESSION['errno_cstate'])) {
    unset($_SESSION['errno_cstate']);
}
if (isset($_SESSION['errno_ccity'])) {
    unset($_SESSION['errno_ccity']);
}
if (isset($_SESSION['errno_cname'])) {
    unset($_SESSION['errno_cname']);
}
if (isset($_SESSION['errno_pw1'])) {
    unset($_SESSION['errno_pw1']);
}
if (isset($_SESSION['errno_pw2'])) {
    unset($_SESSION['errno_pw2']);
}
if (isset($_SESSION['avatar'])) {
    unset($_SESSION['avatar']);
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
    <!-- <script src="https://kit.fontawesome.com/00d453b880.js" crossorigin="anonymous"></script> -->
    <link rel="stylesheet" href="css/all.css">
    <!-- custom CSS -->
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/responsive.css">
    <!-- favicon -->
    <link rel="shortcut icon" href="assets/img/favicon.ico">

</head>

<body>
    <!-- nav bar -->
    <nav class="navbar navbar-light bg-light border-bottom border-secondary sticky-top">
        <div class="col-md-6 d-flex justify-content-md-start justify-content-center mb-md-0 mb-1 ">
            <a class="navbar-brand" href="#">
                <img class="img-fluid" src="assets/img/logo.jpg" width="130" height="30" alt="">
            </a>
        </div>
        <div class="col-md-6 d-flex justify-content-md-end justify-content-center  mb-md-0 mb-1 navBtns">
            <button class="btn btn-secondary mr-2" id="#loginNavBtn" data-toggle="modal" data-target="#loginModal">Login</button>
            <button class="btn btn-outline-secondary mr-2" id="#signUpNavBtn" data-toggle="modal" data-target="#signUpModal">Sign Up</button>
            <button class="btn btn-outline-secondary" id="#contactUsNavBtn" data-toggle="modal" data-target="#contactUsModal">Contact Us</button>
        </div>
    </nav>

    <!-- login modal -->
    <div class="modal fade" id="loginModal" data-backdrop="static" data-keyboard="false" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Existing User Login</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body mb-0 pb-1">
                    <?php include('assets/includes/loginForm.php'); ?>
                </div>
                <div class="modal-footer d-block m-0 p-0 pb-1">
                    <!-- forgot password or username -->
                    <div class="form-row">
                        <div class="col-md-6 text-center">
                            <a href="#forgotPasswordModal" class="text-decoration-none" data-dismiss="modal" data-toggle="modal">Forgot Password?</a>
                        </div>
                        <div class="col-md-6 text-center">
                            <a href="#forgotUsernameModal" class="text-decoration-none" data-dismiss="modal" data-toggle="modal">Forgot Username?</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- sign up modal -->
    <div class="modal fade" id="signUpModal" data-backdrop="static" data-keyboard="false" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">New User Sign Up</h5>
                    <button type="button" class="close" id="signUpCrossBtn" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php include('assets/includes/signUpForm.php'); ?>
                </div>
            </div>
        </div>
    </div>

    <!-- contact us modal -->
    <div class="modal fade" id="contactUsModal" data-backdrop="static" data-keyboard="false" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-title">
                        <h5 class="my-0">Do Write To Us...</h5>
                        <h6 class="text-muted my-0">ustore.sks@gmail.com</h6>
                    </div>
                    <button type="button" class="close" id="signUpCrossBtn" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php include('assets/includes/contactUsForm.php') ?>
                </div>
            </div>
        </div>
    </div>


    <!-- main wall -->
    <div class="mainWall container-fluid overflow-hidden m-0 p-0">
        <div class="card bg-dark text-white">
            <img src="assets/img/index-wall-md.jpg" class="card-img">
            <div class="card-img-overlay text-center mt-0 mt-md-5">
                <h2 class="card-title">Need an e-shop within your College?</h2>
                <p class="card-text d-none d-md-block">So here we are! An online shop within your college where you are both</p>
                <p class="card-text">A <em>Buyer</em> and A <em>Seller</em> too.</p>
                <a class="btn btn-info d-md-inline-block d-none btn-lg getStarted" href="#featLocation">Get Started</a>
                <a class="btn btn-info d-md-none d-inline-block mt-1 getStarted" href="#featLocation">Get Started</a>
            </div>
        </div>
    </div>


    <!-- features  -->
    <div id="featLocation"></div>
    <div class="featContainer container-fluid px-md-5 mt-5 mb-5 text-center">
        <div class="row justify-content-center mb-3">
            <h2>Key Features</h2>
        </div>
        <hr class="w-25 d-none d-md-block line" style="height: 5px !important;">
        <hr class="w-75 d-md-none line">
        <div class="row">
            <div class="col-md-9">
                <div class="row mb-md-5">
                    <div class="col-md-4 mb-3 mb-md-0">
                        <div class="card border-success shadow">
                            <div class="featSymbolWrapper w-100 bg-success">
                                <div class="featSymbol rounded-circle mx-auto bg-light text-white mt-3">
                                    <i class="fas fa-user-plus mt-4 text-success"></i>
                                </div>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Easy Sign Up</h5>
                                <p class="card-text">
                                    Just fill in your details in the sign-up form and your are set to go!
                                    We do not take <strong>unnecessary details or verifcations</strong> for your ease.
                                </p>
                            </div>
                            <div class="card-footer bg-success">
                                <small class="text-white">Last updated 3 mins ago</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3 mb-md-0">
                        <div class="card border-danger shadow">
                            <div class="featSymbolWrapper w-100 bg-danger">
                                <div class="featSymbol rounded-circle mx-auto bg-light text-white mt-3">
                                    <i class="fas fa-sign-in-alt mt-4 text-danger"></i>
                                </div>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Quick Login</h5>
                                <p class="card-text">
                                    Login instantly with your username and password, after signing up.
                                    Don't worry in case you forget either of it,
                                    <strong>we are there for your rescue.</strong>
                                </p>
                            </div>
                            <div class="card-footer bg-danger">
                                <small class="text-white">Last updated 3 mins ago</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3 mb-md-0">
                        <div class="card shadow" style="border-color: darkorange;">
                            <div class="featSymbolWrapper w-100" style="background-color: darkorange;">
                                <div class="featSymbol rounded-circle mx-auto bg-light text-white mt-3">
                                    <i class="fas fa-upload mt-4" style="color: darkorange;"></i>
                                </div>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Sell Products</h5>
                                <p class="card-text">
                                    Want to sell an item? simple! Upload a picture of the item with breif description
                                    and the amount most reasonable to you. Respond to the incoming bids and
                                    <strong>get the best customer.</strong>
                                </p>
                            </div>
                            <div class="card-footer" style="background-color: darkorange;">
                                <small class="text-white">Last updated 3 mins ago</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 mb-3 mb-md-0">
                        <div class="card border-info shadow">
                            <div class="featSymbolWrapper w-100 bg-info">
                                <div class="featSymbol rounded-circle mx-auto bg-light text-white mt-3">
                                    <i class="fas fa-shopping-cart mt-4 text-info"></i>
                                </div>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Buy Products</h5>
                                <p class="card-text">
                                    Wish to buy an item of your requirement, just type it in the search bar and
                                    place a suitable bid on the product.
                                    <strong>Wait for the seller to respond</strong> to your bid.
                                </p>
                            </div>
                            <div class="card-footer bg-info">
                                <small class="text-white">Last updated 3 mins ago</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3 mb-md-0">
                        <div class="card shadow" style="border-color: coral;">
                            <div class="featSymbolWrapper w-100" style="background-color: coral;">
                                <div class="featSymbol rounded-circle mx-auto bg-light text-white mt-3">
                                    <i class="fas fa-users mt-4" style="color: coral;"></i>
                                </div>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Simple Interaction</h5>
                                <p class="card-text">
                                    U-store promotes simple and clear interaction between the seller and the
                                    customer. <strong>Overcoming the typical interaction</strong> i.e. haggling
                                    through chats, you just need to place a bid on the product and the seller
                                    will accept or reject your bid as per his/her convenience.
                                </p>
                            </div>
                            <div class="card-footer" style="background-color: coral;">
                                <small class="text-white">Last updated 3 mins ago</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3 mb-md-0">
                        <div class="card border-primary shadow">
                            <div class="featSymbolWrapper w-100 bg-primary">
                                <div class="featSymbol rounded-circle mx-auto bg-light text-white mt-3">
                                    <i class="fas fa-address-card mt-4 text-primary"></i>
                                </div>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Privacy</h5>
                                <p class="card-text">
                                    Your privacy is of prime importance to us. The details of the seller are only
                                    available if the bid is accepted by the seller,
                                    <strong>avoiding sensitive information</strong>
                                    such as phone number, being shared.
                                </p>
                            </div>
                            <div class="card-footer bg-primary">
                                <small class="text-white">Last updated 3 mins ago</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow" style="border-color: purple;">
                    <div class="featSymbolWrapper w-100" style="background-color:purple;">
                        <div class="featSymbol rounded-circle mx-auto bg-light text-white mt-3">
                            <i class="fas fa-crosshairs mt-4" style="color:purple;"></i>
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Precise</h5>
                        <p class="card-text">
                            How often do you feel the need to sell stuff in your own college?<br>
                            Did you ever feel that if only you knew it before that it was available with
                            someone in you own college, you wouldn't have been to market?<br>
                            So U-store comes with a solution to both of these where
                            <strong>you are a buyer and a seller too.</strong> It operates in a small domain
                            of your college, in which you can buy items available with someone in your own
                            campus and also sell products in your own college.
                            <strong>U-store is restrcited to college domain,</strong>
                            providing a medium for products and a healthy contact between seller and buyer.
                        </p>
                    </div>
                    <div class="card-footer" style="background-color:purple;">
                        <small class="text-white">Last updated 3 mins ago</small>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- footer -->
    <footer>
        <div class="container-fluid text-center bg-light border-top p-2 overflow-hidden border-top">
            <div class="row justify-content-center">
                <div class="col-md-5 text-md-right pr-0 mr-0">
                    Copyright &copy; 2020 <a href="https://www.linkedin.com/in/shubham-kumar-singh-a73b1217b/" class="text-decoration-none">VeNoM</a>.
                </div>
                <div class="col-md-5 text-md-left pl-0 ml-0">
                    &nbsp;All Rights Reserved
                </div>
            </div>
        </div>
    </footer>


    <!-- forgot password modal -->
    <div class="modal fade" id="forgotPasswordModal" data-backdrop="static" data-keyboard="false" tabindex="-1">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Forgot Password?</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="assets/handlers/forgotHandler.php" method="POST" autocomplete="off">
                        <!-- username -->
                        <div class="form-row mt-2">
                            <div class="col mb-3">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-at"></i></span>
                                    </div>
                                    <input type="text" class="form-control" id="forgotPasswordUsername" name="forgotPasswordUsername" placeholder="enter your username." required>
                                </div>
                            </div>
                        </div>
                        <!-- email to send mail to -->
                        <div class="form-row">
                            <div class="col mb-2">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                    </div>
                                    <input type="text" class="form-control" id="forgotPasswordEmail" name="forgotPasswordEmail" placeholder="enter your email." required>
                                </div>
                            </div>
                        </div>

                        <small class="text-muted">You will get a link to reset your password via email.</small>

                        <hr class="my-3">

                        <!-- submit & close buttons -->
                        <div class="form-row">
                            <div class="col-md-6 mb-2">
                                <button class="btn btn-info btn-block" id="forgotPasswordBtn" name="forgotPasswordBtn" type="submit">Send Mail</button>
                            </div>
                            <div class="col-md-6">
                                <button type="button" class="btn btn-secondary btn-block" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- forgot username modal -->
    <div class="modal fade" id="forgotUsernameModal" data-backdrop="static" data-keyboard="false" tabindex="-1">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Forgot Username?</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="assets/handlers/forgotHandler.php" method="POST" autocomplete="off">
                        <div class="form-row mt-2">
                            <!-- email to send mail to -->
                            <div class="col mb-2">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                    </div>
                                    <input type="text" class="form-control" id="forgotUsernameEmail" name="forgotUsernameEmail" placeholder="enter your email." required>
                                </div>
                            </div>
                        </div>

                        <small class="text-muted">You will get your current username via email.</small>

                        <hr class="my-3">

                        <!-- submit & close buttons -->
                        <div class="form-row">
                            <div class="col-md-6 mb-2">
                                <button class="btn btn-info btn-block" id="forgotUsernameBtn" name="forgotUsernameBtn" type="submit">Send Mail</button>
                            </div>
                            <div class="col-md-6">
                                <button type="button" class="btn btn-secondary btn-block" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- forgot password/username response modal -->
    <div class="modal fade" id="forgotResponseModal" data-backdrop="static" data-keyboard="false" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Message</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <?php
                if (isset($_SESSION['modalContent'])) {
                    echo $_SESSION['modalContent'];
                    unset($_SESSION['modalContent']);
                }
                ?>
            </div>
        </div>
    </div>


    <!-- successful sign up alert -->
    <div class="modal fade" id="signUpSuccessAlert" data-backdrop="static" data-keyboard="false" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Sign Up Successful!</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-success">
                        You are successfully signed up!<br>Now proceed to <a href="#loginModal" data-dismiss="modal" data-toggle="modal" class="alert-link">Login</a>.
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal">Okay</button>
                </div>
            </div>
        </div>
    </div>


    <!-- login failed alert -->
    <div class="modal fade" id="loginFailedAlert" data-backdrop="static" data-keyboard="false" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Login Failed!</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger">
                        <?php
                        if (isset($_SESSION['login_error_string'])) {
                            echo $_SESSION['login_error_string'];
                        }
                        ?>
                        <br>click here to
                        <a href="#loginModal" data-dismiss="modal" data-toggle="modal" class="alert-link"> Login </a>again.
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Okay</button>
                </div>
            </div>
        </div>
    </div>


    <!-- logged out alert -->
    <div class="modal fade" id="logoutAlert" data-backdrop="static" data-keyboard="false" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">User Logged out!</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-success">
                        You are logged out ! Want to <a href="#loginModal" data-dismiss="modal" data-toggle="modal" class="alert-link">Login</a> again?
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal">Okay</button>
                </div>
            </div>
        </div>
    </div>

    <!-- account DELETED success message -->
    <div class="modal fade" id="accountDeleted" data-backdrop="static" data-keyboard="false" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Account Deleted !</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-secondary">
                        Your account is deleted permanently.<br>Hope to see you soon.
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Okay</button>
                </div>
            </div>
        </div>
    </div>

    <!-- contact us response modal -->
    <div class="modal fade" id="contactUsResponseModal" data-backdrop="static" data-keyboard="false" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <?php
                if (isset($_SESSION['contactUsCheck'])) {
                    if ($_SESSION['contactUsCheck'] == 1) {
                        echo "<div class='modal-header'>
                                    <h5 class='modal-title'>Message Sent !</h5>
                                    <button type='button' class='close' data-dismiss='modal'>
                                        <span>&times;</span>
                                    </button>
                                </div>
                                <div class='modal-body'>
                                    <div class='alert alert-success'>
                                        <h5>Thankyou " . $_SESSION['contactedUser'] . " !</h5>
                                        Happy to hear from you. <br/>
                                        We'll surely consider your valuable response. 
                                    </div>
                                </div>
                                <div class='modal-footer'>
                                    <button type='button' class='btn btn-success' data-dismiss='modal'>Close</button>
                                </div>";
                    } elseif ($_SESSION['contactUsCheck'] == 0) {
                        echo "<div class='modal-header'>
                                    <h5 class='modal-title'>Message NOT Sent !</h5>
                                    <button type='button' class='close' data-dismiss='modal'>
                                        <span>&times;</span>
                                    </button>
                                </div>
                                <div class='modal-body'>
                                    <div class='alert alert-danger'>
                                        <h5>We're Sorry " . $_SESSION['contactedUser'] . " !</h5>
                                        Something went wrong! <br/>
                                        Please try again.
                                    </div>
                                </div>
                                <div class='modal-footer'>
                                    <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                                </div>";
                    }
                }
                ?>
            </div>
        </div>
    </div>


    <!-- jQuery latest version -->
    <script type="text/javascript" src="js/jquery.min.js"></script>

    <!-- Bootstrap JavaScripts -->
    <script type="text/javascript" src="js/popper.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>

    <!-- custom JavaScripts -->
    <script type="text/javascript" src="js/signUpFormFunctions.js"></script>
    <script type="text/javascript" src="js/index.js"></script>

    <script>
        //to show sign up success alert
        $(document).ready(function() {
            var signUpCheck = <?php
                                if (isset($_SESSION['signUpCheck'])) {
                                    if ($_SESSION['signUpCheck'] == 1) {
                                        echo 1;
                                    } else {
                                        echo 0;
                                    }
                                } else {
                                    echo 0;
                                }
                                ?>

            if (signUpCheck == 1) {
                $("#signUpSuccessAlert").modal("show");
                <?php unset($_SESSION['signUpCheck']); ?>
            } else {
                $("#signUpSuccessAlert").modal("hide");
            }
        });

        //to show login failed alerts
        $(document).ready(function() {
            var loginCheck = <?php
                                if (isset($_SESSION['errno_login'])) {
                                    if ($_SESSION['errno_login'] == 17 || $_SESSION['errno_login'] == 18) {
                                        echo 1;
                                    } else {
                                        echo 0;
                                    }
                                } else {
                                    echo 0;
                                }
                                ?>

            if (loginCheck == 1) {
                $("#loginFailedAlert").modal("show");
                <?php unset($_SESSION['errno_login']); ?>
            } else {
                $("#loginFailedAlert").modal("hide");
            }
        });

        //to show logged out alert
        $(document).ready(function() {
            var logoutCheck = <?php
                                if (isset($_SESSION['logoutCheck'])) {
                                    if ($_SESSION['logoutCheck'] == 1) {
                                        echo 1;
                                    } else {
                                        echo 0;
                                    }
                                } else {
                                    echo 0;
                                }
                                ?>

            if (logoutCheck == 1) {
                $("#logoutAlert").modal("show");
                <?php unset($_SESSION['logoutCheck']); ?>
            } else {
                $("#logoutAlert").modal("hide");
            }
        });


        //to show success modal when account is deleted successfully
        $(document).ready(function() {
            var accountDeleteCheck = <?php
                                        if (isset($_SESSION['accountDeleteCheck'])) {
                                            echo $_SESSION['accountDeleteCheck'];
                                        } else {
                                            echo -1;
                                        }
                                        ?>;
            if (accountDeleteCheck == 1) {
                //showing the error modal
                $("#accountDeleted").modal('show');
                <?php unset($_SESSION['accountDeleteCheck']); ?>
            }
        });


        //to show forgot password/username response modal
        $(document).ready(function() {
            var forgotCheck = <?php
                                if (isset($_SESSION['forgotCheck'])) {
                                    echo $_SESSION['forgotCheck'];
                                } else {
                                    echo -1;
                                }
                                ?>;
            if (forgotCheck == 1) {
                //showing the error modal
                $("#forgotResponseModal").modal('show');
                <?php unset($_SESSION['forgotCheck']); ?>
            }
        });


        //to show contact us response message
        $(document).ready(function() {
            var contactUsCheck = <?php
                                    if (isset($_SESSION['contactUsCheck'])) {
                                        echo $_SESSION['contactUsCheck'];
                                    } else {
                                        echo -1;
                                    }
                                    ?>;
            if (contactUsCheck != -1) {
                $("#contactUsResponseModal").modal('show'); //showing the response modal
                <?php unset($_SESSION['contactUsCheck']); ?>
            }
        });
    </script>


</body>

</html>