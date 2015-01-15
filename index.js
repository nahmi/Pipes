$(document).ready(function() {
	console.log("ok");
	$("#btn-submit-login").mouseenter(function() {
		if ($("#user").val() == "") {
				$("#user").css("border-color", "red");
		}

		if ($("#pass").val() == "") {
				$("#pass").css("border-color", "red");
		}
	});

	$("#btn-submit-login").mouseleave(function() {
		$("#user").css("border-color", "");
		$("#pass").css("border-color", "");
	});


	$("#btn-submit-login").click(function() {
			/*if ($("#user").val() == "") {
				$("#user").css("border-color", "red");
				$("#user").effect("shake", {times: 2, distance: 3}, 300);
			}

			if ($("#pass").val() == "") {
				$("#pass").css("border-color", "red");
				$("#pass").effect("shake", {times: 2, distance: 3}, 300);
			}*/

			if ($("#user").val() != "" && $("#pass").val() != ""){
						console.log("btn-submit-login");
						$.ajax({
				  			url: 'log.php',
				  			type: 'POST',
				  			async: true,
				  			data: 'user=' + $("#user").val() + '&pass='+ $("#pass").val(),
				  			"success": function(result) {
				  				if(result.substring(0, 1) == "S"){
				  					$("#divt").hide();

				  					var u = (result.substring(1, result.length)).split("$$$");

				  					$("#divt").html(u[0] + " " + u[1]);
				  					$("#divt").fadeIn();
				  				}else{
				  					if(result.substring(0, 1) == "E"){
				  						$("#divt").html(result.substring(1, result.length));
				  					$("#divt").fadeIn();
				  					};
				  				};
				  			},
				  			"error": function(result) {
					    		console.log("fuuuuuuck");
		   					}
		  				});				
			}
	});

    
        $("#btn-submit-modal").mouseenter(function() {
		if ($("#name").val() == "" && !($("#name").is(":focus"))) {
				$("#name").css("border-color", "red");
			}
		if ($("#lastname").val() == "" && !($("#lastname").is(":focus"))) {
				$("#lastname").css("border-color", "red");
			}
		if ($("#username").val() == "" && !($("#username").is(":focus"))) {
				$("#username").css("border-color", "red");
			}
		if ($("#email").val() == "" && !($("#email").is(":focus"))) {
				$("#email").css("border-color", "red");
			} 
		if ($("#password").val() == "" && !($("#password").is(":focus"))) {
				$("#password").css("border-color", "red");

	    	}
		});

		 $("#btn-submit-modal").mouseleave(function() {
		$("#name").css("border-color", "");
		$("#lastname").css("border-color", "");
		$("#username").css("border-color", "");
		$("#email").css("border-color", "");
		$("#password").css("border-color", "");
	});


	 $("#btn-submit-modal").click(function() {
	 	if($("#name").val() != "" && $("#lastname").val() != "" && $("#username").val() != "" && $("#email").val() != "" &&$("#password").val() != "")
		{
			$.ajax({
				  			url: 'signup.php',
				  			type: 'POST',
				  			async: true,
				  			data: 'usu=' + $("#username").val() + '&pass='+ $("#password").val() + '&name=' + $("#name").val() + '&surname=' + $("#lastname").val() + '&mail=' + $("#email").val(),
				  			"success": function(result) {
				  					$("#divt").hide();
				  					console.log(result);

				  					$("#divt").html(result);
				  					$("#divt").fadeIn();
				  			},
				  			"error": function(result) {
					    		
		   					}
		  			});			
		}	 
	 });
    
   
      

    $("#username").focusout(function () {
    	if($("#username").val() != "")
    	{
    		$.ajax({
				  			url: 'verif.php',
				  			type: 'POST',
				  			async: true,
				  			data: 'type=u&data='+ $("#username").val(),
				  			"success": function(result) {
				  					if(result.substring(0, 1) == "f")
				  					{
				  						//Cruz en User(#username)
				  						console.log("Cruz en user");
				  						$("#uStatus").removeClass("fa-check");
				  						$("#uStatus").addClass("fa-times");

				  						//moverboton abajo
				  						//$("#btn-submit-modal").animate({'margin-top' : '+=18px'},100);
                                        

				  					}else
				  					{
				  						//Tick en User(#username)
				  						console.log("Tick en user");
				  						$("#uStatus").removeClass("fa-times");
				  						$("#uStatus").addClass("fa-check");
				  					}

				  			},
				  			"error": function(result) {
					    		
		   					}
		  			});			
    	}

    });

    $("#email").focusout(function () {
    	if($("#email").val() != "")
    	{
    		$.ajax({
				  			url: 'verif.php',
				  			type: 'POST',
				  			async: true,
				  			data: 'type=m&data='+ $("#email").val(),
				  			"success": function(result) {
				  					if(result.substring(0, 1) == "f")
				  					{
				  						//Cruz en Mail(#email)
				  						console.log("Cruz en Mail");
				  						$("#eStatus").removeClass("fa-check");
				  						$("#eStatus").addClass("fa-times");

				  						//$("#btn-submit-modal").animate({'margin-top' : '+=18px'},100);

				  					}else
				  					{
				  						//Tick en Mail(#email)
				  						console.log("Tick en Mail");
				  						$("#eStatus").removeClass("fa-times");
				  						$("#eStatus").addClass("fa-check");
				  					}
				  			},
				  			"error": function(result) {
					    		;
		   					}
		  			});			
    	}

    });

    function MailVerif (mail)
    {
    	var ok;

    	var sec = mail.split(".");

    	if (sec.length < 2)
    	{
    		ok=false;
    	}else
    	{
    		ok=true;
    	}

    	return ok;

    }


    $("[data-toggle=tooltip]").tooltip({ placement: 'right'});

    $("#eye").mouseenter(function() {
    	$("#password").attr('type', 'text')
    });

    $("#eye").mouseleave(function() {
    	$("#password").attr('type', 'password')
    });




});