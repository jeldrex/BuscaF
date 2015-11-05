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

function generaHrefdelBocadilloVistoso( $href, $row_mostrar, $label, $mensaje)
{
	$detalle="<a class=\"infoP\" target=\"_blank\" href=\"".$href."\">".$row_mostrar."</a>";
	$detalle.="<span class=\"tooltip\"><span class=\"highlight\">"."$label: ".$row_mostrar."</span><br>$mensaje</span>";
	return $detalle;
}

function listarPeliculas( $_pagi_Lim )
{
	echo "<table width='710' border='0' cellspacing='0' cellspadding='10'>";
/* 	echo "<tr>";
	echo "<td colspan='3' bgcolor='#d2d2e4'><div class='Estilo7'><strong>PELICULAS</strong></div></td>";
	echo "<td colspan='3' bgcolor='#d2d2e4'><div class='Estilo7'><strong></strong></div></td>";
	echo "</tr>"; */
	$color1 = "#eaeaf2";//claro   F7F8ED
	$color2 = "#d2d2e4";//oscuro  E7E7CF
	
	include "conn.php";//conexion a postgresql    
	$conn = pg_connect("host=$dbhost port=$dbport dbname=$dbname user=$dbuser password=$dbpass") or die("Error al conectar la base de datos");
	
	if(!$conn){
		echo "<tr>";
		echo "<td colspan='3' bgcolor='#F7F8ED'><div class='Estilo7'>X Error al conectarce a la Base de Datos</div></td>";
		echo "</tr>";
		exit();
		}
		
	$contador=1;
	
	$busca = "SELECT nombre_pelicula,formato,idioma,id_pelicula
	          FROM pelicula  order by nombre_pelicula asc ".$_pagi_Lim;
	$result=pg_query($conn,$busca);
	if(!$result) {
		echo "<tr>";
		echo "<td colspan='3' bgcolor='#F7F8ED'><div class='Estilo7'>X Error al buscar en la Bases de Datos</div></td>";
		echo "</tr>";
		exit();
		}
	echo "<tr>";
	echo "<td width='30' bgcolor=#d2d2e4 height='25'><div class='Estilo7'><strong>NOMBRE PELICULA</strong></div></td>";
	echo "<td width='30' bgcolor=#d2d2e4 height='25'><div class='Estilo7'><strong>FORMATO</strong></div></td>";
	echo "<td width='30' bgcolor=#d2d2e4 height='25'><div class='Estilo7'><strong>IDIOMA</strong></div></td>";
	echo "<td width='30' bgcolor=#d2d2e4 height='25'><div class='Estilo7'><strong>OPCIONES</strong></div></td>";
	echo "</tr>";
	while ( $row = pg_fetch_array( $result ) )
	{
	
		if( $row[formato] == 'MPEG-1 and MPEG-2 PS' ||
		    $row[formato] == 'Audio-Video Interleaved' ||
			$row[formato] == 'MPEG-4 format' ||
			$row[formato] == 'Matroska open audio/video container' ||
			$row[formato] == 'Macromedia Flash video' ||
			$row[formato] == 'RealMedia' ||
			$row[formato] == 'Windows Media Video' ||
			$row[formato] == 'OGM' ||
			$row[formato] == '1080p' ||
			$row[formato] == '720p'
			)
		{
		/*$href="http://127.0.0.1/buscaf/search.php?id_buscar=".$row[nombre_pelicula];
		$detalle="<a class=\"infoP\" target=\"_blank\" href=\"".$href."\">".$row[nombre_pelicula]."</a>";
		$detalle.="<span class=\"tooltip\"><span class=\"highlight\">"."Nombre de la Pelicula: ".$row[nombre_pelicula]."</span><br>Click para buscar en sistema BuscaF ...</span>";*/

		$detalle = generaHrefdelBocadilloVistoso ( "http://127.0.0.1/buscaf/search.php?txtSearch=".$row[nombre_pelicula], $row[nombre_pelicula], "Nombre de la Pelicula", "Click para buscar en BuscaF ..." );

		}
		else
			$detalle = $row[nombre_pelicula];
		$contador++;	
		if(($contador%2) == 0)$color = $color1;
		else $color = $color2;
		echo "<tr>";
		echo "<td width='30' bgcolor=$color height='25'><div class='Estilo7'>$detalle</div></td>";
		echo "<td width='30' bgcolor=$color height='25'><div class='Estilo7'>$row[formato]</div></td>";
		
		switch($row[idioma]){
				case 'Espanoljoder':
					echo "<td width='30' bgcolor=$color height='25'><div class='Estilo7'>Español de España</div></td>";
					break;
				case 'Espanol':
					echo "<td width='30' bgcolor=$color height='25'><div class='Estilo7'>Español</div></td>";
					break;
				default:
					echo "<td width='30' bgcolor=$color height='25'><div class='Estilo7'>".$row[idioma]."</div></td>";
					break;
				}
		//Hace que aparesca un cuadro preguntando antes  de borrar
		$Confirm_js = 'onclick = "if (! confirm(\'Confirma eliminar pelicula?\')) return false;"' ;
		
		echo "<td width='100' bgcolor=$color height='25'><div class='Estilo7' >
		<a href='listar_peliculas.php?menu=act&accion=ver&id_pelicula=$row[id_pelicula]'>[ver]</a> 
		<a href='listar_peliculas.php?menu=act&accion=del&id_pelicula=$row[id_pelicula]' ". $Confirm_js."><font color=\"#FF0000\"><strong>[eliminar]</strong></font></a> 
		<a href='listar_peliculas.php?menu=act&accion=modificar&id_pelicula=$row[id_pelicula]'><font color=\"#0000FF\"><strong>[modificar]</strong></font></a>
		</div>
		</td>";
		echo "</tr>";
		}

	echo "</table>";
	echo "<br>";
	pg_close($conn);
	} 

