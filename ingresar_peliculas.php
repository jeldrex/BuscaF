<?php
	session_start();
?>
<?php if(isset($HTTP_SESSION_VARS['usuario_registrado'])&&isset($HTTP_SESSION_VARS['usuario_registrado'])&&isset($HTTP_SESSION_VARS['password_registrado'])){?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"><html>
<head>
<link href="favicon.ico" rel="icon" type="image/x-icon" />
<script type="text/javascript" src="javascript/jquery.js"></script>
<script type="text/javascript">
	/*
	Es para solucionar el problema del conflicto :)	
	*/
	var q = jQuery.noConflict();
    q(document).ready(function(){
    setTimeout(function(){ q(".mensajes").fadeOut(800);}, 3000);  
        });
</script>
<script src="javascript/messages_es.js" type="text/javascript"></script>

<link rel="stylesheet" type="text/css" href="css/main.css" media="all" />
<link rel="stylesheet" type="text/css" href="css/Button.css" media="all" />
<link rel="stylesheet" type="text/css" href="css/mensajes.css" media="all" />
<link rel="stylesheet" href="menu/menu_style.css" type="text/css" />
<link rel="stylesheet" type="text/css" href="css/style.css">

<link type="text/css" rel="stylesheet" href="css/797khaox.css">
<link href="css/6maw1ulv.css" media="all" type="text/css" rel="stylesheet">
<link href="css/6mpli0u9.css" media="all" type="text/css" rel="stylesheet">

<!-- InstanceBeginEditable name="doctitle" --> 
<title>Gesti&oacute;n de Peliculas</title>
<!-- InstanceEndEditable --> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<!-- InstanceBeginEditable name="head" --><!-- InstanceEndEditable --> 

</head>
<body>
<table width="850" border="0" align="center" cellpadding="0" cellspacing="0">
  <!--DWLayoutTable-->
  <tr>
    <td height="98" colspan="8" align="left" valign="bottom" class="Estilo1"><img src="imagenes/banner2.jpg" title="" alt="" style="height:98px; width:850px; border:0px;"></td>
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
    <td colspan="6" align="center" valign="top" bgcolor="#eaeaf2" class="Estilo1"">
	<table width="715" border="0" align="center">
        <!--DWLayoutTable-->
        <tr>
          <td width="700" align="left" valign="top"bgcolor="#FFFFFF"> 
            <!-- InstanceBeginEditable name="contenido" --> 
            <table width="700" height="483" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td width="700" height="509" align="center" valign="top"> 
                  	<?
						require "./funciones/funciones_peliculas.php";
						require "./funciones/funcion.php";

						//echo '<p align="left"class="Estilo7">Generar listado de peliculas <a target="_blank" href="'."$_SERVER[PHP_SELF]?action=getpdf".'"><span class="Estilo23">[PDF]</span></a></p>';						

						if(isset($HTTP_SESSION_VARS['usuario_registrado'])){
							if(isset($HTTP_GET_VARS['menu']) && isset($HTTP_GET_VARS['accion'])){
								if($HTTP_GET_VARS['menu'] == act){
									/*if(($HTTP_GET_VARS['accion'] == del) && isset($HTTP_GET_VARS['id'])){
										EliminarEmpresa($HTTP_GET_VARS['id']);
										}*/
									
									/*if($HTTP_GET_VARS['accion'] == modificar && isset($HTTP_GET_VARS['id'])){
										modificarEmpresa($HTTP_GET_VARS['id']);
										}*/
									if($HTTP_GET_VARS['accion'] == agregar){
										AgregarPelicula(
													   limpia($HTTP_POST_VARS['nombre_pelicula']),
										               limpia($HTTP_POST_VARS['formato']),
													   limpia($HTTP_POST_VARS['audio'])
													   );
										}
									/*if($HTTP_GET_VARS['accion'] == ver && isset($HTTP_GET_VARS['id'])){
										verEmpresa($HTTP_GET_VARS['id']);
										}*/
									/*if($_GET['accion'] == mod){
										mod(
											limpia($_POST['nombre_pelicula_original']),
										    limpia($_POST['nombre_pelicula']),
										    limpia($_POST['formato']),
											limpia($_POST['audio'])
											);
									}*/
									}
								}
								
								/*include "conn.php";//conexion a postgresql
								$conn = pg_connect("host=$dbhost port=$dbport dbname=$dbname user=$dbuser password=$dbpass") or die("Error al conectar la base de datos");	
					
								$_pagi_sql = "SELECT count(*)
											  FROM pelicula";
								$_pagi_nav_num_enlaces = 3;
								$_pagi_cuantos = 20;
								$_pagi_mostrar_errores = TRUE;
								$_pagi_nav_estilo = "paginacion";

								include 'paginator.inc.php';

								echo "<center>".$_pagi_navegacion."</center>";
								
								listarEmpresa( $_pagi_Lim );

								echo "<center>".$_pagi_navegacion."</center>";
								echo "<center>".$_pagi_info."</center>";*/
								
								FormularioPelicula();
								
								//pg_close( $conn );
							}
					?>
					<script type="text/javascript" language="javascript">
					<!--
					var uname = document.forms['form1'].elements['nombre_empresa'];
					
					if (uname.value == '') {
					    uname.focus();
					} 
					//-->
					</script>
                </td>
              </tr>
            </table>
        <!-- InstanceEndEditable --></td>
      </tr>
    </table></td> 
  </tr>

</table>
</font> 
</p>
</body>
<!-- InstanceEnd --></html>
<?php 
}
else
{
	header ("location: index.php?mensaje=1");exit;
}

?>