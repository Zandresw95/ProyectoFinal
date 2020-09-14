<link href="../style.css" media="screen" rel="stylesheet" type="text/css" />
<link href="css/estiloPurchases.css" rel="stylesheet">
<form action="savepur.php" method="post">
<h4>Agregar compra</h4><hr>
<div id="tbl">
	<div id="ac">
		<span>Fecha: <br></span><input type="date" id="fech" name="date" placeholder="MM/DD/YYYY" /><br>
		<span>Número de factura: </span><input type="text" id="nfac" name="iv" /><br>
		<span>Proovedor : </span>
		<select name="supplier" id="prov">
			<?php
			include('../connect.php');
			$result = $db->prepare("SELECT * FROM supliers");
			$result->bindParam(':userid', $res);
			$result->execute();
			for($i=0; $row = $result->fetch(); $i++){
				?>
				<option><?php echo $row['suplier_name']; ?></option>
				<?php
			}
				?>
		</select><br>
		<span>Observacion:<br> </span><input type="text" id="obs" name="remarks" /><br>
		<span>&nbsp;</span><input id="btn" type="submit" value="save" />
	</div>
</div>
</form>