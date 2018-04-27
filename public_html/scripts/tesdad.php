<?php
include_once 'dbconnection.php';

$sql = "insert into users (fname) VALUES ('donut')";
$result = $conn->query($sql);

echo $result;