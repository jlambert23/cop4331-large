<?php

	session_start();
	if(isset($_SESSION['u_id'])){

		 include 'dbconnection.php';
		$userId  = $_SESSION['u_id'];

		$sql = "SELECT * FROM users_has_events WHERE users_userID = $userId ;";

		$result = mysqli_query($conn,$sql);

		$json[] = array();
	 while ($row = mysqli_fetch_assoc($result)) {

	 	$eventId = $row['events_eventID'];
	 	$sql = "SELECT * FROM  events WHERE eventID = $eventId;";

	 	//STILL NEED TO CHECK IF THIS GAVE EVENTS
	 	$eventRow = msqli_query($conn,$sql);
	 	$json[]['name'] = $eventRow['name'];
	 	$json[]['start'] = $eventRow['start'];
	 	$json[]['end'] = $eventRow['end'];
	 	$json[]['location'] = $eventRow['location'];
	 	$json[]['description'] = $eventRow['description'];
	 	



	 }
	 echo json_encode($json);



}


else{

	echo "user Id variable not set";
}
