<?php

function teamsCreateEvent() {
	session_start();

	if(isset($_SESSION['u_id'])){
	
		include_once 'dbconnection.php';
	
		$eventName = mysqli_real_escape_string($conn, $_POST["event-name"]);
		// start date is now combined with start time
		$startD = mysqli_real_escape_string($conn, $_POST["start-date-input"]);
		$startTime = mysqli_real_escape_string($conn, $_POST["start-time-input"]);
		$endD = mysqli_real_escape_string($conn, $_POST["end-date-input"]);
		$endTime = mysqli_real_escape_string($conn, $_POST["end-time-input"]);
		$eventOwner = mysqli_real_escape_string($conn, $_POST["event-team"]);
		
		$startDate = $startD;
		$startDate .= " ";
		$startDate .= $startTime;
		
		//end date is now combined with end time
		$eventDescription = mysqli_real_escape_string($conn, $_POST["event-description"]);
		$eventLocation = mysqli_real_escape_string($conn, $_POST["event-location"]);
	
		$endDate = $endD;
		$endDate .= " ";
		$endDate .= $endTime;
		
		
		//$startTime = mysqli_real_escape_string($conn, $_POST["start-time-input"]);
		//$endTime = mysqli_real_escape_string($conn, $_POST["end-time-input"]);
		
	
		//checking to see if any of the feilds have been sent as empty
		//might need to change this according to Justin's plan. supposed to do error handling on front end?
		if(empty($eventName) || empty($startDate) 
			|| empty($endDate) || empty($eventLocation)
			|| (empty($eventDescription)))
		{
			//header("Location: ../index.html? signup=empty");
			echo "empty fields\n";
			exit();
		}
	
		else if(empty($eventOwner)){
			// header("Locate: ../../dashboard.html? owner=fail");// "Error: either user event or no owner given";
			exit();
		}
		//could check for duplicate events or over lappping events.
		// right now storing in DB without questions
		else{
			$sql = "INSERT INTO events(name, start, end, location, description, owner) VALUES ('$eventName','$startDate','$endDate','$eventLocation','$eventDescription','$eventOwner');";
			$result = mysqli_query($conn,$sql);
			
			//get the Primary Key for the team event you just entered
			$teamEventId = mysqli_insert_id($conn);
			$sql = "SELECT * from teams where team_name = '$eventOwner';";
			$result = mysqli_query($conn,$sql);
			$row = mysqli_fetch_assoc($result);
			$teamID = $row['teamID'];

			$sql = "INSERT INTO events_has_teams (teamID, eventID) VALUES( $teamID ,$teamEventId);";
			$result = mysqli_query($conn,$sql);

			//redirects to the dashboard SHOULD REDIRECT TO TEAM PAGE
			//PART #3 we have the team PK now we need to query and get all the users in the team
			// WE need their primary keys from user_has_teams table
			// put the PK's into an array we need to loop through this array later

			$sql = "SELECT users_userID FROM users_has_teams WHERE teams_teamID = $teamID;";
			$result = mysqli_query($conn, $sql);
			

			//get all the users that belong to that team
			while ($row = mysqli_fetch_assoc($result)) {
			
			$uid = $row['users_userID'];
			$sql = "INSERT INTO users_has_events (users_userID, events_eventID) VALUES ($uid, $teamEventId);";
			$result = mysqli_query($conn, $sql);
			header("Location: ../../pages/dashboard.html?eo=$eventOwner ?q=" . $result);
			exit();

			}

			
		header("Location: ../../pages/dashboard.html? we got inadskufuhsadiud?");
		exit();

		}
	
	}
	
	//couldnt get into the if because the session is not working
	else{
	
		echo "denied bitch!!";
	}
}