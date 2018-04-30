<?php

session_start();

if (isset($_SESSION['u_id']) && isset($_POST['email']) && isset($_POST['t_id'])) {
    include 'dbconnection.php';
    
    $tm_email = $_POST['email'];
    $team_id = $_POST['t_id'];

    // get new member's user id
    $sql = "SELECT userID FROM users WHERE email = '$tm_email';";
	$result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) <= 0) {
        echo false;
        exit();
    }

    $row = mysqli_fetch_assoc($result);
    $tm_id = $row['userID'];

    // add user id with team id to users_has_teams
    $sql = "INSERT INTO users_has_teams(users_userID, teams_teamID, isUserAdmin) VALUES(?, ?, '0');";
	$stmt = mysqli_stmt_init($conn);

	if(!mysqli_stmt_prepare($stmt, $sql)){
        echo false;
        exit();
	}
	
	mysqli_stmt_bind_param($stmt, "ss" , $tm_id, $team_id);
	mysqli_stmt_execute($stmt);
	echo true;
	
}