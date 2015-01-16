<?php
	session_start();
	
	if(isset($_SESSION['id']))
	{
		header("location: ../home/pipes-home.html");
	}
?>

<DOCTYPE! html>

<html>
<head>

	<title>Welcome to Pipes!</title>

	<link rel="stylesheet" type="text/css" href="stylesheets/index.css">

	<meta charset="utf-8">

	<script src="js/jquery/jquery-1.9.1.js" type="text/javascript"></script> 
	<script src="js/jquery/jquery-ui-1.11.1/jquery-ui.js" type="text/javascript"></script>
	<script src="js/index.js" type="text/javascript" ></script>

	<!--boot-->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>


	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">



</head>
<body>

	<div class="container-fluid">
		<div class="row">
			<button class="btn btn-primary pull-right btn-lg btn-submit" id="btn-submit-signup" data-toggle="modal" data-target="#myModal"> Sign up </button>
		</div>
		<div class="row">
			<div class="col-md-4 col-md-offset-4 login-form">
				<h1> Pipes </h1>
				<h2> Flow your links, share with your friends, share with the world </h2>

				<!-- el action de un form le dice al formulario a donde enviar los datos cuando el usuario haga "submit", despue,s nahmod va a hacer cosas con esos datos, a vos no te importa -->
				<form role="form" method="POST" action="log.php" class="col-md-8 col-md-offset-2">
					<div class="form-group">
						<input name="user" type="text" class="form-control input-lg login-input" id="user" placeholder="Username">
					</div>
					<div class="form-group">
						<input name="pass" type="password" class="form-control input-lg login-input" id="pass" placeholder="Password">
					</div>
					<button type="submit" class="btn btn-block btn-primary btn-submit" id="btn-submit-login"> Log in </button>
				</form>


				<div id="divt"></div>



				<div class="col-md-12">
					<a class="btn btn-link btn-block white-link"> Did you forget your password? </a>
					<a class="btn btn-link btn-block white-link" data-toggle="modal" data-target="#myModal"> Don't have an account? </a>
			     </div>
			</div>
		</div>
		<div class="row" id="info-us">
			<a href="../aboutinfo/info.html" class="btn btn-link white-link">About</a>
			<a href="#" class="btn btn-link white-link">Contact</a>
		</div>
	</div>



	<!-- Modal -->
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog" style="margin-top:45px;width:530;">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
	        <h4 class="modal-title" id="myModalLabel">Sign up</h4>
	      </div>
	      <div class="modal-body">

	      		<div class="row">

	      			<h2 class="modal-sub-header"> Pipes </h2>
	      			<h3> <strong>Join free today! </strong>Sign up using your e-mail! </h3>
	       
					<form role="form" method="POST" action="signup.php" class="col-md-8 col-md-offset-2">
						<div class="form-group">
							<input name="name" type="text" class="form-control input-lg login-input signup-input" id="name" placeholder="Name">
						</div>
						<div class="form-group">
							<input name="lastname" type="text" class="form-control input-lg login-input signup-input" id="lastname" placeholder="Lastname">
						</div>

						<div class="form-group">
							<input name="username" type="text" class="form-control input-lg login-input signup-input" id="username" placeholder="Username" title="Between 6 and 12 characters, don't use $, * or &" data-toggle="tooltip">
							<i id="uStatus" class="fa"></i>

						</div>

						<div class="form-group">
							<input name="email" type="email" class="form-control input-lg login-input signup-input" id="email" placeholder="Email" title="email@email.com" data-toggle="tooltip">
							<i id="eStatus" class="fa"></i>
						</div>

						<div class="form-group">
							<input name="pass" type="password" class="form-control input-lg login-input signup-input" id="password" placeholder="Password" title="Between 6 and 14 characters, use numbers and capitals" data-toggle="tooltip">
							<i id="eye" class="fa fa-eye"></i>

						</div>

						<button type="submit" class="btn btn-block btn-primary btn-submit" id="btn-submit-modal"> Send! </button>
					</form>
				</div>

	      </div>
<!-- 	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        <button type="button" class="btn btn-primary">Save changes</button>
	      </div> -->
	    </div>
	  </div>
	</div>
</body>
</html>