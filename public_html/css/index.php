<!DOCTYPE html> 

<html>

<head>

	<title> XXXBoneKiller </title>

</head>

<body>

	<p> Please enter information</p>
	
	<form action = "scripts/login.php" method = "POST">

	<!-- mmuts said having required in the fields on the front end is back practice
		because people can easily get around it using the developer tools. we should
		check the fields on the backend with php-->
	<ul style = "list-style-type:none">
		<li><input type = "text" name = "first" placeholder = "First Name" ></li>
		<li><input type = "text" name = "last" placeholder = "Last Name" ></li>
		<li><input type = "text" name = "email" placeholder = "Email" ></li>
		<li><input type = "text" name = "username" placeholder = "Enter Username" > </li>
		<li><input type = "password" name = "password" placeholder = "Password" ></li>
	</ul>

	<input type = "submit" name ="submit"> Sign up </input>

	</form>

	


</body>

</html>
