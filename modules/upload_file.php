<?php
	session_start();
    $Tid = $_SESSION['userID'];
	$Suid = $_POST['Suid'];
	$Srid = $_POST['Srid'];

	if(is_uploaded_file($_FILES["filetoAdd"]["tmp_name"]))
	   {
	     move_uploaded_file($_FILES["filetoAdd"]["tmp_name"], "../materialsFile/".$_FILES["filetoAdd"]["name"]);
		 $connect = mysql_connect("localhost","root","");
		 $db = mysql_select_db("KursDB",$connect);
		 $File_Name = $_FILES["filetoAdd"]["name"];
		 $path = "/materialsFile/".$_FILES["filetoAdd"]["name"];
		 
	     $query = mysql_query("INSERT INTO `materials`(`File_Name`, `Srid`, `path`) VALUES ('$File_Name',$Srid,'$path')",$connect);
	   } else {
	      echo("Ошибка загрузки файла");
	   }
	
	$str = 'Location: ../teacher/materials.php?Suid='.$Suid;
	header($str);
?>
