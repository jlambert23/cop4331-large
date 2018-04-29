<?php
	echo "test\n";

if(isset($_POST['submitPass'])){
	
	include_once 'dbconnection.php';

	//$username =mysqli_real_escape_string($conn, $_POST["username"]);
	$oldPass = mysqli_real_escape_string($conn, $_POST["currPass"]);
	$shinyPass = mysqli_real_escape_string($conn, $_POST["newPass"]);

	$userID = $_SESSION["u_id"];


	//error handlers
	//empty fields
	if(empty($oldPass) || empty($shinyPass)){
		//header("Location: ../index.html ? signup=empty");
		echo "empty fields\n";
		exit();
	}

	else{

	$sql = "select password from users where userID = ?";
	
	$oldHashedPassword = password_has($oldPass,PASSWORD_DEFAULT);
	

	// if ($result = $conn->query($sql) != true) {
	// 	echo "It it didn't work, yo.\n";
	// 	exit();
	// }
	
	// echo $result;
	// echo "\n WE PIP IT\n";
	
		
	$stmt = mysqli_stmt_init($conn);

	if(!mysqli_stmt_prepare($stmt, $sql)){
		//echo "SQL error\n";
		header("Location: ../index.html? signup = ivalidSQL");
	}
	
	else{
		//hash pwd
		$hashedNewPassword = password_hash($shinyPass,PASSWORD_DEFAULT);
		printf("%s\n", $hashedPassword);

		mysqli_stmt_bind_param($stmt, "ssss" , $first, $last , $email, $hashedPassword);
		$oldpass = mysqli_stmt_execute($stmt);

		//echo "\nsignup is working\n";
		header("Location: ../index.html? signup=success");
	}

	


	
	}
}

else{

	//echo "nothing worked at all\n";
	header("Location: ../index.html? signup= fail");
	exit();
}