<?php     
      session_start(); //запускаем сессию
      error_reporting(0);
      include('../modules/upload.php');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>KursTeacher | TeacherHome</title>
        <?php include('style.php'); ?>         
    </head>
    <body>
    	<?php 

            $connection = mysql_connect("localhost", "root", "");
            $db = mysql_select_db("KursDB", $connection);
            mysql_set_charset( 'utf8' );
            $userID = $_SESSION['userID'];

            $query = mysql_query("select * from teachers where Tid = '$userID'", $connection);
			
			$teacher = mysql_fetch_array($query);
			
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
		          <li class="open"><a href="teacher.php"><i class="fa fa-user"></i> Профиль</a></li>
		          <li><a href="subject.php"><i class="fa fa-tasks"></i>Выбор предметов</a></li>
		          <li><a href="groups.php"><i class="fa fa-users"></i> Выбор групп</a></li>
		          <li><a href="work.php"><i class="fa fa-list"></i> Назначения работ</a></li>
		          <li><a href="note.php"><i class="fa fa-tag"></i> Управление работами</a></li>
		          <li><a href="materials.php"><i class="fa fa-book"></i> Материалы</a></li>
		          <li><a href="postmail_t.php"><i class="fa fa-envelope"></i> Почта</a></li>
		          <li><a href="../modules/logout.php"><i class="fa fa-sign-out"></i> Выход</a></li>
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
                                                <img src ="../img/TImg/<?php echo $_SESSION['userID'] ?>.jpg" class="img-responsive" alt="">
                                            </div>
                                            <div class="profile-usertitle">
                                                <div class="profile-usertitle-name">
                                                    <?= $teacher['FIO']; ?>
                                                </div>
                                                <div class="profile-usertitle-job">
                                                    <?= $teacher['office']; ?>
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
												                    <h1><p align="center">Изменение фотографии</p></h1>
												                </div>
												                <div class="modal-body">
												                	<div class="span5">
												                		<p align="center"><input type="file" name="imgToAdd"></p>
												                	</div>
												                </div>
												                <div class="modal-footer">
												                    <button type="button" class="btn btn-warning pull-right" name = "imgAdd" data-dismiss="modal">Закрыть</button>
												                    <button type="submit" name="imgAdd" class="btn btn-success pull-right" style="margin-right:5px"> Сохранить </button>
												                </div>
												            </div><!-- /.modal-content -->
												        </form>
											        </div>
										    	</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                           	<?php 
	                           	$tid=$_SESSION['userID'];
								$query = mysql_query("Select Suid, Name FROM subject WHERE Suid in(SELECT Suid FROM subjectReference WHERE Tid = $tid)", $connection);
								$res_array = array();
							
								$count = 0;
								
								while($row = mysql_fetch_array($query))
								{
									$res_array[$count] = $row;
									$count++;
								}
                            ?>
                            <div class="col-md-3">
								<div class="table-responsive" style="background-color:#fff">
      								<table id="mytable" class="table table-bordred table-striped">
      									<thead> <p align="center"><b>МОИ ПРЕДМЕТЫ</b></p></thead>
									    <?php 
											foreach($res_array as $subject)
											{
									    ?>
									    <tbody>
										    <tr>
										    	<form action="del_index_post.php" method="POST">
												    <td><?= $subject['Name'];?></td>
												    <td><input type="text" name="Suid" hidden value=<?= $subject['Suid']?>></td>
												    <td><p align="right"><button class="btn btn-danger btn-xs" type="submit"><span class="fa fa-trash-o"></span></button></p></td>
												</form>
										    </tr>
									    </tbody>
									    <?
									    	}
									    ?>
									</table>
								</div>
                            </div>
                            <?php 
	                           	$tid=$_SESSION['userID'];
								$query = mysql_query("Select Gid, Name FROM groups WHERE Gid in (SELECT Gid FROM groupReference WHERE Tid=$tid)", $connection);
								$res_array = array();
							
								$count = 0;
								
								while($row = mysql_fetch_array($query))
								{
									$res_array[$count] = $row;
									$count++;
								}
							?>
                            <div class="col-md-3">
								<div class="table-responsive" style="background-color:#fff">
      								<table id="mytable" class="table table-bordred table-striped">
      									<thead> <p align="center"><b>МОИ ГРУППЫ</b></p></thead>
									    <?php 
									    	foreach ($res_array as $row) {
									    		
									    ?>	
									    <tbody>
										    <tr>
										    	<form action="del_index_post.php" method="POST">
												    <td><?= $row['Name'];?></td>
												    <td><input type="text" name="Gid" hidden value=<?= $row['Gid']?>></td>
												    <td><p align="right"><button class="btn btn-danger btn-xs" type="submit"><span class="fa fa-trash-o"></span></button></p></td>
												</form>
										    </tr>
									    </tbody>
									    <?
									    	}
									    ?>
									</table>
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
		<script src="js/charts.js"></script> <!-- Charts & Graphs -->

	</body>
</html>