<?
	session_start(); 
?>
<?php
if(
isset($HTTP_SESSION_VARS['usuario_registrado'])&&
isset($HTTP_SESSION_VARS['password_registrado'])){
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<link href="favicon.ico" rel="icon" type="image/x-icon" />
<!-- InstanceBeginEditable name="doctitle" --> 
<title>Configuraci&oacute;n de la cuenta</title>
<!-- InstanceEndEditable --> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<!-- InstanceBeginEditable name="head" --><!-- InstanceEndEditable --> 

<link rel="stylesheet" type="text/css" href="css/main.css" media="all" >
<link rel="stylesheet" type="text/css" href="css/Button.css" media="all" >
<link rel="stylesheet" href="menu/menu_style.css" type="text/css" />

<link type="text/css" rel="stylesheet" href="css/797khaox.css">
<link href="css/6maw1ulv.css" media="all" type="text/css" rel="stylesheet">
<link href="css/6mpli0u9.css" media="all" type="text/css" rel="stylesheet">
</head>
<body>
<table width="850" border="0" align="center" cellpadding="0" cellspacing="0">
  <!--DWLayoutTable-->
  <tr>
    <td height="98" colspan="8" align="left" valign="bottom" class="Estilo1">
		<img src="imagenes/banner.jpg" title="" alt="" style="height:98px; border:0px;">
	</td>
  </tr>
  <tr align="center" valign="middle" class="Estilo22">
  </tr>
  <tr valign="middle">
  	<td width="133" valign="top" bgcolor="#c2c2da" class="Estilo1"> <!--la columna debajo del menu-->
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
    <td colspan="6" align="center" valign="top" bgcolor="#eaeaf2" >
	<table width="715" border="0" align="center">
        <!--DWLayoutTable-->
        <tr>
          <td width="700" align="left" valign="top" bgcolor="#FFFFFF"> 
            <!-- InstanceBeginEditable name="contenido" --> 
            <table width="700" height="483" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td width="700" height="509" align="center" valign="top">
                  	<?	
						include("./funciones/funciones_usuario.php");
						require "./funciones/funcion.php";

						if( isset( $HTTP_SESSION_VARS['usuario_registrado'] ) )
						{
							if(isset($HTTP_GET_VARS['menu']) && isset($HTTP_GET_VARS['accion'])){
								if($HTTP_GET_VARS['menu'] == act){
									/*
									if(($HTTP_GET_VARS['accion'] == del) && isset($HTTP_GET_VARS['id'])){
										EliminarUsuario($HTTP_GET_VARS['id']);
										}
									if($HTTP_GET_VARS['accion'] == modificar && isset($HTTP_GET_VARS['id'])){
										modificarUsuario($HTTP_GET_VARS['id']);
										}
									if($HTTP_GET_VARS['accion'] == agregar){
										AgregarUsuario(
													   limpia($HTTP_POST_VARS['rut']),
										               limpia($HTTP_POST_VARS['pass']),
													   limpia($HTTP_POST_VARS['nombre']),
													   limpia($HTTP_POST_VARS['direccion']),
													   limpia($HTTP_POST_VARS['telefono']),
													   limpia($HTTP_POST_VARS['celular']),
													   limpia($HTTP_POST_VARS['email']),
													   limpia($HTTP_POST_VARS['usuario']),
													   limpia($HTTP_POST_VARS['edad'])
													   );
										}
									if($HTTP_GET_VARS['accion'] == ver && isset($HTTP_GET_VARS['id'])){
										echo strlen($HTTP_GET_VARS['id']);
										verUsuario($HTTP_GET_VARS['id']);
										}*/
									if($_GET['accion'] == mod){
										modUser(
											limpia($_POST['id']),
										    limpia($_POST['nombre_usuario']),
										    limpia($_POST['nombre']),
											limpia($_POST['password'])
											);
									}
									}
								}
								modificarUsuario($HTTP_SESSION_VARS['id_usuario']);
							}
							
							else
								echo "<table width='580' border='0' cellspacing='0' cellpadding='0'>
								<tr>
								<td width='580' height='60' bgcolor='#d2d2e4' align='center' valign='middle'><div class='Estilo7'>S&oacute;lo los usuarios supervisores tienes acceso a esta funcionalidad</div></div></td>
								</tr>
								</table>
								<br>";
					?>
                </td>
              </tr>
            </table>
        <!-- InstanceEndEditable --></td>
      </tr>
    </table></td> 
  </tr>
</table>
</font> </p>
</body>
<!-- InstanceEnd --></html>
<?php }else{header ("location: administrador.php?mensaje=1");exit;}?>