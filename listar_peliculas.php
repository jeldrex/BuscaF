<?php
	session_start();
?>
<?php
if($_REQUEST['action']=="getpdf"&&

isset($HTTP_SESSION_VARS['usuario_registrado'])&&
isset($HTTP_SESSION_VARS['password_registrado'])){
	$fecha=date("d/m/Y");
	include "conn.php";//conexion a postgresql    
	$conn = pg_connect("host=$dbhost port=$dbport dbname=$dbname user=$dbuser password=$dbpass") or die("Error al conectar la base de datos");

	define('FPDF_FONTPATH','font/');	
	include ('fpdf.php');
	
	$pdf = new FPDF('landscape','mm','legal');//Page orientation landscape
	$pdf->SetAuthor($HTTP_SESSION_VARS['usuario_registrado']);
	$pdf->SetTitle("Reporte de Peliculas Fecha: ".$fecha);
	$pdf->AddPage();
	
	$pdf->Image('imagenes/reporte.png',10,1,40,40,'PNG');

	$pdf->SetFont('Helvetica','',14);
	$pdf->Text(50,20,'Listado de Peliculas');
	
	$pdf->SetFontSize(10);
	$pdf->Text(50,25,"Fecha: $fecha .");
	
	$pdf->Ln(30);
	$pdf->SetFont('Helvetica','B',10);

	$pdf->Cell(100,7,'NOMBRE DE LA PELICULA',1);
	$pdf->Cell(100,7,'TIPO DE FORMATO',1);
	$pdf->Cell(40,7,'IDIOMA',1);

	$pdf->Ln();
	
	$pdf->SetFont('Helvetica','',10);
	
	$consulta = "
	        SELECT nombre_pelicula,formato,idioma
	        FROM pelicula order by nombre_pelicula asc
			";
	$result=pg_query($consulta);
	$cont = 1;
	while( $row=pg_fetch_array($result) ){
		$pdf->Cell(100,10,$cont.". ".$row['nombre_pelicula'],1);
		$pdf->Cell(100,10,$row['formato'],1);
		
		if($row['idioma']=='Espanoljoder')		
			$pdf->Cell(40,10,'Español de España',1);
		else
			$pdf->Cell(40,10,$row['idioma'],1);

		$pdf->Ln();
		$cont ++;
		}
	$pdf->Ln();
	$pdf->Output();
	pg_close($conn);
	exit;
	}
?>

<?php if(isset($HTTP_SESSION_VARS['usuario_registrado'])&&isset($HTTP_SESSION_VARS['usuario_registrado'])&&isset($HTTP_SESSION_VARS['password_registrado'])){?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"><html>
<head>
<link href="favicon.ico" rel="icon" type="image/x-icon" />
<script src="javascript/jquery.js" type="text/javascript" ></script>
<script src="javascript/messages_es.js" type="text/javascript"></script>
<script type="text/javascript" src="javascript/niceToolTips-1.js"></script>
<script language="javascript" type="text/javascript">			
    	$(document).ready(function()
		{
			niceToolTip(".infoP");
		});
</script>

<script type="text/javascript">
        $(document).ready(function(){
            setTimeout(function(){ $(".mensajes").fadeOut(800);}, 3000);  
        });
</script>

<link rel="stylesheet" type="text/css" href="css/main.css" media="all" />
<link rel="stylesheet" type="text/css" href="css/Button.css" media="all" />
<link rel="stylesheet" type="text/css" href="css/mensajes.css" media="all" />
<link rel="stylesheet" type="text/css" href="menu/menu_style.css"  />

<!-- InstanceBeginEditable name="doctitle" --> 
<title>Gesti&oacute;n de Peliculas</title>
<!-- InstanceEndEditable --> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<!-- InstanceBeginEditable name="head" --><!-- InstanceEndEditable --> 

<link rel="stylesheet" type="text/css" href="css/main.css" media="all" />
<link rel="stylesheet" type="text/css" href="css/style.css">

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
						require "./funciones/funciones_peliculas.php";
						require "./funciones/funcion.php";

						echo '<p align="left"class="Estilo7">Generar listado de peliculas <a target="_blank" href="'."$_SERVER[PHP_SELF]?action=getpdf".'"><span class="Estilo23">[PDF]</span></a></p>';						

						if(isset($HTTP_SESSION_VARS['usuario_registrado'])){
						
							if(isset($HTTP_GET_VARS['menu']) && isset($HTTP_GET_VARS['accion'])){
								if($HTTP_GET_VARS['menu'] == act){
									
									if(($HTTP_GET_VARS['accion'] == del) && isset($HTTP_GET_VARS['id_pelicula'])){
										EliminarPelicula($HTTP_GET_VARS['id_pelicula']);
										}
									
									if($HTTP_GET_VARS['accion'] == modificar && isset($HTTP_GET_VARS['id_pelicula'])){
										ModificarPelicula($HTTP_GET_VARS['id_pelicula']);
										}
									/*if($HTTP_GET_VARS['accion'] == agregar){
										AgregarPelicula(
													   limpia($HTTP_POST_VARS['nombre_pelicula']),
										               limpia($HTTP_POST_VARS['formato']),
													   limpia($HTTP_POST_VARS['audio'])
													   );
										}*/
									if($HTTP_GET_VARS['accion'] == ver && isset($HTTP_GET_VARS['id_pelicula'])){
										DetallePelicula($HTTP_GET_VARS['id_pelicula']);
										}
									if($_GET['accion'] == mod){
										mod(
											limpia($_POST['id_pelicula']),
										    limpia($_POST['nombre_pelicula']),
										    limpia($_POST['formato']),
											limpia($_POST['audio'])
											);
									}
									}
								}
								
								include "conn.php";//conexion a postgresql
								$conn = pg_connect("host=$dbhost port=$dbport dbname=$dbname user=$dbuser password=$dbpass") or die("Error al conectar la base de datos");	
					
								$_pagi_sql = "SELECT count(*)
											  FROM pelicula";
								$_pagi_nav_num_enlaces = 5;
								$_pagi_cuantos = 35;
								$_pagi_mostrar_errores = TRUE;
								$_pagi_nav_estilo = "paginacion";
								$_pagi_propagar = array("");
								include 'paginator.inc.php';
								echo "<center>".$_pagi_navegacion."</center>";								
								listarPeliculas( $_pagi_Lim );
								echo "<center>".$_pagi_navegacion."</center>";
								//echo "<center>".$_pagi_info."</center>";
								echo "<center><span class=\"paginacion2\">".$_pagi_info."</span></center>";
								echo "<br><br><br><br><br><br><br><br>";
								//pg_close( $conn );
							}
					?>
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