<?php
	echo "test\n";

if(isset($_POST['submitSignup'])){
	
	include_once 'dbconnection.php';

	//$username =mysqli_real_escape_string($conn, $_POST["username"]);
	$first = mysqli_real_escape_string($conn, $_POST["fname"]);
	$last = mysqli_real_escape_string($conn, $_POST["lname"]);
	$email = mysqli_real_escape_string($conn, $_POST["email"]);
	$password = mysqli_real_escape_string($conn, $_POST["psw"]);
	$passwordRepeat = mysqli_real_escape_string($conn, $_POST["pswrepeat"]);


	//error handlers
	//empty fields
	if(empty($first) || empty($last) || empty($email) || empty($password)){
		//header("Location: ../../index.html ? signup=empty");
		echo "empty fields\n";
		exit();
	}

	else if(! ($password === $passwordRepeat) ){
		//header("Location: ../../index.html ? signup=passwordNotMatching");
		echo "passwords dont match\n";
		exit();
	}

	else{

	$sql = "INSERT INTO users (fName, lName, email, password) VALUES (?, ?, ?, ?)";

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
		//hash pwd
		$hashedPassword = password_hash($password,PASSWORD_DEFAULT);
		printf("%s\n", $hashedPassword);

		mysqli_stmt_bind_param($stmt, "ssss" , $first, $last , $email, $hashedPassword);
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
