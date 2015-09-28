<?php 
	session_start();

	$connection = mysql_connect("localhost", "root", "");
	$db = mysql_select_db("KursDB", $connection);

	if(isset($_POST['addTheme'])) { //add theme
		
		$Tid = $_SESSION['userID']; 
		$Suid = $_POST['Suid'];
		$Gid = $_POST['Gid'];
		$theme = $_POST['theme'];
		
		$query = mysql_query("INSERT INTO themes( Tid, Suid, theme) VALUES ('$Tid', '$Suid', '$theme')" ,$connection);
		
		$str = 'Location: work.php?Suid='.$Suid.'&Gid='.$Gid;
		header($str);
	}
	//create connection
	if (isset($_POST['addConnect'])) {
		
		$Tid = $_SESSION['userID']; 
		$Gid = $_POST['Gid'];
		$Suid = $_POST['Suid'];
	
		$query = mysql_query("select * from sugtreference where Gid = '$Gid' and Tid = '$Tid 'and Suid = '$Suid'", $connection); 
		if(mysql_num_rows($query) != 1){
			$query = mysql_query("INSERT INTO sugtreference (Suid, Tid, Gid) VALUES ('$Suid','$Tid','$Gid')", $connection); 
		}
		
		$str = 'Location: work.php?Suid='.$Suid.'&Gid='.$Gid;
		header($str);
	}
	//del_table post
	if (isset($_POST['del_table_post'])) {
		
		$Gid = $_POST['Gid'];
		$Suid = $_POST['Suid'];
		$TopicID = $_POST['TopicID'];
	
		$query = mysql_query("delete from themes WHERE TopicID = '$TopicID'", $connection);

		$str = 'Location: work.php?Suid='.$Suid.'&Gid='.$Gid;
		header($str);
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
		<?php  
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
		          <li class="open"><a href="work.php"><i class="fa fa-list"></i> Назначения работ</a></li>
		          <li><a href="note.php"><i class="fa fa-tag"></i> Управление работами</a></li>
		          <li><a href="materials.php"><i class="fa fa-book"></i> Материалы</a></li>
		          <li><a href="postmail_t.php"><i class="fa fa-envelope"></i> Почта</a></li>
		          <li><a href="../modules/logout.php"><i class="fa fa-sign-out"></i> Выход</a></li>
		        </ul>
		    </div>
		  	<div class="mainbar">
			    <div class="page-head">
			      	<h2 class="pull-left"><i class="fa fa-tasks"></i> Выбор групп</h2>
		        	<div class="clearfix"></div>
			    </div>

			    <div class="matter">
			        <div class="container">
			        	<div class="col-md-3">
			        		<div class="panel panel-default">
		                        <div class="panel-heading"><p align="center"> НАЗНАЧЬТЕ ПРЕДМЕТ ВЫБРАННОЙ ГРУППЕ</p></div>
		                        <div class="panel-body">
		                            <form class="" method="POST" action="work.php">
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
		                                    <p align="center"><button type = "submit"  name ="addConnect" class="btn btn-primary"> Назначить </button></p>
			                        	</div>
										           
		                            </form>
		                      	</div>
		                    </div>
			        	</div>
			        	<?php 
			        		if (isset($_GET['Suid'])) 
			        			{
					        		$Tid=$_SESSION['userID'];
					        		$Suid = $_GET['Suid'];
					        		
					        		$query = mysql_query("Select TopicID, theme, Sid FROM themes where Tid = '$Tid' and Suid = '$Suid'", $connection);
									if ($query != false){
									$res_array = array();
								
									$count = 0;
									
									while($row = mysql_fetch_array($query))
									{
										$res_array[$count] = $row;
										$count++;
									}
			        	?>
			        	<div class="col-md-4">
			        		<div class="panel panel-default">
		        				<div class="panel-heading"><p align="center"> ДОБАВЛЕНИЕ ТЕМЫ КУРСОВОЙ РАБОТЫ</p></div>
		                        <div class="panel-body">
		                        	<form class="" method="POST" action="work.php">
	                                    <input type="text" name="theme" class="form-control" placeholder="Название курсовой работы" style="margin-bottom:5px">
	                                    <input type="text" name="Suid" hidden value=<?= $_GET['Suid']  ?>>
	                                    <input type="text" name="Gid" hidden value=<?= $_GET['Gid']  ?>>
	                                    <p align="center"><button type = "submit" name = 'addTheme' class="btn btn-primary" style="margin-right:1%"> Добавить </button></p>
	                                </form>
	                            </div>
		                    </div>
			        	</div>
			        	<div class="col-md-5">
			        		<div class="panel panel-default" style="overflow:auto; max-height:450px">
			        			<div class="panel-body">
			        				<div class="table-responsive" style="background-color:#fff">
	      								<table id="mytable" class="table table-bordred table-striped">
	      									<thead> <p align="center"> ТЕМЫ КУРСОВЫХ РАБОТ</p>
	      										<th>Название</th>
	      										<th>Студент</th>
	      									</thead>
										    <?php 
												foreach($res_array as $row)
												{ 
													$student = '';
													if (!(is_null($row['Sid']))){
														$Sid = $row['Sid'];
														$query = mysql_query("select FIO FROM students WHERE Sid = $Sid", $connection);
														$student = mysql_fetch_array($query);
													}


										    ?>
										    <tbody>
											    <tr>
											    	<form action="work.php" method="POST">
													    <td><?= $row['theme'];?></td>
													    <?php 
													    	if ($student['FIO'] == '') { ?>
													    		<td>Свободна</td>
													    <?php }
													    	else { ?>
																<td><?= $student['FIO'];?></td>
													    <?php } ?>
				
													    <td><input type="text" name="Suid" hidden value=<?= $_GET['Suid']  ?>></td>
	                                    				<td><input type="text" name="Gid" hidden value=<?= $_GET['Gid']    ?>></td>
	                                    				<td><input type="text" name="TopicID" hidden value=<?= $row['TopicID']  ?>></td>
													    <td><p align="right"><button class="btn btn-danger btn-xs" name = "del_table_post" type="submit"><span class="fa fa-trash-o"></span></button></p></td>
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
					<?php } }?>
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