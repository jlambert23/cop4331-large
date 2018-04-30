<?php

if(isset($_GET['t_id']) ){

	include 'dbconnection.php';
	$teamId = $_GET['t_id'];

	$sql = "SELECT * FROM events_has_teams WHERE teamID = $teamId;";

	$result = mysqli_query($conn, $sql);

		$eventPrimary = array();
	  while ($row = mysqli_fetch_assoc($result)) {

		 	$eventPrimary[] = $row['eventID'];

        	}

        $json[] = array();

        foreach ($eventPrimary as &$currentEventPrimary){
 				
 				// based on the for loop this should be the PK from the array -> $currentUserPrimary 
		 		$sql = "SELECT * FROM events WHERE eventID = $currentEventPrimary";

		 		//need to verify that the event thingg has rows
		 		$event = mysqli_query($conn,$sql);

		 		$json[]['name'] = $event['name'];
		 		$json[]['start'] = $event['start'];
		 		$json[]['end'] = $event['end'];
		 		$json[]['location'] = $event['description'];
		 		$json[]['owner'] = $event['owner'];
		 		
			   
			}
			echo json_encode($json);

	}

else {


	echo "didnt get a proper t_id dude cmon you had one job";
}