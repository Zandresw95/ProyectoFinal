<html>
<head>
<?php 
require_once('auth.php');
?>
<title>Productos - COVID</title>
</title>
<link href="css/bootstrap.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="css/DT_bootstrap.css">  
<link rel="stylesheet" href="css/font-awesome.min.css">
<link href="css/customer_ledger.css" rel="stylesheet">
<link href="css/bootstrap-responsive.css" rel="stylesheet">
<link href="../style.css" media="screen" rel="stylesheet" type="text/css" />
<script src="argiepolicarpio.js" type="text/javascript" charset="utf-8"></script>
<script src="js/application.js" type="text/javascript" charset="utf-8"></script>
<link href="src/facebox.css" media="screen" rel="stylesheet" type="text/css" />
<script src="lib/jquery.js" type="text/javascript"></script>
<script src="src/facebox.js" type="text/javascript"></script>
<script type="text/javascript">
  	jQuery(document).ready(function($) {
    	$('a[rel*=facebox]').facebox({
      		loadingImage : 'src/loading.gif',
      		closeImage   : 'src/closelabel.png'
    	})
  	})
</script>
</head>
<body>
<?php 
include('navfixed.php');
?>
<div class="container-fluid">
    <div class="row-fluid">
		<div class="span2">
          	<div class="well sidebar-nav">
	            <ul class="nav nav-list">
              		<li class="active"><a href="#"><i class="icon-dashboard icon-large"></i> Inicio <div class="pull-right"><i class="icon-circle-arrow-right icon-large"></i></div></a></li> 
              		<li><a href="#"><i class="icon-group icon-large"></i> Clientes <div class="pull-right"><i class="icon-circle-arrow-right icon-large"></i></div></a></li>
              		<li><a href="#"><i class="icon-table icon-large"></i> Productos <div class="pull-right"><i class="icon-circle-arrow-right icon-large"></i></div></a></li>
              		<li><a href="#"><i class="icon-group icon-large"></i> Proveedores <div class="pull-right"><i class="icon-circle-arrow-right icon-large"></i></div></a></li>
              		<li><a href="sales.php"><i class="icon-bar-chart icon-large"></i> Reporte de ventas <div class="pull-right"><i class="icon-circle-arrow-right icon-large"></i></div></a></li>
              		<li><a href="sales.php"><i class="icon-inbox icon-large"></i> Efectivo <div class="pull-right"><i class="icon-circle-arrow-right icon-large"></i></div></a></li>
			   		<li><a href="user.php"><i class="icon-user icon-large"></i> Usuarios <div class="pull-right"><i class="icon-circle-arrow-right icon-large"></i></div></a></li>
            	</ul>
        	</div>
    	</div>
		<div class="span10">
			<div class="contentheader">
				<i class="icon-list"></i> Efectivo
			</div>
			<ul class="breadcrumb">
				<li><a href="index.php">Inicio</a></li> /
				<li class="active">Libro mayor de clientes</li>
			</ul>
			<div id="maintable">
				<div id="btnb">
					<a  href="index.php"><button class="btn btn-default btn-large" id="btnback"> Atras</button></a>
				</div>
				<?php
				include('../connect.php');
				$tftft=$_GET['cname'];
				$resulta = $db->prepare("SELECT * FROM sales WHERE invoice_number= :a");
				$resulta->bindParam(':a', $tftft);
				$resulta->execute();
				for($i=0; $rowa = $resulta->fetch(); $i++){
					$name=$rowa['name'];
					$amount=$rowa['amount'];
				}
				$resultas = $db->prepare("SELECT * FROM customer WHERE customer_name= :b");
				$resultas->bindParam(':b', $name);
				$resultas->execute();
				for($i=0; $rowas = $resultas->fetch(); $i++){
					echo 'Nombre : '.$rowas['customer_name'].'<br>';
					echo 'Direccion : '.$rowas['address'].'<br>';
					echo 'Contacto : '.$rowas['contact'].'<br>';
				}
				?>
				<table class="table table-bordered" id="resultTable" data-responsive="table">
					<thead>
						<tr>
							<th> ID de transacción </th>
							<th> Fecha </th>
							<th> Número de factura </th>
							<th> Pago </th>
							<th> Monto total debido </th>
							<th> Balance </th>
						</tr>
					</thead>
					<tbody>
						<tr class="record">
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td><strong><?php echo $rowa['amount']; ?></strong></td>
							<td>&nbsp;</td>
						</tr>
						<?php
						$tftft=$_GET['cname'];
						$result = $db->prepare("SELECT * FROM collection WHERE name= :userid ORDER BY transaction_id ASC");
						$result->bindParam(':userid', $tftft);
						$result->execute();
						for($i=0; $row = $result->fetch(); $i++){
						?>
							<tr class="record">
								<td>TR-000<?php echo $row['transaction_id']; ?></td>
								<td><?php echo $row['date']; ?></td>
								<td><?php echo $row['invoice']; ?></td>
								<td><?php echo $row['amount']; ?></td>
								<td>&nbsp;</td>
								<td><?php echo $row['balance']; ?></td>
							</tr>
						<?php
						}
						?>		
					</tbody>
				</table>
				<a rel="facebox" href="addledger.php?invoice=<?php echo $_GET['cname']; ?>&amount=<?php echo $rowa['amount']; ?>"  id="apay"><button class="btn btn-success">Agregar pago</button></a><br><br>
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