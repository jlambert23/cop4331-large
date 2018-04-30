<?php
    session_start();

    if (isset($_SESSION["u_id"])) {
        include 'dbconnection.php';
        
        // Currently, a user is fetching ALL of the teams for testing purposes.
        // We'll use the commented code later, when we're better at things.
        //$id = $_SESSION["u_id"];
        //$sql = "SELECT teams_teamID FROM users_has_teams WHERE users_userID = '$id';";

        $sql = "SELECT teams_teamID FROM users_has_teams;";
        $result = mysqli_query($conn, $sql);
        $teamIDs = mysqli_fetch_all($result);

        // No teams are associated with this user. Return empty JSON.
        if (count($teamIDs) <= 0) {
            echo json_encode($teamIDs);
            exit();
        }

        // Build sql query so that we obtain the team names of all team ids we have.
        $sql = "SELECT * FROM teams WHERE ";
        for( $i = 0; $i < count($teamIDs); $i++ ) {
            $teamid = $teamIDs[$i][0];
            $sql .= "teamID = '$teamid'";

            if ($i < count($teamIDs) - 1) $sql .= " OR ";
        }
        $sql .= ";";

        $result = mysqli_query($conn, $sql);
        
        // Fetch team names and format for json package.
        while ($row = mysqli_fetch_assoc($result)) {
            $team['team'] = $row['team_name'];
            $team['tid'] = $row['teamID'];
            $json[] = $team;
        }

        echo json_encode($json);
    }