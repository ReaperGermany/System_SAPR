<?php
	include('session.php');
	if(!isset($_GET['group']))
	{
		header("location: agroup.php");
	}	
	include('sAdd.php');
	include('sDel.php');
	include('sEdit.php');
	
?>

<HTML>
	<HEAD>
		<TITLE> Таблица студентов </TITLE>
		<META charset="utf-8"/>
	</HEAD>
	
	<BODY>
		<a href='agroup.php'>Back</a>
		<h1> Студенты </h1>
		<form action='gStTable.php?group=<?=$_GET['group'];?>' method='post'>
			<?php
				$connection = mysql_connect("localhost","root","");
				$db = mysql_select_db("KursDB",$connection);
				$gid = $_GET['group'];
				$query = mysql_query("SELECT Kurs FROM groups WHERE Gid = $gid",$connection);
				$res = mysql_fetch_array($query);
			?>
			<input type="hidden" name="kurs" value="<?=$res['Kurs'];?>">
			<input type="text" name="username" placeholder="Логин" required>
			<input type="password" name="password" placeholder="*****" required> 
			<input type="text" name="FIO" placeholder="ФИО" required>
			<input type="submit" name="sAdd" value="Добавить">
		</form>
		
		<TABLE border="1">
			<tr>
				<th> ID </th>
				<th> FIO </th>
				<th> Login </th>
				<th> Password </th>
				<th> Edit </th>
				<th> Delete </th>
			</tr>
		<?php
			$connection = mysql_connect("localhost","root","");
			$db = mysql_select_db("KursDB",$connection);
			$query = mysql_query("SELECT * FROM students WHERE `Gid`=$gid",$connection);
			$res = array();
			$count = 0;
			while($row = mysql_fetch_array($query))
			{
				$res[$count] = $row;
				$count++;
			}
			foreach($res as $students):
		?>
			<tr>
				<td> <?=$students['Sid'];?> </td>
				<td> <?=$students['FIO'];?> </td>
				<td> <?=$students['login'];?> </td>
				<td> <?=$students['password'];?> </td>
				<td> 
					<form action='stEdit.php?group=<?=$_GET['group'];?>' method='POST'> 
						<input type="hidden" name="ID" value="<?=$students['Sid'];?>">
						<input type="submit" name="sEdit" value="Edit">
					</form> 
				</td>
				<td> 
					<form action='gStTable.php?group=<?=$_GET['group'];?>' method='POST'> 
						<input type="hidden" name="ID" value="<?=$students['Sid'];?>">
						<input type="submit" name="sDel" value="Delete">
					</form> 
				</td>
			</tr>
		<?php
			endforeach;
		?>
		</TABLE>
		<?php
			mysql_close($connection);
		?>
	</BODY>
</HTML>