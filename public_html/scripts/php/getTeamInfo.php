<?php
	//given a team id spit back out information as json
	//change the isset to whatever justin is doing
	if(isset($_POST['t_id']){
	
	 include 'dbconnection.php';

 	 $teamId = $_POST['t_id'];


	 $sql = "SELECT * FROM teams WHERE teamID = $teamId;";
	 $result = mysqli_query($conn, $sql);


	 if (mysqli_num_rows($result) != 1) {
		$json['team_name'] = false;
		echo json_encode($json);
		exit();
	}

	if($row = mysqli_fetch_assoc($result)){
		/*
		$hashedPasswordCheck = password_verify($password, $row['password']);

		if($hashedPasswordCheck == false){
			$json['password'] = false;
			echo json_encode($json);
			exit();
		}
      */

		$json['team_name'] = $row['team_name'];
		$json['picture_path'] = $row['picture_path'];
      
	}

	else{
		
	echo "didnt get an ID post...do your job Justin!";

	}

