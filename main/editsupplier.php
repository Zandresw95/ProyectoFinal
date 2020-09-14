<?php
	include('../connect.php');
	$id=$_GET['id'];
	$result = $db->prepare("SELECT * FROM supliers WHERE suplier_id= :userid");
	$result->bindParam(':userid', $id);
	$result->execute();
	for($i=0; $row = $result->fetch(); $i++){
?>
<link href="../style.css" media="screen" rel="stylesheet" type="text/css" />
<link href="css/estiloEditSupplier.css" media="screen" rel="stylesheet" type="text/css" />
<form action="saveeditsupplier.php" method="post">
	<center><h4> Editar Proovedor</h4></center><hr>
	<div id="ac">
		<input type="hidden" name="memi" value="<?php echo $id; ?>" />
		<span>Nombre del Proveedor : </span><input type="text" id="nprov" name="name" value="<?php echo $row['suplier_name']; ?>" /><br>
		<span>Direccion : </span><input type="text" id="location" name="address" value="<?php echo $row['suplier_address']; ?>" /><br>
		<span>Persona de Contacto : </span><input type="text" id="pcont" name="cperson" value="<?php echo $row['contact_person']; ?>" /><br>
		<span>No. Contacto: </span><input type="text" id="ncont" name="contact" value="<?php echo $row['suplier_contact']; ?>" /><br>
		<span>Nota : </span><textarea id="note" name="note"><?php echo $row['note']; ?></textarea><br>
		<div id="btns">
			<button class="btn btn-success btn-block btn-large" id="btnsav"> Guardar Cambios </button>
		</div>
	</div>
</form>
<?php
}
?>