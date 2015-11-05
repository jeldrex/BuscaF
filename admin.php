<?
session_start(); 
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>

<head>
<link href="favicon.ico" rel="icon" type="image/x-icon" />
<!-- InstanceBeginEditable name="doctitle" --> 
<title>BuscaF</title>
<!-- InstanceEndEditable --> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<!-- InstanceBeginEditable name="head" --><!-- InstanceEndEditable --> 
<link rel="stylesheet" type="text/css" href="css/main.css" media="all" >
<link rel="stylesheet" type="text/css" href="css/Button.css" media="all" >
<link rel="stylesheet" type="text/css" href="css/mensajes.css" media="all" >
<link rel="stylesheet" href="menu/menu_style.css" type="text/css" />
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
							</ul>
					</div>
				</td>
			<!-- la wea del borde-->
    		<td colspan="6" align="center" valign="top" bgcolor="#c2c2da" class="Estilo1">
				<table width="610" border="0" align="center">
				<!--DWLayoutTable-->
				<tr>
					<td width="610" height="509" align="left" valign="top" bgcolor="#FFFFFF"> 
					<!-- InstanceBeginEditable name="contenido" --> 
            <table width="710"border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td width="710" height="509" valign="top"><br>
                  
				  <br> 
                  <table width="618" border="0" align="center">
                    <tr>                       
                      <td width="512"><span class="Login">Bienvenido  a BuscaF</span></td>
                    </tr>
					<tr>                       
                      <td width="512"><span class="Login">Iniciar Sesi&oacute;n</span></td>
                    </tr>

                    <tr valign="top"> 
                      <td height="74" colspan="2"><form name="form1" method="post" action="index_admin.php">
                          <table width="400" border="0" cellspacing="0" cellpadding="0">
                            <tr class="Estilo7"> 
                              <td width="102">&nbsp;</td>
                              <td width="13">&nbsp;</td>
                              <td width="285">&nbsp; </td>
                            </tr>
                            <tr class="Estilo7"> 
                              <td>Usuario</td>
                              <td> <div align="center">:</div></td>
                              <td><input name="usuario" type="text" id="id" maxlength="20">
							  
							  	<?php 
									//int $mensaje;
									if($_GET[mensaje]==1||$_GET[mensaje]==2)
                                		echo '<font color="#FF0000"><strong>x</strong></font>'; 
								?>
							  </td>
                            </tr>
                            <tr class="Estilo7"> 
                              <td>Contrase&ntilde;a</td>
                              <td> <div align="center">:</div></td>
                              <td><input name="password" type="password" id="password" maxlength="20">
							  	<?php 
									if($_GET[mensaje]==1||$_GET[mensaje]==2)
                                		echo '<font color="#FF0000"><strong>x</strong></font>'; 
								?>
							  </td>
                            </tr>
                            <tr class="Estilo7"> 
                              <td colspan="3">&nbsp;</td>
                            </tr>
                            <tr class="Estilo7"> 
                              <td>&nbsp;</td>
                              <td> <div align="center"></div></td>							  
                              <td><label class="uiButton uiButtonConfirm uiButtonLarge"><input type="submit" value="Login"></label></td>
                            </tr>
                            <tr class="Estilo7">
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                            </tr>
                          </table>
                        </form></td>
                    </tr>
					<tr> 
                      <td height="21" colspan="2" class="Estilo23">
                        <?php
							if($_GET[mensaje]==1)
								echo '<div class=Estilo7><font color="#FF0000"><strong> X Campos vacios</font></strong></div>';
							if($_GET[mensaje]==2)
								echo '<div class="error">Nombre de Usuario o contrase&ntilde;a incorrecto</div>';
							if($_GET[mensaje]==3)
								echo '<div class=Estilo7><font color="#FF0000"><strong> X Error interno</font></strong></div>';
					  	?>
                      </td>
                    </tr>

                  </table></td>
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
