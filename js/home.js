var uname;
var apellido;
var mail;
var fecha;
var id;
var foto;
var pipes;
var pipeid = [];
var pname = [];
var tema = [];
var propietario = [];
var cantlinks = [];
var privado = [];
var pfoto = [];
var link = [];
var descripcion = [];
var links = [];
var parentpipe = [];
var llinks = [];
var linkname = [];
var idlink = [];
var friends;
var fusu = [];
var cantpipes;
var pid;

//var result = '{ "name":"Pablo", "apellido":"Marmol", "mail":"pp@marmol.com", "foto":"", "fecha":"0000-00-00", "id":"0", "pipes": [{ "name":"Google", "tema":"Busquedas", "propietario":"1", "cantlinks":"2", "privado":"0", "foto":"http://www.celiacos.com/wp-content/uploads/2008/10/panqueques.jpg", "link":"", "descripcion":"asdfghjkl", "links":[{"parentpipe":"Google", "link":"https://www.google.com/", "linkname":"Google"},{"parentpipe":"Google", "link":"https://www.youtube.com/", "linkname":"Youtube"}]},{ "name":"Social", "tema":"Personas", "propietario":"1", "cantlinks":"2", "privado":"0", "foto":"http://todaymade.com/blog/wp-content/uploads/2013/03/troll-face.png", "link":"", "descripcion":"asdfghjk", "links":[{"parentpipe":"Social", "link":"www.facebook.com", "linkname":"Face"},{"parentpipe":"Social", "link":"www.twitter.com", "linkname":"Twitter"}]},{ "name":"Damian", "tema":"Pedofilia", "propietario":"1", "cantlinks":"0", "privado":"1", "foto":"http://upload.wikimedia.org/wikipedia/commons/1/13/Facebook_like_thumb.png", "link":"", "descripcion":"amo ser yo", "links":[]}]}';


