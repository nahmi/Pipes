<?php
session_start();
function borrarlink($idlink)
{
	include 'ServerData.php';
	$srv = new ServerData;
	$con=mysql_connect($srv->GetName(), $srv->GetUser(), $srv->GetPass());
	mysql_select_db("pipes",$con);

	$sql="select tblpipes.Cantlinks, tblpipes.Id_pipe from tblpipes INNER JOIN tbllinks ON tblpipes.Id_pipe=tbllinks.Id_pipe where tbllinks.Id_Link=". $idlink;
	$res=mysql_query($sql, $con);
	echo $sql;
	echo mysql_result($res, 0, 0);
	$sql="update tblpipes SET Cantlinks=".(mysql_result($res, 0, 0)-1)." where tblpipes.Id_pipe=". mysql_result($res, 0, 1);
	echo $sql;
	$res=mysql_query($sql, $con);
	$sql="delete from tbllinks where Id_Link=". $idlink;
	$res=mysql_query($sql, $con);
	echo $sql;
}

function borrarpipe($idpipe)
{
	include 'ServerData.php';
	$srv = new ServerData;
	$con=mysql_connect($srv->GetName(), $srv->GetUser(), $srv->GetPass());
	mysql_select_db("pipes",$con);

	$sql="select * from tblcompartir INNER JOIN tblpipes ON tblcompartir.Id_pipe=tblpipes.Id_pipe where tblcompartir.Id_pipe=". $idpipe . " and tblpipes.Propietario=" . $_SESSION['id'];
	$res=mysql_query($sql, $con);

 if(mysql_num_rows($res)<1)
  {

	$sql="select Cantpipes from tbluser INNER JOIN tblcompartir ON tblcompartir.Id_1=tbluser.Id_1 where tblcompartir.Id_pipe=". $idpipe;
	$res=mysql_query($sql, $con);
	$sql="update tbluser SET Cantpipes=".($res-1)." where tbluser.Id_1=". $_session['id'];
	$res=mysql_query($sql, $con);
	$sql="delete from tblcompartir where tblcompartir.Id_pipe=". $idpipe." and tblcompartir.Id_1=". $_SESSION['id'] ;
	$res=mysql_query($sql, $con);
  }else
  {

	$sql="select Cantpipes from tbluser INNER JOIN tblcompartir ON tblcompartir.Id_1=tbluser.Id_1 where tblcompartir.Id_pipe=". $idpipe;
	$res=mysql_query($sql, $con);
	$sql="update tbluser SET Cantpipes=".($res-1)." where tbluser.Id_1=". $_SESSION['id'];
	$res=mysql_query($sql, $con);
	$sql="delete from tblcompartir where tblcompartir.Id_pipe=". $idpipe;
	$res=mysql_query($sql, $con);


	$sql="update tblpipes SET Propietario=0 where Id_pipe=". $idpipe;
	$res=mysql_query($sql, $con);
 }
}
?>