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
		//header("Location: ../../index.html ? signup=empty");
		echo "empty fields\n";
		exit();
	}

	else{
		$sql = "SELECT * FROM users WHERE userID = '$userID';";
		$result = mysqli_query($conn, $sql);


		//$sql = "select password from users where userID = '$userID';";

<<<<<<< HEAD:public_html/scripts/changepassword.php
		// Checks if the user entered the correct password
		$hashedPasswordCheck = password_verify($password,$row['password']);
=======
	if(!mysqli_stmt_prepare($stmt, $sql)){
		//echo "SQL error\n";
		header("Location: ../../index.html? signup = ivalidSQL");
	}
	
	else{
		//hash pwd
		$hashedNewPassword = password_hash($shinyPass,PASSWORD_DEFAULT);
		printf("%s\n", $hashedPassword);
>>>>>>> 5c4d19ba089c89a9c1afd075643b135d06036b2b:public_html/scripts/php/changepassword.php

		if($hashedPasswordCheck == false){
			header("Location: ../index.html?password=notCorrect");
			exit();

<<<<<<< HEAD:public_html/scripts/changepassword.php
		}
=======
		//echo "\nsignup is working\n";
		header("Location: ../../index.html? signup=success");
	}
>>>>>>> 5c4d19ba089c89a9c1afd075643b135d06036b2b:public_html/scripts/php/changepassword.php

		// if ($result = $conn->query($sql) != true) {
		// 	echo "It it didn't work, yo.\n";
		// 	exit();
		// }
		
		// echo $result;
		// echo "\n WE PIP IT\n";
		
			
		//$stmt = mysqli_stmt_init($conn);
		
		
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
	header("Location: ../../index.html? signup= fail");
	exit();
}