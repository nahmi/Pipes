<?php
session_start();
include 'srv.php';
$srv = new ServerData;
$con=mysql_connect($srv->GetName(), $srv->GetUser(), $srv->GetPass());
mysql_select_db("pipes",$con);
$sql="Select * from tbluser where tbluser.USUARIO LIKE '%".$_REQUEST['like']."%'";
$sql=mysql_query($sql, $con);
$str="[";

if(mysql_num_rows($sql)>0){
for($i = 0; $i<(mysql_num_rows($sql)); $i++)
{
	$str .= '{ "Id":"' . mysql_result($sql,$i,0) . '", "Nombre":"' . mysql_result($sql,$i,1) . '", "Apellido":"' . mysql_result($sql,$i,2) . '", "Usuario":"' . mysql_result($sql,$i,3) . '", "Fecha":"' . mysql_result($sql,$i,5) . '", "Cantpipes":"' . mysql_result($sql,$i,6) . '", "Foto":"' . mysql_result($sql,$i,7) . '", "Mail":"' . mysql_result($sql,$i,8) . '"},';
}
$str = substr($str, 0, -1);}
$str.="]";
echo $str;
?>