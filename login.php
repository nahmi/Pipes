<?php
function login($user, $pass) {
include 'srv.php';
	$srv = new ServerData;
	$con=mysql_connect($srv->GetName(), $srv->GetUser(), $srv->GetPass());
	mysql_select_db("pipes",$con);


$sql="Select ID_1,Nombre,Apellido from tbluser where USUARIO='". $user ."' and PASSWORD='".$pass."'";

$res=mysql_query ($sql,$con);


if (!mysql_errno()) { 
	$num=mysql_num_rows($res);
	$sal="";
	
	if ($num>0){
			$sal.= "S".mysql_result($res,0,1)."$$$".mysql_result($res,0,2);

			session_start();
			$_SESSION['id'] = mysql_result($res,0,0);
			$sal .= " " . $_SESSION['id'];
			header("Location: ../houm-vale/home.html");
			}else{
			$sal.="EUsuario o Contraseña incorrectos";
			
			header("Location: index.php");
	}
}else{
			$sal.= "EParece haber un error. Intente mas tarde.";
			header("Location: index.php");
}
}
?>