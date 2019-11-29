<?php 
	session_start();	session_destroy();		setcookie("id_usuarios", "",  0, "/");	setcookie("permiso_usuarios", "",  0, "/");	setcookie("nombre_usuarios", "",  0, "/");		header("location:main_login.php");	
?>