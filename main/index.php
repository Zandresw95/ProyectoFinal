<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Productos - COVID</title>
	<link href="css/bootstrap.css" rel="stylesheet">
 	<link rel="stylesheet" type="text/css" href="css/DT_bootstrap.css">
  	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link href="css/bootstrap-responsive.css" rel="stylesheet">
	<link href="css/estiloIndex.css" rel="stylesheet">
	<link href="../style.css" media="screen" rel="stylesheet" type="text/css" />
	<link href="src/facebox.css" media="screen" rel="stylesheet" type="text/css" />
	<script src="lib/jquery.js" type="text/javascript"></script>
	<script src="src/facebox.js" type="text/javascript"></script>
	<script type="text/javascript">
  		jQuery(document).ready(function($) {$('a[rel*=facebox]').facebox({
									loadingImage : 'src/loading.gif',
      								closeImage   : 'src/closelabel.png'
    							})
  		})
	</script>
	<?php
		require_once('auth.php');
		function createRandomPassword() {
			$chars = "003232303232023232023456789";
			srand((double)microtime()*1000000);
			$i = 0;
			$pass = '' ;
			while ($i <= 7) {
				$num = rand() % 33;
				$tmp = substr($chars, $num, 1);
				$pass = $pass . $tmp;
				$i++;
			}
			return $pass;
		}
		$finalcode='RS-'.createRandomPassword();
	?>
</head>
<body>
	<?php include('navfixed.php');
		$position=$_SESSION['SESS_LAST_NAME'];
		if($position=='cashier') {
	?>
			<a href="../index.php">Salir</a>
	<?php
		}
		if($position=='admin') {
	?>
			<div class="container-fluid">
				  <div class="row-fluid">
					<div class="span2">
						  <div class="well sidebar-nav">
							 <ul class="nav nav-list">
								  <li class="active"><a href="#">Inicio</a></li> 
								<li><a href="sales.php?id=cash&invoice=<?php echo $finalcode ?>"> Ventas</a>  </li>             
								<li><a href="products.php"> Productos</a></li>
								<li><a href="customer.php"> Clientes</a></li>
								<li><a href="supplier.php"> Proveedores</a></li>
								<li><a href="salesreport.php?d1=0&d2=0"> Reporte de ventas</a></li><br><br><br><br>		
							</ul>                               
						  </div>
					</div>
					<div class="span10">
						<div class="contentheader"></div>
						<ul class="breadcrumb">
							<li class="active">Inicio</li>
						</ul>
						<p id="tit">Productos para el COVID</p>
						<div id="mainmain">
							<a href="sales.php?id=cash&invoice=<?php echo $finalcode ?>"><br> Ventas</a>               
							<a href="products.php"><br> Productos</a>      
							<a href="customer.php"><br> Clientes</a>     
							<a href="supplier.php"></i><br> Proveedores</a>     
							<a href="salesreport.php?d1=0&d2=0"><br> Reporte Ventas</a>
							<a href="../index.php"><br>Cerrar sesión</a> 
	<?php
		}
	?>
							<div class="clearfix"></div>
						</div>
					</div>
				</div>
			</div>
	
</body>
<?php 
include('footer.php'); 
?>
</html>


