<?php
  session_start(); // запускаем сессию
  error_reporting(0);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
      <title>KursTeacher | Materials</title>
      <?php 
        include('style.php');
      ?>
  </head>

  <body>
  <?php 
    //подключение к БД
    $connection = mysql_connect("localhost", "root", "");
    $db = mysql_select_db("KursDB", $connection);
    $userID = $_SESSION['userID'];
    mysql_set_charset( 'utf8' );
    
    //получение списка преподавателей для списка
    $Gid = $_SESSION['Gid'];
    $query = mysql_query("select * from groupReference inner join teachers on groupReference.Tid = teachers.Tid AND groupReference.Gid = '$Gid.'", $connection);
    //создание массива преподавателей 
    $masTeachers = array();
    while($tTeacher=mysql_fetch_array($query)) { 
        $masTeachers[]=$tTeacher;
      }  
      mysql_free_result($query);
      //создание списка преподавателей для выбора
  ?>
  <div class="navbar navbar-fixed-top bs-docs-nav" role="banner">
    
      <div class="conjtainer">
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
            <li class="open"><a href="material_step1.php"><i class="fa fa-book"></i> Материалы</a></li>
        </ul>
    </div>
    <div class="mainbar">
      <div class="page-head">
          <h2 class="pull-left"><i class="fa fa-book"></i> Материалы</h2>
          <div class="clearfix"></div>
      </div>
      <div class="matter">
        <div class="container">
            <div class="panel panel-dafeault">
                <div class="panel-heading"><p align="center">ПОЖАЛУЙСТА ВЫБЕРИТЕ ПРЕПОДАВАТЕЛЯ</p></div>
                <div class="panel-body">
                  <div class="row">
                    <div class="col-md-12">
                        <?php
                            foreach ($masTeachers as $tTeacher)
                              {
                          ?>
                            <div class="col-md-4">
                                <form class="thumbnail clearfix" method="POST" action="material_step2.php">
                                    <img src="img/TImg/<?= $tTeacher['Tid'] ?>.jpg" alt="ALT NAME" class="pull-left clearfix" width = '100px' style='margin-right:10px' img=responsive>
                                    <div class="caption" class="pull-left">  
                                        <p><i class="fa fa-user"> </i> <?= $tTeacher['FIO'] ?></p>
                                        <input type="text" name = 'Tid' hidden value=<?= $tTeacher['Tid'] ?>>
                                    </div>
                                    <button type = "submit" name = 'step1' class="btn btn-primary icon  pull-right"> Выбрать </button>
                                  </form>
                              </div>
                           <?php } ?>
                        </div>
                    </div>
                  </div>
                </div>
              </div>
           </div>
        </div>
      </div>
      <div class="clearfix"></div>
  </div>
</div>
<!-- Content ends -->

<!-- Footer starts -->
<footer>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
            <!-- Copyright info -->
            <p class="copy">Copyright &copy; 2015 | <a href="#">Надежда Ельникова</a> </p>
      </div>
    </div>
  </div>
</footer>   

<!-- Footer ends -->

<!-- Scroll to top -->
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
<script src="js/charts.js"></script> <!-- Charts & Graphs -->

</body>
</html>