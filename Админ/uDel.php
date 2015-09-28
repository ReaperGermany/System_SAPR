<?php
	if(isset($_POST['uDel']))
	{
		$connect = mysql_connect("localhost","root","");
		$db = mysql_select_db("KursDB",$connect);
		$id = $_POST['ID'];
		$query = mysql_query("DELETE FROM `teachers` WHERE `teachers`.`Tid` = $id",$connect);
		mysql_close($connect);
	}
?>