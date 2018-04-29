<?php
	echo "test\n";

if(isset($_POST['submitName'])){
	
	include_once 'dbconnection.php';

	//$username =mysqli_real_escape_string($conn, $_POST["username"]);
	$fName = mysqli_real_escape_string($conn, $_POST["fname"]);
	$lName = mysqli_real_escape_string($conn, $_POST["lname"]);

	$userID = $_SESSION["u_id"];


	//error handlers
	//empty fields
	if(empty($fName) || empty($lName)){
		//header("Location: ../../index.html ? signup=empty");
		echo "empty fields\n";
		exit();
	}

	else{

	$sql = "update users set fName = ?, lName = ? where userID = ?";
		

	// if ($result = $conn->query($sql) != true) {
	// 	echo "It it didn't work, yo.\n";
	// 	exit();
	// }
	
	// echo $result;
	// echo "\n WE PIP IT\n";
	
		
	$stmt = mysqli_stmt_init($conn);

	if(!mysqli_stmt_prepare($stmt, $sql)){
		//echo "SQL error\n";
		header("Location: ../../index.html? signup = ivalidSQL");
	}
	
	else{
		mysqli_stmt_bind_param($stmt, "sss" , $fName, $lName , $userID);
		mysqli_stmt_execute($stmt);

		//echo "\nsignup is working\n";
		header("Location: ../../index.html? signup=success");
	}

	


	
	}
}

else{

	//echo "nothing worked at all\n";
	header("Location: ../../index.html? signup= fail");
	exit();
}