<?php
	if (isset($_POST['suDel']))
	{
		$connect = mysql_connect("localhost","root","");
		$db = mysql_select_db("KursDB",$connect);
		$id = $_POST['id'];
		
		$query = mysql_query("DELETE FROM `KursDB`.`subject` WHERE `subject`.`Suid` = $id",$connect);
		mysql_close($connect);
	}
?>