<?php
session_start();
include 'srv.php';
$srv = new ServerData;
$con=mysql_connect($srv->GetName(), $srv->GetUser(), $srv->GetPass());
mysql_select_db("pipes",$con);
$str="";

$sql="Select * from tbluser where Id_1='". $_SESSION['id'] ."'";

$userinfo=mysql_query ($sql,$con);

$sql="Select tblpipes.* from tbluser INNER JOIN (tblcompartir INNER JOIN tblpipes ON tblcompartir.Id_pipe=tblpipes.Id_pipe) ON tbluser.Id_1=tblcompartir.Id_1 where tbluser.Id_1 = " . $_SESSION['id'];

$pipesinfo=mysql_query($sql, $con);

$sql = "Select tblpipes.*, tbllinks.* from tbluser INNER JOIN (tblcompartir INNER JOIN (tblpipes INNER JOIN tbllinks ON tblpipes.Id_pipe= tbllinks.Id_pipe) ON tblcompartir.Id_pipe=tblpipes.Id_pipe) ON tbluser.Id_1=tblcompartir.Id_1 where tbluser.Id_1 = " . $_SESSION['id'];

$linksinfo=mysql_query($sql, $con);

$sql="Select * from tbluser INNER JOIN tblamigos ON tblamigos.Id_2=tbluser.Id_1 where tblamigos.Id_1='". $_SESSION['id'] ."' and tblamigos.Confirm=1";

$friends=mysql_query($sql, $con);

//$str .= '{ "user" :';

$str .= '{ "name":"' . mysql_result($userinfo,0,1) . '", "apellido":"' . mysql_result($userinfo,0,2) . '", "mail":"' . mysql_result($userinfo,0,8) . '", "foto":"' . mysql_result($userinfo,0,7) . '", "fecha":"' . mysql_result($userinfo,0,5) . '", "id":"' . mysql_result($userinfo,0,6) . '", "pipes": [';

if (mysql_num_rows($pipesinfo) > 0) {

for($i = 0; $i<mysql_num_rows($pipesinfo); $i++)
{
	$str .= '{ "name":"' . mysql_result($pipesinfo,$i,1) . '", "id":"' . mysql_result($pipesinfo,$i,0) . '", "tema":"' . mysql_result($pipesinfo,$i,2) . '", "propietario":"' . mysql_result($pipesinfo,$i,3) . '", "cantlinks":"' . mysql_result($pipesinfo,$i,4) . '", "privado":"' . mysql_result($pipesinfo,$i,5) . '", "foto":"' . mysql_result($pipesinfo,$i,6) . '", "link":"' . mysql_result($pipesinfo,$i,7) . '", "descripcion":"' . mysql_result($pipesinfo,$i,8) . '", "links":[';

	if(mysql_result($pipesinfo,$i,4) > 0){
	
		for($o = 0; $o<mysql_num_rows($linksinfo); $o++)
		{
			if(mysql_result($pipesinfo,$i,1) == mysql_result($linksinfo,$o,1)){
				$str .= '{"parentpipe":"' . mysql_result($linksinfo,$o,1) . '", "link":"' . mysql_result($linksinfo,$o,11) . '", "linkname":"' . mysql_result($linksinfo,$o,12) . '", "idlink":"' . mysql_result($linksinfo,$o,9) . '"},';
			}
		}

		$str = substr($str, 0, -1);
	}
	
	$str .= ']},';
}

$str = substr($str, 0, -1);
$str .= '],';


}else
{
	$str .= '],';
}

$str .= '"friends":[';

if(mysql_num_rows($friends)>0)
{
	for($i = 0; $i<mysql_num_rows($friends); $i++)
	{
		$str .= '{ "Id":"' . mysql_result($friends,$i,0) . '", "Nombre":"' . mysql_result($friends,$i,1) . '", "Apellido":"' . mysql_result($friends,$i,2) . '", "Usuario":"' . mysql_result($friends,$i,3) . '", "Fecha":"' . mysql_result($friends,$i,5) . '", "Cantpipes":"' . mysql_result($friends,$i,6) . '", "Foto":"' . mysql_result($friends,$i,7) . '", "Mail":"' . mysql_result($friends,$i,8) . '"}, ';
	}

	$str = substr($str, 0, -2);
}



$str .= ']}';

echo $str;

//echo mysql_result($userinfo,0,1) . " <br> " . mysql_result($pipesinfo,0,1) . " <br> " . mysql_result($linksinfo,0,2);

//crear pipe, insertar id-pipe y relacion. id-pipe autonumerico???



?>