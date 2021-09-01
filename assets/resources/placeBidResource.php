<?php
    session_start();

    include('../handlers/conHandler.php');          //including connection handler

    
    if(isset($_POST['diff_var'])){
        //showing the new bid input field***********************************************************
        if($_POST['diff_var'] == "initBid"){
            $currentUser = $_SESSION['userLoggedIn'];

            echo "<li class='py-2 px-3 newBid' style='list-style: none; margin: 0; padding: 0;'>
                    <form class='d-flex flex-wrap justify-content-between align-items-center'>
                        <label class='text-muted'>
                        @" . $currentUser . "
                        </label>
                        <div class='input-group input-group-sm' style='width: 125px;'>
                            <div class='input-group-prepend'>
                                <span class='input-group-text'><i class='fas fa-rupee-sign'></i></span>
                            </div>
                            <input type='number' class='form-control' placeholder='price' min='0' max='50000'>
                            <div class='input-group-append'>
                                <button class='btn btn-success btn-sm' type='button' title='submit bid' disabled><i class='fas fa-check'></i></button>
                            </div>
                        </div>
                    </form>
                </li>";
        }
        
        //submitting the new bid*******************************************************************
        if($_POST['diff_var'] == "submitBid"){
            $productId = str_replace("product", "", $_POST['product_Id']);  //product Id
            $owner = $_POST['owner'];           //owner's username
            $bid_by = $_SESSION['userLoggedIn'];   //bid by
            $bidValue = $_POST['bid_val'];      //entered bid value
            $productName = $_POST['product_name'];  //current product name

            
            //sql query to insert data into bids table
            $query = "INSERT INTO bids VALUES('', '$productId', '$owner', '$bid_by', '$bidValue', 'none' )";
            mysqli_query($con, $query);

            //id for the just inserted bid
            $bid_id = mysqli_insert_id($con);

            //sql query to get the bids of the corresponding product
            $query = "SELECT bids_ids FROM products WHERE id = '$productId' ";
            $result = mysqli_query($con, $query);
            $row = mysqli_fetch_assoc($result);
            //preparing bids ids string to update the current product
            $product_bids_ids_string = $row['bids_ids'] . $bid_id . ",";

            //sql query to update corresponding products table
            $query = "UPDATE products SET bids_ids = '$product_bids_ids_string' WHERE id = '$productId' ";
            mysqli_query($con, $query);

            
            //sql query to get the bids ids for the current user
            $query = "SELECT bids_placed_ids FROM users WHERE username = '$bid_by' ";
            $result = mysqli_query($con, $query);
            $row = mysqli_fetch_assoc($result);
            //preparing bids ids string to update the current user
            $user_bids_placed_ids_string = $row['bids_placed_ids'] . $bid_id . ",";
            
            //sql query to update the current user
            $query = "UPDATE users SET bids_placed_ids = '$user_bids_placed_ids_string' WHERE username = '$bid_by' ";
            mysqli_query($con, $query);



            //date of bid placed
            $notiDate = date("Y-m-d");

            //creating a notification for the product owner***************************************************
            $query = "INSERT INTO noti VALUES('', '$productId', '$productName', '$owner', '$bid_by', 'placed a new bid on your product.', '$notiDate', 'success' )";
            mysqli_query($con, $query);

            //creating a notification for the all the other users who already placed bid on this product*******
            //sql query to get all users who already placed bid on this product
            $query = "SELECT bid_by FROM bids WHERE product_id = '$productId' ";
            $result = mysqli_query($con, $query);
            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_assoc($result)){
                    $bidUsers[] = $row;     //collecting all such users
                }
                //creating notification for each such user(one by one)
                foreach($bidUsers as $bidUser){
                    $bidOwner = $bidUser['bid_by'];       //bid owner
                    //sql query to create notification
                    $query = "INSERT INTO noti VALUES('', '$productId', '$productName', '$bidOwner', '$bid_by', 'also placed a bid.', '$notiDate', 'warning' )";
                    mysqli_query($con, $query);
                }
            }

            //echoing the new bid column to be displayed
            echo "<li class='list-group-item d-flex flex-wrap align-items-center'>
                    <span class='text-muted'>@" . $bid_by . "</span>
                    <span class='badge badge-warning ml-2 mr-auto'>Rs " . $bidValue . "</span>
                    <button class='btn btn-info btn-sm mr-1 editBidBtn' title='edit bid'><i class='fas fa-pen'></i></button>
                    <button class='btn btn-danger btn-sm deleteBidBtn' title='delete bid'><i class='fas fa-trash-alt'></i></button>
                </li>";
        }


        //editing a bid : adding input field****************************************************************
        if($_POST['diff_var'] == "editBid"){
            $currentBidVal = $_POST['bid_val'];         //current bid value
            $currentUser = $_SESSION['userLoggedIn'];   //bid by


            echo "<form class='d-flex flex-wrap justify-content-between align-items-center'>
                    <label class='text-muted'>
                    @" . $currentUser . "
                    </label>
                    <div class='input-group input-group-sm' style='width: 150px;'>
                        <div class='input-group-prepend'>
                            <span class='input-group-text'><i class='fas fa-rupee-sign'></i></span>
                        </div>
                        <input type='number' class='form-control' placeholder='price' value='" . $currentBidVal . "' min='0' max='50000'>
                        <div class='input-group-append'>
                            <button class='btn btn-success btn-sm bidEditDoneBtn' title='submit bid' type='button' disabled><i class='fas fa-check'></i></button>
                            <button class='btn btn-danger btn-sm cancelBidEditBtn' title='cancel edit' type='button'><i class='fas fa-times'></i></button>
                        </div>
                    </div>
                </form>";
        }

        //submitting the editted bid**********************************************************
        if($_POST['diff_var'] == "submitEdittedBid"){
            $newBidVal = $_POST['new_bid_val'];         //new bid value
            $productId = $_POST['product_Id'];           //current product id
            $bid_by = $_SESSION['userLoggedIn'];        //bid by
            $productName = $_POST['product_name'];      //current product name
            $owner = $_POST['owner'];                   //owner's username


            //sql query to update the bid
            $query = "UPDATE bids SET bid_value = '$newBidVal' WHERE product_id = '$productId' AND bid_by = '$bid_by' ";
            mysqli_query($con, $query);


            //date of bid placed
            $notiDate = date("Y-m-d");

            //creating a notification for the product owner***************************************************
            $query = "INSERT INTO noti VALUES('', '$productId', '$productName', '$owner', '$bid_by', 'editted his bid.', '$notiDate', 'info' )";
            mysqli_query($con, $query);

            //creating a notification for the all the other users who already placed bid on this product*******
            //sql query to get all users who already placed bid on this product
            $query = "SELECT bid_by FROM bids WHERE product_id = '$productId' ";
            $result = mysqli_query($con, $query);
            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_assoc($result)){
                    $bidUsers[] = $row;     //collecting all such users
                }
                //creating notification for each such user(one by one)
                foreach($bidUsers as $bidUser){
                    $bidOwner = $bidUser['bid_by'];       //bid owner
                    //sql query to create notification
                    $query = "INSERT INTO noti VALUES('', '$productId', '$productName', '$bidOwner', '$bid_by', 'editted his bid.', '$notiDate', 'info' )";
                    mysqli_query($con, $query);
                }
            }


            //echoing the editied bid column to be displayed
            echo "<span class='text-muted'>@" . $bid_by . "</span>
                  <span class='badge badge-warning ml-2 mr-auto'>Rs " . $newBidVal . "</span>
                  <button class='btn btn-info btn-sm mr-1 editBidBtn' title='edit bid'><i class='fas fa-pen'></i></button>
                  <button class='btn btn-danger btn-sm deleteBidBtn' title='delete bid'><i class='fas fa-trash-alt'></i></button>";
        }


        //accepting a bid************************************************************************
        if($_POST['diff_var'] == "acceptBid"){
            $productId = $_POST['product_Id'];      //product id
            $bid_by = $_POST['bid_by'];             //bid by
            $bidValue = $_POST['bid_val'];          //bid value
            $owner = $_POST['owner'];               //product owner
            $productName = $_POST['product_name'];  //product name

            //sql query update the current bid status
            $query = "UPDATE bids SET bid_status = 'accepted' WHERE product_id = '$productId' AND bid_by = '$bid_by' ";
            mysqli_query($con, $query);


            //date of bid placed
            $notiDate = date("Y-m-d");

            //creating noti for the user whose bid is accepted
            $query = "INSERT INTO noti VALUES('', '$productId', '$productName', '$bid_by', '$owner', 'accepted your bid.', '$notiDate', 'success' )";
            mysqli_query($con, $query);

            //creating a notification for the all the other users who already placed bid on this product*******
            //sql query to get all users who already placed bid on this product
            $query = "SELECT bid_by FROM bids WHERE product_id = '$productId' AND bid_by != '$bid_by' ";
            $result = mysqli_query($con, $query);
            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_assoc($result)){
                    $bidUsers[] = $row;     //collecting all such users
                }
                //creating notification for each such user(one by one)
                foreach($bidUsers as $bidUser){
                    $bidOwner = $bidUser['bid_by'];       //bid owner
                    //sql query to create notification
                    $query = "INSERT INTO noti VALUES('', '$productId', '$productName', '$bidOwner', '$owner', 'accepted a bid.', '$notiDate', 'danger' )";
                    mysqli_query($con, $query);
                }
            }

        }

        
        //rejecting a bid************************************************************************
        if($_POST['diff_var'] == "rejectBid"){
            $productId = $_POST['product_Id'];      //product id
            $bid_by = $_POST['bid_by'];             //bid by
            $owner = $_POST['owner'];               //product owner
            $productName = $_POST['product_name'];  //product name

            //sql query to get the current bid's id
            $query = "SELECT id FROM bids WHERE product_id = '$productId' AND bid_by = '$bid_by' ";
            $result = mysqli_query($con, $query);
            $row = mysqli_fetch_assoc($result);
            $bid_id = $row['id'];           //current bid's id

            //sql to delete the current bid record from database
            $query = "DELETE FROM bids WHERE id = '$bid_id' ";
            mysqli_query($con, $query);

            //sql query to remove the current bid's id from the current product's bids string
            $query = "SELECT bids_ids FROM products WHERE id = '$productId' ";
            $result = mysqli_query($con, $query);
            $row = mysqli_fetch_assoc($result);
            $bids_ids_string_product = $row['bids_ids'];    //bids ids string from products
            $bid_id = $bid_id . ",";                        //adding comma 
            $bids_ids_string_product = str_replace($bid_id, "", $bids_ids_string_product);    //deleting the current bid id
            //updating the products table
            $query = "UPDATE products SET bids_ids = '$bids_ids_string_product' WHERE id = '$productId' ";
            mysqli_query($con, $query);

            //sql query to remove the current bid's id from the user who placed it
            $query = "SELECT bids_placed_ids FROM users WHERE username = '$bid_by' ";
            $result = mysqli_query($con, $query);
            $row = mysqli_fetch_assoc($result);
            $bids_ids_string_user = $row['bids_placed_ids'];    //bids ids string from user
            $bids_ids_string_user = str_replace($bid_id, "", $bids_ids_string_user);    //deleting the current bid id
            //updating the users table
            $query = "UPDATE users SET bids_placed_ids = '$bids_ids_string_user' WHERE username = '$bid_by' ";
            mysqli_query($con, $query);


            //date of bid placed
            $notiDate = date("Y-m-d");

            //creating noti for the user whose bid is rejected
            $query = "INSERT INTO noti VALUES('', '$productId', '$productName', '$bid_by', '$owner', 'rejected your bid.', '$notiDate', 'danger' )";
            mysqli_query($con, $query);
            //id of the just added notification
            $notiId = mysqli_insert_id($con);

            echo $notiId;       //echoing noti id for the undo function
        }


        //undoing a rejected bid*****************************************************
        if($_POST['diff_var'] == "undoBidReject"){
            $productId = $_POST['product_Id'];      //product id
            $productOwner = $_SESSION['userLoggedIn']; //the user who rejected the bid must be the product owner
            $bid_by = $_POST['bid_by'];             //bid by
            $bidValue = $_POST['bid_val'];          //bid value
            $notiId = $_POST['notiId'];             //noti id to be deleted

            //deleting the notification
            $query = "DELETE FROM noti WHERE id = '$notiId' ";
            mysqli_query($con, $query);

            //sql query to re-add the rejected bid to the bids table
            $query = "INSERT INTO bids VALUE('', '$productId', '$productOwner', '$bid_by', '$bidValue', 'none')";
            mysqli_query($con, $query);

            //id for the just re-added bid
            $reAddedBidId = mysqli_insert_id($con);
            $reAddedBidId = $reAddedBidId . ",";        //data to be added

            //sql query to re-add the id for the re-added bid to the products table
            $query = "SELECT bids_ids FROM products WHERE id = '$productId' ";
            $result = mysqli_query($con, $query);
            $row = mysqli_fetch_assoc($result);
            $bids_ids_string_product = $row['bids_ids'];    //bids ids string from products
            $bids_ids_string_product = $bids_ids_string_product . $reAddedBidId;    //preparing new bids string
            //updating products table
            $query = "UPDATE products SET bids_ids = '$bids_ids_string_product' WHERE id = '$productId' ";
            mysqli_query($con, $query);
            
            //sql query to re-add the bid id for the re-added bid to users table
            $query = "SELECT bids_placed_ids FROM users WHERE username = '$bid_by' ";
            $result = mysqli_query($con, $query);
            $row = mysqli_fetch_assoc($result);
            $bids_ids_string_user = $row['bids_placed_ids'];    //bids ids string from user
            $bids_ids_string_user = $bids_ids_string_user . $reAddedBidId;  //preapring new bids string
            $query = "UPDATE users SET bids_placed_ids = '$bids_ids_string_user' WHERE username = '$bid_by' ";
            mysqli_query($con, $query);

            //echoing the re-added column again
            echo "<li class='list-group-item d-flex flex-wrap align-items-center'>
                    <a href='#userShortInfoModal' data-toggle='modal' class='text-muted'>@" . $bid_by . "</a>
                    <span class='badge badge-warning ml-2 mr-auto bidValue'>Rs " . $bidValue . "</span>
                    <button class='btn btn-success btn-sm mr-1 acceptBidBtn' title='accept bid'><i class='fas fa-check'></i></button>
                    <button class='btn btn-danger btn-sm rejectBidBtn' title='reject bid'><i class='fas fa-times'></i></button>
                </li>";
        }


        //deleting a bid**********************************************************************
        if($_POST['diff_var'] == "deleteBid"){
            $productId = $_POST['product_Id'];      //product id
            $bid_by = $_POST['bid_by'];             //bid by
            
            //sql query to get the current bid's id
            $query = "SELECT id FROM bids WHERE product_id = '$productId' AND bid_by = '$bid_by' ";
            $result = mysqli_query($con, $query);
            $row = mysqli_fetch_assoc($result);
            $bid_id = $row['id'];           //current bid's id

            //sql to delete the current bid record from database
            $query = "DELETE FROM bids WHERE id = '$bid_id' ";
            mysqli_query($con, $query);

            //sql query to remove the current bid's id from the current product's bids string
            $query = "SELECT bids_ids FROM products WHERE id = '$productId' ";
            $result = mysqli_query($con, $query);
            $row = mysqli_fetch_assoc($result);
            $bids_ids_string_product = $row['bids_ids'];    //bids ids string from products
            $bid_id = $bid_id . ",";                        //adding comma 
            $bids_ids_string_product = str_replace($bid_id, "", $bids_ids_string_product);    //deleting the current bid id
            //updating the products table
            $query = "UPDATE products SET bids_ids = '$bids_ids_string_product' WHERE id = '$productId' ";
            mysqli_query($con, $query);

            //sql query to remove the current bid's id from the user who placed it
            $query = "SELECT bids_placed_ids FROM users WHERE username = '$bid_by' ";
            $result = mysqli_query($con, $query);
            $row = mysqli_fetch_assoc($result);
            $bids_ids_string_user = $row['bids_placed_ids'];    //bids ids string from user
            $bids_ids_string_user = str_replace($bid_id, "", $bids_ids_string_user);    //deleting the current bid id
            //updating the users table
            $query = "UPDATE users SET bids_placed_ids = '$bids_ids_string_user' WHERE username = '$bid_by' ";
            mysqli_query($con, $query);
        }


        //DELETING PRODUCT************************************************************************
        if($_POST['diff_var'] == "deleteProduct"){
            $productId = $_POST['product_Id'];      //product id
            $productOwner = $_SESSION['userLoggedIn'];  //thats why delete product button is being displayed
            $productName = $_POST['product_name'];      //product name


            //date of bid placed
            $notiDate = date("Y-m-d");

            //creating a notification for the all the users who placed bid on this product*******
            //sql query to get all users who placed bid on this product
            $query = "SELECT bid_by FROM bids WHERE product_id = '$productId' ";
            $result = mysqli_query($con, $query);
            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_assoc($result)){
                    $bidUsers[] = $row;     //collecting all such users
                }
                //creating notification for each such user(one by one)
                foreach($bidUsers as $bidUser){
                    $bidOwner = $bidUser['bid_by'];       //bid owner
                    //sql query to create notification
                    $query = "INSERT INTO noti VALUES('', '$productId', '$productName', '$bidOwner', '$productOwner', 'deleted his product.', '$notiDate', 'secondary' )";
                    mysqli_query($con, $query);
                }
            }
            

            //sql query to fetch the required product details
            $query = "SELECT product_photo,uploaded_by, bids_ids FROM products WHERE id = '$productId' ";
            $result = mysqli_query($con, $query);
            $row = mysqli_fetch_assoc($result);
            $productPhotoPath = $row['product_photo'];  //product photo path
            $productOwner = $row['uploaded_by'];        //product owner
            $bids_ids_string_product = $row['bids_ids'];        //bids ids on the current product

            //deleting the product photo
            $productPhotoPath = "../../" . $productPhotoPath;   //path relative this resource file
            unlink($productPhotoPath);                          //photo deleted

            //sql query to remove the product's id from users table
            $query = "SELECT uploaded_pro_ids FROM users WHERE username = '$productOwner' ";
            $result = mysqli_query($con, $query);
            $row = mysqli_fetch_assoc($result);
            $product_ids_string_user = $row['uploaded_pro_ids'];     //owner's uploaded product's ids
            //deleting the current product's id from the owner
            $productIdMod = $productId . ",";      //to be removed from ids string
            $product_ids_string_user = str_replace($productIdMod, "", $product_ids_string_user);    //ids string prepared
            //updating users table
            $query = "UPDATE users SET uploaded_pro_ids = '$product_ids_string_user' WHERE username = '$productOwner' ";
            mysqli_query($con, $query);

            //compiling all the bid's ids on the current product into an array
            $bids_ids_array_product = explode("," , $bids_ids_string_product);      //aontains some two NULL values
            array_shift($bids_ids_array_product);           //removes the first NULL value
            array_pop($bids_ids_array_product);             //removes the last NULL value
            
            //iterating through each bid id and clear it from the users table
            foreach($bids_ids_array_product as $bid_id){
                //sql query to get the bid_by
                $query = "SELECT bid_by FROM bids WHERE id = '$bid_id' ";
                $result = mysqli_query($con, $query);
                $row = mysqli_fetch_assoc($result);
                $bid_by = $row['bid_by'];       //bid by

                //sql query to fetch the bid's ids string of the user who placed the current bid
                $query = "SELECT bids_placed_ids FROM users WHERE username = '$bid_by' ";
                $result = mysqli_query($con, $query);
                $row = mysqli_fetch_assoc($result);
                $bids_ids_string_user = $row['bids_placed_ids'];    //current user's bids ids string
                $bid_idMod = $bid_id . ",";                            //value to deleted from the string
                $bids_ids_string_user = str_replace($bid_idMod, "", $bids_ids_string_user);    //string prepared
                //updating current user
                $query = "UPDATE users SET bids_placed_ids = '$bids_ids_string_user' WHERE username = '$bid_by' ";
                mysqli_query($con, $query);
            }

            //sql query to delete all the product record from the products table
            $query = "DELETE FROM products WHERE id = '$productId' ";
            mysqli_query($con, $query);

            //sql query to delete all the associated bids
            $query = "DELETE FROM bids WHERE product_id = '$productId' ";
            mysqli_query($con, $query);
            
        }
    }else{
        header("Location: ../../index.php");        //when directly trying to access this resource
    }
?>



