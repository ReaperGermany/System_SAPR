<?php
	if(isset($_POST['uEdit']))
	{
		$connect = mysql_connect("localhost","root","");
		$db = mysql_select_db("KursDB",$connect);
		$login = $_POST['username'];
		$password = $_POST['password'];
		$FIO = $_POST['FIO'];
		$id = $_POST['id'];
		$query = mysql_query("UPDATE `teachers` SET `FIO`='$FIO',`Login`='$login',`Password`='$password' WHERE Tid=$id", $connect);
		mysql_close($connect);
	}
?>