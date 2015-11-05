<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<link href="favicon.ico" rel="icon" type="image/x-icon" >
<link rel="stylesheet" type="text/css" href="css/main.css" >
<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" type="text/css" href="css/Button.css">
<link rel="stylesheet" type="text/css" href="css/screen.css" >
<link rel="stylesheet" type="text/css" href="css/searchSuggest.css" >
<link rel="stylesheet" href="menu/menu_style.css" type="text/css" >

<link type="text/css" rel="stylesheet" href="css/797khaox.css">
<link href="css/6maw1ulv.css" media="all" type="text/css" rel="stylesheet">
<link href="css/6mpli0u9.css" media="all" type="text/css" rel="stylesheet">


<script src="javascript/jquery.js" type="text/javascript"></script>
<script src="javascript/jquery.validate.js" type="text/javascript"></script>
<script src="javascript/messages_es.js" type="text/javascript"></script>
<script type="text/javascript" src="javascript/niceToolTips-1.js"></script>
<script language="JavaScript" type="text/javascript" src="javascript/ajax_search.js"></script>

<script language="JavaScript" type="text/javascript">
      function limpiar(){
        document.getElementById('txtSearch').value="";
		
		var uname = document.forms['FormularioBusqueda'].elements['txtSearch'];								
		if (uname.value == '') {
			uname.focus();
		}
        return true;
      }
</script>

<script type="text/javascript">
$(document).ready(function() {
	$("#FormularioBusqueda").validate();
});
</script>

<script language="javascript" type="text/javascript">
    	$(document).ready(function()
		{
			niceToolTip(".infoP");
		});
</script>

<style type="text/css">
#commentForm { width: 500px; }
#commentForm label.error, #commentForm input.submit { margin-left: 50px; }
</style>

<!-- InstanceBeginEditable name="doctitle" --> 
<title>BuscaF</title>
<!-- InstanceEndEditable --> 
<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
<!-- InstanceBeginEditable name="head" --><!-- InstanceEndEditable --> 

</head>

