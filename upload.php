<? 
	session_start();
?>
<?php 
if(isset($HTTP_SESSION_VARS['usuario_registrado'])&&
   isset($HTTP_SESSION_VARS['password_registrado']))
 
 {?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<link href="favicon.ico" rel="icon" type="image/x-icon" />
<link rel="stylesheet" type="text/css" href="css/main.css" media="all" />
<link rel="stylesheet" type="text/css" href="css/Button.css" media="all" />
<link rel="stylesheet" type="text/css" href="css/mensajes.css" media="all" />
<link rel="stylesheet" href="menu/menu_style.css" type="text/css" />

<link type="text/css" rel="stylesheet" href="css/797khaox.css">
<link href="css/6maw1ulv.css" media="all" type="text/css" rel="stylesheet">
<link href="css/6mpli0u9.css" media="all" type="text/css" rel="stylesheet">

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

<script type="text/javascript" src="javascript/prototype.js"></script>
<script type="text/javascript">
<!--  
 //<![CDATA[  
function comprobar(nick)   
{  
  var url = 'ajax_comprobar_catalogo.php';
  var pars= ("id_catalogo=" + nick);
  var myAjax = new Ajax.Updater( 'comprobar_mensaje', url, { method: 'get', parameters: pars});  
}  
// -->  
</script>

<script language="javascript" type="text/javascript">
function NuevoAjax(){
var xmlhttp=false;
try{
	xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
}catch(e){
	try{
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
 	}catch(E){
		xmlhttp = false;
	}
}

if(!xmlhttp && typeof XMLHttpRequest!='undefined'){
	xmlhttp = new XMLHttpRequest();
}
return xmlhttp;
}
function Cargar(url){
var contenido, preloader;
contenido = document.getElementById('contenido');
preloader = document.getElementById('preloader');
ajax=NuevoAjax();
ajax.open("GET", url,true);
ajax.onreadystatechange=function(){
	if(ajax.readyState==1){
		preloader.innerHTML = "<p>&nbsp;</p><p>&nbsp;</p><p><h1><br>Cargando ...</h1></p>";
		preloader.style.background = "url('loading.gif') no-repeat";
	}else if(ajax.readyState==4){
		if(ajax.status==200){
			contenido.innerHTML = ajax.responseText;
			preloader.innerHTML = "Cargado.";
			preloader.style.background = "url('loaded.gif') no-repeat";
		}else if(ajax.status==404){
			preloader.innerHTML = "La página no existe";
		}else{
			preloader.innerHTML = "Error:".ajax.status;
		}
	}
}
ajax.send(null);
}
</script>

<!-- InstanceBeginEditable name="doctitle" --> 
<title>Agregar Cat&aacute;logo</title>
<!-- InstanceEndEditable --> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<!-- InstanceBeginEditable name="head" --><!-- InstanceEndEditable -->
</head>
<body>
<table width="850" border="0" align="center" cellpadding="0" cellspacing="0">
  <!--DWLayoutTable-->
  <tr>
    <td height="98" colspan="8" align="left" valign="bottom" class="Estilo1">
	<img src="imagenes/banner.jpg" title="" alt="" style="height:98px;border:0px;"></td>
  </tr>
  <tr align="center" valign="middle" class="Estilo22">
  </tr>
  <div id="sidebar"> 

</div>
  <tr valign="middle">
  	<td valign="top" bgcolor="#c2c2da" class="Estilo1"> 
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
           	<?
						require "funciones.php";
						
						if(isset($HTTP_SESSION_VARS['usuario_registrado']))
						{
									if($_GET['accion'] == agregar)
									{
										//Agrega el catalogo
										//Bug, no tengo idea por que ingresa un catalogo vacio, 
										//esto es una solucion muy pero muy chanta , evita que ingrese el catalogo fantasma ""
										if ( !empty( $_POST['id_catalogo'] ) )
										{
											if ( agregarCatalogo2( $HTTP_SESSION_VARS['id_usuario'], limpia( $_POST['id_catalogo'] ), limpia( $_POST['ubicacion'] )  ) )
												mensaje( "¡Error!","El cat&aacute;logo ".limpia( $_POST['id_catalogo'] )." ya existe en la base de datos" );

											else
											{
												//echo $_POST['id_ruta'];
												//Agrega los archivos al catalogo
												listar_directorios_ruta( limpia( $_POST['id_catalogo'] ), $_POST['id_ruta']);
												//mensaje( "¡Confirmado!","Cat&aacute;logo <b>".limpia( $_POST['id_catalogo'] )."</b> ingresado exitosamente" );
												echo '<div class="exito mensajes">¡Confirmado! Cat&aacute;logo <b>'.limpia( $_POST['id_catalogo'] ).'</b> ingresado exitosamente</div>';											
											}
										}
									}
						}
						FormularioCargarCatalogo();
					?>
					<script type="text/javascript" language="javascript">
					<!--
					var uname = document.forms['FormularioCargarCatalogo'].elements['id_catalogo'];
					
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
	 
    </table>
  </td> 
  </tr>

</table>

</body>
<!-- InstanceEnd --></html>
<?php
}//Cierre del if
else
{
	header ("location: admin.php");
	exit;
}
?>