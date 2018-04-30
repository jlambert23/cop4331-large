<?php

session_start();

if (isset($_SESSION["u_id"]) && isset($_GET["term"])) {
    include 'dbconnection.php';

    $term = $_GET["term"];
    $sql = "SELECT fname, lname, email, phone FROM users WHERE fname LIKE '%$term%' OR lname LIKE '%$term%';";
    
    $result = mysqli_query($conn, $sql);
 
    $json = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $user['fname'] = $row['fname'];
        $user['lname'] = $row['lname'];
        $user['email'] = $row['email'];
        $user['phone'] = $row['phone'];
        $json[] = $user;
    }
    
    echo json_encode($json);
    exit();
}