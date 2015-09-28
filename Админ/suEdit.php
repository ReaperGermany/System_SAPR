<?php
	if(isset($_POST['suEdit']))
	{
		$connect = mysql_connect("localhost","root","");
		$db = mysql_select_db("KursDB",$connect);
		$id = $_POST['id'];
		$name = $_POST['suName'];	
		$query = mysql_query("UPDATE `subject` SET `Name`='$name' WHERE Suid=$id",$connect);
		mysql_close($connect);
	}
?>