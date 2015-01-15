<?php
session_start();
include 'srv.php';
	$srv = new ServerData;
	$con=mysql_connect($srv->GetName(), $srv->GetUser(), $srv->GetPass());
	mysql_select_db("pipes",$con);
/*

VERIFICA PROPIETARIO

$sql="select Propietario from tblpipes where Id_pipe=".$_REQUEST['idpipe'];
$res=mysql_query($sql, $con);
if((mysql_result($res, 0,0))==$_SESSION['id']){
	$sql="insert into tblcompartir (Id_1, Id_pipe) values (".$_REQUEST['idamigo'].",".$_REQUEST['idpipe']")";
	$res=mysql_query($sql, $con);
}
*/
$sql="insert into tblcompartir (Id_1, Id_pipe) values (".$_REQUEST['idamigo'].", ".$_REQUEST['idpipe'].")";
$res=mysql_query($sql, $con);

echo $sql;
?>