$(document).ready(function() {
	$.ajax({
		url: "../home/consultaloca.php",
		type: 'POST',
		async: true,
		"success": function(result) {
			console.log(result);
			var obj = JSON.parse(result);
			uname = obj.name;
			apellido = obj.apellido;
			mail = obj.mail;
			fecha = obj.fecha;
			id = obj.id;
			foto = obj.foto;
			pipes = obj.pipes;
			friends = obj.friends;
			cantpipes = pipes.length;

			for(var i=0; i<cantpipes; i++)
			{
				pname[i] = pipes[i].name;
				pipeid[i] = pipes[i].id;
				tema[i] = pipes[i].tema;
				propietario[i] = pipes[i].propietario;
				cantlinks[i] = pipes[i].cantlinks;
				privado[i] = pipes[i].privado;
				pfoto[i] = pipes[i].foto;
				link[i] = pipes[i].link;
				descripcion[i] = pipes[i].descripcion;
				links[i]= pipes[i].links;
				llinks[i] = [];
				parentpipe[i] = [];
				linkname[i] = [];
				idlink[i] = [];

				for(var j=0; j<cantlinks[i]; j++)
				{
					if((pipes[i].links[j].link).indexOf("://") == -1)
					{
						llinks[i][j] = "http://" + pipes[i].links[j].link;
					}else
					{
						llinks[i][j] = pipes[i].links[j].link;
					}
					parentpipe[i][j] = pipes[i].links[j].parentpipe;
					linkname[i][j] = pipes[i].links[j].linkname;
					idlink[i][j] = pipes[i].links[j].idlink;

				}

			}

			for(var i=0; i<friends.length; i++)
			{
				fusu[i] = obj.friends[i].Usuario;
				console.log(fusu[i]);
			}

		$("#drop1").append(uname + " " + apellido);

		load();

		$("#navbar-mypipes").click(function() {


			$('.lista-pipes').html(null);

			$('.lista-pipes').append('<div  class= "col-md-6 pipe-padding" ><!--column--><div class="show-pipe" id="pipe-1" ><span id="add-plus" class="glyphicon glyphicon-plus-sign" data-toggle="modal" data-target="#Modal2" ></span></div></div>');

			load();
	    });

	    $("#navbar-dashboard").click(function() {

			$('.lista-pipes').html(null);

			$('.lista-pipes').append('<div class="col-sm-3 col-md-3 pull-right col-edit-srch"><form class="navbar-form" role="search"><div class="input-group edit-input-group"><input type="text" class="form-control srch-dash" placeholder="Search pipes" name="srch-term" id="srch-term srch-bar"><div class="input-group-btn"><div class="btn btn-default"><i class="fa fa-search lupilla-sign"></i></div></div>');

			console.log($('.srch-dash').val());

			$.ajax({
				url: "../home/pipespublicos.php",
				type: 'POST',
				async: true,
				data: 'like=*',
				"success": function(result) {

					console.log(result);
					var res = JSON.parse(result);

					for (var i = 0; i<res.length; i++ ) 
					{
				    	$('.lista-pipes').append('<div class="col-md-6 pipe-padding"><div id="dash' + i + '" class="show-pipe pipebox" data-toggle="modal" data-target="#ModalLinks"><img src="' + res[i].foto + '" height="250px" width="370px" id="change-res"><div class="coso"><h3 class="piti">' + res[i].name + '</h3></br><h4 class="desc">' + res[i].descripcion +'</h4></div></div></div>');
				    	
				    }

					    $(".pipebox").click(function() {
						var pid = ($(this).attr('id')).substr(4, ($(this).attr('id')).length-4);
						console.log(pid);
						$("#cont").html(null);
						$("#myTitle").html(res[pid].name + ' - ' + res[pid].link);
						var l=res[pid].links;

							for(var i=0; i<res[pid].cantlinks; i++)
							{
								var relleno = l[i].linkname + ' - <a href="' + l[i].link + '">' + l[i].link + '</a>';
								$("#cont").append('<form id="form" class="col-md-8 col-md-offset-2"><div class="form-group form-group-links"><p id="link-dash-' + pid + '-' + i + '">' + relleno + '</p> <i id = cross-dash-' + pid + '-' + i + '" class="fa fa-times cross-link"></i></div>');
							}
				});
				}
			});


			$(".srch-dash").keyup(function() {

				var like;
				if($(this).val() == "")
				{
					like="*";
				}else{
					like=$(this).val();
				}

				console.log(like);

				$('.pipe-padding').remove();

				$.ajax({
				url: "../home/pipespublicos.php",
				type: 'POST',
				async: true,
				data: 'like=' + like,
				"success": function(result) {

					console.log(result);
					var res = JSON.parse(result);

					for (var i = 0; i<res.length; i++ ) 
					{
				    	$('.lista-pipes').append('<div class="col-md-6 pipe-padding"><div id="dash' + i + '" class="show-pipe pipebox" data-toggle="modal" data-target="#ModalLinks"><img src="' + res[i].foto + '" height="250px" width="370px" id="change-res"><div class="coso"><h3 class="piti">' + res[i].name + '</h3></br><h4 class="desc">' + res[i].descripcion +'</h4></div></div></div>');
				    	
				    }

					    $(".pipebox").click(function() {
						pid = ($(this).attr('id')).substr(4, ($(this).attr('id')).length-4);
						console.log(pid);
						$("#cont").html(null);
						$("#myTitle").html(res[pid].name + ' - ' + res[pid].link);
						var l=res[pid].links;

							for(var i=0; i<res[pid].cantlinks; i++)
							{
								var relleno = l[i].linkname + ' - <a href="' + l[i].link + '">' + l[i].link + '</a>';
								$("#cont").append('<form id="form" class="col-md-8 col-md-offset-2"><div class="form-group form-group-links"><p id="link-dash-' + pid + '-' + i + '">' + relleno + '</p> <i id = cross-dash-' + pid + '-' + i + '" class="fa fa-times cross-link"></i></div>');
							}
				});
				}
			});

			});
		});

		$("#navbar-friends").click(function() {

			$('.lista-pipes').html(null);

			$('.lista-pipes').append('<div class="col-sm-3 col-md-3 pull-right col-edit-srch"><form class="navbar-form" role="search"><div class="input-group edit-input-group"><input type="text" class="form-control srch-fri" placeholder="Search" name="srch-term" id="srch-term srch-bar"><div class="input-group-btn"><button class="btn btn-default" type="submit"><i class="fa fa-search lupilla-sign"></i></button></div>');

			  for(var i=0; i<friends.length; i++)
			 {
		 		$('.lista-pipes').append('<div id="f-' + i + '"" class="col-md-4 friend-padding"><div class="show-friend pipebox"><img src="../home/images/usuario.jpg" height="200px" width="200px" id="image-user"><div class="coso"><h4 id="name-user">' + friends[i].Nombre + ' ' + friends[i].Apellido + '</h4><h6 id="user-user">'+ friends[i].Usuario +'</h6></div></div></div>');
		 	 }

		 	 $.ajax({
				url: "../home/consultamigospendient.php",
				type: 'POST',
				async: true,
				"success": function(result) {
					console.log(result);
					var obj = JSON.parse(result);
					console.log(obj.length);

					for(var i=0; i<obj.length; i++)
					 {
						$('.lista-pipes').append('<div id="pf-' + i + '" class="col-md-4 friend-padding pf"><div class="show-friend pipebox"><img src="../home/images/usuario.jpg" height="200px" width="200px" id="image-user"><span id="add-plus" class="glyphicon glyphicon-asterisk add-friend"></span><div class="coso"><h4 id="name-user">' + obj[i].Nombre + ' ' + obj[i].Apellido + '</h4><h6 id="user-user">' + obj[i].Usuario + '</h6></div></div></div>');				 	
				     }

				     $(".pf").click(function() {
				     	console.log(($(this).attr("id")).substr(3, $(this).attr("id").length-3));
				     	var fid = obj[($(this).attr("id")).substr(3, $(this).attr("id").length-3)].Id;
				     	var f = ($(this).attr("id")).substr(3, $(this).attr("id").length-3);
				     	$.ajax({
							url: "../home/confirmaramigo.php",
							type: 'POST',
							async: true,
							data: 'Id_2=' + obj[($(this).attr("id")).substr(3, $(this).attr("id").length-3)].Id + '&Aceptado=1',
							"success": function(result) {
								console.log(result);
								console.log(fid);
								friends[friends.length] = obj[f];
								$("#navbar-friends").trigger('click');
							}
						});
				     });

			  }
			});

		 	 $(".srch-fri").keyup(function() {

		 	 	 $.ajax({
				url: "../home/buscaramigos.php",
				type: 'POST',
				data: 'like=' + $(this).val(),
				async: true,
				"success": function(result) {					
					console.log(result);
					var obj = JSON.parse(result);
					$('.friend-padding').remove();

					for(var i=0; i<obj.length; i++)
					 {

		 				$('.lista-pipes').append('<div id="nf-' + i + '" class="col-md-4 friend-padding nf"><div class="show-friend pipebox"><img src="../home/images/usuario.jpg" height="200px" width="200px" id="image-user"><span id="add-plus" class="glyphicon glyphicon-plus-sign add-friend"></span><div class="coso"><h4 id="name-user">' + obj[i].Nombre + ' ' + obj[i].Apellido + '</h4><h6 id="user-user">' + obj[i].Usuario + '</obj</h6></div></div></div>');
		 			 }

		 			 $(".nf").click(function() {

		 			 		 $.ajax({
								url: "../home/insertamigo.php",
								type: 'POST',
								data: 'Id_2=' + obj[($(this).attr("id")).substr(3, $(this).attr("id").length-3)].Id,
								async: true,
								"success": function(result) {

									console.log(result);
									$("#navbar-friends").trigger('click');
								}
							});

		 			 });
		 	}
		 });

		 	});

		});


	}
	});



		$("#menu-toggle").click(function(e) {
		      e.preventDefault();
			$("#wrapper").toggleClass("toggled");
		});

		$('.dropdown-toggle').dropdown();

		
		$('#add-pipe-btn-share').click(function() {

			$("#add-pipe-btn-share").after('<div class="ui-widget"><input name="share-friends" type="text" placeholder="Search friends..."  id="share-friends" class="pull-left form-control" >  </div>');
			$('#add-pipe-btn-share').attr("disabled", true);
				

		    $( "#share-friends" ).autocomplete({
		      source: fusu
		    });	

		    share();

		});	


		$('#ModalLinks').on('hidden.bs.modal', function () {
				$('#share-friends').remove();
				$('#add-pipe-btn-share').attr("disabled", false);
		});

		$('#ModalLinks').on('shownn.bs.modal', function () {
				
				$("#add-pipe-btn-share").after('<div class="ui-widget"> <input name="share-friends" type="text" placeholder="Search friends..."  id="share-friends" class="pull-left form-control" ></div>  ');

				$( "#share-friends" ).autocomplete({source: fusu});

				share();
		});


	


 
});

