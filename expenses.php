<?php
require("db.php");
?>
<html>
	<head>
		<title>Insert Expense</title>
		<script src="jquery-2.1.3.min.js" language="javascript" type="text/javascript"></script>
		<script src="jquery.dataTables.min.js" language="javascript" type="text/javascript"></script>
		<link rel="stylesheet" type="text/css" href="jquery.dataTables.min.css">
		<script>
			var table;
			$("document").ready(function(){
				table = $('#expenses').dataTable();
				
				$.get("get_expenses.php", function(result){
					var expenses = jQuery.parseJSON(result);
					for(var expense in expenses){
						table.fnAddData([expenses[expense].Name, expenses[expense].Amount, expenses[expense].ExpenseTime, expenses[expense].Type]);
					}
				});
			});
			
			function insert(){
				if(!$("#name").val().trim() || !$("#date").val().trim() || !$("#amount").val()){
					return;
				}
				$.post("insert_expense.php", $("#insert_form").serialize(), function(result){
					if(result == "true"){
						$('#expenses').dataTable().fnAddData(
							[$("#name").val(), $("#amount").val(), $("#date").val(), $("#type option:selected").text()]
						);
						$("#name").val("");
						$("#amount").val("");
					}
				});
			}
		</script>
	</head>
	<body>
		<form id="insert_form" action="insert_expense.php" method="POST">
			<label for="name">Name:</label>
			<input type="text" id="name" name="name" />
			<label for="amount">Amount:</label>
			<input type="text" id="amount" name="amount" />
			<label for="date">Time:</label>
			<input type="text" id="date" name="date" value="<?php echo date('Y/m/d H:i:s');?>" />
			<label for="type">Type:</label>
			<select id="type" name="type">
<?php
$type_results = $mysqli->query("select * from expense_types;");
while($type = $type_results->fetch_object()){
	echo "<option value=\"" . $type->Id . "\">" . $type->Name . "</option>\n";
}
?>
			</select>
			<input type="button" value="Submit" onclick="insert();" />
		</form>
		<table id="expenses">
			<thead>
				<tr>
					<th>Name</th>
					<th>Amount</th>
					<th>Time</th>
					<th>Type</th>
				</tr>
			</thead>
			<tbody>
			</tbody>
		</table>
	</body>
</html>
