<?php

include 'dbconnection.php';

if (isset($_GET['email'])) {
    $email = $_GET['email'];

    $sql = "SELECT * FROM users WHERE email = '$email';";
    $result = mysqli_query($conn, $sql);
    
    if (mysqli_num_rows($result) > 0) {
        echo json_encode("'$email' is already taken.");
        exit();
    }

    echo json_encode('true');
}