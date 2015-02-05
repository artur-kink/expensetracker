<?php
require("db.php");
if(strtoupper($_SERVER["REQUEST_METHOD"]) == "POST"){
	$name = $_POST["name"];
	$amount = floatval($_POST["amount"]);
	$date = $_POST["date"];
	$type = $_POST["type"];

	$stmt = $mysqli->prepare("call InsertExpense(?, ?, ?, ?);");
	$stmt->bind_param("sdsi", $date, $amount, $name, $type);
	$result = $stmt->execute();
	$stmt->close();
	echo "true";
}
?>