function comboFormato()
{
	echo					'<select name="formato" id="formato">
							<option value="1" >DVD</option>
							<option value="2" >MPEG-1 and MPEG-2 PS</option>
                        	<option value="3" >Audio-Video Interleaved</option>
                            <option value="4" >MPEG-4 format</option>
							<option value="5" >Matroska open audio/video container</option>
							<option value="6" >Macromedia Flash video</option>
							<option value="7" >RealMedia</option>
							<option value="8" >Windows Media Video</option>
							<option value="9" >OGM</option>
							<option value="10" >1080p</option>
							<option value="11" >720p</option>
						</select>';
}	

function comboAudio()
{
	echo '					<select name="audio" id="audio">
							<option value="1" >Ingles</option>
                        	<option value="2" >Espa&ntilde;ol</option>
                            <option value="3" >Español de España</option>
							<option value="4" >Multi</option>
							<option value="5" >Frances</option>
							<option value="6" >Italiano</option>
							<option value="7" >Japon&eacute;s</option>
							<option value="8" >Portugues</option>
						</select>';
}
function FormularioPelicula(){
	echo '
		<form name="form1" method="post" action="ingresar_peliculas.php?menu=act&accion=agregar">
			<table width="700" border="0" cellspacing="0" cellpadding="1" bgcolor="#eaeaf2">
				<tr class="Estilo7"> 
					<td colspan="3" bgcolor="#d2d2e4"> <div class="Estilo7"><strong>AGREGAR NUEVA PELICULA</strong></div></td>
				</tr>
				<tr class="Estilo7"> 
					<td colspan="3">&nbsp;</td>
				</tr>				
				<tr class="Estilo7"> 
					<td width="120">Nombre de la Pelicula</td>
					<td width="20">:</td>
					<td width="367"><input name="nombre_pelicula" id="nombre_empresa" type="text" size="60" maxlength="60"></td>
				</tr>		
				<tr class="Estilo7"> 
					<td width="100" valign="top">Formato</td>
					<td width="20" valign="top">:</td>					
					<td width="170">'; 
					comboFormato();
					echo '</td>
				</tr>

				<tr class="Estilo7"> 
					<td width="80" valign="top">Idioma Audio</td>
					<td width="20" valign="top">:</td>					
					<td width="170">';
					comboAudio();
					echo '</td>
				</tr>				
				<tr class="Estilo7">
					<td colspan="3">&nbsp;</td>
				</tr>				
				<tr class="Estilo7"> 
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td><label class="uiButton uiButtonSpecial uiButtonLarge"><input type="submit" name="Submit" value="Agregar Pel&iacute;cula"></label></td>
				</tr>				
				<tr class="Estilo7"> 
					<td colspan="3">&nbsp;</td>
				</tr>
				<tr bgcolor="#FFFFFF" class="Estilo7"> 
					<td colspan="3">&nbsp;</td>
				</tr>

			</table>
        </form>
		';
	}

