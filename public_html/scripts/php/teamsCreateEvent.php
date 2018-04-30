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
	
		
		$startDate = $startD;
		$startDate .= " ";
		$startDate .= $startTime;
	
		$endDate = $endD;
		$endDate .= " ";
		$endDate .= $endTime;
		
		
		//end date is now combined with end time
		$eventDescription = mysqli_real_escape_string($conn, $_POST["event-description"]);
		$eventLocation = mysqli_real_escape_string($conn, $_POST["event-location"]);
		$eventOwner = $_POST['event-team'];
		
		//$startTime = mysqli_real_escape_string($conn, $_POST["start-time-input"]);
		//$endTime = mysqli_real_escape_string($conn, $_POST["end-time-input"]);
	
	
		//checking to see if any of the feilds have been sent as empty
		//might need to change this according to Justin's plan. supposed to do error handling on front end?
		if(empty($eventName) || empty($startDate) 
			|| empty($endDate) || empty($eventLocation)
			|| (empty($eventDescription)))
		{
			//header("Location: ../index.html ? signup=empty");
			echo "empty fields\n";
			exit();
		}
	
		else if(empty($eventOwner)){
			echo "Error: either user event or no owner given";
			exit();
		}
	
		//could check for duplicate events or over lappping events.
		// right now storing in DB without questions
		else{
			
	
	
			//end is a key word in SQL not sure you can insert properly
			$sql = "INSERT INTO events (name, start, end, location, description, owner) VALUES (?, ?, ?, ?,?,?)";
			$stmt = mysqli_stmt_init($conn);
	
			if(!mysqli_stmt_prepare($stmt, $sql)){
				//echo "SQL error\n";
				header("Location: ../pages/dashboard.html? eventCreation = ivalidSQL");
			}
	
			else{
	
				
	
				mysqli_stmt_bind_param($stmt, "ssssss" , $eventName, 
										$startDate , $endDate, 
										$eventLocation, $eventDescription, $eventOwner);
	
				mysqli_stmt_execute($stmt);
	
				//get the Primary Key for the team event you just entered
				$teamEventId = mysqli_insert_id($conn);
				$teamId = $_POST['t_id'];
				
				//NOW I NEED TO ADD TO THE EVENT HAS TEAMS TABLE
				$sql = "INSERT INTO event_has_teams (teamID, eventID) VALUES( $teamId ,$teamEventId);";
	
				mysqli_query($conn,$sql);
	
				//redirects to the dashboard SHOULD REDIRECT TO TEAM PAGE
				header("Location: ../../pages/dashboard.html ? we got in?");
	
				//PART #3 we have the team PK now we need to query and get all the users in the team
				// WE need their primary keys from user_has_teams table
				// put the PK's into an array we need to loop through this array later
	
				$sql = "SELECT users_userID FROM users_has_teams WHERE teams_teamID = $teamId;";
	
				$result = mysqli_query($conn, $sql);
	
				//get all the users that belong to that team
				while ($row = mysqli_fetch_assoc($result)) {
				
					//$team['team'] = $row['team_name'];
					//$json[] = $team;
	
					$userPrimaryKeys[] = $row['users_userID'];
	
					// STEP#4 Now that we have the PK's we need to add them to user_has_event we need the EVENT PK (teamEventId)
					foreach ($userPrimaryKeys as &$currentUserPrimary){
						
						// based on the for loop this should be the PK from the array -> $currentUserPrimary 
						$sql = "INSERT INTO users_has_events (users_userID, teams_teamID) VALUES( $currentUserPrimary,$teamEventId);";
						mysqli_query($conn,$sql);
					
						}
	
					}
	
			}
		}
	
	}
	
	//couldnt get into the if because the session is not working
	else{
	
		echo "denied bitch!!";
	}
}
	