<?php
session_start();
include 'srv.php';
	$srv = new ServerData;
	$con=mysql_connect($srv->GetName(), $srv->GetUser(), $srv->GetPass());
	mysql_select_db("pipes",$con);
$sql="Select * from tbluser INNER JOIN tblamigos ON tblamigos.Id_2=tbluser.Id_1 where tblamigos.Id_1=". $_SESSION['id'] ." and tblamigos.Confirm=0";
$res=mysql_query($sql, $con);
$str = "[";
if(mysql_num_rows($res)>0){
for($i = 0; $i<mysql_num_rows($res); $i++)
{
	$str .= '{ "Id":"' . mysql_result($res,$i,0) . '", "Nombre":"' . mysql_result($res,$i,1) . '", "Apellido":"' . mysql_result($res,$i,2) . '", "Usuario":"' . mysql_result($res,$i,3) . '", "Fecha":"' . mysql_result($res,$i,5) . '", "Cantpipes":"' . mysql_result($res,$i,6) . '", "Foto":"' . mysql_result($res,$i,7) . '", "Mail":"' . mysql_result($res,$i,8) . '"},';
}
$str = substr($str, 0, -1);}
echo $str . "]";
?>