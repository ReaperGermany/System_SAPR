<?php 
    session_start();
    error_reporting(0);
?>
<!DOCTYPE html>
<html lang="en">
<head>

  <title>KursTeacher | StudentHome</title>
  <?php include('style.php'); ?>

</head>
<body>
  <?php
 
  $connection = mysql_connect("localhost", "root", "");
  $db = mysql_select_db("KursDB", $connection);
  mysql_set_charset('utf8');

  $userID = $_SESSION['userID'];
  $Gid = $_SESSION['Gid']; 


  $queryM = mysql_query("select * from Smessages inner join teachers on Smessages.Tid = teachers.Tid and Sid = '$userID' and MsgStatus = 1 order by Date Desc", $connection);
  $masMessage = array();
  $MsgID = $_GET['MsgID'];
  while($tMess=mysql_fetch_array($queryM)) { 
        //получение ФИО преподавателя для сообшения
      $masMessage[]=$tMess;
      if($tMess['MsgID'] == $MsgID)
        {
            $tMess2=$tMess;
        }
    }
  ?> 
  <div class="navbar navbar-fixed-top bs-docs-nav" role="banner">
    
      <div class="conjtainer">
        <!-- Menu button for smallar screens -->
        <div class="navbar-header">
          <button class="navbar-toggle btn-navbar" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse">
          <span>Menu</span>
          </button>
          <!-- Site name for smallar screens -->
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
                <li><a href="writemail.php"><i class="fa fa-pencil"></i> Написать</a></li>
                <li><a href="inboxmail.php"><i class="fa fa-envelope"></i> Входящие</a></li>
                <li class="open"><a href="postmail.php"><i class="fa fa-envelope-o"></i> Исходящие</a></li>
            </ul>
        </div>
        <div class="mainbar">
          <div class="page-head">
              <h2 class="pull-left"><i class="fa fa-envelope"></i> Исходящие</h2>
              <div class="clearfix"></div>
          </div>
          <div class="matter">
            <div class="container">
                <?php
                  if ($masMessage==NULL) { ?>
                        <p align="center"><em>Сообщений нет</em></p>
                 <?php }
                  else  
                      { 
                ?>
                      <div class="row profile">
                        <div class="col-md-3">
                          <div class="profile-sidebar">
                            <div class="profile-usermenu">
                                <ul class="nav">
                                  <?php 
                                      foreach ($masMessage as $tMess) {
                                  ?>
                                    <li>
                                      <a href="postmail.php?MsgID=<?=$tMess['MsgID']?>" ><?= $tMess['FIO'] ?><br><span class="label label-success"><?= $tMess['Date'] ?></span></a>
                                    </li>
                                  <?php } ?>
                                </ul>
                            </div>
                          </div>
                        </div>
                        <?php 
                          if (isset($_GET['MsgID'])) { ?>
                            <div class="col-md-8">
                                <div class="panel panel-default">
                                      <form action="deleteMess.php" method="POST">
                                        <div class="panel-heading"><h3 class="panel-title"><b>Получатель: <?=$tMess2['FIO'] ?> - <?=$tMess2['Date'] ?></b></h3></div>
                                        <div class="panel-body" style="owerflow:auto">
                                          <p align="justify" style="maxlength:10000"><em><?=$tMess2['TextM'] ?></em></p>
                                          <input type="text" name = 'MsgID' value=<?=$tMess2['MsgID']?> hidden>
                                          <br>      
                                        </div>
                                        <div class="panel-footer">
                                            <button type="submit" class="btn btn-success btn-sm"  name="del">Удалить</button>
                                        </div>
                                      </form>                     
                                </div>
                            </div>
                <?php } }?>
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