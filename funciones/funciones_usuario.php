<?php
function modUser($id,$nombre_usuario,$nombre,$password){

		if(empty($id) || empty($nombre_usuario) || empty($nombre) || empty($password))
			mensaje("Debe ingresar todos los datos requeridos");
		else
		{
		$password = md5(trim(htmlspecialchars($password)));
		
		include "conn.php";//conexion a postgresql    
		$conn = pg_connect("host=$dbhost port=$dbport dbname=$dbname user=$dbuser password=$dbpass") or die("Error al conectar la base de datos");
		
		$camb = "UPDATE usuario SET 
		         nombre_usuario='$nombre_usuario',
				 nombre='$nombre', 
				 pass='$password'
				 WHERE id= '$id'";
		
		//echo $camb;
		
		$result= pg_query($conn,$camb);
		if(!$result) 
		{
			mensaje("No se pudo modificar");
		}
		else{
			mensaje("¡Exito!","Los datos se actualizaron correctamente");			
			}
		pg_close($conn);
		}
}

function mensaje( $titulo,$texto ){

echo '
<div id="cuadro_mensaje_status" class="mobile_account_inlay">
<div id="standard_status" class="UIMessageBox status">
<h2 class="main_message">
<h2 class="asdf">'.$titulo.'</h2>
<p class="sub_message">
'.$texto.'
</p>
</div>
</div>

'
;

}

function modificarUsuario($id){
	include "conn.php";//conexion a postgresql    
	$conn = pg_connect("host=$dbhost port=$dbport dbname=$dbname user=$dbuser password=$dbpass") or die("Error al conectar la base de datos");

	$busca = "SELECT * FROM usuario WHERE id = '$id'";	
	$result= pg_query($conn,$busca);

	if($row = pg_fetch_array($result)){
		$id=$row['id'];
		$nombre_usuario=$row['nombre_usuario'];
		$nombre=$row["nombre"];
		//$direccion=$row["direccion"];
		//$telefono=$row["telefono"];
		//$celular=$row["celular"];
		//$email=$row["email"];
		//$usuario=$row["usuario"];
		//$edad=$row["edad"];

		echo '
		<form name="form1" method="post" action="'.$_SERVER[PHP_SELF].'?menu=act&accion=mod">
                    <table width="700" border="0" cellspacing="0" cellpadding="0">
                      <tr bgcolor="#d2d2e4" class="Estilo7"> 
                        <td colspan="3"><strong>Modificaci&oacute;n para '.$nombre.'</strong></td>
                      </tr>
					  <tr bgcolor="#eaeaf2" class="Estilo7"> 
                 		<td colspan="3">&nbsp;</td>
                      </tr>
					  <input name="id" type="hidden" value="'.$id.'">
					  
					  <tr bgcolor="#eaeaf2" class="Estilo7"> 
                        <td width="80">Usuario</td>
                        <td width="17">:</td>
                        <td width="300"><input name="nombre_usuario" type="text" id="nombre_usuario" value="'.$nombre_usuario.'" size="25" maxlength="12"> <b>Maximo 12 Caracteres</b></td>
                      </tr>
					  
					  <tr bgcolor="#eaeaf2" class="Estilo7"> 
                        <td width="80">Nombre</td>
                        <td width="17">:</td>
                        <td width="300"><input name="nombre" type="text" id="nombre" value="'.$nombre.'"  size="50" maxlength="50"></td>
                      </tr>
					 <tr bgcolor="#eaeaf2" class="Estilo7"> 
                        <td>Password</td>
                        <td>:</td>
                        <td> <input name="password" type="password" id="password" value="" size="30" maxlength="20"></td>
                      </tr>
                      
                      <tr bgcolor="#eaeaf2" class="Estilo7"> 
                        <td colspan="3">&nbsp;</td>
                      </tr>
                      <tr bgcolor="#eaeaf2" class="Estilo7"> 
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td><label class="uiButton uiButtonConfirm uiButtonLarge"><input type="submit" name="Submit" value="Guardar"></label>
						</td>
                      </tr>
					    <tr bgcolor="#eaeaf2" class="Estilo7"> 
                        <td colspan="3">&nbsp;</td>
                      </tr>
               	</table>
            </form>
			';
		}

	//else
		//echo "$id NO encontrado en la base de datos";
	//	mensaje("Debes iniciar nuevamente sesion para que los cambios tomen efecto");
		
	pg_close($conn);
}
	

