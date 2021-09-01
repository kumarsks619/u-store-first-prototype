<?php
    session_start();

    include('conHandler.php');                   //including connection handler


    //compress image function*******************************************************************
    function compressImage($source, $destination, $quality){
        $info = getimagesize($source);
        //preparing image file for compression
        if($info['mime'] == "image/jpeg"){
            $image = imagecreatefromjpeg($source);
        }elseif($info['mime'] == "image/png"){
            $image = imagecreatefrompng($source);
        }

        imagejpeg($image, $destination, $quality);     //compressing image
    }


    //UPLOADING PRODUCT******************************************************************************
    if(isset($_POST['productUploadBtn'])){
        $productName = mysqli_real_escape_string($con, $_POST['productName']);  //product name
        $productDesc = mysqli_real_escape_string($con, $_POST['productDesc']);  //product description
        $file = $_FILES['productPhoto'];                                        //product image file array
        $productPrice = $_POST['productPrice'];                                 //product price

        //getting file details
        $imageName = $file['name'];             //image name
        $imageTmpSource = $file['tmp_name'];    //file tmp location
        $imageSize = $file['size'];             //file size
        
        //extracting file extension
        $fileExt = pathinfo($imageName, PATHINFO_EXTENSION);
        $fileExt = strtolower($fileExt);

        //new file name
        $newImageName = time() . "." . $fileExt;

        //file upload location
        $destination = "../../uploads/productsImage/" . $newImageName;

        //setting the compression quality
        if($imageSize > 2*1024*1000){            //when file size is larger than 2mb
            $quality = 5;
        }elseif($imageSize > 1*1024*1000){       //when file size is larger than 1mb
            $quality = 20;
        }elseif($imageSize > 0.5*1024*1000){    //when file size is larger than 500kb but less than 1mb
            $quality = 30;
        }else{                                  //when file size is less than 500kb 
            $quality = 40;
        }

        //calling the compress function
        compressImage($imageTmpSource, $destination, $quality);     //this will also upload the file

        //preparing data for database*****************************************
        //image link to display it
        $imageDisplayPath = "uploads/productsImage/" . $newImageName;

        //uploaded by
        $uploaded_by = $_SESSION['userLoggedIn'];
        
        //uploader's college name
        $query = "SELECT c_name FROM users WHERE username = '$uploaded_by' ";
        $result = mysqli_query($con, $query);
        $row = mysqli_fetch_assoc($result);
        $uploaderCollege = $row['c_name'];

        //time of upload
        $upload_date = date("Y-m-d");


        //sql query for inserting data table products table
        $query = "INSERT INTO products VALUES('', '$productName', '$productDesc', '$imageDisplayPath',
                                        '$productPrice', '$uploaded_by', '$uploaderCollege', '$upload_date', ',' )"; 
        mysqli_query($con, $query);

        //getting the product Id of the just uploaded product
        $productId = mysqli_insert_id($con);
        
        //sql query to get the value of product_Id column for the current user
        $query = "SELECT uploaded_pro_ids FROM users WHERE username = '$uploaded_by' ";
        $result = mysqli_query($con, $query);
        $row = mysqli_fetch_assoc($result);
        //preparing product ids string to be inserted
        $uploaded_pro_ids_string = $row['uploaded_pro_ids'] . $productId . ",";
        
        //sql query to update the uploaded_pro_ids column for the current user
        $query = "UPDATE users SET uploaded_pro_ids = '$uploaded_pro_ids_string' WHERE username = '$uploaded_by' ";
        mysqli_query($con, $query);

        //creating a session variable to display success message
        $_SESSION['productUploadCheck'] = 1;

        header("Location: ../../myProducts.php");     //redirecting when upload is completed successfully
        
    }
    //UPDATING PRODUCT**************************************************************************************
    elseif(isset($_POST['productEditBtn'])){
        $productId = $_POST['productId'];                                       //product id
        $productName = mysqli_real_escape_string($con, $_POST['productName']);  //product name
        $productDesc = mysqli_real_escape_string($con, $_POST['productDesc']);  //product description
        $productPrice = $_POST['productPrice'];                                 //product price

        //checking if the photo is to be updated or not****************************
        if($_FILES['productPhoto']['name'] != ""){
            //deleting the previously uploaded image of the product********
            //fetching the previous image name
            $query = "SELECT product_photo FROM products WHERE id = '$productId' ";
            $result = mysqli_query($con, $query);
            $row = mysqli_fetch_assoc($result);
            //image path relative to this handler
            $photoPath = "../../" . $row['product_photo'];
            unlink($photoPath);     //photo deleted

            //working on new photo******************************************
            $file = $_FILES['productPhoto'];        //product image file array

            //getting file details
            $imageName = $file['name'];             //image name
            $imageTmpSource = $file['tmp_name'];    //file tmp location
            $imageSize = $file['size'];             //file size
            
            //extracting file extension
            $fileExt = pathinfo($imageName, PATHINFO_EXTENSION);
            $fileExt = strtolower($fileExt);

            //new file name
            $newImageName = time() . "." . $fileExt;

            //file upload location
            $destination = "../../uploads/productsImage/" . $newImageName;

            //setting the compression quality
            if($imageSize > 2*1024*1000){            //when file size is larger than 2mb
                $quality = 5;
            }elseif($imageSize > 1*1024*1000){       //when file size is larger than 1mb
                $quality = 20;
            }elseif($imageSize > 0.5*1024*1000){    //when file size is larger than 500kb but less than 1mb
                $quality = 30;
            }else{                                  //when file size is less than 500kb 
                $quality = 40;
            }

            //calling the compress function
            compressImage($imageTmpSource, $destination, $quality);     //this will also upload the file

            //image link to display it
            $imageDisplayPath = "uploads/productsImage/" . $newImageName;

            //updating database*******************************
            $query = "UPDATE products SET product_name = '$productName', product_desc = '$productDesc', 
                        product_price = '$productPrice', product_photo = '$imageDisplayPath' 
                        WHERE id = '$productId' ";
            mysqli_query($con, $query);

            //creating a session variable to display success message
            $_SESSION['productEditCheck'] = 1;

            header("Location: ../../myProducts.php");     //redirecting when product is eddited successfully
        }else{
            //updating database*******************************
            $query = "UPDATE products SET product_name = '$productName', product_desc = '$productDesc', 
                        product_price = '$productPrice' WHERE id = '$productId' ";
            mysqli_query($con, $query);

            //creating a session variable to display success message
            $_SESSION['productEditCheck'] = 1;

            header("Location: ../../myProducts.php");     //redirecting when product is eddited successfully
        }
    }else{
        header("Location: ../../index.php");    //when directly trying to access this handler
    }
?>