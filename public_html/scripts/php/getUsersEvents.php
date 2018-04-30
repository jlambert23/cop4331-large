<?php

	session_start();
	if(isset($_SESSION['u_id'])){

		include 'dbconnection.php';
		$userId  = $_SESSION['u_id'];

		$sql = "SELECT events_eventID FROM users_has_events WHERE users_userID = $userId;";

		$result = mysqli_query($conn,$sql);
		$events = mysqli_fetch_all($result);

        // No teams are associated with this user. Return empty JSON.
        if (count($events) <= 0) {
            echo json_encode($events);
            exit();
        }

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


else{

	echo "user Id variable not set";
}