function verUsuario($rut){
	
	include "conn.php";//conexion a postgresql    
	$conn = pg_connect("host=$dbhost port=$dbport dbname=$dbname user=$dbuser password=$dbpass") or die("Error al conectar la base de datos");
		
	$busca = "SELECT rut,nombre,direccion,telefono,celular,email,usuario,edad
	          FROM usuario WHERE rut = '$rut'";
	
	$result= pg_query($conn,$busca);
	
	if($row =pg_fetch_array($result)){
		echo "<table width='500' border='0' cellspacing='0' cellpadding='0'>
				 
				 <tr>
					<td bgcolor='#d2d2e4' align='left' valign='middle'><div class='Estilo7'>RUT</div></td>
    				<td bgcolor='#d2d2e4' align='left' valign='middle'><div class='Estilo7'>".$row["rut"]."</div></div></td>
  				</tr>

				<tr>
					<td bgcolor='#eaeaf2' align='left' valign='middle'><div class='Estilo7'>Nombre: </div></td>
    				<td bgcolor='#eaeaf2' align='left' valign='middle'><div class='Estilo7'>".$row["nombre"]."</div></div></td>
  				</tr>				
				
				<tr>
					<td bgcolor='#d2d2e4' align='left' valign='middle'><div class='Estilo7'>direccion:  </div></td>
    				<td bgcolor='#d2d2e4' align='left' valign='middle'><div class='Estilo7'>".$row["direccion"]."</div></div></td>
  				</tr>
				
				<tr>
					<td bgcolor='#eaeaf2' align='left' valign='middle'><div class='Estilo7'>telefono: </div></td>
    				<td bgcolor='#eaeaf2' align='left' valign='middle'><div class='Estilo7'>".$row["telefono"]."</div></div></td>
  				</tr>
				
				<tr>
					<td bgcolor='#d2d2e4' align='left' valign='middle'><div class='Estilo7'>celular: </div></td>
    				<td bgcolor='#d2d2e4' align='left' valign='middle'><div class='Estilo7'>".$row["celular"]."</div></div></td>
  				</tr>
				
				<tr>
					<td bgcolor='#eaeaf2' align='left' valign='middle'><div class='Estilo7'>email: </div></td>
    				<td bgcolor='#eaeaf2' align='left' valign='middle'><div class='Estilo7'>".$row["email"]."</div></div></td>
  				</tr>
				
				<tr>
					<td bgcolor='#d2d2e4' align='left' valign='middle'><div class='Estilo7'>Usuario: </div></td>
    				<td bgcolor='#d2d2e4' align='left' valign='middle'><div class='Estilo7'>".$row["usuario"]."</div></div></td>
  				</tr>
				
				<tr>
					<td bgcolor='#eaeaf2' align='left' valign='middle'><div class='Estilo7'>Edad: </div></td>
    				<td bgcolor='#eaeaf2' align='left' valign='middle'><div class='Estilo7'>".$row["edad"]."</div></div></td>
  				</tr>
	
			</table>
			<br>";
		}
	else{
		echo "<table width='580' border='0' cellspacing='0' cellpadding='0'>
 				<tr>
    				<td width='580' height='60' bgcolor='#d2d2e4' align='center' valign='middle'><div class='Estilo7'>No se pudo ver el usuario</div></div></td>
  				</tr>
			</table>
			<br>";
		}	
	pg_close($conn);
}

function EliminarUsuario($rut){

	include "conn.php";//conexion a postgresql
	$conn = pg_connect("host=$dbhost port=$dbport dbname=$dbname user=$dbuser password=$dbpass") or die("Error al conectar la base de datos");

	$query = "DELETE FROM usuario WHERE (rut = '$rut')"; 
	if(pg_query($conn,$query)){
		echo "<table width='580' border='0' cellspacing='0' cellpadding='0'>
 				<tr>
    				<td width='580' height='60' bgcolor='#d2d2e4' align='center' valign='middle'><div class='Estilo7'>Usuario eliminado exitosamente</div></div></td>
  				</tr>
			</table>
			<br>";
		}
	else{
		echo "<table width='580' border='0' cellspacing='0' cellpadding='0'>
 				<tr>
    				<td width='580' height='60' bgcolor='#d2d2e4' align='center' valign='middle'><div class='Estilo7'>No se pudo borrar usuario</div></div></td>
  				</tr>
			</table>
			<br>";
		}
	pg_close($conn);
}

function listarUsuarios(){
	echo "<table width='580' border='0' cellspacing='0' cellspadding='10'>";
	echo "<tr>";
	echo "<td colspan='3' bgcolor='#d2d2e4'><div class='Estilo7'><strong>LISTADO DE USUARIOS DEL SISTEMA</strong></div></td>";
	echo "</tr>";
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
	
	$busca = "SELECT rut,nombre
	          FROM usuario order by rut asc";
	$result=pg_query($conn,$busca);
	if(!$result) {
		echo "<tr>";
		echo "<td colspan='3' bgcolor='#F7F8ED'><div class='Estilo7'>X Error al buscar en la Bases de Datos</div></td>";
		echo "</tr>";
		exit();
		}
	while ($row = pg_fetch_array($result)){
		$contador++;	
		if(($contador%2) == 0)$color = $color1;
		else $color = $color2;
	
		echo "<tr>";
		echo "<td width='30' bgcolor=$color height='25'><div class='Estilo7'>$row[rut]</div></td>";
		echo "<td width='30' bgcolor=$color height='25'><div class='Estilo7'>$row[nombre]</div></td>";
		echo "<td width='100' bgcolor=$color height='25'><div class='Estilo7' >
		<a href='usuarios.php?menu=act&accion=ver&id=$row[rut]'>[ver]</a>
		<a href='usuarios.php?menu=act&accion=del&id=$row[rut]'><strong><font color=\"#FF0000\">[eliminar]</font></strong></a> 
		
		<a href='usuarios.php?menu=act&accion=modificar&id=$row[rut]'><font color=\"#0000FF\"><strong>[modificar]</strong></font></a>
		</div>
		</td>";
		echo "</tr>";
		}
	echo "</table>";
	echo "<br>";
	pg_close($conn);
	}
		
