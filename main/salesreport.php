<!DOCTYPE html>
<html lang="en">
<?php
	require_once('auth.php');
?>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Productos - COVID</title>
	<link href="css/bootstrap.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/DT_bootstrap.css">  
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link href="css/estiloSalesReport.css" rel="stylesheet">
	<link href="css/bootstrap-responsive.css" rel="stylesheet">
	<link href="../style.css" media="screen" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" type="text/css" href="tcal.css" />
	<script type="text/javascript" src="tcal.js"></script>
	<script language="javascript">
	function Clickheretoprint(){ 
		  var disp_setting="toolbar=yes,location=no,directories=yes,menubar=yes,"; 
		disp_setting+="scrollbars=yes,width=700, height=400, left=100, top=25"; 
		  var content_vlue = document.getElementById("content").innerHTML; 
		  var docprint=window.open("","",disp_setting); 
		   docprint.document.open(); 
		   docprint.document.write('</head><body onLoad="self.print()" style="width: 700px; font-size:11px; font-family:arial; font-weight:normal;">');          
		   docprint.document.write(content_vlue); 
		   docprint.document.close(); 
		   docprint.focus(); 
	}
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
						<li><a href="supplier.php">Proveedores</a></li>
						<li class="active"><a href="salesreport.php?d1=0&d2=0">Reporte de ventas</a></li>
						<br><br><br><br>
					</ul>     
				  </div>
			</div>
			<div class="span10">
				<div class="contentheader">Reporte de ventas <i class="icon-bar-chart"></i></div>
				<ul class="breadcrumb">
					<li><a href="index.php">Inicio</a></li> /
					<li class="active">Reporte de ventas</li>
				</ul>
				<div id="btnb">
					<a  href="index.php"><button class="btn btn-default btn-large" style="float: none;">Atras</button></a>
					<button  id="btnimpr" class="btn btn-success btn-mini"><a href="javascript:Clickheretoprint()"> Impresión</button></a>
				</div>
				<form action="salesreport.php" method="get">
					<p id="txt"><strong>De : <input type="text" id="de" name="d1" class="tcal" value=""/> A: <input type="text" id="to" name="d2" class="tcal" value="" />
					 <button class="btn btn-info" id="btnbus" type="submit"> Buscar</button>
					</strong></p>
				</form>
				<div class="content" id="content">
					<div id="report">
						Reporte de ventas desde &nbsp;<?php echo $_GET['d1'] ?>&nbsp; hasta &nbsp;<?php echo $_GET['d2'] ?>
				</div>
				<table class="table table-bordered" id="resultTable" data-responsive="table" >
					<thead>
						<tr>
							<th width="13%"> ID de transacción </th>
							<th width="13%"> Fecha de Transacción </th>
							<th width="20%"> Nombre del cliente </th>
							<th width="16%"> Número de factura </th>
							<th width="18%"> Cantidad </th>
							<th width="13%"> Lucro </th>
						</tr>
					</thead>
					<tbody>
						<?php
						include('../connect.php');
						$d1=$_GET['d1'];
						$d2=$_GET['d2'];
						$result = $db->prepare("SELECT * FROM sales WHERE date BETWEEN :a AND :b ORDER by transaction_id DESC ");
						$result->bindParam(':a', $d1);
						$result->bindParam(':b', $d2);
						$result->execute();
						for($i=0; $row = $result->fetch(); $i++){
						?>
						<tr class="record">
							<td>STI-00<?php echo $row['transaction_id']; ?></td>
							<td><?php echo $row['date']; ?></td>
							<td><?php echo $row['name']; ?></td>
							<td><?php echo $row['invoice_number']; ?></td>
							<td>
								<?php
								$dsdsd=$row['amount'];
								echo formatMoney($dsdsd, true);
								?>
							</td>
							<td>
								<?php
								$zxc=$row['profit'];
								echo formatMoney($zxc, true);
								?>
							</td>
						</tr>
					<?php
					}
					?>
					</tbody>
					<thead>
						<tr>
							<th colspan="4" class="tot"> Total: </th>
							<th colspan="1" class="tot"> 
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
							$d1=$_GET['d1'];
							$d2=$_GET['d2'];
							$results = $db->prepare("SELECT sum(amount) FROM sales WHERE date BETWEEN :a AND :b");
							$results->bindParam(':a', $d1);
							$results->bindParam(':b', $d2);
							$results->execute();
							for($i=0; $rows = $results->fetch(); $i++){
								$dsdsd=$rows['sum(amount)'];
								echo formatMoney($dsdsd, true);
							}
							?>
							</th>
							<th colspan="1" class="tot">
								<?php 
								$resultia = $db->prepare("SELECT sum(profit) FROM sales WHERE date BETWEEN :c AND :d");
								$resultia->bindParam(':c', $d1);
								$resultia->bindParam(':d', $d2);
								$resultia->execute();
								for($i=0; $cxz = $resultia->fetch(); $i++){
									$zxc=$cxz['sum(profit)'];
									echo formatMoney($zxc, true);
								}
								?>		
							</th>
						</tr>
					</thead>
				</table>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
	<script src="js/jquery.js"></script>
	<script type="text/javascript">
		$(function() {
			$(".delbutton").click(function(){
			//guarda en enlace
			var element = $(this);
			//Busca el id del enlace
			var del_id = element.attr("id");
			//Built a url to send
			var info = 'id=' + del_id;
			 if(confirm("Seguro que quiere borrar?")){
				 $.ajax({
					   type: "GET",
					   url: "deletesales.php",
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
