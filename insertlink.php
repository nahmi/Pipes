<?php
	session_start();
	include 'ServerData.php';
	$srv = new ServerData;

	$con=mysql_connect($srv->GetName(), $srv->GetUser(), $srv->GetPass());
	mysql_select_db("pipes",$con);

	$sql="insert into tbllinks (Id_pipe, Link, Nombre) values (".$_REQUEST['idpipe'].", '".$_REQUEST['link']."', '".$_REQUEST['nombre']."')";
	$res=mysql_query($sql, $con);
	$sql="select * from tblpipes Cantlinks where Id_pipe=".$_REQUEST['idpipe'];
	$res=mysql_query($sql, $con);
	$sql="update tblpipes SET Cantlinks=".(mysql_result($res, 0, 4)+1)." where Id_pipe=".$_REQUEST['idpipe'];
	$res=mysql_query($sql, $con);

	$sql = "Select tbllinks.Id_Link from tbluser INNER JOIN (tblcompartir INNER JOIN (tblpipes INNER JOIN tbllinks ON tblpipes.Id_pipe= tbllinks.Id_pipe) ON tblcompartir.Id_pipe=tblpipes.Id_pipe) ON tbluser.Id_1=tblcompartir.Id_1 where tbluser.Id_1 = " . $_SESSION['id'] . " and tblpipes.Id_pipe = " . $_REQUEST['idpipe'];
	$linksinfo=mysql_query($sql, $con);

	$r="";

	for($i = 0; $i<mysql_num_rows($linksinfo); $i++) {
		$r .=  mysql_result($linksinfo,$i,0) . '$$$';
	}

	$r = substr($r, 0, -3);
	echo $r;
?>