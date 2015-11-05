<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<link href="favicon.ico" rel="icon" type="image/x-icon" />

<link rel="stylesheet" type="text/css" href="css/main.css" >
<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" type="text/css" href="css/Button.css">
<link rel="stylesheet" type="text/css" href="css/screen.css" >
<link rel="stylesheet" type="text/css" href="css/searchSuggest.css" >
<link rel="stylesheet" href="menu/menu_style.css" type="text/css" />

<script src="javascript/jquery.js" type="text/javascript"></script>
<script src="javascript/jquery.validate.js" type="text/javascript"></script>
<script src="javascript/messages_es.js" type="text/javascript"></script>
<script type="text/javascript" src="javascript/niceToolTips-1.js"></script>
<script src="javascript/ajax_search.js" language="JavaScript" type="text/javascript" ></script>

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
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<!-- InstanceBeginEditable name="head" --><!-- InstanceEndEditable --> 
</head>

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
								<li><a href="patch.txt" target="_self">Buscaf Patch</a></li>
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
													include 'funciones.php';
													AgregarFormularioBusqueda();
												?>
												<script type="text/javascript" language="javascript">								
												var uname = document.forms['FormularioBusqueda'].elements['txtSearch'];								
												if (uname.value == '') {
													uname.focus();
												}
												</script>
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
