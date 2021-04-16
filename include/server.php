<?php

    $servername = "localhost";
    $useername = "root";
    $password = "";
    $dbname = "register_db";

    $conn = mysqli_connect($servername,$useername,$password,$dbname);

    if(!$conn){
        die("Connection Failed" . mysqli_connect_error());
    }
