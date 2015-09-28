<?php
	include('session.php');
?>

<HTML>
	<HEAD>
		<TITLE> Изменение пользователя </TITLE>
		<META charset="utf-8"/>
	</HEAD>
	
	<BODY>
		<a href="gStTable.php?group=<?=$_GET['group'];?>">Back</a>
		<?php
			$connect = mysql_connect("localhost","root","");
			$db = mysql_select_db("KursDB",$connect);
			$id = $_POST['ID'];
			$query = mysql_query("SELECT * FROM students WHERE Sid = $id",$connect);
			$res = mysql_fetch_array($query);
		?>
				<form method='POST' action='gStTable.php?group=<?=$_GET['group'];?>'>
					<input type='text' name='username' placeholder='<?=$res['login'];?>' value='<?=$res['login'];?>' required>
					<input type='text' name='password' placeholder='<?=$res['password'];?>' value='<?=$res['password'];?>' required>
					<input type='text' name='FIO' placeholder='<?=$res['FIO'];?>' value='<?=$res['FIO'];?>' required>
					<input type='hidden' name='id' value='<?=$_POST['ID'];?>'>
					<input type='submit' name='sEdit' value='Edit'>
				</form>
		<?php
			mysql_close($connect);
		?>
	</BODY>
</HTML>