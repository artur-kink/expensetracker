<?php
$mysqli = new mysqli("127.0.0.1", "root", "x", "expensetracker");
if(mysqli_connect_errno()){
	die("Could not resolve mysql connection.");
}
?>
