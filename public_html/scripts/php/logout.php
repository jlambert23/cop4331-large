<?php

if(isset($_POST['logout'])){
	session_start();
	session_unset();
	session_destroy();
	echo "/../index.html";
	header("Location: ../pages/dashboard.html");
}