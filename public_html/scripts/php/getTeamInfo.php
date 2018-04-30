<?php
	
	session_start();
	//given a team id spit back out information as json
	//change the isset to whatever justin is doing

	if(isset($_GET['t_id'])){
	
	 include 'dbconnection.php';

 	 $teamId = $_GET['t_id'];


	 $sql = "SELECT * FROM teams WHERE teamID = $teamId;";
	 $result = mysqli_query($conn, $sql);


	 if (!mysqli_num_rows($result)) {
		$json['team'] = false;
		echo json_encode($json);
		exit();
	}

	if($row = mysqli_fetch_assoc($result)){
		
		$json['team'] = $row['team_name'];
		$json['picture'] = $row['picture_path'];
		echo json_encode($json);
      
	}

	else{
		
		echo "didnt get an ID post...do your job Justin!";

	}

}

else{

	echo "shit is breaking didnt get a proper t_id";
}

