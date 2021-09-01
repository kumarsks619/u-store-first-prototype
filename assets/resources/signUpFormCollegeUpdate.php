<?php
    include('../handlers/conHandler.php');

    if(isset($_POST['cityName'], $_POST['stateName'])){
        //state name
        $stateName = strtolower($_POST['stateName']);
        $stateName = str_replace(" ", "_", $stateName);
        //city name
        $cityName = $_POST['cityName'];

        $query = "SELECT colleges FROM  $stateName WHERE city_name = '$cityName' ";
        $result = mysqli_query($con, $query);
        if(mysqli_num_rows($result) > 0){
            echo "<option selected disabled>College Name</option>";
            
            $row = mysqli_fetch_assoc($result);
            $collegeString = $row['colleges'];            //string containing all the colleges of the selected city
            $collegeArray = explode(":", $collegeString); //array containing college names with 2 garbage values
            array_shift($collegeArray);   //removing garbage value from first position
            array_pop($collegeArray);     //removing garbage value from last position
            //iterating through the college array 
            foreach($collegeArray as $collegeName){
                echo "<option>" . $collegeName . "</option>";
            }
        }
    }else{
        header("Location: ../../index.php");    //when directly trying to access this resource
    }
?>