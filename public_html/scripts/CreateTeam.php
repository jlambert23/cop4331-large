<?php
	session_start();

if(isset($_POST['submit-team'])){

	include_once 'dbconnection.php';

	$teamName = mysqli_real_escape_string($conn, $_POST["team-name" ]);
	//$eventDescription = mysqli_real_escape_string($conn, $_POST["event-description" ]);
	

	//checking to see if any of the feilds have been sent as empty
	//might need to change this according to Justin's plan. supposed to do error handling on front end?
	if(empty($teamName))
	{
		//header("Location: ../index.html ? signup=empty");
		echo "empty fields\n";
		exit();
	}

	//could check for duplicate events or over lappping events.
	// right now storing in DB without questions
	else{

		$sql = "INSERT INTO teams (team_name) VALUES (?)";
		$stmt = mysqli_stmt_init($conn);

		if(!mysqli_stmt_prepare($stmt, $sql)){
			//echo "SQL error\n";
			header("Location: ../pages/dashboard.html? eventCreation = ivalidSQL");
		}

		

		mysqli_stmt_bind_param($stmt, "s" , $teamName);
		mysqli_stmt_execute($stmt);

		header("Location: ../pages/dashboard.html ? we got in?");

	}




}

//couldnt get into the if because the session is not working
else{

	echo "denied bitch!! the session variable not working";
}