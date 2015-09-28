<?php
	if(isset($_POST['sDel']))
	{
		$connect = mysql_connect("localhost","root","");
		$db = mysql_select_db("KursDB",$connect);
		$id = $_POST['ID'];
		$query = mysql_query("DELETE FROM `KursDB`.`students` WHERE `students`.`Sid` = $id",$connect);
		mysql_close($connect);
	}
?>
