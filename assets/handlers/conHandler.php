<?php
    //database info
    $server = "localhost";                  //default = "localhost"         "sql110.epizy.com"
    $username = "root";                     //default = "root"              "epiz_25951262"
    $password = "";                         //default = ""                  "G29pRSbMSD"
    $dbName = "u_store";                    //default = "u_store"           "epiz_25951262_ustore"

    $con = mysqli_connect($server, $username, $password, $dbName);

    if(!$con){
        echo "Connection Error code: " . mysqli_connect_error();
    }
?>