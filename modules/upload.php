<?php
//Скрипт загрузки фото профиля
  session_start();
  include('resize_crop.php');
  if(isset($_POST['imgAdd']))
  {
  //Если файл загружен на сервер
    if(is_uploaded_file($_FILES["imgToAdd"]["tmp_name"]))
    {
      //Выводим сообщение о том, что файл загружен во временную папку
      //Если пользователь - студент(роль=0), то загружаем в папку stImg, иначе - в tchImg
      if($_SESSION['role']==0){
        $target = "img/stImg/".$_SESSION['userID'].".jpg";
      }
      else{
        $target = "../img/TImg/".$_SESSION['userID'].".jpg";
      }
      // Было изображение до этого? Удаляем
      if (file_exists($target)) {
        unlink($target); // Удаление
      } 
      //Перемещаем загруженный пользователем файл из временной папки в папку с изображениями пользователей этой группы(студент/преподаватель)
      
      $res = resize($_FILES["imgToAdd"]["tmp_name"], $target, 300, 300, false);
      
      move_uploaded_file($_FILES["imgToAdd"]["tmp_name"], $target);
      //Выводим, куда и какой по названю файл был перемещен. ile uploaded to tmp. ../img/stImg/1.jpg
    }
  }
?>