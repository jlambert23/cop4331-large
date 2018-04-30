<?php

session_start();


if (isset($_SESSION["u_id"]) && isset($_GET["term"])) {
    include 'dbconnection.php';
    $tid = $_GET["t_id"];
    $term = $_GET["term"];
    $sql = "SELECT * FROM users WHERE fName LIKE '%$term%' OR lName LIKE '%$term%';";
    
    $result = mysqli_query($conn, $sql);

    $json = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $uid = $row['userID'];
        $sql = "SELECT * FROM users_has_teams WHERE users_userID='$uid' AND teams_teamID='$tid';";
        $result2 = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result2) <= 0) {
            $user['fname'] = $row['fName'];
            $user['lname'] = $row['lName'];
            $user['email'] = $row['email'];
            $json[] = $user;
        }
    }
    
    echo json_encode($json);
    exit();
}