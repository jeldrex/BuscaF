<?php

/**
* Separa los argumentos ingresados como busqueda mediante split, y genera la consulta sql
* agregando like ' % % '
*/
function whereGeneraConsultaSqlSplit($id_buscar)
{
	$id_buscar = strtolower( $id_buscar );
	$datos = split( '[ +]', $id_buscar );
	$select = " where nombre_archivo ilike '%".$datos[0]."%' ";
	for ( $i=1;$i<count($datos);$i++ )
		$select .= "and nombre_archivo ilike '%".$datos[$i]."%' ";
	return $select;
}

function whereGeneraConsultaSqlSplit_3($id_buscar)
{
	$id_buscar = strtolower( $id_buscar );
	$datos = split( '[ ]', $id_buscar );
	$select = " where nombre_archivo ilike '%".$datos[0]."%' ";
	for ( $i=1;$i<count($datos);$i++ )
		$select .= "and nombre_archivo ilike '%".$datos[$i]."%' ";
	return $select;
}

/**
* Funcion que hace lo mismo que la anterior whereGeneraConsultaSqlSplit, 

*/
function whereGeneraConsultaSqlSplit_2($id_buscar)
{
	$id_buscar = strtolower( $id_buscar );
	$datos = split( '[ +]', $id_buscar );
	$select = " where a.id_catalogo=b.id_catalogo and a.nombre_archivo ilike '%".$datos[0]."%' ";
	for ( $i=1;$i<count($datos);$i++ )
		$select .= "and a.nombre_archivo ilike '%".$datos[$i]."%' ";
	return $select;
} 
function ConsultaSqlSplit($id_buscar)
{
	$id_buscar = strtolower( $id_buscar );
	$datos = split( '[ +]', $id_buscar );
	$select = " a.id_catalogo=b.id_catalogo and a.nombre_archivo ilike '%".$datos[0]."%' ";
	for ( $i=1;$i<count($datos);$i++ )
		$select .= "and a.nombre_archivo ilike '%".$datos[$i]."%' ";
	return $select;
}

