<?php
	
	// PHP5 Implementation - uses MySQLi.
	// mysqli('localhost', 'yourUsername', 'yourPassword', 'yourDatabase');
	//$db = new mysqli('localhost', 'rodrigo' ,'enter', 'base1');

	include "conn.php";//conexion a postgresql	
	$conn = pg_connect("host=$dbhost port=$dbport dbname=$dbname user=$dbuser password=$dbpass") or die('<div width="100%" class="error">OCURRIO UN ERROR AL INTENTAR CONECTAR A LA BASE DE DATOS <B>'. $dbname.' </B></div>');
	
	if(!$conn) {
		// Show error if we cannot connect.
		echo 'ERROR: Could not connect to the database.';
	} else {
		// Is there a posted query string?
		if(isset($_GET['search'])) {
			//$queryString = $db->real_escape_string($_POST['queryString']);
			$queryString = $_GET['search'];
			
			//echo $queryString;
			// Is the string length greater than 0?
			
			if(strlen($queryString) >0) {
				// Run the query: We use LIKE '$queryString%'
				// The percentage sign is a wild-card, in my example of countries it works like this...
				// $queryString = 'Uni';
				// Returned data = 'United States, United Kindom';
				
				// YOU NEED TO ALTER THE QUERY TO MATCH YOUR DATABASE.
				// eg: SELECT yourColumnName FROM yourTable WHERE yourColumnName LIKE '$queryString%' LIMIT 10
				require_once 'funciones.php';
				
				$query = "select nombre_archivo from archivo".whereGeneraConsultaSqlSplit_3( $queryString ) ."order by nombre_archivo asc LIMIT 15 OFFSET 0 ";
				
				$result= pg_query($conn,$query);
				
				if( $result ) {
					//Verificando si la consulta tiene resultados
					/*if( ! pg_num_rows($result) )
						echo 'La busqueda no tuvo resultados'. "\n";*/

					//Mostrando los resultados
					//else
						// While there are results loop through them - fetching an Object (i like PHP5 btw!).
						while ($row = pg_fetch_array($result))
						{
							//$tamanho="<font color=#f60000><b>".formatBytes( $row["tamanho"] )."</b></font>";

							// Format the results, im using <li> for the list, you can change it.
							// The onClick function fills the textbox with the result.
							// YOU MUST CHANGE: $result->value to $result->your_colum

							//echo '<li onClick="fill(\''.$row["nombre_archivo"].'\');"><b>'.$row["nombre_archivo"]."</b>  ".$tamanho.'</li>';
							//echo '<li onClick="fill(\''.$row["nombre_archivo"].'\');"><b>'.$row["nombre_archivo"]."</b>  ".$tamanho.'</li>' . "\n" ;
							echo $row['nombre_archivo']. "\n";
						}
					
				} else {
					echo 'ERROR: There was a problem with the query.';
				}
			} else {
				// Dont do anything.
			} // There is a queryString.
		} else {
			echo 'There should be no direct access to this script!';
		}
		pg_close( $conn );
	}
?>