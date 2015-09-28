<?php
	include("session.php");
	include("suAdd.php");
	include("suEdit.php");
	include("suDel.php");
?>
<HTML>
	<HEAD>
		<TITLE> Предметы </TITLE>
		<META charset="utf-8"/>
	</HEAD>
	
	<BODY>
		<a href="achoose.php"> Back </a>
		<h1> Предметы </h1>
		
		<form method="POST" action="aSubj.php">
			<input type="text" name="suName" placeholder="Название предмета">
			<input type="submit" name="suAdd" value="Add">
		</form>
		
		<TABLE border="1">
		
			<tr>
				<th>ID</th>
				<th>Name</th>
				<th>Edit</th>
				<th>Del</th>
			</tr>
		
		<?php
			$connect = mysql_connect("localhost","root","");
			$db = mysql_select_db("KursDB",$connect);
			$query = mysql_query("SELECT * FROM subject",$connect);
			$res = array();
			$count = 0;
			while ($row = mysql_fetch_array($query))
			{
				$res[$count]=$row;
				$count++;
			}
			foreach($res as $subj):
		?>
			
			<tr>
				<td><?=$subj['Suid'];?></td>
				<td><?=$subj['Name'];?></td>
				<td>
					<form method="POST" action="aSubj.php">
						<input type="text" name="suName" placeholder="<?=$subj['Name'];?>">
						<input type="hidden" name="id" value="<?=$subj['Suid'];?>">
						<input type="submit" name="suEdit" value="Edit">
					</form>
				</td>
				<td>
					<form method="POST" action="aSubj.php">
						<input type="hidden" name="id" value="<?=$subj['Suid'];?>">
						<input type="submit" name="suDel" value="Del">
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