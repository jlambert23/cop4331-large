<?php
    session_start();

    if (isset($_SESSION["u_id"])) {
        include 'dbconnection.php';
        $id = $_SESSION["u_id"];

        $sql = "SELECT teams_teamID FROM users_has_teams;";// WHERE users_userID = '$id';";
        $result = mysqli_query($conn, $sql);
        $teamIDs = mysqli_fetch_assoc($result);

        // No teams are associated with this user. Return empty JSON.
        if (count($teamIDs) <= 0) {
            echo json_encode($teamIDs);
            exit();
        }

        // Build sql query for teamID.
        $sql = "SELECT team_name FROM teams WHERE ";
        for( $i = 0; $i < count($teamIDs); $i++ ) {
            $tid = $teamIDs[$i];
            $sql .= count($teamIDs); //"teamID = '$tid'";

            if ($i < count($teamIDs) - 1) $sql .= " OR ";
        }
        $sql .= ";";

        // $result = mysqli_query($conn, $sql);
        // $teams = mysqli_fetch_all($result);

        echo json_encode($teamIDs["teams_teamID"]);
    }