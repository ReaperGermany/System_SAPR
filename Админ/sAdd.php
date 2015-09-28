<?php
	if(isset($_POST['sAdd'])){
		$connect = mysql_connect("localhost","root","");
		$db = mysql_select_db("KursDB",$connect);
		$login = $_POST['username'];
		$password = $_POST['password'];
		$FIO = $_POST['FIO'];
		$group = $_GET['group'];
		$kurs = $_POST['kurs'];
		$query = mysql_query("INSERT INTO `students`( `FIO`, `Login`, `Password`, `Gid`, `Kurs`) VALUES ('$FIO','$login','password', $group, $kurs)",$connect);
		mysql_close($connect);
	}
?>		