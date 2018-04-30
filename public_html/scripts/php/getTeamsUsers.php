<?php

//THIS NEEDS TO BE CHANGED TO THE ENTIRE USER FIELD
if(isset($_GET['t_id'])){

	 include 'dbconnection.php';

 	 $teamId = $_GET['t_id'];

 	 $sql = "SELECT * FROM user_has_teams WHERE teams_teamID = $teamId;";
	
	 $result = mysqli_query($conn, $sql);

	  while ($row = mysqli_fetch_assoc($result)) {
	  		
	  		//we have the user PK from the user has teams table
	  		$currentUser = $row['users_userID'];

	  		//need to get the users information from the users table
	  		//ERROR CHECK IF FOUND NO ROWS should not happen but check
	  		$sql = "SELECT * FROM users WHERE userID = $currentUser;";
	  		$userRow = mysqli_query($conn, $sql);

	  		//now that we have the row put inside the json
		 	$json[]['fName'] = $userRow['fName'];
		 	$json[]['lName'] = $userRow['lName'];
		 	$json[]['email'] = $userRow['email'];
		 	$json[]['phone'] = $userRow['phone'];



        	}

      echo json_encode($json);

}

else{
	
	echo "get me a proper t_id IT IS t_id dumbass";
}