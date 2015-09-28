<?php
	if(isset($_POST['uAdd'])){
		$connect = mysql_connect("localhost","root","");
		$db = mysql_select_db("KursDB",$connect);
		$login = $_POST['username'];
		$password = $_POST['password'];
		$FIO = $_POST['FIO'];
		$query = mysql_query("INSERT INTO `teachers`( `FIO`, `Login`, `Password`) VALUES ('$FIO','$login','password')",$connect);
		mysql_close($connect);
	}
?>