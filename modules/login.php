<?php
	session_start();

	$error='';
	if (isset($_POST['Teacher'])) 
		{
			if (empty($_POST['login']) || empty($_POST['password'])) 
				{
					$_SESSION['error'] = "Пожалуйста введите все данные";
					header("location: ../index.php");
				}
			else
				{
					$login = $_POST['login'];
					$password = $_POST['password'];

					$connection = mysql_connect("localhost", "root", "");
					$db = mysql_select_db("KursDB", $connection);
					
					$login = stripslashes($login);
					$password = stripslashes($password);

					$login = mysql_real_escape_string($login);
					$password = mysql_real_escape_string($password);
				
					$query = mysql_query("Select Tid from teachers where password='$password' AND login='$login'", $connection);
					$rows = mysql_num_rows($query);

					if ($rows == 1) 
						{
							$_SESSION['role']=1; 

							$res = mysql_fetch_array($query);
							$_SESSION['userID']=$res['Tid'];
							header("location: ../teacher/teacher.php");
							} 
						else 
							{
								$_SESSION['error'] = "Неверно введены логин или пароль";
								header("location: ../index.php");
							}
					mysql_close($connection); 
				}
		}

	if (isset($_POST['Student'])) 
		{
			if (empty($_POST['login']) || empty($_POST['password'])) 
				{
					$_SESSION['error'] = "Пожалуйста введите все данные";
					header("location: ../index.php");
				}
			else
				{	
					$login=$_POST['login'];
					$password=$_POST['password'];
			
					$connection = mysql_connect("localhost", "root", "");

					$login = stripslashes($login);
					$password = stripslashes($password);

					$login = mysql_real_escape_string($login);
					$password = mysql_real_escape_string($password);

					$db = mysql_select_db("KursDB", $connection);
					$query = mysql_query("select Sid from students where password='$password' AND login='$login'", $connection);
					$rows = mysql_num_rows($query);

					if ($rows == 1) 
						{
							$_SESSION['role']=0;
							$res = mysql_fetch_array($query);
							$_SESSION['userID']=$res['Sid'];
							$_SESSION['userLogin'] = $login;
								
							$_SESSION['sellect']['Stid'] = 0;
							$_SESSION['sellect']['Suid'] = 0;
							$_SESSION['sellect']['Tid'] = 0;
							header("location: ../sthome.php");
						} 
					else 
						{
							$_SESSION['error'] = "Неверно введены логин или пароль";
							header("location: ../index.php");
						}
					mysql_close($connection); 
				}
		}
?>