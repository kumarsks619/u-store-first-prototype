<div class="wrapper">
    <div class="row">
        <div class="col-lg-4 pt-4 px-5 overflow-auto" id="notiWrapper">
            <?php 
                //sql query to get all the notifications for the current user
                $query = "SELECT * FROM noti WHERE user_to = '$userLoggedIn' AND user_from != '$userLoggedIn' ORDER BY id DESC";
                $result = mysqli_query($con, $query);
                if(mysqli_num_rows($result) > 0){
                    while($row = mysqli_fetch_assoc($result)){
                        $notis[] = $row;    //collecting all the notifications for the current user
                    }
                    //iterating through each notification to display it
                    foreach($notis as $noti){
                        $notiId = $noti['id'];                  //notification id
                        $productName = $noti['product_name'];   //product name
                        $notiFrom = $noti['user_from'];         //notification from
                        $notiMsg = $noti['noti_msg'];           //notification message
                        $notiDate = $noti['noti_date'];         //notification date
                        $productId = $noti['product_id'];       //product id
                        $notiType = $noti['noti_type'];         //noti type, this will decide the color of toast

                        //preaparing time message for notification********************
                        $currentDate = date("Y-m-d");       //current date

                        $startDate = new DateTime($notiDate);
                        $endDate = new DateTime($currentDate);
                        $interval = $startDate->diff($endDate);         //difference between the dates

                        if($interval->y >= 1){  //checking if the noti is at least an year old
                            if($interval->y == 1){
                                $timeMsg = $interval->y . " year ago";  //1 year old
                            }else{
                                $timeMsg = $interval->y . " years ago"; //1+ years old
                            }
                        }elseif($interval->m >= 1 ){    //checking if the noti is at least a month old
                            //if the noti is at least a month old the checking how many more days
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
                        }elseif($interval->d >= 1){     //checking if the noti is at least a day old
                            if($interval->d == 1){
                                $timeMsg = "yesterday";     //1 day old
                            }else{
                                $timeMsg = $interval->d . " days ago";  //1+ days old
                            }
                        }else{
                            $timeMsg = "today";     //noti added today
                        }//end of time message
                        

                        //now echoing the final notification****************************
                        echo "<div class='toast' data-autohide='false' id='noti" . $notiId . "'> 
                                    <div class='toast-header border-bottom'>
                                        <div class='bg-" . $notiType . " rounded mr-2' style='height: 20px; width: 20px;'></div>
                                        <strong class='mr-auto'><a href='#' id='product" . $productId . "' class='stretched-link text-decoration-none text-secondary notiProductName'>" . $productName . "</a></strong>
                                        <small class='text-muted notiDate'>" . $timeMsg . "</small>
                                        <button type='button' class='ml-2 mb-1 close notiDeleteBtn' data-dismiss='toast' style='z-index: 10;'>
                                            <span>&times;</span>
                                        </button>
                                    </div>
                                    <div class='toast-body notiMsg'>
                                        <strong>@" . $notiFrom . "</strong> " . $notiMsg . "
                                    </div>
                                </div>";
                        
                    }//end of foreach
                }else{      //when there is no notifications
                    echo "<div class='alert alert-secondary mx-3'>No notifications. You're all caught up !</div>";
                }
            ?>
        </div>

        <div class="col-lg-8 overflow-auto" id="notiPreview">
            <div class='alert alert-secondary mx-4 mt-4'>click a notification to get preview.</div>
        </div>
    </div>
</div>
<br><br><br>




