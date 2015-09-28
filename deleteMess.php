<?php
	session_start(); //запуск сессии
	if (isset($_POST['MsgID'])) { //если знаем, что удалять (установлен ID сообщения), то
        //получаем ID сообщения
        $MsgID=$_POST['MsgID'];
		if ($_SESSION['role']  == 0) {  //если студент, то
			//подключение к БД
			$connection = mysql_connect("localhost", "root", ""); 		
			$db = mysql_select_db("KursDB", $connection);
			//запрос на удаление
			$query = mysql_query("delete from Smessages where MsgID = '$MsgID'", $connection);
			mysql_close($connection);
			header('location:inboxmail.php');
		} else { //если преподаватель, то
			//подключение к БД
			$connection = mysql_connect("localhost", "root", ""); 		
			$db = mysql_select_db("KursDB", $connection);
			//запрос на удаление
			$query = mysql_query("delete from Tmessages where MsgID = '$MsgID'", $connection);
			mysql_close($connection);
			header('location:inboxmail.php');
		}
	}
?>
</body>
</html>
