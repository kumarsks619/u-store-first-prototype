<div class="wrapper">
    <div class="card-columns p-3">
        <?php
            $currentUser = $userLoggedIn;           //current user

            //sql query to get the bids of the current user
            $query = "SELECT product_id FROM bids WHERE bid_by = '$currentUser' ORDER BY id DESC";
            $result = mysqli_query($con, $query);
            if(mysqli_num_rows($result) > 0){  
                while($row = mysqli_fetch_assoc($result)){
                    $productIds[] = $row['product_id'];   //collecting all the product's ids returned by the query
                }

                //iterating through each product ids on which the current user placed the bid
                foreach($productIds as $pro_id){
                    //sql query to get the products
                    $query = "SELECT * FROM products WHERE id = '$pro_id' ORDER BY id DESC";
                    $result = mysqli_query($con, $query);
                    
                    
                    //handling one product at a time
                    while($row = mysqli_fetch_assoc($result)){
                        $card = "";       //initializing a variable to store the complete card for current product
                        
                        //fetching all the details of the current product
                        $productId = $row['id'];
                        $productName = $row['product_name'];
                        $productDesc = $row['product_desc'];
                        $productPhoto = $row['product_photo'];
                        $productPrice = $row['product_price'];
                        $productOwner = $row['uploaded_by'];
                        $uploadDate = $row['upload_date'];
                        $bids_ids_string  = $row['bids_ids'];   //string containing all the bids on the current product(comma seperated)

                        //preparing the date message**************************
                        $currentDate = date("Y-m-d");       //current date

                        $startDate = new DateTime($uploadDate);
                        $endDate = new DateTime($currentDate);
                        $interval = $startDate->diff($endDate);         //difference between the dates

                        if($interval->y >= 1){  //checking if the product is at least an year old
                            if($interval->y == 1){
                                $timeMsg = $interval->y . " year ago";  //1 year old
                            }else{
                                $timeMsg = $interval->y . " years ago"; //1+ years old
                            }
                        }elseif($interval->m >= 1 ){    //checking if the product is at least a month old
                            //if the product is at least a month old the checking how many more days
                            if($interval->d == 0){
                                $days = "ago";         //no more extra days
                            }elseif($interval->d == 1){
                                $days = $interval->d . " day ago";  //1 extra day 
                            }else{
                                $days = $interval->d . " days ago";     //1+ extra days
                            }

                            //comibing the days string with months
                            if($interval->m == 1){
                                $timeMsg = $interval->m . " month " . $days;    //1 month + some days old
                            }else{
                                $timeMsg = $interval->m . " months " . $days;    //1+ months + some days old
                            }
                        }elseif($interval->d >= 1){     //checking if the product is at least a day old
                            if($interval->d == 1){
                                $timeMsg = "yesterday";     //1 day old
                            }else{
                                $timeMsg = $interval->d . " days ago";  //1+ days old
                            }
                        }else{
                            $timeMsg = "today";     //product uplaoded today
                        }


                        //preaparing product card**********************************************
                        $card = $card . "<div class='card m-2 mb-3' id='product" . $productId . "'>
                                            <div class='card-header'>
                                                <div class='h6'>Owner : ";
                        
                        //product owner's username
                        $card = $card .     "@<a href='#userShortInfoModal' class='text-muted productOwner' data-toggle='modal'>" . $productOwner . "</a>";
                        
                    
                        $card = $card .  "</div>
                                    </div>
                                    <img src='" . $productPhoto . "' class='card-img-top' height=250>
                                    <div class='card-body d-flex flex-column'>
                                        <h5 class='card-title productName'>" . $productName . "</h5>
                                        <p class='card-text productDesc' style='font-size: 0.9rem;'>" . $productDesc . "</p>
                                        <span class='badge badge-warning py-2 productPrice'>Rs " . $productPrice . "</span>
                                    </div>
                                    <nav class='navbar navbar-light bg-light'>
                                        <h6>Bids : <span class='badge badge-pill badge-primary'>";

                        //working on bids of the current product    
                        $bids_ids_array = explode(",", $bids_ids_string);
                        array_shift($bids_ids_array);           //removing the first empty element from the array
                        array_pop($bids_ids_array);             //removing the last empty element from the array
                        $num_of_bids = count($bids_ids_array);  //number of bids on the current product
                                        
                                        
                        $card = $card .                                                    $num_of_bids . "</span></h6>";

                        //checking the need to show bids-expand button
                        if($num_of_bids > 0){
                            $card = $card . "<button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#product" . $productId . "Bids'>
                                                <span class='navbar-toggler-icon' style='width: 0.9rem; height: 0.9rem;'></span>
                                            </button>";
                        }

                        $card = $card . "</nav>
                                        <div class='collapse' id='product" . $productId . "Bids'>
                                            <ul class='list-group list-group-flush'>";
                        

                        foreach($bids_ids_array as $bid_id){
                            //sql query to fetch the current bid details
                            $query = "SELECT * FROM bids WHERE id = '$bid_id' ";
                            $result = mysqli_query($con, $query);
                            $row = mysqli_fetch_assoc($result);
                            //bids details
                            $bid_by = $row['bid_by'];               //bid by
                            $bid_value = $row['bid_value'];         //bid value
                            $bid_status = $row['bid_status'];       //bid status

                            if($bid_status == "accepted"){
                                $card = $card . "<li class='list-group-item d-flex flex-wrap align-items-center border border-success rounded' style='background-color: #d4edda;'>";
                            }else{
                                $card = $card . "<li class='list-group-item d-flex flex-wrap align-items-center'>";
                            }

                            //bid owner's username
                            $card = $card . "<span class='text-muted bidBy'>@" . $bid_by . "</span>";                    

                            //showing bid value
                            $card = $card .     "<span class='badge badge-warning ml-2 mr-auto bidValue'>Rs " . $bid_value . "</span>";
                            
                            //placing action buttons for each bid (edit & delete bid buttons)
                            if($bid_by == $currentUser && $bid_status != "accepted"){
                                $card = $card . "<button class='btn btn-info btn-sm mr-1 editBidBtn' title='edit bid'><i class='fas fa-pen'></i></button>
                                                <button class='btn btn-danger btn-sm deleteBidBtn' title='delete bid'><i class='fas fa-trash-alt'></i></button>";
                            }elseif($productOwner != $currentUser && $bid_status == "accepted"){
                                $card = $card . "<span class='badge badge-success'>ACCEPTED</span>";
                            }

                            
                            $card = $card . "</li>";
                        }

                        //showing time message in the footer
                        $card = $card .               "</ul>
                                                    </div>
                                                    <div class='card-footer d-flex align-items-center'>
                                                        <small class='text-muted mr-auto'>" . $timeMsg . "</small>";
                        
                        //sql query to check if the bid is already placed on the current product by the current user
                        $query = "SELECT id FROM bids WHERE product_id = '$productId' AND bid_by = '$currentUser' ";
                        $result = mysqli_query($con, $query);
                        $row =mysqli_fetch_assoc($result);
                        if(mysqli_num_rows($result) > 0){
                            $bidAlreadyPlaced = 1;          //bid already placed
                        }else{
                            $bidAlreadyPlaced = 0;          //bid not placed
                        }

                        if($productOwner != $currentUser && $bidAlreadyPlaced == 0){
                            $card = $card .              "<button class='btn btn-info btn-sm placeBidBtn'>Place Bid</button>
                                                        <button class='btn btn-secondary btn-sm cancelBidBtn' style='display: none;'>Cancel</button>";
                        }

                        //finallizing the card
                        $card = $card .                "</div>
                                                    </div>";

                        echo $card;     //echoing the final card for ONE product
                    }   
                }
                $showMessage = 0;   //no need to show message
            }else{
                $showMessage = 1;   //need to show a message
            } 
        ?>
    </div>
    <div class="message">
        <?php
            if($showMessage == 1){
                echo "<div class='alert alert-secondary mx-4'>You did not placed any bid yet.</div>";
            }
        ?>
    </div>
</div>
<br><br><br>