<?php

include 'srv.php';
	$srv = new ServerData;
	$con=mysql_connect($srv->GetName(), $srv->GetUser(), $srv->GetPass());
	mysql_select_db("pipes",$con);

if($_REQUEST['type']=="u"){
	$sql="Select * from tbluser where USUARIO='".$_REQUEST['data'] ."'";
	$res=mysql_query ($sql,$con);
	$num=mysql_num_rows($res);
	if ($num > 0) {
		$sal="f";
		echo $sal;
	}
	else
	{
		$sal="s";
        echo $sal;
    }
}else{
	$sql="Select * from tbluser where Mail='".$_REQUEST['data'] ."'";
	$res=mysql_query ($sql,$con);
	$num=mysql_num_rows($res);
	if ($num > 0 ){
		$sal="f";
		echo $sal;
	}
	else
	{
		$sal="s";
        echo $sal;
    }
}
?>

