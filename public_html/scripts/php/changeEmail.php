<?php
	
session_start();

if(isset($_POST['submitEmail'])){
	
	include_once 'dbconnection.php';

	//$username =mysqli_real_escape_string($conn, $_POST["username"]);
	$email = mysqli_real_escape_string($conn, $_POST["email"]);

	$userID = $_SESSION["u_id"];


	//error handlers
	//empty fields
	if(empty($email)){
		//header("Location: ../../index.html? signup=empty");
		echo "empty fields\n";
		exit();
	}

	else{

	$sql = "UPDATE users SET email = ? WHERE userID = ?;";
	
		
	$stmt = mysqli_stmt_init($conn);

	if(!mysqli_stmt_prepare($stmt, $sql)){
		//echo "SQL error\n";
		header("Location: ../../pages/dashboard.html? nameChange = ivalidSQL");
	}
	
	else{

		mysqli_stmt_bind_param($stmt, "ss" , $email , $userID);
		mysqli_stmt_execute($stmt);
		
		header("Location: ../../pages/dashboard.html? nameChange =success");
		$_SESSION['u_email']= $email;
		//echo "$userID <br> $fName <br> $lName" ;
	}

	


	
	}
}

else{

	//echo "nothing worked at all\n";
	header("Location: ../../pages/dashboard.html? nameChange = fail");
	exit();
}