<?php

function quitar($mensaje){
	//$mensaje=strip_tags($mensaje);
	$mensaje = str_replace("`","",$mensaje);
	$mensaje = str_replace(";","",$mensaje);
	//$mensaje = str_replace(":","",$mensaje);
	$mensaje = str_replace("'","",$mensaje);
	//$mensaje = str_replace("&","",$mensaje);
	$mensaje = str_replace("\'","",$mensaje);
	$mensaje = str_replace("<","",$mensaje);
	$mensaje = str_replace(">","",$mensaje);
	$mensaje = str_replace("\'","",$mensaje);
	$mensaje = str_replace('\"',"",$mensaje);
	$mensaje = str_replace("\\\\","",$mensaje);
	return $mensaje;
	}

function Cambio($contenido){
	$contenido=quitar($contenido);
	$contenido=str_replace("�","&aacute;",$contenido);
	$contenido=str_replace("�","&eacute;",$contenido);
	$contenido=str_replace("�","&iacute;",$contenido);
	$contenido=str_replace("�","&oacute;",$contenido);
	$contenido=str_replace("�","&uacute;",$contenido);
	$contenido=str_replace("�","&Aacute;",$contenido);
	$contenido=str_replace("�","&Eacute;",$contenido);
	$contenido=str_replace("�","&Iacute;",$contenido);
	$contenido=str_replace("�","&Oacute;",$contenido);
	$contenido=str_replace("�","&Uacute;",$contenido);
	$contenido=str_replace("�","&ntilde;",$contenido);
	$contenido=str_replace("�","&Ntilde;",$contenido);
	$contenido=str_replace("{[","<a href=\\\"",$contenido);
	$contenido=str_replace("]","\\\" target=\\\"_blank\\\"><span class=\\\"linkpag\\\">",$contenido);
	$contenido=str_replace("}","</span></a>",$contenido);
	$contenido=str_replace("(n)","<strong>",$contenido);
	$contenido=str_replace("(s)","<br>",$contenido);
	$contenido=str_replace("(/n)","</strong>",$contenido);
	return $contenido;
}

function mensaje($texto){
	echo '
	<br>
	<table width="500" border="0" cellspacing="0" cellpadding="0">
    	<tr> 
        	<td align="center" valign="bottom" bgcolor="#d2d2e4" class="Estilo7">&nbsp;</td>
       	</tr>
        <tr> 
			<td align="center" valign="middle" bgcolor="#d2d2e4" class="Estilo7">'.$texto.'</td>
     	</tr>
       	<tr> 
        	<td align="center" valign="top" bgcolor="#d2d2e4" class="Estilo7">&nbsp;</td>
     	</tr>
	</table><br><br>';
	}

?>