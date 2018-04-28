<?php
	session_start();

if(isset($_POST['submit'])){

	include_once 'dbconnection.php';

	$eventName = mysqli_real_escape_string($conn, $_POST["event-name"]);
	$startDate = mysqli_real_escape_string($conn, $_POST["start-date-input"]);
	$startTime = mysqli_real_escape_string($conn, $_POST["start-time-input"]);
	$endDate = mysqli_real_escape_string($conn, $_POST["end-date-input"]);
	$endTime = mysqli_real_escape_string($conn, $_POST["end-time-input"]);
	$eventDescription = mysqli_real_escape_string($conn, $_POST["event-description"]);
	$eventLocation = mysqli_real_escape_string($conn, $_POST["event-location"]);

	//checking to see if any of the feilds have been sent as empty
	//might need to change this according to Justin's plan. supposed to do error handling on front end?
	if(empty($eventName) || empty($startDate) || empty($startTime) 
		|| empty($endDate) || empty($endTime) || empty($eventLocation)
		|| (empty($eventDescription)))
	{
		//header("Location: ../index.html ? signup=empty");
		echo "empty fields\n";
		exit();
	}

	//could check for duplicate events or over lappping events.
	// right now storing in DB without questions
	else{

	$sql = "INSERT INTO events (name, start_date, end_date, start_time,end_time, location, description) VALUES (?, ?, ?, ?,?,?, ?)";
		$stmt = mysqli_stmt_init($conn);

		if(!mysqli_stmt_prepare($stmt, $sql)){
			//echo "SQL error\n";
			header("Location: ../pages/dashboard.html? eventCreation = ivalidSQL");
		}

		

		mysqli_stmt_bind_param($stmt, "sssssss" , $eventName, 
								$startDate , $startTime, $endDate,$endTime, 
								$eventDescription, $eventLocation);

		mysqli_stmt_execute($stmt);
		header("Location: ../pages/dashboard.html ? we got in?");

	}




}

//couldnt get into the if because the session is not working
else{

	echo "denied bitch!!";
}