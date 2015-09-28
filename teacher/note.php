<?php
	session_start(); 

	$connection = mysql_connect("localhost", "root", "");
    $db = mysql_select_db("KursDB", $connection);

	if(isset($_POST['createWorks'])) { //add theme
		
		$Tid = $_SESSION['userID']; 
		$Suid = $_POST['Suid'];
		$Gid = $_POST['Gid'];
		$Sid = $_POST['Sid'];
		$theme = $_POST['theme'];
		$semester = $_POST['semester'];

		$query = mysql_query("select Wid from works WHERE Suid = '$Suid' and Tid = '$Tid' and Sid = '$Sid'" ,$connection);
			if (mysql_num_rows($query) == 0) {
				$query = mysql_query("INSERT INTO works (Suid, Topic, Tid, Sid, semester) VALUES ('$Suid', '$theme', '$Tid', '$Sid', '$semester')" ,$connection);
			}
				
		$str = 'Location: note.php?Suid='.$Suid.'&Gid='.$Gid;
		header($str);
	}



	$Tid = $_SESSION['userID'];

    $query_1 = mysql_query("Select Suid, Name FROM subject WHERE Suid in(SELECT Suid FROM subjectReference WHERE Tid = $Tid)", $connection);
	$res_array_1 = array();

	$count = 0;
	
	while($row = mysql_fetch_array($query_1))
	{
		$res_array_1[$count] = $row;
		$count++;
	}

	$query = mysql_query("Select Gid, Name FROM groups WHERE Gid in (SELECT Gid FROM groupReference WHERE Tid=$Tid)", $connection);
	$res_array = array();

	$count = 0;
	
	while($row = mysql_fetch_array($query))
	{
		$res_array[$count] = $row;
		$count++;
	}

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">

		<title>KursTeacher | TeacherHome</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="keywords" content="">
		<meta name="author" content="">

		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" href="css/font-awesome.min.css"> 
		<link rel="stylesheet" href="css/jquery-ui.css"> 
		<link rel="stylesheet" href="css/fullcalendar.css">
		<link rel="stylesheet" href="css/prettyPhoto.css">  
		<link rel="stylesheet" href="css/rateit.css">
		<link rel="stylesheet" href="css/bootstrap-datetimepicker.min.css">
		<link rel="stylesheet" href="css/jquery.cleditor.css"> 
		<link rel="stylesheet" href="css/jquery.dataTables.css"> 
		<link rel="stylesheet" href="css/jquery.onoff.css">
		<link href="css/style.css" rel="stylesheet">
		<link href="css/widgets.css" rel="stylesheet">   

		<script src="js/respond.min.js"></script>
		<link rel="shortcut icon" href="img/favicon/favicon.png">

	</head>
	<body>
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
		          <li><a href="teacher.php"><i class="fa fa-user"></i> Профиль</a></li>
		          <li><a href="subject.php"><i class="fa fa-tasks"></i>Выбор предметов</a></li>
		          <li><a href="groups.php"><i class="fa fa-users"></i> Выбор групп</a></li>
		          <li><a href="work.php"><i class="fa fa-list"></i> Назначения работ</a></li>
		          <li class="open"><a href="note.php"><i class="fa fa-tag"></i> Управление работами</a></li>
		          <li><a href="materials.php"><i class="fa fa-book"></i> Материалы</a></li>
		          <li><a href="postmail_t.php"><i class="fa fa-envelope"></i> Почта</a></li>
		          <li><a href="../modules/logout.php"><i class="fa fa-sign-out"></i> Выход</a></li>
		        </ul>
		    </div>
		  	<div class="mainbar">
			    <div class="page-head">
			      	<h2 class="pull-left"><i class="fa fa-tag"></i> Управление работами</h2>
		        	<div class="clearfix"></div>
			    </div>

			    <div class="matter">
			        <div class="container">
			        	<div class="col-md-3">
			        		<div class="panel panel-default">
		                        <div class="panel-heading"><p align="center"> ВЫБЕРИТЕ ГРУППУ И ПРЕДМЕТ</p></div>
		                        <div class="panel-body">
		                            <form class="" method="GET" action="note.php">
			                            <div class="col-md-12">
			                        		<select name="Gid" class=" form-control" style="margin-bottom:5px">
			                        			<?php 
			                        				foreach ($res_array as $row) { ?>
			                        					<option 
			                        						<?php  if ($_GET['Gid']==$row['Gid']) { echo 'selected';} ?>
			                        						value=<?= $row['Gid'] ?>> <?=$row['Name'] ?></option>
			                        			<?php	}
			                        			?>
		                                    </select>
											<select name="Suid" class=" form-control" style="margin-bottom:5px">
	                                            <?php 
			                        				foreach ($res_array_1 as $row) { ?>
			                        					<option <?php  if ($_GET['Suid']==$row['Suid']) { echo 'selected';} ?>
			                        					value=<?= $row['Suid'] ?>> <?=$row['Name'] ?></option>
			                        			<?php	}
			                        			?>
		                                    </select>
		                                    <p align="center"><button type = "submit" class="btn btn-success"> ПОКАЗАТЬ </button></p>
			                        	</div>    
		                            </form>
		                      	</div>
		                    </div>
		                    <div class="panel panel-default">
		                        <div class="panel-heading"><p align="center"> ЭТАПЫ ВЫПОЛНЕНИЯ</p></div>
		                        <div class="panel-body">
		                            <div class="col-md-12">
										<p data-placement="top" data-toggle="tooltip" title="Кодировка" align="center"><button class="btn btn-success" data-title="кодировка" data-toggle="modal" data-target="#status" >ПРОСМОТР</button></p>
		                        	</div>
										          
		                            <div class="modal fade" id="status" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
										<div class="modal-dialog modal-sm">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="fa fa-remove" aria-hidden="true"></span></button>
													<h4 class="modal-title custom_align" id="Heading"><p align="center"> ЭТАПЫ ВЫПОЛНЕНИЯ
												</div>
												<div class="modal-body" style="margin-left:0px">
												<?php  
													$query = mysql_query("select * from statuslist", $connection);
											
													while($row = mysql_fetch_array($query)) {
														$str = $row['Stid'].' '.$row['Status'];
												?>
													<p><?= $str ?></p>
												<?php } ?>
												</div>
												<div class="modal-footer ">
													<button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
												</div>
											</div>
										</div>
									</div>
		                      	</div>
		                    </div>
		                    <?php
		                    	if(isset($_GET['Suid'])) {
		                   	?>
			        	</div>
						<?php 
							// Получаем темы
							$Tid = $_SESSION['userID'];
							$Suid = $_GET['Suid'];

							$query = mysql_query("Select TopicID, theme FROM themes WHERE  Tid = $Tid and Suid = $Suid and Sid is null", $connection);
							$themes = array();

							
							while($row = mysql_fetch_array($query))
							{
								$themes[] = $row;
							}

							// Получаем студентов
							$Gid = $_GET['Gid'];

							$query = mysql_query("Select Sid, FIO FROM students WHERE  Gid = $Gid", $connection);
							$students = array();

							while($row = mysql_fetch_array($query))
							{
								$students[] = $row;
							}

							// Получаем таблицу работ
							$query = mysql_query("Select * FROM works AS w INNER JOIN students AS s 
								ON w.Sid = s.Sid and w.Tid = $Tid and w.Suid = $Suid and s.Gid = $Gid", $connection);
							$works = array();

							while($row = mysql_fetch_array($query))
							{
								$works[] = $row;
							}
						?>
						<?php if ( !isset($_GET['Wid'])) { ?>
			        	<div class="col-md-9">
			        		<div class="panel panel-default">
		                        <div class="panel-heading"><p align="center"> НАЗНАЧИТЬ РАБОТУ</p></div>
		                        <div class="panel-body">
									<div class="col-md-12">
										<form action="note.php" method="POST">
											<div class="col-md-1">
												<input type="text" name = "semester" placeholder = "1" title="Семестр" class="form-control">
											</div>
											<div class="col-md-4">
												<select name="Sid" id="" class="form-control">
													<?php foreach ($students as $row) { ?>
														<option value="<?= $row['Sid'] ?>"><?= $row['FIO'] ?></option>
													<?php } ?>
												</select>
											</div>
											
											<div class="col-md-5">
												<select name="theme" id="" class="form-control">
												<?php foreach ($themes as $row) { ?>
													<option value=<?= $row['theme'] ?>> <?= $row['theme'] ?> </option>
												<?php } ?>
												</select>
											</div>

											<input type="text" name="Suid" hidden value=<?= $_GET['Suid']  ?>>
	                                    	<input type="text" name="Gid" hidden value=<?= $_GET['Gid']    ?>>
											<button type="submit" name = "createWorks" class="btn btn-primary">Назначить</button>
										</form>
									</div>
		                        </div>
		                    </div>
		                    
				        		<div class="table-responsive" style="background-color:#fff; max-height:450px; overflow:auto">
	  								<table id="mytable" class="table table-bordred table-striped">
	  									<thead> <p align="center"><b>ВЕДОМОСТЬ</b></p>
											<th>Студент</th>
											<th>Тема</th>
											<th>Этап</th>
											<th>Cрок</th>
											<th>Защита</th>
											<th>Оценка</th>
	  									</thead>
									    <tbody>
								    	<?php 
								    	foreach ($works as $row) {												   		
								   		?>
										    <tr>
											    <td><?= $row['FIO']  ?></td>
											    <td><?= $row['Topic']  ?></td>
											    <td><?= $row['Stid']  ?></td>
											<?php  if($row['inTime'] == 1){ ?>
											    <td>Да</td>
											<?php } else { ?>
												<td> </td>
											<?php } ?>
											<?php  if($row['defend'] == 1){ ?>
											    <td>Да</td>
											<?php } else { ?>
												<td> </td>
											<?php } ?>
											    <td><?= $row['mark']  ?></td>
										    	
											    <td>
											    	<form action="note.php" method="GET">
											    		<input type="text" name="Gid" hidden	value=<?= $row['Gid']  ?>>
											    		<input type="text" name="Suid" hidden	value=<?= $row['Suid']  ?>>
												    	<input type="text" name="Wid" hidden	value=<?= $row['Wid']  ?>>
												    	<p><button class="btn btn-success btn-xs" value="1" name="edit" type="submit"><span class="fa fa-pencil"></span></button>
												    	<button class="btn btn-info btn-xs" name="view" value="1" type="submit"><span class="fa fa-eye"></span></button></p>
												    </form>
												</td>							    
										    </tr>
									    <?php } ?>
									    </tbody>
									</table>
								</div>
							<?php } ?>

							<?php  if (isset($_GET['edit'])) { ?>
							<?php  
								$query = mysql_query("select * from statuslist", $connection);

								$statuses = array();								
								while($row = mysql_fetch_array($query))
								{
									$statuses[] = $row;
								}

								$Wid = $_GET['Wid'];

								$query = mysql_query("select * from works where Wid = $Wid", $connection);

								$work = mysql_fetch_array($query);
								
							?>
							<div class="col-md-9">
								<div class="panel panel-default">
									<div class="panel-heading">
										<p align="center">ОБНОВЛЕНИЕ ДАННЫХ</p>
									</div>
									<div class="panel-body">
										<div class="col-md-12">
											<form action="updateWork.php" method="POST">
												<div class="table-responsive" style="background-color:#fff; max-height:450px; overflow:auto">
					  								<table id="mytable" class="table table-bordred table-striped">
					  									<thead>
															<th><p align="center">Выбрать этап</p></th>
															<th><p align="center">Сдана в срок</p></th>
															<th><p align="center">Защита</p></th>
															<th><p align="center">Оценка</p></th>

					  									</thead>
													    <tbody>
												    		<tr>
												    			<td>
												    				<select name="Stid" class="form-control">
												    					<?php foreach ($statuses as $row) { ?>
												    						<option value=<?=($row['Stid']); ?> <?php if($row['Stid'] == $work['Stid'] ) echo('selected');  ?> ><?= $row['Status']  ?></option>
												    					<?php } ?>
												    				</select>
												    			</td>
												    			<td><p align="center"><input name="inTime" value="1" type="checkbox"<?php if($work['inTime']) echo('checked="checked"') ?>></p></td>
												    			<td><p align="center"><input name="defend" value="1" type="checkbox" <?php if($work['defend']) echo('checked="checked"') ?>></p></td>
												    			<td><p align="center"><input name="mark" class="form-control" type="text" placeholder="Процент" value=<?= $work['mark'] ?> ></p></td>
												    		</tr>
													    </tbody>
													</table>
												</div> 
												<input type="text" name="Wid" hidden value=<?= $_GET['Wid'] ?>>
												<input type="text" name="Suid" hidden value=<?= $_GET['Suid'] ?>>
												<input type="text" name="Gid" hidden value=<?= $_GET['Gid'] ?>>
												<p align="center"><button type="submit" class="btn btn-primary">Обновить</button></p>
										</form>
										</div>
									</div>
								</div>	
							</div>
		        		</div>
		        	<?php
		               } 
		            ?>
		            <?php  if (isset($_GET['view'])) { 

		            	$Wid = $_GET['Wid'];
						
						$query = mysql_query("select * from statusDate where Wid = $Wid", $connection);
					
						$status = mysql_fetch_array($query);
						
		            	?>

			            <div class="col-md-9">
							<div class="panel panel-default">
								<div class="panel-heading">
									<p align="center">ПРОСМОТР ВЫПОЛНЕНИЯ КУРСОВОЙ РАБОТЫ</p>
								</div>
								<div class="panel-body">
					            	<form action="note.php" method="GET">
					            		<div class="table-responsive" style="background-color:#fff; max-height:450px; overflow:auto">
			  								<table id="mytable" class="table table-bordred table-striped">
			  									<thead>
													<?php for ($i=1; $i<=8; $i++) { ?>
													<th style="width:13%"><?= $i ?></th>
													<?php } ?>
			  									</thead>
											    <tbody>
												    <tr>
													    <td><?= $status['s1'] ?></td>
													    <td><?= $status['s2'] ?></td>
													    <td><?= $status['s3'] ?></td>
													    <td><?= $status['s4'] ?></td>
													    <td><?= $status['s5'] ?></td>
													    <td><?= $status['s6'] ?></td>
													    <td><?= $status['s7'] ?></td>
													    <td><?= $status['s8'] ?></td>
													    <td><?= $status['s9'] ?></td>
												    </tr>
											    </tbody>
											</table>
										</div>
										<input type="text" name="Gid" value=<?= $_GET['Gid'] ?> hidden>
										<input type="text" name="Suid" value=<?= $_GET['Suid'] ?> hidden>
										<p align="center"><button class="btn btn-primary" type="submit">Вернуться</button></p>
					            	</form>
					            </div>
					        </div>
					    </div>
		            <?php } ?>
		            <?php
		               } 
		            ?>

			        </div>
			    </div>
			</div>
			<div class="clearfix"></div>
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
<?php mysql_close($connection); ?>
	</body>
</html>