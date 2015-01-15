<?php
session_start();
include 'srv.php';
	$srv = new ServerData;
	$con=mysql_connect($srv->GetName(), $srv->GetUser(), $srv->GetPass());
	mysql_select_db("pipes",$con);
if($_REQUEST['Aceptado']==1){
	$sql='update tblamigos SET Confirm=1 where tblamigos.Id_2='.$_REQUEST['Id_2'].' and tblamigos.Id_1='.$_SESSION['id'];
	$res=mysql_query($sql, $con);

	$sql='update tblamigos SET Confirm=1 where tblamigos.Id_2='.$_SESSION['id'].' and tblamigos.Id_1='.$_REQUEST['Id_2'];
	$res=mysql_query($sql, $con);

	echo $sql;
}else{
	$sql='delete from tblamigos where tblamigos.Id_2='.$_REQUEST['Id_2'].' and tblamigos.Id_1='.$_SESSION['id'];
	$res=mysql_query($sql, $con);

	$sql='delete from tblamigos where tblamigos.Id_2='.$_SESSION['id'].' and tblamigos.Id_1='.$_REQUEST['Id_2'];
	$res=mysql_query($sql, $con);

	echo $sql;
}
?>