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
	<link href="css/bootstrap-responsive.css" rel="stylesheet">
	<link href="css/estiloProducts.css" rel="stylesheet">
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
	<script>
	function sum() {
		var txtFirstNumberValue = document.getElementById('txt1').value;
		var txtSecondNumberValue = document.getElementById('txt2').value;
		var result = parseInt(txtFirstNumberValue) - parseInt(txtSecondNumberValue);
		if (!isNaN(result)) {
			document.getElementById('txt3').value = result;		
		}			
		var txtFirstNumberValue = document.getElementById('txt11').value;
		var result = parseInt(txtFirstNumberValue);
		if (!isNaN(result)) {
			document.getElementById('txt22').value = result;				
		}		
		var txtFirstNumberValue = document.getElementById('txt11').value;
		var txtSecondNumberValue = document.getElementById('txt33').value;
		var result = parseInt(txtFirstNumberValue) + parseInt(txtSecondNumberValue);
		if (!isNaN(result)) {
			document.getElementById('txt55').value = result;		
		}		
		var txtFirstNumberValue = document.getElementById('txt4').value;
		var result = parseInt(txtFirstNumberValue);
		if (!isNaN(result)) {
			document.getElementById('txt5').value = result;
		}		
	}
	</script>	
<body>
	<?php 
	include('navfixed.php');
	?>
	<div class="container-fluid">
		<div class="row-fluid">
			<div class="span2">
				  <div class="well sidebar-nav">
					  <ul class="nav nav-list">
						  <li><a href="index.php"> Inicio </a></li> 
						<li><a href="sales.php?id=cash&invoice=<?php echo $finalcode ?>"> Ventas</a></li>             
						<li class="active"><a href="products.php"> Productos</a></li>
						<li><a href="customer.php"> Clientes</a></li>
						<li><a href="supplier.php"> Proveedores</a></li>
						<li><a href="salesreport.php?d1=0&d2=0"> Reporte de ventas</a></li>
						<br><br><br><br>		
					</ul>             
				  </div>
			</div>
			<div class="span10">
				<div class="contentheader">
					<i class="icon-table"></i> Productos
				</div>
				<ul class="breadcrumb">
					<li><a href="index.php">Inicio</a></li> /
					<li class="active">Productos</li>
				</ul>
				<div id="btnb">
					<a  href="index.php"><button class="btn btn-default btn-large" id="btnback"> Atras</button></a>
					<?php 
						include('../connect.php');
						$result = $db->prepare("SELECT * FROM products ORDER BY qty_sold DESC");
						$result->execute();
						$rowcount = $result->rowcount();
					?>
				
					<?php 
						include('../connect.php');
						$result = $db->prepare("SELECT * FROM products where qty < 10 ORDER BY product_id DESC");
						$result->execute();
						$rowcount123 = $result->rowcount();
					?>
					<div id="ntot">
						<p id="totprod">Numero total de productos:  <?php echo $rowcount;?></p>
					</div>
				</div>
				<input type="text" style="padding:15px;" name="filter" value="" id="filter" placeholder="Buscar Producto..." autocomplete="off" />
				<a rel="facebox" href="addproduct.php"><Button type="submit" class="btn btn-info" id="addP"> Agregar Producto</button></a><br><br>
				<table class="hoverTable" id="resultTable" data-responsive="table">
					<thead>
						<tr>
							<th width="12%"> Nombre de la marca</th>
							<th width="14%"> Nombre generico </th>
							<th width="13%"> Categoria / Descripccion </th>
							<th width="7%"> Proveedores </th>
							<th width="9%"> Fecha de recepción </th>
							<th width="10%"> Fecha de caducidad </th>
							<th width="6%"> Precio original </th>
							<th width="6%"> Precio de venta </th>
							<th width="6%"> Cant. </th>
							<th width="5%"> Cant. restante</th>
							<th width="8%"> Total </th>
							<th width="8%"> Accion </th>
						</tr>
					</thead>
					<tbody>
						<?php
						function formatMoney($number, $fractional=false) {
							if ($fractional) {
								$number = sprintf('%.2f', $number);
							}
							while (true) {
								$replaced = preg_replace('/(-?\d+)(\d\d\d)/', '$1,$2', $number);
								if ($replaced != $number) {
									$number = $replaced;
								} 
								else {
									break;
								}
							}
							return $number;
						}
						include('../connect.php');
						$result = $db->prepare("SELECT *, price * qty as total FROM products ORDER BY product_id DESC");
						$result->execute();
						for($i=0; $row = $result->fetch(); $i++){
							$total=$row['total'];
							$availableqty=$row['qty'];
							if ($availableqty < 10) {
								echo '<tr class="alert alert-warning record" style="color: #fff; background:rgb(255, 95, 66);">';
							}
							else {
								echo '<tr class="record">';
							}
						?>
						<td><?php echo $row['product_code']; ?></td>
						<td><?php echo $row['gen_name']; ?></td>
						<td><?php echo $row['product_name']; ?></td>
						<td><?php echo $row['supplier']; ?></td>
						<td><?php echo $row['date_arrival']; ?></td>
						<td><?php echo $row['expiry_date']; ?></td>
						<td>
							<?php
								$oprice=$row['o_price'];
								echo formatMoney($oprice, true);
							?>
						</td>
						<td>
							<?php
								$pprice=$row['price'];
								echo formatMoney($pprice, true);
							?>
						</td>
						<td><?php echo $row['qty_sold']; ?></td>
						<td><?php echo $row['qty']; ?></td>
						<td>
							<?php
							$total=$row['total'];
							echo formatMoney($total, true);
							?>
						</td>	
						<td>
							<a rel="facebox" title="Click para editar el producto" href="editproduct.php?id=<?php echo $row['product_id']; ?>"><button class="btn btn-warning">Editar</button> </a>
							<a href="#" id="<?php echo $row['product_id']; ?>" class="delbutton" title="Click para borrar el Producto"><button class="btn btn-danger">Borrar</button></a>
						</td>
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
				//guardo enlace
				var element = $(this);
				//Busco el id del enlace
				var del_id = element.attr("id");
				//contruyo una url
				var info = 'id=' + del_id;
				 if(confirm("Sure you want to delete this Product? There is NO undo!")){
					 $.ajax({
						   type: "GET",
						   url: "deleteproduct.php",
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
<?php 
include('footer.php');
?>
</html>