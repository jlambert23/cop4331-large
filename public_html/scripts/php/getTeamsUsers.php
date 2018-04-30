<?php

session_start();

if(isset($_GET['t_id'])){

	include 'dbconnection.php';

 	$teamId = $_GET['t_id'];

 	$sql = "SELECT * FROM users_has_teams WHERE teams_teamID = '$teamId';";
	
	$result = mysqli_query($conn, $sql);

	while ($row = mysqli_fetch_assoc($result)) {
	  		
		// we have the user PK from the user has teams table
	  	$currentUser = $row['users_userID'];

	  	// need to get the users information from the users table
	  	// ERROR CHECK IF FOUND NO ROWS should not happen but check
	  	$sql = "SELECT * FROM users WHERE userID = $currentUser;";
	  	$rowResult = mysqli_query($conn, $sql);
	  	$userRow = mysqli_fetch_assoc($rowResult);

		//now that we have the row put inside the json
		$user['fname'] = $userRow['fName'];
		$user['lname'] = $userRow['lName'];
		$user['email'] = $userRow['email'];
		$user['phone'] = $userRow['phone'];
		$json[] = $user;
	}
		
    echo json_encode($json);
}

else{
	
	echo "get me a proper t_id IT IS t_id dumbass";
}