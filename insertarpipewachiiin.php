<?php
	session_start();
	include 'ServerData.php';
	$srv = new ServerData;
	$con=mysql_connect($srv->GetName(), $srv->GetUser(), $srv->GetPass());
	mysql_select_db("pipes",$con);

	include 'keygen.php';

	//Inserto Pipe
	$sql="insert into tblpipes (Nombre, Tema, Propietario, Cantlinks, Privado, Descripcion, Foto) values ('" . $_REQUEST['nombre'] . "', '" . $_REQUEST['tema'] . "', " . $_SESSION['id'] . ", 0, " . $_REQUEST['privado'] . ", '" . $_REQUEST['descripcion'] . "', '". $_REQUEST['foto'] ."')";
	$res=mysql_query($sql, $con);

	//Averiguo Id_pipe
	$sql="select tblpipes.Id_pipe from tblpipes LEFT OUTER JOIN tblcompartir ON tblpipes.Id_pipe= tblcompartir.Id_pipe where tblcompartir.Id_pipe is null and tblpipes.Propietario=" . $_SESSION['id']."";

	$res=mysql_query($sql, $con);

	$linkpeola=mysql_result($res, 0, 0) ."$$$/NewHome/paginadelinks/links.html?id=".keygen((mysql_result($res, 0, 0)));
	echo $linkpeola;

	$sql="update tblpipes SET Link='/NewHome/paginadelinks/links.html?id=".keygen((mysql_result($res, 0, 0)))."' where tblpipes.Id_pipe=".mysql_result($res, 0, 0);
	$ras = mysql_query($sql, $con);

	//Creo relacion con Id_pipe
	$sql="insert into tblcompartir (Id_1, Id_pipe) values (".$_SESSION['id'].", ".mysql_result($res, 0, 0).")";
	$relacion=mysql_query($sql, $con);

	$sql="select Cantpipes from tbluser where tbluser.Id_1=".$_SESSION['id'];
	$res=mysql_query($sql, $con);

	$sql="update tbluser SET Cantpipes=".(mysql_result($res, 0, 0)+1)." where tbluser.Id_1=" . $_SESSION['id'];
	$res=mysql_query($sql, $con);
?>