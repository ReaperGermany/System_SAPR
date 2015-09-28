<?php
	session_start();
?>
<html>
<head>
    <meta  http-equiv="Refresh" content="0; URL = groups.php">
</head>
<body>
	<?php		
		$gID = $_POST["Gid"];
		$tID = $_SESSION['userID'];
		var_dump($tID);

		$connection = mysql_connect("localhost", "root", "");
		$db = mysql_select_db("KursDB", $connection);

		$query = mysql_query("INSERT INTO groupReference (`Gid`, `Tid`) VALUES ($gID, $tID)", $connection);   	

		mysql_close($connection);
		$_SESSION['error'] = 'выполнено';
	?>
</body>
</html>	