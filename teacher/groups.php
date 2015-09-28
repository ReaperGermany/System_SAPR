<?php
	session_start(); 
?>
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
            $connection = mysql_connect("localhost", "root", "");
            $db = mysql_select_db("KursDB", $connection);
			
			$userID = $_SESSION['userID'];

			$query = mysql_query("Select Gid, Name FROM groups WHERE Gid not in (SELECT Gid FROM groupReference WHERE Tid=$userID)", $connection);
			
			$res_array = array();
			$count = 0;

			while($row = mysql_fetch_array($query))
			{
				$res_array[$count] = $row;
				$count++;
			}

			mysql_close($connection);
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
		          <li class="open"><a href="groups.php"><i class="fa fa-users"></i> Выбор групп</a></li>
		          <li><a href="work.php"><i class="fa fa-list"></i> Назначения работ</a></li>
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
			        	<div class="col-md-4">
			        		<div class="panel panel-default">
		                        <div class="panel-heading"><p align="center"> ВЫБЕРИТЕ ГРУППЫ ДЛЯ ВЕДЕНИЯ КУРСОВОЙ РАБОТЫ</p></div>
		                        <div class="panel-body">
		                            <form class="" method="POST" action="groupAdd.php">
			                            <div class="col-md-8">
			                        		<select name="Gid" class=" form-control">
			                        			<?php 
			                        			foreach ($res_array as $row) 
			                        			{ 
			                        			?>
                                           			<option value=<?= $row['Gid']; ?>> <?= $row['Name']; ?> </option>
	                                           	<?php
                                           	 	} 
	                                           	?>
		                                    </select>
			                        	</div>
										<button type = "submit" name = 'Add' class="btn btn-primary pull-right"> Выбрать <i class="fa fa-caret-right"></i></button>             
		                            </form>
		                      	</div>
		                    </div>
			        	</div>
			        	<?php if($_SESSION['error'] == 'выполнено') {?>
				        	<div  class="col-md-8">
								<div class="alert alert-success" role="alert"> Данный предмет добавлен в Ваш список </div>
				        	</div>
						<?php
						$_SESSION['error'] = '';
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

	</body>
</html>