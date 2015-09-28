<?php
	if(isset($_POST['gDel']))
	{
		$connect = mysql_connect("localhost","root","");
		$db = mysql_select_db("KursDB",$connect);
		$id = $_POST['id'];
		$query = mysql_query("DELETE FROM `KursDB`.`groups` WHERE `groups`.`Gid` = $id",$connect);
		mysql_close($connect);
	}
?>