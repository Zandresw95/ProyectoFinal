<html>
<head>
<title>Productos - COVID</title>
<?php
	require_once('auth.php');
?>
<link href="css/bootstrap.css" rel="stylesheet">
<link href="css/estiloCustomer.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="css/DT_bootstrap.css">  
<link rel="stylesheet" href="css/font-awesome.min.css">
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
					<li><a href="sales.php?id=cash&invoice=<?php echo $finalcode ?>">Ventas </a></li>             
					<li><a href="products.php"> Productos</a></li>
					<li class="active"><a href="customer.php">Clientes </a></li>
					<li><a href="supplier.php">Proveedores</a></li>
					<li><a href="salesreport.php?d1=0&d2=0">Reporte de ventas</a></li>
					<br><br><br><br>
				</ul>     
          	</div>
        </div>
		<div class="span10">
			<div class="contentheader">
				<i class="icon-group"></i> Clientes
			</div>
			<ul class="breadcrumb">
				<li><a href="index.php">Inicio</a></li> /
				<li class="active">Clientes</li>
			</ul>
			<div style="margin-top: -19px; margin-bottom: 21px;">
				<a  href="index.php"><button class="btn btn-default btn-large" style="float: left;">Atras</button></a>
				<?php 
				include('../connect.php');
				$result = $db->prepare("SELECT * FROM customer ORDER BY customer_id DESC");
				$result->execute();
				$rowcount = $result->rowcount();
				?>
			<div style="text-align:center;">
				Número total de clientes: <font color="green" style="font:bold 22px 'Aleo';"><?php echo $rowcount;?></font>
			</div>
		</div>
		<input type="text" name="filter" style="padding:15px;" id="filter" placeholder="Buscar Cliente..." autocomplete="off" />
		<a rel="facebox" href="addcustomer.php"><Button type="submit" class="btn btn-info" style="float:right; width:230px; height:35px;"><i class="icon-plus-sign icon-large"></i> Agregar cliente</button></a><br><br>
		<table class="table table-bordered" id="resultTable" data-responsive="table" style="text-align: left;">
			<thead>
				<tr>
					<th width="17%"> Nombre completo</th>
					<th width="10%"> Dirección </th>
					<th width="10%"> Número de contacto</th>
					<th width="23%"> nombre del producto</th>
					<th width="9%"> Total </th>
					<th width="17%"> Nota </th>
					<th width="9%"> Fecha de vencimiento </th>
					<th width="14%"> Acción </th>
				</tr>
			</thead>
			<tbody>
				<?php
				include('../connect.php');
				$result = $db->prepare("SELECT * FROM customer ORDER BY customer_id DESC");
				$result->execute();
				for($i=0; $row = $result->fetch(); $i++){
				?>
					<tr class="record">
						<td><?php echo $row['customer_name']; ?></td>
						<td><?php echo $row['address']; ?></td>
						<td><?php echo $row['contact']; ?></td>
						<td><?php echo $row['prod_name']; ?></td>
						<td><?php echo $row['membership_number']; ?>.00</td>
						<td><?php echo $row['note']; ?></td>
						<td><?php echo $row['expected_date']; ?></td>
						<td>
							<a  title="Click para editar cliente" rel="facebox" href="editcustomer.php?id=<?php echo $row['customer_id']; ?>"><button class="btn btn-warning btn-mini"> Editar </button></a> 
							<a href="#" id="<?php echo $row['customer_id']; ?>" class="delbutton" title="Click para eliminar"><button class="btn btn-danger btn-mini"> Borrar</button></a>
						</td>
					</tr>
				<?php
				}
				?>
			</tbody>
		</table>
		<div class="clearfix"></div>
	</div>
</div>
<script src="js/jquery.js"></script>
<script type="text/javascript">
$(function() {
	$(".delbutton").click(function(){
	//guardo enlace
	var element = $(this);
	//BUsco el id del enlace
	var del_id = element.attr("id");
	//construyo url
	var info = 'id=' + del_id;
	if(confirm("Seguro que quiere borrar? NO hay paso atras!")){
 		$.ajax({
   			type: "GET",
   			url: "deletecustomer.php",
   			data: info,
   			success: function(){ }
 		});
         $(this).parents(".record").animate({ backgroundColor: "#fbc7c7" }, "fast")
		.animate({ opacity: "hide" }, "slow");
 	}
	return false;
	});
});
</script>
</body>
<?php 
include('footer.php');
?>

</html>