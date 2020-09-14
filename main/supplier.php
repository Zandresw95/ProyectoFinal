<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Productos - COVID</title>
	<?php
		require_once('auth.php');
	?>
	<link href="css/bootstrap.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/DT_bootstrap.css">  
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<style type="text/css">
	body {
		padding-top: 60px;
		padding-bottom: 40px;
	}
	.sidebar-nav {
		padding: 9px 0;
	}
	</style>
	<link href="css/bootstrap-responsive.css" rel="stylesheet">
	<link href="../style.css" media="screen" rel="stylesheet" type="text/css" />
	<script src="jeffartagame.js" type="text/javascript" charset="utf-8"></script>
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
<?php
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
<body>
	<?php 
	include('navfixed.php');
	?>
	<div class="container-fluid">
		<div class="row-fluid">
			<div class="span2">
				<div class="well sidebar-nav">
					<ul class="nav nav-list">
						<li><a href="index.php">Inicio</a></li> 
						<li><a href="sales.php?id=cash&invoice=<?php echo $finalcode ?>">Ventas</a></li>             
						<li><a href="products.php">Productos</a></li>
						<li><a href="customer.php">Clientes</a></li>
						<li class="active"><a href="supplier.php">Proveedores</a></li>
						<li><a href="salesreport.php?d1=0&d2=0">Reporte de ventas</a></li>
						<br><br><br><br>
					</ul>     
				  </div>
			</div>
			<div class="span10">
				<div class="contentheader">
					<i class="icon-group"></i> Proveedores
				</div>
				<ul class="breadcrumb">
					<li><a href="index.php">Inicio</a></li>/
					<li class="active">Proveedores</li>
				</ul>
				<div style="margin-top: -19px; margin-bottom: 21px;">
					<a  href="index.php"><button class="btn btn-default btn-large" style="float: left;">Atras</button></a>
					<?php 
						include('../connect.php');
						$result = $db->prepare("SELECT * FROM supliers ORDER BY suplier_id DESC");
						$result->execute();
						$rowcount = $result->rowcount();
					?>
					<div style="text-align:center;">
						Numero total de porveedores: <font color="green" style="font:bold 22px 'Aleo';"><?php echo $rowcount;?></font>
					</div>
				</div>
				<input type="text" name="filter" style="height:35px; margin-top: -1px;" value="" id="filter" placeholder="Search Supplier..." autocomplete="off" />
				<a rel="facebox" href="addsupplier.php"><Button type="submit" class="btn btn-info" style="float:right; width:230px; height:35px;" />Agregar Proveedor <i class="icon-plus-sign icon-large"></i></button></a><br><br>
				<table class="table table-bordered" id="resultTable" data-responsive="table" style="text-align: left;">
					<thead>	
						<tr>
							<th> Proveedor </th>
							<th> Persona de contacto </th>
							<th> Dirección </th>
							<th> No. Contacto </th>
							<th> Nota</th>
							<th width="120"> Opciones </th>
						</tr>
					</thead>
					<tbody>
						<?php
							include('../connect.php');
							$result = $db->prepare("SELECT * FROM supliers ORDER BY suplier_id DESC");
							$result->execute();
							for($i=0; $row = $result->fetch(); $i++){
						?>
								<tr class="record">
									<td><?php echo $row['suplier_name']; ?></td>
									<td><?php echo $row['contact_person']; ?></td>
									<td><?php echo $row['suplier_address']; ?></td>
									<td><?php echo $row['suplier_contact']; ?></td>
									<td><?php echo $row['note']; ?></td>
									<td><a rel="facebox" href="editsupplier.php?id=<?php echo $row['suplier_id']; ?>"><button class="btn btn-warning btn-mini">Editar </button></a>
									<a href="#" id="<?php echo $row['suplier_id']; ?>" class="delbutton" title="Click To Delete"><button class="btn btn-danger btn-mini">Eliminar</button></a></td>
								</tr>
						<?php
							}
						?>
					</tbody>
				</table>
				<div class="clearfix"></div>
			</div>
		</div>
	</div>
	
	<script src="js/jquery.js"></script>
	<script type="text/javascript">
		$(function() {
			$(".delbutton").click(function(){
			//guardo el enlace
			var element = $(this);
			//busco el id del enlace clickeado
			var del_id = element.attr("id");
			//Construyo la url
			var info = 'id=' + del_id;
			 if(confirm("Seguro que quiere borrar? ")){
				 $.ajax({
					   type: "GET",
					   url: "deletesupplier.php",
					   data: info,
					   success: function(){}
				 });
				 $(this).parents(".record").animate({ backgroundColor: "#fbc7c7" }, "fast")
				.animate({ opacity: "hide" }, "slow");
			 }
			return false;
			});
		});
	</script>
</body>
</html>