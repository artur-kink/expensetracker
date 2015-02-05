<?php
require("db.php");

$expense_result = $mysqli->query("select expense.Name as Name, expense.ExpenseTime as ExpenseTime, expense.Amount as Amount, etype.Name as Type from expenses as expense inner join expense_types as etype on expense.Type = etype.Id;");
$expenses = array();
while($expense = $expense_result->fetch_object()){
	$expenses[] = $expense;
}
echo json_encode($expenses);
?>