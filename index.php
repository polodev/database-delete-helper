<?php

require __dir__ . '/Db.php';

if ( isset( $_POST['database'] ) && isset( $_POST['username'] ) && isset( $_POST['password'] ) ) {
  $server     = $_POST['server'] ?? "localhost";
  $database   =  $_POST['database'] ;
  $username   = $_POST['username'];
  $password   = $_POST['password'];
  $db = new Db($server, $database, $username, $password);
  $db->delete_all_tables_worker();
}


?>

<!DOCTYPE html>
<html lang='en'>
<head>
	<meta charset='UTF-8'/>
	<title>Delete My DB</title>
<style>
input {
	padding: 6px 10px;
	display: block;
	margin-bottom: 5px;
}	
button {
	padding: 6px 10px;
	font-size: 16px;
}
</style>
</head>
<body>
	<form method="post">
		<input value="localhost" type="text"  name="server" placeholder="Server"> 
		<input type="text"  name="username" placeholder="User Name"> 
		<input type="text"  name="password" placeholder="Password"> 
		<input type="text"  name="database" placeholder="Database"> 
		<button type="submit">Submit</button>
	</form>
	
</body>
</html>