<?php
   $db = new mysqli('localhost', 'root' ,'andy1995', 'sales');
	if(!$db) {	
		echo 'No se pudo conectar a la base de datos';
	} 
	else {
		if(isset($_POST['queryString'])) {
			$queryString = $db->real_escape_string($_POST['queryString']);
			if(strlen($queryString) >0) {
				$sddsdsd='credit';
				$query = $db->query("SELECT *  FROM sales WHERE type='$sddsdsd' AND name LIKE '$queryString%' LIMIT 10");
				if($query) {
					echo '<ul>';
					while ($result = $query ->fetch_object()) {
	         			echo '<li onClick="fill(\''.addslashes($result->invoice_number).'\');">'.$result->name.' - '.$result->invoice_number.'</li>';
	         		}
					echo '</ul>';
				} 
				else {
					echo 'hubo un problema';
				}
			} 
			else {
				// no hace nada
			}
		} 
		else {
			echo 'No hay acceso al script!';
		}
	}
?>