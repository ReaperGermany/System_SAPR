<?php
	include('session.php');
	include('gEdit.php');
	include('gDel.php');
	include('gAdd.php');
?>

<HTML>
	<HEAD>
		<TITLE> Группы</TITLE>
		<META charset='utf-8'/>
	</HEAD>
	
	<BODY>
		<a href='achoose.php'>Back</a>
		<h1> Группы </h1>
		
		<form action='agroup.php' method='post'>
			<input type="text" name="gName" placeholder="Название группы" required>
			<input type="text" name="Kurs" placeholder="Курс" required>			
			<input type="submit" name="gAdd" value="Добавить">
		</form>
		
		<TABLE border="1">
			<tr>
				<th> ID </th>
				<th> Название группы </th>
				<th> Курс </th>				
				<th> Студенты </th>
				<th> Изменить название </th>
				<th> Удалить </th>
			</tr>
		
		<?php
			$connect = mysql_connect("localhost","root","");
			$db = mysql_select_db("KursDB",$connect);
			$query = mysql_query("SELECT * FROM groups",$connect);
			$res = array();
			$count = 0;
			while ($row = mysql_fetch_array($query))
			{
				$res[$count] = $row;
				$count++;
			}
			foreach ($res as $group):
		?>
			<tr>
				<td><?=$group['Gid'];?></td>
				<td><?=$group['Name'];?></td>
				<td><?=$group['Kurs'];?></td>				
				<td><a href="gStTable.php?group=<?=$group['Gid'];?>">Перейти</a></td>
				<td>
					<form action="agroup.php" method="POST">
						<input type="text" name="Name" placeholder="<?=$group['Name'];?>" required>
						<input type="text" name="Kurs" placeholder="<?=$group['Kurs'];?>" required>
						<input type="hidden" name="id" value="<?=$group['Gid'];?>">
						<input type="submit" name="gEdit" value="Edit">
					</form>
				</td>
				<td>
					<form action="agroup.php" method="POST">
						<input type="hidden" name="id" value="<?=$group['Gid'];?>">
						<input type="submit" name="gDel" value="Del">
					</form>
				</td>
			</tr>
		<?php
			endforeach;
			mysql_close($connect);
		?>
		</TABLE>
	</BODY>
</HTML>