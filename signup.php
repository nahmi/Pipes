<?php

	include("login.php");

include 'ServerData.php';
	$srv = new ServerData;
	$con=mysql_connect($srv->GetName(), $srv->GetUser(), $srv->GetPass());
	mysql_select_db("pipes",$con);

$mail=flase;
$usu=false;
$res;

$sql="Select * from tbluser where USUARIO='".$_REQUEST['username'] ."'";
$ros=mysql_query ($sql,$con);
	$num=mysql_num_rows($ros);
	if ($num > 0) {
		$usu=false;
	}
	else
	{
		$usu=true;
    }


	$sql="Select * from tbluser where Mail='".$_REQUEST['email'] ."'";
	$ros=mysql_query ($sql,$con);
	$num=mysql_num_rows($ros);
	if ($num > 0) {
		$mail=flase;
	}
	else
	{
		$mail=true;
    }


if($mail==true && $usu==true){
	$sql = "insert into tbluser (Nombre, Apellido, USUARIO, Mail, PASSWORD) VALUES ('". $_REQUEST['name']."', '". $_REQUEST['lastname']."', '". $_REQUEST['username']."', '". $_REQUEST['email']."', '". $_REQUEST['pass']."' )";
$res=mysql_query( $sql, $con);
}else{
	if($mail==true && $usu==false){
		$sal="error usuario";
		//echo $sal;
	}else{
		if($mail==false && $usu==true){
			$sal="error mail";
			//echo $sal;
		}else{
			$sal="error usuario y mail";
			//echo $sal;
		}
		
	}
}



if($res && $mail==true && $usu==true){
//echo "success";
	login($_REQUEST['username'],  $_REQUEST['pass']);
}else{
	//echo "error";
}

?>