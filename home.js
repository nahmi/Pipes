var uname;
var apellido;
var mail;
var fecha;
var id;
var foto;
var pipes;
var pname = [];
var tema = [];
var propietario = [];
var cantlinks = [];
var privado = [];
var foto = [];
var link = [];
var descripcion = [];
var links = [];
var parentpipe = [][];
var llink = [][]
var linkname = [][];


$(document).Ready(function(){
	$.ajax({
		url: "consultaloca.php",
		type: 'POST',
		async: true,
		"success": function(result) {
			var obj = JSON.parse(result)
			name = obj.name;
			apellido = obj.apellido;
			mail = obj.mail;
			fecha = obj.fecha;
			id = obj.id;
			foto = obj.foto;
			pipes = obj.pipes;

			for(var i; i<pipes.length; i++)
			{
				pname[pname.length] = pipes[i].name;
				tema[tema.length] = pipes.[i].tema;
				propietario[propietario.length] = pipes.[i].propietario;
				cantlinks[cantlinks.length] = pipes.[i].cantlinks;
				privado[privado.length] = pipes.[i].privado;
				foto[foto.length] = pipes.[i].foto;
				link[link.length] = pipes.[i].link;
				descripcion[descripcion.length] = pipes.[i].descripcion;
				links[i]= pipes[i].links;
				for(var j; j<pipes.[i].links.length; j++)
				{
					llinks[i][links.length] = pipes[i].links[j].link;
					parentpipe[i][links.length] = pipes[i].links[j].parentpipe;
					linkname[i][links.length] = pipes[i].links[j].linkname;



				}

			}
		};
	});
});
