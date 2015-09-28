<?php
	session_start();
?>
<html>
<head>
    <meta  http-equiv="Refresh" content="0; URL = subject.php">
</head>
<body>
	<?php		
		$sID = $_POST["Suid"];
		$tID = $_SESSION['userID'];

		$connection = mysql_connect("localhost", "root", "");
		$db = mysql_select_db("KursDB", $connection);
		
		$query = mysql_query("INSERT INTO `subjectReference`(`Suid`, `Tid`) VALUES ($sID,$tID)", $connection); 

		mysql_close($connection);
		$_SESSION['error'] = 'выполнено';
	?>
</body>
</html>	