function Cambio($contenido){
	$contenido=quitar($contenido);
	$contenido=str_replace("á","&aacute;",$contenido);
	$contenido=str_replace("é","&eacute;",$contenido);
	$contenido=str_replace("í","&iacute;",$contenido);
	$contenido=str_replace("ó","&oacute;",$contenido);
	$contenido=str_replace("ú","&uacute;",$contenido);
	$contenido=str_replace("Á","&Aacute;",$contenido);
	$contenido=str_replace("É","&Eacute;",$contenido);
	$contenido=str_replace("Í","&Iacute;",$contenido);
	$contenido=str_replace("Ó","&Oacute;",$contenido);
	$contenido=str_replace("Ú","&Uacute;",$contenido);
	$contenido=str_replace("ñ","&ntilde;",$contenido);
	$contenido=str_replace("Ñ","&Ntilde;",$contenido);
	$contenido=str_replace("{[","<a href=\\\"",$contenido);
	$contenido=str_replace("]","\\\" target=\\\"_blank\\\"><span class=\\\"linkpag\\\">",$contenido);
	$contenido=str_replace("}","</span></a>",$contenido);
	$contenido=str_replace("(n)","<strong>",$contenido);
	$contenido=str_replace("(s)","<br>",$contenido);
	$contenido=str_replace("(/n)","</strong>",$contenido);
	return $contenido;
}

function EliminarPelicula($id_pelicula){

	include "conn.php";//conexion a postgresql    
	$conn = pg_connect("host=$dbhost port=$dbport dbname=$dbname user=$dbuser password=$dbpass") or die("Error al conectar la base de datos");

	$query = "DELETE FROM pelicula WHERE (id_pelicula = '$id_pelicula')"; 
	if(pg_query($conn,$query))
		echo '<div class="exito mensajes">¡Confirmado!, Pelicula Eliminada Exitosamente</div>';
	else
	{
		echo '<div class="error mensajes">No se pudo eliminar la Pelicula</div>';
	}
	pg_close($conn);
}

function mensaje( $titulo,$texto )
{

echo '
		<div id="cuadro_mensaje_status" class="mobile_account_inlay">
		<div id="standard_status" class="UIMessageBox status">
		<h2 class="main_message">
		<h2 class="asdf">'.$titulo.'</h2>
		<p class="sub_message">
		'.$texto.'
		</p>
		</div>
		</div>';
}

function AgregarPelicula($nombre_pelicula,$op_formato,$op_audio){
	if(empty($nombre_pelicula))
	{		
		//include "../funciones.php";	
		/*echo "<table width='580' border='0' cellspacing='0' cellpadding='0'>
 				<tr>
    				<td width='580' height='60' bgcolor='#d2d2e4' align='center' valign='middle'><div class='Estilo7'>NO INGRESADO. Debe completar todos los campos</div></div></td>
  				</tr>
			</table>
			<br>";*/		
		
		mensaje("No Ingresado","Debe completar todos los campos");	
	}
	else{
	
		include "conn.php";//conexion a postgresql    
		$conn = pg_connect("host=$dbhost port=$dbport dbname=$dbname user=$dbuser password=$dbpass") or die("Error al conectar la base de datos");

		//seleccionando el tipo de formato
		$formato = tipo_formato($op_formato);
		
		//seleccionando el tipo de AUDIO
		$audio = tipo_audio($op_audio);
		
		$query = "INSERT INTO pelicula (nombre_pelicula,formato,idioma) 
				  VALUES ('$nombre_pelicula','$formato','$audio')";

		if(pg_query($conn,$query))
			echo '<div class="exito mensajes">¡Confirmado! Pelicula ingresada </b> ingresado exitosamente</div>';
        else 
			echo '<div class="error mensajes">Error en el ingreso, la pelicula ya existe</div>';
		}
	pg_close($conn);
	}

