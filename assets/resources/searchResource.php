<?php
    session_start();            //starting session to use session variables

    include('../handlers/conHandler.php');      //including the connection to database handler

    if(isset($_POST['search'])){
        $searchFor = mysqli_real_escape_string($con, $_POST['search']);      //searching for this value
        $collegeName = $_SESSION['currentUserCollege'];                     //current user's college

        //checking if the search is field is empty or not
        if($searchFor != ""){
            //exploding the search value to make guesses
            $searchForArray = explode(" ", $searchFor);
            if(count($searchForArray) == 1){
                if(strpos($searchForArray[0], "_") !== false || strpos($searchForArray[0], "@") !== false){
                    //may be user is searching for a username
                    $searchFor = str_replace("@", "", $searchFor);      //removing the "@" sign 
                    $query = "SELECT id, product_name, uploaded_by FROM products WHERE c_name = '$collegeName' AND uploaded_by LIKE '%$searchFor%' LIMIT 7 ";
                }else{
                    //may be user is searching for a product name
                    $query = "SELECT id, product_name, uploaded_by FROM products WHERE c_name = '$collegeName' AND product_name LIKE '%$searchFor%' LIMIT 7 ";
                }
                //checking if something is found here or not
                $result_check = mysqli_query($con, $query);
                if(mysqli_num_rows($result_check) == 0){
                    $resultFound = 0;       //no result for than go for a general search
                }
            }elseif(count($searchForArray) >= 2){
                //may be user is searching for a product name or product description
                $query = "SELECT id, product_name, uploaded_by FROM products WHERE c_name = '$collegeName' AND ((product_name LIKE '%$searchForArray[0]%' OR product_name LIKE '%$searchForArray[1]%') OR (product_desc LIKE '%$searchForArray[0]%' OR product_desc LIKE '%$searchForArray[1]%')) LIMIT 7 ";
            }
            
            //if none of the guesses matched than seacrh for all only if the user has entered 3 letters
            if(isset($resultFound)){
                $query = "SELECT id, product_name, uploaded_by FROM products WHERE c_name = '$collegeName' AND((uploaded_by LIKE '%$searchFor%') OR (product_name LIKE '%$searchFor%') OR (product_desc LIKE '%$searchFor%')) LIMIT 7 ";
            }

            //checking if any of the guesses matched or not
            if(isset($query)){
                //finally extracting results
                $result = mysqli_query($con, $query);
                foreach($result as $row){
                    //preparing an array of all the product ids for the search results page
                    $searchResultsProductIds[] = $row['id'];

                    //output string for live search result
                    $searchResultString = "<div class='oneSearchResult p-2'>
                                                <a href='searchPage.php?productId=" . $row['id'] . "' class='text-decoration-none'>
                                                    <p class='m-0 p-0'>" . $row['product_name'] . "</p>
                                                    <p class='text-muted m-0 p-0'><small>owner: </small>@" . $row['uploaded_by'] . "</p>
                                                </a>
                                            </div><hr class='m-1'>";
                    
                    echo $searchResultString;
                }//end of for each
                echo "*";           //to separate array
                //building link for "see more results" page
                $idsArray = http_build_query(array('idArray' => $searchResultsProductIds));
                echo $idsArray;
            }  
        }
    }
?>