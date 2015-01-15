<?php
session_start();
include 'srv.php';
	$srv = new ServerData;
	$con=mysql_connect($srv->GetName(), $srv->GetUser(), $srv->GetPass());
	mysql_select_db("pipes",$con);
if($_REQUEST['like']=='*'){
$sql='select * from tblpipes INNER JOIN tbllinks ON tbllinks.Id_pipe=tblpipes.Id_pipe where tblpipes.Propietario != 0 and tblpipes.Privado=0 ORDER BY tblpipes.Id_pipe DESC';
$res=mysql_query ($sql,$con);
$str="[";
$count=0;
for($i = 0; $i<mysql_num_rows($res); $i++)
{
	$str .= '{ "name":"' . mysql_result($res,$i,1) . '", "tema":"' . mysql_result($res,$i,2) . '", "propietario":"' . mysql_result($res,$i,3) . '", "cantlinks":"' . mysql_result($res,$i,4) . '", "privado":"' . mysql_result($res,$i,5) . '", "foto":"' . mysql_result($res,$i,6) . '", "link":"' . mysql_result($res,$i,7) . '", "descripcion":"' . mysql_result($res,$i,8) . '", "links":[';
	if(mysql_result($res,$i,4)>0){
				for($o=0; $o < mysql_result($res,$i,4); $o++)
		{
				$str .= '{"parentpipe":"' . mysql_result($res,$i+$o,1) . '", "link":"' . mysql_result($res,$i+$o,11) . '", "linkname":"' . mysql_result($res,$i+$o,12) . '"},';
				$count=$o;
		}
		$i+=$count;
		$str = substr($str, 0, -1);
	
	$str .= ']},';
}else{
	$str .="]";
}
	

}
$str = substr($str, 0, -1);
}
else{
$sql = 'select * from tblpipes INNER JOIN tbllinks ON tbllinks.Id_pipe=tblpipes.Id_pipe where tblpipes.Propietario != 0 and tblpipes.Privado=0 and tblpipes.Nombre LIKE "%'.$_REQUEST['like'].'%"';
$res=mysql_query ($sql,$con);
$str="[";
$count=0;
for($i = 0; $i<mysql_num_rows($res); $i++)
{
	$str .= '{ "name":"' . mysql_result($res,$i,1) . '", "tema":"' . mysql_result($res,$i,2) . '", "propietario":"' . mysql_result($res,$i,3) . '", "cantlinks":"' . mysql_result($res,$i,4) . '", "privado":"' . mysql_result($res,$i,5) . '", "foto":"' . mysql_result($res,$i,6) . '", "link":"' . mysql_result($res,$i,7) . '", "descripcion":"' . mysql_result($res,$i,8) . '", "links":[';
	if(mysql_result($res,$i,4)>0){
				for($o=0; $o < mysql_result($res,$i,4); $o++)
		{
				$str .= '{"parentpipe":"' . mysql_result($res,$i+$o,1) . '", "link":"' . mysql_result($res,$i+$o,11) . '", "linkname":"' . mysql_result($res,$i+$o,12) . '"},';
				$count=$o;
		}
		$i+=$count;
		$str = substr($str, 0, -1);
	
	$str .= ']},';
}else{
	$str .="]";
}
	

}
$str = substr($str, 0, -1);	
}

$str .="]";
echo $str;

?>