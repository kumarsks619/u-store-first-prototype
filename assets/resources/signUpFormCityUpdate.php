<?php
    include('../handlers/conHandler.php');

    if(isset($_POST['stateName'])){
        $stateName = strtolower($_POST['stateName']);
        $stateName = str_replace(" ", "_", $stateName);

        $query = "SELECT city_name FROM  $stateName";
        $result = mysqli_query($con, $query);
        if(mysqli_num_rows($result) > 0){
            echo "<option selected disabled>College City</option>";

            while($row = mysqli_fetch_assoc($result)){
                echo "<option>" . $row['city_name'] . "</option>";
            }
        }
    }else{
        header("Location: ../../index.php");    //when directly trying to access this resource
    }
?>