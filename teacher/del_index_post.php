<?php 
	session_start();
?>
<html>
<head>
	<meta  http-equiv="Refresh" content="0; URL = teacher.php">
</head>>
<?php 
	
	if (isset($_POST['Gid'])) {
		$del_gid=$_POST['Gid'];
		$Tid=$_SESSION['userID'];
		$connection = mysql_connect("localhost", "root", "");
        $db = mysql_select_db("KursDB", $connection);

        $query = mysql_query("delete from groupreference WHERE Tid = '$Tid' and Gid = '$del_gid'", $connection);
		
		mysql_close($connection);
	}

	if (isset($_POST['Suid'])) {
		
		$del_suid=$_POST['Suid'];
		$Tid=$_SESSION['userID'];

		$connection = mysql_connect("localhost", "root", "");
        $db = mysql_select_db("KursDB", $connection);

        var_dump($del_suid);

        $query = mysql_query("delete from subjectreference where Tid = '$Tid' and Suid = '$del_suid'", $connection);
		
		mysql_close($connection);
    }
?>
</html>
