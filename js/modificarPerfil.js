
// ----------------- MAPA ------------------ //

$( document ).ready(function() {
	var options = {
		map: ".map_canvas",
		location: "Buenos Aires",
		details: "form"
	};

	$("#geocomplete").geocomplete(options);			
});

// ----------------- FECHA ------------------ //
$(function() {
    $( "#datepicker" ).datepicker({
      changeMonth: true,
      changeYear: true,
      dateFormat: "yy-mm-dd"
    });


});

// ----------------- VALIDAR ------------------ //


$(function(){	
		
		$('#formModificar').validate({

			rules : {
					alias : { 
						required : true, //para validar campo vacio
						minlength : 6, //para validar campo con minimo 3 caracteres
						maxlength : 20,  //para validar campo con maximo 9 caracteres
					},
					email : {
						required : true, //para validar campo vacio
						email    : true,  //para validar formato email
						remote: { url: "./php/comprobarEmail.php?cambiarEmail=true", async: false } 
					},
					password : {
						minlength : 6, //para validar campo con minimo 3 caracteres
						maxlength : 15  //para validar campo con maximo 9 caracteres
					},
					confirma_password : {
						minlength : 6, //para validar campo con minimo 3 caracteres
						maxlength : 15,  //para validar campo con maximo 9 caracteres
						equalTo: "#password"
					}
			},
			messages : {
					alias : {
						required : "Debe ingresar su usuario.",
						minlength : "EL usuario debe tener un minimo de 6 caracteres",
						maxlength : "EL usuario debe tener un maximo de 20 caracteres",
					},
			 		email : {
						required : "Debe ingresar su email.",
						email    : "Debe ingresar un email valido.",
						remote    : "Email utilizado."
					}, 
					password : {
						minlength : "Su password debe tener un minimo de 6 caracteres",
						maxlength : "Su password debe tener un maximo de 15 caracteres"
					},
					confirma_password : {
						minlength : "Su password debe tener un minimo de 6 caracteres",
						maxlength : "Su password debe tener un maximo de 15 caracteres",
						equalTo: "Los password deben ser iguales."
					}
			}
		});

        $('#formModificarFoto').validate({

			rules : {
					foto : {
                        required : true, //para validar campo vacio
                        accept: "image/*"
					}
			},
			messages : {
				   	foto : {
                        required : "Debe seleccionar una imagen.",
                        accept: "Seleccione archivos de imagen."
					}
			}
		});

});


/*,
					foto : {
						accept: "image/*"
					}
                         ,
					foto : {
						accept: "Seleccione archivos de imagen."
					}
                    */
