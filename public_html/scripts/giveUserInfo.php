<?php 
	session_start();
	include 'dbconnection.php';

	$jsonExample = array();

	$jsonExample['fname'] = $_SESSION['u_first'];
	$jsonExample['lname'] = $_SESSION['u_last'];
	$jsonExample['description'] = 'I\'m just a guy. Please stop laughing.';
	$jsonExample['image'] = 'img/Pizzaface.jpg';

	echo json_encode($jsonExample, JSON_UNESCAPED_SLASHES);



// // person is logged in we have a session
// if(isset($_SESSION[u_id])){
	
// 	$jsonExample = array();

// 	 //dynamic example
// 	$userId = $_SESSION["u_id"] ;
// 	$fName = $_SESSION["u_first"] ;
// 	$lName = $_SESSION["u_last"] ;
// 	$email= $_SESSION["u_email"] ;

// 	$jsonExample['fName'] = '$fName';
// 	$jsonExample['lname'] = '$lName';
// 	$jsonExample['description'] = 'I\'m just a guy. Please stop laughing.';

// 	$sql = "SELECT picture_path FROM users WHERE userID = '$userId';";
// 	$result = mysqli_query($conn, $sql);

// 	while($row = mysql_fetch_assoc($result)) {
//     $fromID = $row['user_id'];
// }

// 	$jsonExample['image'] = '$fromID';

// 	echo json_encode($jsonExample, JSON_UNESCAPED_SLASHES);

// 	/*
// 	//static example
// 	$jsonExample['fName'] = 'Pizza';
// 	$jsonExample['lname'] = 'Face';
// 	$jsonExample['description'] = 'I\'m just a guy. Please stop laughing.';
// 	$jsonExample['image'] = 'img/Pizzaface.jpg';

// 	echo json_encode($jsonExample, JSON_UNESCAPED_SLASHES);
	
// 	//$associativeArray = array();
// 	//$associativeArray ['FirstValue'] = 'FirstValue';
// 	*/


// }