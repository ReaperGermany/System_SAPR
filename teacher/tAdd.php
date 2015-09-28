<?
	//Скрипт для добавления темы
	if(isset($_POST['Addtheme']))
		{
		//Подключаемся к БД и считываем ИД предмета, препода и тему
			$connection = mysql_connect("localhost", "root", "");
			$db = mysql_select_db("KursDB", $connection);
			$tid=$_POST['tID'];
			$suid=$_POST['sID'];
			$theme = $_POST['theme'];
		//Выполняем запрос на вставку новой темы в таблицу тем.
			$query = mysql_query("INSERT INTO `themes`( `Tid`, `Suid`, `theme`) VALUES ($tid, $suid, '$theme')" ,$connection);
		//Выводим сообщение об успешном добавлении
			?> <div> <?php echo "Added!";?></div> <?php
		}
?>