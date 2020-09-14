<link href="../style.css" media="screen" rel="stylesheet" type="text/css" />
<link href="css/estiloAddProduct.css" media="screen" rel="stylesheet" type="text/css" />
<form action="saveproduct.php" method="post">
	<center><h4><i class="icon-plus-sign icon-large"></i> Agregar producto</h4></center>
	<div id="ac">
		<span>Nombre del marca : </span><input type="text" id="mName" name="code" Required><br>
		<span>Nombre Generico : </span><input type="text" id="gName" name="gen" Required/><br>
		<span>Descripción  : </span><textarea id="description" name="name"> </textarea><br>
		<span>Fecha de llegada: </span><input type="date" id="cDate" name="date_arrival" /><br>
		<span>Fecha de caducidad : </span><input type="date" value="<?php echo date ('M-d-Y'); ?>" id="dDate" name="exdate" /><br>
		<span>Precio de venta : </span><input type="text" id="pvp" name="price" onkeyup="sum();" Required><br>
		<span>Precio original : </span><input type="text" id="pvo" name="o_price" onkeyup="sum();" Required><br>
		<span>Lucro : </span><input type="text" id="lucro" name="profit" readonly><br>
		<span>Proveedor : </span><select name="supplier" id="selec"><option></option>
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
		<span>Cantidad : </span><input type="number" min="0" id="cant" onkeyup="sum();" name="qty" Required ><br>
		<span></span><input type="hidden" id="tramp" name="qty_sold" Required ><br>
		<div id="btnsav">
			<button class="btn btn-success btn-block btn-large" id="btns" >Guardar</button>
		</div>
	</div>
</form>
