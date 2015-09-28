<?php
	session_start(); // запуск сессии
?>
<html>	
	<head>
	    <meta charset='utf-8'/>
 		
	    <title>Отправка сообщения</title>
	</head>
<body>
<?php
	if ($_POST['student'] == 0)
		{
    		$error = "Не указан получатель!";
	   	}
	else
	    {
	    	//подключение к БД
	    	$connection = mysql_connect("localhost", "root", "");
			$db = mysql_select_db("KursDB", $connection);
			//получение переменных и обработка для защиты
			$Tid = $_POST['teacher'];
			$Theme = stripslashes($_POST['theme']);
			$Text = stripslashes(htmlspecialchars($_POST['text']));
			$Theme = mysql_real_escape_string($Theme);
			$Text = mysql_real_escape_string($Text);
			$Sid = $_SESSION['userID'];
			//запросы на вставку сообщений
			$query = mysql_query("INSERT INTO Smessages(Sid, Tid, TextM, Theme, MsgStatus) VALUES ('$Sid', '$Tid', '$Text', '$Theme', 0)", $connection);
			$query = mysql_query("INSERT INTO Tmessages(Sid, Tid, TextM, Theme, MsgStatus) VALUES ('$Sid', '$Tid', '$Text', '$Theme', 1)", $connection);
			mysql_close($connection);
			header('location:inboxmail.php');
		}	
?>
</body>
</html>
