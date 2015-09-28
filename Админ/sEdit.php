<?php
	if(isset($_POST['sEdit']))
	{
		$connect = mysql_connect("localhost","root","");
		$db = mysql_select_db("KursDB",$connect);
		$login = $_POST['username'];
		$password = $_POST['password'];
		$FIO = $_POST['FIO'];
		$id = $_POST['id'];
		$query = mysql_query("UPDATE `students` SET `FIO`='$FIO',`login`='$login',`password`='$password' WHERE Sid=$id", $connect);
		mysql_close($connect);
	}
?>