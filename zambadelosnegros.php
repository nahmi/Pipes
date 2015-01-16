<?php
session_start();

include 'ServerData.php';
$srv = new ServerData;
$con=mysql_connect($srv->GetName(), $srv->GetUser(), $srv->GetPass());
mysql_select_db("pipes",$con);

include 'keygen.php';
$pipeid= keyneg($_REQUEST['Idpipe']);

$sql="select * from tblcompartir INNER JOIN tblpipes ON tblpipes.Id_pipe=tblcompartir.Id_pipe where ".$pipeid."=tblcompartir.Id_pipe and tblpipes.Propietario != 0";
$res=mysql_query ($sql,$con);

if(is_null(mysql_result($res, 0, 7))){

	$sql="select * from tbllinks where ".$pipeid."=tbllinks.Id_pipe";

    $linksinfo=mysql_query ($sql,$con);

    $str .= '{ "name":"' . mysql_result($res,0,3) . '", "id":"' . mysql_result($res,0,2) . '", "tema":"' . mysql_result($res,0,4) . '", "propietario":"' . mysql_result($res,0,5) . '", "cantlinks":"' . mysql_result($res,0,6) . '", "privado":"' . mysql_result($res,0,7) . '", "foto":"' . mysql_result($res,0,8) . '", "link":"' . mysql_result($res,0,9) . '", "descripcion":"' . mysql_result($res,0,10) . '", "links":[';

    if(mysql_result($res,0,6)>0){

    for($o = 0; $o<mysql_num_rows($linksinfo); $o++){
    	
    	$str .= '{"parentpipe":"' . mysql_result($linksinfo,$o,1) . '", "link":"' . mysql_result($linksinfo,$o,2) . '", "linkname":"' . mysql_result($linksinfo,$o,3) . '", "idlink":"' . mysql_result($linksinfo,$o,0) . '"},';
    }
    $str = substr($str, 0, -1);
    $str.="]}";
    echo $str;

    }else{
        $str.="]}";
        echo $str;
    }

}else{
	if(isset($_SESSION['id']) && mysql_result($res, 0, 1)==$_SESSION['id'] || mysql_result($res, 0, 5)== $_SESSION['id']){

	$sql="select * from tbllinks where ".$pipeid."=tbllinks.Id_pipe";

    $linksinfo=mysql_query ($sql,$con);

    $str .= '{ "name":"' . mysql_result($res,0,3) . '", "id":"' . mysql_result($res,0,2) . '", "tema":"' . mysql_result($res,0,4) . '", "propietario":"' . mysql_result($res,0,5) . '", "cantlinks":"' . mysql_result($res,0,6) . '", "privado":"' . mysql_result($res,0,7) . '", "foto":"' . mysql_result($res,0,8) . '", "link":"' . mysql_result($res,0,9) . '", "descripcion":"' . mysql_result($res,0,10) . '", "links":[';

    if(mysql_result($res,0,6)>0){

    for($o = 0; $o<mysql_num_rows($linksinfo); $o++){

    	$str .= '{"parentpipe":"' . mysql_result($linksinfo,$o,1) . '", "link":"' . mysql_result($linksinfo,$o,2) . '", "linkname":"' . mysql_result($linksinfo,$o,3) . '", "idlink":"' . mysql_result($linksinfo,$o,0) . '"},';
    }
    $str = substr($str, 0, -1);
    $str.="]}";
    echo $str;
    }else{
        $str.="]}";
        echo $str;
    }

	}else{

		//header ("location: ../home/index.php");
	}
}
?>