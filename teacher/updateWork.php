<?
session_start();
		
	$connection = mysql_connect("localhost", "root", "");
	$db = mysql_select_db("KursDB", $connection);
	
	$Stid = $_POST['Stid'];
	$inTime = $_POST['inTime'];
	$defend = $_POST['defend'];
	$mark = $_POST['mark'];
	$Wid = $_POST['Wid'];
	$Suid = $_POST['Suid'];
	$Gid = $_POST['Gid'];


	$query = mysql_query("UPDATE works SET Stid = '$Stid', inTime = '$inTime', defend = '$defend', mark = '$mark' WHERE Wid = $Wid" ,$connection);

	$query = mysql_query("select Wid from statusDate where Wid = '$Wid'" ,$connection);
	
		if( mysql_num_rows($query) == 0 ) { 
			$query = mysql_query("INSERT INTO statusDate (Wid) VALUES ('$Wid')" ,$connection);
		}

	$strQuery = "UPDATE statusDate SET s".$Stid." = '".date('j F Y')."' WHERE Wid = $Wid";
	$query = mysql_query($strQuery ,$connection);

	mysql_close($connection);

	$str = 'Location: note.php?Suid='.$Suid.'&Gid='.$Gid;
		header($str);
?>