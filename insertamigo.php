<?php
	session_start();
	include 'ServerData.php';
	$srv = new ServerData;

	$con=mysql_connect($srv->GetName(), $srv->GetUser(), $srv->GetPass());
	mysql_select_db("pipes",$con);

	$sql="insert into tblamigos (Id_1, Id_2, Confirm) values(".$_SESSION['id'].", ".$_REQUEST['Id_2'].", 3)";
	$res=mysql_query($sql, $con);

	$sql="insert into tblamigos (Id_1, Id_2, Confirm) values(".$_REQUEST['Id_2'].", ".$_SESSION['id'].", 0)";
	$res=mysql_query($sql, $con);

	if($res=false){
		echo "Error";
	} else {
	echo "Success";
	}
?>
