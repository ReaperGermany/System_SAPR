<?php
	if(isset($_POST['suAdd']))
	{
		$connect = mysql_connect("localhost","root","");
		$db = mysql_select_db("KursDB",$connect);
		$name = $_POST['suName'];
		$query = mysql_query("INSERT INTO `subject`(`Name`) VALUES ('$name')",$connect);
		mysql_close($connect);
	}
?>