function AgregarUsuarioForm(){
	echo '
		<form name="form1" method="post" action="usuarios.php?menu=act&accion=mod">
			<table width="470" border="0" cellspacing="0" cellpadding="0" bgcolor="#eaeaf2">
				<tr class="Estilo7"> 
					<td colspan="3" bgcolor="#d2d2e4"> <div class="Estilo7"><strong>AGREGAR NUEVO USUARIO AL SISTEMA</strong></div></td>
				</tr>
				
				<tr class="Estilo7"> 
					<td colspan="3">&nbsp;</td>
				</tr>
				
				<tr class="Estilo7">
					<td width="80">Usuario</td>
					<td width="23">:</td>
					<td width="367"><input name="usuario" id="usuario" type="text" size="50" maxlength="49"></td>
				</tr>
				
				<tr class="Estilo7"> 
					<td width="80">Contraseña</td>
					<td width="23">:</td>
					<td width="367"><input name="pass" id="pass" type="password" size="50" maxlength="49"></td>
				</tr>
				
				<tr class="Estilo7"> 
					<td width="80" valign="top">Nombre</td>
					<td width="23" valign="top">:</td>
					<td width="367"><input name="nombre" type="text" id="nombre"  size="50" maxlength="500"></td>
				</tr>			

				<tr class="Estilo7">
					<td colspan="3">&nbsp;</td>
				</tr>
				
				<tr class="Estilo7"> 
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td><input type="submit" name="Submit" value="Agregar"></td>
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

function AgregarUsuario($rut,
                        $pass,
						$nombre,
						$direccion,
						$telefono,
						$celular,
						$email,
						$op_usuario,
						$edad){
	if(empty($rut)||
	   empty($pass)||
	   empty($nombre)||
	   empty($direccion)||
	   empty($telefono)||
	   empty($celular)||
	   empty($email)||
	   empty($op_usuario)||
	   empty($edad)
	   )
		echo "<table width='580' border='0' cellspacing='0' cellpadding='0'>
 				<tr>
    				<td width='580' height='60' bgcolor='#d2d2e4' align='center' valign='middle'><div class='Estilo7'>NO INGRESADO. Debe completar todos los campos.</div></div></td>
  				</tr>
			</table>
			<br>";
	else{
		include "conn.php";//conexion a postgresql    
		$conn = pg_connect("host=$dbhost port=$dbport dbname=$dbname user=$dbuser password=$dbpass") or die("Error al conectar la base de datos");
		
		$pass=md5($pass);//Para encriptar en MD5
		
		//seleccionando el tipo de usuario
		switch($op_usuario){
		case 1:$usuario="operario";break;
		case 2:$usuario="capataz";break;
		case 3:$usuario="supervisor";break;
		default:break;
		}
		
		$query = "INSERT INTO usuario (rut,pass,nombre,direccion,telefono,celular,email,usuario,edad,nombre_puerto) 
				  VALUES ('$rut',
						  '$pass',
						  '$nombre',
						  '$direccion',
						  '$telefono',
						  '$celular',
						  '$email',
						  '$usuario',
						  '$edad',
						  'svti'
						  )";
		//echo $query;
			if(pg_query($conn,$query))
			{
            	echo "<table width='580' border='0' cellspacing='0' cellpadding='0'>
 						<tr>
    						<td width='580' height='60' bgcolor='#d2d2e4' align='center' valign='middle'><div class='Estilo7'>Usuario ingresado exitosamente</div></div></td>
  						</tr>
					</table>
					<br>";
				echo pg_last_error($conn);
			}
        	else{ 
				echo "<table width='580' border='0' cellspacing='0' cellpadding='0'>
 						<tr>
    						<td width='580' height='60' bgcolor='#d2d2e4' align='center' valign='middle'><div class='Estilo7'>Error en el ingreso, el usuario ya existe</div></div></td>
  						</tr>
					</table>
					<br>";	
				echo pg_last_error($conn);

				}
		}
	pg_close($conn);
}	
	
?>