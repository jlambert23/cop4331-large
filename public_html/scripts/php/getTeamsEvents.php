<?php

if(isset($_GET['t_id'])){

	$teamId = $_GET['t_id'];

	$sql = "SELECT * FROM events_has_teams WHERE teamID = $teamId;";
	
	$result = mysqli_query($conn, $sql);


	  while ($row = mysqli_fetch_assoc($result)) {

		 	$eventPrimary[] = $row['eventID'];

        	}

	}

else {


	echo "didnt get a proper t_id dude cmon you had one job";
}