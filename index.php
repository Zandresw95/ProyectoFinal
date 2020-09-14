<?php
	//Start session
	session_start();
	
	//Unset the variables stored in session
	unset($_SESSION['SESS_MEMBER_ID']);
	unset($_SESSION['SESS_FIRST_NAME']);
	unset($_SESSION['SESS_LAST_NAME']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Productos - COVID</title>
	<link rel="shortcut icon" href="main/images/pos.jpg">
	<link href="main/css/bootstrap.css" rel="stylesheet">
	<link href="main/css/estilo.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="main/css/DT_bootstrap.css">
	<link rel="stylesheet" href="main/css/font-awesome.min.css">
	<link href="main/css/bootstrap-responsive.css" rel="stylesheet">
	<link href="style.css" media="screen" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="container-fluid">
      	<div class="row-fluid">
			<div class="span4"></div>
		</div>
		<div id="login">
			<?php
			if( isset($_SESSION['ERRMSG_ARR']) && is_array($_SESSION['ERRMSG_ARR']) && count($_SESSION['ERRMSG_ARR']) >0 ) {
				foreach($_SESSION['ERRMSG_ARR'] as $msg) {
					echo '<div class="error">',$msg,'</div><br>'; 
				}
				unset($_SESSION['ERRMSG_ARR']);
			}
			?>
			<form action="login.php" method="post">
				<p class="titu">Productos - COVID</p><br>		
				<div class="input-prepend">
					<input style="height:30px;" type="text" name="username" Placeholder="Username" required/><br>
				</div>
				<div class="input-prepend">
					<input type="password" style="height:30px;" name="password" Placeholder="Password" required/><br>
				</div>
				<div class="qwe">
			 		<button class="btn btn-large btn-primary btn-block pull-right" href="dashboard.html" type="submit">Ingresar</button>
				</div>
			</form>
		</div>
	</div>
</body>
</html>