function DetallePelicula($id_pelicula){
	
	include "conn.php";//conexion a postgresql    
	$conn = pg_connect("host=$dbhost port=$dbport dbname=$dbname user=$dbuser password=$dbpass") or die("Error al conectar la base de datos");
		
	$busca = "SELECT nombre_pelicula,formato,idioma
	          FROM pelicula WHERE id_pelicula = '$id_pelicula'";
	
	$result= pg_query($conn,$busca);
	
	if($row =pg_fetch_array($result)){
					
		echo "<table width='500' border='0' cellspacing='0' cellpadding='0'>
				 
				 <tr>
					<td bgcolor='#d2d2e4' align='left' valign='middle'><div class='Estilo7'><b>Nombre pelicula: </b></div></td>
    				<td bgcolor='#d2d2e4' align='left' valign='middle'><div class='Estilo7'>".$row["nombre_pelicula"]."</div></div></td>
  				</tr>

				<tr>
					<td bgcolor='#eaeaf2' align='left' valign='middle'><div class='Estilo7'><b>formato: </b></div></td>
    				<td bgcolor='#eaeaf2' align='left' valign='middle'><div class='Estilo7'>".$row["formato"]."</div></div></td>
  				</tr>				
				
				<tr>
					<td bgcolor='#d2d2e4' align='left' valign='middle'><div class='Estilo7'><b>Idioma: </b></div></td>
				";
				switch($row[idioma]){
				case 'Espanoljoder':
					echo "<td bgcolor='#d2d2e4' align='left' valign='middle'><div class='Estilo7'>Español de España</div></div></td>";
					break;
				case 'Espanol':
					echo "<td bgcolor='#d2d2e4' align='left' valign='middle'><div class='Estilo7'>Español</div></div></td>";
					break;
				default:
					echo "<td bgcolor=#d2d2e4 height='25'><div class='Estilo7'>".$row[idioma]."</div></td>";
					break;
				}
				/*if($row[tipo_i]=='Espanoljoder')
					echo "<td bgcolor='#d2d2e4' align='left' valign='middle'><div class='Estilo7'>Español de España</div></div></td>";
				else
					echo "<td width='30' bgcolor=#d2d2e4 height='25'><div class='Estilo7'>".$row[tipo_i]."</div></td>";			*/
			    				
  		echo"</tr>
			</table>
			<br>";
		}
	else{
			echo '<div class="error mensajes">Error! Pelicula no encontrada</div>';
		}	
	pg_close($conn);
	}

/*function mensaje($texto){
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
	}*/

