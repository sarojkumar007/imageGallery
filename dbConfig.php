<?php
    $dbHost     = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbName     = "drdoproject";
    // Create database connection
    $db = mysqli_connect($dbHost, $dbUsername, $dbPassword, $dbName);
    if(mysqli_connect_error()) die("connect failed");
?>
