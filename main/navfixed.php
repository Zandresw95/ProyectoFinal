<!--Barra que uso para mostrar el usuario, la fecha y la opcion de cerrar sesion-->
<div class="navbar navbar-inverse navbar-fixed-top">
  <div class="navbar-inner">
    <div class="container-fluid">
      <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>
      <div class="nav-collapse collapse">
        <ul class="nav pull-right">
          <li><a>Bienvenido:<strong> <?php echo $_SESSION['SESS_LAST_NAME'];?></strong></a></li>
			    <li>
            <a>
					    <?php
						  $Today = date('y:m:d',time());
						  $new = date('l, F d, Y', strtotime($Today));
						  echo $new;
						  ?>
            </a>
          </li>
          <li><a href="../index.php"> Cerrar sesión</a></li>
        </ul>
      </div>
    </div>
  </div>
</div>
	