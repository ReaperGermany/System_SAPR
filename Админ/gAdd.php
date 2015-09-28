<?php
	if(isset($_POST['gAdd']))
	{
		$connect = mysql_connect("localhost","root","");
		$db = mysql_select_db("KursDB",$connect);
		$name = $_POST['gName'];
		$kurs = $_POST['Kurs'];
		$query = mysql_query("INSERT INTO `groups`(`Name`, `Kurs`) VALUES ('$name','$kurs')",$connect);
		mysql_close($connect);
	}
?>