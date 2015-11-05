<?php
	session_start();
	unset($HTTP_SESSION_VARS['usuario_registrado']);
	unset($HTTP_SESSION_VARS['password_registrado']);
	unset($HTTP_SESSION_VARS['email_registrado']);
	unset($HTTP_SESSION_VARS['supervisor']);
	unset($usuario);
	unset($password);
	unset($HTTP_POST_VARS['usuario']);
	unset($HTTP_POST_VARS['password']);
	session_unset();
	session_destroy();
	header ("Location: admin.php");
?>
