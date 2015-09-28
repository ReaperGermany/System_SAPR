<?php
	if(isset($_POST['gEdit']))
	{
		$connect = mysql_connect("localhost","root","");
		$db = mysql_select_db("KursDB",$connect);
		$id = $_POST['id'];
		$name = $_POST['Name'];
		$kurs = $_POST['Kurs'];		
		$query = mysql_query("UPDATE `groups` SET `Name`='$name', `Kurs`=$kurs WHERE `groups`.`Gid` = $id",$connect);
		mysql_close($connect);
	}
?>