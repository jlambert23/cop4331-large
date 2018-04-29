<?php
	
session_start();

if(isset($_POST['submitPass'])){
	
	include_once 'dbconnection.php';

	//$username =mysqli_real_escape_string($conn, $_POST["username"]);
	$oldPass = mysqli_real_escape_string($conn, $_POST["currPass"]);
	$newPass = mysqli_real_escape_string($conn, $_POST["newPass"]);


	$userID = $_SESSION["u_id"];


	//error handlers
	//empty fields
	if(empty($oldPass) || empty($newPass)){
		//header("Location: ../../index.html ? signup=empty");
		echo "empty fields\n";
		exit();
	}

	$sql = "SELECT * FROM users WHERE userID = $userID;";
	$result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($result) != 1) {
		exit();
	}

	if($row = mysqli_fetch_assoc($result)){
		$hashedPasswordCheck = password_verify($oldPass, $row['password']);

		if($hashedPasswordCheck == false){
			$json['password'] = false;
			echo json_encode($json);
			exit();
		}

		else{

			$sql = "UPDATE users SET password = ? WHERE userID = ?;";
			
				
			$stmt = mysqli_stmt_init($conn);

			if(!mysqli_stmt_prepare($stmt, $sql)){
				//echo "SQL error\n";
				header("Location: ../../pages/dashboard.html? nameChange = ivalidSQL");
			}
			
			else{

				mysqli_stmt_bind_param($stmt, "ss" , $newPass , $userID);
				mysqli_stmt_execute($stmt);
				
				header("Location: ../../pages/dashboard.html ? nameChange =success");
				//echo "$userID <br> $fName <br> $lName" ;
			}

		


		
		}
}
}

else{

	//echo "nothing worked at all\n";
	header("Location: ../../pages/dashboard.html? nameChange = fail");
	exit();
}