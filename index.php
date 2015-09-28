<?php
    session_start();
    
    if(isset($_SESSION['role']))
      {
          if ($_SESSION['role'] == 0) {
              header("location: sthome.php");
          }

          if ($_SESSION['role'] == 1){
              header("location: teacher/teacher.php");
          }
      }
    
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>KursTeacher | Login</title>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link href="css/style.css" rel="stylesheet">

    <script src="js/respond.min.js"></script>
    <link rel="shortcut icon" href="img/favicon/favicon.png">
  </head>
  <body>
    <div class="admin-form">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="widget worange">
              <div class="widget-head">
                <i class="fa fa-lock"></i> Авторизация 
              </div>
              <div class="widget-content">
                <div class="alert alert-danger" role="alert" 
                    <?php 
                    if(!isset($_SESSION['error']))
                      {
                        echo "hidden";
                      }
                    ?>
                >
                    <?php 
                      if($_SESSION['error'])
                        {
                          echo $_SESSION['error'];
                        }
                    ?> 
                 </div>
                <div class="padd">
                  <form class="form-horizontal" method="POST" action="modules/login.php">
                    <div class="form-group">
                      <div class="col-lg-9">
                        <input type="text" class="form-control" name="login" placeholder="Login">
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-lg-9">
                        <input type="password" class="form-control" name="password" placeholder="Password">
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-lg-9">
                        <input type="submit" name="Student" value="Student" class="btn btn-lg btn-primary" href="/" style="float:left"></input> 
                        <input type="submit" name="Teacher" value="Teacher" class="btn btn-lg btn-primary" href="/" style="float:right"></input> 
                      </div>
                    </div>
                  </form>
                </div>
              </div>
              <div class="widget-foot">
                <p align="center">Не зарегистрированы? Обратитесь к администратору</p>
              </div>
            </div>  
          </div>
        </div>
      </div> 
    </div>
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>