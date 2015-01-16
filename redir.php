<?php
	session_start();
?>
<DOCTYPE! html>
<html>

	<head>
		<title>Welcome to Pipes!</title>
	</head>
	<body>

	<?php
		include 'ServerData.php';
		$srv = new ServerData;

		$con=mysql_connect($srv->GetName(), $srv->GetUser(), $srv->GetPass());
		mysql_select_db("pipes",$con);

		$sql="Select * from tbluser where ID_1='". $_SESSION['id'] . "'";

		$res=mysql_query ($sql,$con);

		if (!mysql_errno()) { 
			$num=mysql_num_rows($res);
	
			if ($num>0){
				echo mysql_result($res,0,1)." ".mysql_result($res,0,2) . " " . mysql_result($res,0,8) . ".................". mysql_result($res,0,0);
			}
		}
	?>
</body>
</html>