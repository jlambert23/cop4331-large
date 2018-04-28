<?php
    session_start();

        include 'dbconnection.php';
        
        $sql = "SELECT fName, lName, email FROM users;";
        $result = mysqli_query($conn, $sql);
        
        // Fetch users and format for json package.
        while ($row = mysqli_fetch_assoc($result)) {
            $user['fname'] = $row['fName'];
            $user['lname'] = $row['lName'];
            $user['email'] = $row['email'];
            $json[] = $user;
        }

        echo json_encode($json);
    