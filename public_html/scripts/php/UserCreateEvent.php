<?php

function userCreateEvent() {
	session_start();


	if(isset($_SESSION['u_id'])){

		include_once 'dbconnection.php';

		$eventName = mysqli_real_escape_string($conn, $_POST["event-name"]);
		// start date is now combined with start time
		$startD = mysqli_real_escape_string($conn, $_POST["start-date-input"]);
		$startTime = mysqli_real_escape_string($conn, $_POST["start-time-input"]);
		$endD = mysqli_real_escape_string($conn, $_POST["end-date-input"]);
		$endTime = mysqli_real_escape_string($conn, $_POST["end-time-input"]);
	
		
		$startDate = $startD;
		$startDate .= " ";
		$startDate .= $startTime;

		//end date is now combined with end time
		$eventDescription = mysqli_real_escape_string($conn, $_POST["event-description"]);
		$eventLocation = mysqli_real_escape_string($conn, $_POST["event-location"]);
	
		$endDate = $endD;
		$endDate .= " ";
		$endDate .= $endTime;

		//checking to see if any of the feilds have been sent as empty
		//might need to change this according to Justin's plan. supposed to do error handling on front end?

		if(empty($eventName) || empty($startDate) || empty($endDate) || empty($eventLocation) || (empty($eventDescription)))
		{
			//header("Location: ../index.html? signup=empty");
			echo "empty fields\n";
			exit();
		}

	
		//could check for duplicate events or over lappping events.
		// right now storing in DB without questions
		else{

	
			$sql = "INSERT INTO events (name, start, end, location, description) VALUES (?, ?, ?, ?, ?)";
			$stmt = mysqli_stmt_init($conn);



			mysqli_stmt_bind_param($stmt, "sssss" , $eventName, 
									$startDate , $endDate, 
									$eventLocation, $eventDescription );

			mysqli_stmt_execute($stmt);
		
			if(!mysqli_stmt_prepare($stmt, $sql)){
				//echo "SQL error\n";
				header("Location: ../../pages/dashboard.html? eventCreation = ivalidSQL");
			}

			

	
			mysqli_stmt_bind_param($stmt, "sssss" , $eventName, 
									$startDate , $endDate, 
									$eventLocation, $eventDescription);

			mysqli_stmt_execute($stmt);

		
			//get the Primary Key for the event you just entered
			$eventId = mysqli_insert_id($conn);
			$userId = $_SESSION['u_id'] ;
			//NOW I NEED TO ADD TO THE USER HAS TEAMS TABLE

		
			$sql = "INSERT INTO users_has_events (users_userID, events_eventID) VALUES( $userId ,$eventId);";

			mysqli_query($conn,$sql);

		
			//redirects to the dashboard
			header("Location: ../../pages/dashboard.html? we got in?");

			}
		}

else{
	
		echo "denied bitch!!";
	}	




	}

//couldnt get into the if because the session is not working
