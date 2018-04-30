<?php
	session_start();

if(isset($_POST['submit-team'])){

	include_once 'dbconnection.php';

	$uid = $_SESSION['u_id'];
	$teamName = $_POST['team-name'];
	$teamDescription = $_POST['description'];

	$sql = "INSERT INTO teams (team_name, description) VALUES ('$teamName', '$teamDescription');";
	mysqli_query($conn, $sql);

	$sql = "SELECT teamID FROM teams WHERE team_name = '$teamName';";
	$result = mysqli_query($conn, $sql);

	$tid = mysqli_fetch_assoc($result);
	$tid = $tid['teamID'];

	$sql = "INSERT INTO users_has_teams (users_userID, teams_teamID, isUserAdmin) VALUES ('$uid', '$tid', '0');";
	header("Location: ../../dashboard.html? createteam = success");
}

// 	$teamName = mysqli_real_escape_string($conn, $_POST["team-name" ]);
// 	$teamDescription = mysqli_real_escape_string($conn, $_POST["description" ]);

// 	//$eventDescription = mysqli_real_escape_string($conn, $_POST["event-description" ]);
	

// 	//checking to see if any of the feilds have been sent as empty
// 	//might need to change this according to Justin's plan. supposed to do error handling on front end?
// 	if(empty($teamName))
// 	{
// 		//header("Location: ../index.html? signup=empty");
// 		echo "empty fields\n";
// 		exit();
// 	}

// 	//could check for duplicate events or over lappping events.
// 	// right now storing in DB without questions
// 	else{

// 		$sql = "INSERT INTO teams (team_name, description) VALUES (?, ?)";
// 		$stmt = mysqli_stmt_init($conn);

// 		if(!mysqli_stmt_prepare($stmt, $sql)){
// 			//echo "SQL error\n";
// 			header("Location: ../pages/dashboard.html? eventCreation = invalidSQL");
// 		}

		

// 		mysqli_stmt_bind_param($stmt, "ss" , $teamName, $teamDescription);
// 		mysqli_stmt_execute($stmt);

// 		//get the Primary Key for the event you just entered
// 		$teamId = mysqli_insert_id($conn);
// 		$userId = $_SESSION['u_id'];

// 		//since they created the team they are admin
// 		$adminPrivelege = true;
// 		//NOW I NEED TO ADD TO THE USER HAS TEAMS TABLE

// 		$sql = "INSERT INTO users_has_teams (users_userID, teams_teamID, isUserAdmin) VALUES( $userId ,$teamId,$adminPrivelege);";

// 		$result = mysqli_query($conn,$sql);

// 		header("Location: ../../pages/dashboard.html? we got in?q=" . $result);

// 	}




// }

// //couldnt get into the if because the session is not working
// else{

// 	echo "denied bitch!! the session variable not working";
// }