<!-- //deciding the notification type
switch($notiType){
    case "success" : echo "<div class='toast' data-autohide='false' id='noti" . $notiId . "'> 
                                <div class='toast-header bg-success text-white'>
                                    <img src='assets/img/noti.png' class='rounded mr-2' height=20 width=20>
                                    <strong class='mr-auto'><a href='#' id='product" . $productId . "' class='stretched-link text-decoration-none text-white notiProductName'>" . $productName . "</a></strong>
                                    <small class='text-white notiDate'>" . $timeMsg . "</small>
                                    <button type='button' class='ml-2 mb-1 close notiDeleteBtn' data-dismiss='toast' style='z-index: 10;'>
                                        <span class='text-white'>&times;</span>
                                    </button>
                                </div>
                                <div class='toast-body notiMsg' style='background-color: #d4edda;'>
                                    <strong>@" . $notiFrom . "</strong> " . $notiMsg . "
                                </div>
                            </div>";
                    break;

    case "danger" : echo "<div class='toast' data-autohide='false' id='noti" . $notiId . "'> 
                                <div class='toast-header bg-danger text-white'>
                                    <img src='assets/img/noti.png' class='rounded mr-2' height=20 width=20>
                                    <strong class='mr-auto'><a href='#' id='product" . $productId . "' class='stretched-link text-decoration-none text-white notiProductName'>" . $productName . "</a></strong>
                                    <small class='text-white notiDate'>" . $timeMsg . "</small>
                                    <button type='button' class='ml-2 mb-1 close notiDeleteBtn' data-dismiss='toast' style='z-index: 10;'>
                                        <span class='text-white'>&times;</span>
                                    </button>
                                </div>
                                <div class='toast-body notiMsg' style='background-color: #f8d7da;'>
                                    <strong>@" . $notiFrom . "</strong> " . $notiMsg . "
                                </div>
                            </div>";
                    break;
    
    case "warning" : echo "<div class='toast' data-autohide='false' id='noti" . $notiId . "'> 
                                <div class='toast-header bg-warning text-dark'>
                                    <img src='assets/img/noti.png' class='rounded mr-2' height=20 width=20>
                                    <strong class='mr-auto'><a href='#' id='product" . $productId . "' class='stretched-link text-decoration-none text-dark notiProductName'>" . $productName . "</a></strong>
                                    <small class='text-dark notiDate'>" . $timeMsg . "</small>
                                    <button type='button' class='ml-2 mb-1 close notiDeleteBtn' data-dismiss='toast' style='z-index: 10;'>
                                        <span class='text-dark'>&times;</span>
                                    </button>
                                </div>
                                <div class='toast-body notiMsg' style='background-color: #fff3cd;'>
                                    <strong>@" . $notiFrom . "</strong> " . $notiMsg . "
                                </div>
                            </div>";
                    break;
    
    case "info" : echo "<div class='toast' data-autohide='false' id='noti" . $notiId . "'> 
                                <div class='toast-header bg-info text-white'>
                                    <img src='assets/img/noti.png' class='rounded mr-2' height=20 width=20>
                                    <strong class='mr-auto'><a href='#' id='product" . $productId . "' class='stretched-link text-decoration-none text-white notiProductName'>" . $productName . "</a></strong>
                                    <small class='text-white notiDate'>" . $timeMsg . "</small>
                                    <button type='button' class='ml-2 mb-1 close notiDeleteBtn' data-dismiss='toast' style='z-index: 10;'>
                                        <span class='text-white'>&times;</span>
                                    </button>
                                </div>
                                <div class='toast-body notiMsg' style='background-color: #d1ecf1;'>
                                    <strong>@" . $notiFrom . "</strong> " . $notiMsg . "
                                </div>
                            </div>";
                    break;
    
    case "secondary" : echo "<div class='toast' data-autohide='false' id='noti" . $notiId . "'> 
                            <div class='toast-header bg-secondary text-white'>
                                <img src='assets/img/noti.png' class='rounded mr-2' height=20 width=20>
                                <strong class='mr-auto'><a href='#' id='product" . $productId . "' class='stretched-link text-decoration-none text-white notiProductName'>" . $productName . "</a></strong>
                                <small class='text-white notiDate'>" . $timeMsg . "</small>
                                <button type='button' class='ml-2 mb-1 close notiDeleteBtn' data-dismiss='toast' style='z-index: 10;'>
                                    <span class='text-white'>&times;</span>
                                </button>
                            </div>
                            <div class='toast-body notiMsg' style='background-color: #e2e3e5;'>
                                <strong>@" . $notiFrom . "</strong> " . $notiMsg . "
                            </div>
                        </div>";
                break;
} -->