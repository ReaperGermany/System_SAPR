<?php
	session_start();
	if (isset($_SESSION['role'])&&((isset($_SESSION['Tid']))||(isset($_SESSION['Sid']))))
	{
		if ($_SESSION['role']==0)
		{
			header("location: sthome.php");
		}
		else 
		{
			header("location: thome.php");
		}
	}
?>