<?php
	include('session.php');
?>

<HTML>
	<HEAD>
		<TITLE> Изменение пользователя </TITLE>
		<META charset="utf-8"/>
	</HEAD>
	
	<BODY>
		<a href="auser.php">Back</a>
		<?php
			$connect = mysql_connect("localhost","root","");
			$db = mysql_select_db("KursDB",$connect);
			$id = $_POST['ID'];
			$query = mysql_query("SELECT * FROM teachers WHERE Tid = $id",$connect);
			$res = mysql_fetch_array($query);
		?>
				<form method='POST' action='auser.php'>
					<input type='text' name='username' placeholder='<?=$res['Login'];?>' value='<?=$res['Login'];?>' required>
					<input type='text' name='password' placeholder='<?=$res['Password'];?>' value='<?=$res['Password'];?>' required>
					<input type='text' name='FIO' placeholder='<?=$res['FIO'];?>' value='<?=$res['FIO'];?>' required>
					<input type='hidden' name='id' value='<?=$_POST['ID'];?>'>
					<input type='hidden' name='type' value='<?=$_POST['type'];?>'>
					<input type='submit' name='uEdit' value='Edit'>
				</form>
		<?php
			mysql_close($connect);
		?>
	</BODY>
</HTML>