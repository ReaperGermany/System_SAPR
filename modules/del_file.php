<?php
	session_start();
    $Tid = $_SESSION['userID'];
	$Suid = $_POST['Suid'];
	$Name = $_POST['Name'];

	$connect = mysql_connect("localhost","root","");
	$db = mysql_select_db("KursDB",$connect);
	
	$query = mysql_query("DELETE FROM `materials` WHERE `File_Name`='$Name'",$connect);

	$str = 'Location: ../teacher/materials.php?Suid='.$Suid;
	header($str);
?>
