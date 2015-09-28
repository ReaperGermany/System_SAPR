<?php
  session_start(); // запуск сессии

  if (isset($_POST['TopicID']) and $_POST['TopicID'] != 0) { //если выбрана тема на прошлом шаге
    //подключение к БД
    $connection = mysql_connect("localhost", "root", "");
    $db = mysql_select_db("KursDB", $connection);
    mysql_set_charset(utf8);

    //получение переменных
    $userID = $_SESSION['userID'];
    $TopicID = $_POST['TopicID'];
    $Tid = $_POST['Tid'];
    $Suid = $_POST['Suid'];
    //занимаем тему (заносим ID текущего студента(пользователя) в теблицу тем)
      $query = mysql_query("update themes SET Sid = '$userID' where TopicID = '$TopicID'", $connection);
      //получаем название выбраной темы для записи его в теблицу с курсовыми
      $query = mysql_query("select * from themes where TopicID = '$TopicID'", $connection);
    $tT = mysql_fetch_array($query);
    $Topic = $tT[theme];
    mysql_free_result($query);
    //записываем в тfблицу с курсовыми название темы
      $query = mysql_query("insert INTO works (Suid, Topic, Tid, Sid, Stid) VALUES ('$Suid','$Topic','$Tid','$userID',0)", $connection);
      header('location: sthome.php');
  mysql_close($connection); // закрываем соединение с БД 
  }
  else
    {
      header('location: getworks_step2.php');
    }
 ?>
