<link href="../style.css" media="screen" rel="stylesheet" type="text/css" />
<link href="css/estiloAddCustomer.css" media="screen" rel="stylesheet" type="text/css" />
<form action="savecustomer.php" method="post">
    <center><h4><i class="icon-plus-sign icon-large"></i> Agregar cliente</h4></center><hr>
    <div id="ac">
        <span id="name">Nombre completo: </span><input type="text" name="name" placeholder="Nombre completo" Required/><br>
        <span id="location">Dirección : </span><input type="text" name="address" placeholder="dirección"/><br>
        <span id="contact">Contacto : </span><input type="text" name="contact" placeholder="Contacto"/><br>
        <span id="pName">Nombre de Producto : </span><textarea name="prod_name"></textarea><br>
        <span id="total">Total: </span><input type="text" name="memno" placeholder="Total"/><br>
        <span id="note">Nota : </span><textarea name="note"></textarea><br>
        <span id="dDate">Fecha esperada: </span><input type="date" name="date" placeholder="Date"/><br>
        <div class= "elbtn">
            <button class="btn btn-success btn-block btn-large" id="save"> Guardar</button>
        </div>
    </div>
</form>