/**
* Elimina un catalogo. Se borra en cascada eliminando todo.
* $id_catalogo: id del catalogo a eliminar
*/
function Eliminar( $id_cat )
{

	include "conn.php";//conexion a postgresql
	$conn = pg_connect("host=$dbhost port=$dbport dbname=$dbname user=$dbuser password=$dbpass") or die('<div width="100%" class="error">OCURRIO UN ERROR AL INTENTAR CONECTAR A LA BASE DE DATOS <B>'. $dbname.' </B></div>');

	$query = "DELETE FROM catalogo WHERE (id_cat = '$id_cat')"; 
	if(pg_query($conn,$query)){
		//mensaje( "¡Confirmado!","Cat&aacute;logo $id_catalogo eliminado exitosamente" );
		echo '<div class="exito mensajes">¡Confirmado!, Cat&aacute;logo eliminado exitosamente</div>';
		}
	else{
	
		//mensaje( "¡Confirmado!","Cat&aacute;logo ".limpia( $_POST['id_catalogo'] )." ingresado exitosamente" );		
		echo pg_last_error($conn);
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


/**
* Muestra un mensaje en un entorno mas vistoso
*/

function mensaje_( $texto ){
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

function limpia( $cadena )
{
	$cadena=strip_tags($cadena);
	//$cadena = str_replace("!","",$cadena);
	$cadena = str_replace("¡","",$cadena);
	//$cadena = str_replace("#","",$cadena);
	//$cadena = str_replace("$","",$cadena);
	//$cadena = str_replace("%","",$cadena);
	//$cadena = str_replace("=","",$cadena);
	//$cadena = str_replace("¿","",$cadena);
	$cadena = str_replace("?","",$cadena);
	//$cadena = str_replace("¡","",$cadena);
	$cadena = str_replace("ç","",$cadena);
	/*$cadena = str_replace("}","",$cadena);
	$cadena = str_replace("{","",$cadena);*/
	//$cadena = str_replace("+","_",$cadena);
	/*$cadena = str_replace("]","",$cadena);
	$cadena = str_replace("[","",$cadena);*/
	$cadena = str_replace("`","",$cadena);
	$cadena = str_replace(";","",$cadena);
	$cadena = str_replace("*","",$cadena);
	$cadena = str_replace("\'","",$cadena);	
	$cadena = str_replace('\"',"",$cadena);
	$cadena = str_replace("\\\\","",$cadena);
	$cadena = str_replace("'","",$cadena);
	$cadena = str_replace("&","",$cadena);
	$cadena = str_replace("<","",$cadena);
	$cadena = str_replace(">","",$cadena);
	$cadena = str_replace('"',"",$cadena);
	/*$cadena = str_replace('“',"&#34",$cadena);
	$cadena = str_replace('”',"&#34",$cadena);*/	
	$cadena = str_replace('“',"",$cadena);
	$cadena = str_replace('”',"",$cadena);	
	$cadena = str_replace('|',"",$cadena);
	//$cadena = str_replace(':',"",$cadena);
	$cadena = str_replace("insert","",$cadena);
	$cadena = str_replace("select","",$cadena);
	$cadena = str_replace("update","",$cadena);
	$cadena = str_replace("delete","",$cadena);
	$cadena = str_replace("union","",$cadena);
	$cadena = str_replace("ñ","nh",$cadena);
	/*$cadena = str_replace("(","",$cadena);
	$cadena = str_replace(")","",$cadena);*/
	//$cadena = str_replace(",","",$cadena);
	$cadena = str_replace("a:","",$cadena);
	$cadena = str_replace("A:","",$cadena);
	$cadena = str_replace("b:","",$cadena);
	$cadena = str_replace("B:","",$cadena);
	$cadena = str_replace("c:","",$cadena);
	$cadena = str_replace("C:","",$cadena);
	$cadena = str_replace("d:","",$cadena);
	$cadena = str_replace("D:","",$cadena);
	$cadena = str_replace("e:","",$cadena);
	$cadena = str_replace("E:","",$cadena);
	$cadena = str_replace("f:","",$cadena);
	$cadena = str_replace("F:","",$cadena);
	$cadena = str_replace("g:","",$cadena);
	$cadena = str_replace("G:","",$cadena);
	$cadena = str_replace("h:","",$cadena);
	$cadena = str_replace("H:","",$cadena);
	$cadena = str_replace("i:","",$cadena);
	$cadena = str_replace("I:","",$cadena);
	
	// $cadena = str_replace("á","a",$cadena);
	// $cadena = str_replace("é","e",$cadena);
	// $cadena = str_replace("í","i",$cadena);
	// $cadena = str_replace("ó","o",$cadena);
	// $cadena = str_replace("ú","u",$cadena);
	
	// $cadena = str_replace("Á","A",$cadena);
	// $cadena = str_replace("É","E",$cadena);
	// $cadena = str_replace("Í","I",$cadena);
	// $cadena = str_replace("Ó","O",$cadena);
	// $cadena = str_replace("Ú","U",$cadena);
	
	return $cadena;
}

/**
* Permite eliminar el codigo malicioso, comando sql y esas cosas.
*/
/*function limpia($cadena)
{
	$malo = array("insert","select","update","delete","'","(",")", ",","b:", "a:", "'", "c:", "d:","e:", "C:", "D:", "E:");
	$bueno   = array("", "", "","","","","","_","", "", "", "", "", "", "", "", "");
	$cadena = str_replace($malo, $bueno, $cadena);
	return $cadena;
}*/

/**
* Elimina caracteres no deseados de los directorios leidos
*/
/*function limpiaCad( $cadena )
{
	$malo = array( "b:", "a:", "'", "c:", "d:","e:", "C:", "D:", "E:" );
	$bueno   = array( "", "", "", "", "", "", "", "", "" );
	$cadena = str_replace($malo, $bueno, $cadena);
	return $cadena;
}*/


/**
* Genera el formulario para modificar el nombre del catalogo
*/
function modificar( $id_cat )
{
	include "conn.php";//conexion a postgresql    
	$conn = pg_connect("host=$dbhost port=$dbport dbname=$dbname user=$dbuser password=$dbpass") or die('<div width="100%" class="error">OCURRIO UN ERROR AL INTENTAR CONECTAR A LA BASE DE DATOS <B>'. $dbname.' </B></div>');

	//$busca = "SELECT * FROM actividad WHERE id_actividad = '$id'";	
	$busca = "
	SELECT id_catalogo 
	FROM catalogo
	WHERE id_cat='$id_cat'
	";
	
	$result= pg_query( $conn,$busca );
	
	if( $row = pg_fetch_array($result) ){
		$id_catalogo = $row['id_catalogo'];
		//$ubicacion = $row['ubicacion'];
		echo '
		<form name="form1" autocomplete="off" method="post" action="'.$_SERVER[PHP_SELF].'?menu=act&accion=mod">
                    <table width="700" border="0" cellspacing="0" cellpadding="0">
                      <tr bgcolor="#d2d2e4" class="Estilo7"> 
                        <td colspan="3"><strong>Modificaci&oacute;n para Cat&aacute;logo: '.$id_catalogo.'</strong></td>
                      </tr>
					  <tr bgcolor="#eaeaf2" class="Estilo7"> 
                 		<td colspan="3">&nbsp;</td>
                      </tr>
					<input name="id_cat" id="id_cat" type="hidden" value="'.$id_cat.'">
					<tr bgcolor="#eaeaf2" class="Estilo7"> 
                    <td width="140"><b>Nombre del cat&aacute;logo</b></td>
					<td width="2">:</td>
					<td><input name="id_catalogo" type="text" id="id_catalogo" value="'.$id_catalogo.'" size="50" maxlength="50">
					<span id="comprobar_mensaje">
					</span></td>
                    </tr>
					<tr bgcolor="#eaeaf2" class="Estilo7"> 
                    <td width="140" valign="top"><b>Ubicaci&oacute;n</b></td>
					<td width="2" valign="top">:</td>
					<td >
						<select name="ubicacion" id="ubicacion">';
							//Consulta para obtener las ubicaciones
							$query_ubicaciones = "select * from ubicacion order by id_ubicacion";	
							//Ejecutando la consulta
							$result_ubicaciones= pg_query($conn,$query_ubicaciones)or die('Query failed: ' . pg_last_error());
							//Agregando las ubicaciones al Select
							while ( $row = pg_fetch_array( $result_ubicaciones ) )
							{
								echo'<OPTION VALUE="'.$row['id_ubicacion'].'">'.$row['id_ubicacion'].'</OPTION>';
							}
					echo'</select>
					</td>
                      </tr>					  
                      
                      <tr bgcolor="#eaeaf2" class="Estilo7"> 
                        <td colspan="3">&nbsp;</td>
                      </tr>
                      <tr bgcolor="#eaeaf2" class="Estilo7"> 
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
						
                        <td> <label class="uiButton uiButtonConfirm uiButtonLarge"><input type="submit" name="Submit" value="Guardar Cambios"></label>
						</td>						
                    </tr>
					<tr bgcolor="#eaeaf2" class="Estilo7"> 
                    <td colspan="3">&nbsp;</td>
					</tr>
               	</table>
            </form>
			';
		}
	else
		echo '<div class="error mensajes">Catálogo no encontrado.</div>';
		
	pg_close( $conn );
}


/**
* Funcion que modifica el nombre del catalogo 
*/
function mod( $id_cat, $id_catalogo, $ubicacion )
{
		//Agregando los datos de user, pass
		include "conn.php";
		//LLamando a la clase
		require_once "postgresql.php";
		//declarar el objeto de la clase base de dato
		$conexion = new Conexion($dbhost,$dbport,$dbname,$dbuser,$dbpass);
		
		/*switch($ubicacion){
		case 1:$ubicacion="Maletin Grande Negro";break;
		case 2:$ubicacion="Maletin Verde";break;
		case 3:$ubicacion="Maletin Grande Negro 2";break;
		default:break;
		}*/
		$camb= "UPDATE catalogo SET 
		         id_catalogo='$id_catalogo',
				 ubicacion='$ubicacion'
				 WHERE id_cat= '$id_cat'";
		
		$result = $conexion->Consulta($camb);

		if( !$result ) 
		{			
			echo '<div class="error mensajes">Error!, Cat&aacute;logo <b>'.$id_catalogo.'</b> ya existe en la base de datos</div>';
		}
		else
		{
			//mensaje("¡Confirmado!","Exitosamente modificado");
			echo '<div class="exito mensajes">¡Confirmado!, Cat&aacute;logo <b>'.$id_catalogo.'</b> Exitosamente modificado</div>';
		}
}


/**
* Rutina encargada de leer los directorios, subdirectorios y archivos de
* una determinada $ruta 
* $catalogo: catalogo al que corresponden los archivos
* $ruta: ruta a leer
*/
function listar_directorios_ruta( $catalogo,$ruta )
{
	header("Content-type: text/html; charset=UTF-8");
   // abrir un directorio y listarlo recursivo

   if (is_dir($ruta)) {
      if ($dh = opendir($ruta)) {
         while (($file = readdir($dh)) !== false) {
            
			//esta línea la utilizaríamos si queremos listar todo lo que hay en el directorio
            //mostraría tanto archivos como directorios
			if ($file!='.' && $file!='..')
			{								
				include "conn.php";//conexion a postgresql    
				$conn = pg_connect("host=$dbhost port=$dbport dbname=$dbname user=$dbuser password=$dbpass") or die('<div width="100%" class="error">OCURRIO UN ERROR AL INTENTAR CONECTAR A LA BASE DE DATOS <B>'. $dbname.' </B></div>');
				
				$filetype=filetype($ruta . $file);
				
				switch($filetype)
				{
					case 'dir':	$extension='dir';
								$size=sprintf("%u", dirSize($ruta . $file));
								break;
					//Obteniendo la extension del archivo
					default:
						//try{
						$extension = strtolower( substr ( strrchr ($ruta . $file, "."),1) );
						//Lee correctamente archivos mayores a 4GB
						$size=GetRealSize($ruta . $file);
						break;
				}

				$file_temp=strtolower( limpia( $file ) );
				$ruta_temp=strtolower( limpia( $ruta ) );
				
				//String para ingresar el archivo
				$query="insert into archivo values('$catalogo','$file_temp','$size','$extension','$ruta_temp');";
				if($debug)
					echo $query."<br>";
				
				//Ingresando el archivo
				$result = pg_query($conn,$query);
				if (!$result) {
					  mensaje( "Nombre Archivo: ".$file_temp , pg_last_error($conn) );
					}
				pg_close($conn);				
			}
			//if para saber si el elemento es un directorio 
            if (is_dir($ruta . $file) && $file!="." && $file!=".."){
               //solo si el archivo es un directorio, distinto que "." y ".."
               //echo "<br>Directorio: $ruta$file";
               listar_directorios_ruta($catalogo,$ruta . $file . "/");
            }
         }
      closedir($dh);
      }
   }else
      echo "<br>No es ruta valida" + $ruta;
}


function generaHrefdelBocadilloVistoso( $href, $row_mostrar, $label, $mensaje)
{
	$detalle="<a class=\"infoP\" target=\"_blank\" href=\"".$href."\">".$row_mostrar."</a>";
	$detalle.="<span class=\"tooltip\"><span class=\"highlight\">"."$label</span><br>$mensaje</span>";
	return $detalle;
}

function generaHrefdelBocadilloVistoso_Preview( $row_mostrar, $label, $mensaje)
{
	$detalle="<a class=\"infoP\">".$row_mostrar."</a>";
	$detalle.="<span class=\"tooltip\"><span class=\"highlight\">"."$label</span><br>$mensaje</span>";
	return $detalle;
}

function myUrlEncode($string) {
    $replacements = array('%21', '%2A', '%27', '%28', '%29', '%3B', '%3A', '%40', '%26', '%3D', '%2B', '%24', '%2C', '%2F', '%3F', '%25', '%23', '%5B', '%5D');
    $entities = array('!', '*', "'", "(", ")", ";", ":", "@", "&", "=", "+", "$", ",", "/", "?", "%", "#", "[", "]");
    return str_replace($entities, $replacements, urlencode($string));
}

function myUrlDecode($string) {
    $entities = array('%21', '%2A', '%27', '%28', '%29', '%3B', '%3A', '%40', '%26', '%3D', '%2B', '%24', '%2C', '%2F', '%3F', '%25', '%23', '%5B', '%5D');
    $replacements = array('!', '*', "'", "(", ")", ";", ":", "@", "&", "=", "+", "$", ",", "/", "?", "%", "#", "[", "]");
    return str_replace($entities, $replacements, urlencode($string));
}


/**
* Genera la lista de todos los catalogos con opciones. Usado en gestion_catalogos.php
*/
function listarCatalogos( $_pagi_Lim, $busca, $id_usuario )
{

	include "conn.php";//conexion a postgresql    
	$conn = pg_connect("host=$dbhost port=$dbport dbname=$dbname user=$dbuser password=$dbpass") or die('<div width="100%" class="error">OCURRIO UN ERROR AL INTENTAR CONECTAR A LA BASE DE DATOS <B>'. $dbname.' </B></div>');
	
	if(!$conn){
		echo "<tr>";
		echo "<td colspan='3' bgcolor='#F7F8ED'><div class='Estilo7'>X Error al conectarce a la Base de Datos</div></td>";
		echo "</tr>";
		exit();
		}

	$contador=1;

	$busca.=$_pagi_Lim;

	$result = pg_query( $conn,$busca );

	if(!$result) {
		echo "<tr>";
		echo "<td colspan='3' bgcolor='#F7F8ED'><div class='Estilo7'>X Error al buscar en la Bases de Datos</div></td>";
		echo "</tr>";
		exit();
		}
	//Contando catalogos del usuario
	$contar_catalogos = "select count(*) from catalogo where id_usuario = '$id_usuario'";
	$total= pg_query($conn,$contar_catalogos);
	list($total_catalogos) = pg_fetch_array($total);
	
	//Contando archivos del usuario
	$contar_archivos="select count(*) from usuario u, catalogo c, archivo a where a.id_catalogo = c.id_catalogo and c.id_usuario=u.id and u.id = '$id_usuario'";
	$total= pg_query($conn,$contar_archivos);
	list($total_archivos) = pg_fetch_array($total);
	
	//Contando tamaño total de archivo 
	$total_tam="select sum(tamanho) as suma from archivo where extension <> 'dir'";
	$total_tam= pg_query($conn,$total_tam);
	$total_tam = pg_fetch_array($total_tam);
	$total_tam= formatBytes($total_tam['suma']);
	
	//echo $total_catalogos;
	echo "<table width='710' border='0' cellspacing='0' >";
	echo "<tr>";
	echo "<td colspan='3' bgcolor='#d2d2e4'><div class='Estilo7'><strong>LISTADO DE CATALOGOS</strong></div> </td>";	
	echo "</tr>";

	echo "<tr>";
	echo "<td colspan='3' bgcolor='#eaeaf2'><div class='Estilo7'><strong>TOTAL CATALOGOS: ".$total_catalogos ."</strong></div> </td>";
	echo "</tr>";
	
	echo "<tr>";
	echo "<td colspan='3' bgcolor='#eaeaf2'><div class='Estilo7'><strong>TOTAL ARCHIVOS: ".$total_archivos ."</strong></div> </td>";
	echo "</tr>";
	
	echo "<tr>";
	echo "<td colspan='3' bgcolor='#eaeaf2'><div class='Estilo7'><strong>TAMAÑO TOTAL: ".$total_tam ."</strong></div> </td>";
	echo "</tr>";

	$color1 = "#eaeaf2";//claro   F7F8ED
	$color2 = "#d2d2e4";//oscuro  E7E7CF

	echo "<tr>";
	echo "<td bgcolor=#d2d2e4 height='25'><div class='Estilo7'><b>NOMBRE CATALOGO</b></div></td>";
	echo "<td bgcolor=#d2d2e4 height='25'><div class='Estilo7'><b>UBICACION</b></div></td>";
	echo "<td width='140' bgcolor=#d2d2e4 height='25'><div class='Estilo7'><b>OPCIONES</b></div></td>";
	echo "</tr>";

	while ($row = pg_fetch_array($result)){
	
	//echo rawurlencode  ( $row["id_catalogo"] ) . "<br>"  ;

	$detalle = generaHrefdelBocadilloVistoso ( "detalle_catalogo.php?accion=ver&amp;id_catalogo=". rawurlencode ( $row["id_catalogo"]), 
												$row['id_catalogo'],
												"Catalogo: ".$row['id_catalogo'], 
												"Click para mostrar detalles ..." 
											  );

	$contador++;
	if(($contador%2) == 0)$color = $color1;
		else $color = $color2;
	
	//Hace que aparesca un cuadro preguntando antes de borrar
	$Confirm_js = 'onclick = "if (! confirm(\'Confirma eliminar el catálogo?\')) return false;"' ;
	
	echo "<tr>";
	//echo "<td width='30' bgcolor=$color height='25'><div class='Estilo7'>$row[id_catalogo]</div></td>";
	echo "<td width='210' bgcolor=$color height='25'><div class='Estilo7'><b>$detalle</b></div></td>";
	echo "<td width='220' bgcolor=$color height='25'><div class='Estilo7'>".$row['ubicacion']."</div></td>";
	//echo "<td width='30' bgcolor=$color height='25'><div class='Estilo7'>$row[nombre]</div></td>";
	echo "<td width='100' bgcolor=$color height='25'><div class='Estilo7' >
	<a href='gestion_catalogos.php?menu=act&amp;accion=modificar&amp;id_cat=".$row['id_cat']."'><font color=\"#0000FF\"><strong>[Modificar]</strong></font></a>		
	<a href='gestion_catalogos.php?menu=act&amp;accion=del&amp;id_cat=".$row['id_cat']."' ".$Confirm_js."><strong><font color=\"#FF0000\">[Eliminar]</font></strong></a> 
	
	</div>
	</td>";
	echo "</tr>";
	}
	echo "</table>";
	echo "<br>";
	pg_close($conn);
}

/**
* Rutina que se encarga de buscar y mostrar los resultados
* $_pagi_Lim: contiene el LIMIT y OFFSET  de la consulta sql
* $busca: tiene el select que se consultara, dependera de si se busca un
*          directorio o un archivo.
*/
function Buscar( $_pagi_Lim,$busca )
{
	$ruta_iconos="iconos/";
	
	echo "<table width='650' border='0' cellspacing='0' cellpadding='0'>";
	
	include "conn.php";//conexion a postgresql    
	$conn = pg_connect("host=$dbhost port=$dbport dbname=$dbname user=$dbuser password=$dbpass") 
			or die('<div width="100%" class="error">OCURRIO UN ERROR AL INTENTAR CONECTAR A LA BASE DE DATOS <B>'. $dbname.' </B></div>');
	
	//$limit se usa para el LIMIT  OFFSET en la parte where de la consulta
	$busca.=$_pagi_Lim;
	$result= pg_query($conn,$busca)or die('Query failed: ' . pg_last_error());
	
	while ( $row = pg_fetch_array( $result ) )
	{
	
	//Esto agrega un icono segun sea la extension
	switch( strtolower( $row["extension"]) )
	{
	case 'ogg':$img="<img src=\"".$ruta_iconos."ogg.png\" >";
				break;
	case 'rar':$img="<img src=\"".$ruta_iconos."rar.png\" >";
				break;
	case 'aac':$img="<img src=\"".$ruta_iconos."aac.png\" >";
				break;
	case 'avi':$img="<img src=\"".$ruta_iconos."avi.png\" >";
				break;
	case 'jpg':$img="<img src=\"".$ruta_iconos."jpg.png\" >";
				break;
	case 'exe':$img="<img src=\"".$ruta_iconos."msi.png\" >";
				break;
	case 'dir':$img="<img src=\"".$ruta_iconos."dir.png\" >";
				break;
	case 'png':$img="<img src=\"".$ruta_iconos."jpg.png\" >";
				break;
	case 'pcx':$img="<img src=\"".$ruta_iconos."pcx.png\" >";
				break;
	case 'ppt':$img="<img src=\"".$ruta_iconos."ppt.png\" >";
				break;
	case 'pps':$img="<img src=\"".$ruta_iconos."ppt.png\" >";
				break;
	case 'mp3':$img="<img src=\"".$ruta_iconos."aac.png\" >";
				break;
	case 'pdf':$img="<img src=\"".$ruta_iconos."pdf.png\" >";
				break;
	case 'flv':$img="<img src=\"".$ruta_iconos."flv.png\" >";
				break;
	case 'mp4':$img="<img src=\"".$ruta_iconos."mp4.png\" >";
				break;
	case 'iso':$img="<img src=\"".$ruta_iconos."iso.png\" >";
				break;
	case 'scm':$img="<img src=\"".$ruta_iconos."scm.png\" >";
				break;
	case 'scx':$img="<img src=\"".$ruta_iconos."scx.png\" >";
				break;
	case 'mdf':$img="<img src=\"".$ruta_iconos."mdf.png\" >";
				break;
	case 'dll':$img="<img src=\"".$ruta_iconos."dll.png\" >";
				break;
	case 'doc':$img="<img src=\"".$ruta_iconos."doc.png\" >";
				break;
	case 'zip':$img="<img src=\"".$ruta_iconos."zip.png\" >";
				break;
	case 'tml':$img="<img src=\"".$ruta_iconos."html.png\" >";
				break;
	case 'htm':$img="<img src=\"".$ruta_iconos."htm.png\" >";
				break;
	case 'rep':$img="<img src=\"".$ruta_iconos."rep.png\" >";
				break;
	case 'cbr':$img="<img src=\"".$ruta_iconos."cbr.png\" >";
				break;
	case 'cbz':$img="<img src=\"".$ruta_iconos."cbr.png\" >";
				break;
	case 'wmv':$img="<img src=\"".$ruta_iconos."wmv.png\" >";
				break;
	case 'bz2':$img="<img src=\"".$ruta_iconos."bz2.png\" >";
				break;
	case 'gz':$img="<img src=\"".$ruta_iconos."gz.png\" >";
				break;
	case 'jar':$img="<img src=\"".$ruta_iconos."jar.png\" >";
				break;	
	case 'msi':$img="<img src=\"".$ruta_iconos."msi.png\" >";
				break;
	case 'srt':$img="<img src=\"".$ruta_iconos."srt.png\" >";
				break;
	case 'mkv':$img="<img src=\"".$ruta_iconos."mkv.png\" >";
				break;
	default:$img="<img src=\"iconos/default.png\" >";
				break;
	}

	//Esto genera una vistosa imagen
	$detalle = generaHrefdelBocadilloVistoso ( "detalle_catalogo.php?accion=ver&amp;id_catalogo=". rawurlencode ($row['id_catalogo']),
												$row["id_catalogo"],
												"Ubicacion del cat&aacute;logo: ".$row["ubicacion"],
												"Click para mostrar detalles del cat&aacute;logo..." );

	//esto generara los subdirectorios
	switch( $row["extension"] )
	{
	case 'dir':
			$tamanho=formatBytes( $row["tamanho"] );
			
			if ($row["ruta"] == '/' )
				$temp = '[Raiz]   ';
			else
				$temp = '';
			$ruta = generaHrefdelBocadilloVistoso ( "detalle_subcarpeta.php?accion=ver&amp;id_catalogo=". rawurlencode ( $row["id_catalogo"] )."&amp;id_ruta=".$row["ruta"].$row["nombre_archivo"].'/',
													$temp.$row["ruta"],
													"Ruta: ".$row["ruta"],
													"Click para mostrar detalles ..." );
			echo " 
				<tr>
				<td colspan='3' bgcolor='#d2d2e4'><div class='Estilo7'>$img".$row["nombre_archivo"]."</div></td>	
				</tr>				

				<tr>
					<td  bgcolor='#eaeaf2' align='left' valign='middle'><div class='Estilo7'><img src=\"iconos/catalogo.png\" ><strong>Cat&aacute;logo: </strong> ".$detalle."</div></td>
    				<td  bgcolor='#eaeaf2' align='left' valign='middle'><div class='Estilo7'></div></td>
  				</tr>
				
				<tr>
					<td  bgcolor=\"#d2d2e4\" align='left' valign='middle'><div class='Estilo7'><strong>Tama&ntilde;o: </strong>".$tamanho." </div></td>
    				<td  bgcolor=\"#d2d2e4\" align='left' valign='middle'><div class='Estilo7'></div></td>
  				</tr>
				
				<tr>
					<td  bgcolor='#eaeaf2' align='left' valign='middle'><div class='Estilo7'><img src=\"iconos/folder.png\" ><strong>Ruta:</strong> ".$ruta."</div></td>
    				<td  bgcolor='#eaeaf2' align='left' valign='middle'><div class='Estilo7'></div></td>
  				</tr>
				<tr>
					<td  align='left' valign='middle'><div class='Estilo7'><br></div></td>
    				<td  align='left' valign='middle'><div class='Estilo7'><br></div></td>
  				</tr>				
				";
			break;
	
	case 'flv':
	case 'avi':
	case 'mp4':
	case 'mkv':
	case 'rmvb':
	case 'wmv':

		
		$prefix_preview="../preview/";
		
		$imagen_preview = $prefix_preview.$row["nombre_archivo"] . '.jpg';
		
		if ( file_exists ( $imagen_preview ) )
			$preview = generaHrefdelBocadilloVistoso_Preview ( "<b>Hover me ;D</b>",
															   "Preview ...",
															   "<img WIDTH=270 src=\"$imagen_preview\">" );

	    else
			$preview = '[No Disponible D:]';

		//Dando formato a la salida, probando codigos
		$tamanho=formatBytes( $row["tamanho"] );

		$ruta = generaHrefdelBocadilloVistoso (     "detalle_subcarpeta.php?accion=ver&amp;id_catalogo=". rawurlencode ($row["id_catalogo"])."&amp;id_ruta=".$row["ruta"],
													$row["ruta"],
													"Ruta: ".$row["ruta"],
													"Click para mostrar detalles ..." );
		
		echo " <tr>
	           <td colspan='3' bgcolor='#d2d2e4'><div class='Estilo7'><strong>$img ".$row["nombre_archivo"]."</strong></div></td>	
				</tr>
				<tr>
					<td  bgcolor='#eaeaf2' align='left' valign='middle'><div class='Estilo7'><img src=\"iconos/catalogo.png\" ><strong>Cat&aacute;logo: </strong>".$detalle." </div></td>
    				<td  bgcolor='#eaeaf2' align='left' valign='middle'><div class='Estilo7'></div></td>
  				</tr>				
				
				<tr>
					<td  bgcolor=\"#d2d2e4\" align='left' valign='middle'><div class='Estilo7'><strong>Tama&ntilde;o: </strong>".$tamanho." </div></td>
    				<td  bgcolor=\"#d2d2e4\" align='left' valign='middle'><div class='Estilo7'></div></td>
  				</tr>				
				<tr>
					<td  bgcolor='#eaeaf2' align='left' valign='middle'><div class='Estilo7'><img src=\"iconos/folder.png\" ><strong>Ruta:</strong> ".$ruta."</div></td>
    				<td  bgcolor='#eaeaf2' align='left' valign='middle'><div class='Estilo7'></div></td>
  				</tr>
				<tr>
					<td  bgcolor=\"#d2d2e4\" align='left' valign='middle'><div class='Estilo7'><strong>Preview: </strong>".$preview." </div></td>
    				<td  bgcolor=\"#d2d2e4\" align='left' valign='middle'><div class='Estilo7'></div></td>
  				</tr>
				<tr>
					<td  align='left' valign='middle'><div class='Estilo7'><br></div></td>
    				<td  align='left' valign='middle'><div class='Estilo7'><br></div></td>
  				</tr>				
				";
				break;
	default:
			if ($row["ruta"] == '/' )
				$temp = '[Raiz]   ';
			else
				$temp = '';

			//Dando formato a la salida, probando codigos
			$tamanho=formatBytes( $row["tamanho"] );

			$ruta = generaHrefdelBocadilloVistoso ( "detalle_subcarpeta.php?accion=ver&amp;id_catalogo=".rawurlencode ( $row["id_catalogo"] )."&amp;id_ruta=".$row["ruta"],
													$temp.$row["ruta"],
													"Ruta: ".$row["ruta"],
													"Click para mostrar detalles ..." );

	echo " <tr>
	           <td colspan='3' bgcolor='#d2d2e4'><div class='Estilo7'><strong>$img ".$row["nombre_archivo"]."</strong></div></td>	
				</tr>
				<tr>
					<td  bgcolor='#eaeaf2' align='left' valign='middle'><div class='Estilo7'><img src=\"iconos/catalogo.png\" ><strong>Cat&aacute;logo: </strong>".$detalle." </div></td>
    				<td  bgcolor='#eaeaf2' align='left' valign='middle'><div class='Estilo7'></div></td>
  				</tr>				
				
				<tr>
					<td  bgcolor=\"#d2d2e4\" align='left' valign='middle'><div class='Estilo7'><strong>Tama&ntilde;o: </strong>".$tamanho." </div></td>
    				<td  bgcolor=\"#d2d2e4\" align='left' valign='middle'><div class='Estilo7'></div></td>
  				</tr>

				<tr>
					<td  bgcolor='#eaeaf2' align='left' valign='middle'><div class='Estilo7'><img src=\"iconos/folder.png\" ><strong>Ruta:</strong> ".$ruta."</div></td>
    				<td  bgcolor='#eaeaf2' align='left' valign='middle'><div class='Estilo7'></div></td>
  				</tr>
				<tr>
					<td  align='left' valign='middle'><div class='Estilo7'><br></div></td>
    				<td  align='left' valign='middle'><div class='Estilo7'><br></div></td>
  				</tr>				
				";
				break;
	}
	}
	
	unset ($result);
	
	echo"</table><br>";
	pg_close( $conn );
}

function conversor_segundos($seg_ini) 
{
	$horas = floor($seg_ini/3600);
	$minutos = floor(($seg_ini-($horas*3600))/60);
	$segundos = $seg_ini-($horas*3600)-($minutos*60);
	$duracion = $horas.'h:'.$minutos.'m:'.$segundos.'s';
	return $duracion;

}
/**
 * Get the directory size
 * @param directory $directory
 * @return integer
 */
function dirSize($directory) {
	try{
		$size = 0;
		foreach(new RecursiveIteratorIterator(new RecursiveDirectoryIterator($directory)) as $file){
			$size+=$file->getSize();
		}
	} catch (Exception $e) {
		echo 'Excepción capturada al intentar obtener tamaño: ',  $e->getMessage(), "\n";
		$size = 0;
	}
    return $size;
}

    function GetRealSize($file) {
		if (file_exists($file)) {
			//Fix 4Gb limit. ( Now limit 8 Gb ;))		
			clearstatcache();
			$INT = 4294967295;//2147483647+2147483647+1;
			$size = filesize($file);
			$fp = fopen($file, 'r');
			fseek($fp, 0, SEEK_END);
			if (ftell($fp)==0) $size += $INT;
			fclose($file);
			if ($size<0) $size += $INT;
		}
		else
			$size = 0;
        return $size;
    }

function formatBytes($b,$p = null) {
    /**
     *
     * @author Martin Sweeny
     * @version 2010.0617
     *
     * returns formatted number of bytes.
     * two parameters: the bytes and the precision (optional).
     * if no precision is set, function will determine clean
     * result automatically.
     *
     **/
    $units = array("B","kB","MB","GB","TB","PB","EB","ZB","YB");
    $c=0;
    if(!$p && $p !== 0) {
        foreach($units as $k => $u) {
            if(($b / pow(1024,$k)) >= 1) {
                $r["bytes"] = $b / pow(1024,$k);
                $r["units"] = $u;
                $c++;
            }
        }
        return number_format($r["bytes"],2) . " " . $r["units"];
    } else {
        return number_format($b / pow(1024,$p)) . " " . $units[$p];
    }
}

function format_size($size) {
      $sizes = array(" Bytes", " KB", " MB", " GB", " TB", " PB", " EB", " ZB", " YB");
      if ($size == 0) { return('n/a'); } else {
      return (round($size/pow(1024, ($i = floor(log($size, 1024)))), 2) . $sizes[$i]); }
}


/**
* Funcion que retorna una version mas legible del tamaño de un archivo, clasificando segun sea en bytes , mb o en gb
* $bytes: tamaño del archivo en bytes
* $tamanho: string con formato que contiene el tamaño mas la unidad de medida
*/
function getTam( $bytes )
{
	 if ( $bytes >=0 && $bytes < 1024) {
		$tamanho= $bytes . " Bytes";
	 } elseif ( $bytes >=1024 &&  $bytes< 1048576 ) {
		$tamanho= ceil( ($bytes / 1024) ) . " KB";
	 } elseif ( $bytes >= 1048576 && $bytes < 1073741824 ) {
	     $tamanho= round( ($bytes / 1048576) ,2 ) . " MB";
	 }
	 else {
	     $tamanho= round ( ($bytes / 1073741824) ,2 ) . " GB";
	 }
	return $tamanho;
}


/**
* Ingresa el id del catalogo en la tabla catalogo
*/
function agregarCatalogo2( $id_usuario, $id_catalogo, $ubicacion )
{
	if ( !empty( $id_catalogo ) )
	{
		//seleccionando el tipo de formato
		/*switch($op_ubicacion){
		case 1:$ubicacion="Maletin Grande Negro";break;
		case 2:$ubicacion="Maletin Verde";break;
		case 3:$ubicacion="Maletin Grande Negro 2";break;
		default:break;
		}*/
		include "conn.php";//conexion a postgresql    
		$conn = pg_connect("host=$dbhost port=$dbport dbname=$dbname user=$dbuser password=$dbpass") or die('<div width="100%" class="error">OCURRIO UN ERROR AL INTENTAR CONECTAR A LA BASE DE DATOS <B>'. $dbname.' </B></div>');
		$query = "insert into catalogo values('$id_catalogo','$ubicacion','$id_usuario');";		
		if ( pg_query( $conn,$query ) )
			$error=false;
		else
			$error=true;
		pg_close( $conn );
	}
	return $error;
}


/**
* Ingresa el id del catalogo en la tabla catalogo
*/
function agregarCatalogo( $id_usuario, $id_catalogo, $ubicacion )
{
	if ( !empty( $id_catalogo ) )
	{
		//Agregando los datos de user, pass
		include "conn.php";
		//LLamando a la clase
		require_once "postgresql.php";
		//declarar el objeto de la clase base de dato
		$conexion = new Conexion($dbhost,$dbport,$dbname,$dbuser,$dbpass);
		
		$query = "insert into catalogo values('$id_catalogo','$ubicacion','$id_usuario');";

		$result = $conexion->Consulta($query);
		
		if ( $result  )
			$error=false;
		else
			$error=true;
		/*echo pg_last_error( $conn );*/
		//pg_close( $conn );
	}
	return $error;
}

/**
* Genera el Formulario que lee la entrada del usuario en index.php, luego se 
* procede a la busqueda.
*/
function AgregarFormularioBusqueda($busqueda="")
{

//En alguna parte saque name="Submit"

echo '
		<form  id="FormularioBusqueda" name="FormularioBusqueda" method="get" action="search.php" autocomplete="off">
			<table width="600" border="0" cellspacing="0" cellpadding="0" bgcolor="#eaeaf2">
				
				<tr class="Estilo7">
					<td colspan="3" bgcolor="#d2d2e4"> <div class="Estilo7"><strong>Buscar Archivos o Documentos ...</strong></div></td>
					<td colspan="3" bgcolor="#d2d2e4"></td>
				</tr>
				<tr class="Estilo7"> 
					<td colspan="3">&nbsp;</td>
					
				</tr>
				<tr class="Estilo7"> 
					<td width="70"></td>
					<td width="367"><input class="required" type="text" value="'.$busqueda.'" id="txtSearch" name="txtSearch" alt="Search Criteria" onkeyup="searchSuggest();" size="60" maxlength="69" ><div id="search_suggest"></div>					
					<td width="70"></td>
					<td width="130"><label class="uiButton uiButtonConfirm uiButtonLarge"><input type="button" onclick="location=\'busqueda_avanzada.php\'" value="B&uacute;squeda avanzada" ></label></td>					
				</tr>				
				<tr class="Estilo7">
					<td colspan="3">&nbsp;</td>
					<td colspan="3">&nbsp;</td>
					<td colspan="3">&nbsp;</td>
				</tr>				
				<tr class="Estilo7"> 
					<td>&nbsp;</td>					
					<td><label class="uiButton uiButtonSpecial uiButtonLarge"><input type="submit" value="Buscar"></label>
						<label class="uiButton uiButtonDefault uiButtonLarge"><input type="button" onclick=\'return limpiar("")\' value="Limpiar"></label>
				</tr>

				<tr class="Estilo7">
					<td colspan="3">&nbsp;</td>
					<td colspan="3">&nbsp;</td>
					<td colspan="3">&nbsp;</td>
				</tr>
			</table>
			
        </form>
		';
}

function FormularioBusquedaAvanzada()
{
	echo '
		<form id="FormularioBusquedaAvanzada" name="FormularioBusquedaAvanzada" method="get" action="search.php" autocomplete="off">
			<table width="600" border="0" cellspacing="0" cellpadding="0" bgcolor="#eaeaf2">
				<tr class="Estilo7"> 
					<td colspan="3" bgcolor="#d2d2e4"> <div class="Estilo7"><strong>B&uacute;squeda avanzada</strong></div>
					<input name="accion" id="accion" type="hidden" value="avanzada">
					</td>
				</tr>

				

				<tr class="Estilo7">				
					<td colspan="3">&nbsp;</td>
				</tr>
				
				<tr class="Estilo7"> 
					<td width="140"><b>Nombre del archivo</b></td>
					<td width="2">:</td>
					<td ><input id="txtSearch" name="txtSearch" type="text" size="50" maxlength="50"> <b>(Obligatorio) </b>
					</td>
				</tr>
				
				<tr class="Estilo7"> 
					<td width="140" valign="top"><b>Fecha de cat&aacute;logo</b></td>
					<td width="2" valign="top">:</td>
					<td ><input name="id_catalogo" type="text" id="id_catalogo"  size="30" maxlength="25"> <b>Ej. 2009 </b></td> 
				</tr>
				
				<tr class="Estilo7"> 
					<td width="140" valign="top"><b>Tama&ntilde;o de archivo</b></td>
					<td width="2" valign="top">:</td>
					<td ><input name="tamanho_min" type="text" id="tamanho_min"  size="5" maxlength="5"> <= Tam <= <input name="tamanho_max" type="text" id="tamanho_max"  size="5" maxlength="5">   
							<select name="unidad" id="unidad"> 
							<OPTION VALUE="kb">KB</OPTION>
							<OPTION VALUE="mb">MB</OPTION>
							<OPTION VALUE="gb">GB</OPTION>
							</select>
							</td>
				</tr>

				<tr class="Estilo7">
					<td colspan="3"></td>
				</tr>

				<tr class="Estilo7">
					<td width="140" valign="top"><b>Tipo de Archivo</b></td>
					<td width="2" valign="top">:</td>				
					<td >
						<select name="extension" id="extension"> 
							<OPTION VALUE="cualquier">Cualquier formato</OPTION>
							<OPTION VALUE="avi">Audio-Video Interleaved (.avi)</OPTION>
							<OPTION VALUE="pdf">Adobe Acrobat PDF (.pdf)</OPTION>
							<OPTION VALUE="ps">Adobe Postscript (.ps)</OPTION>
							<OPTION VALUE="rar">Archivo Winrar (.rar)</OPTION>
							<OPTION VALUE="zip">Archivo Winzip (.zip)</OPTION>
							<OPTION VALUE="dir">Directorios (.dir)</OPTION>
							<OPTION VALUE="mkv">Matroska open audio/video container (.mkv)</OPTION>
							<OPTION VALUE="xls">Microsoft Excel (.xls)</OPTION>
							<OPTION VALUE="ppt">Microsoft Powerpoint (.ppt)</OPTION>
							<OPTION VALUE="doc">Microsoft Word (.doc)</OPTION>
							<OPTION VALUE="docx">Microsoft Word (.docx)</OPTION>
							<OPTION VALUE="iso">Imagen ISO (.iso)</OPTION>
							<OPTION VALUE="mp3">Winamp media file (.mp3)</OPTION>
						</select>
					</td>
				</tr>
		
				<tr class="Estilo7">
					<td colspan="3">&nbsp;</td>
				</tr>
				
				<tr class="Estilo7"> 
					<td>&nbsp;</td>
					<td>&nbsp;</td>					
					<td><label class="uiButton uiButtonConfirm uiButtonLarge"><input type="submit" value="B&uacute;squeda avanzada" ></label></td>
				</tr>
				
				<tr class="Estilo7"> 
					<td colspan="3">&nbsp;</td>
				</tr>
				<tr class="Estilo7"> 
					<td colspan="3">&nbsp;</td>
				</tr>				
				</table>

        </form>
		';
}


/** 
* Usado en upload.php, permite agregar un nuevo catalogo al sistema
*/
function FormularioCargarCatalogo()
{
	include "conn.php";//conexion a postgresql    
	$conn = pg_connect("host=$dbhost port=$dbport dbname=$dbname user=$dbuser password=$dbpass") 
			or die('<div width="100%" class="error">OCURRIO UN ERROR AL INTENTAR CONECTAR A LA BASE DE DATOS <B>'. $dbname.' </B></div>');
	
	$busca = "select * from ubicacion order by id_ubicacion";
	
	$result= pg_query($conn,$busca)or die('Query failed: ' . pg_last_error());
	
	
	echo '
		<form autocomplete="off" name="FormularioCargarCatalogo" method="post" action="upload.php?accion=agregar">
			<table width="700" border="0" cellspacing="0" cellpadding="0" bgcolor="#eaeaf2">
				<tr class="Estilo7"> 
					<td colspan="3" bgcolor="#d2d2e4"> <div class="Estilo7"><strong>AGREGAR NUEVO CATALOGO</strong></div></td>
				</tr>
				
				<tr class="Estilo7"> 
					<td colspan="3">&nbsp;</td>
				</tr>
				
				<tr class="Estilo7"> 
					<td width="140"><b>Nombre del cat&aacute;logo</b></td>
					<td width="2">:</td>
					<td ><input name="id_catalogo" onKeyUp="comprobar(this.value)" id="id_catalogo" type="text" size="50" maxlength="50">
					<span id="comprobar_mensaje">
					</span> </td>
				</tr>
				<tr class="Estilo7"> 
					<td width="140" valign="top"><b>Ruta</b></td>
					<td width="2" valign="top">:</td>
					<td ><input name="id_ruta" value="E:/" type="text" id="id_ruta"  size="30" maxlength="25"> <b>Ej. c:/dir/</b></td>
				</tr>
				<tr class="Estilo7">
					<td colspan="3"></td>
				</tr>
				<tr class="Estilo7">
					<td width="140" valign="top"><b>Ubicaci&oacute;n</b></td>
					<td width="2" valign="top">:</td>				
					<td >
						<select name="ubicacion" id="ubicacion">';						
							while ( $row = pg_fetch_array( $result ) )
							{
								echo'<OPTION VALUE="'.$row['id_ubicacion'].'">'.$row['id_ubicacion'].' - '.$row['descripcion'].'</OPTION>';
							}
					echo '</select>
					</td>
				</tr>
		
				<tr class="Estilo7">
					<td colspan="3">&nbsp;</td>
				</tr>
				
				<tr class="Estilo7"> 
					<td>&nbsp;</td>
					<td>&nbsp;</td>					
					<td><label class="uiButton uiButtonSpecial uiButtonLarge"><input type="submit" value="Agregar Cat&aacute;logo"  onclick="javascript:Cargar(\'upload.php?accion=agregar\');"  ></label></td>
				</tr>
				
				<tr class="Estilo7"> 
					<td colspan="3">&nbsp;</td>
				</tr>
				<tr class="Estilo7"> 
					<td colspan="3">&nbsp;</td>
				</tr>				
				</table>
				<table>
				<tr class="Estilo7">
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td width="367"><div id="preloader"></div></td>
				</tr>				
				</table>
        </form>
		';
}

?>