function share() {

	$( "#share-friends" ).keyup(function(e) {
		    	var ok = false;
		    	var index;
					for(var i =0; i<fusu.length; i++)
					{
						if ($(this).val() == fusu[i]) {
							ok=true;
							index=i;
						}
					}

				if (e.which == 13 && ok)
				{
					$.ajax({
						url: "../home/compartirpipe.php",
						type: 'POST',
						async: true,
						data: 'idpipe=' + pipeid[pid] + '&idamigo=' + friends[index].Id,
						"success": function(result) {

							console.log(result);

						}
					});

					$(this).val(null);

				}else
				{

					if(ok)
					{
						$(this).css('color', 'green');

					}else
					{
						$(this).css('color', 'red');
					}
				}

				});	
}

function load() {
	for (var i = 0; i<cantpipes; i++ ) {
	        
	    	$('.lista-pipes').append('<div id="d-' + i + '" class="col-md-6 pipe-padding"><div id="' + i + '" class="show-pipe pipebox" data-toggle="modal" data-target="#ModalLinks"><img src="' + pfoto[i] + '" height="250px" width="370px" id="change-res"><div class="coso"><h3 class="piti">' + pname[i] + '</h3></br><h4 class="desc">' + descripcion[i] +'</h4></div></div><i class="fa fa-times cross-pipe"></i></div>');
	    	
	    }


	    $('.cross-pipe').unbind('click').click(function() {
	    	console.log(($(this).parent()).attr('id').substr(2, ($(this).parent()).attr('id').length-2));
	    	var c = ($(this).parent()).attr('id').substr(2, ($(this).parent()).attr('id').length-2);

	    	$.ajax({
								url: "../home/EliminarPipe.php",
								type: 'POST',
								data: 'idpipe=' + pipeid[c],
								async: true,
								"success": function(result) {

									console.log(result);

									pname.splice(c, 1);
									tema.splice(c, 1);
									propietario.splice(c, 1);
									cantlinks.splice(c, 1);
									privado.splice(c, 1);
									pfoto.splice(c, 1);
									link.splice(c, 1);
									descripcion.splice(c, 1);
									pipeid.splice(c, 1);

									llinks.splice(c, 1);
									parentpipe.splice(c, 1);
									linkname.splice(c, 1);
									idlink.splice(c, 1);

									cantpipes--;

									//pipes.splice(c, 1);

									$("#navbar-mypipes").trigger('click');
								}
							});
	    });
	   

	    $('#add-pipe-btn-crear').unbind('click').click(function() {

	    		var n = pname[pname.length] = $("#pipe-name").val();
	    		console.log($("#pipe-name").val());
				tema[tema.length] = $("#pipe-topic").val();
	    		console.log($("#pipe-topic").val());
				propietario[propietario.length] = id;
				cantlinks[cantlinks.length] = '0';
				privado[privado.length] = $("#pipe-private").is(':checked') ;
	    		console.log($("#pipe-private").is(':checked'));
				pfoto[pfoto.length] = $("#pipe-photo").val();
	    		console.log($("#pipe-photo").val());
				link[link.length] = '';
				descripcion[descripcion.length] = $("#pipe-description").val();
	    		console.log($("#pipe-description").val());

				llinks[llinks.length] = [];
				parentpipe[parentpipe.length] = [];
				linkname[linkname.length] = [];
				idlink[idlink.length] = [];
		
			$('.lista-pipes').append('<div id="d-' + (pname.length - 1) + '"  class="col-md-6 pipe-padding"><div id="' + (pname.length - 1) + '" class="show-pipe pipebox" data-toggle="modal" data-target="#ModalLinks"><img src="' + pfoto[pfoto.length-1] + '" height="250px" width="370px" id="change-res"><div class="coso"><h3 class="piti">' + pname[pname.length-1] + '</h3></br><h4 class="desc">' + descripcion[descripcion.length-1] +'</h4></div></div><i class="fa fa-times cross-pipe"></i></div>');

			$.ajax({
				url: "../home/insertarpipewachiiin.php",
				type: 'POST',
				data: 'nombre='+pname[pname.length-1]+'&tema='+tema[tema.length-1]+'&privado='+privado[privado.length-1]+'&descripcion='+descripcion[descripcion.length-1]+'&foto='+pfoto[pfoto.length-1],
				async: true,
				"success": function(result) {
					console.log(result);

					var r = result.split("$$$");
					var le = pipeid.length;
					pipeid[le] = r[0];
					link[le] = r[1];

					console.log(r[1]);

					location.reload();
				}
			});

			$(".pipebox").click(function() {
					pid = $(this).attr('id');
					console.log(pname[pid]);
					$("#cont").html(null);
					$("#myTitle").html(pname[pid] + ' - ' + link[pid]);

					for(var i=0; i<cantlinks[pid]; i++)
					{
						var relleno = linkname[pid][i] + ' - <a href="' + llinks[pid][i] + '">' + llinks[pid][i] + '</a>';
						$("#cont").append('<form id="form" class="col-md-8 col-md-offset-2"><div class="form-group form-group-links"><p id="link-' + pid + '-' + i + '">' + relleno + '</p> <i class="fa fa-times cross-link"></i></div>');
					}

					$("#new").html('<div class="form-group form-group-links"><input name="pipe-add-link-name" type="text" placeholder="Title" class="form-control input-lg add-pipe-input" id="pipe-add-link-name" ><input name="pipe-add-link" type="text" placeholder="Add link" class="form-control input-lg add-pipe-input" id="pipe-add-link" ></div>');			});

		});




		$(".pipebox").click(function() {
			pid = $(this).attr('id');
			console.log(pname[pid] + ' - ' + link[pid]);
			$("#cont").html(null);
			$("#myTitle").html(pname[pid] + ' - ' + link[pid]);

			for(var i=0; i<cantlinks[pid]; i++)
			{
				var relleno = linkname[pid][i] + ' - <a href="' + llinks[pid][i] + '">' + llinks[pid][i] + '</a>';
				$("#cont").append('<form id="form" class="col-md-8 col-md-offset-2"><div class="form-group form-group-links"><p id="link-' + pid + '-' + i + '">' + relleno + '</p> <i id="cross-' + i + '" class="fa fa-times cross-link"></i></div>');
			}

					$("#new").html('<div class="form-group form-group-links"><input name="pipe-add-link-name" type="text" placeholder="Title" class="form-control input-lg add-pipe-input" id="pipe-add-link-name" ><input name="pipe-add-link" type="text" placeholder="Add link" class="form-control input-lg add-pipe-input" id="pipe-add-link" ></div>');


					$(".cross-link").click(function() {
						console.log($(this).attr('id'));
						var pidd = ($(this).attr('id')).substr(6, ($(this).attr('id')).length-6);
						console.log(pidd);


						llinks[pid].splice(pidd, 1);
						parentpipe[pid].splice(pidd, 1);
						linkname[pid].splice(pidd, 1);
						cantlinks[pid]--;

						($('#link-' +  pid.toString() + '-' + pidd.toString()).parent()).parent().fadeOut();

						$.ajax({
								url: "../home/EliminarLink.php",
								type: 'POST',
								data: 'idlink='+idlink[pid][pidd],
								async: true,
								"success": function(result) {
									console.log(result);
									idlink[pid].splice(pidd, 1);
									$( "#add-pipe-btn-close" ).trigger( "click" );
								} });
					});
				});

		$('#add-pipe-btn-save').unbind('click').click(function() {
			var nuevo;

						if($('#pipe-add-link-name').val() != "" && $('#pipe-add-link').val() != "")
						{

							llinks[pid][llinks[pid].length]=$('#pipe-add-link').val();
							parentpipe[pid][parentpipe[pid].length]=pname[pid];
							linkname[pid][linkname[pid].length]=$('#pipe-add-link-name').val();
							cantlinks[pid]++;

							relleno = linkname[pid][linkname[pid].length-1] + ' - <a href="' + llinks[pid][llinks[pid].length-1] + '">' + llinks[pid][llinks[pid].length-1] + '</a>';
							$("#cont").append('<form id="form" class="col-md-8 col-md-offset-2"><div class="form-group form-group-links"><p id="link-' + pid.toString() + '-' + (linkname[pid].length-1).toString() + '">' + relleno + '</p> <i id="cross-' + (linkname[pid].length-1).toString() + '" class="fa fa-times cross-link"></i></div>');
							nuevo = linkname[pid].length-1;

							console.log(pipeid[pid]);
							$.ajax({
								url: "../home/insertlink.php",
								type: 'POST',
								data: 'idpipe='+pipeid[pid]+'&nombre='+ $('#pipe-add-link-name').val() +'&link='+$('#pipe-add-link').val(),
								async: true,
								"success": function(result) {
									console.log(result);

									var r = result.split('$$$');

									for (var i=0; i<r.length; i++) 
									{
										idlink[pid][i] = r[i];
									}
								}

							});
						}

			$(".cross-link").click(function() {
						console.log($(this).attr('id'));
						var pidd = ($(this).attr('id')).substr(6, ($(this).attr('id')).length-6);

						if(pidd == nuevo){
							console.log(pidd);


							llinks[pid].splice(pidd, 1);
							parentpipe[pid].splice(pidd, 1);
							linkname[pid].splice(pidd, 1);
							cantlinks[pid]--;

							($('#link-' +  pid.toString() + '-' + pidd.toString()).parent()).parent().fadeOut();

							$.ajax({
									url: "../home/EliminarLink.php",
									type: 'POST',
									data: 'idlink='+idlink[pid][pidd],
									async: true,
									"success": function(result) {
										console.log(result);
										idlink[pid].splice(pidd, 1);
										$( "#add-pipe-btn-close" ).trigger( "click" );
									} 
							});
						}
			});
		});
}
