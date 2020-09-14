<link href="../style.css" media="screen" rel="stylesheet" type="text/css" />
<link href="css/estiloAddSupplier.css" media="screen" rel="stylesheet" type="text/css" />
<form action="savesupplier.php" method="post">
    <center><h4><i class="icon-plus-sign icon-large"></i> Añadir proveedor</h4></center><hr>
    <div id="ac">
        <span>Nombre del proveedor: </span><input type="text" id="provname" name="name" required/><br>
        <span>Dirección : </span><input type="text" id="location" name="address" /><br>
        <span>Persona de contacto : </span><input type="text" id="pcont" name="contact" /><br>
        <span> No.Contacto : </span><input type="text" id="ncont" name="cperson" /><br>
        <span>Nota : </span><textarea id="note" name="note"></textarea><br>
        <div id="btnsav">
            <button class="btn btn-success btn-block btn-large" id="btns"> Guardar</button>
        </div>
    </div>
</form>