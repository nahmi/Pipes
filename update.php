<?php
session_start();
include 'srv.php';
	$srv = new ServerData;
	$con=mysql_connect($srv->GetName(), $srv->GetUser(), $srv->GetPass());
	mysql_select_db("pipes",$con);
$sql="update tbluser SET Nombre=".$_REQUEST['unombre'].", Apellido=".$_REQUEST['uapellido'].", USUARIO=".$_REQUEST['uusuario'].", PASSWORD=".$_REQUEST['upassword'].", Fecha=".$_REQUEST['ufecha'].", Foto=".$_REQUEST['ufoto'].", Mail=".$_REQUEST['umail']." where Id_1=".$_SESSION['Id']."";
$res=mysql_query ($sql,$con);
?>