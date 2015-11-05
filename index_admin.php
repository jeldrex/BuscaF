<?php
session_start();
include("./funciones/funciones.php");
if(empty($HTTP_POST_VARS['usuario'])||empty($HTTP_POST_VARS['password'])){
	header ("location: admin.php?mensaje=1");exit;
	}
else{//--0
	if(!isset($HTTP_SESSION_VARS['usuario_registrado'])||!isset($HTTP_SESSION_VARS['password_registrado'])){
		$usuario = (quitar(trim(htmlspecialchars($HTTP_POST_VARS['usuario']))));
		$password = md5(quitar(trim(htmlspecialchars($HTTP_POST_VARS['password']))));
		}
	else{
		if(!strcmp($HTTP_SESSION_VARS['usuario_registrado'],md5($HTTP_POST_VARS['usuario']))&&!strcmp($HTTP_SESSION_VARS['password_registrado'],md5($HTTP_POST_VARS['password']))){
			$usuario=$HTTP_SESSION_VARS['usuario_registrado'];
			$password=$HTTP_SESSION_VARS['password_registrado'];
			}
		else{
			unset($HTTP_SESSION_VARS['usuario_registrado']);
			unset($HTTP_SESSION_VARS['password_registrado']);
			}
		}

	include "conn.php";//conexion a postgresql
    
	$conn = pg_connect("host=$dbhost port=$dbport dbname=$dbname user=$dbuser password=$dbpass");
	if(!$conn){
		header ("Location: admin.php?mensaje=3");exit;
		}
	$consulta = "SELECT * from usuario where nombre_usuario='".escapeshellcmd($usuario)."'";
	
	$res = pg_query ($consulta);
	if(!$res){
		header ("Location: admin.php?mensaje=2");exit;
		}
	if (pg_num_rows($res)== 0) {
		header ("Location: admin.php?mensaje=2");exit;
		}
	else{
		//---1
		
		/*
		Verificando la sesion del administrador 
		version muy chanta !!!!!!!!!
		*/
		/*$query="select usuario 
				from usuario 
				where rut='$usuario'
				and usuario='supervisor'";
		$resultado=pg_query ( $query );
		
		switch ( pg_num_rows( $resultado ) )
		{
		case 0:$paso=FALSE;break;
		case 1:$paso=TRUE;break;
		default:break;
		}*/

		$row= pg_fetch_array( $res );
		if(!strcmp($password,$row['pass'])){//---2 !!!!!!!!!!!!!!!!!!!!!!!!!!!!
			$HTTP_SESSION_VARS['usuario_registrado']=quitar($usuario);
			$HTTP_SESSION_VARS['password_registrado']=quitar($password);
			$HTTP_SESSION_VARS['nombre_registrado']=quitar($row['nombre']);
			$HTTP_SESSION_VARS['id_usuario']=quitar($row['id']);
			//$HTTP_SESSION_VARS['supervisor']=$paso;

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"><html>
<head>
<link href="favicon.ico" rel="icon" type="image/x-icon" />
<!-- InstanceBeginEditable name="doctitle" --> 
<title>BuscaF</title>
<!-- InstanceEndEditable --> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

<link rel="stylesheet" type="text/css" href="css/main.css" media="all" />
<link rel="stylesheet" href="menu/menu_style.css" type="text/css" />

</head>
<body>
<table width="850" border="0" align="center" cellpadding="0" cellspacing="0">
  <!--DWLayoutTable-->
  <tr>
    <td height="98" colspan="8" align="left" valign="bottom" class="Estilo1">
		<img src="imagenes/banner.jpg" title="" alt="" style="height:98px;border:0px;">
	</td>
  </tr>
  <tr valign="middle">
  	<td width="133" valign="top" bgcolor="#c2c2da" class="Estilo1">
	<!--la columna debajo del menu-->
	<div class="menubg">
			<ul id="menu">
				<li><a href="upload.php" target="_self">Agregar Cat&aacute;logo</a></li>
				<li><a href="gestion_catalogos.php" target="_self">Gesti&oacute;n Cat&aacute;logos</a></li>
				<li><a href="ingresar_peliculas.php" target="_self">Agregar Pel&iacute;cula</a></li>
				<li><a href="listar_peliculas.php" target="_self">Gesti&oacute;n Pel&iacute;culas</a></li>
				<li><a href="usuarios.php" target="_self">Configuraci&oacute;n</a></li>
				<li><a target='blank' href="index.php" target="_self">Ir a BuscaF</a></li>
				<li><a target='blank' href="../info_rep" target="_self">InfoRep</a></li>
				<li><a href="salir_admin.php" target="_self">Cerrar sesi&oacute;n</a></li>
			</ul>
	</div>
    </td>

    <td colspan="6" align="center" valign="top" bgcolor="#eaeaf2" class="Estilo1">
	<table width="715" border="0" align="center">
        <!--DWLayoutTable-->
        <tr>
          <td width="700" align="left" valign="top"bgcolor="#FFFFFF"> 
            <!-- InstanceBeginEditable name="contenido" --> 
            <table width="700" height="483" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td width="700" height="509" align="center" valign="top"> 
					<br>				
				  <table width="453" border="0">
                </tr>
                  </table>
                  <br> 
                  <table width="513" border="0" align="center">
                    <tr>                      
                    </tr>
                    <tr valign="top"> 
                      <td height="74" colspan="2"><br>
                        <?php 
							echo "<div class=Estilo7>Bienvenido $HTTP_SESSION_VARS[nombre_registrado] .</strong></div>";
						?>
                      </td>
                    </tr>                   
                  </table>
                </td>
              </tr>
            </table>
        <!-- InstanceEndEditable --></td>
      </tr>
	 
    </table>
  </td> 

  </tr>
</table>
</body>
<!-- InstanceEnd -->
</html>
<? 
			}//---2
		else{
			pg_close($conn);
			header ("location: admin.php?mensaje=2");
			exit;
			}
		}//---1
	}//---0
?>