<body>
	<table width="850" border="0" align="center" cellpadding="0" cellspacing="0">
  	<!--DWLayoutTable-->
  		<tr>
   	 		<td height="98" colspan="7" align="left" valign="bottom" class="Estilo1">
			<a href="index.php"><img alt="Inicio" src="imagenes/banner.jpg" style="height:98px; border:0px;"></a>
			</td>
		</tr>
		<tr>
  			<td valign="top" bgcolor="#c2c2da" class="Estilo1">
				<div class="menubg">
						<ul id="menu">
							<li><a href="admin.php" target="_self">Iniciar Sesi&oacute;n</a></li>
							<li><a href="index.php" target="_self">BuscaF</a></li>
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
							<table width="710" border="0" cellpadding="0" cellspacing="0">
								<tr>
								<td width="710" height="509" valign="top">		
								<?
									/*
									PARA RECORDAR:
									Razon de porque hay dos sentencias sql dando vueltas, es porque postgresql no acepta que la consulta 
									select count(*) tenga order by, en mysql se puede, 
									es por eso que se deben generar 2 sentencias, una para contar los registros, que genera un numero, 
									y la otra que contenga la sentencia completa de busqueda con
									el order by correspondiente.
									*/

									include 'funciones.php';
									//Agregando el formulario a la busqueda
									AgregarFormularioBusqueda($_GET['txtSearch']);

									include 'conn.php';//conexion a postgresql
									$conn = pg_connect("host=$dbhost port=$dbport dbname=$dbname user=$dbuser password=$dbpass") or die('<div width="100%" class="error">OCURRIO UN ERROR AL INTENTAR CONECTAR A LA BASE DE DATOS <B>'. $dbname.' </B></div>');	
									//Valida que este ingresado el nombre del archivo
									if ( /*$_GET['accion'] == 'avanzada' &&*/ !strlen ($_GET['txtSearch'] ) )
										mensaje( "Aviso",
												 "Es obligatorio ingresar un valor en el campo nombre de archivo." );
									
									else
									{
										//Verifica si esta la opcion de busqueda avanzada
										if ( $_GET['accion'] == 'avanzada' && strlen ($_GET['txtSearch'] ) > 0)
											{
												//Convierte la unidad seleccionada a byte
												switch ($_GET['unidad'])
												{
													//Caso de kb
													case 'kb': $tamanho_min = $_GET['tamanho_min'] * 1024;
															   $tamanho_max = $_GET['tamanho_max'] * 1024;
															   break;
													//caso para MB
													case 'mb': $tamanho_min = $_GET['tamanho_min'] * 1024 * 1024;
															   $tamanho_max = $_GET['tamanho_max'] * 1024 * 1024;
															   break;
													//caso para GB
													case 'gb': $tamanho_min = $_GET['tamanho_min'] * 1024 * 1024 * 1024;
															   $tamanho_max = $_GET['tamanho_max'] * 1024 * 1024 * 1024;
															   break;
													default: break;
												}
												//Sentencia de consulta. Esta primera linea es simple, 
												//pero la idea es que dependiendo de las opciones seleccionadas, se vayan concatenando 
												//los filtros a la consulta original
												$busca = "SELECT a.id_archivo, b.id_catalogo,a.nombre_archivo, a.tamanho, a.ruta, a.extension, b.ubicacion 
												 from archivo a, catalogo b " .
												 whereGeneraConsultaSqlSplit_2( $_GET['txtSearch'] ) ;
												//Se agrega el filtro para fecha de los catalogos 
												if ( strlen ($_GET['id_catalogo'] ) > 0)
													$busca = $busca . " and b.id_catalogo ilike '%" .$_GET['id_catalogo'] . "%'" ;
												//Se agrega el filtro para los tamaños
												if ( $tamanho_min > 0 && $tamanho_max > 0)
													$busca = $busca . " and (a.tamanho >= ".$tamanho_min. " and a.tamanho <=" . $tamanho_max. ") " ;
												//Sea agrega filtro para la extension
												if ( strlen ($_GET['extension'] ) > 0 && $_GET['extension']!='cualquier')
													$busca = $busca . " and a.extension = '".$_GET['extension'] . "'" ;
												 
												//echo $busca;
											}
										//Esto se ejecuta para el caso de la busqueda normal
										else
											$busca = "SELECT a.id_archivo, b.id_catalogo,a.nombre_archivo, a.tamanho, a.ruta, a.extension, b.ubicacion 
													from archivo a, catalogo b " .
													whereGeneraConsultaSqlSplit_2( $_GET['txtSearch'] ) ;
									
										//$_pagi_sql = "select nombre_archivo from archivo".whereGeneraConsultaSqlSplit( $_GET['txtSearch'] );
										//Se pasa a $_pagi_sql la consulta $busca pero sin el order by
										$_pagi_sql = $busca;
										//En $_pagi_sql no puede haber un order by, por eso se le agrega despues
										$busca = $busca . "order by a.nombre_archivo asc"; 
										//Definiendo parametros para paginator
										$_pagi_nav_num_enlaces = 5;
										$_pagi_cuantos = 8;
										$_pagi_mostrar_errores = TRUE;

										$_pagi_nav_estilo = "paginacion";
										//$_pagi_propagar = array("");
										include 'paginator.inc.php';
										
										if($debug)
											echo $busca."<br>";
										//Tomando la hora inicial para poder tomar el tiempo de la busqueda
										$time_start = microtime(true);
										Buscar( $_pagi_Lim, $busca);
										$time_end = microtime(true);

										echo "<center>".$_pagi_navegacion."</center>";
										echo "<center><span class=\"paginacion2\">".$_pagi_info."</span></center>";

										$time = $time_end - $time_start;
										$time = round( $time ,2 );

										echo "<center><span class=\"paginacion2\">"."($time segundos)"."</span></center>";
										echo "<br><br><br>";
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
