<?php

if(isset($_GET['t_id']) ){

	include 'dbconnection.php';
	$teamId = $_GET['t_id'];

	$sql = "SELECT eventID FROM events_has_teams WHERE teamID = $teamId;";


	$result = mysqli_query($conn, $sql);
	$events = mysqli_fetch_all($result);
	
	// No events. Return empty JSON.
	if (count($events) <= 0) {
		echo json_encode($events);
		exit();
	}
	
    // Build sql query so that we obtain the team names of all team ids we have.
	$sql = "SELECT * FROM events WHERE ";
	for( $i = 0; $i < count($events); $i++ ) {
		$eventid = $events[$i][0];
		$sql .= "eventID = '$eventid'";

		if ($i < count($events) - 1) $sql .= " OR ";
	}
	$sql .= ";";

	$result = mysqli_query($conn, $sql);
	
	if (mysqli_num_rows($result) <= 0) {
		echo json_encode($result);
		exit();
	}

	while ($event = mysqli_fetch_assoc($result)) {
		$var['name'] = $event['name'];
		$var['start'] = $event['start'];
		$var['end'] = $event['end'];
		$var['location'] = $event['description'];
		$var['owner'] = $event['owner'];
		$json[] = $var;
	}
	
	echo json_encode($json);
}
else {
	echo "didnt get a proper t_id dude cmon you had one job";
}