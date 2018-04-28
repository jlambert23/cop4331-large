<?php 

$dbServerName = "localhost";
$dbUserName = "root";
$dbPassword = "";
$dbName = "cop4331";

$conn = mysqli_connect($dbServerName,$dbUserName,$dbPassword, $dbName);

if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}
