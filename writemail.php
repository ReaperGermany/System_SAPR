<?php 
    session_start();
    error_reporting(0);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    
    <title>KursTeacher | WriteMessage</title>
    <?php 
      include('style.php')
    ?>

  </head>
  <body>
    <?php
        //подключение к БД
        $connection = mysql_connect("localhost", "root", "");
        $db = mysql_select_db("KursDB", $connection);
        mysql_set_charset('utf8');

        $userID = $_SESSION['userID'];
        //получение списка преподавателей
        $Gid = $_SESSION['Gid']; //тут id группы уже есть 
        //получение массива с преподавателями
          $query = mysql_query("select * from groupReference inner join teachers on groupReference.Tid = teachers.Tid and Gid = '$Gid'", $connection);
        $masTeachers = array();
        while($tTeacher=mysql_fetch_array($query)) { 
            $masTeachers[] = $tTeacher;}  
          mysql_free_result($query);
          //создание списка преподавателей для выбора во всплывающем окне
    ?>
    <div class="navbar navbar-fixed-top bs-docs-nav" role="banner">
        <div class="conjtainer">
          <!-- Menu button for smallar screens -->
          <div class="navbar-header">
            <button class="navbar-toggle btn-navbar" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse">
            <span>Menu</span>
            </button>
            <a href="index.html" class="navbar-brand hidden-lg">MacBeth</a>
          </div>   
        </div>
    </div>

    <header>
        <div class="container">
          <div class="row">
            <div class="col-md-4">
                <div class="logo">
                    <h1><a href="#">Kurs<span class="bold">Teacher</span></a></h1>
                    <p class="meta">Автоматизированная система контроля</p>
                </div>
            </div>   
          </div>
        </div>
    </header>
    <div class="content">
        <div class="sidebar">
            <div class="sidebar-dropdown"><a href="#">Navigation</a></div>
            <ul id="nav">
                <li><a href="sthome.php"><i class="fa fa-user"></i> Профиль</a></li>
                <li class="open"><a href="writemail.php"><i class="fa fa-pencil"></i> Написать</a></li>
                <li><a href="inboxmail.php"><i class="fa fa-envelope"></i> Входящие</a></li>
                <li><a href="postmail.php"><i class="fa fa-envelope-o"></i> Исходящие</a></li>
            </ul>
        </div>
        <div class="mainbar">
          <div class="page-head">
              <h2 class="pull-left"><i class="fa fa-pencil"></i> Написать сообщение</h2>
              <div class="clearfix"></div>
          </div>
          <div class="matter">
            <div class="container">
              <div class="row">
                  <div class="col-md-6 col-md-offset-3">
                    <div class="well well-sm">
                      <form class="form-horizontal" action="sendMess_s.php" method="POST">
                
                        <div class="form-group">
                          <label class="col-md-3 control-label" for="theme">Тема сообщения</label>
                          <div class="col-md-9">
                            <input name="theme" type="text" placeholder="" class="form-control">
                          </div>
                        </div>
                
                        <div class="form-group">
                          <label class="col-md-3 control-label" for="teacher"> Преподаватель</label>
                          <div class="col-md-9">
                            <select name="teacher" class="form-control">
                            <?php foreach ($masTeachers as $tTeacher) {

                            ?>
                                <option value=<?= $tTeacher['Tid'] ?>> <?= $tTeacher['FIO'] ?></option>
                            <?php } ?>
                            </select>
                          </div>
                        </div>
                
                        <!-- Message body -->
                        <div class="form-group">
                          <label class="col-md-3 control-label" for="message">Ваше сообщение</label>
                          <div class="col-md-9">
                            <textarea class="form-control" id="message" name="text" rows="5"></textarea>
                          </div>
                        </div>
                
                        <!-- Form actions -->
                        <div class="form-group">
                          <div class="col-md-12 text-right">
                            <button type="submit" class="btn btn-primary btn-sm">Отправить</button>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
              </div>
            </div>
          </div>
          <div class="clearfix"></div>
        </div>
    </div>
    <footer>
      <div class="container">
        <div class="row">
          <div class="col-md-12">
                <p class="copy">Copyright &copy; 2015 | <a href="#">Надежда Ельникова</a> </p>
          </div>
        </div>
      </div>
    </footer>   


  <span class="totop"><a href="#"><i class="fa fa-chevron-up"></i></a></span> 

<!-- JS -->
<script src="js/jquery.js"></script> <!-- jQuery -->
<script src="js/bootstrap.min.js"></script> <!-- Bootstrap -->
<script src="js/jquery-ui.min.js"></script> <!-- jQuery UI -->
<script src="js/fullcalendar.min.js"></script> <!-- Full Google Calendar - Calendar -->
<script src="js/jquery.rateit.min.js"></script> <!-- RateIt - Star rating -->
<script src="js/jquery.prettyPhoto.js"></script> <!-- prettyPhoto -->
<script src="js/jquery.slimscroll.min.js"></script> <!-- jQuery Slim Scroll -->
<script src="js/jquery.dataTables.min.js"></script> <!-- Data tables -->

<!-- jQuery Flot -->
<script src="js/excanvas.min.js"></script>
<script src="js/jquery.flot.js"></script>
<script src="js/jquery.flot.resize.js"></script>
<script src="js/jquery.flot.pie.js"></script>
<script src="js/jquery.flot.stack.js"></script>

<script src="js/sparklines.js"></script> <!-- Sparklines -->
<script src="js/jquery.cleditor.min.js"></script> <!-- CLEditor -->
<script src="js/bootstrap-datetimepicker.min.js"></script> <!-- Date picker -->
<script src="js/jquery.onoff.min.js"></script> <!-- Bootstrap Toggle -->
<script src="js/filter.js"></script> <!-- Filter for support page -->
<script src="js/custom.js"></script> <!-- Custom codes -->

</body>
</html>