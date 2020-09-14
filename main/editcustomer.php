<?php
	include('../connect.php');
	$id=$_GET['id'];
	$result = $db->prepare("SELECT * FROM customer WHERE customer_id= :userid");
	$result->bindParam(':userid', $id);
	$result->execute();
	for($i=0; $row = $result->fetch(); $i++){
?>
<link href="../style.css" media="screen" rel="stylesheet" type="text/css" />
<link href="css/estiloEditCustomer.css" media="screen" rel="stylesheet" type="text/css" />
<form action="saveeditcustomer.php" method="post">
	<center><h4> Editar clientes</h4></center><hr>
	<div id="ac">
		<input type="hidden" name="memi" value="<?php echo $id; ?>" />
		<span>Nombre completo : </span><input type="text" id="fName" name="name" value="<?php echo $row['customer_name']; ?>" /><br>
		<span>Dirección: </span><input type="text" id="location" name="address" value="<?php echo $row['address']; ?>" /><br>
		<span>Contacto : </span><input type="text" id="contact" name="contact" value="<?php echo $row['contact']; ?>" /><br>
		<span>nombre del producto : </span><textarea id="nprod" name="prod_name"><?php echo $row['prod_name']; ?></textarea><br>
		<span>Total : </span><input type="text" id="total" name="memno" value="<?php echo $row['membership_number']; ?>" /><br>
		<span>Nota : </span><textarea id="note" name="note"><?php echo $row['note'];?></textarea><br>
		<span>Fecha esperada: </span><input type="date" id="wdate" name="date" value="<?php echo $row['expected_date']; ?>" placeholder="fecha"/><br>
		<div id="btns">
			<button class="btn btn-success btn-block btn-large" id="btnsav"> Guardar cambios </button>
		</div>
	</div>
</form>
<?php
	}
?>