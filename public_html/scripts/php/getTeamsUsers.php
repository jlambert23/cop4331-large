<?php

if(isset($_GET['t_id'])){

	 include 'dbconnection.php';

 	 $teamId = $_GET['t_id'];

 	 $sql = "SELECT * FROM user_has_teams WHERE teams_teamID = $teamId;";
	 $result = mysqli_query($conn, $sql);

	  while ($row = mysqli_fetch_assoc($result)) {

		 	$json[] = $row['userID'];

        	}
      echo json_encode($json);

}

else{
	
	echo "get me a proper t_id IT IS t_id dumbass";
}