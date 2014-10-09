$(function(){	
		
		$('#crear_partido').validate({

			rules : {
						fecha : {
							required : true
						},
	                    hora : {
						   required: true
						},
						cant_jugadores: {
							digits: true
						}
			},
			messages : {

						fecha : {
							required : "Debe escribir la fecha."
						},
	                    hora : {
							required : "Debe escribir la hora."
						},
						cant_jugadores: {
							digits: "La cantidad debe ser solo numeros"
						}
			}
		});

		$('#editar_partido').validate({

			rules : {
						fecha : {
							required : true
						},
	                    hora : {
						   required: true
						},
						cant_jugadores: {
							digits: true
						}
			},
			messages : {

						fecha : {
							required : "Debe escribir la fecha."
						},
	                    hora : {
							required : "Debe escribir la hora."
						},
						cant_jugadores: {
							digits: "La cantidad debe ser solo numeros"
						}
			}
		});


});
