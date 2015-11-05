<?php   

	include "conn.php";//conexion a postgresql    
	$conn = pg_connect("host=$dbhost port=$dbport dbname=$dbname user=$dbuser password=$dbpass") or die('<div width="100%" class="error">OCURRIO UN ERROR AL INTENTAR CONECTAR A LA BASE DE DATOS <B>'. $dbname.' </B></div>');

	$id_catalogo=$_REQUEST['id_catalogo'];
	$sql="SELECT id_catalogo FROM catalogo WHERE id_catalogo='$id_catalogo'";

	$result = pg_query($conn,$sql);

	$total=pg_num_rows($result);

	if($total>0)  
	{   
	  // El catálogo existe en la Base de Datos  
	  echo "<font color=#cc0033><B>Cat&aacute;logo Ocupado</b></FONT>";  
	}
	else
	{  
	  // Ese catálogo esta libre  
	  echo "<font color=#339966><B>Cat&aacute;logo Libre</b></FONT>";  
	}
	pg_close($conn);
 
?> 
