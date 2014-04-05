
$(function(){
		$('#formRegistrarse').validate({	
		
			rules :{
					alias : {
						required : true, //para validar campo vacio
						minlength : 6, //para validar campo con minimo 3 caracteres
						maxlength : 20  //para validar campo con maximo 9 caracteres
					},
					email : {
						required : true, //para validar campo vacio
						email    : true,  //para validar formato email
						remote: { url: "./php/comprobarEmail.php", async: false } 
					},
					password : {
						required : true, //para validar campo vacio
						minlength : 6, //para validar campo con minimo 3 caracteres
						maxlength : 15  //para validar campo con maximo 9 caracteres
					},
					confirma_password : {
						required : true, //para validar campo vacio
						minlength : 6, //para validar campo con minimo 3 caracteres
						maxlength : 15,  //para validar campo con maximo 9 caracteres
						equalTo: "#password"
					}
			},
			messages : {
					alias : {
						required : "Debe ingresar su usuario.",
						minlength : "EL usuario debe tener un minimo de 6 caracteres",
						maxlength : "EL usuario debe tener un maximo de 20 caracteres"
					},
			 		email : {
						required : "Debe ingresar su email.",
						email    : "Debe ingresar un email valido.",
						remote    : "Email usado."
					}, 
					password : {
						required : "Debe ingresar su password.",
						minlength : "Su password debe tener un minimo de 6 caracteres",
						maxlength : "Su password debe tener un maximo de 15 caracteres"
					},
					confirma_password : {
						required : "Debe ingresar un password",
						minlength : "Su password debe tener un minimo de 6 caracteres",
						maxlength : "Su password debe tener un maximo de 15 caracteres",
						equalTo: "Los password deben ser iguales."
					}
			}
		});    
		
		$('#formIngresar').validate({
				
			rules :{
					correo : {
						required : true, //para validar campo vacio
						email    : true  //para validar formato email
					},
					clave : {
						required : true //para validar campo vacio
					}
			},
			messages : {
					correo : {
						required : "Debe ingresar su email.",
						email    : "Debe ingresar un email valido."
					},
			 		clave : {
						required : "Debe ingresar su clave."
					}
			}
		});
});