<?
	session_start();
?>

<?php if(isset($HTTP_SESSION_VARS['usuario_registrado'])&&isset($HTTP_SESSION_VARS['password_registrado'])){?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<link href="favicon.ico" rel="icon" type="image/x-icon" />
<link rel="stylesheet" type="text/css" href="css/main.css" media="all" />
<link rel="stylesheet" type="text/css" href="css/Button.css" media="all" />
<link rel="stylesheet" type="text/css" href="css/mensajes.css" media="all" />
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" href="menu/menu_style.css" type="text/css" />

<script type="text/javascript" src="javascript/jquery.js"></script>
<script type="text/javascript" src="javascript/niceToolTips-1.js"></script>
<script type="text/javascript">	
        $(document).ready(function(){
            setTimeout(function(){ $(".mensajes").fadeOut(800);}, 3000);  
        });
		
		/*
		Muestra el tooltip
		*/
    	$(document).ready(function()
		{
			niceToolTip(".infoP");
		});
</script>

<!-- InstanceBeginEditable name="doctitle" --> 
<title>Gesti&oacute;n de Cat&aacute;logos</title>
<!-- InstanceEndEditable --> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<!-- InstanceBeginEditable name="head" --><!-- InstanceEndEditable -->
</head>
<body>
<table width="850" border="0" align="center" cellpadding="0" cellspacing="0">
  <!--DWLayoutTable-->
  <tr>
    <td height="98" colspan="8" align="left" valign="bottom" class="Estilo1"><img src="imagenes/banner.jpg" title="" alt="" style="height:98px;border:0px;"></td>
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
						require_once 'funciones.php';
						
						if(isset($HTTP_SESSION_VARS['usuario_registrado'])){
							if(isset($_GET['menu']) && isset($_GET['accion'])){
								if($_GET['menu'] == act){
									if(($_GET['accion'] == del) && isset($_GET['id_cat'])){										
										Eliminar(limpia($_GET['id_cat']));
										}
									if($_GET['accion'] == modificar && isset($_GET['id_cat'])){
										modificar(limpia($_GET['id_cat']));
										}
									if($_GET['accion'] == mod){
										mod(
										    $_POST['id_cat'],
										    limpia( $_POST['id_catalogo'] ),
											limpia( $_POST['ubicacion'] )
											);
									}
									}
								}

								$id_usuario = $HTTP_SESSION_VARS['id_usuario'];
								
								//conexion a postgresql
								include "conn.php";
								$conn = pg_connect("host=$dbhost port=$dbport dbname=$dbname user=$dbuser password=$dbpass") or die('<div width="100%" class="error">OCURRIO UN ERROR AL INTENTAR CONECTAR A LA BASE DE DATOS <B>'. $dbname.' </B></div>');	

								$_pagi_sql = "select count(*) from catalogo where id_usuario = '$id_usuario'";
								
								$_pagi_nav_num_enlaces = 5;
								$_pagi_cuantos = 27;
								$_pagi_mostrar_errores = true;
								$_pagi_nav_estilo = "paginacion";
																
								$_pagi_propagar = array("");

								include 'paginator.inc.php';

								$busca = "SELECT id_catalogo,ubicacion,id_cat
										from catalogo where id_usuario = '$id_usuario' order by id_catalogo desc";
								//echo $busca;
								echo $_pagi_navegacion;

								listarCatalogos( $_pagi_Lim, $busca, $id_usuario );

								echo "<center>".$_pagi_navegacion."</center>";
								
								echo "<span class=\"paginacion2\">".$_pagi_info."</span>";
								echo "<br><br><br><br><br><br><br><br>";

							}
					?>
                </td>
              </tr>
            </table>
        <!-- InstanceEndEditable -->
			</td>
      </tr>
    </table>
	
	</td>
  </tr>
</table>
</body>
<!-- InstanceEnd -->
</html>
<?php
}//Cierre del if
else
{
	header ("location: admin.php");
	exit;
}
?>