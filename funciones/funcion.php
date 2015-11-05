<?

/*
Permite contar el codigo malicioso, comando sql y esas cosas.
*/
function limpia($cadena)
{
	$malo = array("insert","select","update","delete","'",",","(",")");
	$bueno   = array("", "", "","","","","","");
	$cadena = str_replace($malo, $bueno, $cadena);
	return $cadena;
}

?>