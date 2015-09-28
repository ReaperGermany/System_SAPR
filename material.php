  <?php 
      session_start();
      error_reporting(0);
  ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>KursTeacher | GetWorks</title>
  <?php 
    include('style.php');
  ?>

</head>

<body>
  <?php 
    if (isset($_POST['Tid'])) {
  ?>
  <?php 
    //подключение к БД
    $connection = mysql_connect("localhost", "root", "");
    $db = mysql_select_db("KursDB", $connection);
    mysql_set_charset( 'utf8' );

    //получаем переменные из сессии и POST массива
    $userID = $_SESSION['userID'];
    $Gid = $_SESSION['Gid'];
    $Tid = $_POST['Tid'];
    //получение предметов (массив) для текущего преподавателя и учебной группы
      $query = mysql_query("select su.Name, sR.Suid from subjectReference AS sR INNER JOIN
        groupReference AS gR ON sR.Tid = gR.Tid and gR.Gid = '$Gid' and gR.Tid = '$Tid' 
      INNER JOIN gSuReference AS gSuR
      ON gSuR.Suid = sR.Suid and gSuR.Gid = gR.Gid 
      INNER JOIN subject AS su ON su.Suid = sR.Suid", $connection);
    $masS = array();
    while($tS=mysql_fetch_array($query)) { 
        $masS[]=$tS;} 
      mysql_free_result($query);
      //создание селектора по предмету (вывод)
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
                  	<li class="open"><a href="getworks_step1.php"><i class="fa fa-tasks"></i> Курсовые работы</a></li>
                </ul>
            </div>
          	<div class="mainbar">
        	    <div class="page-head">
        	      	<h2 class="pull-left"><i class="fa fa-tasks"></i> Выбрать курсовую работу</h2>
                	<div class="clearfix"></div>
        	    </div>
        	    <div class="matter">
                <div class="container">
                  <div class="col-md-4 ">
                    <div class="panel panel-dafeault">
                        <div class="panel-heading"><p align="center">ПОЖАЛУЙСТА ВЫБЕРИТЕ ПРЕДМЕТ</p></div>
                        <div class="panel-body">
                        <?php //создание списка предметов
                                  foreach ($masS as $tS) 
                                    {
                            ?> 
                              <form class="thumbnail clearfix" method="POST" action="getworks_step2.php">
                                  <div class="col-md-8" style="margin-top:3%">
                                      <p align="left"><?= $tS['Name'] ?></p>
                                      <input type="text" name = 'Suid' value=<?=$tS['Suid'] ?> hidden>
                                      <input type="text" name = 'Tid' value=<?=$Tid ?> hidden>
                                  </div>
                                  <button type = "submit" name = 'step2' class="btn btn-primary pull-right"> Выбрать <i class="fa fa-caret-right"></i></button>
                              </form>
                        <?php } ?>
                      </div>
                    </div>
                  </div>
                  <div  class="col-md-8">
                  <?php
                      if (isset($_POST['Suid'])) 
                      {
                        $Suid = $_POST['Suid'];
                        $query = mysql_query("select * from themes where Tid = '$Tid' and Sid = '$userID' and Suid = '$Suid'", $connection);
                           
                        $tTh = mysql_fetch_array($query);
                        mysql_free_result($query);

                        if($tTh == NULL)
                        { 
                          $query = mysql_query("select * from themes where Tid = '$Tid' and Suid = '$Suid' and Sid is NULL", $connection);
                          $masTh = array();
                            while($tTh = mysql_fetch_array($query)) 
                            {
                                $masTh[] = $tTh;
                            }
                            if ($masTh == NULL) 
                              {
                  ?>  
                  <div class="alert alert-warning" role="alert"> Нет списка тем по данному предмету</div> 
                  <?php 
                              }
                            else
                              { ?>
                                <div class="panel panel-dafeault">
                                  <div class="panel-heading"><p align="center">ПОЖАЛУЙСТА ВЫБЕРИТЕ ТЕМУ КУРСОВОЙ РАБОТЫ</p></div>
                                  <div class="panel-body">
                                    <table class="table table-striped custab">
                                      <thead>
                                          <tr>
                                              <th>Тема курсовой работы</th>
                                              <th class="text-center">Действие</th>
                                          </tr>
                                      </thead>
                                        <tr>
                                          <?php 
                                              foreach ($masTh as $tTh) {
                                          ?>
                                          <form action="getworks_step3.php" method="POST">
                                              <td><?= $tTh['theme'] ?></td>
                                              <input type="text" name="Suid" value=<?= $Suid ?> hidden>
                                              <input type="text" name="Tid" value=<?= $Tid ?> hidden>
                                              <input type="text" name="TopicID" value=<?= $tTh['TopicID']?> hidden>
                                              <td class="text-center"><button class='btn btn-success btn-xs' name="tTH" type="submit" ><span class="fa fa-check"></span> Принять</button></td>
                                          </form>
                                        </tr>
                                        <?php } ?>
                                    </table>
                                  </div>
                                </div>
                            <?php  
                              } 
                            ?>
                    </div>
                        <?php 
                        } 

                        else 
                        {
                        ?>
                           <div class="alert alert-warning" role="alert" >Вы уже выбрали тему курсовой работы по данному предмету</div> 
                        <?php 

                        }?>
                
                    <?php  
                    } ?>

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
<script src="js/charts.js"></script> <!-- Charts & Graphs -->
  <?php } ?>
</body>
</html>
