<?php
	session_start();
	if ($_SESSION['login_user']!='Asha'){header("location: index.php");}
?>