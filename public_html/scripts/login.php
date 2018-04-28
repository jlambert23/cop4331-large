<?php

session_start();

if (isset($_POST['email']) && isset($_POST['psw']) && isset($_POST['submitButton'])){
	include 'dbconnection.php';

	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$password = mysqli_real_escape_string($conn, $_POST['psw']);

	if(empty ($email) || empty($password)) {
		echo "error: email or password is empty.";
		header("Location: ../index.html?login=empty");
		exit();
	}

	$sql = "SELECT * FROM users WHERE email = '$email';";
	$result = mysqli_query($conn, $sql);

	if($row = mysqli_fetch_assoc($result)){
		$hashedPasswordCheck = password_verify($password, $row['password']);

		if($hashedPasswordCheck == false){
			throw new Exception("Given password is not valid.");
		}

		// Store the user session info.
		$_SESSION["u_id"] = $row["userID"];
		$_SESSION["u_first"] = $row["fName"];
		$_SESSION["u_last"] = $row["lName"];
		$_SESSION["u_email"] = $row["email"];
		$_SESSION["u_pic"] = $row["picture_path"];
		$_SESSION["u_phone"] = $row["phone"];
		header("Location: ../pages/dashboard.html");
	}
}

// if(isset($_POST['submitButton'])){

// 	include 'dbconnection.php';

// 	$username = mysqli_real_escape_string($conn, $_POST['email']);
// 	$password = mysqli_real_escape_string($conn, $_POST['psw']);

// 	if(empty ($username) || empty($password)){
		
// 		// echo'<script type = "text/javascript">' ,
// 		// 'alert("empty")',
// 		// '</script>';
// 		header("Location: ../index.html? login=empty");
// 	}

// 	else{
// 			$sql = "SELECT * FROM users WHERE email = '$username';";
// 			$result = mysqli_query($conn, $sql);
// 			$resultCheck = mysqli_num_rows($result);

// 			// NOT SURE IF USERNAME CAN HAVE DUPLICATES
// 			if($resultCheck <1 || $resultCheck >1){
// 				header("Location: ../index.html?login=error johnson");
// 				exit();
// 			}

// 			else{
				
// 				if($row = mysqli_fetch_assoc($result)){

// 					$hashedPasswordCheck = password_verify($password,$row['password']);

// 					if($hashedPasswordCheck == false){
// 						header("Location: ../index.html?password=notCorrect");
// 						exit();

// 					}

// 					elseif($hashedPasswordCheck == true){
// 						//log in the user here
// 						$_SESSION["u_id"] = $row["userID"];
// 						$_SESSION["u_first"] = $row["fName"];
// 						$_SESSION["u_last"] = $row["lName"];
// 						$_SESSION["u_email"] = $row["email"];
// 						$_SESSION["u_pic"] = $row["picture_path"];
// 						$_SESSION["u_phone"] = $row["phone"];
// 						//$_SESSION["u_username"] = $row["username"];

// 						header("Location: ../pages/dashboard.html");
// 						exit();
					


// 					}


// 				}

// 			}


// 	}


// }

// else{

// 	header("Location: ../index.html? login = errordude");
// 	exit();

// }