function ModificarPelicula($id_pelicula){
	include "conn.php";//conexion a postgresql    
	$conn = pg_connect("host=$dbhost port=$dbport dbname=$dbname user=$dbuser password=$dbpass") or die("Error al conectar la base de datos");

	$busca = "SELECT nombre_pelicula FROM pelicula WHERE id_pelicula = '$id_pelicula'";
	
	$result= pg_query($conn,$busca);
	if($row = pg_fetch_array($result)){
		$nombre_pelicula=$row['nombre_pelicula'];		

		echo '
		<form name="form1" method="post" action="'.$_SERVER[PHP_SELF].'?menu=act&accion=mod">
                    <table width="700" border="0" cellspacing="0" cellpadding="0">
                      <tr bgcolor="#d2d2e4" class="Estilo7"> 
                        <td colspan="3"><strong>Modificaci&oacute;n para '.$nombre_pelicula.'</strong></td>
                      </tr>
					  <tr bgcolor="#eaeaf2" class="Estilo7"> 
                 		<td colspan="3">&nbsp;</td>
                      </tr>
					  
					  <input name="id_pelicula" type="hidden" id="'.$id_pelicula.'" value="'.$id_pelicula.'">
					  
					  <tr bgcolor="#eaeaf2" class="Estilo7">
                        <td>Nombre pelicula</td>
                        <td>:</td>
                        <td> <input name="nombre_pelicula" type="text" id="nombre_pelicula" size="70" maxlength="100" value="'.$nombre_pelicula.'"></td>
                      </tr>
					  
					<tr bgcolor="#eaeaf2" class="Estilo7"> 
						<td width="80" valign="top">Formato</td>
						<td width="23" valign="top">:</td>					
						<td width="170">'; 
					comboFormato();
					echo '</td>
					</tr>
				
					<tr bgcolor="#eaeaf2" class="Estilo7">
						<td width="80" valign="top">Idioma Audio</td>
						<td width="23" valign="top">:</td>					
					<td width="170">';
					comboAudio();
					echo '</td>
					</tr>
                      
                      <tr bgcolor="#eaeaf2" class="Estilo7"> 
                        <td colspan="3">&nbsp;</td>
                      </tr>
                      <tr bgcolor="#eaeaf2" class="Estilo7"> 
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td><label class="uiButton uiButtonConfirm uiButtonLarge"><input type="submit" name="Submit" value="Guardar Cambios"></label></td>
                      </tr>
<tr bgcolor="#eaeaf2" class="Estilo7"> 
                        <td colspan="3">&nbsp;</td>
                      </tr>					  
               	</table>
            </form>
			';
		}
	else
		echo '<div class="error mensajes">Pelicula NO encontrado en la base de datos</div>';
	pg_close($conn);
	}

function tipo_formato($op_formato)
{
		//seleccionando el tipo de formato
		switch($op_formato){
		case 1:$formato="DVD";break;
		case 2:$formato="MPEG-1 and MPEG-2 PS";break;
		case 3:$formato="Audio-Video Interleaved";break;
		case 4:$formato="MPEG-4 format";break;
		case 5:$formato="Matroska open audio/video container";break;
		case 6:$formato="Macromedia Flash video";break;
		case 7:$formato="RealMedia";break;
		case 8:$formato="Windows Media Video";break;
		case 9:$formato="OGM";break;
		case 10:$formato="1080p";break;
		case 11:$formato="720p";break;
		default:break;
		}
		
		return $formato;
}	

function tipo_audio ($op_audio)
{
		switch($op_audio){
		case 1:$audio="Ingles";break;
		case 2:$audio="Espanol";break;
		case 3:$audio="Espanoljoder";break;
		case 4:$audio="Multi";break;
		case 5:$audio="Frances";break;
		case 6:$audio="Italiano";break;
		case 7:$audio="Japones";break;
		case 8:$audio="Portugues";break;
		default:break;
		}
		
		return $audio;
}
function mod($id_pelicula,$nombre_pelicula,$op_formato,$op_audio){
		
		include "conn.php";//conexion a postgresql    
		$conn = pg_connect("host=$dbhost port=$dbport dbname=$dbname user=$dbuser password=$dbpass") or die("Error al conectar la base de datos");

		//seleccionando el tipo de formato
		$formato = tipo_formato($op_formato);
		
		//seleccionando el tipo de AUDIO
		$audio = tipo_audio($op_audio);
		
		$camb = "UPDATE pelicula SET 
		         nombre_pelicula='$nombre_pelicula', 
				 formato='$formato', 
				 idioma='$audio'
				 WHERE id_pelicula= '$id_pelicula'";

		$result= pg_query($conn,$camb);
		if(!$result) 
		{
			echo '<div class="error mensajes">No se pudo modificar</div>';
		}
		else{
			echo '<div class="exito mensajes">¡Confirmado!, Pelicula Exitosamente modificada</div>';
			}
		pg_close($conn);
	}	

?>