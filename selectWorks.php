<?php
	session_start(); // запускаем сессию
?>
<html>	
<head>
    <meta charset='utf-8'/>
    <meta  http-equiv="Refresh" content="0; URL = sthome.php">
    <title>Выбор курсовых(инициализация)</title>
</head>
<body>
<?php // просто заносим данные из фильтра курсовых в сессию для удобства работы
	
	$_SESSION['sellect']['Stid'] = $_POST['status'];
	$_SESSION['sellect']['Suid'] = $_POST['subject'];
	$_SESSION['sellect']['Tid'] = $_POST['teacher'];	
	$_SESSION['sellect']['semester'] = $_POST['semester'];
?>
</body>
</html>
