<?php
	include('session.php');
	include('uAdd.php');
	include('uDel.php');
	include('uEdit.php');
?>

<HTML>
	<HEAD>
		<TITLE> Пользователи</TITLE>
		<META charset='utf-8'/>
	</HEAD>
	<BODY>
		<a href='achoose.php'>Back</a>
		<h1> Пользователи </h1>
		<h2> Преподаватели </h2>
		<form action='auser.php' method='post'>
			<input type="text" name="username" placeholder="Логин" required>
			<input type="password" name="password" placeholder="*****" required> 
			<input type="text" name="FIO" placeholder="ФИО" required>
			<input type="hidden" name="type" value="teacher">
			<input type="submit" name="uAdd" value="Добавить">
		</form>
		
		<TABLE border="1">
			<tr>
				<th> ID </th>
				<th> FIO </th>
				<th> login </th>
				<th> password </th>
				<th> Edit </th>
				<th> Del </th>
			</tr>
		<?php
			$connection = mysql_connect("localhost","root","");
			$db = mysql_select_db("KursDB",$connection);
			$query = mysql_query("SELECT * FROM teachers",$connection);
			$res = array();
			$count = 0;
			while($row = mysql_fetch_array($query))
			{
				$res[$count] = $row;
				$count++;
			}
			foreach($res as $teacher):
		?>
			<tr>
				<td> <?=$teacher['Tid'];?> </td>
				<td> <?=$teacher['FIO'];?> </td>
				<td> <?=$teacher['Login'];?> </td>
				<td> <?=$teacher['Password'];?> </td>
				<td> 
					<form action='userEdit.php' method='POST'> 
						<input type="hidden" name="ID" value="<?=$teacher['Tid'];?>">
						<input type="hidden" name="type" value="teacher">
						<input type="submit" name="tEdit" value="Edit">
					</form> 
				</td>
				<td> 
					<form action='auser.php' method='POST'> 
						<input type="hidden" name="ID" value="<?=$teacher['Tid'];?>">
						<input type="hidden" name="type" value="teacher">
						<input type="submit" name="uDel" value="Delete">
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