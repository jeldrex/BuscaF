<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"><html>
<head>
<link href="favicon.ico" rel="icon" type="image/x-icon" />
<link rel="stylesheet" type="text/css" href="css/main.css" media="all" >
<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" href="menu/menu_style.css" type="text/css" />

<script type="text/javascript" src="javascript/jquery.js"></script>
<script type="text/javascript" src="javascript/niceToolTips-1.js"></script>
<script language="javascript" type="text/javascript">
		/*
		Muestra el tooltip
		*/		
    	$(document).ready(function()
		{
			niceToolTip(".infoP");
		});
</script>

<!-- InstanceBeginEditable name="doctitle" --> 
<title>BuscaF</title>
<!-- InstanceEndEditable --> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<!-- InstanceBeginEditable name="head" --><!-- InstanceEndEditable --> 

<link rel="stylesheet" type="text/css" href="css/main.css" media="all" >
</head>
<!-- InstanceEnd -->

<body>
	<table width="850" border="0" align="center" cellpadding="0" cellspacing="0">
  	<!--DWLayoutTable-->
  		<tr>
   	 		<td height="98" colspan="7" align="left" valign="bottom" class="Estilo1">
			<a href="index.php"><img alt="Inicio" src="imagenes/banner.jpg" title="" alt="" style="height:98px; border:0px;"></a>
			</td>
		</tr>
		<tr valign="middle">
  			  	<td valign="top" bgcolor="#c2c2da" class="Estilo1">				
					<div class="menubg">
							<ul id="menu">
								<li><a href="admin.php" target="_self">Iniciar Sesi&oacute;n</a></li>
								<li><a href="index.php" target="_self">Ir a BuscaF</a></li>
								<li><a href="../info_rep" target="_self">InfoRep</a></li>
							</ul>
					</div>
				</td>
			<!-- la wea del borde-->
    		<td colspan="6" align="center" valign="top" bgcolor="#c2c2da" class="Estilo1">
				<table width="710" border="0" align="center">
				<!--DWLayoutTable-->
				<tr>
					<td width="610" height="509" align="left" valign="top" bgcolor="#FFFFFF"> 
					<!-- InstanceBeginEditable name="contenido" --> 
							<table width="710"border="0" cellpadding="0" cellspacing="0">
								<tr>
									<td width="710" height="509" valign="top">
											<?

												require_once 'funciones.php';

												include "conn.php";//conexion a postgresql    
												$conn = pg_connect("host=$dbhost port=$dbport dbname=$dbname user=$dbuser password=$dbpass") or die("Error al conectar la base de datos");  

												/*if(isset($HTTP_POST_VARS['id']))
													$_pagi_sql="select count(*) from archivo where id_catalogo='".$HTTP_POST_VARS['id']."' ";//and extension='dir';";               
												else*/
												$_pagi_sql="select count(*) from archivo where id_catalogo='".$_GET['id_catalogo']."' ";//and extension='dir';";

												$_pagi_nav_num_enlaces = 7;
												$_pagi_cuantos = 10;
												$_pagi_mostrar_errores = true;
												$_pagi_nav_estilo = "paginacion";
												include 'paginator.inc.php';

												/*if( isset($HTTP_POST_VARS['id']) )
												{
													$busca = "SELECT id_catalogo,nombre_archivo, tamanho, ruta, extension
															from archivo
															where 
															id_catalogo='".$HTTP_POST_VARS['id']."' order by nombre_archivo ";            
													
												}
												else*/
												{
													/*$busca = "SELECT id_catalogo,nombre_archivo, tamanho, ruta, extension
															from archivo
															where 
															id_catalogo='".$_GET['id']."' order by nombre_archivo asc ";*/
															
													// $busca ="SELECT a.id_archivo,a.id_catalogo,a.nombre_archivo, a.tamanho, a.ruta, a.extension,b.ubicacion 
															// from archivo a, catalogo b 
															// where a.id_catalogo='".$_GET['id_catalogo']."' and a.id_catalogo=b.id_catalogo order by a.nombre_archivo asc";
															
													$busca ="SELECT a.id_archivo,a.id_catalogo,a.nombre_archivo, a.tamanho, a.ruta, a.extension,b.ubicacion 
															from archivo a INNER JOIN catalogo b  ON
															a.id_catalogo='".$_GET['id_catalogo']."' and a.id_catalogo=b.id_catalogo order by a.nombre_archivo asc";
												}
												
																							
												//Mostrando paginacion
												echo "<center>".$_pagi_navegacion."</center>";
												
												//Buscando los datos
												Buscar( $_pagi_Lim,$busca );

												//Mostrando paginacion
												
												echo "<center>".$_pagi_navegacion."</center>";
												//echo "<center>".$_pagi_info."</center>";
												echo "<center><span class=\"paginacion2\">".$_pagi_info."</span></center>";
												
												echo "<br><br><br>";

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

</html>
