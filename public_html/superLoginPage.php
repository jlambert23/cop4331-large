<?php
session_start();
?>


<!DOCTYPE html>
<html>

	<head> 
		<title> you have logged in </title>
	</head>

	<body>
		
		<div class = "main wrapper">
		
		<?php

		if(isset($_SESSION['u_id'])){

		echo "you are logged in Mr." . "<br>" ;
		echo "$_SESSION[u_id]";
		echo "jimmy";

		}

		?>


		

		</div>
		<form action = "scripts/logout.php" method = "POST"> 
			<button type ="submit" name = "logout"> logout </button>
		</form>
		

	</body>



</html>