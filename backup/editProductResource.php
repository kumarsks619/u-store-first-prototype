<?php
    session_start();

    include('../handlers/conHandler.php');          //including connection handler

    if(isset($_POST['diff_var'])){
        $productId = $_POST['product_Id'];          //product id

        //fetching product details
        $query = "SELECT product_name, product_desc, product_price FROM products WHERE id = '$productId' ";
        $result = mysqli_query($con, $query);
        while($row = mysqli_fetch_assoc($result)){
            $productName = $row['product_name'];        //product name
            $productDesc = $row['product_desc'];        //product description
            $productPrice = $row['product_price'];      //product price

            exit(json_encode(array("productName" => $productName, "productDesc" => $productDesc, "productPrice" => $productPrice)));
        }
    }else{
        header("Location: ../../index.php");        //when directly trying to access this resource
    }
?>