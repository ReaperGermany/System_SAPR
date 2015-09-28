<?php     
      session_start(); //запускаем сессию
      error_reporting(0);
      include('modules/upload.php');
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
            mysql_set_charset( 'utf8' );
            $userID = $_SESSION['userID'];
  
            $query = mysql_query("select * from students where Sid = '$userID'", $connection);
            $rows = mysql_num_rows($query);
           
            if ($rows != 1) //Выбор по ID
                {
                    $error = "Что-то пошло не так (#нет данных о студенте)";
                    echo($error);
                    die;
               }

            $tempS=mysql_fetch_array($query);
            mysql_free_result($query);
                  
            
            $Gid = $tempS['Gid']; //Название группы по ID группы
            $_SESSION['Gid'] = $Gid; 
            $query = mysql_query("select * from groups where Gid = '$Gid'", $connection);
            $rows = mysql_num_rows($query);
            if ($rows != 1) //Выбор по id, значит должна быть ОДНА запись
               {
                    $error = "Что-то пошло не так (#нет данных о группе)";
                    echo($error);
               }
            $tempG=mysql_fetch_array($query);
            mysql_free_result($query);
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
                  <li class="open"><a href="index.php"><i class="fa fa-user"></i> Профиль</a></li>
                  <li><a href="getworks_step1.php"><i class="fa fa-tasks"></i> Курсовые работы</a></li>
                  <li><a href="material_step1.php"><i class="fa fa-book"></i> Материалы</a></li>
                  <li><a href="#"><i class="fa fa-users"></i> Общий рейтинг</a></li>
                  <li><a href="inboxmail.php"><i class="fa fa-envelope"></i> Почта</a></li>
                  <li><a href="modules/logout.php"><i class="fa fa-sign-out"></i> Выход</a></li>
                </ul>
            </div>

            <div class="mainbar">
                <div class="page-head">
                    <h2 class="pull-left"><i class="fa fa-user"></i> Профиль</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="matter">
                    <div class="container">
                        <div class="row profile">
                            <div class="col-md-3">
                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        <div class="profile-sidebar">
                                            <div class="profile-userpic">
                                                <img src ="img/stImg/<?= $_SESSION['userID'] ?>.jpg" class="img-responsive" alt="">
                                            </div>
                                            <div class="profile-usertitle">
                                                <div class="profile-usertitle-name">
                                                    <?= $tempS['FIO'] ?>
                                                </div>
                                                <div class="profile-usertitle-job">
                                                    <?= $tempS['Kurs'] ?> Курс </br>
                                                    <?= $tempG['Name'] ?>
                                                </div>
                                            </div>
                                        </div>
                                      </div>
                                      <div class="panel-footer">
                                          <div class="container">
                                            <div class="col-md-12">
                                                <a class="btn btn-success btn-sm" href="#myModal" data-toggle="modal"><i class="fa fa-picture-o"></i> Изменить фотографию</a>
                                                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
												        <div class="modal-dialog">
												        	<form enctype="multipart/form-data" action="" method="POST">
													            <div class="modal-content">
													                <div class="modal-header modal-header-success">
													                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
													                    <h1><p align="center">Добавление фотографии</p></h1>
													                </div>
													                <div class="modal-body">
													                	<div class="span5">
													                		<p align="center"><input type="file" name="imgToAdd"></p>
													                	</div>
													                </div>
													                <div class="modal-footer">
													                    <button type="button" class="btn btn-warning pull-right" data-dismiss="modal">Закрыть</button>
													                    <button type="submit" name = "imgAdd" class="btn btn-success pull-right" style="margin-right:5px"> Сохранить </button>
													                </div>
													            </div><!-- /.modal-content -->
													        </form>
												        </div><!-- /.modal-dialog -->
											        
										    	</div>
                                            </div>
                                          </div>
                                      </div>
                                    </div>
                                  </div>

                                <div class="col-md-9">
                                    <div class="container">
                                        <div class="row">
                                            <div class="panel panel-success">
                                                <div class="panel-heading">
                                                    <h3 class="panel-title">МОИ КУРСОВЫЕ РАБОТЫ</h3>
                                                    <div class="pull-right">
                                                        <span class="clickable filter" data-toggle="tooltip" title="Toggle table filter" data-container="body">
                                                            <i class="glyphicon glyphicon-filter"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="panel-body">
                                                    <div class="form-inline">
                                                    <?php //реализация селект формы для работ
  
                                                    //запрос для создания селектора по преподавателю
                                                    $query = mysql_query("select * from groupReference where Gid = '$Gid'", $connection);
                                                    $masTeachers = array();
                                                    while($tTeacher=mysql_fetch_array($query)) { 
                                                    $masTeachers[]=$tTeacher;}  
                                                    mysql_free_result($query);

                                                    //запрос для создания селектора по статусу
                                                    $query = mysql_query("select * from statusList", $connection);
                                                    $masStatus = array();
                                                    while($tStatus=mysql_fetch_array($query)) { 
                                                    $masStatus[]=$tStatus;} 
                                                    mysql_free_result($query);

                                                    //запрос для создания селектора по предмету
                                                    
                                                    $query = mysql_query("select * FROM gsureference inner join subject on gsureference.Suid = subject.Suid AND Gid = '$Gid'", $connection);
                                                    $masSubject = array();
                                                    while($tSubject=mysql_fetch_array($query)) 
                                                      { 
                                                        $masSubject[]=$tSubject;
                                                      }
                                                    mysql_free_result($query);
                                                    //вывод формы фильтров курсовых
                                            ?>
                                                    <form method='POST' action="selectWorks.php">
                                                        <select name="teacher" class="form-control">
                                                            <option value=0>None</option>
                                                                <?php //создание селектора по преподавателю
                                                                foreach ($masTeachers as $tTeacher) {
                                                                    //получение ФИО текущего преподавателя
                                                                    $Tid = $tTeacher['Tid']; 
                                                                    $query = mysql_query("select * from teachers where Tid = '$Tid'", $connection);
                                                                        //проверка данных запроса
                                                                        $rows = mysql_num_rows($query);
                                                                        if ($rows != 1) //выбор по id, значит должна быть ОДНА запись
                                                                                {
                                                                                        $error = "Что-то пошло не так (#нет данных о преподе)";
                                                                                        echo($error);
                                                                                }
                                                                        $tempT=mysql_fetch_array($query);
                                                                        mysql_free_result($query);
                                                                        //вывод текущего преподавателя в список селектора (фильтра) 
                                                                        if ($tempT['Tid'] == $_SESSION['sellect']['Tid']) { ?>
                                                                                <option value=<?php echo $tempT['Tid'] ?> selected > <?php echo $tempT['FIO'] ?> </option>
                                                                                <?php
                                                                                } 
                                                                                else {
                                                                                ?>
                                                                                        <option value=<?php echo $tempT['Tid'] ?> > <?php echo $tempT['FIO'] ?> </option>
                                                                <?php
                                                                                }
                                                                }       
                                                                ?> 
                                                        </select>  
                                                        <select name="status" class="form-control">
                                                            <?php //создание селектора по статусу
                                                                foreach ($masStatus as $tStatus) {
                                                                        if ($tStatus['Stid'] == $_SESSION['sellect']['Stid']) { ?> 
                                                                        <option value=<?php echo $tStatus['Stid'] ?> selected > <?php echo $tStatus['Status'] ?> </option>
                                                                                <?php 
                                                                                } 
                                                                                else {
                                                                                ?> 
                                                                                <option value=<?php echo $tStatus['Stid'] ?> > <?php echo $tStatus['Status'] ?> </option>
                                                                <?php 
                                                                                }  
                                                                }   
                                                                ?>              
                                                        </select> 
                                                        <select name="subject" class="form-control">
                                                                <option value=0>None</option>
                                                                <?php //создание селектора по предмету
                                                                  foreach ($masSubject as $tSubject) {
                                                                    if ($tSubject['Suid'] == $_SESSION['sellect']['Suid']) {
                                                                ?> 
                                                                  <option value=<?php echo $tSubject['Suid'] ?> selected > <?php echo $tSubject['Name'] ?> </option>
                                                                <?php 
                                                                  } 
                                                                    else {
                                                                ?> 
                                                                  <option value=<?php echo $tSubject['Suid'] ?> > <?php echo $tSubject['Name'] ?> </option>
                                                                <?php 
                                                                                }  
                                                                }   
                                                                ?>  
                                                        </select>
                                                       	<select name="semester" class="form-control">
                                                        	<?php 
                                                        		for ($i=1; $i<=8 ; $i++) { ?>
                                                        			<option value=<?php echo $i ?> <?php if ($i == $_SESSION['sellect']['semester']) {
                                                        				echo "selected";
                                                        			} ?> ><?php echo $i ?></option>
                                                        	<?php } ?>
                                                         	?>
                                                        </select>
                                                        <button type='submit' class="btn btn-primary" name='selectWorks'>Показать</button>
                                                </form>
                                                    </div>
                                                </div>
                                                <table class="table table-hover" id="task-table">
                                                    <thead>
                                                        <tr>
                                                            <th>Тема</th>
                                                            <th>Предмет</th>
                                                            <th>Преподаватель</th>
                                                            <th>Семестр</th>
                                                            <th>Сдать до</th>
                                                            <th>Статус</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php
                                                      //получение данных по фильтру
                                                      $masWorks = array();
                                                      $sellectSuid = $_SESSION['sellect']['Suid'];
                                                      $sellectTid = $_SESSION['sellect']['Tid'];
                                                      $sellectStid = $_SESSION['sellect']['Stid'];
                                                      $semester = $_SESSION['sellect']['semester'];
                                                      //выполнение запроса с учетом фильтров (получаем набор курсовых, удовлетворяющих всем условиям)
                                                      $strQuery = "select * from works AS w INNER JOIN subject AS su ON su.Suid = w.Suid and w.Sid = '$userID'";
                                                      if($sellectSuid != 0){
                                                        $strQuery .= " and w.Suid = '$sellectSuid'";
                                                      }
                                                      if($semester){
                                                        $strQuery .= " and w.semester = '$semester'";
                                                      }
                                                      $strQuery .= " INNER JOIN teachers AS t ON t.Tid = w.Tid";
                                                      if($sellectTid != 0){
                                                        $strQuery .= " and w.Tid = '$sellectTid'";
                                                      }
                                                      $strQuery .= " INNER JOIN statusList AS st ON st.Stid = w.Stid";
                                                      if($sellectStid != 0){
                                                        $strQuery .= " and w.Stid = '$sellectStid'";
                                                      }

                                                      $query = mysql_query($strQuery, $connection);
                                                      while($tWork=mysql_fetch_array($query)) { 
                                                              $masWorks[]=$tWork;}  
                                                        mysql_free_result($query);
  
                                                      foreach ($masWorks as $tWork) {  
                                                    ?>
                                                          <tr>
                                                              <td><?=$tWork['Topic'] ?></td>
                                                              <td><?=$tWork['Name'] ?></td>
                                                              <td><?=$tWork['FIO'] ?></td>
                                                              <td align="center"><?=$tWork['semester'] ?></td>
                                                              <td><?=$tWork['date_s'] ?></td>
                                                              <td><?=$tWork['Status'] ?></td>
                                                        </tr>
                                                    <?php 
                                                      }
                                                    ?>
                                                    </tbody>
                                                </table>
                                            </div>
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
        <span class="totop"><a href="#"><i class="fa fa-chevron-up"></i></a></span> 
        
        <!-- JS -->
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