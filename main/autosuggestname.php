<?php
   $db = new mysqli('us-cdbr-east-02.cleardb.com', 'baa1e7556611c5' ,'d3825e54', 'sales');
	if(!$db) {
		echo 'No se pudo conectar a la base de datos.';
	} 
	else {
		if(isset($_POST['queryString'])) {
			$queryString = $db->real_escape_string($_POST['queryString']);
			if(strlen($queryString) >0) {
				$query = $db->query("SELECT customer_name FROM customer WHERE customer_name LIKE '$queryString%' LIMIT 10");
				if($query) {
					echo '<ul>';
					while ($result = $query ->fetch_object()) {
	         			echo '<li onClick="fill(\''.addslashes($result->customer_name).'\');">'.$result->customer_name.'</li>';
	         		}
					echo '</ul>';
				} 
				else {
					echo 'OOPS hubo un problema';
				}
			} 
			else {}
		} else {
			echo 'No hay acceso al script';
		}
	}
?>